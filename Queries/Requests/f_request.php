<html>
	<body>

<?php
    try {
        $host = "db.ist.utl.pt";
        $user ="ist187689";
        $password = "amarelo23";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo("<h3>Meios de socorro accionados em processos de socorro originados num dado local de incendio</h3>");
		echo("<form action=\"../Queries/f.php\" method=\"post\">");
		$sql = "SELECT moradalocal FROM localidade ORDER BY localidade ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER MORADA*/
        echo ("<p>Qual e a localizacao do incendio? ");
        echo("<select type=\"text\" name=\"moradalocal\">\n");
        foreach($result as $row) {
            echo("<option value='{$row['moradalocal']}'>{$row['moradalocal']}</option></p>");
        }
        echo("</select>\n");
		echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
	}
	catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
		<br>
 	    <button onclick="location.href = '../menu.php';">Voltar</button>
	</body>
</html>