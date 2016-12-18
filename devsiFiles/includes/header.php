<?php 
    $userDetails=$devsi->getFullDetails($_SESSION['siadmin'],'logindetails');
    $dp=$devsi->getDp($_SESSION['siadmin']);
    //$message=$devsi->getNum('')
?>
<header class="main-header">
<!-- Logo -->
<a href="?home" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Q</b>SR</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Quick</b>Service Restaurant</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
</a>

<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success"><?php echo $devsi->getNumRows('messages'); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <?php echo $devsi->getNumRows('messages'); ?> messages</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <!-- start message -->
                <!-- <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="banners/<?php echo $dp[0]; ?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li> -->
                <!-- end message -->
            </ul>
        </li>
        <li class="footer"><a href="#">See All Messages</a></li>
    </ul>
</li>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning"><?php echo $devsi->getNumRows('notifications'); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <?php echo $devsi->getNumRows('notifications'); ?> notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
               <!--  <li>
                    <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="footer"><a href="?notifications">View all</a></li>
    </ul>
</li>
<!-- Tasks: style can be found in dropdown.less -->
<li class="dropdown tasks-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-flag-o"></i>
        <span class="label label-danger"><?php echo $devsi->getNumRows('tasks'); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <?php echo $devsi->getNumRows('tasks'); ?> tasks</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <!-- Task item -->
                <!-- <li>
                    <a href="#">
                        <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                        </h3>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </a>
                </li> -->
                <!-- end task item -->
            </ul>
        </li>
        <li class="footer">
            <a href="#">View all tasks</a>
        </li>
    </ul>
</li>
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="banners/<?php echo $dp[0]; ?>" class="user-image" alt="User Image">
        <span class="hidden-xs"><?php echo $userDetails[3]; ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="banners/<?php echo $dp[0]; ?>" class="img-circle" alt="User Image">

            <p>
                <?php echo $userDetails[3]; ?> 
                <small>Administrator</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#chngpwd" data-toggle="modal" class="tooltip-bottom" title="Change Password"><span class="glyphicon glyphicon-lock text-success"></span></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#chngdp" data-toggle="modal" class="tooltip-bottom" title="Change Profile Picture"><span class="glyphicon glyphicon-picture text-warning"></span></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#editDetails" data-toggle="modal" class="tooltip-bottom" title="Edit Profile Details"><span class="glyphicon glyphicon-pencil text-danger"></span></a>
                  </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat tooltip-bottom" title="View Profile">Profile</a>
            </div>
            <div class="pull-right">
                <a href="?logout" class="btn btn-default btn-flat tooltip-bottom" title="Log Out">Sign out</a>
            </div>
        </li>
    </ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>
</nav>
</header>