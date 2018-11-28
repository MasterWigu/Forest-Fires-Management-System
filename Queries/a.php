<html>
    <meta charset="UTF-8">
	<body>
<?php

	$opcao = $_REQUEST['opcao'];
	$moradalocal = $_REQUEST['moradalocal'];
	$nomeentidade = $_REQUEST['nomeentidade'];

	try
	{

		$host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
		$dbname = $user;

		$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		if ($opcao == 1) {
		
			$sql = "INSERT INTO localidade VALUES (:moradalocal)";

			$result = $db->prepare($sql);

			$result->execute([':moradalocal' => $moradalocal]);

			echo("Morada adicionada");
		}

		elseif ($opcao == 9) {

			$sql = "INSERT INTO entidademeio VALUES (:nomeentidade)";

			$result = $db->prepare($sql);

			$result->execute([':nomeentidade' => $nomeentidade]);

			echo("Entidade adicionada");
		}

		else {

		}

		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}

?>
</body>
</html>