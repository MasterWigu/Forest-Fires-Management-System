<html>
    <meta charset="UTF-8">
	<body>
<?php
	try
	{
		$moradalocal = $_REQUEST['moradalocal'];


		$host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
		$dbname = $user;

		$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "INSERT INTO localidade VALUES (:moradalocal)";

		$result = $db->prepare($sql);

		$result->execute([':moradalocal' => $moradalocal]);

		echo('Adicionado');
		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}

?>
</body>
</html>