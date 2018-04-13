<?php
	class Login
	{
		function __construct()
		{
			
		}
		
		public static function logIn($Login, $Password)
		{
			$Password = md5(md5($Password));
			$db = new Database;
			$result = $db->dbQuery('SELECT id, login, password, token FROM users WHERE login = "'.$Login.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if($row['password'] != $Password)
						return false;
					else
					{
						$Token = Login::generateToken();
						Login::updateToken($Login, $Token);
						Login::updateLoginTime($Login);
						$_SESSION['prn_user_id'] = $row['id'];
						$_SESSION['prn_user_login'] = $row['login'];
						$_SESSION['prn_user_token'] = $Token;
						setcookie('cookie_prn_id', $_SESSION['prn_user_id'], time()+60*60*24*7);
						setcookie('cookie_prn_login', $_SESSION['prn_user_login'], time()+60*60*24*7);
						setcookie('cookie_prn_token', $_SESSION['prn_user_token'], time()+60*60*24*7);
						return true;
					}
				}
			}
			else
				return false;
		}
		
		public static function checkSession()
		{
			$Login = '';
			if(!isset($_SESSION["prn_user_id"]) || !isset($_SESSION["prn_user_login"]) || !isset($_SESSION["prn_user_token"]))
				return false;
			
			if(!isset($_COOKIE["cookie_prn_login"]) || !isset($_COOKIE["cookie_prn_id"]) || !isset($_COOKIE["cookie_prn_token"]))
				return false;
			else
				$Login = $_COOKIE["cookie_prn_login"];
			
			$db = new Database;
			$result = $db->dbQuery('SELECT id, login, token FROM users WHERE login = "'.$Login.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					if($row['id'] != $_COOKIE["cookie_prn_id"] || $row['id'] != $_SESSION['prn_user_id'])
						return false;
					else if($row['login'] != $_COOKIE["cookie_prn_login"] || $row['login'] != $_SESSION['prn_user_login'])
						return false;
					else if($row['token'] != $_COOKIE["cookie_prn_token"] || $row['token'] != $_SESSION['prn_user_token'])
						return false;
					else
						return true;
				}
			}
			else
				return false;
		}
		
		public static function logOut()
		{
			session_destroy();
			session_unset();
			session_regenerate_id();
			setcookie('cookie_prn_id', "");
			setcookie('cookie_prn_login', "");
			setcookie('cookie_prn_token', "");
			unset($_COOKIE['cookie_prn_id']);
			unset($_COOKIE['cookie_prn_login']);
			unset($_COOKIE['cookie_prn_token']);
			header("Location: index.php");
		}
		
		public static function updateLang($Lang)
		{
			$Login = Login::currentLogin();
			$db = new Database;
			$db->dbQuery('UPDATE users set lang = "'.$Lang.'" where login = "'.$Login.'"');
		}
		
		public static function updatePass($NewPassword, $NewPasswordAgain)
		{
			if($NewPassword != $NewPasswordAgain)
				return false;
			
			$Login = Login::currentLogin();
			$pass = md5(md5($NewPassword));
			$db = new Database;
			$result = $db->dbQuery('UPDATE users set password = "'.$pass.'" where login = "'.$Login.'"');
			if($result)
			{
				return true;
			}
			else
				return false;
		}
		
		public static function getLang()
		{
			$Login = Login::currentLogin();
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM users where login = "'.$Login.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					return $row['lang'];
				}
			}
		}
		
		public static function getPass()
		{
			$Login = Login::currentLogin();
			$db = new Database;
			$result = $db->dbQuery('SELECT * FROM users where login = "'.$Login.'"');
			if(!is_null($result))
			{
				while($row = $result->fetch_assoc())
				{
					return $row['password'];
				}
			}
		}
		
		public static function currentLogin()
		{
			if(isset($_COOKIE['cookie_prn_login']))
				return $_COOKIE['cookie_prn_login'];
		}
		
		public static function printCurrentLogin()
		{
			echo $_COOKIE['cookie_prn_login'];
		}
		
		private function updateToken($Login, $Token)
		{
			$db = new Database;
			$db->dbQuery('UPDATE users set token = "'.$Token.'" where login = "'.$Login.'"');
		}
		
		private function generateToken()
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 11; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return md5($randomString);
		}
		
		private function updateLoginTime($Login)
		{
			date_default_timezone_set("Asia/Baku");
			$Time = (new DateTime())->format('Y-m-d H:i:s');
			$db = new Database;
			$db->dbQuery('UPDATE users set logindate = "'.$Time.'" where login = "'.$Login.'"');
		}
	}
?>