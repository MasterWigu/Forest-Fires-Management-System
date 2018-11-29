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

            $sql = "INSERT INTO acciona VALUES (:nummeio, :nomeentidade, :numprocessosocorro)";

            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numprocessosocorro' => $numprocessosocorro]);

            echo("<p>Adicionado o meio numero $nummeio, da entidade \"$nomeentidade\", ao processo $numprocessosocorro.</p>");
        
        }
        else {
            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            $telefoneinstante = $_REQUEST['telefoneinstante'];

            $array_tel_inst = explode(',', $telefoneinstante);
            $numtelefone = $array_tel_inst[0];
            $instantechamada = $array_tel_inst[1];

            $sql = "SELECT * FROM processosocorro WHERE numprocessosocorro = :numprocessosocorro";

            $result = $db->prepare($sql);
            $result->execute([':numprocessosocorro' => $numprocessosocorro]);

            if ($result->rowCount() == 0) {
                $sql = "INSERT INTO processosocorro VALUES (:numprocessosocorro)";
                $result = $db->prepare($sql);
                $result->execute([':numprocessosocorro' => $numprocessosocorro]);
            }

            $sql = "SELECT numprocessosocorro FROM eventoemergencia WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

            $result = $db->prepare($sql);
            $result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

            if ($result->fetch()['numprocessosocorro'] == null) {
                $sql = "UPDATE eventoemergencia SET numprocessosocorro = :numprocessosocorro WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

                $result = $db->prepare($sql);
                $result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

                echo("Numero de processo de socorro associado ao evento de emergencia");

            } else {
                echo("O evento de emergencia selecionado ja possui um numero de processo de socorro");
            }
        }


        $db = null;
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