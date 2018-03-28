<!DOCTYPE html>
<html>
	<head>
		<title>Ilebomonplato</title>
		<link rel="stylesheet" href="../CSS/try.css" />
		<link rel="stylesheet" href="../CSS/goban.css" />
	</head>

						<!--Alors oui, j'ai du mettre deux pages CSS différentes, je sais pas si ça vient de mon wamp,
						mais ça ne marche pas si je les rassemble-->


	<body>
		<?php
			$test = false;

				/*Test est là pour vérifier si le goban a été dessiné ou non. Si non, on affiche le formulaire*/

			if(isset($_POST['taille']) && ($_POST['taille']==9 OR $_POST['taille']==13 OR $_POST['taille']==19)){
				$test = Plateau((int)$_POST['taille']);
			}
			
			if(!$test){
				Formulaire();
			}
		?>
	</body>
</html>


<?php 
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
					echo '<ellipse cx="'.$etoiles[0].'" cy="'.$etoiles[0].'" rx="10" ry="10" />';
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

			/*Un lien pour pouvoir réessayer sans avoir à réecrire l'url à chaque essai.
			Si le goban a été dessiné, on met test à true, pour empecher le formulaire de s'afficher*/

		echo "<a href=\"index.php\">Recommencer</a>";

		return true;
	}

	function Formulaire(){
	?>
		<form method="post" action="goban.php">
			<p>Sélectionnez la taille de goban désirée :<br/>
			<input type="radio" name="taille" value="9" id="9"/><label for="9">9x9</label><br/>
			<input type="radio" name="taille" value="13" id="13"/><label for="13">13x13</label><br/>
			<input type="radio" name="taille" value="19" id="19"/><label for="19">19x19</label>
			</p>

			<input type="submit" value="Valider"/>
		</form>
	<?php
	}	
?>