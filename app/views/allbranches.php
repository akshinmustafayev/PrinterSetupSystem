			<div class="container">
				<a href="index.php?addbranch"><button type="button" class="btn btn-success btn-lg"><?php echo $lang['MENU_ADMIN_ADDBRANCH']; ?></button></a>
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
			</div>