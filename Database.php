<?php
	require('app/configs/database.php');
	
	class Database
	{
		private static $instance;
		private $mysqli;
		
		function __construct()
		{
			$this->mysqli = mysqli_connect( 
            HOST,			/* Хост, к которому мы подключаемся */ 
            USER,			/* Имя пользователя */ 
            PASSWORD,		/* Используемый пароль */ 
            DATABASE);		/* База данных для запросов по умолчанию */ 
			
			if(!$this->mysqli)
			{
				printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
				exit; 
			}
			mysqli_query($this->mysqli,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		}
		
		public function dbQuery($query)
		{
			$result;
			if($result = $this->mysqli->query($query))
			{
				return $result;
			}
			else
				return;
			
			$result->close();
			$this->mysqli->close(); 
		}
	}
	
	/* Пример работы с классом Database
	
	$db = new Database;
	$result = $db->dbQuery('SELECT name, surname, city FROM test WHERE id = 0');
	if(!is_null($result))
	{
		while($row = $result->fetch_assoc())
		{
			printf("Name: %s . Surname: %s . City: %s <br>", $row['name'], $row['surname'], $row['city']); 
		}
	}
	*/
?>
