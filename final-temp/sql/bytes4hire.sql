-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 22 Απρ 2021 στις 14:34:27
-- Έκδοση διακομιστή: 10.4.11-MariaDB
-- Έκδοση PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `bytes4hire`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `exp_levels`
--

CREATE TABLE `exp_levels` (
  `id` int(11) NOT NULL,
  `exp_level` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `exp_levels`
--

INSERT INTO `exp_levels` (`id`, `exp_level`) VALUES
(1, 'Junior'),
(2, 'Senior'),
(3, 'Director'),
(4, 'Mid-Level');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(11) NOT NULL,
  `title_name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `job_titles`
--

INSERT INTO `job_titles` (`id`, `title_name`) VALUES
(2, 'Data Analyst'),
(4, 'Full Stack Developer'),
(1, 'Other'),
(3, 'Web Designer');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `job_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `job_level` int(11) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_rate` int(11) NOT NULL,
  `techs` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `location` varchar(50) COLLATE utf8_bin DEFAULT 'Remote',
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp(),
  `status` varchar(10) COLLATE utf8_bin DEFAULT 'Open',
  `last_edit` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `payment_rates`
--

CREATE TABLE `payment_rates` (
  `id` int(11) NOT NULL,
  `rate` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `payment_rates`
--

INSERT INTO `payment_rates` (`id`, `rate`) VALUES
(3, 'Annually'),
(4, 'Full Payment'),
(1, 'Hourly'),
(2, 'Monthly');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Business'),
(3, 'Freelancer'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `techs`
--

CREATE TABLE `techs` (
  `id` int(11) NOT NULL,
  `tech_name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `techs`
--

INSERT INTO `techs` (`id`, `tech_name`) VALUES
(5, 'C'),
(7, 'C#'),
(6, 'C++'),
(9, 'Fortran'),
(1, 'Java'),
(3, 'Kotlin'),
(4, 'PHP'),
(2, 'Python'),
(8, 'Ruby');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL,
  `status` varchar(20) COLLATE utf8_bin DEFAULT 'Pending Confirmation',
  `registration_date` datetime DEFAULT current_timestamp(),
  `last_status_change` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `role`, `status`, `registration_date`, `last_status_change`, `last_update`, `last_login`) VALUES
(13, 'testreg', 'test@test.com', '$2y$10$r6VzkOT7a.l1YD9CTJsR4ON4.Q.BxHSAIoE76GhdJU9OCs7k3g4ce', 'Admin', 'Pending Confirmation', '2021-04-21 18:03:05', '2021-04-21 18:03:05', '2021-04-21 18:03:05', '2021-04-22 14:03:48');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user_techs`
--

CREATE TABLE `user_techs` (
  `id` int(11) NOT NULL,
  `tech_name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user_titles`
--

CREATE TABLE `user_titles` (
  `id` int(11) NOT NULL,
  `title_name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `exp_levels`
--
ALTER TABLE `exp_levels`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_name` (`title_name`);

--
-- Ευρετήρια για πίνακα `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `job_level` (`job_level`),
  ADD KEY `payment_rate` (`payment_rate`);

--
-- Ευρετήρια για πίνακα `payment_rates`
--
ALTER TABLE `payment_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rate` (`rate`);

--
-- Ευρετήρια για πίνακα `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Ευρετήρια για πίνακα `techs`
--
ALTER TABLE `techs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tech_name` (`tech_name`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleID` (`role`);

--
-- Ευρετήρια για πίνακα `user_techs`
--
ALTER TABLE `user_techs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tech_name` (`tech_name`);

--
-- Ευρετήρια για πίνακα `user_titles`
--
ALTER TABLE `user_titles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_name` (`title_name`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `exp_levels`
--
ALTER TABLE `exp_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT για πίνακα `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `payment_rates`
--
ALTER TABLE `payment_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `techs`
--
ALTER TABLE `techs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT για πίνακα `user_techs`
--
ALTER TABLE `user_techs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `user_titles`
--
ALTER TABLE `user_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `listings_ibfk_2` FOREIGN KEY (`job_level`) REFERENCES `exp_levels` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `listings_ibfk_3` FOREIGN KEY (`payment_rate`) REFERENCES `payment_rates` (`id`) ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
