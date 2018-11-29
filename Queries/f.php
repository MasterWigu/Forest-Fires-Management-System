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

        echo("<h3>Meios de socorro accionados em processos de socorro originados em {$moradalocal}</h3>");

		echo("<table border=\"1\">\n");
		echo("<tr><td>Numero do Processo de Socorro</td><td>Nome da Entidade</td><td>Numero do Meio</td></tr>\n");

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
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>

</html>