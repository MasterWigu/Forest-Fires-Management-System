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
            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            $nummeio = $_REQUEST['nummeio'];
            $nomeentidade = $_REQUEST['nomeentidade'];

            $sql = "insert into acciona values (:nummeio, :nomeentidade, :numprocessosocorro)";
            echo("<p>$sql</p>");
            echo("<p>teste</p>");

            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numprocessosocorro' => $numprocessosocorro]);
        

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