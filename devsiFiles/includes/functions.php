<?php
require "dbconfig.php";

//encryption class
class Security {
    public static function encrypt($input, $key) {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = Security::pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    private static function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public static function decrypt($sStr, $sKey) {
        $decrypted= mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            base64_decode($sStr),
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
}
//end of encryption class


class Devsi{
    private $con;

    function __construct(){
        $this->con = new PDO("mysql:host=".HOST.";dbname=".DB_NAME."",USERNAME,PASSWORD);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    //mobile app
    ##################################################################################
    function verifyAppUser($username,$password){
        $username=$this->sanitize($username);
        $password=$this->encrypt_decrypt("encrypt",$this->sanitize($password));
        $query="select * from mlogin where username=? and password=?";
        $result=$this->con->prepare($query);
        $result->bindParam("s",$username);
        $result->bindParam("s",$password);
        $result->execute(array($username,$password));
        if($result->rowCount() >=1){
            //user found 
            return true;
        }else{
            return false;
        }
    }



    function processAppEOrder($username,$category,$menu,$amount,$number,$location){
         $sql="insert into externalorders(username,category,menu,persons,location) values(?,?,?,?,?)";
        $result=$this->con->prepare($sql);
        $result->bindParam("s",$username);
        $result->bindParam("s",$category);
        $result->bindParam("s",$menu);
        $result->bindParam("s",$number);
        $result->bindParam("s",$location);
        if($result->execute(array($username,$category,$menu,$number,$location))){
            return true;
        }else{
            return false;
        }
    }

    function processAppOrder($username,$category,$menu,$amount,$number){
        $sql="insert into orders(username,category,menu,persons) values(?,?,?,?)";
        $result=$this->con->prepare($sql);
        $result->bindParam("s",$username);
        $result->bindParam("s",$category);
        $result->bindParam("s",$menu);
        $result->bindParam("s",$number);
        if($result->execute(array($username,$category,$menu,$number))){
            return true;
        }else{
            return false;
        }
    }

    function addUser($fullname,$username,$nickname,$password,$mobno,$mobno1,$email){
        $sql="insert into mlogin(username,password) values(?,?)";
        $result=$this->con->prepare($sql);
        $result->bindParam("s",$username);
        $result->bindParam("s",$this->encrypt_decrypt("encrypt",$password));
        $result->execute(array($username,$this->encrypt_decrypt("encrypt",$password)));
        $cDate=$this->genDate();
        $sql="insert into mlogindetails(username,nickname,fullname,email,mobileNo1,mobileNo2,datereg) values(?,?,?,?,?,?,?)";
        $result=$this->con->prepare($sql);
        $result->bindParam("s",$username);
        $result->bindParam("s",$nickname);
        $result->bindParam("s",$fullname);
        $result->bindParam("s",$email);
        $result->bindParam("s",$mobno);
        $result->bindParam("s",$mobno1);
        $result->bindParam("s",$cDate);
        $res=$result->execute(array($username,$nickname,$fullname,$email,$mobno,$mobno1,$cDate));
        if($res){
            return true;
        }else{
            return false;
        }

    }

    function getMenu($dish,$category){
        $data=array();
        $dish=$this->sanitize($dish);
        $category=$this->sanitize($category);
        $query="select * from ".$category." order by date desc";
        $result=$this->con->query($query);
        $count=0;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            $data[$count][0]=$row['name'];
            $data[$count][1]=$row['amount'];
            $data[$count][2]=$row['date'];
            $count++;
        }
        return $data;
    }
    
    ##################################################################################
    //end of mobile app


    function sanitize2($data){
        return trim($data);
    }

    function checkifLoggedIn(){
        if(isset($_SESSION['siadmin'])){
            echo "<script>
                        window.location.assign('index.php');
                    </script>";
        }
    }

    function checkLogIn(){
        if(!isset($_SESSION['siadmin'])){
            echo "<script>window.location.assign('login.php');</script>";
        }
    }

    function updateAppConfig(){
        $appid=$this->sanitize($_POST['appid']);
        $appkey=$this->sanitize($_POST['appkey']);
        $query="update appconfig set appid=?, appkey=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$appid);
        $result->bindParam('s',$appkey);
        if($result->execute(array($appid,$appkey))){
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>App Configuration updated..!!!</span></center>');
                            window.location.assign('?dashboard');
                        </script>";
        }else{
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!!</span></center>');
                            window.location.assign('?dashboard');
                        </script>";
        }
    }

    //updating app configuration

    function sanitize($data){
        return htmlentities(trim($data));
    }

    //encryption/decryption algorithm

    function getNotifications(){
        $data=array();
        $query="select * from notifications";
        $result=$this->con->query($query);
        $count=0;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            $data[$count][0]=$row['message'];
            $data[$count][1]=$row['date'];
            $count++;
        }
        return $data;
    }
    //end of encryption/decryption algorithm


    //getting notifications

    function getNotificationNote($nDate){
        $query="select message from notifications where date='$nDate' limit 1";
        $result=mysql_query($query);
        $result=mysql_fetch_row($result);
        return $result[0];
    }

    function updatePass($username,$oldpassword,$newpassword){
        $username=$this->sanitize($username);
        $oldpassword=$this->sanitize($oldpassword);
        $newpassword=$this->sanitize($newpassword);
        $oldpassword=$this->encrypt_decrypt('encrypt',$oldpassword);
        $query="select * from login where username=? and password=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->bindParam('s',$oldpassword);
        $result->execute(array($username,$oldpassword));
        if($result->rowCount() >=1){
            //user exists; ready for update
            $newpassword=$this->encrypt_decrypt('encrypt',$newpassword);
            $query1="update login set password=? where username=?";
            $result1=$this->con->prepare($query1);
            $result1->bindParam('s',$newpassword);
            $result1->bindParam('s',$username);
            if($result1->execute(array($newpassword,$username))){
                $this->updatePassChng($username);
                echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Process Complete..!!!</span></center>');
                            window.location.assign('?logout');
                        </script>";
            }else{
                echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed...Try again!!!</span></center>');
                            window.location.assign('?dashboard');
                        </script>";
            }

        }else{
            //user doesnot exist through an error
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'> Process failed...Try again!!!</span></center>');
                            window.location.assign('?dashboard');
                        </script>";
        }

    }

    //updating password

    function encrypt_decrypt($action,$string){
        $output=false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = "luxferro@#777";
        $secret_iv = "luxferro@#777";

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC 16 bytes
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    function updatePassChng($username){
        $username=$this->sanitize($username);
        $cDate=$this->genDate();
        $query="insert into lastpasschng(username,date) values(?,?)";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->bindParam('s',$cDate);
        $result->execute(array($username,$cDate));
    }

    //getting profilePic

    function genDate(){
        return date('Y-m-d h:i:s');
    }


    function processWelcome($welcome){
        $welcome=$this->sanitize($welcome);
        if($welcome=="1"){
            if(isset($_SESSION['init']) && $_SESSION['init']==1){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $_SESSION['init']=0;
            echo 0;
        }
    }

    function nOrders(){
        $sql="select * from orders where status=0";
        $result=$this->con->query($sql);
        $num=$result->rowCount();
        if($num > 0){
            echo 1;
        }else{
            echo 0;
        }
    }

    function eorders(){
        $sql="select * from orders where status=0";
        $result=$this->con->query($sql);
        $num=$result->rowCount();
        if($num > 0){
            echo 1;
        }else{
            echo 0;
        }
    }

    //updating dp

    function verifyLogin($username,$password){
        $username=$this->sanitize($username);
        $password=$this->encrypt_decrypt("encrypt",$this->sanitize($password));
        $query="select * from login where username=? and password=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->bindParam('s',$password);
        $result->execute(array($username,$password));
        if($result->rowCount() >= 1){
            $_SESSION['siadmin']=$username;
            $_SESSION['init']=1;
            $_SESSION['orders']=0;
            $_SESSION['eorders']=0;
            $this->updateLastLogin($username);
            $this->updateStatus($username,1);
            echo "<script>
                    $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>LogIn successful..!!</span></center>').fadeOut(10000);
                        window.location.assign('index.php');
                </script>";
        }else{
            echo "<script>
                    $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>LogIn failed!!</span></center>').fadeOut(10000);
                        window.location.assign('login.php');
                </script>";
        }
    }

    //getting number of rows in a table

    function updateLastLogin($username){
        $username=$this->sanitize($username);
        $ip=$_SERVER['REMOTE_ADDR'];
        $cDate=$this->genDate();
        $query="insert into lastlogin(username,ip,date) values(?,?,?)";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->bindParam('s',$ip);
        $result->bindParam('s',$cDate);
        $result->execute(array($username,$ip,$cDate));
    }

    //getting full details

    function updateStatus($username,$value){
        $username=$this->sanitize($username);
        $value=intval($this->sanitize($value));
        $query="select * from active where username=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        if($result->rowCount() >= 1){
            //user already exists; update status
            $query1="update active set status=? where username=?";
            $result1=$this->con->prepare($query1);
            $result1->bindParam('i',$value);
            $result1->bindParam('s',$username);
            $result1->execute(array($value,$username));

        }else{
            //insert status
            $query1="insert into active(username,status) values(?,?)";
            $result1=$this->con->prepare($query1);
            $result1->bindParam('s',$username);
            $result1->bindParam('i',$value);
            $result1->execute(array($username,$value));
        }

    }

    //get app config

    function updateDp(){
        $username=$this->sanitize($_SESSION['siadmin']);
        if(is_uploaded_file($_FILES['dp']['tmp_name'])){
            //validating input file
            $aFiles=['png','PNG','jpg','JPEG','jpeg','JPG'];
            $ext=explode('.', $_FILES['dp']['name']);
            $ext=end($ext);
            if(!in_array($ext, $aFiles)){
                echo "<script>
                    $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                        window.location.assign('?dashboard');
                    </script>";
            }else{
                $newfilename=date('Ymdhis').".".$ext;
                //getting previous file name
                $previousImage=$this->getDp($_SESSION['siadmin']);
                if(move_uploaded_file($_FILES['dp']['tmp_name'], 'banners/'.$newfilename)){
                    unlink("banners/".$previousImage[0]);
                    $query="update dp set image=? where username=?";
                    $result=$this->con->prepare($query);
                    $result->bindParam('s',$newfilename);
                    $result->bindParam('s',$_SESSION['siadmin']);
                    $result->execute(array($newfilename,$_SESSION['siadmin']));
                    echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Profile picture update..!!</span></center>').fadeOut(10000);
                                window.location.assign('?dashboard');
                        </script>";
                }else{
                    echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?dashboard');
                        </script>";
                }
            }
        }else{
            echo "<script>
                    $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                        window.location.assign('?dashboard');
                </script>";
        }
    }

    //generating last login

    function getDp($username){
        $query="select image from dp where username=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        return $result->fetch();
    }

    function getNumRows($table){
        $table=$this->sanitize($table);
        $query="select count(*) from ".$table;
        $result=$this->con->query($query);
        $num=$result->fetch();
        return $num[0];
    }

    function getFullDetails($username,$table){
        $data=array();
        $username=$this->sanitize($username);
        $table=$this->sanitize($table);
        $query="select * from ".$table." where username=? limit 1";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        $data=$result->fetch();
        return $data;
    }

    function getFullDetailsE($username,$table){
        $data=array();
        $username=$this->sanitize($username);
        $table=$this->sanitize($table);
        $query="select * from ".$table." where email=? limit 1";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        $data=$result->fetch();
        return $data;
    }

    //send notification

    function genLastLogin(){
        $query="select * from lastlogin order by date desc";
        $result=$this->con->query($query);
        $count=1;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td><center>".$row['ip']."</center></td><td><center>".$row['date']."</center></td></tr>";
            $count++;
        }
    }

    //generating log list

    function processDeviceRequest($deviceId,$event){
        $deviceId=$this->sanitize($deviceId);
        $event=intval($this->sanitize($event));
        $cDate=$this->genDate();
        if($event==1){
            //initiated a process
            $this->sendAppNotification("Device Triggered");
            $query="insert into deviceinit(name,date) values(?,?)";
            $result=$this->con->prepare($query);
            $result->bindParam('s',$deviceId);
            $result->bindParam('s',$cDate);
            if($result->execute(array($deviceId,$cDate))){
                echo 1;
            }else{
                echo 0;
            }
        }elseif($event==0){
            //stopped a process
            $this->sendAppNotification("Device Stopped");
            $query1="insert into devicestop(name,date) values(?,?)";
            $result1=$this->con->prepare($query1);
            $result1->bindParam('s',$deviceId);
            $result1->bindParam('s',$cDate);
            if($result1->execute(array($deviceId,$cDate))){
                echo 1;
            }else{
                echo 0;
            }
        }


    }

    //generating notification list

    function sendAppNotification($message){
        $appConfig=$this->getAppConfig();
        $message=$this->sanitize($message);
        $curdate=$this->genDate();

        $this->addNotification($message,$curdate);

        // echo $appConfig[2];
        $APPLICATION_ID = $appConfig[1];
        $REST_API_KEY = $appConfig[2];
        $url = 'https://api.parse.com/1/push';
        $data = array(
            'channel' => 'SMART-IRRIGATION',
            'expiry' => 1451606400,
            'data' => array(
                'alert' => $message,
            ),
        );

        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        try{
            curl_exec($curl);

        }catch(Exception $e){

        }

    }

    //content view

    function getAppConfig(){
        $data=array();
        $query="select * from appconfig limit 1";
        $result=$this->con->query($query);
        $data=$result->fetch();
        return $data;
    }

    function addNotification($message,$curdate){
        $query="insert into notifications(message,date) values(?,?)";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$message);
        $result->bindParam('s',$curdate);
        $result->execute(array($message,$curdate));
    }

    function genLogList(){
        //trigger list
        $query="select * from deviceinit order by date desc";
        $result=$this->con->query($query);
        $count=1;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td><center>".$row['name']."</center></td><td><center>Device Triggered</center></td><td><center>".$row['date']."</center></td></tr>";
            $count++;
        }
        $query1="select * from devicestop order by date desc";
        $result1=$this->con->query($query1);
        while($row1=$result1->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td><center>".$row1['name']."</center></td><td><center>Device Stopped</center></td><td><center>".$row1['date']."</center></td></tr>";
            $count++;
        }
    }

    //last password change

    function genNotificationList(){
        //trigger list
        $query="select * from notifications order by date desc";
        $result=$this->con->query($query);
        $count=1;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td><center>".$row['message']."</center></td><td><center>".$row['date']."</center></td></tr>";
            $count++;
        }
    }

    function toggleStatusId($table,$id){
        $table=$this->sanitize($table);
        $id=$this->sanitize($id);

        $query="update ".$table." set status=1 where id=".$id."";
        if($this->con->query($query)){
            echo 1;
        }else{
            echo 0;
        }
    }


    function loadExternalOrders(){
        $sql="select * from externalorders order by status";
        $result=$this->con->query($sql);
        $data="<table class='table table-bordered table-hover table-condensed' id='tableList'>";
        $data.="<thead>
                <tr><th><center>No.</center></th><th><center>Full Name</center></th><th><center>Order</center></th><th><center>Plate(s)</center></th><th><center>Location</center></th><th></th></tr>
            </thead>";
        $data.="<tbody>";
        $count=1;
        while($row=$result->fetch()){
            $details=$this->getFullDetails($row['username'],'mlogindetails');
            $data.="<tr><td><center>".$count."</center></td><td>".$details[3]."</td><td>".$row['menu']."</td><td><center>".$row['persons']."</center></td><td>".$row['location']."</td>";
            if($row['status']==1){
                $data.="<td><center><button type='button' class='btn btn-xs btn-success br' onclick=\"toggleStatusId('".$row['id']."')\"><span class='glyphicon glyphicon-ok'></span></button></center></td>";
            }else{
                 $data.="<td><center><button type='button' class='btn btn-xs btn-warning br' onclick=\"toggleStatusId('".$row['id']."')\"><span class='glyphicon glyphicon-refresh'></span></button></center></td>";
            }
            $count++;
        }
        $data.="</tbody>";
        $data.="</table>";
        echo $data;
    }

    function loadInternalOrders(){
        $sql="select * from orders order by status";
        $result=$this->con->query($sql);
        $data="<table class='table table-bordered table-hover table-condensed' id='tableList'>";
        $data.="<thead>
                <tr><th><center>No.</center></th><th><center>Full Name</center></th><th><center>Order</center></th><th><center>Plate(s)</center></th><th></th></tr>
            </thead>";
        $data.="<tbody>";
        $count=1;
        while($row=$result->fetch()){
            $details=$this->getFullDetails($row['username'],'mlogindetails');
            $data.="<tr><td><center>".$count."</center></td><td>".$details[3]."</td><td>".$row['menu']."</td><td><center>".$row['persons']."</center></td>";
            if($row['status']==1){
                $data.="<td><center><button type='button' class='btn btn-xs btn-success br' onclick=\"toggleStatusId('".$row['id']."')\"><span class='glyphicon glyphicon-ok'></span></button></center></td>";
            }else{
                 $data.="<td><center><button type='button' class='btn btn-xs btn-warning br' onclick=\"toggleStatusId('".$row['id']."')\"><span class='glyphicon glyphicon-refresh'></span></button></center></td>";
            }
            $count++;
        }
        $data.="</tbody>";
        $data.="</table>";
        echo $data;
    }

    function editMenuItem($category){
        $name=$this->sanitize($_POST['dish']);
        $amount=$this->sanitize($_POST['amount']);
        $category=$this->sanitize($category);
        $id=$this->sanitize($_POST['menuid']);
        $query="update ".$category." set name=?,amount=? where id=?";
        $result=$this->con->prepare($query);
        $result->bindParam("s",$name);
        $result->bindParam("s",$amount);
        $result->bindParam("s",$id);
        if($result->execute(array($name,$amount,$id))){
             echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Menu Item updated..!!</span></center>').fadeOut(10000);
                                window.location.assign('?".$category."');
                        </script>";
        }else{
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?".$category."');
                        </script>";
        }
    }

    function addMenuItem($category){
        $name=$this->sanitize($_POST['dish']);
        $amount=$this->sanitize($_POST['amount']);
        $category=$this->sanitize($category);
        $tDate=$this->genDate();
        $query="insert into ".$category."(name,amount,date) values(?,?,?)";
        $result=$this->con->prepare($query);
        $result->bindParam("s",$name);
        $result->bindParam("s",$amount);
        $result->bindParam("s",$tDate);
        if($result->execute(array($name,$amount,$tDate))){
             echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Menu Item added..!!</span></center>').fadeOut(10000);
                                window.location.assign('?".$category."');
                        </script>";
        }else{
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?".$category."');
                        </script>";
        }
    }

    function editContinentalMenuItem(){
        $id=$this->sanitize($_POST['edit']);
        $query="select * from continental where id=".$id;
        $result=$this->con->query($query);
        $result=$result->fetch();
        echo "
            <div class='row' style='margin: 15px;'>
                <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                    <div class='modal-header' style='background-color: #3c8dbc; color: #fff;'>
                        <h5 style='text-align: center; font-size: 18px;'><span class='glyphicon glyphicon-th'></span> Continental Dish(es)</h5>
                    </div>
                    <div class='modal-body'>
                        <form method='post' action='?continental' class='form'>
                            <legend></legend>
                            <div class='form-group'>
                                <label for='item'>Menu Item:</label>
                                <input type='text' name='dish' value='".$result[1]."' placeholder='Menu Item' required autofocus class='form-control'/>
                                <input type='hidden' name='menuid' value='".$id."'/>
                            </div>
                            <div class='form-group'>
                                <label for='amount'>Amount per plate(GH&cent;):</label>
                                <input type='text' name='amount' value='".$result[2]."' placeholder='Amount per plate(GH&cent;)' required class='form-control'/>
                            </div>
                            <div class='form-group'>
                                <center><button type='submit' name='editMenu' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-edit'></span> Update Menu Item</button> &nbsp; <a href='?continental' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span> Close</a></center>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>

                    </div>
                </div>
            </div>
            </div>
        ";
    }

    function editLocalMenuItem(){
        $id=$this->sanitize($_POST['edit']);
        $query="select * from local where id=".$id;
        $result=$this->con->query($query);
        $result=$result->fetch();
        echo "
            <div class='row' style='margin: 15px;'>
                <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                    <div class='modal-header' style='background-color: #3c8dbc; color: #fff;'>
                        <h5 style='text-align: center; font-size: 18px;'><span class='glyphicon glyphicon-th'></span> Local Dish(es)</h5>
                    </div>
                    <div class='modal-body'>
                        <form method='post' action='?local' class='form'>
                            <legend></legend>
                            <div class='form-group'>
                                <label for='item'>Menu Item:</label>
                                <input type='text' name='dish' value='".$result[1]."' placeholder='Menu Item' required autofocus class='form-control'/>
                                <input type='hidden' name='menuid' value='".$id."'/>
                            </div>
                            <div class='form-group'>
                                <label for='amount'>Amount per plate(GH&cent;):</label>
                                <input type='text' name='amount' value='".$result[2]."' placeholder='Amount per plate(GH&cent;)' required class='form-control'/>
                            </div>
                            <div class='form-group'>
                                <center><button type='submit' name='editMenu' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-edit'></span> Update Menu Item</button> &nbsp; <a href='?local' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span> Close</a></center>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>

                    </div>
                </div>
            </div>
            </div>
        ";
    }

    function loadContentDishes(){
        $query="select * from continental order by date desc";
        $result=$this->con->query($query);
        $count=1;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td>".$row['name']."</td><td><center>".$row['amount']."</center></td><td><center><form method='post' action='?continental'><button type='submit' name='edit' value='".$row['id']."' class='btn btn-xs btn-info tooltip-bottom' title='Edit' style='border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px;'><span class='glyphicon glyphicon-pencil'></span></button></form></center></td><td><center><button type='button' class='btn btn-xs btn-danger tooltip-bottom' title='Delete' style='border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px;' onclick=\"delMenuItem('continental','".$row['id']."');\"><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>";
            $count++;
        }
    }

    function loadLocalDishes(){
        $query="select * from local order by date desc";
        $result=$this->con->query($query);
        $count=1;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><center>".$count."</center></td><td>".$row['name']."</td><td><center>".$row['amount']."</center></td><td><center><form method='post' action='?local'><button type='submit' name='edit' value='".$row['id']."' class='btn btn-xs btn-info tooltip-bottom' title='Edit' style='border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px;'><span class='glyphicon glyphicon-pencil'></span></button></form></center></td><td><center><button type='button' class='btn btn-xs btn-danger tooltip-bottom' title='Delete' style='border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px;' onclick=\"delMenuItem('local','".$row['id']."');\"><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>";
            $count++;
        }
    }

    function delMenuItem($category,$id){
        $category=$this->sanitize($category);
        $id=$this->sanitize($id);
        $query="delete from ".$category." where id=".$id;
        $result=$this->con->query($query);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    function delDishCategory($category){
        $category=$this->sanitize($category);
        $query="delete from ".$category;
        $result=$this->con->query($query);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    function loadContent(){
        if(isset($_GET['logout'])){
            include "dashboard.php";
            $this->updateStatus($_SESSION['siadmin'],0);
            unset($_SESSION['siadmin']);
            echo "<script>window.location.assign('login.php'); </script>";
        }elseif(isset($_GET['dashboard'])){
            include "dashboard.php";
        }elseif(isset($_GET['lastlogin'])) {
            include "lastlogin.php";
        }elseif(isset($_GET['notifications'])){
            include "notifications.php";
        }elseif(isset($_GET['continental'])){
            include "continental.php";
        }elseif(isset($_GET['local'])){
            include "local.php";
        }elseif(isset($_GET['internal'])){
            include "internal.php";
        }elseif(isset($_GET['external'])){
            include "external.php";
        }else{
            include "dashboard.php";
        }
    }

    //last login

    function cRight(){
        $startDate="2016";
        if(Date('Y')==$startDate){
            echo $startDate;
        }else{
            echo $startDate."-".Date("Y");
        }
    }

    function getPassChng($username){
        $data=array();
        $data[0]="-";
        $username=$this->sanitize($username);
        $query="select * from lastpasschng where username=? order by date desc";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        $count=0;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            if($count==1){
                break;
            }
            $data[0]=$row['date'];
            $count++;
        }
        return $data;
    }

    //updating login status

    function getLastLogin($username){
        $data=array();
        $data[0]="-";
        $data[1]="-";
        $username=$this->sanitize($username);
        $query="select * from lastlogin where username=? order by date desc";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$username);
        $result->execute(array($username));
        $count=0;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            if($count==2){
                break;
            }
            $data[0]=$row['ip'];
            $data[1]=$row['date'];
            $count++;
        }
        return $data;
    }

    //getting active members

    function getActiveUsers(){
        $query="select * from active where status=1";
        $result=$this->con->query($query);
        return $result->rowCount();
    }

    //update username change

    function updateProf(){
        $oldusername=$this->sanitize($_POST['oldusername']);
        $newusername=$this->sanitize($_POST['username']);
        $nickname=$this->sanitize($_POST['nickname']);
        $fullname=$this->sanitize($_POST['fullname']);
        $email=$this->sanitize($_POST['email']);
        $mobileNo1=$this->sanitize($_POST['mobileNo1']);
        $mobileNo2=$this->sanitize($_POST['mobileNo2']);
        $query="update logindetails set username=?, nickname=?, fullname=?, email=?, mobileNo1=?, mobileNo2=? where username=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$newusername);
        $result->bindParam('s',$nickname);
        $result->bindParam('s',$fullname);
        $result->bindParam('s',$email);
        $result->bindParam('s',$mobileNo1);
        $result->bindParam('s',$mobileNo2);
        $result->bindParam('s',$oldusername);
        if($result->execute(array($newusername,$nickname,$fullname,$email,$mobileNo1,$mobileNo2,$oldusername))){
            //updating other tables
            $this->updateUChng($oldusername,$newusername,'active');
            $this->updateUChng($oldusername,$newusername,'dp');
            $this->updateUChng($oldusername,$newusername,'lastlogin');
            $this->updateUChng($oldusername,$newusername,'lastpasschng');
            $this->updateUChng($oldusername,$newusername,'login');
            $_SESSION['siadmin']=$newusername;
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Profile Updated..!!</span></center>').fadeOut(10000);
                                window.location.assign('?dashboard');
                        </script>";
        }else{
            echo "<script>
                            $('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?dashboard');
                        </script>";
        }
    }

    //updating profile details

    function updateUChng($oldusername,$newusername,$table){
        $oldusername=$this->sanitize($oldusername);
        $newusername=$this->sanitize($newusername);
        $table=$this->sanitize($table);
        $query="update ".$table." set username=? where username=?";
        $result=$this->con->prepare($query);
        $result->bindParam('s',$newusername);
        $result->bindParam('s',$oldusername);
        $result->execute(array($newusername,$oldusername));
    }
}