<?php

ob_start();

?>

<h3 class="mt-4">Il y a : <?= $films->rowCount(); ?> films</h3>

<table class="col-8 d-flex flex-column align-items-center mt-4">
  <!-- <thead> -->
  <tr class="bg-secondary">
    <td><strong>titre</strong></td>
    <td><strong>réalisateur</strong></td>
    <td class="col-3"><strong>rôle</strong></td>
    <td></td>
  </tr>
  <!-- </thead>
  <tbody> -->
  <?php
  // var_dump($films->fetch());

  while ($film = $films->fetch()) {
    echo "<tr><td><a href='index.php?action=detailFilm&id=" . $film['id_film'] . "'>" . $film["titre"] . "</a></td>";
    echo "<td><a href='index.php?action=detailRealisateur&id=" . $film['fk_realisateur_id'] . "'>" . $film['nom_realisateur'] . "</a></td>";
    echo "<td>" . $film['personnage'] . "</td>";
    echo "<td><figure><a href='index.php?action=deleteCasting&idfilm=" . $film['id_film'] . "&idacteur=" . $film['id_acteur'] . "'><i class='fas fa-trash-alt'></i></a></figure></td>";
  }
  ?>


  </tbody>
</table>

<p></p>
<?php
$acteur = $acteur->fetch();
echo "<a href='index.php?action=castingActeur&id=" . $acteur['id_acteur'] . "'>Ajouter un casting</a>";
$films->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
