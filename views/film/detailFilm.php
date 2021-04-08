<?php

ob_start();

$detailFilm = $film->fetch();

?>

<h2><?= $detailFilm["titre"] ?></h2>
<p> <strong>année de sortie :</strong> <?= $detailFilm["sortie"] ?>
  <strong>durée : </strong><?= $detailFilm["duree"] ?>
  <strong>réalisateur : </strong><a href='index.php?action=detailRealisateur&id= <?= $detailFilm['fk_realisateur_id'] ?> '> <?= $detailFilm['nom_realisateur'] ?></a>
  <strong> note : </strong><?= $detailFilm["note"] ?>
  <strong>genre(s) : </strong>
  <?php
  while ($genre = $genres->fetch()) {
    echo "<a href='index.php?action=listfilmsGenres&id=" . $genre["id"] . "'>" . $genre["libelle"] . "</a>";
    echo " ";
  }
  ?>
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
      <br><small>(pour ajouter ou modifier un casting, aller sur la fiche de l'acteur concerné)</small>
    </p>
    <div class="d-flex flex-column m-3">
      <a href="index.php?action=lierGenreFilm&id=<?= $detailFilm['id'] ?>">attribuer un genre au film</a>
      <a class="p-3" href="index.php?action=editFilm&id=<?= $detailFilm['id'] ?>"><i class='fas fa-edit'></i>modifier les informations du film</a>
      <a href="index.php?action=deleteFilm&id=<?= $detailFilm['id'] ?>" onclick=' alertReal()'><i class='fas fa-trash-alt'></i>supprimer le film</a>
    </div>
  </div>
</div>



<?php

$film->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
