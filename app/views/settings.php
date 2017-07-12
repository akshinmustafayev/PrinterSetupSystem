			<div class="container">
				<h3 class="form-signin-heading"><?php echo $lang['ADMIN_SETTINGS_CHANGEPASS_HEADER']; ?></h3>
				<form action="index.php" class="form-signin" method="POST">
					<h5 class="form-signin-heading"><?php echo $lang['ADMIN_SETTINGS_CHANGEPASS']; ?></h5>
					<input name="newpass" type="password" class="form-control" required="" autofocus="">
					<h5 class="form-signin-heading"><?php echo $lang['ADMIN_SETTINGS_CHANGEPASS2']; ?></h5>
					<input name="newpassagain" type="password" class="form-control" required="" autofocus="">
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang['ADMIN_SETTINGS_CHANGEPASS_APPLY']; ?></button>
				</form>
			</div>