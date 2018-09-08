-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--

--
-- Štruktúra tabuľky pre tabuľku `kvety_objednavky`
--

DROP TABLE IF EXISTS `kvety_objednavky`;
CREATE TABLE IF NOT EXISTS `kvety_objednavky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pouz` smallint(6) NOT NULL,
  `adresa` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `kytica` smallint(6) NOT NULL,
  `pocet` smallint(6) NOT NULL,
  `venovanie` text COLLATE utf8_slovak_ci NOT NULL,
  `kedy_dorucit` date NOT NULL,
  `cena_spolu` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=4 ;

--
-- Sťahujem dáta pre tabuľku `kvety_objednavky`
--

INSERT INTO `kvety_objednavky` (`id`, `id_pouz`, `adresa`, `kytica`, `pocet`, `venovanie`, `kedy_dorucit`, `cena_spolu`) VALUES
(1, 5, 'FMFI, Mlynská dolina, Bratislava', 3, 1, 'všetko najlepšie k meninám', '2016-04-21', 43.98),
(2, 6, 'Súmračná, Košice', 16, 1, 'všetko najlepšie k narodeninám', '2016-04-25', 84.5),
(3, 4, 'Školská, Žilina', 21, 1, 'ľúbim ťa', '2016-04-26', 34.99);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kvety_pouzivatelia`
--

DROP TABLE IF EXISTS `kvety_pouzivatelia`;
CREATE TABLE IF NOT EXISTS `kvety_pouzivatelia` (
  `id_pouz` smallint(6) NOT NULL AUTO_INCREMENT,
  `prihlasmeno` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(50) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `meno` varchar(20) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `priezvisko` varchar(30) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pouz`),
  UNIQUE KEY `username` (`prihlasmeno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=7 ;

--
-- Sťahujem dáta pre tabuľku `kvety_pouzivatelia`
--

INSERT INTO `kvety_pouzivatelia` (`id_pouz`, `prihlasmeno`, `heslo`, `meno`, `priezvisko`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrátor', 'systému', 1),
(2, 'uwa', '78f0f32c08873cfdba57f17c855943c0', 'predmet', 'UWA', 0),
(3, 'roman', 'b179a9ec0777eae19382c14319872e1b', 'Roman', 'Hrušecký', 1),
(4, 'marek', 'e061c9aea5026301e7b3ff09e9aca2cf', 'Marek', 'Nagy', 0),
(5, 'jozko', '256f035bd7cf72238fad007fb9199c66', 'Jožko', 'Púčik', 0),
(6, 'mrkva', 'bfd7d9c62540ed72de0f32932077bef7', 'Janko', 'Mrkvička', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kvety_tovar`
--

DROP TABLE IF EXISTS `kvety_tovar`;
CREATE TABLE IF NOT EXISTS `kvety_tovar` (
  `kod` smallint(6) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `popis` text COLLATE utf8_slovak_ci NOT NULL,
  `cena` float NOT NULL,
  `na_sklade` smallint(6) NOT NULL,
  PRIMARY KEY (`kod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=26 ;

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
(25, 'Pestrý deň', 'Kytica naaranžovaná v pestrej kombinácii žltých chryzantém, karafiátov, červených ruží a bohatej zelene. ', 35.19, 50);
