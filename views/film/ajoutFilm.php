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

</body>

</html>

<?php

ob_start();

?>

<section class="Inscription">
  <div class="form-wrapper">
    <h1>Inscription</h1>
    <form action="./index.php?action=checkAjoutActeur" method="post">
      <div class="form-item">
        <label for="titre"></label>
        <input type="text" name="titre" required="required" placeholder="titre du film"></input>
      </div>
      <div>
        <label for="sortie">Date de sortie du film :</label>
        <input type="date" id="sortie" name="sortie">
      </div>
      <div class="form-item">
        <label for="duree"></label>
        <input type="number" name="duree" required="required" placeholder="Durée du chiffre en minutes (chiffres uniquement)"></input>
      </div>
      <div class="form-item">
        <label for="note"></label>
        <input type="number" name="note" required="required" placeholder="note globale du film (chiffres uniquement)"></input>
      </div>
      <div class="form-item">
        <label for="resume"></label>
        <input type="text" name="resume" required="required" placeholder="résumé du film"></input>
      </div>
      <div>
        <label for="real">Réalisateur du film :</label>
        <select name="real" id="real">
          <?php
          while ($real = $reals->fetch()) {

            echo "<option value=" . $real['id'] . ">" . $real['nom_realisateur'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-item">
        <label for="imgPath"></label>
        <input type="text" name="imgPath" required="required" placeholder="imgPath"></input>
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

<?php

// $reals->closeCursor();
$titre = "ajout Realisateur";
$contenu = ob_get_clean();
require "./views/template.php";
