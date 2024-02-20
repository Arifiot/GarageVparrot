  <!doctype html>
  <html class="no-js" lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garage V.Parrot</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="img/icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--link rel="stylesheet" href="css/normalize.css"-->
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>

  <body>


    <!-- start header -->

    <header class="main-header">

     <nav class="main-navigation mainColor">
      <div class="nav-wrapper flex">
        <img src="img/logo.png" alt="logo">
        <input id="menu-checkbox" type="checkbox" class="menu-checkbox">
        <label for="menu-checkbox" class="menu-toggle"><i class="fas fa-bars"></i></label>
        <ul class="menu">
          <li><a href="index.php">Présentation</a></li>
          <li><a href="catalogue.php">Catalogue</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="menu">
          <li><a href="connexion.php">Connexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="titre-accroche flex">
      <h1>Un bon garagiste c'est un membre de la famille</h1>
    </div>
  </header>
  <!-- end header -->

  <!-- start main -->

  <main>

    <main>



      <form class="flex formStyle" method="post">
        <div class="form-group resizeForm">
          <label class="secondColor" for="email">Adresse mail</label>
          <input type="email" name="lemail" class="form-control fourthColor" id="InputEmail1" aria-describedby="emailHelp" placeholder="Adresse mail">
        </div>
        <div class="form-group resizeForm">
          <label class="secondColor" for="password">Mot de passe</label>
          <input type="password" name= "lpassword" class="form-control fourthColor" id="InputPassword1" placeholder="Mot de passe">
        </div>
        <button name="formsend" type="submit" class="btn btn-primary thirdColor btnResize" id="formsend">Envoyer</button>
      </form>

      <?php
      include 'database.php';
      global $db;

      if(isset($_POST['formsend']))
      { 
        extract($_POST);
        if(!empty($lemail) && !empty($lpassword))
        {
          $q = $db->prepare("SELECT * FROM user WHERE email =:email");
          $q->execute(['email'=>$lemail]);
          $result = $q->fetch();
          if($result == true)
          {
            if($lpassword==$result['password'])
                if($result['status'] == 'Admin')
                  header("Location: http://localhost/Site%20Garage/admin.php");
                  exit; // Assurez-vous de terminer le script après la redirection
          }
        }
        else
        {
          echo"veuillez tous remplir";
        }
      }

      ?>


      
    </main>

    <!-- end main -->

    <!-- start footer -->

<footer class="mainColor">

  <!-- mettre les horaire d'ouverture et le formulaire de contacte -->
  <div class="flex lienFoot">
    <?php
    try{
      $dbCalendar = new PDO("mysql:host=" . 'localhost' . ";dbname=". 'horaire' ,'root' ,'');
      $dbCalendar->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
      echo $e;
    }
    for ($i=1; $i <8 ; $i++) { 

      $q = $dbCalendar->prepare('SELECT * FROM jours WHERE id='.$i); 
      $q->execute();
      $jours = $q->fetch();
      echo "" . $jours['Jours'] . " " . ($jours['ouverture matin'] - $jours['ouverture matin']%60)/60 . "h: " . ($jours['ouverture matin'])%60 ." - ". $jours['fermeture matin'] / 60 ."h, " . ($jours['ouverture apres midi'] - $jours['ouverture apres midi']%60)/60 . "h: " ." - ". $jours['fermeture apres midi'] / 60 ."h " . "</br>";
    }
    
    ?>
  </div>
</div>

</footer>

    <!-- end footer -->

  </body>

  </html>
