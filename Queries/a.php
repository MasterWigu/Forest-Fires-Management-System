<html>
    <meta charset="UTF-8">
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
			$moradalocal = $_REQUEST['moradalocal'];
		
			$sql = "INSERT INTO localidade VALUES (:moradalocal)";

			$result = $db->prepare($sql);
			$result->execute([':moradalocal' => $moradalocal]);

			echo("Morada adicionada");
		}


		elseif ($tipo == 2) {

		}


		elseif ($tipo == 3) {
			$numtelefone = $_REQUEST['numtelefone'];
			$instantechamada = $_REQUEST['instantechamada'];
			$nomepessoa = $_REQUEST['nomepessoa'];
			$moradaLocal = $_REQUEST['moradalocal'];
			$numprocessosocorro = $_REQUEST['numprocessosocorro'];

			$sql = "INSERT INTO eventoemergencia VALUES (:numtelefone, :instantechamada, :nomepessoa, :moradalocal, :numprocessosocorro)";

			$result = $db->prepare($sql);
			$result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada, ':nomepessoa' => $nomepessoa,':moradalocal' => $moradalocal, ':numprocessosocorro' => $numprocessosocorro]);

			echo("Evento de emergencia adicionado");
		}


		elseif ($tipo == 4) {

		}


		elseif ($tipo == 5) {
			/*$numprocessosocorro = $_REQUEST['numprocessosocorro'];
			$numtelefone = $_REQUEST['numtelefone'];
			$instantechamada = $_REQUEST['instantechamada'];

			$sql = "UPDATE eventoemergencia SET numprocessosocorro=':numprocessosocorro'";

			$result = $db->prepare($sql);

			$result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

			echo("Processo de socorro adicionado ao(s) evento(s) de emergencia que o originou(aram)");*/
		}


		elseif ($tipo == 6) {

		}


		elseif ($tipo == 7) {
			$nomemeio = $_REQUEST['nomemeio'];
			$nomeentidade = $_REQUEST['nomeentidade'];

			$nummeio = "SELECT MAX(nummeio) FROM meio WHERE nomeentidade = :nomeentidade";
			$result = $db->prepare($nummeio);
			$result->execute([':nomeentidade' => $nomeentidade]);

			if ($nummeio == null)
				$nummeio = 0;

			$sql = "INSERT INTO meio VALUES (:nummeio, :nomemeio, :nomeentidade)";

			$result = $db->prepare($sql);
			$result->execute(['nummeio' => $nummeio + 1, 'nomemeio' => $nomemeio, ':nomeentidade' => $nomeentidade]);

			echo("Meio adicionado");			
		}


		elseif ($tipo == 8) {

		}


		elseif ($tipo == 9) {
			$nomeentidade = $_REQUEST['nomeentidade'];

			$sql = "INSERT INTO entidademeio VALUES (:nomeentidade)";

			$result = $db->prepare($sql);
			$result->execute([':nomeentidade' => $nomeentidade]);

			echo("Entidade adicionada");
		}


		else {

		}


		$db = null;
	}

	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");

		/*echo("<p></p>");

		if(isset($_POST)){
            var_dump($_POST);
        }*/

	}

?>
</body>
</html>