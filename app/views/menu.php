		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="position: relative;">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><?php echo $lang['BRAND']; ?></a>
				</div>
				<div class="navbar-header pull-left">
					<ul class="nav navbar-nav">
						<?php
							echo '<li '.PrinterSystem::checkMenuActive('branches').'><a href="index.php?branches">'.$lang['MENU_INSTALL_PRINTER'].'</a></li>';
							echo '<li '.PrinterSystem::checkMenuActive('help').'><a href="index.php?help">'.$lang['MENU_HELP'].'</a></li>';
							if(Login::checkSession())
							{
								echo '<li '.PrinterSystem::checkMenuActive('allbranches').'><a href="index.php?allbranches">'.$lang['MENU_ADMIN_BRANCHES'].'</a></li>';
								echo '<li '.PrinterSystem::checkMenuActive('allprinters').'><a href="index.php?allprinters">'.$lang['MENU_ADMIN_PRINTERS'].'</a></li>';
							}
						?>
						<!--
						<li class="active"><a href="index.php?branches"><?php echo $lang['MENU_INSTALL_PRINTER']; ?></a></li>
						<li><a href=""><?php echo $lang['MENU_HELP']; ?></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								About Driven<strong class="caret"></strong>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">The Team</a></li>
								<li><a href="#">Our Partners</a></li>
							</ul>
						</li>-->
					</ul>
				</div>
				<div class="navbar-header pull-right">
					<ul class="nav navbar-nav">
						<?php
							if(Login::checkSession())
							{
								$login = Login::currentLogin();
								echo '<li class="navbar-right dropdown"><a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;">'.$login.'</a><ul class="dropdown-menu"><li><a href="index.php?logout">'.$lang['ADMIN_LOGOUT'].'</a></li><li><a href="index.php?settings">'.$lang['ADMIN_SETTINGS'].'</a></li><li><a href="index.php?accounts">'.$lang['ADMIN_ACCOUNTS'].'</a></li><li><a href="index.php?commands">'.$lang['ADMIN_COMMANDS'].'</a></li></ul></li>';
							}
						?>
						
						<li class="navbar-right"><a href="index.php?lang=rus"><img src="app/views/img/rus.png" style="height:20px;"></a></li>
						<li class="navbar-right"><a href="index.php?lang=az"><img src="app/views/img/az.png" style="height:20px;"></a></li>
					</ul>
				</div>
			</div>
		</nav>