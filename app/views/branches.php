		<div class="container">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $lang['BRANCHES_HEADER']; ?></h1>
			</div>
			<div class="row" style="display:flex;flex-wrap:wrap;width:100%;">
				<?php
					$info->getBranches();
				?>
			</div>
		</div>