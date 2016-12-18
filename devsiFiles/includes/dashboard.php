<?php
$data=$this->getLastLogin($_SESSION['siadmin']);
$data1=$this->getPassChng($_SESSION['siadmin']);
?>
<section class="content-header">
    <h1>
        <span class="fa fa-dashboard"></span> Dashboard
        <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>


<!--main content -->
<section class="content">
    <div class="row" id="displayRes" style="margin: 15px;"></div>
    <?php
    if(isset($_POST['updatePass'])){
        $this->updatePass($_SESSION['siadmin'],$_POST['oldpassword'],$_POST['newpassword']);
    }elseif(isset($_POST['updateDp'])){
        $this->updateDp();
    }elseif(isset($_POST['updateProf'])){
        $this->updateProf();
    }elseif(isset($_POST['updateAppConfig'])){
        $this->updateAppConfig();
    }
    ?>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h4><b><?php echo $data[1]; ?></b></h4>
                    <p>Last LogIn(Date)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-log-in"></i>
                </div>
                <a href="?lastlogin" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!--last login date -->

        <!--last login ip -->
        <div class="col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h4><b><?php echo $data[0]; ?></b></h4>
                    <p>Last LogIn(IP Address)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                <a href="?lastlogin" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!--last login ip -->

        <!--last password change -->
        <div class="col-md-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h4><b><?php echo $data1[0]; ?></b></h4>
                    <p>Last Password Change</p>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
                <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!--end of last password change -->

        <!--active users-->
        <div class="col-md-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h4><b><?php echo $this->getActiveUsers();  ?></b></h4>
                    <p>Active Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!--end of active users-->

    </div>
    <div class="row" style="margin: 1px;">
        <div style="align: center;">
            <br/><br/>
            <center><img src="banners/bg.jpg" id="qsrbg" style="width: 300px; height: 300px; border-radius: 50px;
                -webkit-border-radius: 50px; -moz-border-radius: 50px;"/></center>
        </div>
    </div>
</section>
<!--end of main content -->
<script type="text/javascript">
   setInterval(function(){
    $('#qsrbg').fadeOut(1000);
    $('#qsrbg').fadeIn(1000);
   },1000);
</script>