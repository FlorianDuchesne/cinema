<?php

require_once "bdd/DAO.php";

class RealisateurController
{


  public function listRealisateurs($ajoutFilm)
  {
    $dao = new DAO();
    $sql = "SELECT id, CONCAT(prenom,' ', nom) AS nom_realisateur, sexe, DATE_FORMAT(dateNaissance, '%d/%m/%y') AS dateNaissance FROM Realisateur r";
    $reals = $dao->executerRequete($sql);
    if (!$ajoutFilm) {
      require "views/realisateur/listRealisateurs.php";
    } else {
      $sqlGenres = "SELECT * FROM Genre";
      $genres = $dao->executerRequete($sqlGenres);
      require "views/film/ajoutFilm.php";
    }
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

    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, GROUP_CONCAT( `libelle` SEPARATOR ' ' ) AS `genres` FROM Film f LEFT JOIN realisateur r ON r.id = f.fk_realisateur_id LEFT JOIN est_classifié c ON c.fk_film_id = f.id LEFT JOIN Genre g ON g.id = c.fk_genre_id WHERE r.id = :id GROUP BY titre";
    $films = $dao->executerRequete($sql, [":id" => $id]);

    require "views/film/listFilms.php";
  }

  public function ajoutReal()
  {

    require "views/realisateur/form.php";
  }

  public function checkAjoutReal($array)
  {

    $dao = new DAO();

    $sql = "INSERT INTO `Realisateur`(`nom`, `prenom`, `sexe`, `dateNaissance`, `imgPath`) VALUES (:nom, :prenom, :sexe, :dateNaissance, :imgPath)";

    $nom = filter_var($array['nom'], FILTER_SANITIZE_STRING);
    $prenom = filter_var($array['prenom'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);
    $imgPath = filter_var($array['imgPath'], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, ["nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "dateNaissance" => $dateNaissance, "imgPath" => $imgPath]);

    header("Location: index.php?action=listRealisateurs");
  }

  public function deleteRealById($id)
  {

    $dao = new DAO();
    $sqlFilms = "DELETE FROM `Film` WHERE `fk_realisateur_id`= :id";
    $sqlReal = "DELETE FROM `Realisateur` WHERE `Realisateur`.`id` = :id";
    $deleteFilms = $dao->executerRequete($sqlFilms, ["id" => $id]);
    $deleteReal = $dao->executerRequete($sqlReal, ["id" => $id]);

    header("Location: index.php?action=listRealisateurs");
  }

  public function editRealById($id)
  {
    $dao = new DAO();
    $sql = "SELECT * FROM `Realisateur` WHERE `Realisateur`.`id` = :id";
    $edit = $dao->executerRequete($sql, ["id" => $id]);
    require "views/realisateur/editForm.php";
  }

  public function checkEditReal($array)
  {

    $dao = new DAO();
    $sql = "UPDATE `Realisateur` SET `nom` = :nom, `prenom` = :prenom, `sexe` = :sexe, `dateNaissance` = :dateNaissance, `imgPath` = :imgPath WHERE `Realisateur`.`id` = :id";

    $id = filter_var($array['id'], FILTER_SANITIZE_STRING);
    $nom = filter_var($array['nom'], FILTER_SANITIZE_STRING);
    $prenom = filter_var($array['prenom'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);
    $imgPath = filter_var($array['imgPath'], FILTER_SANITIZE_STRING);

    $edit = $dao->executerRequete($sql, ["id" => $id, "nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "dateNaissance" => $dateNaissance, "imgPath" => $imgPath]);
    header("Location: index.php?action=listRealisateurs");
  }
}
