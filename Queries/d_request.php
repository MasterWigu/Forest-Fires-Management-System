<html>
    <body>
<?php
    
	$option = $_REQUEST['option'];
    if ($option == 1) {
        echo("<form action=\"d.php?tipo=1\" method=\"post\">");
        echo("<p>What's the Number of Process: <input type=\"text\" name=\"numprocessosocorro\"/></p>");
        echo("<p>What's the number of the Vehicle: <input type=\"text\" name=\"nummeio\"/></p>");
        echo("<p>What's the entity of the Vehicle: <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }

    else {
    	echo("<form action=\"d.php?tipo=2\" method=\"post\">");
        echo("<p>What's the Number of Process: <input type=\"text\" name=\"numprocessosocorro\"/></p>");
        echo("<p>What's the number of the Vehicle: <input type=\"text\" name=\"nummeio\"/></p>");
        echo("<p>What's the entity of the Vehicle: <input type=\"text\" name=\"nomeentidade\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>");
    }
?>
    </body>
</html>