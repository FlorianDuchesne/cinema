<?php

require_once "bdd/DAO.php";

class RealisateurController
{


  public function listRealisateurs()
  {
    $dao = new DAO();
    $sql = "SELECT id, CONCAT(prenom,' ', nom) AS nom_realisateur, sexe, DATE_FORMAT(dateNaissance, '%d/%m/%y') AS dateNaissance FROM Realisateur r";
    $reals = $dao->executerRequete($sql);
    require "views/realisateur/listRealisateurs.php";
  }

  public function findOneById($id)
  {

    $dao = new DAO;

    $sql = "SELECT r.id, CONCAT(r.prenom,' ',r.nom) AS identite, DATE_FORMAT(dateNaissance, '%d/%m/%y') AS dateNaissance, imgPath
            FROM realisateur r
            WHERE r.id= :id";
    $realisateur = $dao->executerRequete($sql, [":id" => $id]);




    require "views/realisateur/detailReal.php";
  }

  public function findAllById($id)
  {

    $dao = new DAO;

    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, f.imgPath FROM Film f, Realisateur r WHERE r.id = :id AND fk_realisateur_id = r.id ";
    $films = $dao->executerRequete($sql, [":id" => $id]);

    require "views/film/listFilms.php";
  }
}
