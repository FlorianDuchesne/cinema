<?php

ob_start();

$detailActeur = $acteur->fetch();



?>

<h2><?= $detailActeur['identite'] ?></h2>
<p> <?= $detailActeur["dateNaissance"] ?> </p>
<p><img src=<?= $detailActeur["imgPath"] ?>></p>

<?php
echo "<p><a href='index.php?action=listActeurfilms&id=" . $detailActeur['id'] . "'>Voir la filmographie</a> de " . $detailActeur['identite'] . "</p>";
?>

<?php

$acteur->closeCursor();
$titre = "détail acteur";
$contenu = ob_get_clean();
require "./views/template.php";
