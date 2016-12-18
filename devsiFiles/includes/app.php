<?php 
	require "functions.php";
	$app= new Devsi();
	define('ENC_KEY', 'luxferro@#777777');


if(isset($_POST['lusername']) && isset($_POST['lpassword'])){
	$username=Security::decrypt($_POST['lusername'],ENC_KEY);
	$password=Security::decrypt($_POST['lpassword'],ENC_KEY);
	$verifyUser=$app->verifyAppUser($username,$password);
 	$username=$app->sanitize($_POST['lusername']);
	if($verifyUser){
        //get user credentials
        $getUserCredentials=$app->getFullDetails($username,'mlogindetails');
 
		 // user is found
        $response["error"] = FALSE;
        $response["uid"] = Security::encrypt($getUserCredentials[1],ENC_KEY);
        $response["user"]["name"] = Security::encrypt($getUserCredentials[3],ENC_KEY);
        $response["user"]["email"] = Security::encrypt($getUserCredentials[4],ENC_KEY);
        $response["user"]["created_at"] = Security::encrypt($getUserCredentials[7],ENC_KEY);
        $response["user"]["updated_at"] = Security::encrypt($getUserCredentials[7],ENC_KEY);
        echo json_encode($response);

	}else{ 
		// user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "LogIn Credentials not valid. Please try again!!!";
       
        echo json_encode($response);
      
	}
}elseif(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['nickname']) && isset($_POST['passwd']) && isset($_POST['mobno']) && isset($_POST['mobno1']) && isset($_POST['email'])){
	//decrypting data
	$fullname=$app->sanitize($_POST['fullname']);
	$fullname=Security::decrypt($fullname,ENC_KEY);

	$username=$app->sanitize($_POST['username']);
	$username=Security::decrypt($username,ENC_KEY);

	$nickname=$app->sanitize($_POST['nickname']);
	$nickname=Security::decrypt($nickname,ENC_KEY);

	$password=$app->sanitize($_POST['passwd']);
	$password=Security::decrypt($password,ENC_KEY);

	$mobno=$app->sanitize($_POST['mobno']);
	$mobno=Security::decrypt($mobno,ENC_KEY);

	$mobno1=$app->sanitize($_POST['mobno1']);
	$mobno1=Security::decrypt($mobno1,ENC_KEY);

	$email=$app->sanitize($_POST['email']);
	$email=Security::decrypt($email,ENC_KEY);

	$res=$app->addUser($fullname,$username,$nickname,$password,$mobno,$mobno1,$email);
	if($res){
		 $response["error"] = false;
	}else{
		 $response["error"] = TRUE;
         $response["error_msg"] = "Process failed. Please try again!!!";
	}
		echo json_encode($response);
}elseif(isset($_POST['getNotifications'])){
	$hostelzone=$app->getNotifications();
	$response["error"]=FALSE;
	$response["user"]["info"]=sizeof($hostelzone);
	for($i=0; $i < sizeof($hostelzone); $i++){
		$response["user"]["topic".$i]=Security::encrypt($hostelzone[$i][0],ENC_KEY);
		$response["user"]["date".$i]=Security::encrypt($hostelzone[$i][1],ENC_KEY);
	}
	echo json_encode($response);

}elseif(isset($_POST['nDate'])){
	$nDate=$app->sanitize($_POST['nDate']);
	$response["error"]=false;
	$result=$app->getNotificationNote($nDate);
	$response["user"]["notes"]=$result;
	echo json_encode($response);

}elseif(isset($_POST['dish']) && isset($_POST['category'])){
	$dish=$app->sanitize($_POST['dish']);
	$category=$app->sanitize($_POST['category']);
	$dish=Security::decrypt($dish,ENC_KEY);
	$category=Security::decrypt($category,ENC_KEY);
	$menu=$app->getMenu($dish,$category);
	$response["user"]["info"]=sizeof($menu);
	for($i=0; $i < sizeof($menu); $i++){
		$response["user"]["name".$i]=Security::encrypt($menu[$i][0],ENC_KEY);
		$response["user"]["amount".$i]=Security::encrypt($menu[$i][1],ENC_KEY);
		$response["user"]["date".$i]=Security::encrypt($menu[$i][2],ENC_KEY);
	}
	$response["error"]=false;
	echo json_encode($response);
}elseif(isset($_POST['order'])&& isset($_POST['categ']) && isset($_POST['menu']) && isset($_POST['amount']) && isset($_POST['number'])){
	$username=Security::decrypt($app->sanitize($_POST['order']),ENC_KEY);
	$username=$app->getFullDetailsE($username,"mlogindetails");
	$category=Security::decrypt($app->sanitize($_POST['categ']),ENC_KEY);
	$menu=Security::decrypt($app->sanitize($_POST['menu']),ENC_KEY);
	$amount=Security::decrypt($app->sanitize($_POST['amount']),ENC_KEY);
	$number=Security::decrypt($app->sanitize($_POST['number']),ENC_KEY);

	$res=$app->processAppOrder($username[1],$category,$menu,$amount,$number);
	if($res){
		 $response["error"] = false;
	}else{
		 $response["error"] = TRUE;
         $response["error_msg"] = "Process failed. Please try again!!!";
	}
	echo json_encode($response);
}elseif(isset($_POST['eorder']) && isset($_POST['ecateg']) && isset($_POST['emenu']) && isset($_POST['eamount']) && isset($_POST['enumber']) && isset($_POST['elocation'])){
	$username=Security::decrypt($app->sanitize($_POST['eorder']),ENC_KEY);
	$username=$app->getFullDetailsE($username,"mlogindetails");
	$category=Security::decrypt($app->sanitize($_POST['ecateg']),ENC_KEY);
	$menu=Security::decrypt($app->sanitize($_POST['emenu']),ENC_KEY);
	$amount=Security::decrypt($app->sanitize($_POST['eamount']),ENC_KEY);
	$number=Security::decrypt($app->sanitize($_POST['enumber']),ENC_KEY);
	$location=Security::decrypt($app->sanitize($_POST['elocation']),ENC_KEY);
	$res=$app->processAppEOrder($username[1],$category,$menu,$amount,$number,$location);
	if($res){
		 $response["error"] = false;
	}else{
		 $response["error"] = TRUE;
         $response["error_msg"] = "Process failed. Please try again!!!";
	}
	echo json_encode($response);
}

//end of login
?>