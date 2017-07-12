<?php
	class Lang
	{
		private $UserLng;
		public $lang = array();
		
		public function __construct(){
			$userLang = '';
			if(!isset($_COOKIE["cookie_lang"]))
			{
				setcookie('cookie_lang', 'az', time()+60*60*24*7);
				$userLang = 'az';
			}
			else
				$userLang = $_COOKIE["cookie_lang"];
			$this->UserLng = $userLang;
		}
		
		public function getLangArray()
		{
			$loadFile = 'app/locale/'.$this->UserLng.'.ini';
			if(!file_exists($loadFile)){
				$loadFile = 'app/locale/eng.ini';
			}
			$this->lang = parse_ini_file($loadFile);
			return $this->lang;
		}
	}
?>