<?php

ob_start();

?>

<h2 class="mt-4">Affiches des réalisateurs catalogués</h2>

<table class="mt-4">
  <!-- <thead> -->
  <tr class="bg-secondary">
    <td class="px-3"><strong>nom</strong></td>
    <td class="px-3"><strong>sexe</strong></td>
    <td class="px-3"><strong>anniversaire</strong></td>
    <td></td>
    <td></td>
  </tr>
  <!-- </thead>
  <tbody> -->
  <?php

  while ($real = $reals->fetch()) {
    echo "<tr><td><a href='index.php?action=detailRealisateur&id=" . $real['id'] . "'>" . $real['nom_realisateur'] . "</a></td>";
    echo "<td>" . $real["sexe"] . "</td>";
    echo "<td>" . $real["dateNaissance"] . "</td>";
    echo "<td><figure><a href='index.php?action=deleteReal&id=" . $real['id'] . "'onclick='alertReal()'><i class='fas fa-trash-alt'></i></a></figure></td>";
    echo "<td><figure><a href='index.php?action=editReal&id=" . $real['id'] . "'><i class='fas fa-edit'></i></a></figure></td></tr>";
  }

  ?>


  </tbody>
</table>

<a href="index.php?action=ajoutReal"">ajouter un réalisateur</a>

<?php

$reals->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
