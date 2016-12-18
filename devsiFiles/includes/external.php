<?php
$data=$this->getLastLogin($_SESSION['siadmin']);
$data1=$this->getPassChng($_SESSION['siadmin']);
?>
<section class="content-header">
    <h1>
        <span class="fa fa-dashboard"></span> External Orders
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?dashboard"><i class="fa fa-dashboard"></i> External Orders</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>


<!--main content -->
<section class="content">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="panel-title"><center><span class="glyphicon glyphicon-dashboard"></span> Internal Orders</center></h3>
			</div>
			<div class="modal-content">
				<div class="row" style="margin: 15px;" id="displayRes"></div>
				<div class="row" style="margin: 15px;"><br/></div>
				<div class="row" style="margin: 15px;">
					<?php $this->loadExternalOrders();  ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$('#tableList').DataTable({
		responsive: true
	})

	function toggleStatusId(id){
		x=confirm('Are you sure you want to proceed?');
		if(x){
			$.post('ajax.php',{'toggle':'externalorders','tid':id},function(data){
				if(data==1){
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Process complete..</span></center>');
					window.location.assign('?internal');
				}else{
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-info\' role=\'alert\'>Process cancelled..</span></center>').fadeOut(5000);
					//window.location.assign('?internal');
				}
			});
		}
	}
</script>