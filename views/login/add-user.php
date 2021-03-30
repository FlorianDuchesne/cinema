<?php

ob_start();

?>

<h2 class="mt-4">Vous êtes bien inscrit ! </h2>

<?php

$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
