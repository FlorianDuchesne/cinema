<?php

ob_start();

$detailActeur = $acteur->fetch();



?>

<h2><?= $detailActeur['identite'] ?></h2>
<p> <?= $detailActeur["dateNaissance"] ?> </p>
<p><img src=<?= $detailActeur["imgPath"] ?>></p>

<?php
echo "<p><a href='index.php?action=listActeurfilms&id=" . $detailActeur['id'] . "'>Voir la filmographie</a> de " . $detailActeur['identite'] . "</p>";
echo "<p><a href='index.php?action=castingActeur&id=" . $detailActeur['id'] . "'>rajouter l'acteur au casting d'un film</a></p>";

echo "<div class='flex'><p><a href='index.php?action=deleteActeur&id=" . $detailActeur['id'] . "'><i class='fas fa-trash-alt'></i></a></p>";
echo "<p><a href='index.php?action=editActeur&id=" . $detailActeur['id'] . "'><i class='fas fa-edit'></i></a></p></div>";

?>

<?php

$acteur->closeCursor();
$titre = "détail acteur";
$contenu = ob_get_clean();
require "./views/template.php";
