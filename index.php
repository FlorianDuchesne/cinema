<?php
require_once "controllers/AccueilController.php";
require_once "controllers/FilmController.php";
require_once "controllers/ActeurController.php";
require_once "controllers/RealisateurController.php";
require_once "controllers/GenreController.php";
require_once "controllers/LogController.php";

$ctrlFilm = new FilmController;
$ctrlActeur = new ActeurController;
$ctrlAccueil = new AccueilController;
$ctrlRealisateur = new RealisateurController;
$ctrlGenre = new GenreController;
$ctrlLog = new LogController;
$ajoutFilm = false;

if (isset($_GET['action'])) {
  if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
  }

  switch ($_GET['action']) {

    case "listFilms":
      $ctrlFilm->listFilms();
      break;
    case "listPics":
      $ctrlFilm->listPics();
      break;
    case "listGenres":
      $ctrlGenre->listGenres();
      break;
    case "listActeurs":
      $ctrlActeur->listActeurs();
      break;
    case "listRealisateurs":
      $ctrlRealisateur->listRealisateurs($ajoutFilm);
      break;
    case "detailRealisateur":
      // $id = ($_GET["id"]);
      $ctrlRealisateur->findOneById($id);
      break;
    case "detailFilm":
      // $id = ($_GET["id"]);
      $ctrlFilm->findOneById($id);
      break;
    case "detailActeur":
      // $id = ($_GET["id"]);
      $ctrlActeur->findOneById($id);
      break;
    case "listfilmsGenres":
      // $id = ($_GET["id"]);
      $ctrlGenre->findAllById($id);
      break;
    case "listActeurfilms":
      // $id = ($_GET["id"]);
      $ctrlActeur->findAllbyId($id);
      break;
    case "listRealisateurfilms":
      // $id = ($_GET["id"]);
      $ctrlRealisateur->findAllbyId($id);
      break;
    case "login":
      $ctrlLog->login();
      break;
    case "signup":
      $ctrlLog->signup();
      break;
    case "add-user":
      $ctrlLog->checkSignup($_POST);
      break;
    case "log":
      $ctrlLog->checkLogin($_POST);
      break;
    case "checkout":
      $ctrlLog->checkout();
      break;
    case "ajoutReal":
      $ctrlRealisateur->ajoutReal();
      break;
    case "checkAjoutReal":
      $ctrlRealisateur->checkAjoutReal($_POST);
      break;
    case "ajoutGenre":
      $ctrlGenre->ajoutGenre();
      break;
    case "checkAjoutGenre":
      $ctrlGenre->checkAjoutGenre($_POST);
      break;
    case "ajoutActeur":
      $ctrlActeur->ajoutActeur();
      break;
    case "checkAjoutActeur":
      $ctrlActeur->checkAjoutActeur($_POST);
      break;
    case "deleteGenre":
      $ctrlGenre->deleteGenreById($id);
      break;
    case "deleteReal":
      $ctrlRealisateur->deleteRealById($id);
      break;
    case "editReal":
      $ctrlRealisateur->editRealById($id);
      break;
    case "checkEditReal":
      $ctrlRealisateur->checkEditReal($_POST);
      break;
    case "deleteActeur":
      $ctrlActeur->deleteActeurById($id);
      break;
    case "editActeur":
      $ctrlActeur->editActeurById($id);
      break;
    case "checkEditActeur":
      $ctrlActeur->checkEditActeur($_POST);
      break;
    case "editGenre":
      $ctrlGenre->editGenreById($id);
      break;
    case "checkEditGenre":
      $ctrlGenre->checkEditGenre($_POST);
      break;
    case "castingActeur":
      $ctrlActeur->ajoutCasting($id);
      break;
    case "checkCastingActeur":
      $ctrlActeur->checkCasting($_POST);
      break;
    case "lierGenreFilm":
      $ctrlGenre->ajouterFilmById($id);
      break;
    case "checkGenreFilm":
      $ctrlGenre->checkGenreFilm($_POST);
      break;
    case "ajoutFilm":
      $ajoutFilm = true;
      $ctrlRealisateur->listRealisateurs($ajoutFilm);
      break;
    case "checkAjoutFilm":
      $ctrlFilm->checkAjoutFilm($_POST);
      break;
    case "editFilm":
      $ctrlFilm->editFilm($id);
      break;
    case "checkEditFilm":
      $ctrlFilm->checkEditFilm($_POST);
      break;
    case "deleteFilm":
      $ctrlFilm->deleteFilm($id);
      break;
    case "deleteCasting":
      $idFilm = filter_input(INPUT_GET, "idfilm", FILTER_SANITIZE_STRING);
      $idActeur = filter_input(INPUT_GET, "idacteur", FILTER_SANITIZE_STRING);
      $ctrlActeur->deleteCasting($idFilm, $idActeur);
      break;
  }
} else {
  $ctrlAccueil->pageAccueil();
}
