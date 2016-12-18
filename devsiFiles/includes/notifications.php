<section class="content-header">
		<h1>
			<span class="fa fa-bell"></span> Notifications
				<small>View Panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Logs</li>
		</ol>
</section>


<section class="content">
	<div class="row" style="margin: 15px;">
		<br/><br/>
	</div>
	<div class="row" style="margin: 0px;">
		<table class="table table-bordered table-condensed table-hover" class="table" id="tableList" style="background-color: #fff;">
			<thead>
				<tr><th><center>#</center></th><th><center>Message</center></th><th><center>Date</center></th></tr>
			</thead>
			<tbody>
				<?php $this->genNotificationList(); ?>
			</tbody>
		</table>
	</div>
</section>

<script type="text/javascript">
	$('#tableList').DataTable({
		responsive: true
	})
</script>