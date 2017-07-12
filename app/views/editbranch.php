			<div class="container">
				<form action="index.php" class="form-signin" method="POST" enctype="multipart/form-data">
					<?php
						Info::editBranchAdmin($_GET['editbranch']);
					?>
			  </form>
			</div>