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
    	

    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 2) {
        echo("<form action=\"b.php?tipo=2\" method=\"post\">");
      

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 3) {
    	echo("<form action=\"b.php?tipo=3\" method=\"post\">");

        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
    }


    elseif ($option == 4) {
        echo("<form action=\"b.php?tipo=4\" method=\"post\">");


        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }


    elseif ($option == 5) { /* mostrar todos os eventos de emergencia cujo numprocessosocorro = null */
        echo("<form action=\"b.php?tipo=5\" method=\"post\">");

    

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