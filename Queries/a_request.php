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
    	echo("<p>Nova morada: <input type=\"text\" name=\"moradalocal\"/></p>");
    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 2) {
        echo("<form action=\"a.php?tipo=2\" method=\"post\">");
        echo("<p>Morada a remover: <input type=\"text\" name=\"moradalocal\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
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
            echo("<option value='{$row['moradalocal']}'>{$row['moradalocal']}</option></p>");
        }
        echo("</select>\n");


        $sql = "SELECT numprocessosocorro FROM processosocorro ORDER BY numprocessosocorro ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER PROCESSO */
        echo ("<p>Numero do processo de socorro originado (opcional): ");
        echo("<select type=\"text\" name=\"numprocessosocorro\">\n");
        foreach($result as $row) {
            echo("<option value='{$row['numprocessosocorro']}'>{$row['numprocessosocorro']}</option></p>");
        }
        echo("</select>\n");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 4) {
        echo("<form action=\"a.php?tipo=4\" method=\"post\">");

        echo("<p>Numero de telefone: <input type=\"text\" name=\"numtelefone\"/></p>");
        echo("<p>Data e hora a que a chamada foi efetuada: <input type=\"text\" name=\"instantechamada\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }


    elseif ($option == 5) { /* mostrar todos os eventos de emergencia cujo numprocessosocorro = null */
        echo("<form action=\"a.php?tipo=5\" method=\"post\">");

        echo("<p>Numero do processo de socorro originado: <input type=\"text\" name=\"numprocessosocorro\"/></p>");


        /* COMBO BOX PARA ESCOLHER PROCESSO */
        /*BOA SORTE COM ISSO*/
        
        echo ("<p>Evento de emergencia que originou o processo de socorro: "); /* DEPOIS VAI TER QUE SER PARA MAIS QUE UM EVENTO DE EMERGENCIA */
        $sql = "SELECT numtelefone FROM eventoemergencia ORDER BY numtelefone ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER PROCESSO */
        echo ("<p>Numero de telefone do evento: ");
        echo("<select type=\"text\" name=\"numtelefone\">\n");
        foreach($result as $row) {
            echo("<option value='{$row['numtelefone']}'>{$row['numtelefone']}</option></p>");
        }
        echo("</select>\n");

        $sql = "SELECT instantechamada FROM eventoemergencia ORDER BY instantechamada ASC";
        $result = $db->prepare($sql);
        $result->execute();

        /* COMBO BOX PARA ESCOLHER PROCESSO */
        echo ("<p>Data e hora do envento de emergencia: ");
        echo("<select type=\"text\" name=\"instantechamada\">\n");
        foreach($result as $row) {
            echo("<option value='{$row['instantechamada']}'>{$row['instantechamada']}</option></p>");
        }
        echo("</select>\n");
        /*echo("<p>Numero de telefone: <input type=\"text\" name=\"numtelefone\"/></p>");
        echo("<p>Data e hora a que a chamada foi efetuada: <input type=\"text\" name=\"instantechamada\"/></p>");**/


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 6) {
        
        echo("<form action=\"a.php?tipo=6\" method=\"post\">");
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
    	echo("<form action=\"a.php?tipo=8\" method=\"post\">");
        echo("<p>Numero do meio a remover: <input type=\"text\" name=\"nummeio\"/></p>");
        echo("<p>Nome da entidade a que pertence o meio a remover: <input type=\"text\" name=\"nomeentidade\"/></p>"); /* NAO ESTA COM COMBO BOX PORQUE OS ESPACOS ESTAO A LIXAR TUDO */
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 9) {
    	echo("<form action=\"a.php?tipo=9\" method=\"post\">");
        echo("<p>Nome da nova entidade: <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }


    else {
        echo("<form action=\"a.php?tipo=10\" method=\"post\">");
        echo("<p>Nome da entidade a remover: <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }


?>
    
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>