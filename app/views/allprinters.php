			<div class="container">
				<a href="index.php?addprinter" class="btn btn-success btn-lg"><?php echo $lang['MENU_ADMIN_ADDPRINTER']; ?></a>
				<h3 id="head"><?php echo $lang['ADMIN_PRINTER_LIST_HEADER']; ?></h3>
				<table class="table">
					<thead>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_1']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_2']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_3']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_4']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_5']; ?></th>
						<th class="hidden"><?php echo $lang['ADMIN_PRINTERS_TABLE_6']; ?></th>
						<th class="hidden"><?php echo $lang['ADMIN_PRINTERS_TABLE_7']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_8']; ?></th>
						<th><?php echo $lang['ADMIN_PRINTERS_TABLE_9']; ?></th>
					</thead>
					<tbody>
						<?php $info->getPrintersAdmin(); ?>
					</tbody>
				</table>
				<div class="scroll-up">
					<a href="#menu"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
				</div>
			</div>