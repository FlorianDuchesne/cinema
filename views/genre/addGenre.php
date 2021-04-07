<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/signup.css">
  <title>Document</title>
</head>

<body>

  <?php

  ob_start();

  $film = $film->fetch();

  ?>

  <section class="Inscription">
    <div class="form-wrapper">
      <h1><?= $film['titre'] ?></h1>
      <h2> s'inscrit dans le ou les genre(s) : </h2>
      <form action="./index.php?action=checkGenreFilm" method="post">
        <label for="id"></label>
        <input type="hidden" name="id" value="<?= $film['id'] ?>"></input>
        <div>
          <li>
            <?php
            while ($genre = $genres->fetch()) {
            ?>
              <ul>
                <label for="genre"> <?= $genre['libelle'] ?> </label>
                <input type="checkbox" name="genres[]" id="<?= $genre['id'] ?>" value="<?= $genre['id'] ?>">
              </ul>
            <?php
            }
            ?>
          </li>
        </div>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Valider" value="Valider" />
    </div>
    </form>
    <!-- <div class="form-footer">
    <p><a href="#">Déjà membre ? <br /> connectez-vous</a></p>
  </div> -->
    </div>
  </section>

</body>

</html>


<?php

$titre = "ajout Realisateur";
$contenu = ob_get_clean();
require "./views/template.php";
