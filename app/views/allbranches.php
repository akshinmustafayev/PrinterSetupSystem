			<div class="container">
				<a href="index.php?addbranch" class="btn btn-success btn-lg"><?php echo $lang['MENU_ADMIN_ADDBRANCH']; ?></a>
				<h3><?php echo $lang['ADMIN_BRANCH_LIST_HEADER']; ?></h3>
				<table class="table">
					<thead>
						<th><?php echo $lang['ADMIN_BRANCHES_TABLE_1']; ?></th>
						<th><?php echo $lang['ADMIN_BRANCHES_TABLE_2']; ?></th>
						<th><?php echo $lang['ADMIN_BRANCHES_TABLE_3']; ?></th>
					</thead>
					<tbody>
						<?php $info->getBranchesAdmin(); ?>
					</tbody>
				</table>
				<div class="scroll-up">
					<a href="#menu"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
				</div>
			</div>