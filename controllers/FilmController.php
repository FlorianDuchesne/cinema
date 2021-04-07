<?php

require_once "bdd/DAO.php";

class FilmController
{


  public function listFilms()
  {
    $dao = new DAO();
    // $sql = "SELECT titre, sortie, duree, `resume`, note FROM film f";
    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, GROUP_CONCAT( `libelle` SEPARATOR ' ' ) AS `genres` FROM Film f LEFT JOIN realisateur r ON f.fk_realisateur_id = r.id LEFT JOIN est_classifié c ON f.id = c.fk_film_id LEFT JOIN Genre g ON c.fk_genre_id = g.id GROUP BY titre";


    // "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur FROM film f 
    // INNER JOIN realisateur r ON r.id = f.fk_realisateur_id ORDER BY titre DESC ";

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

    $sql = "SELECT f.id, titre, DATE_FORMAT(sortie, ('%Y')) AS sortie, DATE_FORMAT(SEC_TO_TIME(duree*60), '%H:%i') AS duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, note, f.imgPath, `resume`, GROUP_CONCAT( `libelle` SEPARATOR ' ' ) AS `genres` FROM film f LEFT JOIN realisateur r ON r.id = f.fk_realisateur_id LEFT JOIN est_classifié c ON c.fk_film_id = f.id LEFT JOIN Genre g ON g.id = c.fk_genre_id GROUP BY titre
            HAVING f.id= :id";
    $film = $dao->executerRequete($sql, [":id" => $id]);
    $sqlCasting = "SELECT a.id AS id_acteur, r.id AS id_role, CONCAT(a.prenom,' ',a.nom) AS nom_acteur, r.personnage AS nom_personnage FROM `Film` f, casting c, Acteur a, Role r WHERE f.id = :id AND a.id = c.fk_acteur_id AND f.id = c.fk_film_id AND r.id = c.fk_role_id";
    $castings = $dao->executerRequete($sqlCasting, [":id" => $id]);

    require "views/film/detailFilm.php";
  }

  public function checkAjoutFilm($array)
  {

    $dao = new DAO();
    $sqlnewFilm = "INSERT INTO `Film` (`id`, `titre`, `sortie`, `duree`, `resume`, `note`, `imgPath`, `fk_realisateur_id`) VALUES (NULL, :titre, :sortie, :duree, :resume, :note, :imgPath, :realisateur)";

    $titre = filter_var($array["titre"], FILTER_SANITIZE_STRING);
    $sortie = filter_var($array["sortie"], FILTER_SANITIZE_STRING);
    $duree = filter_var($array["duree"], FILTER_SANITIZE_STRING);
    $note = filter_var($array["note"], FILTER_SANITIZE_NUMBER_INT);
    $resume = filter_var($array["resume"], FILTER_SANITIZE_STRING);
    $prenom = filter_var($array["prenom"], FILTER_SANITIZE_STRING);
    $nom = filter_var($array["nom"], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array["sexe"], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array["dateNaissance"], FILTER_SANITIZE_STRING);
    $imgPathReal = filter_var($array["imgPathReal"], FILTER_SANITIZE_STRING);
    $imgPathFilm = filter_var($array["imgPathFilm"], FILTER_SANITIZE_STRING);
    $idReal = filter_var($array["real"], FILTER_SANITIZE_NUMBER_INT);


    if ($prenom) {
      $sqlnewReal = "INSERT INTO `Realisateur` (`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `imgPath`) VALUES (NULL, :nom, :prenom, :sexe, :dateNaissance, :imgPath)";
      $newReal = $dao->executerRequete($sqlnewReal, ["nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "dateNaissance" => $dateNaissance, "imgPath" => $imgPathReal]);
      $sqlIdReal = "SELECT id FROM Realisateur WHERE nom LIKE :nom AND prenom LIKE :prenom";
      $idReal = $dao->executerRequete($sqlIdReal, ["nom" => $nom, "prenom" => $prenom]);
      $idSearch = $idReal->fetch();
      $idReal = $idSearch["id"];
    }

    $newFilm = $dao->executerRequete($sqlnewFilm, ["titre" => $titre, "sortie" => $sortie, "duree" => $duree, "resume" => $resume, "note" => $note, "imgPath" => $imgPathFilm, "realisateur" => $idReal]);

    header("Location: index.php?action=listFilms");
  }

  public function editFilm($id)
  {
    $dao = new DAO();

    $sql = "SELECT f.id, titre, sortie, duree, fk_realisateur_id, CONCAT(r.prenom,' ', r.nom) AS nom_realisateur, note, f.imgPath, `resume`, GROUP_CONCAT( `libelle` SEPARATOR ' ' ) AS `genres` FROM film f LEFT JOIN realisateur r ON r.id = f.fk_realisateur_id LEFT JOIN est_classifié c ON c.fk_film_id = f.id LEFT JOIN Genre g ON g.id = c.fk_genre_id GROUP BY titre
    HAVING f.id= :id";
    $film = $dao->executerRequete($sql, [":id" => $id]);
    $sqlReal = "SELECT CONCAT(prenom, ' ', nom) AS nom_real, id FROM `Realisateur`";
    $reals = $dao->executerRequete($sqlReal);
    $sqlGenres = "SELECT * FROM `Genre`";
    $genres = $dao->executerRequete($sqlGenres);
    $sqlRoles = "SELECT * FROM `Role`";
    $roles = $dao->executerRequete($sqlRoles);
    $sqlActeurs = "SELECT id, CONCAT (prenom, ' ', nom) AS nom_acteur FROM `Acteur`";
    $acteurs = $dao->executerRequete($sqlActeurs);

    require "views/film/editFilm.php";
  }



  public function checkEditFilm($array)
  {
    $dao = new DAO();
    $idFilm = filter_var($array["id"], FILTER_SANITIZE_NUMBER_INT);
    $titre = filter_var($array["titre"], FILTER_SANITIZE_STRING);
    $sortie = filter_var($array["sortie"], FILTER_SANITIZE_STRING);
    $duree = filter_var($array["duree"], FILTER_SANITIZE_STRING);
    $note = filter_var($array["note"], FILTER_SANITIZE_NUMBER_INT);
    $resume = filter_var($array["resume"], FILTER_SANITIZE_STRING);
    $imgPath = filter_var($array["imgPath"], FILTER_SANITIZE_STRING);
    $idReal = filter_var($array["real"], FILTER_SANITIZE_NUMBER_INT);

    $sqlDeleteGenres = "DELETE FROM `est_classifié` WHERE `est_classifié`.`fk_film_id` = :idFilm";
    $deleteGenre = $dao->executerRequete($sqlDeleteGenres, ["idFilm" => $idFilm]);

    $sqlEditFilm = "UPDATE `Film` SET `titre` = :titre, `sortie` = :sortie, `duree` = :duree, `resume` = :resume, `note` = :note, `imgPath` = :imgPath, `fk_realisateur_id` = :idReal WHERE `Film`.`id` = :idFilm";
    $i = 0;
    foreach ($array["genres"] as $value) {
      $idGenres[] = filter_var($value, FILTER_SANITIZE_STRING);
      $sql = "INSERT INTO `est_classifié`(`fk_film_id`, `fk_genre_id`) VALUES (:idFilm, :idGenre)";
      $ajoutGenre = $dao->executerRequete($sql, ["idFilm" => $idFilm, "idGenre" => $idGenres[$i]]);
      $i++;
    }

    $EditFilm = $dao->executerRequete($sqlEditFilm, ["titre" => $titre, "sortie" => $sortie, "duree" => $duree, "resume" => $resume, "note" => $note, "imgPath" => $imgPath, "idReal" => $idReal, "idFilm" => $idFilm]);

    header("Location: index.php?action=listFilms");
  }

  public function deleteFilm($id)
  {
    $dao = new DAO();
    $sqlDeleteCasting = "DELETE FROM `casting` WHERE `casting`.`fk_film_id` = :id";
    $deleteCasting = $dao->executerRequete($sqlDeleteCasting, [":id" => $id]);
    $sqlDeleteFilm = "DELETE FROM `Film` WHERE `Film`.`id` = :id";
    $deleteFilm = $dao->executerRequete($sqlDeleteFilm, [":id" => $id]);

    header("Location: index.php?action=listFilms");
  }
}
