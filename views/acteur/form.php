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
        <label for="prenom"></label>
        <input type="text" name="prenom" required="required" placeholder="Prénom de l'acteur"></input>
      </div>
      <div class="form-item">
        <label for="nom"></label>
        <input type="text" name="nom" required="required" placeholder="Nom de l'acteur"></input>
      </div>
      <div>
        <label for="sexe">Sexe de l'acteur :</label>
        <select name="sexe" id="sexe">
          <option value="masculin">masculin</option>
          <option value="feminin">feminin</option>
        </select>
      </div>
      <label for="dateNaissance">Date de naissance de l'acteur :</label>
      <input type="date" id="dateNaissance" name="dateNaissance">
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
