<html>
    <body>
<?php
    
	$option = $_REQUEST['option'];

    if ($option == 1) {
        echo("<form action=\"a.php?tipo=1\" method=\"post\">");
    	echo("<p>What's the new address? <input type=\"text\" name=\"moradalocal\"/></p>");
    	echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
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
    	echo("<form action=\"a.php?tipo=9\" method=\"post\">");
        echo("<p>What's the new entity's name? <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }

    else {

    }


?>
    </body>
</html>