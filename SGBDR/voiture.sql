
--
-- Structure de la table `voiture`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `marque` varchar(100) DEFAULT NULL,
  `modele` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `kilometrage` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
);

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `prix`, `annee`, `kilometrage`, `description`, `image`) VALUES
(2, 'Renault', 'Clio', 8000.00, 2018, 50000, 'Bonne état, essence, faible consommation', 'img/Clio 5.jpg'),
(3, 'Peugeot', '2008', 9000.00, 2017, 60000, 'Bon état général, diesel, climatisation', 'img/Peugeot 2008.jpg'),
(4, 'Volkswagen', 'Golf', 12000.00, 2016, 70000, 'Quelques rayures, diesel, régulateur de vitesse', 'img/Golf 7.jpg'),
(5, 'Hyundai', 'Ioniq 6', 25000.00, 2023, 500, 'Nouveau modèle électrique', 'img/Ioniq 6.jpg');
