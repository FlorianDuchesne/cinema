<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/signup.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>

<body>

</body>

</html>

<?php

ob_start();

$detailFilm = $film->fetch();


?>

<section class="Inscription">
  <div class="form-wrapper">
    <h1>modification film</h1>
    <form action="./index.php?action=checkEditFilm" method="post">
      <label for="id"></label>
      <input type="hidden" name="id" value="<?= $detailFilm['id'] ?>"></input>
      <div class="form-item m-3">
        <label for="titre">titre du film</label>
        <input type="text" name="titre" value="<?= $detailFilm['titre'] ?>"></input>
      </div>
      <div class="form-item m-3">
        <label for="sortie">date de sortie</label>
        <input type="date" name="sortie" value="<?= $detailFilm['sortie'] ?>"></input>
      </div>
      <div class="form-item m-3">
        <label for="duree">durée du film en minutes</label>
        <input type="number" name="duree" min="0" value="<?= $detailFilm['duree'] ?>"></input>
      </div>
      <div class="form-item m-3">
        <label for="note">note du film</label>
        <input type="number" name="note" min="0" max="5" value="<?= $detailFilm['note'] ?>"></input>
      </div>
      <div class="form-item m-3">
        <label for="real">réalisateur :</label>
        <select name="real" id="real">
          <?php
          while ($real = $reals->fetch()) {
          ?>
            <option value='<?= $real['id'] ?>' <?php
                                                if ($detailFilm['fk_realisateur_id'] === $real['id']) {
                                                  echo "selected";
                                                }
                                                ?>><?= $real['nom_real'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="form-item m-3">
        <p>Genre(s) du film : </p>
        <?php
        $tableauGenres = [];
        // var_dump($genresFilm->fetchAll());
        while ($genreFilm = $genresFilm->fetch()) {
          $tableauGenres[] = $genreFilm['id'];
          // var_dump($tableauGenres);
        }
        while ($genre = $genres->fetch()) {
        ?>
          <input type="checkbox" name="genres[]" class="checkbox" id="<?= $genre['id'] ?>" value="<?= $genre['id'] ?>" <?php
                                                                                                                        if (in_array($genre['id'], $tableauGenres)) {
                                                                                                                          echo "checked";
                                                                                                                        }
                                                                                                                        ?>>
          <label for="genres"> <?= $genre['libelle'] ?> </label>
        <?php
        }
        ?>
      </div>
      <div class="form-item">
        <label for="imgPath">imgPath du film :</label>
        <input type="text" name="imgPath" value="<?= $detailFilm['imgPath'] ?>"></input>
      </div>
      <div class="form-item">
        <label for="resume">résumé du film : </label>
        <textarea type="text" name="resume" rows="10" cols="35" style="padding: 0.5em"><?= $detailFilm['resume'] ?></textarea>
      </div>
  </div>
  <div class="button-panel">
    <input type="submit" class="button" title="Valider" value="Valider"></input>
  </div>
  </form>
</section>


<?php

$film->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
