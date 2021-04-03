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

  $castingActeur = $acteur->fetch();

  ?>

  <section class="Inscription">
    <div class="form-wrapper">
      <h1>nouveau casting</h1>
      <form action="./index.php?action=checkCastingActeur" method="post">
        <label for="id"></label>
        <input type="hidden" name="id" value="<?= $castingActeur['id'] ?>"></input>
        <div class="form-item">
          <h2>L'acteur <?= $castingActeur['identite'] ?></h2>
        </div>
        <div>
          <label for="film">a joué dans le film : </label>
          <select name="film" id="film">
            <?php
            while ($film = $films->fetch()) {
              echo "<option value='" . $film['id'] . "'>" . $film['titre'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="film">le rôle de : </label>
          <select name="role" id="film">
            <?php
            while ($role = $roles->fetch()) {
              echo "<option value='" . $role['id'] . "'>" . $role['personnage'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-item">
          <label for="personnage">Si le rôle n'est pas encore répertorié, rentrez-le ici :</label>
          <input type="text" name="personnage" placeholder="nom du personnage" />
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

// $reals->closeCursor();
$titre = "ajout Realisateur";
$contenu = ob_get_clean();
require "./views/template.php";
