<?php

ob_start();

?>

<h2>Affiches des films catalogués</h2>

<?php

while ($film = $films->fetch()) {
  echo "<p><a href='index.php?action=detailFilm&id=" . $film['id'] . "'>" . $film["titre"] . "</a></p>";
  echo "<figure><img src =" . $film["imgpath"] . "></img></figure>";
}

?>

<?php

$films->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
