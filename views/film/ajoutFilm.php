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
    <h1>nouveau film</h1>
    <form action="./index.php?action=checkAjoutFilm" method="post">
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
        <input type="number" name="duree" min="0" required="required" placeholder="Durée du chiffre en minutes (chiffres uniquement)"></input>
      </div>
      <div class="form-item">
        <label for="note"></label>
        <input type="number" name="note" min="0" max="5" required="required" placeholder="note globale du film (chiffres uniquement)"></input>
      </div>
      <div class="form-item">
        <label for="resume"></label>
        <textarea type="text" name="resume" required="required" style="padding: 0.5em">résumé du film</textarea>
      </div>
      <div class="form-item m-3">
        <p>Genre(s) du film : </p>
        <?php
        while ($genre = $genres->fetch()) {
        ?>
          <input type="checkbox" name="genres[]" class="checkbox" id="<?= $genre['id'] ?>" value="<?= $genre['id'] ?>">
          <label for="genre"> <?= $genre['libelle'] ?> </label>
        <?php
        }
        ?>
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

      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button my-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Rajouter un nouveau réalisateur
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="form-item">
                <label for="prenom"></label>
                <input type="text" name="prenom" placeholder="Prénom du réalisateur"></input>
              </div>
              <div class="form-item">
                <label for="nom"></label>
                <input type="text" name="nom" placeholder="Nom du réalisateur"></input>
              </div>
              <div>
                <label for="sexe">Sexe du réalisateur :</label>
                <select name="sexe" id="sexe">
                  <option value="masculin">masculin</option>
                  <option value="feminin">feminin</option>
                </select>
              </div>
              <div>
                <label for="dateNaissance">Date de naissance du réalisateur :</label>
                <input type="date" id="dateNaissance" name="dateNaissance">
              </div>
              <div class="form-item">
                <label for="imgPath"></label>
                <input type="text" name="imgPathReal" placeholder="imgPath réalisateur"></input>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-item">
        <label for="imgPath"></label>
        <input type="text" name="imgPathFilm" required="required" placeholder="imgPath film"></input>
      </div>
  </div>
  <div class="button-panel">
    <input type="submit" class="button" title="Valider" value="Valider"></input>
  </div>
  </form>
  <!-- <div class="form-footer">
    <p><a href="#">Déjà membre ? <br /> connectez-vous</a></p>
  </div> -->
</section>

<?php

$titre = "ajout Realisateur";
$contenu = ob_get_clean();
require "./views/template.php";
