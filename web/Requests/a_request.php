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
            echo("<h3>Inserir novo local</h3>");
            echo("<form action=\"../Queries/a.php?tipo=1\" method=\"post\">");
        	echo("<p>Nova morada: <input type=\"text\" name=\"moradalocal\"/></p>");
        	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 2) {
            echo("<h3>Remover local</h3>");
            echo("<form action=\"../Queries/a.php?tipo=2\" method=\"post\">");

            $sql = "SELECT moradalocal FROM localidade ORDER BY localidade ASC";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA ESCOLHER MORADA*/
            echo ("<p>Morada a remover: ");
            echo("<select type=\"text\" name=\"moradalocal\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['moradalocal']}'>{$row['moradalocal']}</option></p>");
            }
            echo("</select>\n");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 3) {
            echo("<h3>Inserir novo evento de emergencia</h3>");
        	echo("<form action=\"../Queries/a.php?tipo=3\" method=\"post\">");
            echo("<p>Numero de telefone: <input type=\"number\" name=\"numtelefone\"/></p>");
            echo("<p>Data e hora a que a chamada foi efetuada: <input type=\"datetime-local\" name=\"instantechamada\"/></p>");
            echo("<p>Nome da pessoa que telefonou: <input type=\"text\" name=\"nomepessoa\"/></p>");
            
            $sql = "SELECT moradalocal FROM localidade ORDER BY localidade ASC";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA ESCOLHER MORADA*/
            echo ("<p>Local do evento de emergencia: ");
            echo("<select type=\"text\" name=\"moradalocal\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['moradalocal']}'>{$row['moradalocal']}</option></p>");
            }
            echo("</select>\n");


            $sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA ESCOLHER PROCESSO */
            echo ("<p>Numero do processo de socorro originado (opcional): ");
            echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
            echo("<option value='-1'>{$row['null']}</option></p>");
            foreach($result as $row) {
                echo("<option value='{$row['numprocessosocorro']}'>{$row['numprocessosocorro']}</option></p>");
            }
            echo("</select>\n");

            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 4) {
            echo("<h3>Remover evento de emergencia</h3>");
            echo("<form action=\"../Queries/a.php?tipo=4\" method=\"post\">");

            $sql = "SELECT numtelefone, instantechamada FROM eventoemergencia";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA NUMTELEFONE E INSTANTECHAMADA DOS EVENTOS CUJO NUMPROCESSO = NULL */
            echo ("<p>Evento de emergencia a eliminar: "); /* DEPOIS VAI TER QUE SER PARA MAIS QUE UM EVENTO DE EMERGENCIA */
            echo("<select type=\"text\" name=\"telefoneinstante\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['numtelefone']}, {$row['instantechamada']}'>{$row['numtelefone']}, {$row['instantechamada']}</option></p>");
            }
            echo("</select>\n");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

        }


        elseif ($option == 5) { /* mostrar todos os eventos de emergencia cujo numprocessosocorro = null */
            echo("<h3>Inserir novo processo de socorro</h3>");
            echo("<form action=\"../Queries/a.php?tipo=5\" method=\"post\">");

            echo("<p>Numero do processo de socorro originado: <input type=\"number\" name=\"numprocessosocorro\"/></p>");
            
            $sql = "SELECT numtelefone, instantechamada FROM eventoemergencia WHERE numprocessosocorro IS NULL ORDER BY instantechamada ASC ";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA NUMTELEFONE E INSTANTECHAMADA DOS EVENTOS CUJO NUMPROCESSO = NULL */
            echo ("<p>Evento de emergencia que originou o processo de socorro: "); /* DEPOIS VAI TER QUE SER PARA MAIS QUE UM EVENTO DE EMERGENCIA */
            echo("<select type=\"text\" name=\"telefoneinstante\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['numtelefone']}, {$row['instantechamada']}'>{$row['numtelefone']}, {$row['instantechamada']}</option></p>");
            }
            echo("</select>\n");

            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 6) {
            echo("<h3>Remover processo de socorro</h3>");
            
            echo("<form action=\"../Queries/a.php?tipo=6\" method=\"post\">");
        	$sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA ESCOLHER PROCESSO */
            echo ("<p>Numero do processo de socorro a ser removido: ");
            echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['numprocessosocorro']}'>{$row['numprocessosocorro']}</option></p>");
            }
            echo("</select>\n");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }
        


        elseif ($option == 7) {
            echo("<h3>Inserir novo meio</h3>");
            echo("<form action=\"../Queries/a.php?tipo=7\" method=\"post\">");

            echo("<p>Nome do meio a adicionar: <input type=\"text\" name=\"nomemeio\"/></p>");

            $sql = "SELECT * FROM entidademeio";
            $result = $db->prepare($sql);
            $result->execute();

            /* COMBO BOX PARA ESCOLHER ENTIDADE ONDE ADICIONAR MEIO */
            echo ("<p>Entidade: ");
            echo("<select type=\"text\" name=\"nomeentidade\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['nomeentidade']}'>{$row['nomeentidade']}</option></p>");
            }
            echo("</select>\n");

            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 8) {
            echo("<h3>Remover meio</h3>");
        	echo("<form action=\"../Queries/a.php?tipo=8\" method=\"post\">");

             $sql = "SELECT nummeio, nomeentidade FROM meio";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>Numero e Entidade do meio a remover: ");
            echo("<select type=\"text\" name=\"entidademeio\">\n");
            foreach($result as $row) {
                $temp = " Meio ". $row['nummeio'];
                echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
            }
            echo("</select>\n");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        }


        elseif ($option == 9) {
            echo("<h3>Inserir nova entidade</h3>");
        	echo("<form action=\"../Queries/a.php?tipo=9\" method=\"post\">");
            echo("<p>Nome da nova entidade: <input type=\"text\" name=\"nomeentidade\"/></p>");
            echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
        }


        else {
            echo("<h3>Remover entidade</h3>");
            echo("<form action=\"../Queries/a.php?tipo=10\" method=\"post\">");
            $sql = "SELECT nomeentidade FROM entidadeMeio ORDER BY nomeentidade ASC";
            $result = $db->prepare($sql);
            $result->execute();

            echo ("<p>Nome da entidade a remover: ");
            echo("<select type=\"text\" name=\"nomeentidade\">\n");
            foreach($result as $row) {
                echo("<option value='{$row['nomeentidade']}'>{$row['nomeentidade']}</option></p>");
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
    <button onclick="location.href = '../menu.php';">Voltar</button>
    </body>
</html>