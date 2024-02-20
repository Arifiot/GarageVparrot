
--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);


INSERT INTO `user` (`id`, `status`, `pseudo`, `email`, `password`) VALUES
(1, 'employes', 'Gerard', 'gerarddupon@gmail.com', 'azerty'),
(2, 'Admin', 'Vincent', 'Vincent@gmail.com', 'Vincent'),
(4, 'employes', 'Clement', 'clement@gmail.com', 'azeqsd');

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);


