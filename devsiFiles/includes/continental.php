<section class="content-header">
    <h1>
        <span class="fa fa-th"></span> Menu
        <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Continental Dishes</li>
    </ol>
</section>


<section class="content">
	<div class="row" style="margin: 15px;"><br/></div>
	<div class="row" style="margin: 15px;">
		<div class="col-md-6">
			<center><a href="#addContinental" data-toggle="modal" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> Add Continental Dish</a></center>
		</div>
		<div class="col-md-6">
			<center><button type="button" class="btn btn-xs btn-danger" onclick="delCategory('continental')"><span class="glyphicon glyphicon-remove"></span> Remove All Continental Dish(es)</button></center>
		</div>
	</div>

	<div class="row" style="margin: 15px;" id="displayRes"></div>

	<?php
		if(isset($_POST['addMenu'])){
			$this->addMenuItem('continental');
		}elseif(isset($_POST['editMenu'])){
			$this->editMenuItem('continental');
		}
	?>
	<!-- loading continental dishes -->
	<div class="row" style="margin: 15px;">
		<br/>
		
		<?php 
			if(isset($_POST['edit'])){
				$this->editContinentalMenuItem();
			}else{
				echo "
					<table class=\"table table-bordered table-condensed table-hover\" id=\"tableList\" style=\"background-color: #fff;\">
				<thead>
				<tr><th><center>#</center></th><th><center>Menu Item</center></th><th><center>Amount(GH&cent;)</center></th><th></th><th></th></tr>
				</thead>
				<tbody>	
					";
				$this->loadContentDishes();
				echo "</tbody>
		</table>";
			}
		?>
	</div>
	<!-- end of continental dishes -->
</section>

<!-- add continental dish -->
<div id="addContinental" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc; color: #fff;">
				<h3 style="text-align: center; font-size: 20px;"><span class="glyphicon glyphicon-th"></span> Continental Dish(es)</h3>
			</div>
			<div class="modal-body">
				<form method="post" action="?continental" class="form">
					<legend></legend>
					<div class="form-group">
						<label for="item">Menu Item:</label>
						<input type="text" name="dish" placeholder="Menu Item" required autofocus class="form-control"/>
					</div>
					<div class="form-group">
						<label for="amount">Amount per plate(GH&cent;):</label>
						<input type="text" name="amount" placeholder="Amount per plate(GH&cent;)" required class="form-control"/>
					</div>
					<div class="form-group">
						<center><button type="submit" name="addMenu" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> Add Menu Item</button></center>
					</div>
				</form>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<!-- end of add continental dish -->

<script type="text/javascript">
	$('#tableList').DataTable({
		responsive: true
	})

	function delCategory(categoryname){
		var x=confirm('Are you sure you want to proceed?');
		if(x){
			$.post('ajax.php',{'delCategory':categoryname},function(data){
				if(data==1){
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Process Complete..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
				}else{
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
				}
			});
		}else{
			$('#displayRes').html('<center><span class=\'alert alert-sm alert-info\' role=\'alert\'>Process cancelled..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
		}
	}

	function delMenuItem(category,id){
		var x = confirm('Are you sure you want to delete this Menu Item?');
		if(x){
			$.post('ajax.php',{'category':category,'id':id},function(data){
				if(data==1){
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-success\' role=\'alert\'>Process Complete..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
				}else{
					$('#displayRes').html('<center><span class=\'alert alert-sm alert-danger\' role=\'alert\'>Process failed..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
				}
			});
		}else{
			$('#displayRes').html('<center><span class=\'alert alert-sm alert-info\' role=\'alert\'>Process cancelled..!!</span></center>').fadeOut(10000);
                                window.location.assign('?continental');
		}
	}
</script>