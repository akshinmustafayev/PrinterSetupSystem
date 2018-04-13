<?php
	class Views
	{
		private $ViewsList;
		
		public function addView($view_name, $view_piece, $error = false)
		{
			$language = New Lang();
			$lang = array();
			$lang = $language->getLangArray();
			$info = New Info();
			
			$this->ViewsList[$view_name] = array(
				'piece' => $view_piece,
			);
			if($error)
				$error = true;
			include('app/views/'.$view_piece);
		}
	}
?>