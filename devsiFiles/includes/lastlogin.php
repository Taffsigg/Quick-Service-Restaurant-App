<section class="content-header">
		<h1>
			<span class="fa fa-user"></span> Session Details
				<small>User Panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">LogIn Details</li>
		</ol>
</section>

<section class="content">
	<div class="row">
		<br/><br/>
	</div>
	<div class="row well">
		<table class="table table-bordered table-condensed table-hover" style="background-color: #fff;" id="tableList">
			<thead>
				<tr><th><center>#</center></th><th><center>IP Address</center></th><th><center>Date</center></th></tr>
			</thead>
			<tbody>
				<?php $this->genLastLogin(); ?>
			</tbody>
		</table>
	</div>
</section>

<script type="text/javascript">
	$('#tableList').DataTable({
		responsive: true
	})
</script>
