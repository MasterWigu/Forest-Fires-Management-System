<html>
    <body>
<?php
    
    $host = "db.ist.utl.pt";
    $user ="ist187689";
    $password = "amarelo23";
    $dbname = $user;
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$option = $_REQUEST['option'];

        /*if(isset($_POST)){
            var_dump($_POST);
        }*/


    if ($option == 1) {
        echo("<form action=\"a.php?tipo=1\" method=\"post\">");
    	echo("<p>What's the new address? <input type=\"text\" name=\"moradalocal\"/></p>");
    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }

    elseif ($option == 2) {
    	
    }

    elseif ($option == 3) {
    	echo("<form action=\"a.php?tipo=3\" method=\"post\">");

        echo("<p>Numero de telefone: <input type=\"text\" name=\"numtelefone\"/></p>");
        echo("<p>Data e hora a que a chamada foi efetuada: <input type=\"text\" name=\"instantechamada\"/></p>");
        echo("<p>Nome da pessoa que telefonou: <input type=\"text\" name=\"nomepessoa\"/></p>");
        
        $sql = "SELECT moradalocal FROM localidade ORDER BY localidade ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER MORADA*/
        echo ("<p>Local do evento de emergencia: ");
        echo("<select type=\"text\" name=\"moradalocal\">\n");
        foreach($result as $row) {
            echo("<option value={$row['moradalocal']}>{$row['moradalocal']}</option></p>");
        }
        echo("</select>\n");


        $sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER PROCESSO */
        echo ("<p>Numero do processo de socorro originado: ");
        echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
        foreach($result as $row) {
            echo("<option value={$row['numprocessosocorro']}>{$row['numprocessosocorro']}</option></p>");
        }
        echo("</select>\n");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");


    }

    elseif ($option == 4) {

    }

    elseif ($option == 5) { /* mostrar todos os eventos de emergencia cujo numprocessosocorro = null */
        /*echo("<form action=\"a.php?tipo=5\" method=\"post\">");

        echo("<p>Numero do processo de socorro originado: <input type=\"text\" name=\"numprocessosocorro\"/></p>");

        $sql = "SELECT numtelefone, instantechamada FROM eventoemergencia";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER PROCESSO */
        /*echo ("<p>Evento de emergencia que originou o processo de socorro: "); /* DEPOIS VAI TER QUE SER PARA MAIS QUE UM EVENTO DE EMERGENCIA */
        /*echo("<select type=\"text\" name=\"numtelefone, instantechamada\">\n");
        foreach($result as $row) {
            echo("<option value={$row['numtelefone', 'instantechamada']}>{$row['numtelefone', 'instantechamada']}</option></p>");
        }
        echo("</select>\n");


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    	*/
    }

    elseif ($option == 6) {
    	
    }

    elseif ($option == 7) {
        echo("<form action=\"a.php?tipo=7\" method=\"post\">");

        echo("<p>Nome do meio a adicionar: <input type=\"text\" name=\"nomemeio\"/></p>");

        $sql = "SELECT * FROM entidademeio";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER ENTIDADE ONDE ADICIONAR MEIO */
        echo ("<p>Entidade: ");
        echo("<select type=\"text\" name=\"nomeentidade\">\n");
        foreach($result as $row) {
            echo("<option value={$row['nomeentidade']}>{$row['nomeentidade']}</option></p>");
        }
        echo("</select>\n");


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");    	


    }

    elseif ($option == 8) {
    	
    }

    elseif ($option == 9) {
    	echo("<form action=\"a.php?tipo=9\" method=\"post\">");
        echo("<p>What's the new entity's name? <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }

    else {

    }


?>
    </body>
</html>