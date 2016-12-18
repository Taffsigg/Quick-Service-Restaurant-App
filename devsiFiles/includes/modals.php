<?php 
	$dp=$devsi->getDp($_SESSION['siadmin']);
	$profDetails=$devsi->getFullDetails($_SESSION['siadmin'],'logindetails');
?>
<!--change password-->
<div id="chngpwd" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header devsibg">
				<h3 class="panel-title"><center><span class="glyphicon glyphicon-lock"></span> Change Password</center></h3>
			</div>
			<div class="modal-body">
				<!--adding chngpwd form -->
				<form method="post" action="?dashboard" class="form">
					<div class="form-group has-feedback">
		                <input type="password" name="oldpassword" class="form-control" placeholder="Old Password" autofocus required>
		                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		            </div>
		            <div class="form-group has-feedback">
		                <input type="password" name="newpassword" class="form-control" placeholder="New Password" required>
		                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		            </div>
		            <div class="form-group has-feedback">
		                <input type="password" name="newpassword1" class="form-control" placeholder="Confirm New Password" required>
		                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		            </div>
		            <div class="form-group">
		            	<center><button type="submit" name="updatePass" class="btn btn-xs btn-success"><span class="glyphcon glyphicon-pencil"></span> Update Password</button></center>
		            </div>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div><!--end of change password-->

<!--change dp-->
<div id="chngdp" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header devsibg">
				<h3 class="panel-title"><center><span class="glyphicon glyphicon-picture"></span> Change Profile Picture</center></h3>
			</div>
			<div class="modal-body">
				<form method="post" action="?dashboard" enctype="multipart/form-data" class="form">
					<div class="form-group">
						<input type="file" name="dp" accept="image/*" onchange="showMyImage(this,'displayPic')" class="form-control" required/>
					</div>
					<div class="form-group">
						<center><img src="banners/<?php echo $dp[0]; ?>" id="displayPic" style="width: 150px; height: 150px;" /></center>
					</div>
					<div class="form-group">
						<center><button type="submit" class="btn btn-xs btn-success" name="updateDp"><span class="glyphicon glyphicon-upload"></span>  Upload Image</button></center>
					</div>
				</form>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div><!--end of change dp -->

<!--edit details-->
<div id="editDetails" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header devsibg">
				<h3 class="panel-title"><center><span class="glyphicon glyphicon-pencil"></span> Update Profile Details</center></h3>
			</div>
			<div class="modal-body">
				<form method="post" action="?dashboard" class="form">
					<div class="form-group">
						<label for="username">User Name:</label>
						<input type="text"  name="username" class="form-control" id="username" placeholder="User Name" value="<?php echo $profDetails[1]; ?>" required autofocus/>
						<input type="hidden" name="oldusername" value="<?php echo $_SESSION['siadmin']; ?>"/>
					</div>
					<div class="form-group">
						<label for="nickname">NickName:</label>
						<input type="text" value="<?php echo $profDetails[2]; ?>"  name="nickname" class="form-control" id="nickname" placeholder="Nick Name" required/>
					</div>
					<div class="form-group">
						<label for="fullname">Full Name:</label>
						<input type="text" value="<?php echo $profDetails[3]; ?>"  name="fullname" class="form-control" id="fullname" placeholder="Full Name" required/>
					</div>
					<div class="form-group">
						<label for="email">Email Address:</label>
						<input type="email" value="<?php echo $profDetails[4]; ?>" name="email" class="form-control" id="email" placeholder="Email Address" required/>
					</div>
					<div class="form-group">
						<label for="mobileNo1">Mobile Number:</label>
						<input type="text" value="<?php echo $profDetails[5]; ?>" name="mobileNo1" class="form-control" id="mobileNo1" placeholder="Mobile Number" maxlength="10" required/>
					</div>
					<div class="form-group">
						<label for="mobileNo2">Mobile Number:</label>
						<input type="text" value="<?php echo $profDetails[6]; ?>" maxlength="10" name="mobileNo2" class="form-control" id="mobileNo2" placeholder="Mobile Number"/>
					</div>
					<div class="form-group">
						<center><button type="submit" class="btn btn-xs btn-success" name="updateProf"><span class="glyphicon glyphicon-pencil"></span> Update Details</button></center>
					</div>
				</form>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div><!--end of edit details -->
