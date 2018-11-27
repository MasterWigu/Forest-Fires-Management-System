<html>
    <body>
<?php
    $moradalocal = $_REQUEST['moradalocal'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist187689";
        $password = "amarelo23";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT numprocessosocorro, nummeio, nomeentidade FROM transporta natural join eventoemergencia WHERE moradalocal = :moradalocal;";

        $result = $db->prepare($sql);

        $result->execute([':moradalocal' => $moradalocal]);

		echo("<table border=\"1\">\n");
		echo("<tr><td>Numero de Processo de Socorro</td><td>Nome de Entidade</td><td>Numero Meio</td></tr>\n");

		foreach($result as $row)
		{
            echo("<tr><td>");
            echo($row["numprocessosocorro"]);
            echo("</td><td>");
            echo($row["nomeentidade"]);
            echo("</td><td>");
            echo($row["nummeio"]);
            echo("</td></tr>");
		}
		echo("</table>\n");

        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>