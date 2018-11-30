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
        $db->beginTransaction();

        if ($tipo == 1) {

            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            $entidademeio = $_REQUEST['entidademeio'];
            $array = explode(',', $entidademeio);
            $nomeentidade = $array[0];
            $nummeio = $array[1];

            $sql = "SELECT * FROM acciona WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

            if ($result->rowCount() == 0) {
                $sql = "INSERT INTO acciona VALUES (:nummeio, :nomeentidade, :numprocessosocorro)";

                $result = $db->prepare($sql);
                $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numprocessosocorro' => $numprocessosocorro]);
                if(isset($_REQUEST['iscombate'])) {
                    echo('<p>O meio selecionado foi accionado como meio de combate</p>');
                }
                else {
                    echo('<p>O meio selecionado foi associado ao processo de socorro</p>');
                }
            } 
            else {
                $sql = "SELECT * FROM meiocombate WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

                $result = $db->prepare($sql);
                $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

                if(isset($_REQUEST['iscombate'])) {
                    if ($result->rowCount() == 0) {
                        echo('<p>O meio selecionado nao esta registado como meio de combate</p>');
                    }
                    else {
                        echo('<p>O meio selecionado ja esta accionado como meio de combate</p>');
                    }
                }
                else {
                    echo('<p>O meio selecionado ja estava associado ao processo de socorro</p>');
                }
            }

            if(isset($_REQUEST['isapoio'])) {
                $sql = "SELECT * FROM alocado WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

                $result = $db->prepare($sql);
                $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

                if ($result->rowCount() == 0) {
                    $sql = "SELECT * FROM meioapoio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

                    $result = $db->prepare($sql);
                    $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

                    if ($result->rowCount() == 0) {
                        echo('<p>O meio selecionado nao esta registado como meio de apoio e por isso nao foi alocado</p>');
                    }
                    else {
                        $sql = "INSERT INTO alocado VALUES (:nummeio, :nomeentidade, :numhoras, :numprocessosocorro)";

                        $result = $db->prepare($sql);
                        $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numhoras' => $_REQUEST['numhoras'], ':numprocessosocorro' => $numprocessosocorro]);

                        echo('<p>O meio selecionado foi alocado como meio de apoio</p>');
                    }
                }
                else {
                    echo('<p>O meio selecionado ja esta accionado como meio de apoio</p>');
                }
            }

            if(isset($_REQUEST['issocorro'])) {
                $sql = "SELECT * FROM transporta WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

                $result = $db->prepare($sql);
                $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

                if ($result->rowCount() == 0) {
                    $sql = "SELECT * FROM meiosocorro WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

                    $result = $db->prepare($sql);
                    $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

                    if ($result->rowCount() == 0) {
                        echo('<p>O meio selecionado nao esta registado como meio de socorro e por isso nao foi acionado como transportador</p>');
                    }
                    else {
                        $sql = "INSERT INTO transporta VALUES (:nummeio, :nomeentidade, :numvitimas, :numprocessosocorro)";

                        $result = $db->prepare($sql);
                        $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade, ':numvitimas' => $_REQUEST['numvitimas'], ':numprocessosocorro' => $numprocessosocorro]);

                        echo('<p>O meio selecionado foi accionado (transporte) como meio de socorro</p>');
                    }
                }
                else {
                    echo('<p>O meio selecionado ja esta accionado como meio de socorro</p>');
                }
            }
        }
        else {
            $numprocessosocorro = $_REQUEST['numprocessosocorro'];
            $telefoneinstante = $_REQUEST['telefoneinstante'];

            $array_tel_inst = explode(',', $telefoneinstante);
            $numtelefone = $array_tel_inst[0];
            $instantechamada = $array_tel_inst[1];

            #podemos assumir que os dados de input estao sempre correctos porque vem de combobox
            #(numprocessosocorro ja existente e eventoemergencia sem processo de socorro associado)
            $sql = "UPDATE eventoemergencia SET numprocessosocorro = :numprocessosocorro WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

            $result = $db->prepare($sql);
            $result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

            echo("Numero de processo de socorro associado ao evento de emergencia");

        }

        $db->commit();
        $db = null;
    }
    catch (PDOException $e)
    {
        $db->rollBack();
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <br><br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
    </body>
</html>