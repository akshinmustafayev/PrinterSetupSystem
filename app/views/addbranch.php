			<div class="container">
				<form action="index.php" class="form-signin" method="POST" enctype="multipart/form-data">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDBRANCH_NAME']; ?></h4>
					<input name="branchname" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_ADDBRANCH_NAME_PLACEHOLDER']; ?>" required="" autofocus="">
					<br>
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDBRANCH_IMAGE']; ?></h4>
					<input name="photo" type="file"/>
					<br>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang['ADMIN_ADDBRANCH_BUTTON']; ?></button>
			  </form>
			</div>