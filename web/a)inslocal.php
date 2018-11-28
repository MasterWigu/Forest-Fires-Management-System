<html>
    <body>
<?php
    $moradalocal = $_REQUEST['moradalocal'];
    try
    {
        $host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "insert into localidade values(:moradalocal);";
        echo("<p>$sql</p>");

        $result = $db->prepare($sql);
        $result->execute([':moradalocal' => $moradalocal]);
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>

<!--
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 

pg_query("BEGIN") or die("Could not start transaction\n");

$res1 = pg_query("DELETE FROM cars WHERE id IN (1, 9)");
$res2 = pg_query("INSERT INTO cars VALUES (1, 'BMW', 36000), (9, 'Audi', 52642)");

if ($res1 and $res2) {
    echo "Commiting transaction\n";
    pg_query("COMMIT") or die("Transaction commit failed\n");
} else {
    echo "Rolling back transaction\n";
    pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
}

pg_close($con);
-->