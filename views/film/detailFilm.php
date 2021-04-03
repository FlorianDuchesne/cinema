<?php

ob_start();

$detailFilm = $film->fetch();


?>

<h2><?= $detailFilm["titre"] ?></h2>
<p> <strong>année de sortie :</strong> <?= $detailFilm["sortie"] ?>
  <strong>durée : </strong><?= $detailFilm["duree"] ?>
  <strong>réalisateur : </strong><a href='index.php?action=detailRealisateur&id= <?= $detailFilm['fk_realisateur_id'] ?> '> <?= $detailFilm['nom_realisateur'] ?></a>
  <strong> note : </strong><?= $detailFilm["note"] ?>
  <strong>genre(s) : </strong><a href='index.php?action=listGenres'><?= $detailFilm['genres'] ?></a>
</p>
<div class="flex container">
  <p><img src=<?= $detailFilm["imgPath"] ?>></p>
  <div>
    <p> <?= $detailFilm["resume"] ?> </p>
    <p> <strong>Casting : </strong>
      <?php
      while ($casting = $castings->fetch()) {
        echo "<a href='index.php?action=detailActeur&id=" . $casting["id_acteur"] . "'>" . $casting["nom_acteur"] . "</a>"
          . " dans le rôle de " .
          $casting["nom_personnage"] . " ";
      }
      ?>
    </p>
  </div>
</div>


<?php

$film->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
