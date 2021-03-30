<?php

require_once "bdd/DAO.php";

class ActeurController
{


  public function listActeurs()
  {
    $dao = new DAO();
    $sql = "SELECT id, CONCAT(prenom,' ', nom) AS nom_acteur, sexe, DATE_FORMAT(dateNaissance, '%d/%m/%y') AS dateNaissance FROM acteur a";
    $acteurs = $dao->executerRequete($sql);
    require "views/acteur/listActeurs.php";
  }

  public function findOneById($id)
  {

    $dao = new DAO;

    $sql = "SELECT id, CONCAT(prenom,' ',nom) AS identite, DATE_FORMAT(dateNaissance, '%d/%m/%y') AS dateNaissance, imgPath
            FROM Acteur a
            WHERE id= :id";
    $acteur = $dao->executerRequete($sql, [":id" => $id]);

    require "views/acteur/detailActeur.php";
  }

  public function findAllById($id)
  {

    $dao = new DAO;

    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, f.imgPath
            FROM Acteur a, Film f, casting c, Realisateur r
            WHERE a.id = :id AND fk_film_id = f.id AND fk_acteur_id = a.id AND fk_realisateur_id = r.id";
    $films = $dao->executerRequete($sql, [":id" => $id]);

    require "views/film/listFilms.php";
  }
}
