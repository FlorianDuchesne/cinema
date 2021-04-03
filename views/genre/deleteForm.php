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

  <p>

  <section class="Inscription">
    <div class="form-wrapper">
      <h1>Suppression d'un genre</h1>
      <form action="./index.php?action=checkDeleteGenre" method="post">
        <div>
          <label for="genre">genre :</label>
          <select name="genre" id="genre">
            <?php

            while ($genre = $genres->fetch()) {
              //   echo "<p>" . $genre["id"] . " " . $genre["libelle"] . "</p>";
              echo "<option value='" . $genre["id"] . "'>" . $genre["libelle"] . "</option>";
            }

            ?>

          </select>
        </div>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Valider" value="Valider"></input>
    </div>
    </form>
    </div>
  </section>

</body>

</html>

<?php

$genres->closeCursor();
$titre = "supprimer genre";
$contenu = ob_get_clean();
require "./views/template.php";
