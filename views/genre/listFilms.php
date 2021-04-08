<?php

ob_start();



$detailGenre = $genre->fetch();

?>
<p></p>

<h4><?= $detailGenre["libelle"] ?>
</h4>
<h3 class="mt-4">Il y a : <?= $films->rowCount(); ?> films</h3>

<table class="col-8 d-flex flex-column align-items-center mt-4">
  <!-- <thead> -->
  <tr class="bg-secondary">
    <td><strong>titre</strong></td>
    <td class="px-3"><strong>sortie</strong></td>
    <td class="px-3"><strong>durée</strong></td>
    <td><strong>réalisateur</strong></td>
    <td><strong>genre(s)</strong></td>
  </tr>
  <!-- </thead>
  <tbody> -->
  <?php

  while ($film = $films->fetch()) {
    echo "<tr><td><a href='index.php?action=detailFilm&id=" . $film['id'] . "'>" . $film["titre"] . "</a></td>";
    echo "<td>" . $film["sortie"] . "</td>";
    echo "<td>" . $film["duree"] . "</td>";
    echo "<td><a href='index.php?action=detailRealisateur&id=" . $film['fk_realisateur_id'] . "'>" . $film['nom_realisateur'] . "</a></td>";
    echo "<td>" . $film['genres'] . "</td></tr>";
  }

  ?>


  </tbody>
</table>
<p></p>
<?php
echo "<p><a href='index.php?action=deleteGenre&id=" . $detailGenre['id'] . "'>Supprimer le genre " . $detailGenre['libelle'] . "</a></p>";
?>

<?php

$films->closeCursor();
$titre = "La liste de films par genre";
$contenu = ob_get_clean();
require "./views/template.php";
