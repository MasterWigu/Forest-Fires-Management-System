<html>
    <body>
    <h3></h3>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist187689";
        $password = "amarelo23";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        echo("<table cellspacing=\"5\">\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?{option=1}\">Inserir locais</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=2\">Remover locais</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=3\">Inserir eventos de emergencia</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=4\">Remover eventos de emergencia</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=5\">Inserir processos de socorro</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=6\">Remover processos de socorro</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=7\">Inserir meios</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=8\">Remover meios</a></td>\n");
        echo("</tr>\n");

        echo("<tr>\n");
        echo("<td><a href=\"a)request.php?option=9\">Inserir entidades</a></td>\n");
        echo("</tr>\n");


        echo("<td><a href=\"a)request.php?option=10\">Remover entidades</a></td>\n");
        echo("</tr>\n");

        echo("</table>\n");

    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
