<?php
	require('app/configs/configs.php');

	class Controller
	{
		function __construct($get, $post)
		{
			if (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 8 && BLOCK_IE == true) 
			{
				$views = new Views;
				$views->addView('ie', 'ie.php');
				exit();
			}
			
			if(isset($post['login']) && isset($post['password']))
			{
				if(Login::logIn($post['login'], $post['password']))
				{
					header("Location: index.php");
				}
				else
				{
					if(USE_ADMIN_KEY)
						header("Location: index.php?admin=".ADMIN_KEY."&error");
					else
						header("Location: index.php?admin=&error");
				}
			}
			else if(isset($post['newpass']) && isset($post['newpassagain']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('settings', 'settings.php');
					if(Login::updatePass($post['newpass'], $post['newpassagain']))
					{
						$views->addView('settings_success_change_pass', 'settings_success_change_pass.php');
					}
					else
					{
						$views->addView('settings_error_change_pass', 'settings_error_change_pass.php');
					}
					$views->addView('footer', 'footer.php');
				}
			}
			else if(isset($post['branchname']) && ($_FILES['photo']['name'] == true || $_FILES['photo']['name'] == false))
			{
				if(Login::checkSession())
				{
					$image = '';
					$image_name = PrinterSystem::generateToken();
					if(Info::uploadFile('photo', 'png', $image_name))
					{
						$image = $image_name.'.png';
					}
					else
					{
						$image = 'none';
					}
					Info::addBranch($post['branchname'], $image);
				}
				header("Location: index.php?allbranches");
			}
			else if(isset($post['adminlogin']) && isset($post['adminpass']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					if(Info::addAdmin($post['adminlogin'], $post['adminpass']))
					{
						$views->addView('addadmin_success', 'addadmin_success.php');
					}
					else
					{
						$views->addView('addadmin_error', 'addadmin_error.php');
					}
					$views->addView('accounts', 'accounts.php');
					$views->addView('footer', 'footer.php');
				}
			}
			else if(isset($post['editaccountid']) && isset($post['editaccountpassword']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					if(Info::updateAccount($post['editaccountid'], $post['editaccountpassword']))
					{
						$views->addView('editaccount_success', 'editaccount_success.php');
					}
					else
					{
						$views->addView('editaccount_error', 'editaccount_error.php');
					}
					$views->addView('accounts', 'accounts.php');
					$views->addView('footer', 'footer.php');
				}
			}
			else if(isset($post['editbranchid']) && isset($post['priority']) && isset($post['editbranchname']) && ($_FILES['photo']['name'] == true || $_FILES['photo']['name'] == false))
			{
				if(Login::checkSession())
				{
					$image = '';
					$image_name = PrinterSystem::generateToken();
					if(Info::uploadFile('photo', 'png', $image_name))
					{
						$image = $image_name.'.png';
					}
					else
					{
						$image = 'none';
					}
					Info::updateBranch($post['editbranchid'], $post['priority'], $post['editbranchname'], $image);
				}
				header("Location: index.php?allbranches");
			}
			else if(isset($post['printername']) && isset($post['printerdesc']) && isset($post['printerip']) && isset($post['printerbranch']) && ($_FILES['photo']['name'] == true || $_FILES['photo']['name'] == false) && ($_FILES['file1']['name'] == true || $_FILES['file1']['name'] == false) && ($_FILES['file2']['name'] == true || $_FILES['file2']['name'] == false) && ($_FILES['file3']['name'] == true || $_FILES['file3']['name'] == false))
			{
				if(Login::checkSession() && $post['printerbranch'] != '' && $post['printerbranch'] != '0')
				{
					$image = '';
					$image_name = PrinterSystem::generateToken();
					if(Info::uploadFile('photo', 'png', $image_name))
					{
						$image = $image_name.'.png';
					}
					else
					{
						$image = 'none';
					}
					
					$file1 = '';
					$file1_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file1', 'bat', $file1_name))
					{
						$file1 = $file1_name.'.bat';
					}
					else
					{
						$file1 = 'none';
					}
					
					$file2 = '';
					$file2_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file2', 'bat', $file2_name))
					{
						$file2 = $file2_name.'.bat';
					}
					else
					{
						$file2 = 'none';
					}
					
					$file3 = '';
					$file3_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file3', 'bat', $file3_name))
					{
						$file3 = $file3_name.'.bat';
					}
					else
					{
						$file3 = 'none';
					}
					Info::addPrinter($post['printername'], $post['printerbranch'], $post['printerdesc'], $post['printerip'] , $image, $file1, $file2, $file3);
				}
				header("Location: index.php?allprinters");
			}
			else if(isset($post['editprinterid']) && isset($post['editprintername']) && isset($post['editprinterdesc']) && isset($post['editprinterip']) && isset($post['editprinterbranch']) && ($_FILES['photo']['name'] == true || $_FILES['photo']['name'] == false))
			{
				if(Login::checkSession() && $post['editprinterbranch'] != '' && $post['editprinterbranch'] != '0')
				{
					$image = '';
					$image_name = PrinterSystem::generateToken();
					if(Info::uploadFile('photo', 'png', $image_name))
					{
						$image = $image_name.'.png';
					}
					else
					{
						$image = 'none';
					}
					
					$file1 = '';
					$file1_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file1', 'bat', $file1_name))
					{
						$file1 = $file1_name.'.bat';
					}
					else
					{
						$file1 = 'none';
					}
					
					$file2 = '';
					$file2_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file2', 'bat', $file2_name))
					{
						$file2 = $file2_name.'.bat';
					}
					else
					{
						$file2 = 'none';
					}
					
					$file3 = '';
					$file3_name = PrinterSystem::generateToken();
					if(Info::uploadFile('file3', 'bat', $file3_name))
					{
						$file3 = $file3_name.'.bat';
					}
					else
					{
						$file3 = 'none';
					}
					Info::updatePrinter($post['editprinterid'], $post['editprintername'], $post['editprinterbranch'], $post['editprinterdesc'] , $post['editprinterip'], $image, $file1, $file2, $file3);	
				}
				header("Location: index.php?allprinters");
			}
			else if(isset($get['lang']))
			{
				setcookie('cookie_lang', $get['lang'], time()+60*60*24*7);
				header("Location: index.php");
			}
			else if(isset($get['logout']))
			{
				Login::logOut();
			}
			else if(isset($get['admin']) && ((USE_ADMIN_KEY == true && $get['admin'] == ADMIN_KEY) || USE_ADMIN_KEY == false))
			{
				if(Login::checkSession())
					header("Location: index.php");
				$views = new Views;
				$views->addView('header', 'header.php');
				$views->addView('menu', 'menu.php');
				$views->addView('login', 'login.php');
				if(isset($get['error']))
					$views->addView('login_error', 'login_error.php');
				$views->addView('footer', 'footer.php');
			}
			else if(isset($get['addbranch']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('addbranch', 'addbranch.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['commands']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('commands', 'commands.php');
					if(isset($get['startservice']))
					{
						echo '<br><br>';
						echo '<div class="container"><h4 class="form-signin-heading">Output</h4><div class="well">';
						echo Info::executeFile('C:\xampp\htdocs\app\commands\StartSpooler.bat');
						echo '</div></div>';
					}
					if(isset($get['stopservice']))
					{
						echo '<br><br>';
						echo '<div class="container"><h4 class="form-signin-heading">Output</h4><div class="well">';
						echo Info::executeFile('C:\xampp\htdocs\app\commands\StopSpooler.bat');
						echo '</div></div>';
					}
					if(isset($get['restartservice']))
					{
						echo '<br><br>';
						echo '<div class="container"><h4 class="form-signin-heading">Output</h4><div class="well">';
						echo Info::executeFile('C:\xampp\htdocs\app\commands\RestartSpooler.bat');
						echo '</div></div>';
					}
					if(isset($get['removealljobs']))
					{
						echo '<br><br>';
						echo '<div class="container"><h4 class="form-signin-heading">Output</h4><div class="well">';
						echo Info::executeFile('C:\xampp\htdocs\app\commands\RemoveAllJobs.bat');
						echo '</div></div>';
					}
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['addprinter']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('addprinter', 'addprinter.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['addadmin']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('addadmin', 'addadmin.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['allprinters']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					if(isset($get['deleteprinter']))
					{
						Info::deletePrinter($get['deleteprinter']);
						$views->addView('allprinters_delete', 'allprinters_delete.php');
					}
					$views->addView('allprinters', 'allprinters.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['allbranches']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					if(isset($get['deletebranch']))
					{
						if(Info::deleteBranch($get['deletebranch']))
						{
							$views->addView('allbranches_delete_success', 'allbranches_delete_success.php');
						}
						else
							$views->addView('allbranches_delete_error', 'allbranches_delete_error.php');
					}
					$views->addView('allbranches', 'allbranches.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['editprinter']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('editprinter', 'editprinter.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['editbranch']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('editbranch', 'editbranch.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['editaccount']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('editaccount', 'editaccount.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['settings']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('settings', 'settings.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else if(isset($get['accounts']))
			{
				if(Login::checkSession())
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					if(isset($get['deleteaccount']))
					{
						if(Info::deleteAccount($get['deleteaccount']))
						{
							$views->addView('accounts_delete_success', 'accounts_delete_success.php');
						}
						else
							$views->addView('accounts_delete_error', 'accounts_delete_error.php');
					}
					$views->addView('accounts', 'accounts.php');
					$views->addView('footer', 'footer.php');
				}
				else
					header("Location: index.php");
			}
			else
			{
				if(isset($get['branches']))
				{
					if(isset($get['branches']) && isset($get['printers']))
					{
						if(isset($get['branches']) && isset($get['printers']) && isset($get['printer']))
						{
							$views = new Views;
							$views->addView('header', 'header.php');
							$views->addView('menu', 'menu.php');
							$views->addView('printer_breadcrumb', 'printer_breadcrumb.php');
							$views->addView('printer', 'printer.php');
							$views->addView('footer', 'footer.php');
						}
						else
						{
							$views = new Views;
							$views->addView('header', 'header.php');
							$views->addView('menu', 'menu.php');
							$views->addView('printers_breadcrumb', 'printers_breadcrumb.php');
							$views->addView('printers', 'printers.php', $get['printers']);
							$views->addView('footer', 'footer.php');
						}
					}
					else
					{
						$views = new Views;
						$views->addView('header', 'header.php');
						$views->addView('menu', 'menu.php');
						$views->addView('branches_breadcrumb', 'branches_breadcrumb.php');
						$views->addView('branches', 'branches.php');
						$views->addView('footer', 'footer.php');
					}
				}
				else if(isset($get['help']))
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('help', 'help.php');
					$views->addView('footer', 'footer.php');
				}
				else
				{
					$views = new Views;
					$views->addView('header', 'header.php');
					$views->addView('menu', 'menu.php');
					$views->addView('dashboard', 'dashboard.php');
					$views->addView('footer', 'footer.php');
				}
			}
			
				
			/*if(empty($get))
			{
				header('Location: index.php?action=login');
			}
			else
			{
				switch($get["action"])
				{
					case 'login':
					{
						$views = new Views;
						$views->addView('login', 'login.php');
						
						break;
					}
				}
			}*/
		}
	}
?>