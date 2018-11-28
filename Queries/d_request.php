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
        if ($option == 1) {

            $sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
            $result = $db->prepare($sql);
            $result->execute();

            echo("<form action=\"d.php?tipo=1\" method=\"post\">");
            echo ("<p>What's the Number of Process:");
            echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
            foreach($result as $row) {
                echo("<option value={$row['numprocessosocorro']}>{$row['numprocessosocorro']}</option></p>");
            }
            echo("</select>\n");


            echo("<p>What's the number of the Vehicle: <input type=\"text\" name=\"nummeio\"/></p>");

            $sql = "SELECT DISTINCT nomeentidade FROM meio ORDER BY nomeentidade ASC";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>What's the entity of the Vehicle:");
            echo("<select type=\"text\" name=\"nomeentidade\">\n");
            foreach($result as $row) {
                echo("<option value={$row['nomeentidade']}>{$row['nomeentidade']}</option></p>");
            }
            echo("</select>\n");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
        }

        else {
        	echo("<form action=\"d.php?tipo=2\" method=\"post\">");
            echo("<p>What's the Number of Process: <input type=\"text\" name=\"numprocessosocorro\"/></p>");
            echo("<p>What's the number of the Vehicle: <input type=\"text\" name=\"nummeio\"/></p>");
            echo("<p>What's the entity of the Vehicle: <input type=\"text\" name=\"nomeentidade\"/></p>");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
        }
    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>