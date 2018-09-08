-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Út 13.Jún 2017, 15:56
-- Verzia serveru: 5.6.13
-- Verzia PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `hrebenar3`
--
CREATE DATABASE IF NOT EXISTS `hrebenar3` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovak_ci;
USE `hrebenar3`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `clanky`
--

CREATE TABLE IF NOT EXISTS `clanky` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nazov` text COLLATE utf8_slovak_ci NOT NULL,
  `clanok` text COLLATE utf8_slovak_ci NOT NULL,
  `datum` date NOT NULL,
  `autor` tinytext COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=10 ;

--
-- Sťahujem dáta pre tabuľku `clanky`
--

INSERT INTO `clanky` (`id`, `nazov`, `clanok`, `datum`, `autor`) VALUES
(1, 'Lukostreľba na Slovensku', 'Luk a s ním aj veľmi často spojovaný šíp, bol nástrojom už v pradávnej dobe kedy sa používal prevažne k lovu. Postupom času sa táto zbraň začala vo veľkom využívať armádami rôzných národov. Každý národ, mal svoj unikátny tvar, dlžku, prispôsobený ich potrebám, či už k lovu, alebo strieľaniu na nepriateľov z koňského chrbta. V dnešnej dobe poznáme veľa druhov lukov a máme možnosť si vybrať práve ten, ktorý sa nám páči, z ktorého sa nám dobre strieľa a z ktorého trafíme vždy svoj cieľ. Aj v dnešnej dobe sa luk používa k lovu, avšak už sa na to vzťahujú obmedzenia a zákazy. My sa poďme ale venovať lukostreľbe ako športu.\r\n\r\nŠportovú lukostreľbu môžeme rozdeliť na halovú lukostreľbu a na 3D lukostreľbu. A my sa venujeme 3D lukostreľbe.\r\n\r\nPred tým ako sa dostaneme k 3D lukostreľbe, tu sú divízie lukov s ktorými sa v 3D lukostreľbe strieľa.\r\n\r\nHU - divízia loveckých kladkových lukov, povolené zameriavače, stabilizátory a iné, nastavenia zameriavača sa počas súťaže nesmú meniť\r\nCU - špeciálna divízia kladkových lukov s vylepšenou možnosťou mierenia , povolené zameriavače so šošovkami a pohyblivé zameriavače, stabilizátory a iné\r\nTRRB - divízia tradičných reflexných lukov, bez zameriavača alebo stabilizátora, skladací alebo z jedného kusu, drevené madlo, základka mac do výšky 1 cm\r\nTRLB - divízia dlhých lukov (Long bow), pri napnutí sa tetiva nesmie dotýkať iných častí luku ako je výrez na tetivu, bez základky\r\nPBHB - divízia primitívny a jazdecký luk. Primitívny luk musí byť vyrobený z jedného kusu dreva bez základky. Jazdecký luk je symetrický reflexný luk, môže byť zložený z viac materialov, madlo tiež symetrické, bez základky\r\nBB - divízia bare bow, luk holý bez výčnelkov, kovové alebo drevené madlo, povolená základka\r\nOL - divízia olympijský luk, akýkoľvek reflexný luk vybavený zameriavačom, stabilizátormi, atď.,\r\nCRB - divízia crossbow ( kuša ), je povolený akýkoľvek typ kuše (reflexnej / kladkovej), s pinmi alebo krížikom, s priblížením alebo bez. Elektronické doplnky sú zakázané. Kuša musí byť nabíjaná ručne (naťahovač povolený) a musí mať bezpečnostnú poistku.\r\nNa slovensku sa konajú rôzne 3D lukostrelecké súťaže. Niektoré priateľské, sériové( Zimná liga, ... ), majstrovské( Slovenský pohár ) a medzinárodné( Grand Prix ). Každá takáto súťaž sa koná vo vonkajšom prostredí a má vlastný pretkársky okruh, zvyčajne s dĺžkou 2 - 6 km, a na ňom je rozmiestnených 18 - 28 terčov, ktoré majú 3D podobu zvierat v reálnych rozmeroch. Každá súťaž sa riadi pravidlami, ktoré určujú maximálne vzdialenosti, stavbu pretekárskych okruhov, hodnotenia, a pod. Existujú rôzne pravidlá ako Europske alebo Svetové a každé sa líšia v rôznych smeroch. Ale princíp ostáva všade rovnaký.\r\n\r\nSúťažiaci sa zapíšu a potom budú rozdelený do súťažných skupín s maximálne 6 súťažiacimi, ktorá sa po rozdelení presunie na pridelené stanovisko, z ktorého začne súťaž. Každé stanovisko je označené poradovým číslom a nachádza sa na ňom 3D terč, a 3 kolíky označujúce vzdialenosti pre danú vekovú kategóriu alebo podľa typu luku. Kolíky sú označené farebne a to Biely - najbližšie k terču, strieľajú od neho súťažiaci do 15 rokov, všetky typy luku, Modrý - stredná vzdialenosť, stieľajú súťažiaci od 19 rokov v divíziách TRRB, TRLB, PBHB, BB, a od 15 do 19 rokov v divíziách HU, CU, CRB, OL, a Červený - najväčšia vzdialenosť, strieľajú sútažiaci od 19 rokov v divíziách HU, CU, CRB, OL. Všetky kolíky sú postavené tak, aby z nich bol priamy výhľad na terč. Súťažiaci nepozná presnú vzdialenosť terču od kolíkov a tak musí vzdialenosť odhadnúť. Nie sú povolené žiadne zameriavacie zariadenia. Bodovanie 3D terču je rozdielne od bodovania kruhového terču pre halovú lukostreľbu. 3D terč má 4 bodovacie zóny. Zóna 11 je najmenšia a nachádza sa v oblasti životne dôležitých orgánov zvieraťa. Zóna 10 sa nacházda okolo zóny 11 a nachádzajú sa v nej menej životne dôležité orgány. Zóna 8 sa nachádza okolo zóny 10 a je to oblasť, do ktorej by zásah zviera stále vedel veľmi zraniť. Zóna 5 je zvyšná plocha 3D terču s výnimkov farebne odlíšených častí terču ako tráva, skaly, kopytá, parohy, a pod, zásah do týchto častí terču sa tak ako aj zásah mimo boduje 0 bodmi.\r\n\r\nSúťažiaci môže podľa pravidiel danej súťaže vystreliť na terč 2 alebo 1 šíp pričom sa bodujú všetky, s výnimkou strelcov v divízií CRB, ktorý podľa pravidiel strieľajú len jeden šíp. Po dokončení súťaže súťažiaci odovzdajú svoje riadne vyplnené a podpísané bodovacie listky a počkajú na vyhodnotenie. Vyhodnotený sú vždy prvý traja sútažiaci podľa veku, pohlavia a divízie.\r\n\r\nAk ste sa pre tento krásny šport rozhodli alebo ste len zvedavý, ako to prebieha, určite sa príďte pozrieť na niektorú zo súťaží, určite sa konajú aj vo vašej blízkosti. Nájdete tam vždy príjemných ľudí, občertvenie a skvelú atmosféru. Nezabúdajte avšak na poriadnu obuv, keďže terén bude náročný.\r\nKalendár súťaží nájdete na tejto stránke. Radi Vás tam uvidíme.', '2017-05-18', '7'),
(8, 'Testovací článok', '\r\nŠtandardná pasáž z Lorem Ipsum, používaná od 16.storočia\r\n\r\n&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;\r\nOdsek 1.10.32 z textu &quot;De finibus bonorum et malorum&quot;, ktorý napísal Cicero v roku 45 pred n.l.\r\n\r\n&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;\r\nPreklad od H. Rackhama z roku 1914\r\n\r\n&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;\r\nOdsek 1.10.33 z textu &quot;De finibus bonorum et malorum&quot;, ktorý napísal Cicero v roku 45 pred n.l.\r\n\r\n&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;\r\nPreklad od H. Rackhama z roku 1914\r\n\r\n&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;\r\n', '2017-05-18', '7'),
(9, 'Stiahnite si projekt', 'Tento projekt so všetkými súbormi si môžete stiahnuť kliknutím na <a href=''projekt.zip''  download>tento link</a>. Súbor obsahuje zdrojové kódy spolu s dokumentáciou projektu.', '2017-06-13', '7');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `prihlasky`
--

CREATE TABLE IF NOT EXISTS `prihlasky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meno` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `priezvisko` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `pohlavie` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `vek` tinyint(4) NOT NULL,
  `mesto` text COLLATE utf8_slovak_ci NOT NULL,
  `adresa` text COLLATE utf8_slovak_ci NOT NULL,
  `psc` text COLLATE utf8_slovak_ci NOT NULL,
  `mobil` text COLLATE utf8_slovak_ci NOT NULL,
  `email` text COLLATE utf8_slovak_ci NOT NULL,
  `newsletter` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `prihlasky`
--

INSERT INTO `prihlasky` (`id`, `meno`, `priezvisko`, `pohlavie`, `vek`, `mesto`, `adresa`, `psc`, `mobil`, `email`, `newsletter`) VALUES
(1, 'Igor', 'Mrkva', 'muz', 30, 'Gočaltovo', 'Gočaltovo 54', '04584', '0902 156 895', 'mrkva@mail.com', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_slovak_ci NOT NULL,
  `meno` text COLLATE utf8_slovak_ci NOT NULL,
  `nick` text COLLATE utf8_slovak_ci NOT NULL,
  `vek` tinyint(4) NOT NULL,
  `bio` text COLLATE utf8_slovak_ci NOT NULL,
  `divizia` text COLLATE utf8_slovak_ci NOT NULL,
  `licencia` text COLLATE utf8_slovak_ci NOT NULL,
  `pohlavie` text COLLATE utf8_slovak_ci NOT NULL,
  `mesto` text COLLATE utf8_slovak_ci NOT NULL,
  `adresa` text COLLATE utf8_slovak_ci NOT NULL,
  `psc` text COLLATE utf8_slovak_ci NOT NULL,
  `mobil` text COLLATE utf8_slovak_ci NOT NULL,
  `newsletter` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=18 ;

--
-- Sťahujem dáta pre tabuľku `profiles`
--

INSERT INTO `profiles` (`ID`, `email`, `meno`, `nick`, `vek`, `bio`, `divizia`, `licencia`, `pohlavie`, `mesto`, `adresa`, `psc`, `mobil`, `newsletter`) VALUES
(7, 'm.hrebenar365@gmail.com', 'Martin Hrebeňár', 'martin62', 19, 'Som študent na Fakulte Matematiky, Fyziky a Informatiky univerzity Komenského v Bratislave a lukostreľbe sa venujem už 4 rok. ', 'TRRB', 'SVK 00468', 'Muž', 'Dobšiná', 'Vlčia dolina 1164', '049 25', '+421 904 840 102', 'on'),
(9, '', 'Peter Vilim', 'Peto', 36, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit dui vitae ante. Nulla nonummy augue nec pede. Pellentesque ut nulla. Donec at libero. Pellentesque at nisl ac nisi fermentum viverra. Praesent odio. Phasellus tincidunt diam ut ipsum. Donec eget est.', 'HU', 'SVK 00123', 'muz', 'Dobšiná', 'Budovateľská 65', '049 25', '0902 156 895', ''),
(10, '', 'Veronika Vilimová', '-', 16, '', 'HU', 'SVK 00234', 'zena', 'Dobšiná', 'Budovateľská 65', '049 25', '0902 156 895', 'on'),
(11, '', 'Viktória Vilimová', 'viki', 14, '', 'HU', 'SVK 00345', 'zena', 'Dobšiná', 'Budovateľská 65', '049 25', '0902 156 895', 'on'),
(12, '', 'Marek Timár', '-', 19, '', 'TRRB', 'SVK 00456', 'muz', 'Dobšiná', 'Neviem aká 154', '049 25', '0902 156 895', 'on'),
(13, '', 'Adrián Klement', '-', 15, '', 'TRRB', 'SVK 00567', 'muz', 'Dobšiná', 'Jarková 54', '049 25', '0902 156 895', ''),
(15, '', 'Jozef Drevár', '', 54, '', '', '', 'muz', 'Fiľakovo', 'ulica SNP 21', '21654', '0902 156 895', '1'),
(16, '', 'Janko Janik', 'janicko', 10, '', '', '', 'muz', 'ABe', 'AJN', 'sas sa', '', 'on'),
(17, 'Martines@martines.martines', 'Martines Martines', 'Martines', 28, '', '', '', 'muz', 'Martines', 'Martines', '04585', '', 'on');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sutaze`
--

CREATE TABLE IF NOT EXISTS `sutaze` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nazov` text COLLATE utf8_slovak_ci NOT NULL,
  `datum_zac` date NOT NULL,
  `datum_kon` date NOT NULL,
  `miesto` text COLLATE utf8_slovak_ci NOT NULL,
  `pocet` smallint(6) NOT NULL,
  `typ` text COLLATE utf8_slovak_ci NOT NULL,
  `prihlasovanie_do` date NOT NULL,
  `GPS` text COLLATE utf8_slovak_ci NOT NULL,
  `popis` text COLLATE utf8_slovak_ci NOT NULL,
  `prihlaseny` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=10 ;

--
-- Sťahujem dáta pre tabuľku `sutaze`
--

INSERT INTO `sutaze` (`id`, `nazov`, `datum_zac`, `datum_kon`, `miesto`, `pocet`, `typ`, `prihlasovanie_do`, `GPS`, `popis`, `prihlaseny`) VALUES
(2, 'Juzna patka 2.kolo', '2017-04-30', '2017-04-30', 'Trnovec nad Vahom', 200, 'Juzna patka', '2017-04-28', '48.116025, 17.91972', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor.\r\nNam sed augue. Donec orci. \r\nCras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit dui vitae ante. Nulla nonummy augue nec pede. Pellentesque ut nulla. Donec at libero. Pellentesque at nisl ac nisi fermentum viverra. Praesent odio. \r\nPhasellus tincidunt diam ut ipsum. Donec eget est.', ''),
(3, 'Juzna patka 1.kolo', '2017-04-08', '2017-04-08', 'Gocovo', 200, 'Juzna patka', '2017-04-06', '49.195566, 18.894863', 'kasnldknasflknaslfnalsfnlaskfnklas', ''),
(4, 'GRAND PRIX HDH IAA, Varin', '2017-05-20', '2017-05-21', 'Varin', 300, 'Grand prix', '2017-05-17', '49.195566, 18.894863 ', 'ndasndkasjdkajsdkjasldkjal', ''),
(5, 'Slovenský Pohár SLA 3D - 3.kolo', '2017-05-13', '2017-05-13', 'Rimavská Sobota', 180, 'Slovenský pohár', '2017-05-10', '49.195566, 18.894863', 'Organizátor - Tibor Lévay st., 421905382851, v1.vercajch@vercajch.sk \r\nRiadite? sú?aže - Tibor Lévay ml. \r\nHlavný rozhodca - Peter Vilim\r\n\r\nSú?ažné pravidlá: strie?a sa d?a pravidiel HDH IAA s národnými úpravami SLA3D 2017 \r\n(vi?: http://archery3d.sk/riadiaca-dokumentacia) \r\n\r\nPo?et ter?ov:   28 alebo 32 \r\n\r\nPo?et výstrelov na ter?: 1, pri výstrele je potrebný dotyk strelca o kolík, strie?a sa po jednom strelcovi, maximálny ?as na výstrel: 90 sekúnd \r\n\r\nBodovanie výstrelov: 11, 10, 8, 5, 0 (sta?í aj dotyk ?iary na zapísanie vyššej bodovej hodnoty). Pri zapisovaní do bodova?ky je povinné priebežne spo?ítava? body. Zapisuje sa do dvoch bodova?iek druhým a tretím ?lenom skupiny. \r\n\r\nSkupiny: Maximálny po?et strelcov v skupine je 6; skupiny budú vopred pripravené organizátorom, pri?om sa prihliada na výkonnos? lukostrelcov a priebežné poradie v Slovenskom pohári SLA3D. \r\n\r\nVo vekových kategóriach je rozhodujúci vek k 1.1.2017 (pozor, tu je zmena oproti predchádzajúcim ro?níkom, ke?že postupujeme pod?a pravidiel HDH IAA). Je možné strie?a? vo vyššej vekovej kategórií (napr. die?a v kadetoch, kadeti a veteráni v dospelých). Všetky kolá je potrebné strie?a? v jednej vekovej kategórií, inak sa body nebudú zapo?ítava?. \r\n\r\nDeti: Deti sa môžu zú?astni? sú?aže len v sprievode rodi?a alebo ním poverenej dospelej osoby. \r\n\r\nFair Play:  Pri registrácii prebehne základná kontrola náradia hlavným rozhodcom v zmysle platných pravidiel. Na registráciu je potrebné prís? s kompletnou sú?ažnou výbavou. \r\n\r\nBezpe?nos?: Za užívanie alkoholu pred sú?ažou a po?as sú?aže je okamžitá bezpodmiene?ná diskvalifikácia. Bezpe?nostné pravidlá na trati sú povinné doržiava? aj sprevádzajúce osoby.\r\n\r\nÚ?astníci sú?aže v kamuflážnom oble?ení musia ma? na sebe prvky s vysokou vidite?nos?ou (napr. reflexná vesta). \r\n\r\nVšetci štartujú na vlastné riziko a sú povinní dodržiava? pokyny organizátora.\r\n\r\n--------------------------------------------------------------\r\n\r\nCelkové hodnotenie Slovenského pohára SLA3D 2017: \r\nSlovenský pohár má v roku 2017 6 kôl a 1 finálové kolo. Pre celkové hodnotenie je potrebná ú?as? aspo? na štyroch sú?ažiach. Do celkového hodnotenia SP sa zapo?ítavajú body za 4 najlepšie umiestnenia. V prípade rovnosti bodov je ?alším kritériom vyhodnotenia priemer na šíp z týchto štyroch najlepších umiestnení. \r\n\r\nBodovanie do celkového hodnotenia SP: \r\n1.miesto: 30 bodov\r\n2.miesto: 25 bodov\r\n3.miesto: 21 bodov\r\n4.miesto: 18 bodov\r\n5.miesto: 15 bodov\r\n6.miesto: 12 bodov\r\n7.miesto: 9 bodov\r\n8.miesto: 6 bodov\r\n9.miesto: 3 body\r\n10.miesto: 1 bod\r\n\r\n\r\nPrví traja z celkového hodnotenia budú na finálovom kole vyhodnotení pohármi.\r\nDivízie:\r\nHU, CU, TRLB, TRRB, OL, CRB, BB, PBHB, CB\r\nVekové kategórie:\r\nDeti, Kadet, Senior, Veterán\r\nŠtartovné:\r\nDeti:          5 EUR\r\n\r\nKadeti:     10 EUR\r\n\r\nDospelí, veteráni:  15 EUR \r\n\r\nV cene štartovného je obed.\r\nProgram:\r\nRegistrácia:    8:00 – 9:30 hod. \r\n\r\nTréning:          8:30 – 9:30 hod.\r\n\r\nZahájenie a rozdelenie do skupín: 9:45 - 10:00 hod.\r\n\r\nŠtart sú?aže:  10:15 hod.\r\n\r\nObed:              13:30 hod.\r\n\r\n Vyhodnotenie:  15:00 hod.\r\nOcenenie:\r\nOce?uje sa medailami, ocenení sú prví traja v každej divízii luku, vekovej kategórií luku a pohlaví bez oh?adu na po?et ú?astníkov.\r\nUbytovanie:\r\nhttp://www.euromotel.sk\r\n\r\nTel.: +421 47 5622517\r\n\r\nMobil: +421 905745308\r\n\r\nFax: +421 47 5622517\r\nE- mail:info@euromotel.sk\r\nIné:\r\nNa sú?ažiach Slovenského pohára SLA3D bude prítomný hlavný rozhodca delegovaný SLA3D.\r\n\r\nSú?aží Slovenského pohára SLA3D sa môžu zú?astni? iba ?lenovia SLA3D s platnými licenciami, prípadne zahrani?ní lukostrelci, ktorí sú ?lenmi partnerskej organizácie SLA3D (napr. ?eská 3D Lukost?elba). \r\n\r\nPretekár sa môže zo sú?aže odhlási? najneskôr do dátumu a ?asu uvedeného v propozíciach sú?aže. Pokia? sa tak nestane, je sú?ažiaci povinný na požiadanie uhradi? organizátorovi výšku stravnej jednotky.', ''),
(6, 'SSPohár - 2.kolo', '2017-06-10', '2017-06-10', 'Dobšiná', 150, 'Stredoslovenský pohár', '2017-06-09', '48.8058722222, 20.3861638889 ', 'Organizátor:\r\nLK Dobšiná \r\nRiaditeľ súťaže - ing. Ján Neubauer \r\nHlavný rozhodca - Peter Vilim\r\n\r\nstrieľa sa na 19 + 1 3D terčov po dva šípy (20. terč - 4 šípy a počítajú sa dva najlepšie zásahy)\r\nDivízie:\r\nHU, CU, TRLB, TRRB, OL, CRB, BB, PBHB, CB\r\nVekové kategórie:\r\nDeti, Kadet, Senior, Veterán\r\nŠtartovné:\r\nDeti- 4€,    \r\n\r\nKadeti- 6€,    \r\n\r\nDospelí  a Veteráni  13€\r\n\r\nV cene štartovného je obed.\r\nProgram:\r\nRegistrácia:    7:30 – 9:45 hod.\r\n\r\nZahájenie a rozdelenie do skupín: 9:45 - 10:00 hod.\r\n\r\nŠtart súťaže:  10:15 hod.\r\n\r\nObed:              13:00 hod.\r\n\r\nVyhodnotenie:  14:00 hod.\r\nOcenenie:\r\nMedaila \r\n\r\nFinále: Pohár + Diplom\r\n\r\nOcenené budú všetky kategórie bez ohľadu na počet súťažiacich', ',9,10,11'),
(7, 'Mikulášsky pretek', '2017-12-02', '2017-12-02', 'Rimavská Sobota', 150, '-', '2017-11-28', '48.3812295, 20.0195452 ', 'Organizátor:\r\nLK BAŠTA Rimavská Sobota', ',7,10,11'),
(8, 'Slovenský pohár SLA3D - 4.kolo', '2017-06-17', '2017-06-17', 'Leles', 165, 'Slovenský pohár', '2017-06-13', '48.500206278, 22.05324852 ', 'Zatiaľ bez popisu.', ''),
(9, 'SSPohár - 3.kolo', '2017-07-01', '2017-07-01', 'Rimavská Sobota', 192, 'Stredoslovenský pohár', '2017-06-28', '48.390087605, 19.97951746 ', 'Organizátor:\r\nLK BAŠTA Rimavská Sobota \r\nOrganizátor - TIBOR LÉVAY st., 421905382851, v1.vercajch@vercajch.sk \r\nRiaditeľ súťaže - TIBOR LÉVAY ml. \r\nHlavný rozhodca - TIBOR LÉVAY ml.\r\n\r\nPravidlá:\r\nHDH IAA s úpravami SLA 3D na rok 2017\r\n\r\nÚpravy pre SSP 2017\r\n\r\nStrieľa sa na 19 + 1 3D terčov po dva šípy;  20. terč 4 šípy počítajú sa dve najlepšie zásahy\r\nDivízie:\r\nHU, CU, TRLB, TRRB, OL, CRB, BB, PBHB, CB\r\nVekové kategórie:\r\nDeti, Kadet, Senior, Veterán\r\nŠtartovné:\r\nMini- 4€,    \r\n\r\nKadet- 6€,    \r\n\r\nDospelý a Veterán 13€\r\n\r\nV cene štartovného je obed.\r\nProgram:\r\nRegistrácia:    7:30 – 9:30 hod.\r\n\r\nTréning:          8:30 – 9:30 hod.\r\n\r\nZahájenie a rozdelenie do skupín: 9:45 - 10:00 hod.\r\n\r\nŠtart súťaže:  10:15 hod.\r\n\r\nObed:              14:00 hod.\r\n\r\nVyhodnotenie:  15:00 hod.\r\nOcenenie:\r\nMedaila \r\n\r\nFinále – pohár +Diplom\r\n\r\n Ocenene budú všetky kategórie bez ohľadu na počet súťažiacich\r\nUbytovanie:\r\nhttp://www.euromotel.sk\r\n\r\nTel.: +421 47 5622517Zavolať: +421 47 5622517\r\n\r\nMobil: +421 905745308Zavolať: +421 905745308\r\n\r\nFax: +421 47 5622517Zavolať: +421 47 5622517\r\nE- mail:info@euromotel.sk', ',17');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_name` text COLLATE utf8_slovak_ci NOT NULL,
  `user_password` text COLLATE utf8_slovak_ci NOT NULL,
  `email` text COLLATE utf8_slovak_ci NOT NULL,
  `newsletter` tinyint(4) NOT NULL COMMENT '1:ano, 0:nie',
  `Admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=18 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`ID`, `user_name`, `user_password`, `email`, `newsletter`, `Admin`) VALUES
(6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 1),
(7, 'martin', '4500d9d7762e5554f4b87c74e34e7231', 'm.hrebenar365@gmail.com', 0, 1),
(9, 'peterv', 'b3fdb2149269d6f616295a6cc69bb03b', '', 0, 0),
(10, 'vera05', '4b3f11e0f46e32cb4141f3baf05a4090', '', 0, 1),
(11, 'viki06', 'f0137e49dcf73e1ac8be2dee453031e3', '', 0, 0),
(12, 'marekt', '2a675b40ff40d4aaa93695dfc6eeb540', '', 0, 0),
(13, 'adko03', '755d4169bbc08b685d507d2c41d64ea8', '', 0, 0),
(15, 'Jozef Drevár8212', 'fec1f993130ae83157c9e53700bbd441', '', 0, 0),
(16, 'janko', 'e32bfa3b866a54d853f868eda7346a27', '', 0, 0),
(17, 'martines', '417e75a9d47b6acb2697e46f198416af', 'Martines@martines.martines', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
