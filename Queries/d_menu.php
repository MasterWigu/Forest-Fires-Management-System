<html>
    <body>
    <h3></h3>
<?php
    #https://phpcodechecker.com/
    try {
       
        echo("<table cellspacing=\"5\">\n");

        echo("<tr>\n");
        echo("<td><a href=\"d_request.php?option=1\">Associar processo de socorro a meio</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"d_request.php?option=2\">Associar processo de socorro a evento de emergencia</a></td>\n");
        echo("</tr>\n");

        echo("</table>\n");

    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
