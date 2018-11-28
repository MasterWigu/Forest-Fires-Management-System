<html>


    <body>
    <h3></h3>
<?php
    #https://phpcodechecker.com/
    try
    {
       
        echo("<table cellspacing=\"5\">\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=1\">Inserir locais</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=2\">Remover locais</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=3\">Inserir eventos de emergencia</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=4\">Remover eventos de emergencia</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=5\">Inserir processos de socorro</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=6\">Remover processos de socorro</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=7\">Inserir meios</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=8\">Remover meios</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a_request.php?option=9\">Inserir entidades</a></td>\n");
        echo("</tr>\n");


        echo("<td><a href=\"a_request.php?option=10\">Remover entidades</a></td>\n");
        echo("</tr>\n");

        echo("</table>\n");

    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>

    <br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>
        
