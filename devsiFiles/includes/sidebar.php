<?php 
    $userDetails=$devsi->getFullDetails($_SESSION['siadmin'],'logindetails');
    $dp=$devsi->getDp($_SESSION['siadmin']);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="banners/<?php echo $dp[0]; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $userDetails[2]; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="?dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="header">MENU</li>
            <li clas="treeview">
                <a href="?continental">
                    <i class="fa fa-th"></i> <span>Continental Dishes</span>
                </a>
            </li>
            <li class="treeview">
                <a href="?local">
                    <i class="fa fa-th"></i> <span>Local Dishes</span>
                </a>
            </li>
            <li class="header">ORDERS</li>
            <li class="treeview">
                <a href="?internal">
                    <i class="fa fa-send"></i> <span>Internal Orders</span>
                </a>
            </li>
            <li class="treeview">
                <a href="?external">
                    <i class="fa fa-send"></i> <span>External Orders</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>