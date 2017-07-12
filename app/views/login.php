			<div class="container">
				<form class="form-signin" method="POST">
					<h2 class="form-signin-heading"><?php echo $lang['ADMIN_LOGIN_HEADER']; ?></h2>
					<input name="login" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_LOGIN_LOGIN_PLACEHOLDER']; ?>" required="" autofocus="" style="border-radius: 4px 4px 0 0;">
					<input name="password" type="password" class="form-control" placeholder="<?php echo $lang['ADMIN_LOGIN_PASS_PLACEHOLDER']; ?>" required="" style="border-radius: 0 0 4px 4px;">
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang['ADMIN_LOGIN_BUT']; ?></button>
			  </form>
			</div>