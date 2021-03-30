<?php

require_once "bdd/DAO.php";

class FilmController
{


  public function listFilms()
  {
    $dao = new DAO();
    // $sql = "SELECT titre, sortie, duree, `resume`, note FROM film f";
    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur FROM film f INNER JOIN realisateur r ON r.id = f.fk_realisateur_id ORDER BY titre DESC ";

    $films = $dao->executerRequete($sql);
    require "./views/film/listFilms.php";
  }

  public function listPics()
  {
    $dao = new DAO();
    $sql = "SELECT id, titre, imgpath FROM film f";
    $films = $dao->executerRequete($sql);
    require "./views/film/listPics.php";
  }

  public function findOneById($id)
  {
    $dao = new DAO;

    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, note, f.imgPath, `resume` FROM film f INNER JOIN realisateur r ON r.id = f.fk_realisateur_id
            WHERE f.id= :id";
    $film = $dao->executerRequete($sql, [":id" => $id]);
    $sqlCasting = "SELECT a.id AS id_acteur, r.id, CONCAT(a.prenom,' ',a.nom) AS nom_acteur, r.personnage AS nom_personnage FROM `Film` f, casting c, Acteur a, Role r WHERE f.id = :id AND a.id = c.fk_acteur_id AND f.id = c.fk_film_id AND r.id = c.fk_role_id";
    $castings = $dao->executerRequete($sqlCasting, [":id" => $id]);

    require "views/film/detailFilm.php";
  }
}
