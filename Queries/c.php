<html>
    <meta charset="UTF-8">
	<body>
<?php
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
		$dbname = $user;

		$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$option = $_REQUEST['option'];

		if ($option == 1) {

			$sql = "SELECT nomeentidade, nummeio, nomemeio FROM meio;";
			$result = $db->prepare($sql);
			$result->execute();

			echo("<table border=\"1\">\n");
			echo("<tr><td>Nome da Entidade</td><td>Numero do Meio</td><td>Nome do Meio</td></tr>\n");

			foreach($result as $row)
			{
	            echo("<tr><td>");
	            echo($row["nomeentidade"]);
	            echo("</td><td>");
	            echo($row["nummeio"]);
	            echo("</td><td>");
	            echo($row["nomemeio"]);
	            echo("</td></tr>");
			}
			echo("</table>\n");

		}
		else {
			$sql = "SELECT numprocessosocorro FROM processosocorro;";
			$result = $db->prepare($sql);
			$result->execute();

			echo("<table border=\"1\">\n");
			echo("<tr><td>Numero do Processo de Socorro</td></tr>\n");

			foreach($result as $row)
			{
	            echo("<tr><td>");
	            echo($row["numprocessosocorro"]);
	            echo("</td></tr>");
			}
			echo("</table>\n");
		}

		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}

?>
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
</body>
</html>