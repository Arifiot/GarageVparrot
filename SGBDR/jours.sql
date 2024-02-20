

--
-- Structure de la table `jours`
--

CREATE TABLE `jours` (
  `id` int(64) NOT NULL,
  `Jours` varchar(255) NOT NULL,
  `ouverture matin` int(32) NOT NULL,
  `fermeture matin` int(32) NOT NULL,
  `ouverture apres midi` int(32) NOT NULL,
  `fermeture apres midi` int(32) NOT NULL
);


INSERT INTO `jours` (`id`, `Jours`, `ouverture matin`, `fermeture matin`, `ouverture apres midi`, `fermeture apres midi`) VALUES
(7, 'Dimanche', 0, 0, 0, 0),
(4, 'Jeudi', 525, 720, 840, 1080),
(1, 'Lundi', 525, 720, 840, 1080),
(2, 'Mardi', 525, 720, 840, 1080),
(3, 'Mercredi', 525, 720, 840, 1080),
(6, 'Samedi', 525, 720, 0, 0),
(5, 'Vendredi', 525, 720, 840, 1080);

