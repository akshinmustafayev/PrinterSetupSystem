		<div class="container">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $lang['PRINTERS_HEADER']; ?></h1>
			</div>
			<div class="row" style="display: flex;flex-wrap: wrap;width:100%;">
				<?php 
					$info->getPrinters()
				?>
			</div>
			<div class="scroll-up">
				<a href="#menu"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
			</div>
		</div>