<?php
	class PrinterSystem
	{
		public function checkMenuActive($get)
		{
			if(isset($_GET[$get]))
				return 'class="active"';
			else
				return '';
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