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


    if ($option == 1) {
        echo("<form action=\"b.php?tipo=1\" method=\"post\">");

        $sql = "SELECT nummeio, nomeentidade FROM meio";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a adicionar como meio de combate: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");

    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


/*           echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$row['nummeio']}'</option></p>");*/

    elseif ($option == 2) {
        echo("<form action=\"b.php?tipo=2\" method=\"post\">");
      
        $sql = "SELECT nummeio, nomeentidade FROM meiocombate";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a remover como meio de combate: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }

    elseif ($option == 3) {
        echo("<form action=\"b.php?tipo=3\" method=\"post\">");
      

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 4) {
    	echo("<form action=\"b.php?tipo=4\" method=\"post\">");

        $sql = "SELECT nummeio, nomeentidade FROM meio";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a adicionar como meio de apoio: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 5) {
        echo("<form action=\"b.php?tipo=5\" method=\"post\">");

        $sql = "SELECT nummeio, nomeentidade FROM meioapoio";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a remover como meio de apoio: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }

    elseif ($option == 6) {
        echo("<form action=\"b.php?tipo=6\" method=\"post\">");


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }


    elseif ($option == 7) {
        echo("<form action=\"b.php?tipo=7\" method=\"post\">");

        $sql = "SELECT nummeio, nomeentidade FROM meio";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a adicionar como meio de socorro: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");
    

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }

    elseif ($option == 8) {
        echo("<form action=\"b.php?tipo=6\" method=\"post\">");

        $sql = "SELECT nummeio, nomeentidade FROM meiosocorro";
        $result = $db->prepare($sql);
        $result->execute();

        echo ("<p>Meio a remover como meio de socorro: ");
        echo("<select type=\"text\" name=\"entidademeio\">\n");
        foreach($result as $row) {
            $temp = " Meio ". $row['nummeio'];
            echo("<option value='{$row['nomeentidade']},{$row['nummeio']}'>'{$row['nomeentidade']},{$temp}'</option></p>");
        }
        echo("</select>\n");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }


    else {
        echo("<form action=\"b.php?tipo=6\" method=\"post\">");
       

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }


?>
    
    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>