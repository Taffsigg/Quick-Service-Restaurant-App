<?php 
    $appConfig=$devsi->getAppConfig();
?>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                   <!--  <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a> -->
                </li>
                
            </ul>
            <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post" action="?dashboard" class="form">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label for="appid">App ID:</label>
                    <input type="text" id="appid" name="appid" value="<?php echo $appConfig[1]; ?>" class="form-control" placeholder="App ID" required autofocus/>
                </div>
                <div class="form-group">
                    <label for="appkey">Rest API Key:</label>
                    <input type="text" id="appkey" name="appkey" value="<?php echo $appConfig[2]; ?>" class="form-control" placeholder="App Key" required/>
                </div>
                <div class="form-group">
                    <center><button type="submit" name="updateAppConfig" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Update Configuration</button></center>
                </div>
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- ./wrapper -->