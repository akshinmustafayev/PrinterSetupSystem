			<div class="container">
				<form action="index.php" class="form-signin" method="POST" enctype="multipart/form-data">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_PRINTER_NAME']; ?></h4>
					<input name="printername" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_PRINTER_NAME_PLACEHOLDER']; ?>" required="" autofocus="">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_PRINTER_DESC']; ?></h4>
					<input name="printerdesc" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_PRINTER_DESC_PLACEHOLDER']; ?>" required="" autofocus="">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_PRINTER_IP']; ?></h4>
					<input name="printerip" type="text" class="form-control" placeholder="<?php echo $lang['ADMIN_PRINTER_IP_PLACEHOLDER']; ?>" required="" autofocus="">
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_PRINTER_BRANCH']; ?></h4>
					<select name="printerbranch" class="form-control">
						<?php $info->getBranchesSelect(); ?>
					</select>
					<br>
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_PRINTER_IMAGE']; ?></h4>
					<input name="photo" type="file"/>
					<br>
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDBRANCH_FILE1']; ?></h4>
					<input name="file1" type="file"/>
					<br>
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDBRANCH_FILE2']; ?></h4>
					<input name="file2" type="file"/>
					<br>
					<h4 class="form-signin-heading"><?php echo $lang['ADMIN_ADDBRANCH_FILE3']; ?></h4>
					<input name="file3" type="file"/>
					<br>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang['ADMIN_PRINTER_BUTTON']; ?></button>
			  </form>
			</div>