<?php

ob_start();

?>

<h2 class="mt-4">Liste des acteurs et actrices catalogués</h2>

<table class="mt-4">
  <!-- <thead> -->
  <tr class="bg-secondary">
    <td class="px-3"><strong>nom</strong></td>
    <td class="px-3"><strong>genre</strong></td>
    <td class="px-3"><strong>anniversaire</strong></td>
    <td class="px-3"></td>
    <td class="px-3"></td>
  </tr>

  <!-- </thead>
  <tbody> -->
  <?php

  while ($acteur = $acteurs->fetch()) {

    echo "<tr><td><a href='index.php?action=detailActeur&id=" . $acteur['id'] . "'>" . $acteur["nom_acteur"] . "</a></td>";
    echo "<td>" . $acteur["sexe"] . "</td>";
    echo "<td>" . $acteur["dateNaissance"] . "</td>";
    echo "<td><figure><a href='index.php?action=deleteActeur&id=" . $acteur['id'] . "'onclick='alertReal()'><i class='fas fa-trash-alt'></i></a></figure></td>";
    echo "<td><figure><a href='index.php?action=editActeur&id=" . $acteur['id'] . "'><i class='fas fa-edit'></i></a></figure></td></tr>";
  }

  ?>

  </tbody>
</table>

<p></p>
<p><a href="index.php?action=ajoutActeur"">ajouter un acteur ou une actrice</a></p>

<?php

$acteurs->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
