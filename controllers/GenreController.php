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
    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur FROM Film f, `est_classifié`, Genre g, Realisateur r WHERE g.id=:id AND `fk_film_id` = f.id AND `fk_genre_id` = g.id AND `fk_realisateur_id` = r.id ";
    $films = $dao->executerRequete($sql, [":id" => $id]);
    require "views/film/listFilms.php";
  }
}
