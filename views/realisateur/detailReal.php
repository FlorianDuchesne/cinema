<?php

ob_start();

$detailReal = $realisateur->fetch();



?>

<h2><?= $detailReal['identite'] ?></h2>
<p> <?= $detailReal["dateNaissance"] ?> </p>
<p><img src=<?= $detailReal["imgPath"] ?>></p>

<?php
echo "<p><a href='index.php?action=listRealisateurfilms&id=" . $detailReal['id'] . "'>Voir la filmographie</a> de " . $detailReal['identite'] . "</p>";

echo "<div class='flex'><p><a href='index.php?action=deleteReal&id=" . $detailReal['id'] . "'onclick='alertReal()'><i class='fas fa-trash-alt'></i></a></p>";
echo "<p><a href='index.php?action=editReal&id=" . $detailReal['id'] . "'><i class='fas fa-edit'></i></a></p></div>";

?>


<?php

$realisateur->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
