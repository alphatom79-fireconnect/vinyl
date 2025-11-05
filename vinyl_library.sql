-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 05, 2025 at 06:38 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinyl_library`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `track_number` int(11) NOT NULL,
  `track_title` varchar(255) NOT NULL,
  `duration` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `record_id`, `track_number`, `track_title`, `duration`) VALUES
(2, 3, 1, 'Święte słowa', '02:30:00'),
(3, 3, 2, 'Dla kontrastu', '03:48:00'),
(4, 3, 3, 'Maluję twój obraz', '03:19:00'),
(5, 3, 4, 'Wielki oczy', '03:37:00'),
(6, 3, 5, 'Czarne chmury', '03:09:00'),
(7, 3, 6, 'Kechup', '03:18:00'),
(8, 3, 7, 'Preferuję prosty przekaz', '03:18:00'),
(9, 3, 8, 'Za dużo słów', '03:52:00'),
(10, 3, 9, 'Tata z mikrofonem', '03:18:00'),
(11, 3, 10, 'Oto ciało moje', '04:02:00'),
(12, 3, 11, 'Umami', '03:08:00'),
(13, 3, 12, 'Suma wszystkich strachów', '03:07:00'),
(14, 4, 1, 'Mój Projekt, Moje Życie', '00:04:55'),
(15, 4, 2, 'Regeneracja', '00:04:30'),
(16, 4, 3, 'Anioł Stróż', '00:04:30'),
(17, 4, 4, 'Dziś Nie Jest Tak Jak Trzeba', '00:03:26'),
(18, 4, 5, 'Dystans', '00:04:30'),
(19, 4, 6, 'Szach Mat', '00:04:28'),
(20, 4, 7, 'Furrora', '00:04:55'),
(21, 4, 8, 'Rap Fleszbek', '00:03:30'),
(22, 4, 9, 'Taki Cel', '00:05:17'),
(23, 4, 10, 'Opanuj Strach', '00:04:52'),
(24, 4, 11, 'Głos Rozsądku', '00:03:55'),
(25, 4, 12, 'Prosta Sprawa', '00:05:28'),
(26, 4, 13, 'Czy Na Pewno', '00:04:14'),
(27, 4, 14, 'Rozglądam Się', '00:04:33'),
(28, 4, 15, 'Mój Aspekt', '00:04:17'),
(29, 5, 1, 'Hollywood Smile', '00:03:26'),
(30, 5, 2, 'Mewa', '00:03:12'),
(31, 5, 3, 'Tyrmand i Hłasko', '00:04:04'),
(32, 5, 4, 'Zszedłem Ze Sceny', '00:02:51'),
(33, 5, 5, 'Miłość na sprzedaż', '00:03:19'),
(34, 5, 6, 'Jan Paweł', '00:02:51'),
(35, 5, 7, 'Tatuaże i Motocykle', '00:03:29'),
(36, 5, 8, 'Stare WWO', '00:03:13'),
(37, 5, 9, 'Tonic Espresso', '00:03:06'),
(38, 5, 10, 'Dom Nad Wodą', '00:03:15'),
(39, 5, 11, 'Nikogo Nie Kocham', '00:03:16'),
(40, 5, 12, 'Gangi w LA', '00:02:47'),
(41, 5, 13, 'Daddy Issues', '00:03:41'),
(42, 5, 14, 'Business Class', '00:03:51'),
(43, 5, 15, 'Tonący', '00:04:35'),
(44, 5, 16, 'Time For Us', '00:04:06'),
(45, 6, 1, 'Wiatruczas', '00:03:20'),
(46, 6, 2, 'Nie ma czasu by pomyśleć', '00:04:43'),
(47, 6, 3, 'Friko', '00:03:41'),
(48, 6, 4, 'Każdy ma chwile', '00:05:17'),
(49, 6, 5, 'Spacer', '00:01:03'),
(50, 6, 6, 'Nie ma skróconych dróg', '00:04:01'),
(51, 6, 7, 'Mówią mi', '00:04:57'),
(52, 6, 8, 'Puste pokoje (Bębny grają miks)', '00:04:15'),
(53, 6, 9, 'Jest już późno, piszę...', '00:03:21'),
(54, 6, 10, 'Pamiętam', '00:04:19'),
(55, 6, 11, 'Wiatrucień', '00:02:58'),
(56, 7, 1, 'XX Przedsłowie', '00:00:47'),
(57, 7, 2, 'Obiecana ziemia', '00:03:23'),
(58, 7, 3, 'Wierszokleta', '00:03:14'),
(59, 7, 4, 'Czarny czwartek', '00:03:14'),
(60, 7, 5, 'Kercelak', '00:03:12'),
(61, 7, 6, 'Okultystyczny Zefir', '00:02:57'),
(62, 7, 7, 'Złoty róg', '00:03:32'),
(63, 7, 8, 'Zima stulecia (skit)', '00:01:47'),
(64, 7, 9, 'Na widoku', '00:03:03'),
(65, 7, 10, '7 palców', '00:03:12'),
(66, 7, 11, 'Tango porcjarza', '00:03:21'),
(67, 7, 12, 'Belweder', '00:03:24'),
(68, 7, 13, 'XX Sztych', '00:03:24'),
(69, 8, 1, 'Dla ludzi - Skit', '00:00:41'),
(70, 8, 2, 'Właściwy wybór', '00:04:32'),
(71, 8, 3, 'Być nie mieć', '00:04:01'),
(72, 8, 4, 'Nie-kocham hip-hop', '00:03:58'),
(73, 8, 5, 'Kolejny stracony dzień', '00:05:49'),
(74, 8, 6, 'WOS', '00:03:35'),
(75, 8, 7, 'I moje miasto złą sławą owiane...', '00:08:14'),
(76, 8, 8, 'Dla frajerstwa - skit', '00:00:30'),
(77, 8, 9, 'Jest jedna rzecz', '00:04:19'),
(78, 8, 10, 'Bit w bit - skit', '00:00:37'),
(79, 8, 11, 'Głucha noc', '00:05:09'),
(80, 8, 12, 'Randori', '00:04:32'),
(81, 8, 13, 'Mój rap moja rzeczywistość', '00:03:53'),
(82, 8, 14, 'O tym, co było i o tym, co jest teraz', '00:03:48'),
(83, 8, 15, 'Dario Invarder Poland', '00:01:28'),
(84, 8, 16, 'Jest jedna rzecz - mix', '00:04:41'),
(85, 9, 1, 'Intro', '00:01:08'),
(86, 9, 2, 'Klima', '00:03:59'),
(87, 9, 3, 'Kontroluję się', '00:04:31'),
(88, 9, 4, 'Armagedon', '00:03:01'),
(89, 9, 5, '28.09.97', '00:02:36'),
(90, 9, 6, 'Wolę się nastukać', '00:06:02'),
(91, 9, 7, 'Wiedziałem, że tak będzie', '00:05:41'),
(92, 9, 8, 'Xeroboy', '00:03:01'),
(93, 9, 9, 'Szacunek', '00:04:22'),
(94, 9, 10, 'Się żyje', '00:05:02'),
(95, 9, 11, 'P.K.U. (Patrz komu ufasz)', '00:03:26'),
(96, 9, 12, 'Upadek', '00:04:03'),
(97, 9, 13, 'Jeszcze jedno', '00:04:20'),
(98, 9, 14, 'Osiedlowe akcje', '00:04:15'),
(99, 9, 15, 'Sztuki', '00:04:09'),
(100, 9, 16, 'Wiedziałem, że tak będzie - mix', '00:05:55'),
(101, 9, 17, 'Outro', '00:00:52'),
(102, 10, 1, 'Obudź się', '00:04:52'),
(103, 10, 2, 'Na linii frontu', '00:04:18'),
(104, 10, 3, 'Amnezja', '00:05:36'),
(105, 10, 4, 'Jedność', '00:03:43'),
(106, 10, 5, 'Narkotyki', '00:02:48'),
(107, 10, 6, 'Coś z niczego', '00:03:10'),
(108, 10, 7, 'Zwykły dzieciak z ulicy', '00:04:15'),
(109, 10, 8, 'Outro', '00:02:10'),
(110, 10, 9, 'Jedność', '00:04:13'),
(111, 10, 10, 'Amnezja', '00:05:19'),
(112, 11, 1, 'Braterstwo', '00:05:00'),
(113, 11, 2, 'Wiem, że jest warto', '00:04:12'),
(114, 11, 3, 'Uliczna liryka', '00:05:00'),
(115, 11, 4, 'Warszawa da się lubic', '00:05:05'),
(116, 11, 5, 'Mary Mary', '00:04:55'),
(117, 11, 6, 'Sprankster', '00:03:34'),
(118, 11, 7, 'Rok smoka', '00:04:05'),
(119, 11, 8, 'Na luzingu', '00:03:03'),
(120, 11, 9, 'Moja dzielnica', '00:04:22'),
(121, 11, 10, 'Outro', '00:02:57'),
(122, 11, 11, 'Jedność', '00:03:56'),
(123, 11, 12, 'Warszawa da się lubić', '00:04:50'),
(124, 11, 13, 'Moja dzielnica', '00:05:09'),
(125, 11, 14, 'Uliczna liryka', '00:04:27'),
(126, 12, 1, 'Zapomniani bohaterowie', '00:04:14'),
(127, 12, 2, 'Dwa spojrzenia', '00:04:18'),
(128, 12, 3, 'Kiedy zabraknie słońca', '00:03:55'),
(129, 12, 4, 'Daj żyć', '00:04:16'),
(130, 12, 5, 'Motywacja', '00:05:01'),
(131, 12, 6, 'Dill gang', '00:05:48'),
(132, 12, 7, 'Loc wojownika', '00:03:53'),
(133, 12, 8, 'Outro', '00:03:43'),
(134, 12, 9, 'Dwa spojrzenia', '00:04:18'),
(135, 12, 10, 'Los wojownika', '00:04:37'),
(136, 13, 1, 'Start', '00:04:00'),
(137, 13, 2, 'Jestem tu', '00:03:34'),
(138, 13, 3, 'Gdzie ta ekipa?', '00:03:38'),
(139, 13, 4, 'Moje życie', '00:03:41'),
(140, 13, 5, 'Nie jestem wzorem świętości', '00:04:31'),
(141, 13, 6, 'Szukam wyjścia', '00:04:04'),
(142, 13, 7, 'Jeden z was', '00:05:02'),
(143, 13, 8, 'Syf tych ulic', '00:03:51'),
(144, 13, 9, 'Jest nas dwóch', '00:03:34'),
(145, 13, 10, 'Dranie tak mają', '00:04:42'),
(146, 13, 11, 'Niesiemy prawdę 2', '00:05:59'),
(147, 13, 12, 'Już ci mówię', '00:04:36'),
(148, 13, 13, 'Na cenzurowanym', '00:04:11'),
(149, 13, 14, 'Kartki i myśli', '00:02:56'),
(150, 13, 15, 'Tego nie da się naprawić', '00:04:02'),
(151, 13, 16, 'To koniec', '00:03:08'),
(152, 14, 1, 'O II (słowa na wiatr)', '00:04:40'),
(153, 14, 2, 'List do K.', '00:03:41'),
(154, 14, 3, 'Opowieść o krainie lodu', '00:02:41'),
(155, 14, 4, 'Krzyk', '00:04:37'),
(156, 14, 5, 'Rzeźnik z Blavikiem', '00:04:13'),
(157, 14, 6, 'Ballada o panu lusterko', '00:05:33'),
(158, 14, 7, 'Miłość bez ść', '00:06:00'),
(159, 14, 8, 'Black sky', '00:03:40'),
(160, 14, 9, 'Sen nocy letniej', '00:04:14'),
(161, 14, 10, 'August Ames', '00:04:04'),
(162, 14, 11, 'Sprandi', '00:04:27'),
(163, 14, 12, 'Art deco', '00:04:37'),
(164, 14, 13, 'Nie, bo piękna', '00:04:35'),
(165, 14, 14, 'Lugia', '00:03:16'),
(166, 14, 15, 'Błędny rycerz', '00:04:00'),
(167, 14, 16, 'вне общества', '00:04:02'),
(168, 14, 17, 'Wróg', '00:02:43'),
(169, 14, 18, 'Doppler', '00:02:30'),
(170, 14, 19, 'Nigdy więcej', '00:04:40'),
(171, 14, 20, 'Articuno', '00:03:16'),
(172, 14, 21, 'Pani jeziora', '00:04:14'),
(173, 14, 22, 'Ballada o dawnym życiu', '00:04:02'),
(174, 14, 23, 'Ostatnie życzenie', '00:03:31'),
(175, 15, 1, 'FCMT', '00:04:00'),
(176, 15, 2, 'Senymenalnie', '00:03:51'),
(177, 15, 3, 'Street Wear', '00:03:48'),
(178, 15, 4, '#john_rambo', '00:03:21'),
(179, 15, 5, 'Fame Lover', '00:04:13'),
(180, 15, 6, 'Mirafiori', '00:03:47'),
(181, 15, 7, 'FEAT Preludium', '00:01:30'),
(182, 15, 8, 'FEAT', '00:03:49'),
(183, 15, 9, 'Stworzeni by wygrywać', '00:03:20'),
(184, 15, 10, 'Dom rapu', '00:03:45'),
(185, 15, 11, '#DLS', '00:04:26'),
(186, 15, 12, 'Kaman', '00:02:52'),
(187, 15, 13, 'CMRT', '00:03:28'),
(188, 15, 14, 'Najba muzik', '00:04:45'),
(189, 15, 15, 'Real HipHop', '00:03:09'),
(190, 15, 16, 'Tłek', '00:03:23'),
(191, 15, 17, 'Najaraj się Marią', '00:03:49'),
(192, 15, 18, 'J23', '00:04:29'),
(193, 15, 19, 'Trinity', '00:03:57'),
(194, 15, 20, 'Słag kogz dupy', '00:04:01'),
(195, 15, 21, 'Warszawa da ci fejm', '00:03:52'),
(196, 15, 22, 'Kara&#039;van', '00:03:53'),
(197, 15, 23, 'Sekretna Socjeta', '00:03:13'),
(198, 15, 24, 'Nic nie jest na zawsze', '00:04:23'),
(199, 15, 25, 'Fryderyk_chopin', '00:04:06'),
(200, 15, 26, 'To coś', '00:04:06'),
(201, 15, 27, '#gimb_money', '00:04:06'),
(202, 16, 1, 'Intro', '00:01:08'),
(203, 16, 2, 'Wyrok', '00:03:04'),
(204, 16, 3, 'Teoria fikcji', '00:04:07'),
(205, 16, 4, 'Kciuk w dół', '00:04:20'),
(206, 16, 5, 'Deszcz meteorytów', '00:03:55'),
(207, 16, 6, 'Siła pokoju', '00:04:12'),
(208, 16, 7, 'Przygotuj się na sztorm', '00:04:23'),
(209, 16, 8, 'Oni mogliby', '00:04:08'),
(210, 16, 9, 'Tak i nie', '00:03:43'),
(211, 16, 10, 'Rosyjska ruletka', '00:04:05'),
(212, 16, 11, 'Z miejsca, gdzie...', '00:03:15'),
(213, 16, 12, 'Czwórka', '00:05:18'),
(214, 16, 13, 'Moja droga', '00:04:20'),
(215, 16, 14, 'Gwóźdź programu', '00:03:21'),
(216, 16, 15, 'Outro', '00:00:46'),
(217, 16, 16, 'Grrrrubas', '00:04:30'),
(218, 16, 17, 'Grrrubas - Remix', '00:04:00'),
(219, 16, 18, 'Powietrze - Remix', '00:04:01'),
(220, 16, 19, 'Our Peoples Rejocing - Mix', '00:04:38'),
(221, 17, 1, 'Intro', '00:00:34'),
(222, 17, 2, 'Masz i pomyśl', '00:03:01'),
(223, 17, 3, 'Dwa sumienia', '00:05:44'),
(224, 17, 4, 'Międzynarodowa - Skit', '00:01:40'),
(225, 17, 5, 'W witrynach odbicia', '00:04:06'),
(226, 17, 6, 'Jeszcze będzie czas', '00:03:53'),
(227, 17, 7, 'Nie ma załamka', '00:03:26'),
(228, 17, 8, 'Polskie realia', '00:03:29'),
(229, 17, 9, 'Krytyczna sytuacja', '00:02:53'),
(230, 17, 10, 'Pozorna harmonia', '00:04:09'),
(231, 17, 11, 'Ryzyko', '00:03:46'),
(232, 17, 12, 'O.S.W. - Skit', '00:00:39'),
(233, 17, 13, 'Obejrzyj sobie wiadomości', '00:03:38'),
(234, 17, 14, 'Desiderata', '00:03:04'),
(235, 17, 15, 'Pozostała kwota - Skit', '00:00:19'),
(236, 17, 16, 'Ile jeszcze', '00:02:57'),
(237, 17, 17, 'W.D.C.S.D. kończy', '00:05:29'),
(238, 17, 18, 'Uszanuj 2', '00:06:08'),
(239, 17, 19, 'Nie pisz czarnych scenariuszy', '00:03:04'),
(240, 17, 20, 'Dobro i zło', '00:03:27'),
(241, 18, 1, 'Intro', '00:01:32'),
(242, 18, 2, 'Powietrze', '00:04:07'),
(243, 18, 3, 'Dziś Judaszu, wczoraj bracie', '00:04:10'),
(244, 18, 4, 'Tok później', '00:04:12'),
(245, 18, 5, 'Kolejny raz', '00:03:27'),
(246, 18, 6, 'Tru luv', '00:04:13'),
(247, 18, 7, 'Taka prawda', '00:03:37'),
(248, 18, 8, 'Roluj, roluj', '00:04:38'),
(249, 18, 9, 'Jestem tutaj', '00:03:05'),
(250, 18, 10, 'Każdy ponad każdym', '00:06:39'),
(251, 18, 11, 'Dokładnie w twoich uszach', '00:03:10'),
(252, 18, 12, 'Our people&#039;s rejoice', '00:04:45'),
(253, 18, 13, 'Chwile prawdy', '00:04:04'),
(254, 18, 14, 'Zostaw', '00:03:54'),
(255, 18, 15, 'Droga otwarta', '00:03:53'),
(256, 18, 16, 'Outro', '00:03:47'),
(257, 18, 17, 'Fristajl', '00:03:02'),
(258, 18, 18, 'Rok później - instrumental', '00:04:08'),
(259, 18, 19, 'Każdy ponad każdym - Instrumental', '00:02:44'),
(260, 18, 20, 'Droga otwarta - Instrumental', '00:03:52'),
(261, 19, 1, 'O.R.S. - Początek', '00:02:23'),
(262, 19, 2, 'Nowa fala', '00:04:12'),
(263, 19, 3, 'Spiesz się powoli', '00:04:45'),
(264, 19, 4, 'Nie ma nic', '00:04:24'),
(265, 19, 5, 'Na szczycie', '00:04:04'),
(266, 19, 6, 'One', '00:03:42'),
(267, 19, 7, 'Nie nie nie', '00:04:40'),
(268, 19, 8, 'Moc', '00:02:43'),
(269, 19, 9, 'Siebie mi daj', '00:03:33'),
(270, 19, 10, 'Ruffneck', '00:03:31'),
(271, 19, 11, 'Kiedy byłem - Skit', '00:01:40'),
(272, 19, 12, 'Biba', '00:03:23'),
(273, 19, 13, 'Przestań się bać', '00:04:13'),
(274, 19, 14, 'Bo to Polska', '00:04:04'),
(275, 19, 15, 'Nie ma to jak', '00:03:44'),
(276, 19, 16, 'Jak wczoraj', '00:02:58'),
(277, 19, 17, 'Koniec', '00:04:41'),
(278, 19, 18, 'Nowa fala', '00:06:03'),
(279, 19, 19, 'Porobi się', '00:04:46'),
(280, 20, 1, 'Intro', '00:01:45'),
(281, 20, 2, 'W imię czego?', '00:03:39'),
(282, 20, 3, 'Graffiti', '00:03:56'),
(283, 20, 4, 'Wskaż co chcesz', '00:02:33'),
(284, 20, 5, 'Beztrosko?', '00:03:39'),
(285, 20, 6, 'Prawdziwe wartości', '00:02:44'),
(286, 20, 7, 'Determinacja', '00:04:53'),
(287, 20, 8, 'Póki co', '00:02:30'),
(288, 20, 9, 'Czas dokonać wyboru', '00:03:31'),
(289, 20, 10, 'Skit JF', '00:00:47'),
(290, 20, 11, 'Niezliczona ilość dni', '00:03:33'),
(291, 20, 12, 'Tak to wygląda', '00:03:23'),
(292, 20, 13, 'Jeden strzał', '00:03:36'),
(293, 20, 14, 'Ukryte zwierzę', '00:03:09'),
(294, 20, 15, 'Przyjdź na chwile', '00:03:15'),
(295, 20, 16, 'Outro', '00:01:25'),
(326, 23, 1, '#1', '03:27:00'),
(327, 23, 2, 'Halo', '02:21:00'),
(328, 23, 3, 'Na tym osiedlu', '04:32:00'),
(329, 23, 4, 'Lubie', '03:33:00'),
(330, 23, 5, 'Nie tylko hit na lato', '03:45:00'),
(331, 23, 6, 'Pezet jak', '03:15:00'),
(332, 23, 7, 'Niegrzeczna', '04:20:00'),
(333, 23, 8, 'Noc i dzień', '04:51:00'),
(334, 23, 9, 'Mamy ten styl', '03:59:00'),
(335, 23, 10, 'Pornogwiazdy', '05:15:00'),
(336, 23, 11, 'Lojalność', '03:18:00'),
(337, 23, 12, 'Seksmisja', '04:26:00'),
(338, 23, 13, 'Czterdzieściprocent', '03:04:00'),
(339, 23, 14, 'Takie jak Ty', '03:51:00'),
(340, 23, 15, 'Gdyby miało nie być jutra', '04:04:00'),
(341, 24, 1, 'Intro', '00:00:37'),
(342, 24, 2, 'NNWNW', '00:03:34'),
(343, 24, 3, 'Lepsze życie', '00:06:04'),
(344, 24, 4, 'Porcja czwarta', '00:00:20'),
(345, 24, 5, 'Śródmieście południowe', '00:04:00'),
(346, 24, 6, 'Porcja szósta', '00:00:05'),
(347, 24, 7, 'Prawilini', '00:05:40'),
(348, 24, 8, 'Być sobą', '00:05:25'),
(349, 24, 9, 'Rap zajawka', '00:05:57'),
(350, 24, 10, 'Porcja dziesiąta', '00:00:48'),
(351, 24, 11, 'Jest jak jest', '00:05:47'),
(352, 24, 12, 'Tragikomedia', '00:06:38'),
(353, 24, 13, 'Zawodowstwo', '00:05:35'),
(354, 24, 14, 'Noc', '00:06:00'),
(355, 24, 15, 'Agresja', '00:03:36'),
(356, 24, 16, 'Orient', '00:02:46'),
(357, 24, 17, 'Porcja siedemnasta', '00:00:18'),
(358, 24, 18, 'Ziping (na tym sztuka polega)', '00:03:51'),
(359, 24, 19, 'Ostatnia kropla', '00:04:16'),
(360, 24, 20, 'Po drodze', '00:04:27'),
(361, 25, 1, 'Start', '00:01:14'),
(362, 25, 2, 'Szkoła', '00:03:54'),
(363, 25, 3, 'Maradona', '00:02:48'),
(364, 25, 4, 'Discopolo', '00:04:55'),
(365, 25, 5, '20 to już nie 04', '00:03:06'),
(366, 25, 6, 'Religia', '00:03:34'),
(367, 25, 7, 'Styl', '00:04:12'),
(368, 25, 8, 'Woda taka głęboka', '00:03:49'),
(369, 25, 9, 'Powiedz na osiedlu 2020', '00:04:36'),
(370, 25, 10, 'Popiół', '00:03:59'),
(371, 25, 11, 'Do widzenia', '00:03:15'),
(372, 25, 12, 'Stop', '00:01:48'),
(373, 26, 1, 'Liroy – Scoobiedoo Ya', '00:03:35'),
(374, 26, 2, 'Young Leosia, bambi, PG$, francis – Te numery', '00:02:37'),
(375, 26, 3, 'Szczyl – Hiphopkryta', '00:02:25'),
(376, 26, 4, 'Sokół feat. Taco Hemingway, PRO8L3M - Napad na bankiet', '00:04:48'),
(377, 26, 5, 'White 2115, Pedro, DKanee - Spadająca gwiazda', '00:02:28'),
(378, 26, 6, 'Żabson - JOHNNY DANG', '00:03:01'),
(379, 26, 7, 'Molesta Ewenement – Wiedziałem, że tak będzie', '00:05:42'),
(380, 26, 8, 'Rosalie., Chloe Martini – Stracona głowa', '00:02:43'),
(381, 26, 9, 'Sapi Tha King, Kubi Producent, Traperhoff – 10K20K', '00:03:04'),
(382, 26, 10, 'HIFI Banda – Puszer', '00:05:53'),
(383, 26, 11, 'Pezet – Magenta (prod. Auer)', '00:03:20'),
(384, 26, 12, 'DJ 600V feat. Kaliber 44 – Ja się wcale nie chwalę', '00:04:24'),
(385, 26, 13, 'Magiera feat. Sobel – Drobna zabawa', '00:03:25'),
(386, 26, 14, 'Hemp Gru – To jest to', '00:03:50'),
(387, 26, 15, 'Hodak, 2K, Deemz – Oh No!', '00:03:00'),
(388, 26, 16, 'Rasmentalism, Quebonafide - Wyjdziesz na dwór?', '00:03:37'),
(389, 26, 17, 'Kubi Producent, Szpaku, Tulia - Pusty pokój, ale płyty diamentowe', '00:03:14'),
(390, 26, 18, 'Wzgórze Ya-Pa-3 – Ja mam to co Ty', '00:04:09'),
(391, 26, 19, 'Miły ATZ, @atutowy – Day Off', '00:03:54'),
(392, 26, 20, 'TEDE, Sir mich – Ostatnia noc', '00:03:21'),
(393, 26, 21, 'Fisz, Emade – Czerwona sukienka', '00:05:35'),
(394, 26, 22, 'Solar, Białas – Intercontinental bajers', '00:03:57'),
(395, 27, 1, 'Po przerwie', '00:04:49'),
(396, 27, 2, 'Raport z regionu', '00:04:35'),
(397, 27, 3, 'Obrachunek moralny 2', '00:04:39'),
(398, 27, 4, 'Jeszcze więcej ognia', '00:04:11'),
(399, 27, 5, 'Najlepszy towar', '00:03:51'),
(400, 27, 6, 'Syn Bogdana', '00:04:12'),
(401, 27, 7, 'Nigdy poniżej oczekiwań', '00:04:12'),
(402, 27, 8, 'Nie chcę być taki jak oni', '00:05:31'),
(403, 27, 9, 'Szum', '00:03:35'),
(404, 27, 10, 'Tak to zwykle się kończy', '00:04:34'),
(405, 27, 11, 'Myśli i kartki', '00:03:29'),
(406, 27, 12, 'O własnych siłach', '00:03:50'),
(407, 27, 13, 'Urywki wspomnień', '00:03:31'),
(408, 27, 14, 'Stan gotowości', '00:04:13'),
(409, 27, 15, 'Pomyślności', '00:05:08'),
(414, 28, 1, 'A.G.R.O. stop', '05:08:00'),
(415, 28, 2, 'Centrum', '03:05:00'),
(416, 28, 3, 'Hip Hop', '03:54:00'),
(417, 28, 4, 'Wzgórze na scenie', '03:26:00'),
(418, 28, 5, 'Palenie II', '03:54:00'),
(419, 28, 6, 'D.I.L.', '04:49:00'),
(420, 28, 7, 'Przemoc', '04:07:00'),
(421, 28, 8, 'Język polski', '07:09:00'),
(422, 28, 9, 'Zalegalizować', '03:51:00'),
(423, 28, 10, 'P.A.R.K.', '03:43:00'),
(424, 28, 11, 'Czekam', '03:30:00'),
(425, 28, 12, 'Agro schody', '05:58:00'),
(426, 28, 13, 'Wzgórze na scenie (V.O.L.T. remix)', '03:47:00'),
(427, 29, 1, 'W/88', '00:00:58'),
(428, 29, 2, 'No Love', '00:03:44'),
(429, 29, 3, 'Krzew', '00:04:20'),
(430, 29, 4, 'Żakardy', '00:02:39'),
(431, 29, 5, 'N D Z W', '00:03:48'),
(432, 29, 6, 'Jak gdyby nic', '00:02:29'),
(433, 29, 7, 'Tego się trzymam', '00:03:10'),
(434, 29, 8, 'Stilo', '00:04:19'),
(435, 29, 9, 'Stworzony', '00:03:34'),
(436, 29, 10, 'Jeszcze wczoraj', '00:03:06'),
(437, 29, 11, 'Wyobraź sobie - remix', '00:04:23'),
(438, 29, 12, 'Połamane skrzydła', '00:03:33');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `last_login`) VALUES
(1, 'admin', '$2a$12$3baz4xGTYhxRMMjW0anD1Oaxyw1xd8FWiY.jlbMbR1WXbs5sPNXn2', 'admin@example.com', '2025-09-12 05:52:43', '2025-11-05 17:00:45');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `csrf_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vinyl_records`
--

CREATE TABLE `vinyl_records` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_year` year(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vinyl_records`
--

INSERT INTO `vinyl_records` (`id`, `artist`, `title`, `release_year`, `price`, `cover_image`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 'Małpa', 'Święte słowa', '2025', 135.00, 'cover_68c66831223bb.jpeg', '2025-09-14 07:01:05', '2025-09-14 07:23:09', 1),
(4, 'Fu', 'Futurum', '2002', 115.00, 'cover_68c673f3e2ddd.png', '2025-09-14 07:51:15', '2025-09-14 07:51:15', 1),
(5, 'Pezet', 'Muzuka komercyjna', '2022', 199.00, 'cover_68c7f1607670a.jpg', '2025-09-15 10:58:40', '2025-09-15 10:58:40', 1),
(6, 'Grammatik', 'Światła miasta', '2000', 99.00, 'cover_68c7f327586d0.jpeg', '2025-09-15 11:06:15', '2025-09-15 11:06:15', 1),
(7, 'O.S.T.R.', 'XX', '2024', 109.00, 'cover_68c953fcb7790.jpg', '2025-09-16 12:11:40', '2025-09-16 12:11:40', 1),
(8, 'Peja', 'Na legalu?', '2001', 189.00, 'cover_68d1268ae647b.jpg', '2025-09-22 10:35:54', '2025-09-22 10:35:54', 1),
(9, 'Molesta', 'Skandal', '1998', 99.00, 'cover_68d128709dc54.jpeg', '2025-09-22 10:44:00', '2025-09-22 10:44:00', 1),
(10, 'Hemp GRU', 'Jedność', '2011', 133.00, 'cover_68d281a957d25.jpeg', '2025-09-23 11:16:57', '2025-09-23 11:16:57', 1),
(11, 'Hemp GRU', 'Braterstwo', '2012', 133.00, 'cover_68d282d566a62.jpeg', '2025-09-23 11:21:57', '2025-09-23 11:21:57', 1),
(12, 'Hemp GRU', 'Lojalność', '2011', 133.00, 'cover_68d283f842ff7.jpg', '2025-09-23 11:26:48', '2025-09-23 11:26:48', 1),
(13, 'Chada', 'Jeden z was', '2012', 129.00, 'cover_68d2856083d11.jpg', '2025-09-23 11:32:48', '2025-09-23 11:32:48', 1),
(14, 'Kartky', 'Kraina lodu', '2021', 187.77, 'cover_68d2888eeb78f.jpg', '2025-09-23 11:46:22', '2025-09-23 11:46:22', 1),
(15, 'Tede', 'Kurt Rolson', '2014', 99.00, 'cover_68d51e9bd1373.jpg', '2025-09-25 10:51:07', '2025-09-25 10:51:07', 1),
(16, 'Kodex III - Varoius Artist', 'Wyrok', '2007', 89.99, 'cover_68d520eeaaae0.jpg', '2025-09-25 11:01:02', '2025-09-25 11:01:02', 1),
(17, 'WWO', 'Masz i pomyśl', '2000', 132.00, 'cover_68d522ee4df67.jpg', '2025-09-25 11:09:34', '2025-09-25 11:09:34', 1),
(18, 'Kodex II Various Artist', 'Proces', '2004', 79.69, 'cover_68dd0d91114db.jpg', '2025-10-01 11:16:33', '2025-10-01 11:16:33', 1),
(19, 'Grubson', 'O.R.S.', '2009', 179.99, 'cover_68dd0f2e6ba47.jpg', '2025-10-01 11:23:26', '2025-10-01 11:23:26', 1),
(20, 'Waco', 'Świeży materiał', '2001', 99.00, 'cover_68dd115713395.jpg', '2025-10-01 11:32:39', '2025-10-01 11:32:39', 1),
(23, 'Pezet', 'Muzyka rozrywkowa', '2018', 171.00, 'cover_68dfb2ac8ce40.jpg', '2025-10-03 11:19:00', '2025-10-03 11:28:26', 1),
(24, 'Zip Skład', 'Chleb powszedni', '2010', 159.90, 'cover_68dfb65e48a7c.jpeg', '2025-10-03 11:41:18', '2025-10-03 11:41:18', 1),
(25, 'Płomień 81', 'Szkoła 81', '2020', 148.99, 'cover_68dfb795d1e46.jpeg', '2025-10-03 11:46:29', '2025-10-03 11:46:29', 1),
(26, 'Various Artist', 'Cały ten rap', '2025', 165.29, 'cover_68ecd9d34d3fa.jpeg', '2025-10-13 10:52:03', '2025-10-13 10:52:03', 1),
(27, 'Chada', 'Syn Bogdana', '2014', 128.80, 'cover_68ee2f21b44e6.jpg', '2025-10-14 11:08:17', '2025-10-14 11:08:17', 1),
(28, 'Wzgórze Ya Pa 3', 'Centrum', '1997', 129.99, 'cover_68ef7ba7da7bd.jpg', '2025-10-15 10:47:04', '2025-10-15 10:50:40', 1),
(29, 'Włodi', 'W/88', '2020', 114.89, 'cover_690b8924ee592.jpg', '2025-11-05 17:28:04', '2025-11-05 17:28:04', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_track_per_record` (`record_id`,`track_number`),
  ADD KEY `idx_tracks_record` (`record_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeksy dla tabeli `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sessions_user` (`user_id`),
  ADD KEY `idx_sessions_token` (`session_token`);

--
-- Indeksy dla tabeli `vinyl_records`
--
ALTER TABLE `vinyl_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_vinyl_artist` (`artist`),
  ADD KEY `idx_vinyl_title` (`title`),
  ADD KEY `idx_vinyl_year` (`release_year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vinyl_records`
--
ALTER TABLE `vinyl_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `vinyl_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vinyl_records`
--
ALTER TABLE `vinyl_records`
  ADD CONSTRAINT `vinyl_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
