<?php

ob_start();

?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/spiderman.jpg" class="d-block w-50" alt="image spiderman">
      <div class="carousel-caption d-none d-md-block">
        <h5>Découvrez les films de super héros de ce catalogue</h5>
        <a href="index.php?action=listfilmsGenres&id=2">Cliquez ici !</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img/spidermanhomecoming.jpg" class="d-block w-50" alt="image spiderman">
      <div class="carousel-caption d-none d-md-block">
        <h5>Découvrez le nouvel acteur de Spiderman</h5>
        <a href="index.php?action=detailActeur&id=10">Cliquez ici !</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img/samraimi.jpg" class="d-block w-50" alt="sam raimi">
      <div class="carousel-caption d-none d-md-block">
        <h5>Découvrez Sam Raimi</h5>
        <a href="index.php?action=detailRealisateur&id=6">Cliquez ici !</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php

$titre = "Page d'accueil de notre site";
$contenu = ob_get_clean();
require "views/template.php";
