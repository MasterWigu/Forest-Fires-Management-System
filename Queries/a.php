<html>
    <meta charset="UTF-8">
	<body>
<?php

	function deleteevento($numtelefone, $instantechamada, $db) {
		#para apagar evento: ver processosocorro associado, ver se so esta ligado a esse evento. se sim, apaga processo e, consegquentemente (cascade), evento, se nao, apenas apaga evento
		$sql = "SELECT DISTINCT numprocessosocorro FROM eventoemergencia WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

		$result = $db->prepare($sql);
		$result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);
		$numprocessosocorro = $result->fetch()['numprocessosocorro'];

		if ($numprocessosocorro != null) {

			$sql = "SELECT COUNT(numprocessosocorro) AS count FROM eventoemergencia WHERE numprocessosocorro = :numprocessosocorro GROUP BY numprocessosocorro";

			$result = $db->prepare($sql);
			$result->execute([':numprocessosocorro' => $numprocessosocorro]);

			if ($result->fetch()['count'] == 1) {
				$sql = "DELETE FROM processosocorro WHERE numprocessosocorro = :numprocessosocorro";

				$result = $db->prepare($sql);
				$result->execute([':numprocessosocorro' => $numprocessosocorro]);
			}
			else {
				$sql = "DELETE FROM eventoemergencia WHERE numprocessosocorro = :numprocessosocorro";

				$result = $db->prepare($sql);
				$result->execute([':numprocessosocorro' => $numprocessosocorro]);
			}
		}
		else  {
			$sql = "DELETE FROM eventoemergencia WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

			$result = $db->prepare($sql);
			$result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);
		}
	}



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
			$moradalocal = $_REQUEST['moradalocal'];

			$sql = "SELECT * FROM localidade WHERE moradalocal = :moradalocal";

			$result = $db->prepare($sql);
			$result->execute([':moradalocal' => $moradalocal]);

			if ($result->rowCount() == 0) {
				$sql = "INSERT INTO localidade VALUES (:moradalocal)";

				$result = $db->prepare($sql);
				$result->execute([':moradalocal' => $moradalocal]);


				echo("{$moradalocal} foi adicionada a lista de localidades.");
			}
			else {
				echo("{$moradalocal} ja existe na lista de localidades.");
			}
		}


		elseif ($tipo == 2) {
			$moradalocal = $_REQUEST['moradalocal'];


			$sql = "SELECT DISTINCT numtelefone, instantechamada FROM eventoemergencia WHERE moradalocal = :moradalocal";

			$result = $db->prepare($sql);
			$result->execute([':moradalocal' => $moradalocal]);

			foreach ($result as $row) {
				deleteevento($row['numtelefone'], $row['instantechamada'], $db);
			}

			$sql = "DELETE FROM localidade WHERE moradalocal = :moradalocal";

			$result = $db->prepare($sql);
			$result->execute([':moradalocal' => $moradalocal]);

			echo("{$moradalocal} foi removida da lista de localidades.");
		}


		elseif ($tipo == 3) {
			$numtelefone = $_REQUEST['numtelefone'];
			$instantechamada = $_REQUEST['instantechamada'];
			$nomepessoa = $_REQUEST['nomepessoa'];
			$moradaLocal = $_REQUEST['moradalocal'];
			$numprocessosocorro = $_REQUEST['numprocessosocorro'];

			$sql "SELECT * FROM eventoemergencia WHERE numtelefone = :numtelefone, instantechamada = :instantechamada";

			if ($result->rowCount() == 0) {
				$sql = "INSERT INTO eventoemergencia VALUES (:numtelefone, :instantechamada, :nomepessoa, :moradalocal, :numprocessosocorro)";

				$result = $db->prepare($sql);
				$result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada, ':nomepessoa' => $nomepessoa,':moradalocal' => $moradalocal, ':numprocessosocorro' => $numprocessosocorro]);

				echo("Evento de emergencia adicionado");
			}
			else {
				echo("O evento de emergencia ja existe")
			}
		}


		elseif ($tipo == 4) {
			$numtelefone = $_REQUEST['numtelefone'];
			$instantechamada = $_REQUEST['instantechamada'];

			deleteevento($numtelefone, $instantechamada, $db);


			echo("Evento de emergencia removido");
		}


		elseif ($tipo == 5) {
			$numprocessosocorro = $_REQUEST['numprocessosocorro'];
			$telefoneinstante = $_REQUEST['telefoneinstante'];

			$array_tel_inst = explode(',', $telefoneinstante);
			$numtelefone = $array_tel_inst[0];
			$instantechamada = $array_tel_inst[1];


			$sql = "SELECT numprocessosocorro FROM eventoemergencia WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";

            $result = $db->prepare($sql);
            $result->execute([':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

            if ($result->fetch()['numprocessosocorro'] == null) { // se estiver a null nao ha nenhum processo de socorro
            	$sql = "SELECT * FROM processosocorro WHERE numprocessosocorro = :numprocessosocorro";

            	$result = $db->prepare($sql);
            	$result->execute([':numprocessosocorro' => $numprocessosocorro]);

            	if ($result->rowCount() == 0) {
                	$sql = "INSERT INTO processosocorro VALUES (:numprocessosocorro)";
                	$result = $db->prepare($sql);
                	$result->execute([':numprocessosocorro' => $numprocessosocorro]);
            	

					$sql = "UPDATE eventoemergencia SET numprocessosocorro = :numprocessosocorro WHERE numtelefone = :numtelefone AND instantechamada = :instantechamada";
					$result = $db->prepare($sql);
					$result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada]);

					echo("Processo de socorro adicionado ao(s) evento(s) de emergencia que o originou(aram)");
				}
				else {
					echo("O numero de processo de socorro inserido ja existe");
				}


			}
			else {

				echo("O evento de emergencia selecionado ja possui um processo de socorro associado");
			}

		}


		elseif ($tipo == 6) {
			$numprocessosocorro = $_REQUEST['numprocessosocorro'];

			$sql = "DELETE FROM processosocorro WHERE numprocessosocorro = :numprocessosocorro";

			$result = $db->prepare($sql);
			$result->execute([':numprocessosocorro' => $numprocessosocorro]);


			echo("Processo de socorro numero {$numprocessosocorro} removido");

		}


		elseif ($tipo == 7) {
			$nomemeio = $_REQUEST['nomemeio'];
			$nomeentidade = $_REQUEST['nomeentidade'];


			$nummeio = "SELECT MAX(nummeio) FROM meio WHERE nomeentidade = :nomeentidade";
			$result = $db->prepare($nummeio);
			$result->execute([':nomeentidade' => $nomeentidade]);

			if ($nummeio == null)
				$nummeio = -1;#-1 porque depois ele cria o meio com nummeio +1 



			$sql = "INSERT INTO meio VALUES (:nummeio, :nomemeio, :nomeentidade)";

			$result = $db->prepare($sql);
			$result->execute(['nummeio' => $nummeio + 1, 'nomemeio' => $nomemeio, ':nomeentidade' => $nomeentidade]);


			echo("Meio numero {$nummeio} da entidade {$nomeentidade} adicionado com sucesso a lista de meios.");		
		}


		elseif ($tipo == 8) {
			$nummeio = $_REQUEST['nummeio'];
			$nomeentidade = $_REQUEST['nomeentidade'];


			$sql = "DELETE FROM meio WHERE nomeentidade = :nomeentidade AND nummeio = :nummeio";

			$result = $db->prepare($sql);
			$result->execute([':nomeentidade' => $nomeentidade, 'nummeio' => $nummeio]);


			echo("Meio numero {$nummeio} da entidade {$nomeentidade} removido com sucesso da lista de meios.");
		}


		elseif ($tipo == 9) {
			$nomeentidade = $_REQUEST['nomeentidade'];


			$sql = "SELECT * FROM entidademeio WHERE nomeentidade = :nomeentidade";
			$result = $db->prepare($sql);
			$result->execute([':nomeentidade' => $nomeentidade]);

			if ($result->rowCount() == 0) {
				$sql = "INSERT INTO entidademeio VALUES (:nomeentidade)";

				$result = $db->prepare($sql);
				$result->execute([':nomeentidade' => $nomeentidade]);

				echo("Entidade adicionada");
			}
			else {
				echo("A entidade {$nomeentidade} ja existe");
			}
		}


		else {
			$nomeentidade = $_REQUEST['nomeentidade'];


			$sql = "DELETE FROM entidademeio WHERE nomeentidade = :nomeentidade";

			$result = $db->prepare($sql);
			$result->execute([':nomeentidade' => $nomeentidade]);


			echo("Entidade removida");
		}

		$db->commit();
		$db = null;
	}

	catch (PDOException $e)
	{
		$db->rollBack();
		echo("<p>ERROR: {$e->getMessage()}</p>");

		echo("<p></p>");

		if(isset($_REQUEST)){
            var_dump($_REQUEST);
        }

	}

?>
	<br><br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
</body>
</html>