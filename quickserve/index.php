
<!--including modals-->
<?php
session_start();
require "../devsiFiles/includes/functions.php";
$devsi = new Devsi();
$devsi->checkLogIn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QUICK SERVICE RESTAURANT | Dashboard</title>
   <?php include "../devsiFiles/includes/scripts.php"; ?>
   <!--second script-->
	<?php include "../devsiFiles/includes/scripts2.php"; ?>
    <style type="text/css">
        @font-face{
            font-family: flower;
            src: url('lovelyfonts/Fflowers-v5.03-9797E33C501E135A76041110B3FD885E.ttf');
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<!--including header file -->
		<?php include "../devsiFiles/includes/header.php"; ?>


		<!--including sidebar -->
		<?php include "../devsiFiles/includes/sidebar.php"; ?>


		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			<?php include "../devsiFiles/includes/maincontent.php"; ?>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->



		<!--footer-->
		<?php include "../devsiFiles/includes/footer.php"; ?>


		<!-- Control Sidebar -->
		<?php include "../devsiFiles/includes/controlsidebar.php"; ?>

		<!--including modals-->
		<?php include "../devsiFiles/includes/modals.php"; ?>

	</div>
	<script type="text/javascript">

		function onShowNotification () {
            console.log('notification is shown!');
        }

        function onCloseNotification () {
            console.log('notification is closed!');
        }

        function onClickNotification () {
            console.log('notification was clicked!');
        }

        function onErrorNotification () {
            console.error('Error showing notification. You may need to request permission.');
        }

        function onPermissionGranted () {
            console.log('Permission has been granted by the user');
            doNotification();
        }

        function onPermissionDenied () {
            console.warn('Permission has been denied by the user');
        }

        var Notify = window.Notify.default;
		//performing test on login to display welcome notification
		$.post('ajax.php',{'welcome':'1'},function(data){
			if(data==1){
				//show notification
				if (!Notify.needsPermission) {
		            doNotification();
		            $.post('ajax.php',{'welcome':'0'},function(data){});
		        } else if (Notify.isSupported()) {
		            Notify.requestPermission(onPermissionGranted, onPermissionDenied);
		        }
			}
		});

		function doNotification () {
            var myNotification = new Notify('Hello, Admin', {
                body: 'Welcome to Quick Service Admin Portal',
                tag: 'Welcome',
                notifyShow: onShowNotification,
                notifyClose: onCloseNotification,
                notifyClick: onClickNotification,
                notifyError: onErrorNotification,
                timeout: 4
            });

            myNotification.show();
        }


        function doOrders () {
            var myNotification = new Notify('Hello, Admin', {
                body: 'New order received',
                tag: 'Welcome',
                notifyShow: onShowNotification,
                notifyClose: onCloseNotification,
                notifyClick: processorder,
                notifyError: onErrorNotification,
                timeout: 4
            });

            myNotification.show();
        }

         function doEorders () {
            var myNotification = new Notify('Hello, Admin', {
                body: 'New external order received',
                tag: 'Order',
                notifyShow: onShowNotification,
                notifyClose: onCloseNotification,
                notifyClick: processE,
                notifyError: onErrorNotification,
                timeout: 4
            });

            myNotification.show();
        }

        function processorder(){
        	window.location.assign('?internal');
        }

        function processE(){
        	window.location.assign('?external');
        }

        //perform check on orders
        setInterval(function(){
        	$.post('ajax.php',{'orders':'y'},function(data){
        		if(data==1){
        			doOrders();
        		}
        	});
        },1000);

        setInterval(function(){
        	$.post('ajax.php',{'eorders':'y'},function(data){
        		if(data==1){
        			doEorders();
        		}
        	});
        },1000);
	</script>
</body>
</html>
