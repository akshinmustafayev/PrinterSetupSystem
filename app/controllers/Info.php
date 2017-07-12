<?php
	class Info
	{
		public function __construct(){
			
		}
		
		public function getBranches()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM branches');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if($row['id'] == '1')
						continue;
					
					if($row['image'] == 'none' || $row['image'] == '')
						echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="index.php?branches&printers='.$row['id'].'"><img class="img-responsive" src="app/views/img/400x300.png" alt=""><div class="caption"><h3>'.$row['branch_name'].'</h3></div></a></div>';
					else
						echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="index.php?branches&printers='.$row['id'].'"><img class="img-responsive" src="uploads/'.$row['image'].'" alt=""><div class="caption"><h3>'.$row['branch_name'].'</h3></div></a></div>';
				}
			} 
		}
		
		public function getPrinters()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM printers WHERE branchid = '.$_GET['printers']);
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if($row['image'] == 'none' || $row['image'] == '')
						echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="index.php?branches&printers='.$_GET['printers'].'&printer='.$row['id'].'"><img class="img-responsive" src="app/views/img/400x300.png" alt=""><div class="caption"><h3>'.$row['name'].'</h3></div></a></div>';
					else
						echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="index.php?branches&printers='.$_GET['printers'].'&printer='.$row['id'].'"><img class="img-responsive" src="uploads/'.$row['image'].'" alt=""><div class="caption"><h3>'.$row['name'].'</h3></div></a></div>';
				}
			} 
		}
		
		public function getPrinter()
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->getLangArray();
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM printers WHERE id = '.$_GET['printer'].'');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<div class="col-sm-4">';
					if($row['image'] == 'none' || $row['image'] == '')
						echo '<img src="app/views/img/400x300.png" class="printer-img">';
					else
						echo '<img src="uploads/'.$row['image'].'" class="printer-img">';
					echo '</div>';
					echo '<div class="col-sm-8">';
					echo '<h2>'.$row['name'].'</h2>';
					echo '<table class="table">';
					echo '<tr><td>'.$lang['PRINTER_DESCRIPTION'].'</td><td>'.$row['description'].'</td></tr>';
					echo '<tr><td>'.$lang['PRINTER_IP'].'</td><td>'.$row['ipaddress'].'</td></tr>';
					echo '</table>';
					if($row['file1'] != '' && $row['file1'] != 'none')
						echo '<a style="color: white;" href="uploads/'.$row['file1'].'"><button type="button" class="btn btn-success btn-lg" style="margin-right:10px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'.$lang['PRINTER_INSTALL1'].'</button></a>';
					if($row['file2'] != '' && $row['file2'] != 'none')
						echo '<a style="color: white;" href="uploads/'.$row['file2'].'"><button type="button" class="btn btn-success btn-lg" style="margin-right:10px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'.$lang['PRINTER_INSTALL2'].'</button></a>';
					if($row['file3'] != '' && $row['file3'] != 'none')
						echo '<a style="color: white;" href="uploads/'.$row['file3'].'"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'.$lang['PRINTER_INSTALL3'].'</button></a>';
					echo '</div>';
				}
			} 
		}
		
		public function getBranchesSelect()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM branches');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
				}
			} 
		}
		
		public function getBranchesSelect2($printer_id)
		{
			$list = '';
			$selected = 1;
			
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM printers WHERE id = "'.$printer_id.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					$selected = $row['branchid'];
				}
			}
			
			$db2 = new Database;
			$result2 = $db2->dbQuery('SELECT * FROM branches');
			if(!is_null($result2))
			{
				while($row = $result2->fetch_assoc())
				{
					if($row['id'] == $selected)
						$list = $list.'<option value="'.$row['id'].'" selected="selected">'.$row['branch_name'].'</option>';
					else
						$list = $list.'<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
				}
			}
			return $list;
		}
		
		public function addBranch($branch_name, $branch_photo)
		{
			$db = new Database;
			$result = $db->dbQuery('insert into branches (branch_name, image) values ("'.$branch_name.'", "'.$branch_photo.'")');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function addAdmin($login, $password)
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM users WHERE login = "'.$login.'"');
			if($result->num_rows != '0')
			{
				return false;
			}
			
			$password = md5(md5($password));
			$db = new Database;
			$result = $db->dbQuery('insert into users (login, password) values ("'.$login.'", "'.$password.'")');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function addPrinter($printer_name, $branch_id, $printer_desc, $printer_ip, $printer_photo, $printer_file1, $printer_file2, $printer_file3)
		{
			$db = new Database;
			$result = $db->dbQuery('insert into printers (name, branchid, description, ipaddress, image, file1, file2, file3) values ("'.$printer_name.'", "'.$branch_id.'", "'.$printer_desc.'", "'.$printer_ip.'", "'.$printer_photo.'", "'.$printer_file1.'", "'.$printer_file2.'", "'.$printer_file3.'")');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function updatePrinter($printer_id, $printer_name, $branch_id, $printer_desc, $printer_ip, $printer_photo, $printer_file1, $printer_file2, $printer_file3)
		{
			$files = '';
			if($printer_photo != '' && $printer_photo != 'none')
				$files = ', image="'.$printer_photo.'"';
			if($printer_file1 != '' && $printer_file1 != 'none')
				$files = $files.', file1="'.$printer_file1.'"';
			if($printer_file2 != '' && $printer_file2 != 'none')
				$files = $files.', file2="'.$printer_file2.'"';
			if($printer_file23 != '' && $printer_file3 != 'none')
				$files = $files.', file3="'.$printer_file3.'"';
			
			$db = new Database;
			$result = $db->dbQuery('UPDATE printers set name="'.$printer_name.'", branchid="'.$branch_id.'", description="'.$printer_desc.'", ipaddress="'.$printer_ip.'"'.$files.' where id = "'.$printer_id.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function updateBranch($branch_id, $branch_name, $branch_photo)
		{
			$files = '';
			if($branch_photo != '' && $branch_photo != 'none')
				$files = ', image="'.$branch_photo.'"';
			$db = new Database;
			$result = $db->dbQuery('UPDATE branches set branch_name="'.$branch_name.'"'.$files.'" where id = "'.$branch_id.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function updateAccount($account_id, $password)
		{
			if($account_id == '1')
				return false;
			
			$password = md5(md5($password));
			$db = new Database;
			$result = $db->dbQuery('UPDATE users set password="'.$password.'" where id = "'.$account_id.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function deletePrinter($printer_id)
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM printers where id="'.$printer_id.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if(file_exists('uploads/'.$row['file1']))
					{
						chown('uploads/'.$row['file1'], 666);
						unlink('uploads/'.$row['file1']);
					}
					
					if(file_exists('uploads/'.$row['file2']))
					{
						chown('uploads/'.$row['file2'], 666);
						unlink('uploads/'.$row['file2']);
					}
				
					if(file_exists('uploads/'.$row['file3']))
					{
						chown('uploads/'.$row['file3'], 666);
						unlink('uploads/'.$row['file3']);
					}
				
					if(file_exists('uploads/'.$row['image']))
					{
						chown('uploads/'.$row['image'], 666);
						unlink('uploads/'.$row['image']);
					}
				}
			}
			
			$db = new Database;
			$result = $db->dbQuery('DELETE FROM printers WHERE id = "'.$printer_id.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function deleteBranch($branch_id)
		{
			$db = new Database;
			$result = $db->dbQuery('DELETE FROM branches WHERE id = "'.$branch_id.'"');
			$db2 = new Database;
			$result2 = $db2->dbQuery('UPDATE printers set branchid="1" WHERE branchid="'.$branch_id.'"');
			if($result && $result2)
			{
				return true;
			}
			else
				return false;
		}
		
		public function deleteAccount($account_id)
		{
			if($account_id == '1')
				return false;
			
			$db = new Database;
			$result = $db->dbQuery('DELETE FROM users WHERE id = "'.$account_id.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public function getPrintersAdmin()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT printers.*, branches.branch_name FROM branches, printers where printers.branchid = branches.id');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<tr><td>'.$row['name'].'</td><td>'.$row['branch_name'].'</td><td>'.$row['description'].'</td><td>'.$row['ipaddress'].'</td><td><a href="uploads/'.$row['file1'].'">'.$row['file1'].'</a></td><td><a href="uploads/'.$row['file2'].'">'.$row['file2'].'</a></td><td><a href="uploads/'.$row['file3'].'">'.$row['file3'].'</a></td><td><a href="index.php?allprinters&deleteprinter='.$row['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer;color:#ce4844;"></span></a></td><td><a href="index.php?editprinter='.$row['id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="cursor:pointer;color:#5bc0de;"></span></a></td></tr>';
				}
			}
		}
		
		public function getBranchesAdmin()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM branches');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if($row['id'] == "1")
						continue;
					echo '<tr><td>'.$row['branch_name'].'</td><td><a href="index.php?allbranches&deletebranch='.$row['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer;color:#ce4844;"></span></a></td><td><a href="index.php?editbranch='.$row['id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="cursor:pointer;color:#5bc0de;"></span></a></td></tr>';
				}
			}
		}
		
		public function getAccountsAdmin()
		{
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM users');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<tr><td>'.$row['login'].'</td><td>'.$row['logindate'].'</td><td><a href="index.php?accounts&deleteaccount='.$row['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer;color:#ce4844;"></span></a></td><td><a href="index.php?editaccount='.$row['id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="cursor:pointer;color:#5bc0de;"></span></a></td></tr>';
				}
			}
		}
		public function editAccountAdmin($account_id)
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->getLangArray();
			
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM users WHERE id="'.$account_id.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<input name="editaccountid" type="text" class="form-control" placeholder="" required="" autofocus="" value="'.$row['id'].'" style="display:none;">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_EDITADMIN_PASSWORD'].'</h4>';
					echo '<input name="editaccountpassword" type="password" class="form-control" placeholder="'.$lang['ADMIN_EDITADMIN_PASSWORD_PLACEHOLDER'].'" required="" autofocus="">';
					
					echo '<br>';
					
					echo '<button class="btn btn-lg btn-primary btn-block" type="submit">'.$lang['ADMIN_EDITADMIN_CHANGE'].'</button>';
				}
			}
		}
		
		public function editPrinterAdmin($printer_id)
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->getLangArray();
			$branches = Info::getBranchesSelect2($printer_id);
			
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM printers WHERE id="'.$printer_id.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<input name="editprinterid" type="text" class="form-control" placeholder="" required="" autofocus="" value="'.$row['id'].'" style="display:none;">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_PRINTER_NAME'].'</h4>';
					echo '<input name="editprintername" type="text" class="form-control" placeholder="'.$lang['ADMIN_PRINTER_NAME_PLACEHOLDER'].'" required="" autofocus="" value="'.$row['name'].'">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_PRINTER_DESC'].'</h4>';
					echo '<input name="editprinterdesc" type="text" class="form-control" placeholder="'.$lang['ADMIN_PRINTER_DESC_PLACEHOLDER'].'" required="" autofocus="" value="'.$row['description'].'">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_PRINTER_IP'].'</h4>';
					echo '<input name="editprinterip" type="text" class="form-control" placeholder="'.$lang['ADMIN_PRINTER_DESC_PLACEHOLDER'].'" required="" autofocus="" value="'.$row['ipaddress'].'">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_PRINTER_BRANCH'].'</h4>';
					echo '<select name="editprinterbranch" class="form-control">'.$branches.'</select>';
					
					echo '<br>';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_PRINTER_IMAGE'].'</h4>';
					echo '<input name="photo" type="file"/>';
					
					echo '<br>';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_ADDBRANCH_FILE1'].'</h4>';
					echo '<input name="file1" type="file"/>';
					
					echo '<br>';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_ADDBRANCH_FILE2'].'</h4>';
					echo '<input name="file2" type="file"/>';
					
					echo '<br>';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_ADDBRANCH_FILE3'].'</h4>';
					echo '<input name="file3" type="file"/>';
					
					echo '<br>';
					echo '<br>';
					
					echo '<button class="btn btn-lg btn-primary btn-block" type="submit">'.$lang['ADMIN_PRINTER_CHANGE'].'</button>';
				}
			}
		}
		
		public function editBranchAdmin($branch_id)
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->getLangArray();
			
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM branches WHERE id="'.$branch_id.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					echo '<input name="editbranchid" type="text" class="form-control" placeholder="" required="" autofocus="" value="'.$row['id'].'" style="display:none;">';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_ADDBRANCH_NAME'].'</h4>';
					echo '<input name="editbranchname" type="text" class="form-control" placeholder="'.$lang['ADMIN_ADDBRANCH_NAME_PLACEHOLDER'].'" required="" autofocus="" value="'.$row['branch_name'].'">';
					
					echo '<br>';
					
					echo '<h4 class="form-signin-heading">'.$lang['ADMIN_ADDBRANCH_IMAGE'].'</h4>';
					echo '<input name="photo" type="file"/>';
					
					echo '<br>';
					echo '<br>';
					
					echo '<button class="btn btn-lg btn-primary btn-block" type="submit">'.$lang['ADMIN_PRINTER_CHANGE'].'</button>';
				}
			} 
		}
		
		public function uploadFile($inputName, $fileExtension, $new_file_name)
		{
			if($_FILES[$inputName]['name'])
			{
				if(!$_FILES[$inputName]['error'])
				{
					if($_FILES[$inputName]['size'] > (1024000))
					{
						return false;
					}
					move_uploaded_file($_FILES[$inputName]['tmp_name'], 'uploads/'.$new_file_name.'.'.$fileExtension);
					return true;
				}
				else
				{
					return false;
				}
			}
			else
				return false;
		}
		
		public function generateToken()
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 11; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return md5($randomString);
		}
	}
?>