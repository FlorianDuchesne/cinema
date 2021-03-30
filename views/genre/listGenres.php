<?php

ob_start();

?>

<h2 class="mt-4">Liste des genres</h2>

<table class="mt-4">
  <thead>
    <tr class="bg-secondary">
      <th>genre</th>
    </tr>
  </thead>
  <tbody>
    <?php

    while ($genre = $genres->fetch()) {
      echo "<tr><td><a href='index.php?action=listfilmsGenres&id=" . $genre['id'] . "'>" . $genre["libelle"] . "</a></td></tr>";
    }

    ?>


  </tbody>
</table>

<?php

$genres->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
