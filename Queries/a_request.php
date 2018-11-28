<html>
    <body>
<?php
    
	$option = $_REQUEST['option'];
		/*
	$host = "db.ist.utl.pt";
    $user ="ist187689";
    $password = "amarelo23";
    $dbname = $user;
    
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/
    if ($option == 1) {
        echo("<form action=\"a.php\" method=\"post\">");
    	echo("<p>What's the new address? <input type=\"text\" name=\"moradalocal\"/></p>");
    	echo("<p><input type=\"submit\" value=\"Submit\"/></p>");
    	echo("<a href=\"a.php?option=1\"></a></form>\n");
    }

    elseif ($option == 2) {
    	
    }

    elseif ($option == 3) {
    	
    }

    elseif ($option == 4) {
    	
    }

    elseif ($option == 5) {
    	
    }

    elseif ($option == 6) {
    	
    }

    elseif ($option == 7) {
    	
    }

    elseif ($option == 8) {
    	
    }

    elseif ($option == 9) {
    	
    }

    else {
    	
    }

    #$db = null;


?>
    </body>
</html>