<?php include_once('config.php');
    include_once('data.php');
    echo '<ul>';
    for($i=0;$i<count($tabMenu);$i++)
        echo"<li>".$tabMenu[$i][m]."</li>";
    echo '</ul>';
?>        