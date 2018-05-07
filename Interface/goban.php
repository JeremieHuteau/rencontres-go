<?php

echo "lel";
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$dbh = (new connexionDB())->db;
		try {
			$stmt = $dbh->prepare("SELECT Taille FROM Partie WHERE ID = :id");
			$parameters = array(
				"id" => $_GET["id"]
			);
			$stmt->execute($parameters);
			$taille = $stmt->fetch(PDO::FETCH_ASSOC)["Taille"];

			include_once('goban.php');
			Plateau($taille);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	function Plateau($plateau){
		echo "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 2343 2343\">";
		echo "<rect id=\"plateau\" x=\"0\" y=\"0\" width=\"2343\" height=\"2343\" />";
		$max = $plateau -1;
		$etoiles = array(0,0,0);
			/*Pour dessiner les lignes on utilise la varible position, par exemple sur du 9x9, on veut une ligne à 0,
			et à chaque 8eme du plateau.*/
			/*J'enregistre certaines valeurs de pôsition dans etoiles pour mettre les etoiles aux bonnes intersection.
			Pour du 9x9 il n'y a que 4 étoiles, sur les 3eme lignes en diagonale depuis les coins, alors que pour 13 et 19,
			il y a 9 étoiles, à 4 lignes en diagonale depuis les coins, au milieu de chaque côté du carré dessiné par les étoiles
			et au plein centre du goban*/
			echo "<ellipse id='previewPion' cx='0' cy='0' rx='50' ry='50' style='opacity:0.5'/>";
		for($colonne = 0; $colonne <= $max; $colonne++){
			$position = 60 + $colonne * 2223 / $max;
			echo "<line x1=\"$position\"  y1=\"60\" x2=\"$position\"  y2=\"2283\" />";
			echo "<line x1=\"60\"  y1=\"$position\" x2=\"2283\"  y2=\"$position\" />";
			if($plateau==9){
				$etoiles[0] = ($colonne==2) ? $position : $etoiles[0];
				$etoiles[1] = ($colonne==6) ? $position : $etoiles[1];
				if($colonne==$max){
					echo '<ellipse cx="'.$etoiles[0].'" cy="'.$etoiles[0].'" rx="15" ry="15" />';
					echo '<ellipse cx="'.$etoiles[0].'" cy="'.$etoiles[1].'" rx="15" ry="15" />';
					echo '<ellipse cx="'.$etoiles[1].'" cy="'.$etoiles[0].'" rx="15" ry="15" />';
					echo '<ellipse cx="'.$etoiles[1].'" cy="'.$etoiles[1].'" rx="15" ry="15" />';
				}
			}
			else{
				$etoiles[0] = ($colonne==3) ? $position : $etoiles[0];
				$etoiles[1] = ($colonne==$max/2) ? $position : $etoiles[1];
				$etoiles[2] = ($colonne==$max-3) ? $position : $etoiles[2];
				if($colonne==$max){
					echo '<ellipse id="ellipse" cx="'.$etoiles[0].'" cy="'.$etoiles[0].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[0].'" cy="'.$etoiles[1].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[0].'" cy="'.$etoiles[2].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[1].'" cy="'.$etoiles[0].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[1].'" cy="'.$etoiles[1].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[1].'" cy="'.$etoiles[2].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[2].'" cy="'.$etoiles[0].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[2].'" cy="'.$etoiles[1].'" rx="10" ry="10" />';
					echo '<ellipse cx="'.$etoiles[2].'" cy="'.$etoiles[2].'" rx="10" ry="10" />';
				}
			}
		}
		echo "</svg>";

		echo '<script src="../JS/goban.js" charset="utf-8"></script>';
		echo "<script type='text/javascript'>var goban = new GobanController($plateau);</script>";

		return true;
	}


?>
