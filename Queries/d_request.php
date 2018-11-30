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

            echo("<h3>Associar processo de socorro a um meio</h3>");
            echo("<form action=\"d.php?tipo=1\" method=\"post\">");
            echo ("<p>Numero do processo de socorro: ");
            echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
            foreach($result as $row) {
                echo("<option value={$row['numprocessosocorro']}>{$row['numprocessosocorro']}</option></p>");
            }
            echo("</select>\n");


                $sql = "SELECT nummeio, nomeentidade FROM meiocombate";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>Meio a associar: ");
            echo("<select type=\"text\" name=\"entidademeio\">\n");
            foreach($result as $row) {
                $temp = " Meio ". $row['nummeio'];
                echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
            }
            echo("</select>\n");

            echo ("<p>Associar como: ");

            echo("<p>Meio de Combate <input type=\"checkbox\" name=\"iscombate\" value=\"1\"></p>");
            echo("<p>Meio de Apoio <input type=\"checkbox\" name=\"isapoio\" value=\"1\"> Numero de horas: <input type=\"number\" name=\"numhoras\" value=\"0\"/></p>");
            echo("<p>Meio de Socorro <input type=\"checkbox\" name=\"issocorro\" value=\"1\">Numero de vitimas: <input type=\"number\" name=\"numvitimas\" value=\"0\"/></p>");

            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
        }

        else {
            echo("<h3>Associar processo de socorro a eventos de emergencia</h3>");
            echo("<form action=\"d.php?tipo=2\" method=\"post\">");

            $sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>Numero do processo de socorro: ");
            echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
            foreach($result as $row) {
                echo("<option value={$row['numprocessosocorro']}>{$row['numprocessosocorro']}</option></p>");
            }
            echo("</select>\n");


            $sql = "SELECT numtelefone, instantechamada FROM eventoemergencia WHERE numprocessosocorro IS NULL ORDER BY instantechamada ASC ";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>Numero de telefone, data e hora do evento de emergencia: ");
            echo("<select type=\"text\" name=\"telefoneinstante\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['numtelefone']}, {$row['instantechamada']}'>{$row['numtelefone']}, {$row['instantechamada']}</option></p>");
            }
            echo("</select>\n"); 

            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
        }
    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>