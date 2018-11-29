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

    	$option = $_REQUEST['option'];



        echo("<form action=\"b2.php\" method=\"post\">");

        $sql = "SELECT nomeentidade FROM meio ORDER BY nomeentidade ASC";
        $result = $db->prepare($sql);
        $result->execute();

        
        echo ("<p>Nome da entiade associada ao meio: ");
        echo("<select type=\"text\" name=\"nomeentidade\">\n");
        foreach($result as $row) {
            echo("<option value='{$row['nomeentidade']}'>{$row['nomeentidade']}</option></p>");
        }
        echo("</select>\n");
    	
        echo("<p>Numero do meio a adicionar/remover/editar: <input type=\"text\" name=\"nummeio\"/></p>");

        echo("<p>Combate: <input type=\"checkbox\" name=\"iscombate\" value=\"1\"></p>");
        echo("<p>Apoio: <input type=\"checkbox\" name=\"isapoio\" value=\"1\"></p>");
        echo("<p>Socorro: <input type=\"checkbox\" name=\"issocorro\" value=\"1\"></p>");

    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }


?>
    
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>