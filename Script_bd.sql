-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 29, 2026 at 07:49 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supercar`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouter_demande_essai` (IN `p_nom` VARCHAR(100), IN `p_prenom` VARCHAR(100), IN `p_adresse` VARCHAR(255), IN `p_contact` VARCHAR(20), IN `p_email` VARCHAR(150), IN `p_date_essai` DATE, IN `p_heure_essai` TIME, IN `p_marque` VARCHAR(50), IN `p_modele` VARCHAR(100))   BEGIN
    INSERT INTO demandes_essai (
        nom,
        prenom,
        adresse,
        contact,
        email,
        date_essai,
        heure_essai,
        marque,
        modele
    )
    VALUES (
        p_nom,
        p_prenom,
        p_adresse,
        p_contact,
        p_email,
        p_date_essai,
        p_heure_essai,
        p_marque,
        p_modele
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bienvenu`
--

CREATE TABLE `bienvenu` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `paragraphe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bienvenu`
--

INSERT INTO `bienvenu` (`id`, `titre`, `paragraphe`) VALUES
(1, 'Bienvenue chez SuperCar', 'SuperCar est votre spécialiste de voitures haut de gamme, offrant une expérience automobile d’exception à chaque client. Nous sélectionnons avec soin les modèles les plus prestigieux de marques renommées telles que BMW, Mercedes, Volkswagen et Ford. Que vous soyez amateur de performance, de confort ou de design, nous avons le véhicule qui répond à vos attentes. Nous mettons un point d\'honneur à proposer des services personnalisés, allant du conseil à la vente jusqu’à la préparation sur-mesure. SuperCar vous invite aussi à participer à des événements exclusifs tels que des expositions, démonstrations, formations et préparations techniques. Rejoignez la communauté SuperCar et vivez la passion de l’automobile à son plus haut niveau');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date_contact` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `email`, `message`, `date_contact`) VALUES
(1, 'Rockzen', 'Kenny', 'kenny@gmail.com', 'Kenny drives ', '2025-04-17 01:55:11'),
(3, 'Mahery', 'Mah', 'mahery@gmail.com', 'Mahery drives', '2025-04-17 05:24:39'),
(7, 'Maudarbocus', 'Nasserr', 'nasser@gmail.com', 'Nasser drives', '2025-05-05 17:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `demandes_essai`
--

CREATE TABLE `demandes_essai` (
  `id` int NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `date_essai` date DEFAULT NULL,
  `heure_essai` time DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(100) DEFAULT NULL,
  `date_soumission` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `demandes_essai`
--

INSERT INTO `demandes_essai` (`id`, `nom`, `prenom`, `adresse`, `contact`, `email`, `date_essai`, `heure_essai`, `marque`, `modele`, `date_soumission`) VALUES
(1, 'MAhery', 'Ifaliana', 'Port Louis', '374583947', 'mahery@gmail.com', '2026-08-03', '13:40:00', 'bmw', 'X6M', '2025-04-17 01:29:26'),
(3, 'Paul', 'Jean', 'Curepipe', '37438974297', 'paul@gmail.com', '2026-02-03', '13:40:00', 'mercedes', 'Maybach', '2025-04-17 05:21:26'),
(4, 'Akram', 'Junior', 'Vacoas', '4832094820', 'akram@gmail.com', '2026-09-22', '07:40:00', 'mercedes', 'Maybach', '2025-04-24 04:52:46'),
(5, 'Akram', 'Junior', 'Mahebourg', '5428504920', 'akram@gmail.com', '2025-05-09', '14:04:00', 'mercedes', 'Class G', '2025-05-05 17:33:31'),
(6, 'Justin', 'hill', 'Port Louis', '54285734925', 'hill@gmail.com', '2025-06-05', '09:40:00', 'mercedes', 'Maybach', '2025-05-06 10:01:41'),
(7, 'Marie', 'marie', 'Qbornes', '453252', 'marie@gmail.com', '2026-03-31', '12:34:00', 'mercedes', 'Class G', '2026-03-29 17:11:29'),
(8, 'Rakoto', 'Marie', 'Vacoas', '58001234', 'marie@test.com', '2026-04-20', '10:30:00', 'bmw', 'M3 Competition', '2026-04-08 18:30:02'),
(9, 'Test', 'Local', 'Curepipe', '52547896', 'test@mail.com', '2026-04-25', '09:00:00', 'ford', 'Ford Focus', '2026-04-08 18:39:47'),
(10, 'Mahery', 'Ifaliana ', 'Quatre_bornes', '5485389753', 'mahery@gmail.com', '2026-04-16', '06:00:00', 'mercedes', 'Class G', '2026-04-08 18:41:39'),
(11, 'Mahery', 'Ifaliana ', 'Port-Louis', '347487923', 'mahery@gmail.com', '2026-03-01', '08:20:00', 'bmw', 'X6M', '2026-04-08 18:50:12'),
(12, 'Julie', 'Martin', 'Quatre Bornes', '57998877', 'julie@test.com', '2026-04-28', '11:00:00', 'bmw', 'M2', '2026-04-08 18:58:44');

--
-- Triggers `demandes_essai`
--
DELIMITER $$
CREATE TRIGGER `trg_apres_insertion_demande_essai` AFTER INSERT ON `demandes_essai` FOR EACH ROW BEGIN
    INSERT INTO historique_demandes_essai (
        demande_id,
        nom,
        prenom,
        email,
        marque,
        modele,
        action_effectuee
    )
    VALUES (
        NEW.id,
        NEW.nom,
        NEW.prenom,
        NEW.email,
        NEW.marque,
        NEW.modele,
        'Insertion demande essai'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `evenementintro`
--

CREATE TABLE `evenementintro` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `evenementintro`
--

INSERT INTO `evenementintro` (`id`, `nom`) VALUES
(1, 'Expositions'),
(2, 'Démonstration'),
(3, 'Formation'),
(4, 'Préparation');

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

CREATE TABLE `evenements` (
  `id` int NOT NULL,
  `titre` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `contenu`, `image`, `date_ajout`) VALUES
(1, 'Salon de voitures', 'Découvrez nos modèles exclusifs lors d\'expositions uniques, dans des lieux prestigieux dédiés aux passionnés.', 'https://www.hotesse.fr/wp-content/uploads/2018/06/Salon-de-l’Auto-une-grand-messe-motorisée-qui-en-a-sous-le-capot-1.jpg', '2026-03-29 11:48:37'),
(2, 'Démonstration', 'Vivez des démonstrations en live de nos véhicules hautes performances, sur circuit ou terrain privé.', 'phodeos/demonstration.jpg', '2025-04-17 01:50:00'),
(3, 'Formation', 'Profitez de formations techniques pour approfondir vos connaissances sur les modèles et leurs technologies.', 'phodeos/formation.jpg', '2025-04-17 01:50:00'),
(4, 'Préparation', 'Nos experts personnalisent chaque véhicule selon vos envies : tuning, performance, esthétique, etc.', 'phodeos/preparation.jpg', '2025-04-17 01:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `historique_demandes_essai`
--

CREATE TABLE `historique_demandes_essai` (
  `id_log` int NOT NULL,
  `demande_id` int DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marque` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modele` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action_effectuee` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_action` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historique_demandes_essai`
--

INSERT INTO `historique_demandes_essai` (`id_log`, `demande_id`, `nom`, `prenom`, `email`, `marque`, `modele`, `action_effectuee`, `date_action`) VALUES
(1, 12, 'Julie', 'Martin', 'julie@test.com', 'bmw', 'M2', 'Insertion demande essai', '2026-04-08 18:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `marqueintro`
--

CREATE TABLE `marqueintro` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `marqueintro`
--

INSERT INTO `marqueintro` (`id`, `nom`) VALUES
(1, 'BMW'),
(2, 'Mercedes'),
(3, 'Volkswagen'),
(4, 'Ford');

-- --------------------------------------------------------

--
-- Table structure for table `marques`
--

CREATE TABLE `marques` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `marques`
--

INSERT INTO `marques` (`id`, `nom`, `logo`, `description`) VALUES
(1, 'BMW', 'phodeos/bmwlogo.jpg', 'Symbole de sportivité et d’innovation allemande, BMW propose des véhicules alliant performance, confort et technologies de pointe.'),
(2, 'Mercedes-Benz', 'phodeos/mercedeslogo.jpg', 'Réputée pour son luxe et son raffinement, Mercedes offre des véhicules prestigieux avec un design élégant et des équipements haut de gamme.'),
(3, 'Volkswagen', 'phodeos/volkswagenlogo.jpg', 'Volkswagen est synonyme de fiabilité et d’innovation accessible. Ses modèles conviennent à toutes les générations de conducteurs exigeants.'),
(4, 'Ford', 'phodeos/fordlogo.webp', 'Halloo Constructeur pionnier dans l’histoire automobile, Ford combine robustesse, technologie et accessibilité dans une large gamme de véhicules.');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `numero`, `adresse`, `email`, `motdepasse`, `date_inscription`) VALUES
(1, 'Mahery', 'Ifaliana ', '847542875', 'Port-Louis', 'mahery@gmail.com', '$2y$10$yjZvPiP/S3xSzM7H3WZJJOgNwu5UhSEsPjSeLKhn//LxpSkV5f3dC', '2025-04-17 02:10:44'),
(4, 'david', 'prv', '9304743829', 'Curepipe', 'david@gmail.com', '$2y$10$VBoqu7jvINWI9vPWa1THxubDYTHq2gT6iuAslpYB7oKI5jRbvQJsG', '2025-04-17 02:23:37'),
(10, 'Akram', 'Junior', '534782759', 'Terre rouge ', 'akram@gmail.com', '$2y$10$LsfCHFOICH09c3FYDvUvYe.JqqFqA5BWpviogzuJ05rfU/Yfi3eWe', '2025-04-21 05:40:20'),
(14, 'Mickael', 'Thrasher', '573825389', 'Vacoas', 'mickael@gmail.com', '$2y$10$nE5aGZ4.fGzFJFC4XO2Yh.MgKNyxKbWEzhLd6Bt7m/vKW6T8oyZNS', '2025-05-05 17:36:23'),
(17, 'Mahery', 'Ifaliana', '57438579', 'QB', 'max@gmail.com', '$2y$10$D840wdPWxsoWG8d7jeXgEe84PrfHDmlR2fz2ymrIV.KczWoJijcuq', '2025-05-05 17:54:05'),
(18, 'Mahery', 'Ras', '5472873495', 'HP', 'ras@gmail.com', '$2y$10$eIwCogfbp/y6DOmfmLi8Suu80TQ44vPBMqcunzu45qLPbyw3Zi0YW', '2025-05-05 17:56:35'),
(21, 'Tomac', 'Eli', '574395287', 'MUR', 'tomac@gmail.com', '$2y$10$AiaXs1ULRllpOezvE/aoBO0AZzJAgGOWzaDjXPtoORhmCVZP0ISny', '2025-05-05 18:06:37'),
(22, 'Justin', 'Barcia', '5745297549', 'Souillac', 'justin@gmail.com', '$2y$10$7IIJXvOIt.JzgZfw3kyv/.TWl2y.tmJpHZmThWPzaUtLHfF8dGuQ.', '2025-05-06 06:32:45'),
(23, 'Justin', 'hills', '574392857', 'PLouis', 'hill@gmail.com', '$2y$10$QhkXuWt6M3xGNFpNh.4jKuUDvBtaC./lWl2JCrM5B4HKmhNeiCSAa', '2025-05-06 10:00:44'),
(24, 'Marie', 'marie', '45753645', 'Qbornes', 'marie@gmail.com', '$2y$10$fX2R8ALRiAWdHBtUV7xpDO99/t.JtfHMu9pGO20/16Lt3z4.f/fRG', '2026-03-29 17:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `voitures`
--

CREATE TABLE `voitures` (
  `id` int NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `prix` varchar(50) DEFAULT NULL,
  `km` varchar(50) DEFAULT NULL,
  `boite` varchar(50) DEFAULT NULL,
  `vmax` varchar(50) DEFAULT NULL,
  `moteur` varchar(100) DEFAULT NULL,
  `transmission` varchar(100) DEFAULT NULL,
  `puissance` varchar(50) DEFAULT NULL,
  `acceleration` varchar(50) DEFAULT NULL,
  `carburant` varchar(50) DEFAULT NULL,
  `cylindres` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `portes` varchar(10) DEFAULT NULL,
  `prix_reference` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `image`, `prix`, `km`, `boite`, `vmax`, `moteur`, `transmission`, `puissance`, `acceleration`, `carburant`, `cylindres`, `couleur`, `portes`, `prix_reference`) VALUES
(2, 'Mercedes', 'AMG C63', 'phodeos/c63.webp', '340000', '20', 'Auto', '280 km/h', 'V8 Biturbo', '0', '510 ch', '3.9 sec', 'Essence', '8', 'Noir', '4', 300000.00),
(3, 'Volkswagen', 'Golf R', 'phodeos/8r.jpeg', '50000', '15 000 km', 'DSG', '250 km/h', 'L4 Turbo', 'AWD', '320 ch', '4.5 sec', 'Essence', '4', 'Gris', '5', 45000.00),
(4, 'Ford', 'Focus RS', 'phodeos/focus.webp', '39000', '18 000 km', 'Manuelle', '240 km/h', 'L4 Turbo', 'AWD', '350 ch', '4.7 sec', 'Essence', '4', 'Bleu', '5', 40000.00),
(17, 'BMW', 'M3 Competition', 'phodeos/m2.jpg', '105000', '10 500 km', 'Automatique', '290 km/h', '3.0L I6 Biturbo', 'Propulsion', '510 ch', '3.9 s', 'Essence', '6', 'Vert', '4', 105000.00),
(18, 'BMW', 'i8 Roadster', 'phodeos/m5.jpg', '120000', '8 000 km', 'Automatique', '250 km/h', 'Hybride rechargeable', 'Transmission intégrale', '374 ch', '4.6 s', 'Hybride', '3', 'Blanc', '2', 120000.00),
(19, 'BMW', 'X6 M', 'phodeos/x6.webp', '115000', '12 300 km', 'Automatique', '290 km/h', '4.4L V8 Biturbo', 'Transmission intégrale', '625 ch', '3.8 s', 'Essence', '8', 'Noir', '5', 115000.00),
(20, 'Mercedes', 'AMG GT', 'phodeos/classg.jpg', '150000', '6 800 km', 'Automatique', '310 km/h', '4.0L V8 Biturbo', 'Propulsion', '585 ch', '3.7 s', 'Essence', '8', 'Jaune', '2', 150000.00),
(21, 'Mercedes', 'CLA 45 AMG', 'phodeos/a45.jpg', '79000', '14 000 km', 'Automatique', '270 km/h', '2.0L Turbo 4 cyl.', '4MATIC', '387 ch', '4.1 s', 'Essence', '4', 'Gris', '4', 79000.00),
(22, 'Mercedes', 'EQC 400', 'phodeos/maybach.jpg', '85000', '7 500 km', 'Automatique', '180 km/h', 'Électrique', '4MATIC', '408 ch', '5.1 s', 'Électrique', '0', 'Bleu nuit', '5', 85000.00),
(23, 'Volkswagen', 'Golf R', 'phodeos/7r.jpg', '55000', '15 000 km', 'Automatique', '250 km/h', '2.0L Turbo', 'Transmission intégrale', '320 ch', '4.8 s', 'Essence', '4', 'Bleu', '5', 55000.00),
(24, 'Volkswagen', 'Arteon R', 'phodeos/tiguan.jpg', '63000', '12 000 km', 'Automatique', '270 km/h', '2.0L TSI', 'Transmission intégrale', '320 ch', '4.9 s', 'Essence', '4', 'Noir', '5', 63000.00),
(25, 'Volkswagen', 'ID.5 GTX', 'phodeos/touareg.jpg', '59000', '5 500 km', 'Automatique', '180 km/h', 'Électrique', 'Transmission intégrale', '299 ch', '6.3 s', 'Électrique', '0', 'Blanc nacré', '5', 59000.00),
(26, 'Ford', 'Mustang GT', 'phodeos/kuga.jpg', '68000', '11 500 km', 'Manuelle', '250 km/h', '5.0L V8', 'Propulsion', '450 ch', '4.5 s', 'Essence', '8', 'Rouge', '2', 68000.00),
(27, 'Ford', 'Focus RS', 'phodeos/fiesta.jpg', '45000', '13 200 km', 'Manuelle', '266 km/h', '2.3L Turbo', 'Transmission intégrale', '350 ch', '4.7 s', 'Essence', '4', 'Bleu', '5', 45000.00),
(28, 'Ford', 'Explorer PHEV', 'phodeos/explorer.webp', '72000', '9 000 km', 'Automatique', '230 km/h', 'Hybride rechargeable', 'Transmission intégrale', '457 ch', '6.0 s', 'Hybride', '6', 'Gris', '5', 72000.00),
(29, 'BMW', 'BMW1', 'phodeos/tesla.webp', '8973913', '37273', 'Manuel', '150', 'diesel', 'jdkjsk', '129', '1283', ';lsjhd', '182', 'rouge', '4', 8973913.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bienvenu`
--
ALTER TABLE `bienvenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandes_essai`
--
ALTER TABLE `demandes_essai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evenementintro`
--
ALTER TABLE `evenementintro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historique_demandes_essai`
--
ALTER TABLE `historique_demandes_essai`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `marqueintro`
--
ALTER TABLE `marqueintro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bienvenu`
--
ALTER TABLE `bienvenu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `demandes_essai`
--
ALTER TABLE `demandes_essai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `evenementintro`
--
ALTER TABLE `evenementintro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `historique_demandes_essai`
--
ALTER TABLE `historique_demandes_essai`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marqueintro`
--
ALTER TABLE `marqueintro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
