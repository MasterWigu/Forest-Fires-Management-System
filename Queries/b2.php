<html>
    <body>
<?php
    try {
        $host = "db.ist.utl.pt";
        $user ="ist187689";
        $password = "amarelo23";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nomeentidade = $_REQUEST['nomeentidade'];
        $nummeio = $_REQUEST['nummeio'];

        if (isset($_REQUEST['iscombate'])) {
            $sql = "DO test BEGIN IF NOT EXISTS (SELECT * FROM meiocombate WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN INSERT INTO meiocombate VALUES (:nummeio, :nomeentidade) END IF; END test";
        } else {
            $sql = "IF EXISTS (SELECT * from meiocombate where nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN DELETE FROM meiocombate WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade)";
        }
        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);


        if (isset($_REQUEST['isapoio'])) {
            $sql = "IF NOT EXISTS (SELECT * from meioapoio where nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN INSERT INTO meioapoio VALUES (:nummeio, :nomeentidade)";
        } else {
            $sql = "IF EXISTS (SELECT * from meioapoio where nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN DELETE FROM meioapoio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade)";
        }
        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);


        if (isset($_REQUEST['issocorro'])) {
            $sql = "IF NOT EXISTS (SELECT * from meiosocorro where nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN INSERT INTO meiosocorro VALUES (:nummeio, :nomeentidade)";
        } else {
            $sql = "IF EXISTS (SELECT * from meiosocorro where nummeio = :nummeio AND nomeentidade = :nomeentidade) THEN DELETE FROM meiosocorro WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade)";
        }
        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

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