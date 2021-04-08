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

    $sql = "SELECT f.id AS id_film, a.id AS id_acteur, titre, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, ro.personnage FROM Film f LEFT JOIN Realisateur r ON f.fk_realisateur_id = r.id LEFT JOIN est_classifié cl ON cl.fk_film_id = f.id LEFT JOIN casting c ON c.fk_film_id = f.id LEFT JOIN Acteur a ON a.id = c.fk_acteur_id LEFT JOIN Role ro ON ro.id = c.fk_role_id WHERE a.id = :id GROUP BY titre";
    $films = $dao->executerRequete($sql, [":id" => $id]);
    require "views/acteur/listFilms.php";
  }

  public function ajoutActeur()
  {

    require "views/acteur/form.php";
  }

  public function checkAjoutActeur($array)
  {
    $dao = new DAO();

    $sql = "INSERT INTO `Acteur`(`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `imgPath`) VALUES (NULL, :nom, :prenom, :sexe, :dateNaissance, :imgPath)";

    $nom = filter_var($array['nom'], FILTER_SANITIZE_STRING);
    $prenom = filter_var($array['prenom'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);
    $imgPath = filter_var($array['imgPath'], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, ["nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "dateNaissance" => $dateNaissance, "imgPath" => $imgPath]);

    header("Location: index.php?action=listActeurs");
  }

  public function deleteActeurById($id)
  {

    $dao = new DAO();
    $sqlDeleteCasting = "DELETE FROM `casting` WHERE `casting`.`fk_acteur_id` = :id";
    $deleteCasting = $dao->executerRequete($sqlDeleteCasting, [":id" => $id]);

    $sql = "DELETE FROM `Acteur` WHERE `Acteur`.`id` = :id";
    $delete = $dao->executerRequete($sql, ["id" => $id]);

    header("Location: index.php?action=listActeurs");
  }

  public function editActeurById($id)
  {
    $dao = new DAO();
    $sql = "SELECT * FROM `Acteur` WHERE `Acteur`.`id` = :id";
    $edit = $dao->executerRequete($sql, ["id" => $id]);

    require "views/acteur/editForm.php";
  }

  public function checkEditActeur($array)
  {

    $dao = new DAO();
    $sql = "UPDATE `Acteur` SET `nom` = :nom, `prenom` = :prenom, `sexe` = :sexe, `dateNaissance` = :dateNaissance, `imgPath` = :imgPath WHERE `Acteur`.`id` = :id";

    $id = filter_var($array['id'], FILTER_SANITIZE_STRING);
    $nom = filter_var($array['nom'], FILTER_SANITIZE_STRING);
    $prenom = filter_var($array['prenom'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);
    $imgPath = filter_var($array['imgPath'], FILTER_SANITIZE_STRING);

    $edit = $dao->executerRequete($sql, ["id" => $id, "nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "dateNaissance" => $dateNaissance, "imgPath" => $imgPath]);
    header("Location: index.php?action=listActeurs");
  }

  public function ajoutCasting($id)
  {

    // $acteur = $this->findOneById($id); je ne sais pas pourquoi, ça ne marche pas…
    $dao = new DAO();
    $sql0 = "SELECT id, CONCAT(prenom,' ', nom) AS identite FROM Acteur WHERE id = :id";
    $sql = "SELECT id, titre FROM `Film`";
    $sql2 = "SELECT id, personnage FROM Role";
    $acteur = $dao->executerRequete($sql0, ["id" => $id]);
    $films = $dao->executerRequete($sql);
    $roles = $dao->executerRequete($sql2);

    require "views/acteur/castingForm.php";
  }

  public function checkCasting($array)
  {
    // var_dump($array);

    $dao = new DAO();
    $sql = "INSERT INTO `casting` (`fk_film_id`, `fk_acteur_id`, `fk_role_id`) VALUES (:idFilm, :idActeur, :idRole) ";


    $idActeur = filter_var($array["id"], FILTER_SANITIZE_NUMBER_INT);
    $idFilm = filter_var($array["film"], FILTER_SANITIZE_STRING);
    $idRole = filter_var($array["role"], FILTER_SANITIZE_STRING);
    $perso = filter_var($array["personnage"], FILTER_SANITIZE_STRING);

    if ($perso) {
      $sqlnewRole = "INSERT INTO `Role` (`id`, `personnage`) VALUES (NULL, :personnage)";
      $newRole = $dao->executerRequete($sqlnewRole, ["personnage" => $perso]);
      $sqlIdRole = "SELECT id FROM Role WHERE personnage LIKE :personnage";
      $idRole = $dao->executerRequete($sqlIdRole, [":personnage" => $perso]);
      $idSearch = $idRole->fetch();
      $idRole = $idSearch["id"];
    }
    // var_dump($idRole);
    // var_dump($role);

    $casting = $dao->executerRequete($sql, ["idFilm" => $idFilm, "idActeur" => $idActeur, "idRole" => $idRole]);
    // var_dump($casting);

    header("Location: index.php?action=listActeurs");
  }

  public function deleteCasting($idFilm, $idActeur)
  {
    $dao = new DAO();
    $sql = "DELETE FROM `casting` WHERE `casting`.`fk_film_id` = :idFilm AND `casting`.`fk_acteur_id` = :idActeur";
    $delete = $dao->executerRequete($sql, ["idFilm" => $idFilm, "idActeur" => $idActeur]);

    header("Location: index.php?action=listActeurs");
  }
}
