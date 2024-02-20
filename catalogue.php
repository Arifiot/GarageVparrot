<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garage V.Parrot</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".filter-button").click(function () {
                $(this).toggleClass("active");
                applyFilters();
            });

            $(".reset-button").click(function () {
                $(".filter-button").removeClass("active");
                applyFilters();
            });

            function applyFilters() {
                var selectedMarques = [];
                $(".marque-button.active").each(function () {
                    selectedMarques.push($(this).data("marque"));
                });

                var selectedAnnees = [];
                $(".annee-button.active").each(function () {
                    selectedAnnees.push($(this).data("annee"));
                });

                var selectedModeles = [];
                $(".modele-button.active").each(function () {
                    selectedModeles.push($(this).data("modele"));
                });

                $(".car").hide();
                $(".car").each(function () {
                    var carMarque = $(this).data("marque");
                    var carAnnee = $(this).data("annee");
                    var carModele = $(this).data("modele");

                    if ((selectedMarques.length === 0 || selectedMarques.includes(carMarque)) &&
                        (selectedAnnees.length === 0 || selectedAnnees.includes(carAnnee)) &&
                        (selectedModeles.length === 0 || selectedModeles.includes(carModele))) {
                        $(this).show();
                    }
                });
            }
        });
    </script>
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
        <div class="container">
            <?php
            try {
                $db = new PDO("mysql:host=localhost;dbname=voiture", 'root', '');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur de connexion: " . $e->getMessage();
                exit;
            }

            // Récupérer les marques distinctes
            $stmt_marques = $db->query("SELECT DISTINCT marque FROM voitures");
            $marques = $stmt_marques->fetchAll(PDO::FETCH_COLUMN);

            // Récupérer les années distinctes
            $stmt_annees = $db->query("SELECT DISTINCT annee FROM voitures");
            $annees = $stmt_annees->fetchAll(PDO::FETCH_COLUMN);

            // Récupérer les modèles distincts
            $stmt_modeles = $db->query("SELECT DISTINCT modele FROM voitures");
            $modeles = $stmt_modeles->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <div>
                <h3>Filtrer par marque :</h3>
                <?php foreach ($marques as $marque) : ?>
                <button class="filter-button marque-button" data-marque="<?php echo $marque; ?>"><?php echo $marque; ?></button>
                <?php endforeach; ?>
            </div>
            <div>
                <h3>Filtrer par année :</h3>
                <?php foreach ($annees as $annee) : ?>
                <button class="filter-button annee-button" data-annee="<?php echo $annee; ?>"><?php echo $annee; ?></button>
                <?php endforeach; ?>
            </div>
            <div>
                <h3>Filtrer par modèle :</h3>
                <?php foreach ($modeles as $modele) : ?>
                <button class="filter-button modele-button" data-modele="<?php echo $modele; ?>"><?php echo $modele; ?></button>
                <?php endforeach; ?>
            </div>
            <div>
                <button class="reset-button">Réinitialiser les filtres</button>
            </div>
            <div class="cars-container">
                <?php
                $stmt_voitures = $db->query("SELECT * FROM voitures");
                while ($row = $stmt_voitures->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='car car-border' data-marque='" . $row["marque"] . "' data-annee='" . $row["annee"] . "' data-modele='" . $row["modele"] . "'>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["marque"] . "'>";
                    echo "<p>Marque: " . $row["marque"] . "</p>";
                    echo "<p>Modèle: " . $row["modele"] . "</p>";
                    echo "<p>Prix: " . $row["prix"] . "</p>";
                    echo "<p>Année: " . $row["annee"] . "</p>";
                    echo "<p>Kilométrage: " . $row["kilometrage"] . "</p>";
                    echo "<p>Description: " . $row["description"] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
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


</html>
