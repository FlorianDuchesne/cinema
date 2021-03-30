<?php

session_start();

ob_start();

?>

<h2 class="mt-4"> <?= $user['pseudo'] ?> Vous êtes bien connecté ! </h2>

<?php

$titre = "La liste de films";
$contenu = ob_get_clean();
require "./views/template.php";
