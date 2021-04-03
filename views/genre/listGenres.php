<?php

ob_start();

?>

<h2 class="mt-4">Liste des genres</h2>

<table class="mt-4">
  <thead>
    <tr class="bg-secondary">
      <th>genre</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php

    while ($genre = $genres->fetch()) {
      echo "<tr><td><a href='index.php?action=listfilmsGenres&id=" . $genre['id'] . "'>" . $genre["libelle"] . "</a></td>";
      echo "<td><figure><a href='index.php?action=deleteGenre&id=" . $genre['id'] . "'><i class='fas fa-trash-alt'></i></a></figure></td>";
      echo "<td><figure><a href='index.php?action=editGenre&id=" . $genre['id'] . "'><i class='fas fa-edit'></i></a></figure></td></tr>";
    }

    ?>


  </tbody>
</table>
<p></p>
<p><a href="index.php?action=ajoutGenre"">ajouter un genre</a></p>

<?php

$genres->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
