<?php

// session_start();

require_once "bdd/DAO.php";

class LogController
{

  function checkSignup($array)
  {

    $dao = new DAO();
    ini_set("pcre.jit", "0");
    $email = filter_var($array["email"], FILTER_VALIDATE_EMAIL);
    $pwd = filter_var($array["pwd"], FILTER_SANITIZE_STRING);
    $pwdrepeat = filter_var($array["pwdrepeat"], FILTER_SANITIZE_STRING);
    if ($pwdrepeat === $pwd) {
      // $user = $this->getUser($email);
      // if (!$user) {
      $this->addUser($email, $pwd, $pwdrepeat, $dao);
    } else {
      header("location: ./signup.php?error=userexists");
      exit();
      // echo "cet identifiant est déjà inscrit !";
    }
    // else {
    // header("location: ./signup.php?error=wrongpasswords");
    // exit();
    // echo "le deuxième mot de passe n'est pas similaire au premier !";
  }

  function checkLogin($array)
  {
    $dao = new DAO();
    ini_set("pcre.jit", "0");
    $email = filter_var($array["email"], FILTER_VALIDATE_EMAIL);
    $pwd = filter_var($array["pwd"], FILTER_SANITIZE_STRING);

    $user = $this->getUser($email);
    if ($user) {
      if ($this->verifMotdepasse($user, $pwd)) {
        $_SESSION['user'] = $user['email'];
        require_once("./views/login/log.php");
      }
    }
  }

  function verifMotdepasse($user, $pwd)
  {
    // var_dump($user);
    $upwd = $user['password'];
    password_verify($pwd, $upwd);
    // var_dump(password_verify($pwd, $upwd));
    // if (!password_verify($pwd, $upwd)) {
    //   header("location: ./login.php?error=wrongpassword");
    //   exit();
    // }

    //   echo "mot de passe incorrect, merci de réessayer";
    // }
    // else {
    // echo "mot de passe correct";
    return password_verify($pwd, $upwd);
  }


  function addUser($email, $pseudo, $pwd, $pdo)
  {
    try {
      // var_dump($email, $pwd, $pwdrepeat);
      $pwd = trim(htmlentities($pwd));
      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

      $sql = "INSERT INTO user (email, pseudo, password) VALUES (:email, :pseudo, :pwd)";

      $statement = $pdo->executerRequete($sql, ["email" => $email, "pseudo" => $pseudo, "pwd" => $hashedPwd]);

      // $postCount = $statement->rowCount();
      // var_dump($postCount);
      require_once("./views/login/signup.php");
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  function getUser($uemail)
  {
    try {
      $dao = new DAO();
      $sql = 'SELECT email, pseudo, password FROM user WHERE email = :email';
      $statement = $dao->executerRequete($sql, [":email" => $uemail]);
      $user = $statement->fetch();
      // var_dump($user);
      // require_once("./views/login/add-user.php");
      return $user;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  function login()
  {
    require "views/login/login.php";
  }

  function signup()
  {
    require "views/login/signup.php";
  }
}
