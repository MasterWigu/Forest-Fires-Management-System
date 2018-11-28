<html>
    <body>
<?php
    $tipo = $_REQUEST['tipo'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist187689";
        $password = "amarelo23";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($tipo == 1) {

            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            $nummeio = $_REQUEST['nummeio'];
            $nomeentidade = $_REQUEST['nomeentidade'];

            $sql = "insert into acciona values (:nummeio, :nomeentidade, :numprocessosocorro)";

            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numprocessosocorro' => $numprocessosocorro]);

            echo("<p>Adicionado o meio numero $nummeio, da entidade \"$nomeentidade\", ao processo $numprocessosocorro.</p>");
        
        }
        else {
            $numtelefone = $_REQUEST['numtelefone'];
            $instantechamada = $_REQUEST['instantechamada'];
            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            /*$numprocessosocorro1 = $_REQUEST['numprocessosocorro1'];
            $numprocessosocorro2 = $_REQUEST['numprocessosocorro2'];
            if ($numprocessosocorro2 == null) {
                $numprocessosocorro = $numprocessosocorro1;
            }
            else {
                $numprocessosocorro = $numprocessosocorro2;
            }
            echo($numprocessosocorro);
            echo($numprocessosocorro1);
            echo($numprocessosocorro2);*/
            echo("teste1");

            $sql = "select exists (select 1 from processosocorro where numprocessosocorro = :numprocessosocorro)";

            $result = $db->prepare($sql);
            $result->execute([':numprocessosocorro' => $numprocessosocorro]);

            echo("teste2");
            echo($result);
            echo("teste2b");

            if ($result == FALSE) {
                echo("teste3");
                $sql = "insert into processosocorro values (:numprocessosocorro)";
                $result = $db->prepare($sql);
                $result->execute([':numprocessosocorro' => $numprocessosocorro]);
            }

            echo("teste4");
            $sql = "update eventoemergencia set numprocessosocorro = :numprocessosocorro where numtelefone = :numtelefone and instantechamada = :instantechamada";

            $result = $db->prepare($sql);
            $result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);
        
            echo("teste5");
        }


        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>