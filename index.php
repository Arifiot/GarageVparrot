<!doctype html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Garage V.Parrot</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
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

  <h3 class="tCenter paragrapheEspace">Le Garage V.Parrot</h3> 
  <h4 class="tCenter paragrapheEspace">Qui sommes nous?</h4>

  <p class="tCenter paragrapheEspace">Je suis Vincent Parrot, fort de 15 années d'expérience dans la réparation automobile, et je suis ravi de partager avec vous mon parcours. En 2021, j'ai ouvert mon propre garage à Toulouse, un projet qui me tient particulièrement à cœur.</br>

  Au cours des deux dernières années, mon équipe et moi avons travaillé sans relâche pour offrir une gamme complète de services. De la réparation de la carrosserie à la mécanique des voitures, en passant par l'entretien régulier, notre objectif est de garantir la performance et la sécurité de chaque véhicule qui franchit nos portes. Mais ce n'est pas tout. Pour répondre à vos besoins, le Garage V. Parrot propose également la vente de véhicules d'occasion, contribuant ainsi à diversifier nos activités.</br>

Pour moi, cet atelier n'est pas simplement un lieu de travail, c'est un véritable lieu de confiance. Je considère que chaque voiture qui nous est confiée doit être entre de bonnes mains. C'est pourquoi je m'engage personnellement à assurer la qualité de nos services. Mon équipe partage cette vision, et ensemble, nous nous efforçons de faire de votre passage au Garage V. Parrot une expérience exceptionnelle.</br>

Je suis convaincu que la clé du succès réside dans l'attention aux détails et dans l'engagement envers la satisfaction du client. Chez nous, chaque voiture est traitée avec le plus grand soin, car je crois fermement que votre véhicule mérite le meilleur.</br>

Merci de faire confiance au Garage V. Parrot, où la passion pour l'automobile rencontre un service de qualité.</br>

</p>

<div class="blockIndex tCenter secondColor">
  <h4>Que faisons nous en resumé?</h4>
  <ul>
    <li class="tCenter paragrapheEspace">la carroserie</li>
    <li class="tCenter paragrapheEspace">la mecanique</li>
    <li class="tCenter paragrapheEspace">l'entretien</li>
    <li class="tCenter paragrapheEspace">la vente de véhicule d'occasion</li>
  </ul>

  <?php

  include 'database.php';
  global $db;

  $q = $db->query("SELECT * FROM user");
  ?>

</div>
</main>

<!-- end main -->

<!-- start footer -->

<footer class="mainColor">
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
