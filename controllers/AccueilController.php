<?php


require_once "bdd/DAO.php";

class AccueilController
{

  public function pageAccueil()
  {
    $dao = new DAO();
    require "views/accueil/accueil.php";
  }
}
