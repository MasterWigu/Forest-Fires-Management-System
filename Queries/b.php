<html>
    <meta charset="UTF-8">
	<body>
<?php

	function parseentidademeio($entidademeio) {
		$array = explode(',', $entidademeio);



	}




	$tipo = $_REQUEST['tipo'];

	try {

		$host = "db.ist.utl.pt";
		$user ="ist187689";
		$password = "amarelo23";
		$dbname = $user;
		$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		if ($tipo == 1) { #adicionar combate
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "INSERT INTO meiocombate VALUES (:nummeio, :nomeentidade)";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} adicionado com sucesso a lista de meios de combate.");

		}


		elseif ($tipo == 2) { #remover combate
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "DELETE FROM meiocombate WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} removido com sucesso da lista de meios de combate.");

		}


		elseif ($tipo == 3) { #modificar combate
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];
			$nomemeio = $_REQUEST['nomemeio'];


			$sql = "UPDATE meio SET nomemeio = :nomemeio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} editado com sucesso.");
			
		}


		elseif ($tipo == 4) { #adicionar apoio
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "INSERT INTO meioapoio VALUES (:nummeio, :nomeentidade)";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} adicionado com sucesso a lista de meios de apoio.");
			
		}


		elseif ($tipo == 5) { #remover apoio
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "DELETE FROM meioapoio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} removido com sucesso da lista de meios de apoio.");
			
		}

		elseif ($tipo == 6) { #modificar apoio
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];
			$nomemeio = $_REQUEST['nomemeio'];


			$sql = "UPDATE meio SET nomemeio = :nomemeio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} editado com sucesso.");
			
		}


		elseif ($tipo == 7) { #adicionar socorro
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "INSERT INTO meiosocorro VALUES (:nummeio, :nomeentidade)";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} adicionado com sucesso a lista de meios de socorro.");
			
		}


		elseif ($tipo == 8) { #remover socorro
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];

			$sql = "DELETE FROM meiosocorro WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} removido com sucesso da lista de meios de socorro.");
			
		}

		else { #modificar socorro
			$entidademeio = $_REQUEST['entidademeio'];
			$array = explode(',', $entidademeio);
			$nomeentidade = $array[0];
			$nummeio = $array[1];
			$nomemeio = $_REQUEST['nomemeio'];


			$sql = "UPDATE meio SET nomemeio = :nomemeio WHERE nummeio = :nummeio AND nomeentidade = :nomeentidade";

       		$result = $db->prepare($sql);

        	$result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nomeentidade' => $nomeentidade]);

        	echo("Meio numero {$nummeio} da entidade {$nomeentidade} editado com sucesso.");
			
		}


		$db = null;
	}

	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");

		echo("<p></p>");

		if(isset($_REQUEST)){
            var_dump($_REQUEST);
        }

	}

?>
	<br>
    <button onclick="location.href = 'menu.php';">Voltar</button>
</body>
</html>