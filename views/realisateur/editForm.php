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

  $detailReal = $edit->fetch();

  ?>

  <section class="Inscription">
    <div class="form-wrapper">
      <h1>Edition</h1>
      <form action="./index.php?action=checkEditReal" method="post">
        <label for="id"></label>
        <input type="hidden" name="id" value="<?= $detailReal['id'] ?>"></input>
        <div class="form-item">
          <label for="prenom"></label>
          <input type="text" name="prenom" value="<?= $detailReal['prenom'] ?>"></input>
        </div>
        <div class="form-item">
          <label for="nom"></label>
          <input type="text" name="nom" value="<?= $detailReal['nom'] ?>"></input>
        </div>
        <div>
          <label for="sexe">Sexe du réalisateur :</label>
          <select name="sexe" id="sexe">
            <option value="masculin">masculin</option>
            <option value="feminin">feminin</option>
          </select>
        </div>
        <label for="dateNaissance">Date de naissance du réalisateur :</label>
        <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $detailReal['dateNaissance'] ?>">
        <div class="form-item">
          <label for="imgPath"></label>
          <input type="text" name="imgPath" value="<?= $detailReal['imgPath'] ?>"></input>
        </div>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Valider" value="Valider"></input>
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

// $reals->closeCursor();
$titre = "ajout Realisateur";
$contenu = ob_get_clean();
require "./views/template.php";
