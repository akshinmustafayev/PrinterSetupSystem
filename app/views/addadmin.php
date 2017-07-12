			<div class="container">
				<form action="index.php" class="form-signin" method="POST" enctype="multipart/form-data">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDADMIN_LOGIN']; ?></h4>
					<input name="adminlogin" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_ADDADMIN_LOGIN_PLACEHOLDER']; ?>" required="" autofocus="">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDADMIN_PASSWORD']; ?></h4>
					<input name="adminpass" type="password" class="form-control" placeholder="<?php echo $lang['ADMIN_ADDADMIN_PASSWORD_PLACEHOLDER']; ?>" required="" autofocus="">
					<br>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang['ADMIN_ADDADMIN_BUTTON']; ?></button>
			  </form>
			</div>