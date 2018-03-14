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
			if(isset($_POST['taille'])){
				$plateau = (int)$_POST['taille'];

				if($plateau==9 OR $plateau==13 OR $plateau==19){
					echo "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 2343 2343\">";
					echo "<rect id=\"plateau\" x=\"0\" y=\"0\" width=\"2343\" height=\"2343\" />";

					$max = $plateau -1;
					$etoiles = array(0,0,0);

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

					echo "<a href=\"index.php\">Recommencer</a>";

					$test = true;
				}
			}
			if(!$test){
				?>
				<form method="post" action="index.php">
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
	</body>
</html>
