			<div class="container">
				<a href="index.php?addadmin" class="btn btn-success btn-lg"><?php echo $lang['ADMIN_ADD_ACCOUNT']; ?></a>
				<h3><?php echo $lang['ADMIN_ACCOUNTS_HEADER']; ?></h3>
				<table class="table">
					<thead>
						<th><?php echo $lang['ADMIN_ACCOUNTS_TABLE_1']; ?></th>
						<th><?php echo $lang['ADMIN_ACCOUNTS_TABLE_2']; ?></th>
						<th><?php echo $lang['ADMIN_ACCOUNTS_TABLE_3']; ?></th>
						<th><?php echo $lang['ADMIN_ACCOUNTS_TABLE_4']; ?></th>
					</thead>
					<?php $info->getAccountsAdmin(); ?>
				</table>
			</div>