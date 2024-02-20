<?php
// Inclure le fichier de connexion à la base de données pour la gestion des horaires
try {
    $db_horaires = new PDO("mysql:host=localhost;dbname=horaire", 'root', '');
    $db_horaires->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}

// Inclure le fichier de connexion à la base de données pour la gestion des véhicules
try {
    $db_vehicules = new PDO("mysql:host=localhost;dbname=voiture", 'root', '');
    $db_vehicules->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}

// Vérifier si le formulaire de gestion des horaires a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier_horaires"])) {
    // Récupérer les valeurs du formulaire de gestion des horaires
    $jours = $_POST["jours"];
    $ouvertureMatin = ($_POST["ouverture_matin_hours"] * 60) + $_POST["ouverture_matin_minutes"];
    $fermetureMatin = ($_POST["fermeture_matin_hours"] * 60) + $_POST["fermeture_matin_minutes"];
    $ouvertureApresMidi = ($_POST["ouverture_apres_midi_hours"] * 60) + $_POST["ouverture_apres_midi_minutes"];
    $fermetureApresMidi = ($_POST["fermeture_apres_midi_hours"] * 60) + $_POST["fermeture_apres_midi_minutes"];

    // Mettre à jour les horaires d'ouverture dans la base de données
    try {
        $stmt = $db_horaires->prepare("UPDATE `jours` SET `ouverture matin` = :ouvertureMatin, `fermeture matin` = :fermetureMatin, `ouverture apres midi` = :ouvertureApresMidi, `fermeture apres midi` = :fermetureApresMidi WHERE `Jours` = :jours");
        $stmt->bindParam(':ouvertureMatin', $ouvertureMatin);
        $stmt->bindParam(':fermetureMatin', $fermetureMatin);
        $stmt->bindParam(':ouvertureApresMidi', $ouvertureApresMidi);
        $stmt->bindParam(':fermetureApresMidi', $fermetureApresMidi);
        $stmt->bindParam(':jours', $jours);

        $stmt->execute();
        $successMessageHoraires = "Les horaires d'ouverture ont été mis à jour avec succès.";
    } catch (PDOException $e) {
        $errorMessageHoraires = "Erreur lors de la mise à jour des horaires d'ouverture : " . $e->getMessage();
    }
}

// Vérifier si le formulaire de gestion des véhicules a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter_vehicule"])) {
    // Récupérer les valeurs du formulaire d'ajout de véhicule
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $prix = $_POST["prix"];
    $annee = $_POST["annee"];
    $kilometrage = $_POST["kilometrage"];
    $description = $_POST["description"];
    $image = $_POST["image"];

    // Insérer le nouveau véhicule dans la base de données
    try {
        $stmt = $db_vehicules->prepare("INSERT INTO voitures (marque, modele, prix, annee, kilometrage, description, image) VALUES (:marque, :modele, :prix, :annee, :kilometrage, :description, :image)");
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':kilometrage', $kilometrage);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        $successMessageVehicules = "Le véhicule a été ajouté avec succès.";
    } catch (PDOException $e) {
        $errorMessageVehicules = "Erreur lors de l'ajout du véhicule : " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer_vehicule"])) {
    // Récupérer l'ID du véhicule à supprimer
    $vehicule_id = $_POST["vehicule_id"];

    // Supprimer le véhicule de la base de données
    try {
        $stmt = $db_vehicules->prepare("DELETE FROM voitures WHERE id = :vehicule_id");
        $stmt->bindParam(':vehicule_id', $vehicule_id);
        $stmt->execute();
        $successMessageVehicules = "Le véhicule a été supprimé avec succès.";
    } catch (PDOException $e) {
        $errorMessageVehicules = "Erreur lors de la suppression du véhicule : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
</head>

<body>
    <button onclick="window.location.href = 'http://localhost/Site%20Garage/index.php';">Redirection vers la page principal</button>
    <h1>Modifier les horaires d'ouverture</h1>
    <?php if (isset($successMessageHoraires)) : ?>
        <p style="color: green;"><?php echo $successMessageHoraires; ?></p>
    <?php endif; ?>
    <?php if (isset($errorMessageHoraires)) : ?>
        <p style="color: red;"><?php echo $errorMessageHoraires; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <!-- Formulaire de gestion des horaires -->
        <label for="jours">Jour de la semaine :</label>
        <select name="jours" id="jours">
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Mercredi">Mercredi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
            <option value="Samedi">Samedi</option>
            <option value="Dimanche">Dimanche</option>
        </select><br><br>
        <label for="ouverture_matin">Ouverture matin :</label>
        <select name="ouverture_matin_hours" id="ouverture_matin_hours">
            <?php for ($i = 0; $i < 24; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select> :
        <select name="ouverture_matin_minutes" id="ouverture_matin_minutes">
            <?php for ($i = 0; $i < 60; $i += 15) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select><br><br>
        <label for="fermeture_matin">Fermeture matin :</label>
        <select name="fermeture_matin_hours" id="fermeture_matin_hours">
            <?php for ($i = 0; $i < 24; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select> :
        <select name="fermeture_matin_minutes" id="fermeture_matin_minutes">
            <?php for ($i = 0; $i < 60; $i += 15) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select><br><br>
        <label for="ouverture_apres_midi">Ouverture après-midi :</label>
        <select name="ouverture_apres_midi_hours" id="ouverture_apres_midi_hours">
            <?php for ($i = 0; $i < 24; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select> :
        <select name="ouverture_apres_midi_minutes" id="ouverture_apres_midi_minutes">
            <?php for ($i = 0; $i < 60; $i += 15) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select><br><br>
        <label for="fermeture_apres_midi">Fermeture après-midi :</label>
        <select name="fermeture_apres_midi_hours" id="fermeture_apres_midi_hours">
            <?php for ($i = 0; $i < 24; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select> :
        <select name="fermeture_apres_midi_minutes" id="fermeture_apres_midi_minutes">
            <?php for ($i = 0; $i < 60; $i += 15) : ?>
                <option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
            <?php endfor; ?>
        </select><br><br>
        <input type="submit" value="Modifier" name="modifier_horaires">
    </form>

    <h1>Gestion des véhicules</h1>
    <!-- Formulaire d'ajout de véhicule -->
    <h2>Ajouter un véhicule</h2>
    <?php if (isset($successMessageVehicules)) : ?>
        <p style="color: green;"><?php echo $successMessageVehicules; ?></p>
    <?php endif; ?>
    <?php if (isset($errorMessageVehicules)) : ?>
        <p style="color: red;"><?php echo $errorMessageVehicules; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="marque">Marque :</label>
        <input type="text" name="marque" id="marque"><br><br>
        <label for="modele">Modèle :</label>
        <input type="text" name="modele" id="modele"><br><br>
        <label for="prix">Prix :</label>
        <input type="text" name="prix" id="prix"><br><br>
        <label for="annee">Année :</label>
        <input type="text" name="annee" id="annee"><br><br>
        <label for="kilometrage">Kilométrage :</label>
        <input type="text" name="kilometrage" id="kilometrage"><br><br>
        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="4" cols="50"></textarea><br><br>
        <label for="image">Image :</label>
        <input type="text" name="image" id="image"><br><br>
        <input type="submit" value="Ajouter" name="ajouter_vehicule">
    </form>

    <!-- Formulaire de suppression de véhicule -->
    <h2>Supprimer un véhicule</h2>
    <?php if (isset($successMessageVehicules)) : ?>
        <p style="color: green;"><?php echo $successMessageVehicules; ?></p>
    <?php endif; ?>
    <?php if (isset($errorMessageVehicules)) : ?>
        <p style="color: red;"><?php echo $errorMessageVehicules; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="vehicule_id">ID du véhicule à supprimer :</label>
        <input type="text" name="vehicule_id" id="vehicule_id"><br><br>
        <input type="submit" value="Supprimer" name="supprimer_vehicule">
    </form>
</body>

</html>
