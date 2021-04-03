<?php

ob_start();

?>


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/signup.css">
  <script src="https://kit.fontawesome.com/e2a8fec256.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>

  <?php
  var_dump($_SESSION['pseudo']);
  if (isset($_SESSION['user'])) {
    echo "<p><a href='index.php?action=checkout'>Déconnectez-vous</a></p>";
  } else {
    echo "<section class='connexion'>
    <div class='form-wrapper'>
      <h1>Connexion</h1>
      <form action='index.php?action=log' method='post'>
        <div class='form-item'>
          <label for='email'></label>
          <input type='email' name='email' required='required' placeholder='Addresse email'></input>
        </div>
        <div class='form-item'>
          <label for='password'></label>
          <div class='flex'>
            <input type='password' name='pwd' required='required' placeholder='mot de passe' id='pwdVisible'></input>
            <i onclick='myFunction()' class='togglePwd fas fa-eye'></i>
          </div>
        </div>
        <div class='button-panel'>
          <input type='submit' class='button' title='Valider' value='Valider'></input>
        </div>
      </form>
      <div class='form-footer'>
        <p><a href='index.php?action=signup'>Pas encore membre ? <br /> Inscrivez-vous</a></p>
      </div>
    </div>
  </section>";
  }
  ?>
  <script src="./js/script.js"></script>

  <?php

  // $films->closeCursor();
  $titre = "login";
  $contenu = ob_get_clean();
  require "./views/template.php";
