-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Št 06.Apr 2017, 08:41
-- Verzia serveru: 5.6.13
-- Verzia PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `wa1`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kvety_tovar`
--

CREATE TABLE IF NOT EXISTS `kvety_tovar` (
  `kod` smallint(6) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `popis` text COLLATE utf8_slovak_ci NOT NULL,
  `cena` float NOT NULL,
  `na_sklade` smallint(6) NOT NULL,
  PRIMARY KEY (`kod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=28 ;

--
-- Sťahujem dáta pre tabuľku `kvety_tovar`
--

INSERT INTO `kvety_tovar` (`kod`, `nazov`, `popis`, `cena`, `na_sklade`) VALUES
(1, 'Potešenie z orchideí', 'Nastal čas prekvapiť blízkych niečim novým...\r\nPripravili sme pre Vás túto radostnú kyticu zloženú zo šiestich veľkokvetých orchideí a bohatej zelene.', 26.52, 30),
(3, 'Bella', 'Kytica, ktorá pridá sviežosť do každej izby, spríjemní kanceláriu, vhodná na každú príležitosť. Kombinácia bielych a oranžových ruží.', 20, 60),
(8, 'Valencia', 'Spestrite priateľom narodeniny kombináciou oranžových ľalií a alstroemerií. Je to nezabudnuteľné vyjadrenie toho, ako si niekoho vážite.', 29.5, 50),
(9, 'Zamatová krása', 'Červená kytica (ruže, gerbery) je ten najlepší spôsob, ako ukázať úprimnú lásku bez toho, aby sa čakalo na vhodnú príležitosť.', 24, 0),
(10, 'Nežná romanca', 'Krása tejto kytice spočíva v kombinácii bielych orchideí, frézií a bieleho kvetu brassica doplnenú zelenými santínkami Yoko Ono, asparátom a trávou bergrass.', 63, 20),
(11, 'Príjemný vánok', 'Aj kytica z malého počtu kvetov môže rozjasniť deň blízkej osobe. Stačí ak jej pošlete kyticu z bordových gerbier, chryzantém ozdobenú zeleným bambusom.', 21.4, 70),
(15, 'Maslové ruže', '21 maslových ruží, ideálny darček ku každej príležitosti.', 59.72, 100),
(16, '19 bordovofialových ruží', 'Veľká okrúhla kytica uviazaná z 19 bordovofialových ruží, doplnená 5 trachéliami. Kyticu zjemňuje tráva Panicum, bohatá zeleň tvorí manžetu. (Aspidistra, bergrass, cococs, plumóza, fatsia).', 84.5, 4),
(17, 'Miešaná okrúhla kytica', 'Plná okrúhla kytica uviazaná z troch ružových ľalií, dvoch bielych chryzantém, dvoch zelených chryzantém, troch malých gerber, troch ružových gerber, piatich tmavočervených ruží, doplnená o zlatobyľ, tilandsiu a zeleň (sala, fatsia).', 60.9, 21),
(18, 'Ružové ráno', 'Máte radi voňavé kvety a túžite ich darovať niekomu, nech mu krásne voňajú? Práve Vám je určená táto kytica. Obsahuje orchidei, germini, alstromérie, hyacinty a frézie. Kytica je dozdobená ozdobnou zeleňou a doplnkami. ', 19.99, 17),
(19, 'Forever', 'Krásna kytica ladená v červených farbách. Celému aranžmánu dominuje rytierska hviezda - červený amaryllis, ktorý symbolizuje okúzľujúcu lásku obdarovanej osoby. Celá kytica je zdobená tulipánmi a minigerberami aby tak zvýraznili krásu amaryllisu a zjemnili už aj tak príjemný pocit z krásy kvetov.', 26.49, 36),
(20, 'Flamenco', 'Flamenco je nádherná letná kytica, ktorá vyvolá len tie najpríjemnejšie pocity. Každá farba navodzuje atmosféru letnej pohody plnej slnka a smiechu, ktorá nikdy nezmizne z tváre obdarovanej osoby.', 27.52, 50),
(21, 'Pierka Lásky', 'Výstižný názov pre sviežu kyticu z troch červených ruží a dvanástich bielych tulipánov. Celý aranžmán dotvárajú biele pierka, ktoré sa stali dominantným prvkom celej kompozície. Kytica pôsobí veľmi slávnostne, čo ju predurčuje aby sa stala darčekom pri rôznych oslavách, výročiach či len tak z lásky Vašim milovaným.', 34.99, 9),
(22, 'Vánok', 'Potešte svojich blízkych jednoduchou kytičkou z 9-tich farebných tulipánov.', 8.93, 100),
(23, 'Mandarinka - citrus', 'Máte radi citrusové rastliny? Práve Vám je určená nasledovná ponuka. Nenáročná citrusová rastlina, ktorá súčasne kvitne a rodí plody. Kvety príjemne voňajú a plody slúžia ako zaujímavá dekorácia. Okrem toho nie každý sa môže pochváliť, že má doma rodiacu mandarinku, ktorá je už zaštepená. Výhodou citrusových rastlín je aj fakt, že ich listy vylučujú látku, ktorá chráni človeka pred ochoreniami ako chrípka alebo nádcha. Vyžaduje svetlé miesto, pravidelnú zálievku a hnojenie každé 3 týždne.', 28.99, 100),
(24, 'Patricia', 'Jarná kytica vo sviežich farbách, ktoré nás prebúdzajú zo zimného spánku. Kvety tulipánov, tak typické pre skoré jarné mesiace sú doplnené kvetmi altromérie. Svoje miesto na kytičke nájde aj hravý motýľ, ktorý sa teší z prebúdzajúcej sa prírody.', 26.52, 80),
(25, 'Pestrý deň', 'Kytica naaranžovaná v pestrej kombinácii žltých chryzantém, karafiátov, červených ruží a bohatej zelene. ', 35.19, 50),
(26, 'Moja kytica', 'kyticakyticakyticakyticavkyticakyticakytica\r\nkyticakytica kytica', 4, 15),
(27, 'moja kytica2', 'dasdlaslkdnalksfnÂ§sakfn\r\nfnKLdnfkldng\r\ngDSNGkSNDl', 52, 84);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
