<?php

require_once "bdd/DAO.php";

class GenreController
{

  public function listGenres()
  {
    $dao = new DAO();
    $sql = "SELECT id, libelle FROM Genre g";
    $genres = $dao->executerRequete($sql);
    require "./views/genre/listGenres.php";
  }

  public function findAllById($id)
  {
    $dao = new DAO;
    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, GROUP_CONCAT( `libelle` SEPARATOR ' ' ) AS `genres` FROM Film f
LEFT JOIN realisateur r ON r.id = f.fk_realisateur_id LEFT JOIN est_classifié c ON c.fk_film_id = f.id LEFT JOIN Genre g ON g.id = c.fk_genre_id WHERE g.id = :id GROUP BY titre";
    $films = $dao->executerRequete($sql, [":id" => $id]);

    $sql2 = "SELECT g.id, g.libelle FROM Genre g WHERE g.id = :id";
    $genre = $dao->executerRequete($sql2, [":id" => $id]);
    require "views/genre/listFilms.php";
  }

  public function ajoutGenre()
  {
    require "./views/genre/form.php";
  }

  public function checkAjoutGenre($array)
  {


    $dao = new DAO();

    $sql = "INSERT INTO `Genre` (`libelle`) VALUES (:libelle) ";
    $genre = filter_var($array["genre"], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, ["libelle" => $genre]);


    header("Location: index.php?action=listGenres");
  }

  public function deleteGenreById($id)
  {
    $dao = new DAO();
    $sql = "DELETE FROM `Genre` WHERE `Genre`.`id` = :id";
    $delete = $dao->executerRequete($sql, ["id" => $id]);

    header("Location: index.php?action=listGenres");
  }

  public function editGenreById($id)
  {
    $dao = new DAO();
    $sql = "SELECT * FROM `Genre` WHERE `Genre`.`id` = :id";
    $edit = $dao->executerRequete($sql, ["id" => $id]);

    require "./views/genre/editForm.php";
  }

  public function checkEditGenre($array)
  {
    $dao = new DAO();
    $sql = "UPDATE `Genre` SET `libelle` = :libelle WHERE `Genre`.`id` = :id";

    $id = filter_var($array["id"], FILTER_SANITIZE_STRING);
    $libelle = filter_var($array["libelle"], FILTER_SANITIZE_STRING);
    $edit = $dao->executerRequete($sql, ["libelle" => $libelle, "id" => $id]);

    header("Location: index.php?action=listGenres");
  }

  public function ajouterFilmById($id)
  {
    $dao = new DAO();
    $sqlFilm = "SELECT * FROM Film WHERE id = :id";
    $sqlGenre = "SELECT * FROM Genre";
    $film = $dao->executerRequete($sqlFilm, ["id" => $id]);
    $genres = $dao->executerRequete($sqlGenre);

    require "./views/genre/addGenre.php";
  }

  public function checkGenreFilm($array)
  {
    // var_dump($array);
    $idFilm = filter_var($array["id"], FILTER_SANITIZE_STRING);
    $dao = new DAO();
    $i = 0;
    foreach ($array["genres"] as $value) {
      $idGenres[] = filter_var($value, FILTER_SANITIZE_STRING);
      $sql = "INSERT INTO `est_classifié`(`fk_film_id`, `fk_genre_id`) VALUES (:idFilm, :idGenre)";
      $ajoutGenre = $dao->executerRequete($sql, ["idFilm" => $idFilm, "idGenre" => $idGenres[$i]]);
      $i++;
    }
    // var_dump($idGenres);
    header("Location: index.php?action=listFilms");
  }
}
