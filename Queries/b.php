<html>
    <meta charset="UTF-8">
	<body>
<?php

	$tipo = $_REQUEST['tipo'];

	try
	{

		$host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
		$dbname = $user;
		$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		if ($tipo == 1) {
			
			
		}


		elseif ($tipo == 2) {


			
		}


		elseif ($tipo == 3) {
			
		}


		elseif ($tipo == 4) {
			
		}


		elseif ($tipo == 5) {
			
		}

		else {
			
		}


		$db = null;
	}

	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");

		echo("<p></p>");

		if(isset($_REQUEST)){
            var_dump($_REQUEST);
        }

	}

?>
	<br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
</body>
</html>