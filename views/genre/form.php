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

  ?>

  <section class="Inscription">
    <div class="form-wrapper">
      <h1>Ajout genre</h1>
      <form action="./index.php?action=checkAjoutGenre" method="post">
        <div class="form-item">
          <label for="genre"></label>
          <input type="text" name="genre" required="required" placeholder="Genre à ajouter"></input>
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
$titre = "ajout Genre";
$contenu = ob_get_clean();
require "./views/template.php";
