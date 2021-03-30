<?php

ob_start();

$detailReal = $realisateur->fetch();



?>

<h2><?= $detailReal['identite'] ?></h2>
<p> <?= $detailReal["dateNaissance"] ?> </p>
<p><img src=<?= $detailReal["imgPath"] ?>></p>

<?php
echo "<p><a href='index.php?action=listRealisateurfilms&id=" . $detailReal['id'] . "'>Voir la filmographie</a> de " . $detailReal['identite'] . "</p>";
?>


<?php

$realisateur->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
