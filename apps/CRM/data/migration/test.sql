
--
-- Contenu de la table `arrondissements`
--

INSERT INTO `arrondissements` (`code`, `arrondissement`) VALUES
(1, 'Arr. Aïn Chok, Sidi Maarouf'),
(2, 'Arr. Aïn Sebaa '),
(4, 'Arr. Anfa'),
(7, 'Arr. Hay Hassani, Oulfa, Lissasfa'),
(8, 'Arr. Hay Mohammadi '),
(9, 'Arr. Maarif'),
(10, 'Arr. Mers Sultan '),
(12, 'Arr. Roches noires '),
(13, 'Arr. Sbata '),
(14, 'Arr. Sidi Belyout (centre ville) '),
(16, 'Arr. Sidi Moumen, Anassi '),
(17, 'Arr. Sidi Othman '),
(1, 'Arr. Aïn Chok, Sidi Maarouf'),
(2, 'Arr. Aïn Sebaa '),
(4, 'Arr. Anfa'),
(7, 'Arr. Hay Hassani, Oulfa, Lissasfa'),
(8, 'Arr. Hay Mohammadi '),
(9, 'Arr. Maarif'),
(10, 'Arr. Mers Sultan '),
(12, 'Arr. Roches noires '),
(13, 'Arr. Sbata '),
(14, 'Arr. Sidi Belyout (centre ville) '),
(16, 'Arr. Sidi Moumen, Anassi '),
(17, 'Arr. Sidi Othman ');

-- --------------------------------------------------------

--
-- Contenu de la table `banques`
--

INSERT INTO `banques` (`code`, `banque`) VALUES
('AB', 'Arab Bank'),
('BM', 'Banque Al Maghrib'),
('BP', 'B.p.'),
('CA', 'Credit Agricole'),
('BC', 'Attijariwafa bank'),
('CE', 'B.m.c.e.'),
('CI', 'B.m.c.i.'),
('CB', 'Citibank'),
('CM', 'C.d.m.'),
('SG', 'Societe Generale'),
('TR', 'Tresor'),
('TB', 'Toutes Banques'),
('MB', 'U.m.b.'),
('IH', 'C.i.h.'),
('BX', 'Bex Maroc'),
('CC', 'C.C.P'),
('BS', 'Banco Sabadell'),
('CX', 'Caixa Maroc'),
('BB', 'Barid Banque'),
('MM', 'F.n.a'),
('CD', 'Cdg Capital'),
('CF', 'CFG BANK');

-- --------------------------------------------------------

--
-- Contenu de la table `civilite`
--

INSERT INTO `civilite` (`code`, `civilite`) VALUES
(1, 'M.'),
(2, 'Mme'),
(3, 'Mlle'),
(4, 'Dr.'),
(18, 'Prof.'),
(34, 'Dr.Prof.'),
(37, 'S.A.LePrince'),
(38, 'S.A.R.'),
(39, 'S.A.R.LaPrincesse'),
(51, 'Hadj'),
(52, 'Moulay'),
(53, 'Maître'),
(57, 'Sidi'),
(58, 'Cheikh');

-- --------------------------------------------------------

--
-- Contenu de la table `fichier`
--

INSERT INTO `fichier` (`code`, `fichier`) VALUES
('K25', 'Petite affaire'),
('K25', 'Petite affaire'),
('K25', 'Petite affaire'),
('Y10', 'Ce client est insolvable, ce code garde les memes chiffres que le K ex Y10, Y20…'),
('Z10', 'Cette firme est non editable a la demande du client, ce code garde les memes chi'),
('G10', 'Cette firme est non editable'),
('K20', 'Cette firme paraissait dans le dernier Telecontact'),
('K21', 'Cette firme paraitra dans le prochain Telecontact'),
('S10', 'Cette firme n`existe plus ou on a perdu ses traces (souvent avec un historique),'),
('K10', 'Cette firme paraissait dans le dernier Kompass'),
('K11', 'Cette firme paraitra dans le prochain Kompass'),
('H21', 'Ambassades et consulats etrangers au Maroc'),
('H31', 'Administrations publiques'),
('H33', 'Chambres de commerces marocaines'),
('H34', 'Chambres d`artisanat marocaines'),
('H35', 'Chambres d`agriculture marocaines'),
('H36', 'Associations professionnelles marocaines'),
('H51', 'Hopitaux'),
('H53', 'Medecins'),
('H55', 'Dentistes'),
('H56', 'Kinesitherapeutes'),
('H57', 'Pharmacies'),
('H63', 'Avocats'),
('H65', 'Notaires'),
('H73', 'Architectes'),
('H75', 'Metreurs'),
('H78', 'Experts'),
('H99', 'Firmes etrangeres'),
('K41', 'Firme domiciliee'),
('A10', 'A10'),
('A11', 'A11'),
('J21', 'Ambassades et consulats etrangers en Afrique'),
('J31', 'Administrations publiques'),
('J33', 'Chambres de commerces africaines'),
('J34', 'Chambres d`artisanat africaines'),
('J35', 'Chambres d`agriculture africaines'),
('J36', 'Associations professionnelles africaines'),
('H50', 'Psychologues'),
('H54', 'Veterinaires'),
('H61', 'Huissiers de justice'),
('H67', 'Adouls'),
('H76', 'Topographes'),
('H38', 'Associations a but non lucratif');

-- --------------------------------------------------------


--
-- Contenu de la table `firmes`
--

INSERT INTO `firmes` (code_firme , zone_geo , code_fichier , code_statut , code_nature , comp_nature , rs_comp , rs_abr , code_voie , lib_voie , comp_voie , num_voie , comp_num_voie , code_ville , bp , code_ville_bp , code_postal , code_arr , code_quart , ouv_matin , ferm_matin , ouv_soir , ferm_soir , longitude , latitude , rc , code_ville_rc , ref_ann_leg , ident_fisc , patente , code_forme_jur , annee_inscr , cap , gamme_ca , ca , eff_min ,eff_max , nb_cadres , sup , sup_couv , chef_file_banque , maj_n ,maj_k ,pub_n , pub_k , logo_d , act_longue) VALUES ('MA1199400' , 'TE04 ' , 'K10' , 'A' , 'A' , '' , 'Tetouan Maille                                                                                      ' , 'Temasa                             ' , '99990' , 'rte de Martil                                            ' , ', q.i.                                                      ' , '' , '' , '164010' , '6009' , '164010' , '93000' , '' , '' , '700' , '1530' , '' , '' , '-5.310483333333     ' , '35.60385            ' , '1213' , '164010' , '1600000000000' , '4940459' , '69441430' , '3' , 1982 , 11386600 , 'F ' , 71728612 , 585 ,0 , 16 , 0 , 7000 , 'CE' , '5' ,'5' ,'' , '' , '' ,  'Confection de collants, bas et chaussettes' ),
('MA3174412' , 'C349 ' , 'K20' , 'A' , 'E' , '' , 'Anas Aluminium                                                                                      ' , '' , '35400' , 'lot. Jouhara (Si Moumen Jdid)                            ' , ', rue 4 n°19                                                ' , '' , '' , '91710' , '' , '' , '20630' , '16' , '50' , '' , '' , '' , '' , '' , '' , '127259' , '91010' , '13899000020' , '2223456' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Menuiserie aluminuim, volet roulant' ),
('MA1399300' , 'C311 ' , 'H57' , 'A' , 'D' , '' , 'Pharmacie Emile Zola                                                                                ' , '' , '13070' , 'bd Emile Zola                                            ' , '' , '221' , '' , '91510' , '' , '' , '20300' , '12' , '10' , '' , '' , '' , '' , '-7.596142326835377  ' , '33.593981383801925  ' , '321344' , '91010' , '570000000000' , '23600590' , '31210944' , '55' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pharmacie' ),
('MA1599200' , 'FE01 ' , 'K20' , 'A' , 'D' , '' , 'Clinique Raiss                                                                                      ' , '' , '70175' , 'bd Allal Ben Abdallah                                    ' , '' , '16' , '' , '141010' , '' , '' , '30000' , '' , '' , '' , '' , '' , '' , '-5.006166666667     ' , '34.0336             ' , '' , '' , '' , '105873' , '13606951' , '55' , 1984 , 0 , 'C ' , 0 , 40 ,0 , 0 , 0 , 700 , 'CE' , '5' ,'5' ,'' , 'P' , '' ,  'Clinique medical chirurgicale' ),
('MA1753123' , '' , 'K10' , 'C' , 'U' , '' , 'I.s.t.a. Maamora-Kenitra                                                                            ' , '' , '73021' , 'rue Maamora                                              ' , ', Nouvelle Medina                                           ' , '' , '' , '105010' , '573' , '14003' , '14000' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '65' , 1986 , 0 , 'Z ' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Valorisation des ressources humaines et maitrise des technologies : formation de main d oeuvre qualifiee, organisation d' ),
('MA1999000' , 'MA09 ' , 'K10' , 'B' , 'A' , '' , 'Richdor                                                                                             ' , '' , '71451' , 'lotiss. Azli                                             ' , '' , '1' , '' , '71010' , '470' , '71010' , '40000' , '' , '' , '800' , '1200' , '1400' , '1800' , '-8.057416666667     ' , '31.62725            ' , '5227' , '71010' , '' , '6501617' , '46210292' , '3' , 1990 , 3800000 , 'D ' , 0 , 10 ,0 , 4 , 0 , 0 , 'BC' , '5' ,'5' ,'' , 'P' , '' ,  'Fabrication de matelas et salons a ressorts' ),
('MA2106946' , 'BO02 ' , 'K10' , 'A' , 'A' , '' , 'Anciens Materiaux de Construction Bouftass                                                          ' , 'A.m.c.b.                           ' , '99990' , 'z.i.                                                     ' , '' , '' , '' , '91413' , '85' , '91413' , '20180' , '' , '' , '800' , '1200' , '1400' , '1800' , '-7.6492343          ' , '33.448116           ' , '51387' , '91010' , '1510000000000' , '2200117' , '32911111' , '3' , 1989 , 2250000 , 'E ' , 14906141 , 50 ,0 , 0 , 10000 , 3000 , 'CM' , '5' ,'5' ,'B' , 'B' , '' ,  'Fabrication de tous materiaux de construction' ),
('MA3002498' , 'R644 ' , 'K20' , 'A' , 'M' , '' , 'Nadacom Design                                                                                      ' , '' , '54350' , 'rue Melouyah                                             ' , ', appt.1                                                    ' , '64' , '' , '101010' , '' , '' , '10090' , '' , '' , '' , '' , '' , '' , '-6.84799164         ' , '33.99794658         ' , '55941' , '101010' , '220000000000' , '3333556' , '25770601' , '' , 0 , 0 , '' , 0 , 5 ,6 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Production audio visuelle' ),
('MA2116941' , 'C133 ' , 'K20' , 'B' , 'E' , '' , 'ets Mohamed Korifa                                                                                  ' , '' , '21780' , 'rue Ennahas Nahoui - ex Mont Pelvoux                     ' , ', Maarif                                                    ' , '169' , '' , '91410' , '' , '' , '20330' , '9' , '34' , '' , '' , '' , '' , '-7.63988            ' , '' , '' , '' , '' , '' , '37507904' , '' , 0 , 0 , '' , 0 , 3 ,0 , 0 , 0 , 50 , '' , '5' ,'5' ,'' , 'B' , '' ,  'Nettoyage des tapis, moquettes, siege de voitures. Revetement decoration' ),
('MA3268365' , 'C314 ' , 'K20' , 'A' , 'B' , '' , 'Incomaroc                                                                                           ' , '' , '20860' , 'bd Mohammed VI                                           ' , ', Erac Centre imm. F2, appt. 4                              ' , '29' , '' , '91410' , '' , '' , '20500' , '10' , '23' , '' , '' , '' , '' , '-7.60514514951109   ' , '33.58500834815208   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '8' ,'8' ,'' , '' , '' ,  'Installation de la plomberie en batiments, industrielles et energie solaire' ),
('MA2118940' , 'C252 ' , 'K20' , 'A' , 'F' , '' , 'Droguerie d Alsace                                                                                  ' , '' , '3190' , 'bd d  Alsace (Mers Sultan)                               ' , '' , '56' , '' , '91110' , '' , '' , '20120' , '14' , '11' , '' , '' , '' , '' , '-7.611564168616744  ' , '33.58571002643557   ' , '' , '' , '' , '' , '34307999' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Droguerie' ),
('MA2126936' , 'TM04 ' , 'K20' , 'A' , 'M' , '' , 'Auto-ecole Erkik Zakaria                                                                            ' , '' , '99990' , 'av. Hassan II                                            ' , ', imm. Erragragui, 1°et.                                    ' , '2' , '' , '103011' , '' , '' , '12000' , '' , '' , '' , '' , '' , '' , '-6.9178             ' , '33.92468333333      ' , '83197' , '101010' , '44288000040' , '3340701' , '27927991' , '' , 0 , 0 , '' , 0 , 6 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Auto-ecole' ),
('MA2128935' , 'C323 ' , 'K10' , 'A' , 'F' , '' , 'Fouara Bois                                                                                         ' , '' , '13971' , 'bd du Fouarat                                            ' , '' , '83' , '' , '91510' , '' , '' , '20570' , '8' , '26' , '' , '' , '' , '' , '-7.571427480        ' , '33.575026140        ' , '61567' , '91010' , '103000000000' , '166038' , '31801282' , '3' , 1997 , 100000 , '' , 0 , 12 ,0 , 0 , 0 , 0 , 'SG' , '5' ,'5' ,'' , '' , '' ,  'Vente de bois en demi gros et contre plaques' ),
('MA3090454' , '' , 'K20' , 'A' , 'F' , '' , 'Thermo Electro Dina                                                                                 ' , 'Thedi                              ' , '99990' , 'rue 701, hay Al Wafa                                     ' , ', Erac Bouargane                                            ' , '20' , '' , '41110' , '' , '' , '80000' , '' , '' , '' , '' , '' , '' , '' , '' , '9665' , '41110' , '' , '' , '' , '4' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '8' ,'8' ,'' , '' , '' ,  'Electricite (fournitures generale).' ),
('MA2134932' , 'MA02 ' , 'H53' , 'A' , 'Q' , '' , 'Nordine Abbas                                                                                       ' , '' , '70482' , 'bd Oued El Makhazine                                     ' , ', place 16 Novembre imm. Sayakh                             ' , '' , '' , '71010' , '' , '' , '40000' , '' , '' , '' , '' , '' , '' , '-8.0082             ' , '31.63103333333      ' , '' , '' , '' , '' , '45112288' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Medecin  chirurgie generale' ),
('MA2138930' , 'C321 ' , 'K10' , 'A' , 'E' , '' , 'Carrosserie ElAbbassy                                                                               ' , '' , '3310' , 'avenue Ambassadeur Ben Aïcha                             ' , ', ang. rue d Azrou                                          ' , '1' , '' , '91510' , '' , '' , '20290' , '12' , '46' , '830' , '1230' , '1400' , '1800' , '-7.5929986224639325 ' , '33.598308772267224  ' , '66383' , '91010' , '' , '1601593' , '31213250' , '4' , 1992 , 2700000 , 'C ' , 0 , 25 ,0 , 4 , 3500 , 1800 , '' , '5' ,'5' ,'B' , 'P' , '' ,  'Carrosserie industrielle (auto cars, bus, fourgons etc..), chaudronnerie et charpente, tôlerie, fabrication semi-remorq' ),
('MA2142928' , 'C151 ' , 'K20' , 'A' , 'F' , '' , 'boutique ElBakkali                                                                                  ' , '' , '8180' , 'rue Chakib Arsalane (anc. medina)                        ' , '' , '7' , '' , '91110' , '' , '' , '20000' , '14' , '6' , '' , '' , '' , '' , '-7.61829            ' , '33.598              ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 3 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Vente de vetements cuir' ),
('MA2150924' , 'C230 ' , 'K20' , 'A' , 'D' , '' , 'ets ElMaleh                                                                                         ' , '' , '20860' , 'route de Mediouna                                        ' , '' , '160' , '' , '91710' , '' , '' , '20490' , '10' , '36' , '' , '' , '' , '' , '-7.603240874796464  ' , '33.582427525740265  ' , '65613' , '91010' , '84541000094' , '1048131' , '33305212' , '4' , 1992 , 100000 , 'B ' , 0 , 2 ,6 , 2 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Fourniture de chantiers, (outillages), produits d etancheite' ),
('MA2154922' , 'C245 ' , 'K10' , 'A' , 'E' , '' , 'Startiss                                                                                            ' , '' , '18760' , 'avenue Lalla Yacout                                      ' , ', c. com. Riad n°4 bis                                      ' , '61' , '' , '91110' , '' , '' , '' , '14' , '20' , '' , '' , '' , '' , '-7.612615977367672  ' , '33.59063450988812   ' , '72113' , '91010' , '' , '1067464' , '32208471' , '4' , 1993 , 500000 , 'B ' , 0 , 5 ,0 , 0 , 115 , 115 , 'CI' , '8' ,'8' ,'' , '' , '' ,  'Tissus d ameublement et decoration' ),
('MA2162918' , 'C211 ' , 'H73' , 'A' , 'Q' , '' , 'Bohsina Khalid                                                                                      ' , '' , '31470' , 'bd Abdelhadi Boutaleb ex  Azemmour                       ' , 'ang. Sidi Abderrahman, imm. 2°et. n°4                       ' , '' , '' , '91110' , '' , '' , '' , '7' , '25' , '' , '' , '' , '' , '-7.673211527987818  ' , '33.576851872174764  ' , '' , '' , '' , '' , '' , '55' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , 'IH' , '5' ,'5' ,'' , '' , '' ,  'Architecte Dplg' ),
('MA2170914' , 'C360 ' , 'K20' , 'A' , 'F' , '' , 'Papeterie ElJoulane                                                                                 ' , '' , '31110' , 'avenue Joulan - ex D                                     ' , ', bloc 36  n°28 bis                                         ' , '' , '' , '91610' , '' , '' , '20700' , '17' , '53' , '' , '' , '' , '' , '-7.57558            ' , '33.5604             ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 2 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Papeterie' ),
('MA2198900' , 'C348 ' , 'K20' , 'A' , 'D' , '' , 'Oki-tec                                                                                             ' , '' , '22950' , 'bd Oqba Ben Nafia                                        ' , ', Masjid Okba, hay Adil                                     ' , '' , '' , '91510' , '' , '' , '20350' , '12' , '1' , '' , '' , '' , '' , '-7.56036            ' , '33.58               ' , '105116' , '' , '' , '' , '34022806' , '' , 0 , 0 , '' , 0 , 8 ,0 , 0 , 0 , 0 , '' , '5' ,'8' ,'' , 'B' , '' ,  'Importation et vente materiel electrique et bobinage' ),
('MA3082458' , 'FE05 ' , 'K20' , 'A' , 'F' , '' , 'Planet Optic                                                                                        ' , '' , '74056' , 'rue Nuastir                                              ' , ', Champs de Cours                                           ' , '7' , '' , '141010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.008566666667     ' , '34.03691666667      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Opticien.' ),
('MA2210894' , 'C231 ' , 'K10' , 'D' , 'U' , '' , 'Cartonnerie et emballage du centre                                                                  ' , 'Centre emballage                   ' , '3960' , 'av de l  Armee Royale                                    ' , ', 13°et.                                                    ' , '67' , '' , '91110' , '' , '' , '20000' , '14' , '67' , '' , '' , '' , '' , '-7.612447103619036  ' , '33.59699367083212   ' , '45119' , '91010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 100 ,0 , 4 , 0 , 0 , '' , '8' ,'8' ,'' , 'B' , '' ,  'Caisse en carton, papeterie' ),
('MA2212893' , 'AG01 ' , 'H63' , 'A' , 'Q' , '' , 'Ben Essaidi Mohamed                                                                                 ' , '' , '70326' , 'bd Hassan II                                             ' , ', imm. Krouz, 1°et.                                         ' , '' , '' , '41110' , '' , '' , '80000' , '' , '' , '' , '' , '' , '' , '-9.595283           ' , '30.416270           ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Avocat' ),
('MA2216891' , 'C228 ' , 'H55' , 'A' , 'Q' , '' , 'Kacemi Saadia                                                                                       ' , '' , '260' , 'bd Abdelmoumen                                           ' , ', resid. Les Jardins Abdelmoumen imm. G3. 1°et n°4          ' , '210' , '' , '91210' , '' , '' , '20390' , '9' , '18' , '' , '' , '' , '' , '-7.6260998989868085 ' , '33.570260247774584  ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Chirurgien dentiste' ),
('MA2226886' , 'C355 ' , 'K25' , 'A' , 'I' , '' , 'Teleboutique Hamiti M hamed                                                                         ' , '' , '31060' , 'lot. Salmia I                                            ' , ', rue 2 n°18                                                ' , '' , '' , '91610' , '' , '' , '20450' , '13' , '47' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Teleboutique' ),
('MA3034482' , '' , 'K10' , 'A' , 'G' , '' , 'Hôtel Lixus                                                                                         ' , '' , '99990' , 'av des Far                                               ' , '' , '' , '' , '82010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-2.92745            ' , '35.1721             ' , '2181' , '82010' , '1780000000000' , '5370269' , '' , '4' , 0 , 1000000 , '' , 0 , 9 ,0 , 3 , 0 , 0 , 'BP' , '5' ,'5' ,'' , '' , '' ,  'Hôtel 3* A' ),
('MA3046476' , 'TA03 ' , 'H55' , 'A' , 'Q' , '' , 'Lazrak Lotfi                                                                                        ' , '' , '70316' , 'bd Habib Bourguiba                                       ' , ', 3°et. appt. 37                                            ' , '124' , '' , '163010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.822116666667     ' , '35.78111666667      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Chirurgien dentiste' ),
('MA3062468' , 'R580 ' , 'H57' , 'A' , 'D' , '' , 'Pharmacie Dahabi                                                                                    ' , '' , '70444' , 'bd Moulay Abdallah                                       ' , ', sect. 5, hay Ennahda, Karia                               ' , '7' , '' , '102010' , '' , '' , '11100' , '' , '' , '' , '' , '' , '' , '-6.769215203427166  ' , '34.01708229384573   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pharmacie' ),
('MA3066466' , 'TA21 ' , 'H78' , 'A' , 'M' , '' , 'Azancot Abraham                                                                                     ' , '' , '70496' , 'bd Prince Moulay Abdallah                                ' , '' , '33' , '' , '163010' , '' , '' , '90000' , '' , '' , '' , '' , '' , '' , '-5.809783333333     ' , '35.77881666667      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Conseil juridique et fiscal, commissaire aux comptes' ),
('MA3070464' , 'OU03 ' , 'K20' , 'A' , 'M' , '' , 'Chouraki Assurances                                                                                 ' , '' , '99990' , 'bd Maghrib Arabi                                         ' , 'ang. bd. Lt. Belhoucine imm. Ousti, 1°et. appt. 4           ' , '' , '' , '83010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-1.91005            ' , '34.67938333333      ' , '17957' , '83010' , '1850000000000' , '5301588' , '' , '4' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'P' , '' ,  'Assurances (agents generaux)' ),
('MA3076461' , 'TA21 ' , 'K20' , 'A' , 'D' , '' , 'Pronautique                                                                                         ' , '' , '70514' , 'bd Sidi Bouabid                                          ' , '' , '100' , '' , '163010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.8195             ' , '35.78183333333      ' , '16909' , '163010' , '1530000000000' , '4905285' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Vente de bateaux de plaisance, ecole de plongee sous marine, vente materiel nautique' ),
('MA3080459' , 'C221 ' , 'K20' , 'D' , 'D' , '' , 'Diamantine                                                                                          ' , '' , '33520' , 'bd El Qods                                               ' , 'ang. 2 Mars                                                 ' , '' , '' , '91210' , '' , '' , '20150' , '1' , '2' , '' , '' , '' , '' , '-7.61326            ' , '33.5336             ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'8' ,'' , '' , '' ,  'Vente de chales, foulards et tous produits textiles (jellabas, pyjamas, bijoux, sacs)' ),
('MA3100449' , 'C221 ' , 'K20' , 'A' , 'D' , '' , 'Institut Superieur de Formation et de Coaching                                                      ' , 'Is-Force                           ' , '42960' , 'qu. les Cretes                                           ' , ', resid. Miamar imm. D                                      ' , '' , '' , '92210' , '16405' , '' , '' , '1' , '31' , '' , '' , '' , '' , '-7.64112563388825   ' , '33.54232918353192   ' , '114897' , '91010' , '218000000000' , '2202356' , '34025342' , '4' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Formation des cadres pour les societes, coaching' ),
('MA3102448' , 'IN01 ' , 'K20' , 'A' , 'E' , '' , 'Aboudrar Lahcen                                                                                     ' , '' , '99990' , 'bd Mokhtar Soussi                                        ' , ', Dcheira                                                   ' , '321' , '' , '42012' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.539883333333     ' , '30.36676666667      ' , ' 3495               ' , '42012' , '' , '' , '49708098' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Travaux de soudure.' ),
('MA3106446' , '' , 'K10' , 'D' , 'U' , '' , 'Regie Autonome de Distribution d Eau et d Electricite Province d Eljadida                           ' , 'R.a.d.e.e.j.                       ' , '99990' , 'hay Riad                                                 ' , '' , '' , '' , '96014' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 1 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Distribution d eau et d electricite' ),
('MA3110444' , 'R685 ' , 'H38' , 'A' , 'M' , '' , 'Union Nationale des Associations Prescolaires                                                       ' , '' , '66640' , 'hay ElFarah (Takadoum)                                   ' , ', n°12                                                      ' , '31' , '' , '101010' , '' , '' , '10200' , '' , '' , '' , '' , '' , '' , '-6.813727           ' , '33.988176           ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Association' ),
('MA3120439' , 'AG02 ' , 'H63' , 'A' , 'Q' , '' , 'Yakhlef Mustapha                                                                                    ' , '' , '70443' , 'bd Moukaouama                                            ' , ', imm. Ifrane, 4°et.                                        ' , '' , '' , '41110' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.578116666667     ' , '30.41705            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Avocat' ),
('MA3126436' , 'AG03 ' , 'K20' , 'A' , 'D' , '' , 'Little Italy                                                                                        ' , '' , '70326' , 'bd Hassan II                                             ' , ', imm. Ghoumri                                              ' , '' , '' , '41110' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.6001             ' , '30.421              ' , '10191' , '41110' , '75076000054' , '6903620' , '' , '' , 2004 , 800000 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Restaurant pizzeria italien' ),
('MA3128435' , 'TE01 ' , 'K20' , 'A' , 'F' , '' , 'ets Chtoun                                                                                          ' , '' , '99990' , 'av. Omar ElMokhtar rte de Tanger                         ' , '' , '1' , '' , '164010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.400783333333     ' , '35.5658             ' , '24025' , '' , '' , '' , '' , '' , 0 , 500000 , 'E ' , 13520915 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Materiels de construction' ),
('MA3132433' , 'C352 ' , 'K20' , 'A' , 'D' , '' , 'Au Chic Parisien                                                                                    ' , '' , '44370' , 'bd Amgala - ex A                                         ' , ', Hay El Osra                                               ' , '195' , '' , '91210' , '' , '' , '20480' , '1' , '2' , '' , '' , '' , '' , '-7.5858253300044645 ' , '33.53741016123012   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Cremerie' ),
('MA3134432' , 'MA05 ' , 'K20' , 'A' , 'D' , '' , 'Auto Ecole Chouhada                                                                                 ' , '' , '70136' , 'bd Al Barrada                                            ' , ', Sidi Youssef Ben Ali                                      ' , '255' , '' , '71010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-7.9683             ' , '31.60980            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Auto ecole' ),
('MA3140429' , 'MA03 ' , 'K20' , 'A' , 'M' , '' , 'Immovinci                                                                                           ' , '' , '70437' , 'bd Mohammed V                                            ' , '' , '245' , '' , '71010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-8.015966666667     ' , '31.63463333333      ' , '24439' , '71010' , '71159000083' , '6510114' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'P' , '' ,  'Agence immobiliere' ),
('MA3148425' , 'TA01 ' , 'K20' , 'A' , 'D' , '' , 'Century 21 D3 Real Estate                                                                           ' , '' , '70345' , 'bd Idriss 1er                                            ' , ', resid. ElKheir                                            ' , '' , '' , '163010' , '' , '' , '90000' , '' , '' , '' , '' , '' , '' , '' , '' , '28767' , '163010' , '1450000000000' , '4908666' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'P' , '1' ,  'Agence immobiliere' ),
('MA3150424' , 'CSM1 ' , 'K20' , 'A' , 'A' , '' , 'Nobel Creation                                                                                      ' , '' , '99990' , 'lotiss. Attaoufik                                        ' , ', sidi Maarouf                                              ' , '16' , '' , '91416' , '' , '' , '' , '1' , '68' , '' , '' , '' , '' , '' , '' , '133185' , '91010' , '37358000037' , '2203041' , '' , '4' , 2005 , 4000000 , 'E ' , 12861081 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Impression numerique' ),
('MA3158420' , 'C248 ' , 'H63' , 'A' , 'Q' , '' , 'Smir Saadia                                                                                         ' , '' , '23050' , 'rue Omar Slaoui                                          ' , ', 1°et.                                                     ' , '29' , '' , '91110' , '' , '' , '20130' , '14' , '16' , '' , '' , '' , '' , '-7.61899            ' , '33.5882             ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Avocat' ),
('MA3162418' , '' , 'K20' , 'A' , 'G' , '' , 'Dar Baba                                                                                            ' , '' , '99990' , 'rue Marrakech                                            ' , '' , '2' , '' , '75010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.772083333333     ' , '31.51345            ' , '195' , '75010' , '1720000000000' , '5790093' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Restaurant cuisine italienne' ),
('MA3172413' , 'C133 ' , 'K20' , 'A' , 'A' , '' , 'Mirab Auto Service                                                                                  ' , '' , '21780' , 'rue Ennahas Annahoui-ex Mont Pelvoux                     ' , '' , '' , '' , '91210' , '' , '' , '20330' , '9' , '34' , '' , '' , '' , '' , '-7.638616618276916  ' , '33.58285332780272   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '8' ,'8' ,'' , '' , '' ,  'Mecanique Autos' ),
('MA3180409' , 'C141 ' , 'K20' , 'A' , 'D' , '' , 'Association pour un Maroc Vert, pour le Developpement de l eco-citoyennete                          ' , 'Association pour un Maroc Vert     ' , '27800' , 'rue Socrate                                              ' , ', 3°et. Maarif                                              ' , '35' , '' , '91210' , '' , '' , '20380' , '9' , '34' , '' , '' , '' , '' , '-7.645260107491397  ' , '33.578105107579994  ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'8' ,'' , '' , '' ,  'Association pour le developpement de l eco-citoyennete' ),
('MA3182408' , 'C331 ' , 'K10' , 'A' , 'D' , '' , 'Maskem Maroc                                                                                        ' , '' , '22091' , 'bd Moulay Slimane                                        ' , ', parc d activite Oukacha E8                                ' , '2' , '' , '91610' , '' , '' , '20580' , '2' , '5' , '' , '' , '' , '' , '-7.539934680        ' , '33.619019310        ' , '148295' , '91010' , '28169000014' , '1103485' , '' , '3' , 2006 , 1500000 , 'C ' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Matieres premieres alimentaire, cosmetique, indutrielle' ),
('MA3184407' , 'C212 ' , 'K10' , 'D' , 'M' , '' , 'Banque Marocaine pour le Commerce et l Industrie                                                    ' , 'B.m.c.i. (ag. Casa Ibn Sina)       ' , '16960' , 'bd Ibn Sina - ex Avicenne                                ' , ', resid. Saada                                              ' , '1' , '' , '91210' , '' , '' , '20220' , '7' , '40' , '' , '' , '' , '' , '-7.671711111111     ' , '33.570325           ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Banques' ),
('MA3188405' , '' , 'K20' , 'A' , 'D' , '' , 'Ecole Edderwa Nouaceur                                                                              ' , '' , '99990' , 'Eddarwa nouaceur                                         ' , '' , '' , '' , '95013' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Ecole primaire public' ),
('MA3192403' , 'R663 ' , 'K20' , 'A' , 'D' , '' , 'Piece Auto Aït Matne                                                                                ' , '' , '64990' , 'bd Moustakbal                                            ' , ', bloc 5 Amal 1 C.y.m.                                      ' , '21' , '' , '101010' , '' , '' , '10140' , '' , '' , '' , '' , '' , '' , '-6.88125204         ' , '33.98756796         ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pieces autos' ),
('MA3198400' , '' , 'K10' , 'D' , 'M' , '' , 'Banque Marocaine du Commerce Exterieur                                                              ' , 'Bmce (ag. Safi Sidi Abdelkrim)     ' , '99990' , 'lotiss. Lourini 2                                        ' , ', lot 6 sidi Abdelkrim                                      ' , '' , '' , '77010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Banque' ),
('MA3200399' , '' , 'H57' , 'A' , 'D' , '' , 'Pharmacie AlWahda                                                                                   ' , '' , '99990' , 'Jorf ElMalha                                             ' , '' , '' , '' , '106010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pharmacie' ),
('MA3204397' , 'C200 ' , 'K20' , 'A' , 'M' , '' , 'Centre de Kinesitherapie Nassim                                                                     ' , '' , '46160' , 'hay Nassim (Lissasfa)                                    ' , ', mosquee Fatima Abdellah Bakchane n°10 bis                 ' , '' , '' , '91210' , '' , '' , '' , '7' , '40' , '' , '' , '' , '' , '-7.661113455467216  ' , '33.52624952795389   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Kinesitherapie' ),
('MA3206396' , 'C360 ' , 'K20' , 'A' , 'A' , '' , 'Menuiserie Annasr                                                                                   ' , '' , '27660' , 'cite Sidi Othmane                                        ' , ', rue 5. n° 6                                               ' , '' , '' , '92110' , '' , '' , '20700' , '17' , '53' , '' , '' , '' , '' , '' , '' , '82163' , '91010' , '39450000007' , '2820420' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Menuiserie de Bois' ),
('MA3210394' , 'R510 ' , 'K20' , 'A' , 'I' , '' , 'Amina Bush                                                                                          ' , '' , '71762' , 'lotiss. Raht El Bal                                      ' , ', resid. Nassim Al Bahr 3 imm. A appt. n°7 Said Hajji       ' , '' , '' , '102010' , '' , '' , '11160' , '' , '' , '' , '' , '' , '' , '-6.79391            ' , '34.07414            ' , '37106' , '102010' , '803000000000' , '40141209' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Institut de beaute' ),
('MA3212393' , '' , 'K20' , 'A' , 'I' , '' , 'Atlas Fitness                                                                                       ' , '' , '99990' , 'Lotissement Beni Yakhlef                                 ' , ', Fb/72                                                     ' , '' , '' , '93015' , '' , '' , '28815' , '' , '' , '' , '' , '' , '' , '-7.33716            ' , '33.68925            ' , '51570' , '105010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'culture physique, fitness' ),
('MA3214392' , 'TA21 ' , 'K20' , 'A' , 'M' , '' , 'Arbit Car                                                                                           ' , '' , '70491' , 'bd Pasteur                                               ' , ', T25                                                       ' , '54' , '' , '163010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.809083333333     ' , '35.7801             ' , '43695' , '163010' , '222000000000' , '40127719' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'P' , '1' ,  'Location de voiture' ),
('MA3216391' , '' , 'K20' , 'A' , 'A' , '' , 'Mar Star                                                                                            ' , '' , '99990' , 'Route Ain Sayerni                                        ' , '' , '' , '' , '95012' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-7.6074             ' , '33.26118333333      ' , '4391' , '95012' , '' , '' , '' , '4' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Biscuiterie' ),
('MA3218390' , 'AG10 ' , 'H63' , 'A' , 'Q' , '' , 'ElKanfoud Abdelaziz                                                                                 ' , '' , '72065' , 'quartier Riad Salam                                      ' , ', imm. AlMoustakbal porte 1 1°et.                           ' , '116' , '' , '41110' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.5757             ' , '30.40953333333      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Avocats' ),
('MA3222388' , 'C323 ' , 'K20' , 'A' , 'M' , '' , 'Oussi Negoce                                                                                        ' , '' , '28430' , 'hay Takadoum                                             ' , ', rue 16 n°51 hay Mohammadi                                 ' , '' , '' , '91610' , '' , '' , '' , '8' , '26' , '' , '' , '' , '' , '-7.566649348440284  ' , '33.58298504685003   ' , '211001              ' , '91010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Import export' ),
('MA3224387' , '' , 'K25' , 'A' , 'I' , '' , 'Gravure Taghzout                                                                                    ' , '' , '99990' , 'av Abdellah Guenoun                                      ' , ', cite Hassani                                              ' , '54' , '' , '42012' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.534166666667     ' , '30.35758333333      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'P' , '' ,  'Graveur' ),
('MA3226386' , '' , 'H38' , 'A' , 'M' , '' , 'Association de Soutien des Malades Insuffisants Renaux Safi                                         ' , '' , '99990' , 'quartier ElMoustachfa                                    ' , ', n°12 rue Bordeaux                                         ' , '' , '' , '77010' , '132' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Association' ),
('MA3228385' , 'C150 ' , 'K20' , 'D' , 'U' , '' , 'Ramapar                                                                                             ' , 'Cash Plus                          ' , '3550' , 'rue des Anglais                                          ' , '' , '153' , '' , '91110' , '' , '' , '' , '14' , '6' , '' , '' , '' , '' , '-7.62362            ' , '33.5981             ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Transfert d argent' ),
('MA3230384' , '' , 'K20' , 'A' , 'M' , '' , 'Fiduciaire AlMarjane                                                                                ' , '' , '99990' , 'lotiss. Ouahidi                                          ' , ', bd Mohammed VI, 2°et. appt. 2                             ' , '11' , '' , '125010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.927830555556     ' , '32.89073888889      ' , '4966' , '125010' , '1610000000000' , '59540695' , '41067209' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'D' , '' ,  'Fiduciaire' ),
('MA3232383' , 'R599 ' , 'K20' , 'D' , 'U' , '' , 'Banque Populaire (ag. Al Arsa)                                                                      ' , '' , '72108' , 'rte de Kenitra                                           ' , ', km 5 hay Al Amal                                          ' , 'K050 ' , '' , '102010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Banque' ),
('MA3238380' , '' , 'K20' , 'A' , 'I' , '' , 'Poterie Alhiane                                                                                     ' , '' , '71127' , 'hay Dakhla                                               ' , ', bloc E1, n°75                                             ' , '' , '' , '41110' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Poterie artisanale' ),
('MA3240379' , '' , 'K20' , 'A' , 'I' , '' , 'Station Total Zemmour                                                                               ' , '' , '99990' , 'av Ibn Sina                                              ' , '' , '' , '' , '104010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.07343            ' , '33.8194             ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Station services (carburant)' ),
('MA3242378' , 'C246 ' , 'K20' , 'A' , 'I' , '' , 'Sogerep                                                                                             ' , '' , '29690' , 'rue Adan -ex Vesoul                                      ' , '' , '6' , '' , '91110' , '' , '' , '' , '14' , '36' , '' , '' , '' , '' , '-7.611658695294076  ' , '33.58913160179889   ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '8' ,'8' ,'' , '' , '' ,  'Equipements scientifiques, materiels de laboratoires, traitements des eaux' ),
('MA3246376' , '' , 'K10' , 'D' , 'U' , '' , 'Axa Credit                                                                                          ' , '' , '99990' , 'bd Mohamed VI                                            ' , ', imm. Anakhil                                              ' , '2' , '' , '149010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-4.011683333333     ' , '34.22315            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Credit a la consommation et credit automobile' ),
('MA3248375' , '' , 'K20' , 'A' , 'I' , '' , 'Ghizlane Ouelaf (boutique)                                                                          ' , '' , '99990' , 'hay Almrina                                              ' , ', kiss. Sidi Makhlouf                                       ' , '' , '' , '162011' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-5.899833333333     ' , '34.99635            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Vetements traditionnels' ),
('MA3250374' , '' , 'K20' , 'A' , 'I' , '' , 'Labo Photo Amsguine                                                                                 ' , '' , '99990' , 'place Mly Hassan                                         ' , '' , '6' , '' , '75010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-9.771833333333     ' , '31.51183333333      ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Labo photo' ),
('MA3260369' , '' , 'K20' , 'D' , 'U' , '' , 'Inwi (ag. Sale Mellah)                                                                              ' , '' , '70115' , 'bd Ahmed Ben Aboud                                       ' , '' , '71' , 'X' , '102010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.82075            ' , '34.03409            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '7' ,'5' ,'' , '' , '' ,  'Operateur global de telecommunication' ),
('MA3264367' , 'FE03 ' , 'K20' , 'A' , 'I' , '' , 'Tresors du Terroir                                                                                  ' , '' , '73860' , 'rue Abdelkrim Khattabi                                   ' , ', v.n.                                                      ' , '10' , '' , '141010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-4.999371           ' , '34.038184           ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , 'B' , '' ,  'Produits naturels et bio' ),
('MA3266366' , 'TD03 ' , 'H57' , 'A' , 'I' , '' , 'Pharmacie Al Kheir                                                                                  ' , '' , '99990' , 'douar Takarkoute                                         ' , ', Ait Iaaza                                                 ' , '' , '' , '43010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-8.793083333333     ' , '30.5063             ' , '16496' , '43010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pharmacie' ),
('MA3270364' , 'OU02 ' , 'K20' , 'A' , 'M' , '' , 'Co Cr Mo                                                                                            ' , '' , '99990' , 'rue des Nations Unies                                    ' , '' , '11' , '' , '83010' , '' , '83010' , '60000' , '' , '' , '' , '' , '' , '' , '-1.91756            ' , '34.67720            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Laboratoire de protheses dentaires' ),
('MA3272363' , 'C221 ' , 'H57' , 'A' , 'I' , '' , 'Pharmacie Jnane Californie                                                                          ' , '' , '7450' , 'quartier Californie                                      ' , ', piste Tadart n°10 resid. Jnane Californie                 ' , '' , '' , '92210' , '' , '' , '' , '1' , '15' , '' , '' , '' , '' , '-7.6103091961406335 ' , '33.52920598985064   ' , '274771' , '91010' , '1510000000000' , '14496504' , '' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Pharmacie' ),
('MA3276361' , '' , 'K20' , 'A' , 'B' , '' , 'Atmani Lighting                                                                                     ' , '' , '99990' , 'lotiss. Ghizlane                                         ' , '' , '11' , '' , '122010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.364127           ' , '32.322867           ' , '5883' , '122010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '8' ,'8' ,'' , '' , '' ,  'Production eclairage led' ),
('MA3280359' , 'C312 ' , 'K20' , 'A' , 'M' , '' , 'Kgh Consulting Maroc                                                                                ' , '' , '13070' , 'bd Emile Zola                                            ' , '' , '42' , '' , '91610' , '' , '' , '' , '12' , '10' , '' , '' , '' , '' , '-7.641069665558302  ' , '33.588501890221224  ' , '135241' , '91010' , '12714000005' , '1680461' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Comptabilite' ),
('MA3284357' , 'C131 ' , 'H36' , 'A' , 'M' , '' , 'Association Marocaine des Agences Immobilieres                                                      ' , 'Amai                               ' , '2660' , 'rue El Kassar - ex Wagram                                ' , 'resid. Clarence 2°et. bur 3                                 ' , '13' , '' , '91210' , '' , '' , '' , '9' , '34' , '' , '' , '' , '' , '' , '' , '36899' , '91010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Association professionnelle' ),
('MA3288355' , 'MA03 ' , 'K20' , 'A' , 'M' , '' , 'Zone Tech                                                                                           ' , '' , '70054' , 'Assif C                                                  ' , '' , '77' , '' , '71010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-8.00373            ' , '31.66217            ' , '59115' , '71010' , '228000000000' , '6528606' , '' , '4' , 2014 , 100000 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Vente du materiel informatique et bureautique' ),
('MA3290354' , 'R611 ' , 'K20' , 'A' , 'I' , '' , 'El Asri Walid                                                                                       ' , '' , '56130' , 'rue Souika                                               ' , '' , '32' , '' , '101010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.8381324          ' , '34.02329            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Vente de vetements et d articles de sport' ),
('MA3292353' , 'KE05 ' , 'K20' , 'A' , 'M' , '' , 'B Amys Cars                                                                                         ' , '' , '72975' , 'rue la Reine Elizabeth                                   ' , ', n°7                                                       ' , '2' , '' , '105010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.583196766270476  ' , '34.261042962574265  ' , '41527' , '105010' , '' , '' , '' , '4' , 0 , 100000 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Location de voitures' ),
('MA3294352' , 'C134 ' , 'K20' , 'A' , 'B' , '' , 'Am Renov                                                                                            ' , '' , '15290' , 'rue Haj Jillali Eloufir-ex Guillotte                     ' , ', bd Yacoube El Mansour                                     ' , '16' , '' , '91210' , '' , '' , '20000' , '9' , '34' , '' , '' , '' , '' , '-7.641234524725405  ' , '33.576346279386925  ' , '15238109' , '' , '' , '' , '35892020' , '4' , 2015 , 100000 , '' , 0 , 1 ,9 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '1' ,  'Batiment' ),
('MA3296351' , 'R644 ' , 'K20' , 'A' , 'M' , '' , 'Alaqar. Ma                                                                                          ' , '' , '50850' , 'avenue Al Abtal                                          ' , ', appt. n°7                                                 ' , '17' , '' , '101010' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '-6.84753948         ' , '34.00130871         ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'site d annonces immobilieres' ),
('MA3300349' , 'C147 ' , 'K20' , 'A' , 'M' , '' , 'Union des Chambres de Commerce et d Industrie Europeennes au Maroc                                  ' , 'Eurocham                           ' , '46790' , 'rue Ahmed Ben Taher El Menjra                            ' , ', lot El Manar villa 18 q. El Hank                          ' , '' , '' , '91110' , '' , '' , '20160' , '4' , '12' , '' , '' , '' , '' , '-7.650194978573609  ' , '33.59934051188021   ' , '23465' , '91010' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Rassemblement des interets des entreprises europeennes au maroc, promotion du developpement des relations economiques et commerciales' ),
('MA3302348' , '' , 'K20' , 'A' , 'A' , '' , 'Nova Motion 3d                                                                                      ' , '' , '70353' , 'bd Imam El Boukhari                                      ' , ', 2°et.                                                     ' , '10' , '' , '41110' , '' , '' , '80000' , '' , '' , '' , '' , '' , '' , '' , '' , '30839' , '41110' , '232000000000' , '' , '' , '4' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Agences de publicite' ),
('MA3304347' , 'R510 ' , 'H53' , 'A' , 'Q' , '' , 'Bensalah Noureddine                                                                                 ' , '' , '70498' , 'bd Prince Sidi Mohamed                                   ' , ', resid. Diyar III, Entree A, imm. 3 appt. 5                ' , '' , '' , '102010' , '' , '' , '0' , '' , '' , '' , '' , '' , '' , '-6.81665            ' , '34.04052            ' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 2 ,3 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Medecin pneumologue' ),
('MA3306346' , 'C352 ' , 'K20' , 'A' , 'I' , '' , 'Para Oxygene                                                                                        ' , '' , '30140' , 'hay Yasmina                                              ' , ', rue 20 n°121 bis                                          ' , '' , '' , '92210' , '' , '' , '' , '1' , '2' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'5' ,'' , '' , '' ,  'Parapharmacie' ),
('MA3310344' , '' , 'H56' , 'A' , 'Q' , '' , 'Bouayad Ilyas                                                                                       ' , '' , '99990' , 'quartier Kssaibi                                         ' , ', rue B n°1, rdc                                            ' , '' , '' , '163010' , '' , '' , '90000' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , '' , 0 , 0 , '' , 0 , 0 ,0 , 0 , 0 , 0 , '' , '5' ,'3' ,'' , '' , '' ,  'Kinesitherapeute' );

-- --------------------------------------------------------

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`code`, `fonction`) VALUES
(111, 'President'),
(112, 'Vice pr.'),
(113, 'Adm. un.'),
(114, 'Propr.'),
(115, 'Admin.'),
(116, 'Gerant'),
(117, 'Adm. del.'),
(199, ''),
(1000, 'ADM. ACT.'),
(1019, 'Pres. del.'),
(1021, 'Admin un.'),
(1022, 'P.d.g.'),
(1023, 'Adm. del.'),
(1024, 'Adm.d.gen.'),
(1025, 'Dir.propr.'),
(1026, 'Dir. ger.'),
(1027, 'Adm. dir.'),
(1031, 'Gouverneur'),
(1033, 'Vice P.del'),
(1099, ''),
(1100, 'Dir. gen.'),
(1125, 'Dir. gen.'),
(1130, 'Dir.gen.a.'),
(1135, 'Sec. gen.'),
(1140, 'Dir. etab.'),
(1145, 'Dir.'),
(1147, 'Sous-dir.'),
(1150, 'Dir. adj.'),
(1160, 'Fond.pouv.'),
(1162, 'Att. dir.'),
(1165, 'Conseiller'),
(1180, 'Med.'),
(1185, 'Pharmacien'),
(1186, 'Expert'),
(1187, 'Avocat'),
(1188, 'Notaire'),
(1199, ''),
(1200, 'D. admin.'),
(1205, 'Dir. adm.'),
(1210, 'Dir. fin.'),
(1215, 'Dir.adm.f.'),
(1220, 'Resp. jur.'),
(1225, 'Compt.gest'),
(1299, ''),
(1400, 'D.dpt div.'),
(1405, 'Dir. dept'),
(1410, 'Dir. div.'),
(1415, 'Resp. dept'),
(1420, 'Resp. div.'),
(1499, ''),
(1600, 'D.per.for.'),
(1605, 'Dir. pers.'),
(1607, 'Dir. r.h.'),
(1610, 'Chef pers.'),
(1615, 'Resp.form.'),
(1699, ''),
(1800, 'Dir. com.'),
(1805, 'Dir. com.'),
(1808, 'Chef ag.'),
(1810, 'Resp.com.'),
(1815, 'Dir. mark.'),
(1820, 'Resp.mark.'),
(1825, 'Dir. pub.'),
(1830, 'Resp. pub.'),
(1835, 'D.rel.ext.'),
(1840, 'R.communi.'),
(1899, ''),
(1999, ''),
(2000, 'D. Export'),
(2005, 'Dir.export'),
(2010, 'Res.export'),
(2099, ''),
(2200, 'D.tec.pro.'),
(2205, 'Dir. tech.'),
(2207, 'Dir. expl.'),
(2208, 'Dir. Usine'),
(2210, 'Dir. prod.'),
(2212, 'Dir.travx.'),
(2213, 'Dir.'),
(2215, 'Resp.tech.'),
(2220, 'Resp.prod.'),
(2225, 'Methode'),
(2230, 'Entretien'),
(2235, 'Securite'),
(2240, 'Bur.etudes'),
(2242, 'Qualite'),
(2245, 'Etu.RecDev'),
(2250, 'Resp. ag.'),
(2255, 'Resp.Depôt'),
(2260, 'Resp.usine'),
(2265, 'Res.centre'),
(2270, 'Res. succ.'),
(2280, 'Ingenieur'),
(2285, 'Chef sce.'),
(2299, ''),
(2400, 'D.ach.app.'),
(2405, 'Dir Achats'),
(2406, 'Resp. ach.'),
(2407, 'Ach.(R st)'),
(2410, 'Dir.Appro.'),
(2415, 'Resp. app.'),
(2499, ''),
(2500, 'D. Ventes'),
(2505, 'Dir.ventes'),
(2510, 'Res.ventes'),
(2599, ''),
(2600, 'S. Inform.'),
(2605, 'Doc. tech.'),
(2610, 'Doc. comm.'),
(2699, ''),
(2800, 'D. info.'),
(2805, 'Dir. info.'),
(2810, 'Resp.info.'),
(2899, ''),
(9900, 'Divers'),
(9910, 'Memb.club.'),
(9920, 'Sign. pub.'),
(9921, 'Sgn.pub KT'),
(9922, 'Sgn.pub KC'),
(9923, 'Sgn.pub KB'),
(215, 'Admin.'),
(211, 'President'),
(9924, 'Sign P OMA'),
(1028, 'Co. Gerant'),
(9925, 'Sgn.pub KP'),
(1181, 'Metreur'),
(1216, 'Cont.Gest.'),
(1182, 'Architecte'),
(1183, 'Kinesi.'),
(2802, 'D.s.i.'),
(2602, 'Dir. Info.'),
(118, 'President'),
(119, 'Membre'),
(9930, 'infos 500'),
(1124, 'President'),
(1126, 'Membre'),
(1189, 'Psycholog.'),
(1184, 'Veterin.'),
(1190, 'Huissier'),
(1191, 'Adoul'),
(1192, 'Topographe');

-- --------------------------------------------------------

--
-- Contenu de la table `formes_juridiques`
--

INSERT INTO `formes_juridiques` (`code`, `forme_jur`) VALUES
(1, 'Assoc.'),
(2, 'G.i.e.'),
(3, 'S.a.'),
(4, 'S.a.r.l'),
(5, 'S.c.act'),
(6, 'S. Fait'),
(7, 'S.n.c.'),
(8, 'Sam'),
(9, 'S.civil'),
(10, 'S.c.i.'),
(11, 'S.c.a.'),
(13, 'SNADC'),
(20, 'SNDP'),
(21, 'LTDPRIV'),
(22, 'LTDPUBL'),
(23, 'JTVENT'),
(24, 'MASS-TR'),
(25, 'Syndica'),
(30, 'Et-publ'),
(31, 'Coop.'),
(32, 'COOP.RL'),
(33, 'SA-FERM'),
(34, 'STAT-CT'),
(35, 'JTSTCY'),
(36, 'SARLCOM'),
(37, 'MUT-ASS'),
(38, 'BUIDST'),
(39, 'BQ-POPU'),
(40, 'Epic'),
(41, 'LTD-PRI'),
(42, 'LTD-PUB'),
(43, 'Ger.'),
(44, 'SCS'),
(51, 'ULTD-PR'),
(52, 'ULTD-PU'),
(55, 'Af.pers'),
(56, 'BURADM'),
(57, 'AGENCE'),
(61, 'Filiale'),
(62, 'Et.u.p.'),
(63, 'Regie'),
(64, 'Ca.Spe'),
(65, 'Admin.'),
(66, 'Co.ter.'),
(67, 'AUTRE'),
(68, 'Fond.'),
(99, 'Non R.'),
(12, 'S.a.s.'),
(14, 'SA DCS'),
(15, 'SARLAU'),
(17, 'SCP');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_dirigeant`
--

INSERT INTO `lien_dirigeant` (`code_personne`, `code_firme`, `code_fonction`, `email`, `tel_1`, `tel_2`, `fax`) VALUES
('MA0014780', 'MA1599200', '1025', NULL, NULL, NULL, NULL),
('MA2169962', 'MA2116941', '114', NULL, NULL, NULL, NULL),
('MA2134404', 'MA2134932', '1180', NULL, NULL, NULL, NULL),
('MA2224025', 'MA2142928', '116', NULL, NULL, NULL, NULL),
('MA2150809', 'MA2150924', '115', NULL, NULL, NULL, NULL),
('MA2101998', 'MA2150924', '111', NULL, NULL, NULL, NULL),
('MA0013644', 'MA2154922', '1026', NULL, NULL, NULL, NULL),
('MA2162917', 'MA2162918', '1182', NULL, NULL, NULL, NULL),
('MA2203382', 'MA2170914', '1145', NULL, NULL, NULL, NULL),
('MA2199084', 'MA2198900', '1027', NULL, NULL, NULL, NULL),
('MA2199083', 'MA2198900', '1027', NULL, NULL, NULL, NULL),
('MA2212894', 'MA2212893', '1187', NULL, NULL, NULL, NULL),
('MA0010737', 'MA2138930', '1026', NULL, NULL, NULL, NULL),
('MA2123983', 'MA2106946', '1150', NULL, NULL, NULL, NULL),
('MA3017032', 'MA2106946', '1125', NULL, NULL, NULL, NULL),
('MA3030765', 'MA2128935', '1145', NULL, NULL, NULL, NULL),
('MA3062467', 'MA3062468', '1185', NULL, NULL, NULL, NULL),
('MA3070461', 'MA3070464', '1145', NULL, NULL, NULL, NULL),
('MA0014407', 'MA1399300', '1185', NULL, NULL, NULL, NULL),
('MA3078408', 'MA3076461', '9924', NULL, NULL, NULL, NULL),
('MA3082457', 'MA3082458', '1199', NULL, NULL, NULL, NULL),
('MA3083791', 'MA3034482', '1125', NULL, NULL, NULL, NULL),
('MA3065498', 'MA1999000', '115', NULL, NULL, NULL, NULL),
('MA3065499', 'MA1999000', '1125', NULL, NULL, NULL, NULL),
('MA3111256', 'MA3100449', '1022', NULL, NULL, NULL, NULL),
('MA3120437', 'MA3120439', '1187', NULL, NULL, NULL, NULL),
('MA3122051', 'MA3034482', '1199', NULL, NULL, NULL, NULL),
('MA3127374', 'MA3100449', '1145', NULL, NULL, NULL, NULL),
('MA3128431', 'MA3128435', '116', NULL, NULL, NULL, NULL),
('MA3134431', 'MA3134432', '114', NULL, NULL, NULL, NULL),
('MA0015830', 'MA3066466', '1186', NULL, NULL, NULL, NULL),
('MA3140393', 'MA2126936', '1145', NULL, NULL, NULL, NULL),
('MA3158419', 'MA3158420', '1187', NULL, NULL, NULL, NULL),
('MA3171523', 'MA2106946', '9922', NULL, NULL, NULL, NULL),
('MA3172351', 'MA1753123', '1145', NULL, NULL, NULL, NULL),
('MA3174411', 'MA3174412', '116', NULL, NULL, NULL, NULL),
('MA3196391', 'MA3110444', '111', NULL, NULL, NULL, NULL),
('MA3198937', 'MA3180409', '111', NULL, NULL, NULL, NULL),
('MA3204394', 'MA3204397', '1199', NULL, NULL, NULL, NULL),
('MA3207799', 'MA3150424', '116', NULL, NULL, NULL, NULL),
('MA3207801', 'MA3150424', '1810', NULL, NULL, NULL, NULL),
('MA3214391', 'MA3214392', '116', NULL, NULL, NULL, NULL),
('MA3218389', 'MA3218390', '1187', NULL, NULL, NULL, NULL),
('MA3240419', 'MA3184407', '1145', NULL, NULL, NULL, NULL),
('MA3259698', 'MA3182408', '1022', NULL, NULL, NULL, NULL),
('MA3259699', 'MA3182408', '2499', NULL, NULL, NULL, NULL),
('MA3266365', 'MA3266366', '1185', NULL, NULL, NULL, NULL),
('MA3269296', 'MA3268365', '116', NULL, NULL, NULL, NULL),
('MA3270363', 'MA3270364', '1145', NULL, NULL, NULL, NULL),
('MA2216890', 'MA2216891', '1180', NULL, NULL, NULL, NULL),
('MA3046475', 'MA3046476', '1180', NULL, NULL, NULL, NULL),
('MA3198760', 'MA3284357', '111', NULL, NULL, NULL, NULL),
('MA3285544', 'MA3272363', '1185', NULL, NULL, NULL, NULL),
('MA3289228', 'MA3002498', '1125', NULL, NULL, NULL, NULL),
('MA3293452', 'MA3162418', '114', NULL, NULL, NULL, NULL),
('MA3294351', 'MA3294352', '2205', NULL, NULL, NULL, NULL),
('MA3294652', 'MA3294352', '1145', NULL, NULL, NULL, NULL),
('MA3245349', 'MA1199400', '1125', NULL, NULL, NULL, NULL),
('MA3295819', 'MA1199400', '1210', NULL, NULL, NULL, NULL),
('MA3298833', 'MA3230384', '1145', NULL, NULL, NULL, NULL),
('MA3304346', 'MA3304347', '1180', NULL, NULL, NULL, NULL),
('MA3306345', 'MA3306346', '116', NULL, NULL, NULL, NULL),
('MA3307062', 'MA3240379', '116', NULL, NULL, NULL, NULL),
('MA3309116', 'MA3310344', '1183', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Contenu de la table `lien_email`
--

INSERT INTO `lien_email` (`code_firme`, `num_ordre`, `email`) VALUES
('MA3076461', 1, 'info@pronautique.com'),
('MA1999000', 1, 'richdor2003@yahoo.fr'),
('MA3066466', 1, 'fidujef@wanadoo.net.ma'),
('MA3100449', 1, 'info@is-force.ma'),
('MA3046476', 1, 'l.lazrak@wanadoo.ma'),
('MA2150924', 1, 'etselmaleh@menara.ma'),
('MA3148425', 1, 'd3realestate@century21.ma'),
('MA3140429', 1, 'immovinci@menara.ma'),
('MA2106946', 1, 'amcb@menara.ma'),
('MA3180409', 1, 'infos@festival-ecologie.com'),
('MA2216891', 1, 'kacemisaadia@hotmail.fr'),
('MA2162918', 1, 'architectes@bohsina.net'),
('MA3150424', 1, 'nblcreation@gmail.com'),
('MA3182408', 1, 'mustapha.bouzzit@maskem.com'),
('MA3212393', 1, 'atlasfitness@gmail.com'),
('MA3214392', 1, 'arbitcar@live.fr'),
('MA3222388', 1, 'simo-ingaren@hotmail.com'),
('MA3232383', 1, 'glamhamdi@cpm.co.ma'),
('MA2116941', 1, 'm.korifa@hotmail.fr'),
('MA3184407', 1, 'wafaa.fetouaki@bnpparisbas.com'),
('MA3268365', 1, 'wamahassan@hotmail.com'),
('MA3270364', 1, 'saoudi_labo@live.fr'),
('MA1599200', 1, 'dr-raisschir@hotmail.com'),
('MA3276361', 1, 'info@atmanilighting.com'),
('MA3162418', 1, 'darbabaristoranteitaliano@live.com'),
('MA3288355', 1, 'zone.techas@gmail.com'),
('MA3002498', 1, 'nadacomd@yahoo.fr'),
('MA2154922', 1, 'startiss.sarl87@yahoo.fr'),
('MA3294352', 1, 'info@amrenov.ma'),
('MA3294352', 2, 'amrenov01@gmail.com'),
('MA1199400', 1, 'hamid.louarroudi@kunert.de'),
('MA3296351', 1, 'contact@alaqar.ma'),
('MA3210394', 1, 'jamilato_42@hotmail.com'),
('MA3284357', 1, 'contact@amai.ma'),
('MA3230384', 1, 'almarjane1@yahoo.fr'),
('MA3230384', 2, 'bendeq62@gmail.com'),
('MA3034482', 1, 'hotellixus1@hotmail.com'),
('MA3302348', 1, 'novamotion3d@gmail.com'),
('MA3264367', 1, 'tresorsduterroir1@gmail.com'),
('MA3306346', 1, 'para.oxygene@gmail.com'),
('MA3310344', 1, 'kinevalfleurytanger@gmail.com');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_fax`
--

INSERT INTO `lien_fax` (`code_firme`, `num_ordre`, `fax`) VALUES
('MA1199400', 1, '05 39 68 89 60'),
('MA1599200', 1, '05 35 65 42 98'),
('MA1753123', 1, '05 37 38 11 70'),
('MA2106946', 1, '05 22 33 48 94'),
('MA2150924', 1, '05 22 44 58 58'),
('MA2162918', 1, '05 22 91 53 34'),
('MA2198900', 1, '05 22 60 47 38'),
('MA3034482', 1, '05 36 33 00 32'),
('MA3066466', 1, '05 39 32 24 50'),
('MA2128935', 1, '05 22 61 39 26'),
('MA3076461', 1, '05 39 37 13 82'),
('MA3082458', 1, '05 35 94 25 18'),
('MA2210894', 1, '05 22 34 22 44'),
('MA3002498', 1, '05 37 77 99 66'),
('MA3100449', 1, '05 22 52 68 23'),
('MA1999000', 1, '05 24 49 76 44'),
('MA3046476', 1, '05 39 93 86 13'),
('MA3128435', 1, '05 39 96 31 07'),
('MA3140429', 1, '05 24 42 05 37'),
('MA3120439', 1, '05 28 22 27 84'),
('MA3148425', 1, '05 39 94 69 37'),
('MA2154922', 1, '05 22 31 30 86'),
('MA3070464', 1, '05 36 70 75 57'),
('MA3180409', 1, '05 22 99 45 43'),
('MA1399300', 1, '05 22 24 23 83'),
('MA3158420', 1, '05 22 22 20 61'),
('MA3184407', 1, '05 22 89 68 21'),
('MA3198400', 1, '05 24 66 77 27'),
('MA3182408', 1, '05 22 67 22 88'),
('MA3150424', 1, '05 22 97 26 30'),
('MA3214392', 1, '05 39 37 14 49'),
('MA3216391', 1, '05 22 32 52 01'),
('MA3218390', 1, '05 28 23 64 61'),
('MA3226386', 1, '05 24 62 73 10'),
('MA3230384', 1, '05 23 56 35 71'),
('MA3232383', 1, '05 37 84 95 80'),
('MA3242378', 1, '05 22 54 35 86'),
('MA3264367', 1, '05 35 94 11 12'),
('MA3268365', 1, '05 22 44 94 56'),
('MA3246376', 1, '05 38 90 18 33'),
('MA3280359', 1, '05 22 44 75 53'),
('MA2134932', 1, '05 24 44 71 01'),
('MA2134932', 2, '05 24 42 04 9');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_marque`
--

INSERT INTO `lien_marque` (`code_marque`, `code_firme`) VALUES
('0021674', 'MA1199400'),
('0020185', 'MA1199400'),
('0017062', 'MA2138930'),
('0018392', 'MA2138930'),
('0022509', 'MA2138930');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_portable`
--

INSERT INTO `lien_portable` (`code_firme`, `num_ordre`, `portable`) VALUES
('MA3102448', 1, '06 68 72 50 15'),
('MA3110444', 1, '06 65 31 25 67'),
('MA2134932', 1, '06 61 16 36 02'),
('MA2142928', 1, '06 72 93 45 36'),
('MA3128435', 1, '06 61 55 46 87'),
('MA3132433', 1, '06 61 66 96 48'),
('MA3134432', 1, '06 61 38 10 17'),
('MA2126936', 1, '06 66 32 89 99'),
('MA2116941', 1, '06 61 19 41 16'),
('MA3204397', 1, '06 61 38 46 79'),
('MA3174412', 1, '06 75 48 20 39'),
('MA3214392', 1, '06 76 56 75 66'),
('MA3216391', 1, '06 54 93 07 76'),
('MA3224387', 1, '06 76 30 18 07'),
('MA3224387', 2, '06 26 40 08 43'),
('MA2212893', 1, '06 61 16 23 80'),
('MA3238380', 1, '06 68 66 73 93'),
('MA3248375', 1, '06 68 42 24 28'),
('MA3248375', 2, '06 67 23 18 27'),
('MA3264367', 1, '06 75 44 30 16'),
('MA3192403', 1, '06 66 61 83 24'),
('MA3126436', 1, '06 61 38 04 76'),
('MA3280359', 1, '06 61 08 15 86'),
('MA3292353', 1, '06 36 93 20 02'),
('MA3292353', 2, '06 11 88 03 83'),
('MA3270364', 1, '06 76 03 05 85'),
('MA3270364', 2, '06 68 73 11 24'),
('MA3304347', 1, '06 61 40 66 76'),
('MA3306346', 1, '06 20 14 19 68'),
('MA3310344', 1, '06 72 08 80 81');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_produits_kompass`
--

INSERT INTO `lien_produits_kompass` (`code_firme`, `code_produit`, `export`, `import`, `fda`) VALUES
('MA1199400', '2348010', 'E', NULL, 'F'),
('MA1199400', '2348003', 'E', NULL, 'F'),
('MA1199400', '2348006', 'E', NULL, 'F'),
('MA1199400', '2348014', 'E', NULL, 'F'),
('MA1199400', '2348011', 'E', NULL, 'F'),
('MA1199400', '2348012', 'E', NULL, 'F'),
('MA1199400', '2348016', 'E', NULL, 'F'),
('MA1199400', '2348017', 'E', NULL, 'F'),
('MA1399300', '3175050', '', NULL, 'D'),
('MA1599200', '8730017', '', NULL, 'D'),
('MA1753123', '8712040', '', NULL, 'A'),
('MA1753123', '8620001', '', NULL, 'A'),
('MA1999000', '2680024', '', NULL, 'F'),
('MA2106946', '3327055', '', NULL, 'F'),
('MA2106946', '3327036', '', NULL, 'F'),
('MA2106946', '5210004', '', NULL, 'F'),
('MA2106946', '3327055', '', NULL, 'F'),
('MA2106946', '3327036', '', NULL, 'F'),
('MA2106946', '5210004', '', NULL, 'F'),
('MA2116941', '8540025', '', NULL, 'A'),
('MA2118940', '6464018', '', NULL, 'D'),
('MA2126936', '8640001', '', NULL, 'D'),
('MA2128935', '6610020', '', NULL, 'D'),
('MA2134932', '8731016', '', NULL, 'A'),
('MA2138930', '3943003', '', NULL, 'F'),
('MA2138930', '3511043', '', NULL, 'F'),
('MA2138930', '3546030', '', NULL, 'F'),
('MA2138930', '3936016', '', NULL, 'F'),
('MA2138930', '3943003', '', NULL, 'F'),
('MA2138930', '3511043', '', NULL, 'F'),
('MA2138930', '3546030', '', NULL, 'F'),
('MA2138930', '3936016', '', NULL, 'F'),
('MA2142928', '6330006', '', NULL, 'D'),
('MA2150924', '6690002', '', NULL, 'D'),
('MA2150924', '3256055', '', NULL, 'D'),
('MA2154922', '6320010', '', NULL, 'D'),
('MA2154922', '6320013', '', NULL, 'D'),
('MA2154922', '2326028', '', NULL, 'D'),
('MA2154922', '2354033', '', NULL, 'D'),
('MA2154922', '2326019', '', NULL, 'D'),
('MA2154922', '2326021', '', NULL, 'D'),
('MA2154922', '2490017', '', NULL, 'D'),
('MA2162918', '8501001', '', NULL, 'A'),
('MA3268365', '5224011', '', NULL, 'A'),
('MA3268365', '6780043', '', NULL, 'A'),
('MA2170914', '6430008', '', NULL, 'D'),
('MA2198900', '9999901', '', NULL, ''),
('MA2212893', '8050010', '', NULL, 'A'),
('MA2216891', '8730030', '', NULL, 'A'),
('MA2226886', '7910007', '', NULL, 'A'),
('MA2210894', '2760018', '', NULL, 'F'),
('MA2210894', '2784014', '', NULL, 'F'),
('MA3034482', '6910015', '', NULL, 'D'),
('MA3046476', '8730030', '', NULL, 'A'),
('MA3062468', '3175050', '', NULL, 'D'),
('MA3070464', '8275201', '', NULL, 'A'),
('MA3076461', '3905012', '', NULL, 'D'),
('MA3076461', '4990016', '', NULL, 'D'),
('MA3076461', '3905033', '', NULL, 'D'),
('MA3080459', '2454001', '', NULL, 'D'),
('MA3080459', '2454018', '', NULL, 'D'),
('MA3082458', '3837040', '', NULL, 'D'),
('MA1199400', '2348001', '', NULL, 'F'),
('MA3090454', '6780010', '', NULL, 'D'),
('MA3100449', '8620055', '', NULL, 'A'),
('MA3102448', '3546019', '', NULL, 'F'),
('MA3106446', '8712030', '', NULL, 'A'),
('MA3106446', '5610006', '', NULL, 'A'),
('MA3106446', '5620006', '', NULL, 'A'),
('MA3066466', '8030010', '', NULL, 'A'),
('MA3066466', '8062001', '', NULL, 'A'),
('MA3120439', '8050010', '', NULL, 'A'),
('MA3126436', '6922050', '', NULL, 'D'),
('MA3128435', '6650020', '', NULL, 'D'),
('MA3132433', '6922040', '', NULL, 'D'),
('MA2170914', '6430010', '', NULL, 'D'),
('MA3134432', '8640001', '', NULL, 'A'),
('MA3140429', '8082015', '', NULL, 'A'),
('MA3148425', '8082015', '', NULL, 'D'),
('MA3148425', '8082038', '', NULL, 'D'),
('MA3150424', '2830018', '', NULL, 'F'),
('MA3158420', '8050010', '', NULL, 'A'),
('MA3172413', '3942005', '', NULL, 'F'),
('MA3174412', '3521007', '', NULL, 'F'),
('MA3174412', '3521013', '', NULL, 'F'),
('MA3180409', '8818001', '', NULL, 'A'),
('MA3184407', '8203003', '', NULL, 'A'),
('MA3188405', '8610003', '', NULL, 'A'),
('MA3192403', '6842020', '', NULL, 'D'),
('MA3182408', '3152001', '', NULL, 'D'),
('MA3110444', '8818001', '', NULL, 'A'),
('MA3198400', '8203003', '', NULL, 'A'),
('MA3200399', '3175050', '', NULL, 'D'),
('MA3204397', '8730035', '', NULL, 'A'),
('MA2128935', '2512007', '', NULL, 'D'),
('MA3206396', '2520003', '', NULL, 'F'),
('MA3210394', '8590020', '', NULL, 'A'),
('MA3212393', '6928011', '', NULL, 'D'),
('MA3214392', '7252018', '', NULL, 'A'),
('MA3216391', '2056004', '', NULL, 'D'),
('MA3238380', '3370029', '', NULL, 'F'),
('MA3240379', '3181003', '', NULL, 'D'),
('MA3242378', '6755053', '', NULL, 'D'),
('MA3246376', '8210010', '', NULL, ''),
('MA3230384', '8062001', '', NULL, 'A'),
('MA3232383', '8203003', '', NULL, ''),
('MA3232383', '8203040', '', NULL, ''),
('MA3232383', '8203301', '', NULL, ''),
('MA3232383', '8215001', '', NULL, ''),
('MA3222388', '6110001', '', NULL, ''),
('MA3224387', '2814030', '', NULL, ''),
('MA3226386', '8725020', '', NULL, ''),
('MA3218390', '8050010', '', NULL, ''),
('MA3250374', '8140005', '', NULL, 'A'),
('MA3182408', '2089055', '', NULL, 'D'),
('MA3182408', '6750049', '', NULL, 'D'),
('MA3260369', '7910005', '', NULL, 'A'),
('MA3266366', '3175050', '', NULL, 'D'),
('MA3264367', '6260028', '', NULL, 'D'),
('MA3270364', '3897501', '', NULL, 'D'),
('MA3272363', '3175050', '', NULL, 'D'),
('MA3276361', '3734023', '', NULL, 'F'),
('MA3276361', '3734033', '', NULL, 'F'),
('MA3162418', '6922025', '', NULL, 'D'),
('MA3280359', '8060005', '', NULL, 'A'),
('MA3284357', '8812001', '', NULL, 'A'),
('MA3288355', '3757050', '', NULL, 'D'),
('MA3288355', '6786027', '', NULL, 'D'),
('MA3002498', '8626005', '', NULL, 'A'),
('MA3290354', '6570024', '', NULL, 'D'),
('MA3228385', '7915001', '', NULL, 'A'),
('MA3248375', '6330023', '', NULL, 'D'),
('MA3292353', '7252018', '', NULL, 'A'),
('MA3294352', '5210004', '', NULL, 'F'),
('MA3126436', '6922025', '', NULL, 'D'),
('MA3296351', '7910020', '', NULL, 'A'),
('MA3300349', '8832001', '', NULL, 'A'),
('MA3302348', '8120002', '', NULL, 'A'),
('MA3304347', '8731044', '', NULL, 'A'),
('MA3306346', '3171001', '', NULL, 'D'),
('MA3310344', '8730035', '', NULL, 'A');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_rubrique_telecontact`
--

INSERT INTO `lien_rubrique_telecontact` (`code_firme`, `code_rubrique`) VALUES
('MA1399300', '609240'),
('MA1753123', '319830'),
('MA2116941', '696250'),
('MA2116941', '760560'),
('MA2118940', '110440'),
('MA2118940', '290190'),
('MA2126936', '059760'),
('MA2128935', '092460'),
('MA2128935', '577870'),
('MA2134932', '518790'),
('MA2138930', '142320'),
('MA2142928', '820320'),
('MA2150924', '374410'),
('MA2154922', '774781'),
('MA2154922', '774830'),
('MA2162918', '038890'),
('MA2170914', '469050'),
('MA2198900', '090580'),
('MA2198900', '304000'),
('MA2198900', '523220'),
('MA2216891', '178850'),
('MA2226886', '764950'),
('MA2210894', '144500'),
('MA2210894', '144640'),
('MA2210894', '311930'),
('MA2210894', '582650'),
('MA3034482', '418440'),
('MA3046476', '178850'),
('MA1999000', '508820'),
('MA2212893', '064460'),
('MA2150924', '335360'),
('MA2106946', '079980'),
('MA2106946', '075650'),
('MA1599200', '199520'),
('MA1199400', '097341'),
('MA3062468', '609240'),
('MA3070464', '052840'),
('MA3076461', '075210'),
('MA3076461', '075100'),
('MA3076461', '595550'),
('MA1999000', '761740'),
('MA1999000', '474100'),
('MA3080459', '002700'),
('MA3082458', '563800'),
('MA3090454', '304020'),
('MA3100449', '319830'),
('MA3102448', '738460'),
('MA3106446', '292000'),
('MA3066466', '224190'),
('MA3066466', '223760'),
('MA3120439', '064460'),
('MA3066466', '345780'),
('MA3126436', '694200'),
('MA3128435', '509990'),
('MA3132433', '710210'),
('MA2170914', '579700'),
('MA3134432', '059760'),
('MA3140429', '426200'),
('MA3148425', '426200'),
('MA3150424', '429000'),
('MA3158420', '064460'),
('MA3172413', '388310'),
('MA3174412', '521370'),
('MA3174412', '832560'),
('MA3180409', '052540'),
('MA3184407', '071370'),
('MA3188405', '319890'),
('MA3192403', '061880'),
('MA3182408', '655780'),
('MA3110444', '052530'),
('MA3198400', '071370'),
('MA3200399', '609240'),
('MA3204397', '508400'),
('MA3206396', '521020'),
('MA3210394', '439750'),
('MA3212393', '256560'),
('MA3214392', '476450'),
('MA3216391', '086530'),
('MA3226386', '052480'),
('MA3218390', '064460'),
('MA3230384', '224190'),
('MA3224387', '405720'),
('MA3228385', '789600'),
('MA3222388', '427240'),
('MA3232383', '071370'),
('MA3238380', '152180'),
('MA3240379', '743680'),
('MA3242378', '456620'),
('MA3080459', '820400'),
('MA3246376', '246850'),
('MA3248375', '820970'),
('MA3250374', '612620'),
('MA3182408', '007120'),
('MA3260369', '563500'),
('MA3266366', '609240'),
('MA3264367', '656690'),
('MA3268365', '629620'),
('MA3270364', '663850'),
('MA3272363', '609240'),
('MA3276361', '011420'),
('MA3162418', '693930'),
('MA3280359', '215530'),
('MA3284357', '752750'),
('MA3288355', '432500'),
('MA3002498', '057800'),
('MA3290354', '741930'),
('MA3292353', '476450'),
('MA3294352', '075650'),
('MA3126436', '693930'),
('MA3296351', '813520'),
('MA3300349', '155840'),
('MA3302348', '666170'),
('MA3304347', '519730'),
('MA3306346', '585500'),
('MA3310344', '508400');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_telephone`
--

INSERT INTO `lien_telephone` (`code_firme`, `num_ordre`, `tel`) VALUES
('MA1399300', 1, '05 22 24 23 83'),
('MA1599200', 1, '05 35 62 11 08'),
('MA1599200', 2, '05 35 62 11 00'),
('MA1599200', 3, '05 35 65 02 06'),
('MA2106946', 1, '05 22 33 41 65'),
('MA2106946', 2, '05 22 33 41 63'),
('MA2106946', 3, '05 22 33 48 93'),
('MA2116941', 1, '05 22 23 15 73'),
('MA2118940', 1, '05 22 31 35 14'),
('MA2134932', 1, '05 24 44 71 01'),
('MA2150924', 1, '05 22 30 07 92'),
('MA2162918', 1, '05 22 91 53 17'),
('MA2198900', 1, '05 22 60 47 30'),
('MA2198900', 2, '05 22 60 47 35'),
('MA2226886', 1, '05 22 57 18 39'),
('MA3034482', 1, '05 36 60 61 09'),
('MA3034482', 2, '05 36 60 71 74'),
('MA3002498', 1, '05 37 68 25 50'),
('MA3046476', 1, '05 39 37 07 07'),
('MA1199400', 1, '05 39 68 89 88'),
('MA1199400', 2, '05 39 68 89 51'),
('MA1199400', 3, '05 39 98 89 21'),
('MA1999000', 1, '05 24 49 60 81'),
('MA2210894', 1, '05 22 31 10 39'),
('MA3062468', 1, '05 37 83 24 88'),
('MA3066466', 1, '05 39 32 20 82'),
('MA3066466', 2, '05 39 32 20 91'),
('MA3070464', 1, '05 36 69 67 55'),
('MA2128935', 1, '05 22 60 76 52'),
('MA2128935', 2, '05 22 61 43 46'),
('MA3076461', 1, '05 39 94 70 63'),
('MA3080459', 1, '05 22 50 09 39'),
('MA3082458', 1, '05 35 94 24 90'),
('MA3090454', 1, '05 28 23 11 33'),
('MA3126436', 1, '05 28 82 00 39'),
('MA3128435', 1, '05 39 96 31 06'),
('MA2154922', 1, '05 22 44 43 41'),
('MA3134432', 1, '05 24 40 97 13'),
('MA2126936', 1, '05 37 61 62 55'),
('MA3120439', 1, '05 28 22 27 42'),
('MA2138930', 1, '05 22 24 08 52'),
('MA3148425', 1, '05 39 32 06 03'),
('MA1753123', 1, '05 37 38 07 53'),
('MA1753123', 2, '05 37 38 19 01'),
('MA3158420', 1, '05 22 26 20 46'),
('MA3162418', 1, '05 24 47 68 09'),
('MA3172413', 1, '05 22 98 37 66'),
('MA3180409', 1, '05 22 94 71 44'),
('MA2170914', 1, '05 22 37 39 96'),
('MA3184407', 1, '05 22 91 80 20'),
('MA3184407', 2, '05 22 91 80 25'),
('MA3188405', 1, '05 22 33 97 11'),
('MA3198400', 1, '05 24 66 51 11'),
('MA3182408', 1, '05 22 35 41 43'),
('MA3182408', 2, '05 22 67 22 99'),
('MA3200399', 1, '05 37 90 96 63'),
('MA2216891', 1, '05 22 25 93 22'),
('MA3204397', 1, '05 22 93 51 52'),
('MA3206396', 1, '05 22 37 30 69'),
('MA3192403', 1, '05 34 52 64 46'),
('MA3212393', 1, '05 23 33 40 41'),
('MA3212393', 2, '05 27 54 51 56'),
('MA3214392', 1, '05 39 37 14 49'),
('MA3216391', 1, '05 22 32 52 00'),
('MA3218390', 1, '05 28 21 41 00'),
('MA3218390', 2, '05 28 23 64 61'),
('MA3106446', 1, '06 60 11 87 46'),
('MA3222388', 1, '06 62 54 87 33'),
('MA3226386', 1, '05 24 62 73 10'),
('MA3228385', 1, '05 22 20 14 08'),
('MA3230384', 1, '05 23 56 35 71'),
('MA3232383', 1, '05 37 84 95 79'),
('MA3100449', 1, '05 22 52 74 13'),
('MA3240379', 1, '05 37 55 62 81'),
('MA3242378', 1, '05 22 54 35 85'),
('MA3250374', 1, '05 24 47 53 24'),
('MA3150424', 1, '05 22 97 26 31'),
('MA3150424', 2, '05 22 97 22 32'),
('MA3264367', 1, '05 35 94 11 12'),
('MA3266366', 1, '05 28 53 64 72'),
('MA3268365', 1, '06 72 62 44 90'),
('MA3246376', 1, '08 02 00 20 40'),
('MA3246376', 2, '05 38 90 18 30'),
('MA3246376', 3, '05 38 90 18 31');

-- --------------------------------------------------------

--
-- Contenu de la table `lien_web`
--

INSERT INTO `lien_web` (`code_firme`, `num_ordre`, `web`) VALUES
('MA3100449', 1, 'www.is-force.ma'),
('MA3148425', 1, 'www.century21.ma'),
('MA3140429', 1, 'www.immovinci.com'),
('MA3180409', 1, 'www.festival-ecologie.com'),
('MA2162918', 1, 'www.bohsina.net'),
('MA3182408', 1, 'www.maskem.com'),
('MA3276361', 1, 'www.atmanilighting.com'),
('MA3002498', 1, 'www.nadacomdesign.com'),
('MA3294352', 1, 'www.amrenov.ma'),
('MA1199400', 1, 'www.kunert.de'),
('MA3210394', 1, 'www.esthetique.coiffure.free.fr'),
('MA3300349', 1, 'www.eurocham-maroc.com'),
('MA3264367', 1, 'www.tresorsduterroir.com');

-- --------------------------------------------------------

--
-- Contenu de la table `marque`
--

INSERT INTO `marque` (`code_marque`, `nom_marque`, `description`) VALUES
('0017062', 'C.e.a.', 'carrosserie'),
('0018392', 'Palkit', 'fourgons'),
('0020185', 'Kunert', 'confection '),
('0021674', 'Hudson', 'confection '),
('0022509', 'Ellamp iberica', 'carrosserie');

-- --------------------------------------------------------

--
-- Contenu de la table `natures`
--

INSERT INTO `natures` (`code`, `nature`) VALUES
('A', 'Usine'),
('B', 'Chantier'),
('C', 'Atelier'),
('D', 'Magasin de vente'),
('G', 'Commerce avec enseigne'),
('H', 'Commerce de gros et demi'),
('J', 'Administr. publique'),
('M', 'Bureau'),
('N', 'Entrepôt'),
('P', 'Exploitation agricole'),
('Q', 'Profession Liberale'),
('S', 'Autres'),
('U', 'Succursale'),
('X', 'Artisan (couturier, ...)'),
('Z', 'Adresse privee'),
('T', 'service a la collectivite'),
('I', 'Commerce de quartier'),
('A', 'Usine'),
('B', 'Chantier'),
('C', 'Atelier'),
('D', 'Magasin de vente'),
('G', 'Commerce avec enseigne'),
('H', 'Commerce de gros et demi'),
('J', 'Administr. publique'),
('M', 'Bureau'),
('N', 'Entrepôt'),
('P', 'Exploitation agricole'),
('Q', 'Profession Liberale'),
('S', 'Autres'),
('U', 'Succursale'),
('X', 'Artisan (couturier, ...)'),
('Z', 'Adresse privee'),
('T', 'service a la collectivite'),
('I', 'Commerce de quartier');

-- --------------------------------------------------------

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`code_personne`, `sex`, `civilite`, `nom`, `prenom`) VALUES
('MA0010737', 'M', '1', 'Elabbassy', 'Abdellatif'),
('MA0013644', 'M', '1', 'Benmoussa', 'Abderrahman'),
('MA0014407', 'M', '4', 'Bennani Kabchi', 'Abdelali'),
('MA0014780', 'M', '4', 'Raiss', 'Mohammed'),
('MA0015830', 'M', '1', 'Azancot', 'Abraham'),
('MA2101998', 'M', '1', 'Elmaleh', 'David'),
('MA2123983', 'M', '1', 'Machkour', 'Mohamed'),
('MA2134404', 'M', '4', 'Nordine', 'Abbas'),
('MA2150809', 'M', '1', 'Elmaleh', 'Jacob'),
('MA2162917', 'M', '1', 'Bohsina', 'Khalid'),
('MA2169962', 'M', '1', 'Korifa', 'Mohamed'),
('MA2199083', 'M', '1', 'Zaikane', 'Saïd'),
('MA2199084', 'M', '1', 'Sorhmat', 'Abdellatif'),
('MA2203382', 'M', '1', 'Arroubi', 'Redouane'),
('MA2212894', 'M', '53', 'Ben Essaidi', 'Mohamed'),
('MA2216890', 'F', '4', 'Kacemi', 'Saadia'),
('MA2224025', 'M', '1', 'Elbakkali', 'Abdeslam'),
('MA3017032', 'M', '1', 'Machkour', 'Lahcen'),
('MA3030765', 'M', '1', 'Bouazzaoui', 'Mounir'),
('MA3046475', 'M', '4', 'Lazrak', 'Lotfi'),
('MA3062467', 'F', '4', 'Dahabi', 'Lamyaa'),
('MA3065498', 'M', '51', 'Berrada', 'Abdessalam'),
('MA3065499', 'M', '1', 'Berrada', 'Said'),
('MA3070461', 'M', '1', 'Chouraki', 'Rabie'),
('MA3078408', 'M', '1', 'Fadli', 'Ahmed'),
('MA3082457', 'F', '2', 'Bensaïd', 'Kaoutar'),
('MA3083791', 'M', '1', 'Azmani', 'Mustapha'),
('MA3111256', 'M', '1', 'Kabbaj', 'Mohammed Mouslime'),
('MA3120437', 'M', '53', 'Yakhlef', 'Mustapha'),
('MA3122051', 'M', '1', 'Azmani', 'Mohamed'),
('MA3127374', 'F', '2', 'Laghzaoui', 'Zineb'),
('MA3128431', 'M', '1', 'Chtoun', 'ElMustapha'),
('MA3134431', 'M', '1', 'ElIdrissi', 'Mbarek'),
('MA3140393', 'M', '1', 'Erkik', 'Zakaria'),
('MA3158419', 'F', '53', 'Smir', 'Saadia'),
('MA3171523', 'M', '1', 'Machkour', 'Redouane'),
('MA3172351', 'M', '1', 'ElMouden', 'Driss'),
('MA3174411', 'M', '1', 'Sadik', 'Anas'),
('MA3196391', 'M', '1', 'Bachar', 'Mohammed'),
('MA3198760', 'M', '1', 'Lahlou', 'Mohamed'),
('MA3198937', 'M', '1', 'Zniber', 'Moundir'),
('MA3204394', 'F', '2', 'Benrahal', 'Houda'),
('MA3207799', 'M', '1', 'Fridji', 'Adil'),
('MA3207801', 'F', '2', 'Taleb', 'Mounia'),
('MA3214391', 'M', '1', 'Khamal Arbit', 'Brahim'),
('MA3218389', 'M', '53', 'ElKanfoud', 'Abdelaziz'),
('MA3240419', 'M', '1', 'Elhamdouni', 'Othmane'),
('MA3245349', 'M', '1', 'Louarroudi', 'Hamid'),
('MA3259698', 'M', '1', 'Khawa', 'Brahim'),
('MA3259699', 'M', '1', 'ElHajjaji', 'Ahmed'),
('MA3266365', 'F', '4', 'Ivanko', 'Oksana'),
('MA3269296', 'M', '1', 'Mhaned', 'Hammou'),
('MA3270363', 'M', '1', 'Saoudi', 'Mohammed'),
('MA3285544', 'M', '4', 'Falah', 'Youssef'),
('MA3289228', 'M', '1', 'ElMeftahi', 'Abdesslem'),
('MA3293452', 'M', '1', 'Bedjartine', 'Jean Francois'),
('MA3294351', 'M', '1', 'El Moussafir', 'Mehdi'),
('MA3294652', 'M', '1', 'Amor', 'Jad'),
('MA3295819', 'F', '2', 'Ait Beh Ouali', 'Sanaa'),
('MA3298833', 'M', '1', 'Bendeq', 'Abdesslam'),
('MA3304346', 'M', '4', 'Bensalah', 'Noureddine'),
('MA3306345', 'M', '1', 'Jamali', 'Sabah'),
('MA3307062', 'M', '1', 'Hachimi', 'Abderazak');

-- --------------------------------------------------------

--
-- Contenu de la table `produits_kompass`
--

INSERT INTO `produits_kompass` (`code_produit`, `lib_produit`) VALUES
('2056004', 'Biscuits, gaufrettes'),
('2089055', 'Additifs divers pour l`industrie alimentaires, non denommes'),
('2326019', 'tissus de coton velours pour ameublement, en coton'),
('2326021', 'tissus de coton d`ameublement'),
('2326028', 'tissus de coton jacquard pour ameublement'),
('2348001', 'bas!et articles chaussants, en general'),
('2348003', 'chaussons pour bebes'),
('2348006', 'bas!circulaires (sans couture)'),
('2348010', 'bas!, collants'),
('2348011', 'collants de danse'),
('2348012', 'chaussettes,mi-bas, socquettes pour dames et fillettes'),
('2348014', 'chaussettes, mi-bas, socquettes pour hommes et garçonnets'),
('2348016', 'protege-bas'),
('2348017', 'bas!en dentelles'),
('2354033', 'passementerie d`ameublement.'),
('2454001', 'Foulards, cravates, echarpes, pochettes'),
('2454018', 'echarpes, chales, fichus'),
('2490017', 'rideaux etvoilages'),
('2512007', 'bois contre.plaques'),
('2520003', 'menuiserie bois, de batiment (entreprises de)'),
('2680024', 'matelas etcoussins a ressorts'),
('2760018', 'cartons divers'),
('2784014', 'boites, caisses en carton ondule'),
('2814030', 'gravures mecaniques (travaux de)'),
('2830018', 'impression numerique'),
('3152001', 'produits chimiques pour parfumerie, cosmetiques, savonnerie'),
('3171001', 'produitspara-pharmaceutiques et para-medicaux'),
('3175050', 'pharmacies'),
('3181003', 'stations-services autos'),
('3256055', 'etancheite: produits non denommes'),
('3327036', 'tuyaux en beton, sans pression, buses'),
('3327055', 'beton: elements de construction divers, non denommes'),
('3370029', 'poteries artistiques, ceramiques artisanales'),
('3511043', 'charpente metallique legere (entreprises de)'),
('3521007', 'menuiserie aluminium (entreprises)'),
('3521013', 'fermetures roulantes metalliques'),
('3546019', 'soudage, mecano-soudage des metaux (travaux de)'),
('3546030', 'chaudronnerie moyenne en fer ou acier (entreprises de)'),
('3734023', 'enseignes lumineuses'),
('3734033', 'affichage electronique, journaux lumineux'),
('3757050', 'informatique: fournitures, accessoires non denommes'),
('3837040', 'optique generale (etudes et realisation d`)'),
('3897501', 'laboratoires dentaires, protheses'),
('3905012', 'bateaux de plaisance'),
('3905033', 'planches de surf,planches a voile, etc..'),
('3936016', 'remorques et semi-remorques routieres'),
('3942005', 'ateliers de reparation pour automobiles'),
('3943003', 'carrossiers pourcamions etautocars'),
('4990016', 'sports aquatiques et subaquatiques (materiel de)'),
('5210004', 'batiment (entreprises - de 50 ouvriers)'),
('5224011', 'plomberie (entreprises de)'),
('5610006', 'electricite (regies de distribution d`)'),
('5620006', 'eau (regies de distribution d`)'),
('6110001', 'import-export, negoce international en general'),
('6260028', 'produits de/regime, dietetique (detaillants)'),
('6320010', 'tissus'),
('6320013', 'tissus d`ameublement (detaillants)'),
('6330006', 'vetements de cuir (detaillants)'),
('6330023', 'confection orientale (detaillants)'),
('6430008', 'librairies-papeteries (detail)'),
('6430010', 'papeteries (magasins detaillant)'),
('6464018', 'drogueries (detail)'),
('6570024', 'sports: detaillants d`articles de'),
('6610020', 'bois (1/2 gros, detail)'),
('6650020', 'materiaux de construction (detail)'),
('6690002', 'fournitures industrielles'),
('6750049', 'materiel pour l`industrie/pharmaceutique, les parfums et les cosmetiques'),
('6755053', 'equipements et produits pour/laboratoires'),
('6780010', 'electricite (magasins detaillant)'),
('6780043', 'energies renouvelables'),
('6786027', 'materiel pour la/bureautique et l` informatique (peripheriques...)'),
('6842020', 'pieces automobiles (detail)'),
('6910015', 'hôtels 3 etoiles'),
('6922025', 'restaurants: cuisine italienne'),
('6922040', 'cremeries, glaciers, salons de the'),
('6922050', 'restaurants pizzerias'),
('6928011', 'fitness clubs, salles degymnastique'),
('7252018', 'location de voitures de tourisme (services de)'),
('7910005', 'telecommunications: services, centres d`exploitation de reseaux'),
('7910007', 'teleboutiques, kiosques (exploitation de)'),
('7910020', 'Internet (services)'),
('7915001', 'messagerie, services postaux prives'),
('8030010', 'gestion, direction, organisation (conseils en)'),
('8050010', 'avocats'),
('8060005', 'comptabilite (services de gestion de)'),
('8062001', 'conseils fiscaux, financiers et juridiques'),
('8082015', 'agences immobilieres'),
('8082038', 'conseils immobiliers et fonciers'),
('8120002', 'publicite: agences a service complet'),
('8140005', 'photographie (laboratoires de developpement)'),
('8203003', 'banques de depôts'),
('8203040', 'banques de credit'),
('8203301', 'banques d`investissement'),
('8210010', 'credit menager (financement de)'),
('8215001', 'banques etrangeres (bureaux de representation de)'),
('8275201', 'agents d` /assurances'),
('8501001', 'architectes'),
('8540025', 'nettoyage de moquettes, tapis a domicile (services de)'),
('8590020', 'centres d` esthetique'),
('8610003', 'ecoles primaires et secondaires publiques'),
('8620001', 'centres deformation professionnelle publics'),
('8620055', 'formation professionnelle non denommee'),
('8626005', 'audiovisuel (methodes et formation)'),
('8640001', 'ecoles de conduite automobile'),
('8712030', 'entreprises d`etat a caractere commercial'),
('8712040', 'entreprises d`etat a caractere social ou culturel'),
('8725020', 'oeuvres sociales'),
('8730017', 'cliniques chirurgicales'),
('8730030', 'chirurgiens dentistes'),
('8730035', 'masseurs kinesitherapeutes'),
('8731016', 'medecins: chirurgie generale'),
('8731044', 'medecins: pneumologie'),
('8812001', 'associations professionnelles'),
('8818001', 'associations culturelles'),
('8832001', 'chambres de commerce etrangeres'),
('9999901', 'Voir produits lies aux marques');

-- --------------------------------------------------------

--
-- Contenu de la table `quartiers`
--

INSERT INTO `quartiers` (`code`, `quartier`) VALUES
(1, 'Aïn Borja      '),
(2, 'Aïn Chok       '),
(5, 'Oukacha        '),
(6, 'Ancienne Medina'),
(10, 'Belvedere      '),
(11, 'Benjdia        '),
(12, 'Bourgogne      '),
(15, 'Californie     '),
(16, 'Centre Ville   '),
(18, 'Derb Ghalef    '),
(20, 'Derb Omar      '),
(23, 'Gironde        '),
(25, 'Hay Hassani    '),
(26, 'Hay Mohammadi  '),
(31, 'Inara          '),
(34, 'Maarif         '),
(36, 'Mers Sultan    '),
(40, 'Oulfa          '),
(46, 'Roches noires  '),
(47, 'Sbata          '),
(50, 'Sidi Moumen    '),
(53, 'Sidi Othman    '),
(67, 'Sidi Belyout   '),
(68, 'Sidi Maarouf');

-- --------------------------------------------------------

--
-- Contenu de la table `rubriques`
--

INSERT INTO `rubriques` (`Code_Rubrique`, `Lib_Rubrique`) VALUES
('002700', 'Accessoires de mode'),
('007120', 'Alimentation: additifs, arômes, levures (fabrication)'),
('011420', 'Affichage electronique, journaux lumineux'),
('038890', 'Architectes et agrees en architecture'),
('052480', 'Associations humanitaires, entraide et prevoyance sociale'),
('052530', 'Associations, organismes culturels et socio-educatifs'),
('052540', 'Associations pour la protection de l`environnement'),
('052840', 'Assurance (agents generaux d`)'),
('057800', 'Audiovisuel (production, realisation)'),
('059760', 'Auto-ecole'),
('061880', 'Automobiles (pieces au detail)'),
('064460', 'Avocats'),
('071370', 'Banques'),
('075100', 'Bateaux de plaisance (vente, reparation)'),
('075210', 'Bateaux de plaisance et planches a voile (materiel & fournitures)'),
('075650', 'Batiment (entreprises)'),
('079980', 'Beton (produits en)'),
('086530', 'Biscuiterie (fabrication, gros)'),
('090580', 'Bobinage pour materiel electrique'),
('092460', 'Bois (detail)'),
('097341', 'Bonneterie (fabrication, gros)'),
('110440', 'Bricolage, outillage'),
('142320', 'Carrosserie et peinture automobile'),
('144500', 'Carton (façonnage)'),
('144640', 'Carton ondule'),
('152180', 'Ceramique et poterie artisanales'),
('155840', 'Chambres de commerce, d`industrie, de metiers et d`agriculture'),
('178850', 'Chirurgiens-dentistes'),
('199520', 'Cliniques chirurgicales'),
('215530', 'Comptabilite (gestion, travaux)'),
('223760', 'Conseils d`entreprises'),
('224190', 'Conseils juridiques et fiscaux'),
('246850', 'Credit a la consommation (etablissements)'),
('256560', 'Culture physique, fitness'),
('290190', 'Drogueries (detail)'),
('292000', 'Eau, electricite (production, distribution)'),
('304000', 'Electricite (materiel et fournitures en gros)'),
('304020', 'Electricite (detail)'),
('311930', 'Emballages, conditionnements (carton, papier)'),
('319830', 'Enseignement professionnel: divers'),
('319890', 'Ecoles et colleges publics'),
('335360', 'Etancheite (produits)'),
('345780', 'Experts comptables'),
('374410', 'Fournitures et materiel industriels'),
('388310', 'Garages d`automobiles (mecanique, reparation)'),
('405720', 'Gravure mecanique'),
('418440', 'Hôtels (1,2,3 etoiles)'),
('426200', 'Agences Immobilieres'),
('427240', 'Import-export'),
('429000', 'Imprimeurs en numerique'),
('432500', 'Informatique (materiel, consommables)'),
('439750', 'Instituts de beaute'),
('456620', 'Laboratoires (appareils, materiel, fournitures)'),
('469050', 'Librairies, papeteries'),
('474100', 'Literie et divans (commerce)'),
('476450', 'Location d`automobiles (tourisme, utilitaires)'),
('508400', 'Kinesitherapeutes, masseurs medicaux'),
('508820', 'Matelas'),
('509990', 'Materiaux de construction (distribution, detail)'),
('518790', 'Medecins : Chirurgie'),
('519730', 'Medecins : Pneumologie'),
('521020', 'Menuiserie bois (entreprises)'),
('521370', 'Menuiserie metallique'),
('523220', 'Mesure, contrôle et regulation (appareils)'),
('563500', 'Telephonie: Operateurs'),
('563800', 'Opticiens'),
('577870', 'Panneaux contreplaques et agglomeres'),
('579700', 'Papeteries (detaillants)'),
('582650', 'Papiers (fabrication, gros)'),
('585500', 'Parapharmacie'),
('595550', 'Peche et chasse (detaillants)'),
('609240', 'Pharmacies'),
('612620', 'Photographie (developpement , tirage)'),
('629620', 'Plomberie (entreprises)'),
('655780', 'Produits chimiques'),
('656690', 'Produits dietetiques, biologiques , naturels (detail)'),
('663850', 'Prothesistes dentaires'),
('666170', 'Publicite (agences et conseils)'),
('693930', 'Restaurants (cuisine italienne)'),
('694200', 'Pizzerias'),
('696250', 'Revetements de sols et murs (pose)'),
('710210', 'Salons de the, cremeries, glaciers'),
('738460', 'Soudure (travaux)'),
('741930', 'Sport: articles et vetements (detail)'),
('743680', 'Stations-service (carburants)'),
('752750', 'Syndicats et ordres professionnels'),
('760560', 'Tapis (nettoyage de)'),
('761740', 'Tapissiers et tapissiers-decorateurs'),
('764950', 'Teleboutiques'),
('774781', 'Tissus et files (grossistes)'),
('774830', 'Tissus d`ameublement'),
('789600', 'Transfert d`argent'),
('813520', 'Vente en ligne et par correspondance'),
('820320', 'Vetements de cuir et de peau (detail)'),
('820400', 'Pret a porter feminin (boutiques)'),
('820970', 'Vetements traditionnels (artisans, detaillants)'),
('832560', 'Volets roulants');

-- --------------------------------------------------------

--
-- Contenu de la table `statuts`
--

INSERT INTO `statuts` (`code`, `status`) VALUES
('A', 'entreprise sans succursale'),
('B', 'entreprise avec succursales'),
('C', 'succursale sans initiative'),
('D', 'succursale avec initiative'),
('E', 'personne physique');

-- --------------------------------------------------------

--
-- Contenu de la table `villes`
--

INSERT INTO `villes` (`code`, `ville`) VALUES
(41110, 'Agadir'),
(42012, 'Inezgane'),
(43010, 'Taroudant'),
(71010, 'Marrakech'),
(75010, 'Essaouira'),
(77010, 'Safi'),
(82010, 'Nador'),
(83010, 'Oujda'),
(91110, 'Casablanca'),
(91210, 'Casablanca'),
(91410, 'Casablanca'),
(91413, 'Bouskoura'),
(91416, 'Casablanca'),
(91510, 'Casablanca'),
(91610, 'Casablanca'),
(91710, 'Casablanca'),
(92110, 'Casablanca'),
(92210, 'Casablanca'),
(93015, 'Beni Yakhlef'),
(95012, 'Berrechid'),
(95013, 'El Gara'),
(96014, 'Oulad Frej'),
(101010, 'Rabat'),
(102010, 'Sale'),
(103011, 'Temara'),
(104010, 'Khemisset'),
(105010, 'Kenitra'),
(106010, 'Sidi Kacem'),
(122010, 'Beni Mellal'),
(125010, 'Khouribga'),
(141010, 'Fes'),
(149010, 'Taza'),
(162011, 'Ksar El Kebir'),
(163010, 'Tanger'),
(164010, 'Tetouan');

INSERT INTO `bon_commande`(code_firme,societe,num_bc,num_facture,edition,support,courtier,date_bc,mt_ttc,reglem_ttc) values 
('MA1199400','1','41150','25119','13','2','106','20041207','1800','1800'),
('MA1199400','1','41620','55714','14','2','106','20051208','1800','1800'),
('MA1199400','1','41748','60482','15','2','106','20061219','1800','1800'),
('MA1999000','5','15476','10853','10','1','133','20030428','3480','3480'),
('MA1999000','5','16633','11770','11','1','133','20040518','3600','3600'),
('MA2106946','1','6741','4774','13','1','132','19910612','4760','4760'),
('MA2106946','1','6741','6198','13','1','132','19910612','4760','4760'),
('MA2106946','1','7806','6446','14','1','132','19921214','5712','5712'),
('MA2106946','1','46228','67569','1','5','991','20080507','1000','1000'),
('MA2106946','1','79444','58190','1','5','991','20060628','1000','1000'),
('MA2106946','1','79832','61787','1','5','991','20070425','1000','1000'),
('MA2106946','3','95065','68176','19','1','991','20080612','3060','3060'),
('MA2116941','3','40484','3637','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3638','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3639','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3640','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3641','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3642','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3643','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3644','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3645','6','1','602','19950309','4046','4046'),
('MA2116941','3','40484','3646','6','1','602','19950309','4046','4046'),
('MA2116941','3','117595','84825','22','1','352','20110516','480','480'),
('MA2116941','3','127025','94601','23','1','325','20120803','2040',''),
('MA2138930','1','7416','6001','14','1','133','19921005','11424','11424'),
('MA2154922','1','113541','15013','6','2','15','19970730','14400','14400'),
('MA2154922','3','50077','26731','9','1','584','19980212','6480','6480'),
('MA2154922','3','55635','34970','10','1','106','19990601','9960','9960'),
('MA2198900','3','48509','24265','8','1','730','19970624','3240','3240'),
('MA2198900','3','48509','24266','8','1','730','19970624','3240','3240'),
('MA2198900','3','48509','24267','8','1','730','19970624','3240','3240'),
('MA2198900','3','48509','24268','8','1','730','19970624','3240','3240'),
('MA2198900','3','52503','30390','9','1','730','19980710','3480','3480'),
('MA2210894','3','52034','28735','9','1','562','19980624','7560','7560'),
('MA2210894','3','53214','30921','10','1','562','19990305','7200','7200'),
('MA2210894','3','56400','36281','11','1','562','20000410','7920','7920'),
('MA2210894','3','60410','40543','12','1','562','20010330','7920','7920'),
('MA2210894','3','66510','43973','13','1','562','20020520','9000','9000'),
('MA2210894','3','68906','46049','14','1','562','20030313','9000','9000'),
('MA2210894','5','14972','10952','10','1','562','20030606','3480','3480'),
('MA3076461','5','14359','10992','10','1','70','20030530','2400','2400'),
('MA3180409','10','2661','72419','1','9','61','20090226','8956.8','8956.8'),
('MA3230384','3','144121','109362','26','1','397','20151030','1920','1920'),
('MA3264367','3','127799','96811','24','2','320','20130624','1800','1800'),
('MA3264367','3','127800','97319','24','1','320','20130726','1400','1400');

INSERT INTO evenement (code_firme,service,societe,edition,support,courtier,date_evennement,resultat,date_resultat,remarques) VALUES
('MA1199400','Affectations','1','28','1','150','20110509','','',''),
('MA1199400','Affectations','1','29','1','975','20121113','','',''),
('MA1199400','Affectations','3','24','1','997','20131205','','',''),
('MA1599200','Affectations','3','25','1','310','20140507','','',''),
('MA1599200','Affectations','3','23','1','320','20120719','','',''),
('MA1599200','Affectations','3','24','1','320','20131209','','',''),
('MA1599200','Affectations','3','27','1','997','20161121','','',''),
('MA1999000','Affectations','1','29','1','975','20121113','','',''),
('MA1999000','Affectations','3','24','1','363','20130826','','',''),
('MA2106946','Affectations','1','32','1','50','20150909','','',''),
('MA2106946','Affectations','1','33','1','76','20160527','','',''),
('MA2106946','Affectations','1','28','1','147','20110509','','',''),
('MA2106946','Affectations','1','29','1','156','20120702','','',''),
('MA2106946','Affectations','1','27','1','168','20100922','','',''),
('MA2106946','Affectations','1','30','1','168','20130927','','',''),
('MA2106946','Affectations','3','27','1','318','20161006','','',''),
('MA2106946','Affectations','3','20','1','660','20090225','L','20090519',''),
('MA2106946','Affectations','3','22','1','705','20101216','','',''),
('MA2106946','Affectations','3','25','1','705','20140806','','',''),
('MA2106946','Affectations','3','19','1','991','20080507','A','',''),
('MA2106946','Affectations','3','21','1','991','20101020','','',''),
('MA2116941','Affectations','3','23','1','325','20120702','','',''),
('MA2116941','Affectations','3','22','1','352','20110516','A','20110516',''),
('MA2116941','Affectations','3','24','1','870','20130917','L','20130926',''),
('MA2116941','Affectations','3','3','4','970','20100915','','',''),
('MA2118940','Affectations','3','23','1','370','20120719','','',''),
('MA2118940','Affectations','3','4','4','342','20111219','','',''),
('MA2126936','Affectations','3','23','1','380','20120530','','',''),
('MA2128935','Affectations','1','32','1','106','20150909','','',''),
('MA2128935','Affectations','1','33','1','106','20160527','','',''),
('MA2128935','Affectations','1','27','1','991','20101005','','',''),
('MA2128935','Affectations','3','22','1','222','20101216','','',''),
('MA2128935','Affectations','3','18','1','411','20061219','N','',''),
('MA2128935','Affectations','3','21','1','600','20100113','','',''),
('MA2138930','Affectations','1','30','1','50','20130731','','',''),
('MA2138930','Affectations','1','33','1','106','20160527','','',''),
('MA2138930','Affectations','1','32','1','145','20150909','','',''),
('MA2138930','Affectations','1','29','1','147','20120702','','',''),
('MA2138930','Affectations','1','31','1','168','20141017','','',''),
('MA2138930','Affectations','3','18','1','411','20061219','L','',''),
('MA2138930','Affectations','3','24','1','422','20131209','','',''),
('MA2138930','Affectations','3','21','1','788','20100120','','',''),
('MA2138930','Affectations','3','22','1','788','20101215','L','20110228',''),
('MA2150924','Affectations','1','27','1','168','20101206','','',''),
('MA2150924','Affectations','3','23','1','75','20120718','','',''),
('MA2150924','Affectations','3','24','1','75','20130916','','',''),
('MA2150924','Affectations','3','28','1','369','20170124','','',''),
('MA2150924','Affectations','3','21','1','427','20100113','','',''),
('MA2150924','Affectations','3','25','1','437','20141124','','',''),
('MA2150924','Affectations','3','27','1','732','20160610','','',''),
('MA2150924','Affectations','3','26','1','880','20150414','','',''),
('MA2150924','Affectations','3','25','1','997','20141120','','',''),
('MA2150924','Affectations','3','4','4','75','20111013','','',''),
('MA2150924','Affectations','3','3','4','732','20101006','','',''),
('MA2154922','Affectations','1','27','1','106','20100913','','',''),
('MA2154922','Affectations','1','27','1','106','20100920','','',''),
('MA2154922','Affectations','1','28','1','168','20111101','','',''),
('MA2154922','Affectations','3','18','1','165','20070507','','',''),
('MA2154922','Affectations','3','23','1','360','20120726','','',''),
('MA2154922','Affectations','3','21','1','655','20100602','','',''),
('MA2154922','Affectations','3','19','1','991','20080507','','',''),
('MA2170914','Affectations','3','22','1','870','20110316','','',''),
('MA3002498','Affectations','3','18','1','133','20061225','','',''),
('MA3002498','Affectations','3','24','1','218','20130909','','',''),
('MA3002498','Affectations','3','21','1','431','20100115','','',''),
('MA3002498','Affectations','3','22','1','431','20110620','','',''),
('MA3002498','Affectations','3','25','1','680','20140117','','',''),
('MA3002498','Affectations','3','20','1','830','20090313','L','20090313',''),
('MA3002498','Affectations','3','23','1','975','20121022','','',''),
('MA3002498','Affectations','3','2','6','997','20120424','','',''),
('MA3034482','Affectations','1','29','1','332','20121113','','',''),
('MA3034482','Affectations','3','23','1','335','20120705','','',''),
('MA3034482','Affectations','3','25','1','997','20140204','','',''),
('MA3066466','Affectations','3','23','1','994','20121022','','',''),
('MA3070464','Affectations','3','23','1','994','20121022','','',''),
('MA3070464','Affectations','3','24','1','997','20130902','','',''),
('MA3070464','Affectations','3','25','1','997','20140204','','',''),
('MA3076461','Affectations','1','27','1','991','20101115','','',''),
('MA3076461','Affectations','3','23','1','997','20120530','','',''),
('MA3080459','Affectations','3','18','1','562','20070404','','',''),
('MA3080459','Affectations','3','3','4','655','20100915','','',''),
('MA3082458','Affectations','3','24','1','25','20131220','','',''),
('MA3100449','Affectations','1','27','1','156','20101026','','',''),
('MA3100449','Affectations','3','18','1','705','20070405','','',''),
('MA3100449','Affectations','3','21','1','709','20100114','','',''),
('MA3100449','Affectations','3','20','1','788','20090312','','',''),
('MA3102448','Affectations','3','24','1','997','20131126','','',''),
('MA3128435','Affectations','3','23','1','997','20120530','','',''),
('MA3128435','Affectations','3','24','1','997','20131205','','',''),
('MA3132433','Affectations','3','22','1','427','20110322','','',''),
('MA3134432','Affectations','3','23','1','318','20120830','','',''),
('MA3134432','Affectations','3','24','1','997','20131025','','',''),
('MA3140429','Affectations','3','23','1','360','20121022','','',''),
('MA3140429','Affectations','3','26','1','765','20150106','','',''),
('MA3140429','Affectations','3','24','1','997','20130826','','',''),
('MA3148425','Affectations','3','23','1','360','20121022','','',''),
('MA3150424','Affectations','1','29','1','147','20120702','','',''),
('MA3150424','Affectations','1','28','1','168','20110509','','',''),
('MA3150424','Affectations','1','27','1','270','20101210','','',''),
('MA3150424','Affectations','3','27','1','376','20161021','','',''),
('MA3150424','Affectations','3','28','1','376','20170117','','',''),
('MA3150424','Affectations','3','19','1','436','20080507','','',''),
('MA3150424','Affectations','3','22','1','562','20110620','','',''),
('MA3150424','Affectations','3','18','1','626','20070416','S','',''),
('MA3150424','Affectations','3','24','1','655','20131113','','',''),
('MA3150424','Affectations','3','21','1','701','20100112','','',''),
('MA3150424','Affectations','3','23','1','788','20120718','','',''),
('MA3150424','Affectations','3','20','1','970','20081201','L','20090513',''),
('MA3162418','Affectations','3','24','1','333','20130826','','',''),
('MA3172413','Affectations','3','22','1','210','20101216','','',''),
('MA3172413','Affectations','3','23','1','385','20120726','','',''),
('MA3172413','Affectations','3','21','1','991','20100617','L','20100604',''),
('MA3172413','Affectations','3','24','1','997','20131008','','',''),
('MA3172413','Affectations','3','3','4','427','20101006','','',''),
('MA3174412','Affectations','1','27','1','76','20100909','','',''),
('MA3174412','Affectations','1','27','1','76','20100920','','',''),
('MA3174412','Affectations','3','24','1','325','20130516','','',''),
('MA3174412','Affectations','3','23','1','332','20120914','','',''),
('MA3174412','Affectations','3','27','1','441','20160601','','',''),
('MA3174412','Affectations','3','20','1','562','20090306','','',''),
('MA3174412','Affectations','3','21','1','870','20100301','','',''),
('MA3174412','Affectations','3','4','4','300','20111206','','',''),
('MA3180409','Affectations','3','24','1','342','20130411','','',''),
('MA3182408','Affectations','1','27','1','50','20100913','','',''),
('MA3182408','Affectations','1','27','1','50','20100920','','',''),
('MA3182408','Affectations','1','32','1','50','20150909','','',''),
('MA3182408','Affectations','1','31','1','145','20150310','','',''),
('MA3182408','Affectations','1','29','1','147','20121225','','',''),
('MA3182408','Affectations','1','33','1','168','20160527','','',''),
('MA3182408','Affectations','1','30','1','390','20130904','','',''),
('MA3182408','Affectations','3','21','1','434','20100113','','',''),
('MA3182408','Affectations','3','20','1','660','20090413','L','20090507',''),
('MA3182408','Affectations','3','22','1','880','20110620','','',''),
('MA3182408','Affectations','3','24','1','880','20131120','','',''),
('MA3204397','Affectations','3','22','1','705','20110224','','',''),
('MA3206396','Affectations','3','25','1','165','20140715','','',''),
('MA3206396','Affectations','3','24','1','441','20130909','','',''),
('MA3206396','Affectations','3','26','1','446','20150616','L','20150611',''),
('MA3206396','Affectations','3','22','1','870','20110316','','',''),
('MA3210394','Affectations','3','23','1','997','20120530','','',''),
('MA3210394','Affectations','3','24','1','997','20131220','','',''),
('MA3212393','Affectations','3','24','1','997','20130910','','',''),
('MA3214392','Affectations','1','28','1','150','20110509','','',''),
('MA3214392','Affectations','3','22','1','150','20110408','','',''),
('MA3214392','Affectations','3','23','1','317','20121022','','',''),
('MA3216391','Affectations','1','28','1','76','20111202','','',''),
('MA3216391','Affectations','3','24','1','997','20130912','','',''),
('MA3222388','Affectations','1','28','1','156','20110509','','',''),
('MA3224387','Affectations','3','23','1','317','20121022','','',''),
('MA3224387','Affectations','3','24','1','997','20131126','','',''),
('MA3226386','Affectations','3','23','1','997','20120413','','',''),
('MA3230384','Affectations','3','26','1','397','20151030','','',''),
('MA3230384','Affectations','3','27','1','397','20160713','L','20161215',''),
('MA3230384','Affectations','3','23','1','997','20120413','','',''),
('MA3230384','Affectations','3','24','1','997','20130910','','',''),
('MA3238380','Affectations','3','24','1','997','20131114','','',''),
('MA3248375','Affectations','3','24','1','997','20130718','','',''),
('MA3250374','Affectations','3','24','1','360','20130826','','',''),
('MA3264367','Affectations','3','24','1','25','20131220','A','20130726',''),
('MA3264367','Affectations','3','26','1','320','20141218','','',''),
('MA3264367','Affectations','3','25','1','333','20141023','L','20141201',''),
('MA3270364','Affectations','3','25','1','997','20140204','','',''),
('MA3280359','Affectations','3','25','1','318','20141014','','',''),
('MA3294352','Affectations','3','27','1','441','20161102','','',''),
('MA3300349','Affectations','1','32','1','76','20160323','','',''),
('MA3300349','Affectations','3','27','1','762','20161205','','',''),
('MA3306346','Affectations','3','27','1','732','20161017','','',''),
('MA2116941','Encaissement','3','23','1','325','20121205','','',''),
('MA2116941','Encaissement','3','23','1','325','20121227','A','20131115',''),
('MA3230384','Encaissement','3','26','1','397','20160209','A RAP','20160309',''),
('MA1199400','Televente','1','31','1','AJ','20150728','INJ','20150728',''),
('MA1199400','Televente','1','31','1','GB','20150522','PROP','20150522',''),
('MA1199400','Televente','1','29','1','GHITA','20121226','NRP','20121226',''),
('MA1199400','Televente','1','29','1','GHITA','20130205','A RAP','20130205',''),
('MA1199400','Televente','1','29','1','GHITA','','','',''),
('MA1199400','Televente','1','33','1','','','','',''),
('MA1199400','Televente','3','27','1','','','','',''),
('MA1199400','Televente','3','25','2','ZA','20140212','CH','20140212',''),
('MA1399300','Televente','3','23','1','SALAH','20121003','','',''),
('MA1999000','Televente','1','31','1','BB','20150303','PINT','20150303',''),
('MA1999000','Televente','1','33','1','FZA','20161012','PINT','20161012',''),
('MA1999000','Televente','1','29','1','GHITA','','','',''),
('MA1999000','Televente','1','32','1','','','','',''),
('MA2106946','Televente','1','29','1','AMAL','','','',''),
('MA2106946','Televente','1','31','1','IF','20150219','PINT','20150219',''),
('MA2106946','Televente','1','33','1','','','','',''),
('MA2106946','Televente','3','26','1','ZA','20150724','A RAP','20150724',''),
('MA2106946','Televente','10','1','9','AT','','','',''),
('MA2116941','Televente','3','22','1','AD','','','',''),
('MA2118940','Televente','3','23','1','SALAH','20121009','','',''),
('MA2118940','Televente','3','27','1','','','','',''),
('MA2118940','Televente','3','5','4','ISMAIL','','','',''),
('MA2118940','Televente','3','5','4','NABIL','','','',''),
('MA2118940','Televente','3','5','4','REDA','20130130','HC','20130130',''),
('MA2126936','Televente','3','22','1','IMANE','20111007','','',''),
('MA2126936','Televente','3','27','1','','','','',''),
('MA2128935','Televente','1','29','1','GHITA','','','',''),
('MA2128935','Televente','1','33','1','','','','',''),
('MA2128935','Televente','3','25','1','MABROUR','20140616','DOUBLON','20140616',''),
('MA2128935','Televente','3','27','1','','','','',''),
('MA2138930','Televente','1','29','1','AMAL','','','',''),
('MA2138930','Televente','1','33','1','FZA','20170112','INJ','20170112',''),
('MA2138930','Televente','3','25','1','BC','20140603','CESS','20140603',''),
('MA2138930','Televente','3','27','1','','','','',''),
('MA2142928','Televente','3','22','1','MERYEM','20110726','','',''),
('MA2142928','Televente','3','27','1','','','','',''),
('MA2142928','Televente','3','5','4','ISMAIL','20130201','CH','20130201',''),
('MA2150924','Televente','3','23','1','SALAH','20120927','','',''),
('MA2150924','Televente','3','25','1','','','','',''),
('MA2154922','Televente','1','31','1','AJ','20150922','HCib','20150922',''),
('MA2154922','Televente','1','29','1','GHITA','20130405','A RAP','20130405',''),
('MA2154922','Televente','1','29','1','GHIZLANE','','','',''),
('MA2154922','Televente','3','26','1','ZA','20150928','INJ','20150928',''),
('MA2154922','Televente','3','27','1','','','','',''),
('MA2162918','Televente','3','23','1','HAYAT','','','',''),
('MA2162918','Televente','3','26','1','','','','',''),
('MA2162918','Televente','3','27','2','OBB','20161230','A RAP','20161230',''),
('MA2170914','Televente','3','26','1','AEL','20160304','PINT','20160304',''),
('MA2170914','Televente','3','22','1','MERYEM','','','',''),
('MA2170914','Televente','3','27','1','','','','',''),
('MA2170914','Televente','3','5','4','ISMAIL','','','',''),
('MA2170914','Televente','3','5','4','REDA','20130318','NRP','20130318',''),
('MA2216891','Televente','3','23','1','HAYAT','','','',''),
('MA3002498','Televente','3','27','1','','','','',''),
('MA3034482','Televente','1','29','1','FARID','20121204','A RAP','20121204',''),
('MA3034482','Televente','1','29','1','GHIZLANE','','','',''),
('MA3034482','Televente','1','31','1','MAA','20150318','INJ','20150318',''),
('MA3034482','Televente','1','33','1','','','','',''),
('MA3034482','Televente','3','26','1','AE','20150223','PINT','20150223',''),
('MA3034482','Televente','3','27','1','AE','20160923','PINT','20160923',''),
('MA3070464','Televente','3','27','1','SJ','20161028','PINT','20161028',''),
('MA3076461','Televente','3','26','1','AEL','20160407','NRP','20160407',''),
('MA3076461','Televente','3','22','1','OUSSAMA','20110815','','',''),
('MA3076461','Televente','3','27','1','SF','20161102','NRP','20161102',''),
('MA3080459','Televente','3','22','1','SOFIA','20111128','','',''),
('MA3082458','Televente','3','27','1','KH','20161220','A RAP','20161220',''),
('MA3082458','Televente','3','26','1','','','','',''),
('MA3100449','Televente','3','27','1','','','','',''),
('MA3102448','Televente','3','22','1','IMANE','20110822','','',''),
('MA3102448','Televente','3','26','1','JC','20150327','INJ','20150327',''),
('MA3102448','Televente','3','27','1','ZH','20160804','PINT','20160804',''),
('MA3102448','Televente','3','24','2','BC','20131128','HC','20131128',''),
('MA3110444','Televente','3','22','1','SOFIA','20111110','','',''),
('MA3126436','Televente','3','26','1','ZA','20150212','PINT','20150212',''),
('MA3128435','Televente','3','22','1','SOFIA','20110810','','',''),
('MA3128435','Televente','3','27','1','','','','',''),
('MA3128435','Televente','3','28','2','KJ','20170222','INJ','20170222',''),
('MA3128435','Televente','3','25','2','ZA','20140903','PINT','20140903',''),
('MA3134432','Televente','3','22','1','HAYAT','20110815','','',''),
('MA3134432','Televente','3','27','1','IA','20160919','PINT','20160919',''),
('MA3134432','Televente','3','26','1','ZH','20150323','PINT','20150323',''),
('MA3148425','Televente','3','27','1','','','','',''),
('MA3148425','Televente','3','28','2','KH','20170209','SUS','20170209',''),
('MA3150424','Televente','1','29','1','ROCHDI','','','',''),
('MA3150424','Televente','3','26','1','KB','20160318','INJ','20160318',''),
('MA3158420','Televente','3','23','1','ALI','','','',''),
('MA3162418','Televente','3','26','1','BC','20150417','A RAP','20150417',''),
('MA3162418','Televente','3','22','1','MALIKA','20110830','','',''),
('MA3162418','Televente','3','28','1','','','','',''),
('MA3172413','Televente','3','24','1','ISMAIL','','','',''),
('MA3174412','Televente','3','23','1','ALI','20121031','','',''),
('MA3174412','Televente','3','26','1','MABROUR','20160223','SUS','20160223',''),
('MA3174412','Televente','3','5','4','MABROUR','20130222','SUS','20130222',''),
('MA3174412','Televente','3','5','4','REDA','','','',''),
('MA3180409','Televente','1','1','9','ACHRAF','','','',''),
('MA3180409','Televente','10','1','9','AT','','','',''),
('MA3182408','Televente','1','29','1','AMAL','','','',''),
('MA3182408','Televente','1','33','1','','','','',''),
('MA3182408','Televente','3','23','1','ALI','20121030','','',''),
('MA3182408','Televente','3','26','1','JC','20160412','PINT','20160412',''),
('MA3188405','Televente','3','22','1','MALIKA','','','',''),
('MA3192403','Televente','3','26','1','','','','',''),
('MA3204397','Televente','3','24','1','ISMAIL','','','',''),
('MA3204397','Televente','3','26','1','','','','',''),
('MA3204397','Televente','3','27','2','KH','20170117','NRP','20170117',''),
('MA3206396','Televente','3','24','1','MUSTAPHA','','','',''),
('MA3206396','Televente','3','27','1','','','','',''),
('MA3210394','Televente','3','27','1','','','','',''),
('MA3210394','Televente','90','23','23','BC','20140908','PINT','20140908',''),
('MA3212393','Televente','3','26','1','KB','20160107','FAUX N','20160107',''),
('MA3212393','Televente','3','27','1','','','','',''),
('MA3214392','Televente','3','22','1','LACHHAB','','','',''),
('MA3216391','Televente','3','28','1','EA','20170210','FAUX N','20170210',''),
('MA3216391','Televente','3','26','1','ZA','20151102','FAUX N','20151102',''),
('MA3216391','Televente','3','27','1','','','','',''),
('MA3222388','Televente','3','25','1','BC','20141104','PINT','20141104',''),
('MA3222388','Televente','3','27','1','','','','',''),
('MA3224387','Televente','3','24','2','MC','','','',''),
('MA3230384','Televente','3','26','1','ZA','20151030','REAL','20151030',''),
('MA3230384','Televente','3','27','1','ZA','20160919','NRP','20160919',''),
('MA3232383','Televente','3','22','1','MOUKTAD','','','',''),
('MA3238380','Televente','3','26','1','MT','20150216','PINT','20150216',''),
('MA3238380','Televente','3','27','1','','','','',''),
('MA3238380','Televente','3','24','2','MA','20131122','OK','20131122',''),
('MA3242378','Televente','3','5','4','ADIL','20130520','A RAP','20130520',''),
('MA3248375','Televente','3','27','1','','','','',''),
('MA3250374','Televente','3','26','1','FZO','','','',''),
('MA3250374','Televente','3','27','1','KJ','20161025','PINT','20161025',''),
('MA3264367','Televente','3','25','1','ZH','20141028','PINT','20141028',''),
('MA3270364','Televente','3','26','1','AE','20150331','CH','20150331',''),
('MA3270364','Televente','3','27','1','ZA','20160926','A RAP','20160926',''),
('MA3276361','Televente','3','25','1','AA','20140924','INJ','20140924',''),
('MA3276361','Televente','3','26','1','ZA','20150209','REAL','20150209',''),
('MA3280359','Televente','3','25','1','MT','20140620','PINT','20140620',''),
('MA3280359','Televente','3','27','1','','','','',''),
('MA3290354','Televente','3','27','1','','','','',''),
('MA3294352','Televente','3','27','1','ZH','','','',''),
('MA3296351','Televente','3','27','1','','','','',''),
('MA3302348','Televente','1','32','1','GB','','','',''),
('MA1199400','RDV','1','32','1','59','20160719','A RAP','',''),
('MA1199400','RDV','1','32','1','106','','','',''),
('MA1599200','RDV','3','27','1','320','20160420','A RAP','',''),
('MA1599200','RDV','3','27','2','320','20161222','L','',''),
('MA2106946','RDV','1','32','1','50','','','',''),
('MA2106946','RDV','1','33','1','76','','','',''),
('MA2106946','RDV','1','32','1','147','','','',''),
('MA2106946','RDV','3','27','1','318','20161216','A RAP','',''),
('MA2128935','RDV','1','32','1','106','20160401','L','',''),
('MA2128935','RDV','1','33','1','106','','','',''),
('MA2138930','RDV','1','33','1','106','','','',''),
('MA2138930','RDV','1','32','1','145','','','',''),
('MA2150924','RDV','3','28','1','369','','','',''),
('MA2150924','RDV','3','27','1','732','','','',''),
('MA3150424','RDV','3','28','1','376','20170228','A RAP','',''),
('MA3174412','RDV','3','27','1','441','','','',''),
('MA3182408','RDV','1','32','1','50','','','',''),
('MA3182408','RDV','1','33','1','168','','','',''),
('MA3230384','RDV','3','27','1','397','','','',''),
('MA3264367','RDV','3','26','1','320','20151112','L','',''),
('MA3294352','RDV','3','27','1','788','','','',''),
('MA3300349','RDV','1','32','1','76','','','',''),
('MA3306346','RDV','3','26','1','732','','','',''),
('MA3306346','RDV','3','27','1','880','','','','');

INSERT INTO `societes`(`code`, `societe`) VALUES ('1','Kompass'),
('3','Telecontact'),
('10','Kompass direct');

INSERT INTO `support`(`code`, `support`, `societe`) VALUES ('1','Kompass Papier','1'),
('2','Kompass Textiles','1'),
('3','KOMPASS.MA','1'),
('4','www.kompass.com','1'),
('5','Vente Annuaire Kompass Maroc','1'),
('1','Telecontact Papier','3'),
('2','www.telecontact.ma','3'),
('3','www.viepratique.ma','3'),
('4','Vie Pratique Casablanca Papier','3'),
('6','Vie Pratique Rabat Papier','3'),
('7','Plan Casablanca','3'),
('8','Chequier','3'),
('9','Vente Plan','3'),
('1','Produits Marketing direct','10');

/*INSERT INTO `televendeurs`(`code`, `nom_televendeur`) VALUES ('EA','Aziza EL ABOUBI'),
('BN','Nabil BOURHID'),
('RBA','Rachid BACHIRI'),
('ZH','Zineb HARROUCH'),
('JC','Jihane CHBIHI'),
('AE','Amina ERRABAH'),
('ZA','Zineb AQACHMAR'),
('HAB','Hajji Abdlakrim'),
('SALAH','salah boukrime'),
('FHA','FATIMA HormatAllah'),
('NEZHA','Nezha NAJMAOUI'),
('HA','Houda Akansous'),
('AD','Administrateur'),
('LL','laila lazrak'),
('NB','NAJIB BELRHAZI'),
('BK','BENHLAL KARIM'),
('AA','Adnane AABOUCHE'),
('AT','Amal Tazi'),
('GB','Ghizlane Benkhadda'),
('MD','Khadija Falah'),
('TFK','Kamal TSOULI FAROUKH'),
('IA','Intissar ARGAZ'),
('KH','Khadija HARROUCH'),
('KJ','Karim JALANI'),
('FZA','Fatima Zohra ALAMI'),
('MY','Youssef MOUSTAOUI'),
('FZE','Fatima Ezzahra ANNACHAT'),
('BS','Salma BACHRI'),
('SZ','Zineb SROUT'),
('AH','Hamza AIT SAID OUALI'),
('AB','Amal BERNIATI');

INSERT INTO `encaisseurs`(`code`, `nom_encaisseur`) VALUES ('AD','Administrateur'),
('SANAA','Sanaa Marhoume'),
('CHEMLAL','Fatima Chemlal'),
('JALANI','Rachida Jalani'),
('AVOCAT','AVOCAT'),
('FERMEE','STE FERMEE'),
('PTS','PETITE SOMME'),
('NEJDI','Mohamed Nejdi'),
('BADAOUI','Mohamed Badaoui'),
('BOUNRI','Rachid Bounri'),
('RAJAA','Rajaa Tahiri'),
('AMINA','Amina Hachim'),
('MO','MOUSSARIA'),
('KHALID','KHALID MAHZOUL'),
('IABDOU','Imane Abdou'),
('OUSSAMA','Oussama Bekouchi'),
('WAFAA','Wafaa Damouche'),
('ILHAM','ILHAM'),
('BELRHAZI','Najib BELRHAZI');

INSERT INTO `operateurs`(`code`, `nom_operateur`) VALUES ('AD','ADMINISTRATEUR'),
('NEZHA','NEZHA NAJMAOUI'),
('NB','NAJIB BELRHAZI'),
('IMANE','Imane AMZIL'),
('ILHAM','Ilham MAGHFOUR'),
('HAJAR','Hajah BOURHFIR'),
('CHEMLAL','Fatima CHEMLAL'),
('OUMAIMA','OUMAIMA BOUASSAMI'),
('SAMIRA','SAMIRA'),
('NADA','NADA'),
('KAOUTAR','KAOUTAR'),
('NAWAL','Nawal Khalil'),
('BOUZENNA','Hajar BOUZENNA'),
('SARA','Sara BERRKKAL'),
('HOUDA','SAID HOUDA'),
('NOHA','Noha SABBAB'),
('MERIEM','Meriem OMAIDINE'),
('HIND','Hind LAAWINE'),
('IDDER','Camilia IDDER'),
('BENCHKROUN','Majda Benchkroun'),
('TAM','Bennani Tam'),
('AHLAM','Ahlam ELKERRAZI'),
('SALIMA','Salima Elyousfi'),
('SROUT','Zineb SROUT'),
('KHATIB','Najat KHATIB');

INSERT INTO `vendeurs`(`code`, `nom_vendeur`) VALUES 
('730','DOUMIRI Nouamane'),
('800','BENNIS Hicham'),
('999','KOMPASS MAROC'),
('701','CHRAIBI Abdelhafid'),
('411','BERRADA Taieb'),
('150','ALAMI Brahim'),
('141','EL MOKADDAM Mouhssine'),
('147','SADAQ Rachida'),
('133','ZERAMDINI HfaÃ¯edh'),
('128','EL HORD Ilham'),
('129','ERZINI Abdelmalek'),
('99','RECEPTION'),
('106','HAMCHI Boubker'),
('82','LEFORT Charlotte'),
('75','REZKI Noufissa'),
('70','FAYE Alioune'),
('21','MORENO Thierry'),
('50','AHMADI Mohamed Moulay'),
('11','ALFONSI Marie Dominique'),
('17','LAYDI Driss'),
('18','ELHAMZAOUI Rachida'),
('19','MARKETING'),
('425','KEZZAZ Abdellatif'),
('427','EL ANDALOUSSI Mohamed'),
('431','OUTIZIAhmed'),
('434','LEBJY Amina'),
('562','BOUABID Ahmed'),
('584','SKALLI Mohamed Kamal'),
('165','DRAKA Saadia'),
('60','HOURMATALLAH Fatima'),
('810','ADLAOUI Omar'),
('441','SAIBI Mohamed'),
('709','BENCHEKROUN Hassan'),
('865','KASSI Nadia'),
('440','RHAZAL Abdellah'),
('436','ALAMI El Bachir'),
('726','EL MOUDNI Ahmed'),
('437','JAAKIK Souhail'),
('732','RAMLAOUANE Said'),
('438','CHOKRALLAH ABDELALAI'),
('25','DIRECTION Commerciale'),
('806','ACHNINE Abdelghani'),
('870','BENZAHRA Abdelhak'),
('875','JELLAB'),
('755','KILAOUY Aziz'),
('950','BADAOUI BENNANI Mohamed'),
('435','EL ANDALOUSSIMustapha'),
('600','BENAMAR Ali'),
('880','HAJJI Abdelati'),
('885','CHAKRI'),
('955','NEJDI MOHAMED'),
('956','Rachid BOUNRI'),
('160','GZOULI HICHAM'),
('480','LOUDGHIRISamira'),
('138','TALIB Mohamed'),
('124','Khadija EL BIGDI'),
('487','kenza'),
('610','ADDIBAS Rachid'),
('965','NEJDI - GHIZLANE'),
('966','BOUNRI - SOFIANE'),
('960','BADAOUI - MOUNA'),
('442','GHIATE Khalid'),
('820','KNINECH Youssef'),
('830','KABRITI Mohamed'),
('443','BOUTGLAYAbdelaziz'),
('809','DINAR BAKIOUI Adil'),
('990','COMPTOIR RABAT'),
('968','Reclamation'),
('969','Bamzil Khadija'),
('173','ZLOURHI Mourad'),
('175','TAZI Mohamed'),
('177','BENLAMINE Mounir'),
('850','SLAOUI Mohamed'),
('860','KHARBOUCH Mounir'),
('179','LAHTOUTE Marouan'),
('168','BERRADA Hind'),
('481','MERZOUK Aziz'),
('840','HMIDI Mohamed'),
('890','CHARI Naima'),
('812','ZOUHADIYassine'),
('750','KADIRI Mustapha'),
('182','Rachid CHOKRI'),
('59','CHEMLAL Fatima'),
('61','Houda AKANSOUS'),
('895','EL MADANI Boutaali'),
('62','Laila Lazrak'),
('180','BELARBI Boutaina'),
('570','MAHER Mustapha'),
('705','CHRAIBI Taib'),
('845','AHMADI Mohamed Amine'),
('991','CALL CENTER'),
('998','Mme LaÃ¯la Lazrak'),
('620','Mastaki Sanaa'),
('622','Boucetta Ahmed'),
('624','ISLAH MOHAMED'),
('630','BELYMAN Mohamed Amine'),
('626','BAALAOUI Hanane'),
('640','RAJRAJI ChouaÃ¯b'),
('445','KHABAR MEHDI'),
('970','TEYBANI Ghizlane'),
('973','JALANI Rachida'),
('975','TAZI Amal'),
('977','MARHOUM SanaÃ¢'),
('30','NEZHA NAJMAOUI'),
('995','Maxi Phone'),
('64','Lamia Safraoui'),
('760','COROLLEUR Sylvie'),
('788','REZKI Latifa'),
('963','Amina HACHIM'),
('971','ZIALE Walid'),
('154','LAHLOU Khalid'),
('156','ROUCHDY Siham'),
('972','SIFY Younes'),
('65','SEFRIOUI Lamia'),
('974','ESSALEH Imane'),
('161','TAOUDI Sana'),
('164','ALIOUI Rachid'),
('446','KHABBAZ Driss'),
('817','GHSSAINE Jamal'),
('650','ABOUZEID Yasmine'),
('655','ALAOUI Hicham'),
('670','AWAB Sara'),
('660','TAIBI Hicham'),
('680','BATTAL Saadia'),
('992','ADWEB'),
('980','BRUAL Thierry'),
('825','IDIANE Mohamed'),
('210','KOUTARI El Mehdi'),
('214','RAJI Lamia'),
('216','MOUTI Mohamed'),
('218','MARRAKCHI Med Amine'),
('66','LAAMIR Sarah'),
('993','TAZI Amal'),
('994','BENKHADDA Ghizlane'),
('996','Mohamed EUHAIK'),
('76','REZKI Omar'),
('215','HAMDI Daoudi'),
('220','KHENBOUBI Issam'),
('222','MAROUANE Abdelkebir'),
('226','NHILA Aziz'),
('224','HIYAJ Imane'),
('350','ICHEGHCHAOUI Youssef'),
('352','TARGUILY Taoufik'),
('328','MOUKTAD ahmed'),
('238','EL MOUJAHID Mohamed'),
('240','EL GHAZLANI Abdellah'),
('270','ABBADI Ahmed Mounir'),
('250','HAJIB BOUAMRI Ahmed'),
('260','TAOUKIL Hicham'),
('280','MAHDI Mohamed Amine'),
('300','BENAISSA Mohamed'),
('485','MOKHTARI Morad'),
('450','BOUALAM Youness'),
('455','CHABABE Amine'),
('332','MANA Khadija'),
('310','SAHRAOUI Omar'),
('320','CHAHBI Mehdi'),
('325','LACHHAB Mustapha'),
('330','CHAHBI Abderrahman'),
('335','ELMRAH Youssef'),
('305','AZEF Zakaria'),
('340','SERDOUK Abdellah'),
('345','TOUILTA Rabie'),
('336','TAHRI Hamza'),
('342','HANINE Abdelilah'),
('338','NOUQATI Tarik'),
('355','ABOULKHAIRAT Nadia'),
('360','MABROUR Fatim Zahra'),
('365','EL AZZOUZI Bahaeddine'),
('370','MAZOUNI Ouarda'),
('375','BOUBAKRI Hafsa'),
('380','RHOZZI Nabil'),
('387','Bekouchi Ousama'),
('385','Mounia BENKANIA'),
('390','Laraki Mohamed Amine'),
('805','OULAD Lahoucine Faress'),
('835','ELOUAZANI Lahoucine'),
('326','BOHTEY FayÃ§al'),
('997','Televente Telecontact'),
('312','EL BOUANANI Amira'),
('314','DAYI Mohamed'),
('740','LAROUSSINIE Raoul'),
('307','AITBRAIM Fouad'),
('308','MOULNAKHLAMohamed Ikbal'),
('317','BOUGHALEB El Ghali'),
('318','EL YACOUBI Zineb'),
('322','MOUNCHIT Zakaria'),
('989','Televente 2'),
('337','SNOUSSI Ahmed'),
('339','RAMZI Rabab'),
('341','OUHLAL Ibtissam'),
('45','MANSOUR Jamil'),
('313','TANGI Houda'),
('319','ENNAJI Abdeljalil'),
('321','FILALI Ghita'),
('55','EL QANDIL Souhail'),
('323','FARID Imane'),
('324','BOUTAYBA RIDA'),
('327','BAKRIM Mohamed'),
('353','BERDAI IsmaÃ¯l'),
('354','NSIAS Nabil'),
('68','BERRADA Achraf'),
('356','EL KOUHLANI Adil'),
('357','IDRISSI BOUTAYBI Chaimaa'),
('372','AABOUCHE Adnan'),
('765','CHARAFEDDINE Zakaria'),
('377','Nabil LAKSIR'),
('374','Alaoui Mdarhri Youssef'),
('333','HARROUCH Zineb'),
('391','ELAMRANI Mohamed'),
('392','BENKIRAN Yousra'),
('393','HALOUANI Imad'),
('394','SALLIH Fatima Zahra'),
('432','KBIRI ALAOUI Younes'),
('361','HASSOUNI Hassan'),
('362','ELHARTI Sara'),
('363','ELKHALIDI Asmaa'),
('67','SIDKI Asmaa'),
('397','AQACHMAR Zineb'),
('398','CHADILI Bouchra'),
('379','SAHRAOU Mohamed'),
('364','Tchaghtchougha Mehdi'),
('366','Kara Naciri Samia'),
('35','MOUTAOUAKIL Mbarke'),
('33','BENHLAL Karim'),
('382','AOUED Jihane'),
('384','SAYDY Imane'),
('386','KRIM Sara'),
('373','BENHRA Reda'),
('383','BINEBINE Othmane'),
('376','CHBIHI Jihane'),
('255','AIT EL MAJDOUB Mehdi'),
('315','RHONI Hicham'),
('395','SAMIR Sanaa'),
('381','ERRABAH Amina'),
('388','GARICH Kamilia'),
('987','Televente Kompass'),
('396','SAQI Omar'),
('399','BOUARGANE Mohamed Badr'),
('155','LAZAAR Nabil'),
('378','LEMCHAHHER Fatima Zahra'),
('344','SALOUANE Salah Eddine'),
('346','YOUSFI Salma'),
('347','OUARAR Faime Zahra'),
('348','HICHY Adnane'),
('349','BOUCHRAOUI Jihad'),
('358','NASSIR Kamal'),
('510','BAALI Younes'),
('520','EL OUAZZANI Ilham'),
('166','LAHRICHI Karim'),
('144','RKHA Maria'),
('145','OUKBICH BENSALAH Reda'),
('433','ZINE Mehdi'),
('369','ECHAABI Ihsane'),
('170','BOUABDALLAHAmine'),
('837','KHATTOU Amine'),
('157','ABARAGH Ahmed'),
('940','ANNOUNE Amine'),
('945','BELAHMER Bachir'),
('367','BENJELLOUN Abdelaziz'),
('368','MESKABI Tarek'),
('371','ESSAKHAR Sarra'),
('40','TSOULI Kamal'),
('334','HAZZAZ Tahar'),
('331','MOSSADAQ El Mehdi'),
('978','Ahlam JAMRI'),
('979','Aziz AHMADI'),
('158','NASIRI Ibrahim'),
('351','EL KHALIDI Asmaa'),
('359','BOULHANA Rachida'),
('530','AITHADDOU Ilyas'),
('389','BACHIRI Rachid'),
('585','GHODRI Yacine'),
('976','BELKHOUYA Ahmed said'),
('422','RASSAM Samy'),
('758','FARIS Jamila'),
('759','Mohamed Hilaoui'),
('761','Lamia MANANE'),
('762','DEBBAOUI Youness'),
('988','ALAMI Fatima Zohra'),
('304','JALANI Karim'),
('306','JAMAL Saloua'),
('309','HARROUCH Khadija'),
('303','ARGAZ Intissar'),
('54','AHMADI Lachmi'),
('672','EL BASRI Youssef'),
('302','BOURHID Nabil'),
('26','Nouveaux Vendeurs');*/

INSERT INTO `resultat_affectations`(`code`, `libelle`) VALUES ('A','Contract Signe'),
('B','Contrat Renouvle'),
('L','Negatif'),
('P','ProblÃ¨me (Ã  preciser)'),
('S','A Suivre'),
('N','Ne pas Prospecter'),
('R','Ferme'),
('T','Absent au Rendez-Vous'),
('U','Prob. Tel');

INSERT INTO `resultat_televentes`(`code`, `libelle`) VALUES ('PROP','Propositionenvoyee'),
('A RAP','A Rappeler'),
('DOUBLON','Doublon'),
('INJ','Injoignable'),
('SUS','Suspendu'),
('PINT','Pas interesse'),
('CESS','Cessation'),
('PAS N','Pas de numero'),
('FAUX N','Faux numero'),
('REAL','Realise'),
('CH','Chute'),
('HCib','Hors Cible'),
('DEJA C','Deja client'),
('RDV','Rendez-vous telephonique'),
('NRP','Ne reponds pas');# 15 lignes affectees.




INSERT INTO `resultat_encaissements`(`code`, `libelle`) VALUES ('Code','Libelle'),
('OCC','OCCUPE'),
('FN','FAUX NUMERO'),
('AP','ACCORD DE PRINCIPE'),
('NRP','NE REPOND PAS'),
('SUS','SUSPENDU'),
('A RAP','A RAPPELER'),
('DVC','DEMANDE VISITE COMMERCIAL'),
('VA','Visite Agent'),
('PR','Parution'),
('CP','CAS PARTICULIER'),
('OK','REGLEMENT PRET'),
('OK V','OK VIREMENT'),
('OK C','OK AGENT'),
('OK P','OK POSTE'),
('PB','PROBLEME'),
('AA','ARRET D ACTIVITE'),
('PTS','PETITE SOMME'),
('A','AVOCAT'),
('SF','SOCIETE FERMEE'),
('DC','DOSSIER CONTENTIEUX');# 21 lignes affectees.

INSERT INTO `resultat_rdv`(`code`, `libelle`) VALUES ('Code','Libelle'),
('A RAP','A RAPPELER'),
('NRP','Ne repond pas'),
('NA','Non Attribue'),
('RDV','Rendez-Vous'),
('L','Nega'),
('CC','Contact Commercial'),
('PR','Proposition'),
('FN','FAUX NUMERO'),
('F','Ferme'),
('AA','ArrÃªt d activite'),
('RP','ProblÃ¨me rÃ¨glement'),
('Signe','signe'),
('5 A RAP','A rappeler'),
('5 FN','Faux numeros'),
('5 OK','Formulaire reÃ§u'),
('5 SF','Societe Fermee'),
('5 SUS','Tel Suspendu'),
('5 NRP','Tel Ne Repend pas'),
('5 Refus','Refus'),
('5 CP','Cas Particuliers'),
('5 AP','Accord de Principe'),
('5 MAIL','Demande Mail'),
('5 FAX','Demande Fax');# 24 lignes affectees.

INSERT INTO production
(code_firme,societe,num_bc,edition,support,num_ligne,operateur,date_operateur,code_produit,date_envoi_bat,date_retour_bat,moyen_envoi,resultat_bat) 
values 
('MA2210894','3','56400','11','1','1','','2000-4-18','E1','2000-4-20','2000-4-25','',''),
('MA2210894','3','60410','12','1','1','AS','2001-4-05','E1','2001-4-10','','FAX',''),
('MA2210894','3','60410','12','1','2','AS','2001-4-05','E1','2001-4-27','2001-4-27','FAX',''),
('MA2210894','3','66510','13','1','1','AB','2002-5-22','E1','2002-5-29','','FAX',''),
('MA2210894','3','66510','13','1','2','AB','2002-5-22','E1','2002-6-06','2002-6-06','FAX',''),
('MA2210894','3','68906','14','1','2','AB','2003-3-18','E1','2003-4-15','2003-4-16','FAX',''),
('MA2210894','3','68906','14','1','1','AB','2003-3-18','E1','2003-3-26','','FAX',''),
('MA1999000','5','15476','10','1','1','AN','2003-5-05','C1','2003-5-12','2003-5-13','FAX',''),
('MA3076461','5','14359','10','1','1','AB','2003-6-05','B1','2003-6-18','2003-8-06','FAX',''),
('MA2210894','5','14972','10','1','1','MZ','2003-6-10','C1','2003-6-17','2003-6-23','FAX',''),
('MA1999000','5','16633','11','1','1','MJ','2004-5-20','C4','2004-5-27','2004-6-01','CR',''),
('MA1999000','5','16633','11','1','2','MJ','2004-5-20','C4','2004-6-01','2004-6-22','EM',''),
('MA2106946','3','95065','19','1','1','MJ','2008-6-13','B1','2008-6-19','2008-7-18','FAX',''),
('MA3264367','3','127800','24','1','1','AD','2013-08-30','','2013-09-05','2013-10-09','EM',''),
('MA3264367','3','127800','24','1','2','AD','2013-08-30','','2013-10-09','2013-10-28','EM',''),
('MA3264367','3','127800','24','1','3','AD','2013-08-30','','2013-10-28','2013-10-28','EM',''),
('MA3264367','3','127800','24','1','4','AD','2013-08-30','','2013-11-02','2013-11-02','EM','OK sans réponse');

INSERT INTO detail_bc 
(code_firme,societe,num_bc,edition,support,code_produit,emplcement,produit_papier,produit_internet,option_prod_internet,date_fin,module,remise,prix_ht)
VALUES
('MA1199400','1','41150','13','2','V','ITEMASA','','','','','','0','1500'),
('MA1199400','1','41620','14','2','V','ITEMASA','','','','','','0','1500'),
('MA1199400','1','41748','15','2','V','ITEMASA','','','','','','0','1500'),
('MA1999000','5','15476','10','1','G','761740','Grossissement simple','','','','','300','0'),
('MA1999000','5','15476','10','1','C1','508820','80 x 40 mm','','','','','0','2900'),
('MA1999000','5','16633','11','1','C4','508820','80 x 40 mm','','','','','1900','3000'),
('MA2106946','1','6741','13','1','C','3327055','1/4 page','','','','','0','4000'),
('MA2106946','1','7806','14','1','C','3327055','1/4 page','','','','','0','4800'),
('MA2106946','1','46228','1','5','','CD24','','','','','','0','250'),
('MA2106946','1','46228','1','5','','KG24','','','','','','0','700'),
('MA2106946','1','79444','1','5','','CD22','','','','','','0','250'),
('MA2106946','1','79444','1','5','','KG22','','','','','','0','700'),
('MA2106946','1','79832','1','5','','KG23','','','','','','0','700'),
('MA2106946','1','79832','1','5','','CD23','','','','','','0','250'),
('MA2106946','3','95065','19','1','B1','075650','19 x 80 mm','','','','','0','2550'),
('MA2116941','3','40484','6','1','N3','696250','30 x 125 mm','','','','','0','3400'),
('MA2116941','3','117595','22','1','G','760560','Grossissement Simple','','','','','0','400'),
('MA2116941','3','127025','23','1','S1','696250','inscription simple','','','','','0','1700'),
('MA2138930','1','7416','14','1','C','3943003','1/4 page','','','','','0','4800'),
('MA2138930','1','7416','14','1','C','3511043','1/4 page','','','','','0','4800'),
('MA2154922','3','50077','9','1','P3','774830','30x125mm/jaune','','','','','0','5400'),
('MA2154922','3','55635','10','1','J2','774830','40 x 163 mm','','','','','0','8300'),
('MA2154922','1','113541','6','2','B','2326019','','','','','','0','12000'),
('MA2198900','3','48509','8','1','N2','304000','30x80mm','','','','','0','2700'),
('MA2198900','3','48509','8','1','G','090580','grossissement seul','','','','','0','0'),
('MA2198900','3','52503','9','1','N2','304000','30x80mm','','','','','0','2900'),
('MA2210894','5','14972','10','1','C1','311930','80 x 40 mm','','','','','0','2900'),
('MA2210894','3','52034','9','1','J3','311930','60x125 mm','','','','','0','6300'),
('MA2210894','3','53214','10','1','E1','311930','82 x 80 mm','','','','','0','6000'),
('MA2210894','3','56400','11','1','E1','311930','82 x 80 mm','','','','','0','6600'),
('MA2210894','3','60410','12','1','E1','311930','82 x 80 mm','','','','','0','6600'),
('MA2210894','3','66510','13','1','E1','311930','82 x 80 mm','','','','','0','7500'),
('MA2210894','3','68906','14','1','E1','311930','82 x 80 mm','','','','','0','7500'),
('MA3076461','5','14359','10','1','B1','075210','80 x 19 mm','','','','','0','2000'),
('MA3180409','10','2661','1','9','','222001','','','','','','0','7464'),
('MA3230384','3','144121','26','1','Q1','224190','inscription + logo quadri','','','','','0','1600'),
('MA3264367','3','127799','24','2','ML','WTRESOR','','','','','Le 1 er magasin a Fes qui vous propose des produits du Terroir pour votre bien être 100% naturels et Bio: miel, huile d olive, huile d argan, huiles essentielles, huiles vegetales, savon naturel, produits alimentaires sans conservateur...','650','1500'),
('MA3264367','3','127800','24','1','Q1','656690','inscription + logo quadri','','','','','733.33','1166.67');

INSERT INTO detail_reglement(code_firme, societe, num_bc, edition, support,num_reglem, num_facture, mt_ttc, mode_reglem, date_reg, date_valeur, date_encais, date_impaye, impaye) VALUES
('MA2106946','1','6741','13','1','3518','4774','2380','Chèque','1991-07-26','1991-07-08','','',''),
('MA2106946','1','6741','13','1','3519','6198','2380','Espèce','1992-12-17','1992-10-02','','',''),
('MA2138930','1','7416','14','1','4308','6001','11424','Chèque','1992-10-12','1992-10-05','','',''),
('MA2106946','1','7806','14','1','4962','6446','5712','Effet','1993-01-7','1993-01-20','','',''),
('MA2154922','1','113541','6','2','79761','15013','14400','Effet','1997-12-31','1998-01-20','','',''),
('MA2116941','3','40484','6','1','34051','3637','404.6','Effet','1995-03-15','1995-03-30','','',''),
('MA2116941','3','40484','6','1','34052','3638','404.6','Effet','1995-03-15','1995-04-30','','',''),
('MA2116941','3','40484','6','1','34053','3639','404.6','Effet','1995-03-15','1995-5-30','','',''),
('MA2116941','3','40484','6','1','34054','3640','404.6','Effet','1995-03-15','1995-06-30','','',''),
('MA2116941','3','40484','6','1','34055','3641','404.6','Effet','1995-03-15','1995-07-30','','',''),
('MA2116941','3','40484','6','1','34056','3642','404.6','Effet','1995-03-15','1995-08-30','','',''),
('MA2116941','3','40484','6','1','34057','3643','404.6','Effet','1995-03-15','1995-09-30','','',''),
('MA2116941','3','40484','6','1','34058','3644','404.6','Effet','1995-03-15','1995-10-30','','',''),
('MA2116941','3','40484','6','1','34059','3645','404.6','Effet','1995-03-15','1995-11-30','','',''),
('MA2116941','3','40484','6','1','34060','3646','404.6','Effet','1995-03-15','1995-12-30','','',''),
('MA2198900','3','48509','8','1','43947','24265','810','Chèque','1997-06-24','1997-06-30','','',''),
('MA2198900','3','48509','8','1','43948','24266','810','Chèque','1997-06-24','1997-08-30','','',''),
('MA2198900','3','48509','8','1','43949','24267','810','Chèque','1997-06-24','1997-10-30','','',''),
('MA2198900','3','48509','8','1','43950','24268','810','Chèque','1997-06-24','1997-12-30','','',''),
('MA2154922','3','50077','9','1','45922','26731','6480','Chèque','1998-03-20','1998-03-19','','',''),
('MA2210894','3','52034','9','1','49182','28735','7560','Chèque','1998-07-02','1998-07-01','','',''),
('MA2198900','3','52503','9','1','49801','30390','3480','Chèque','1999-01-06','1998-12-31','','',''),
('MA2210894','3','53214','10','1','50741','30921','7200','Chèque','1999-03-11','1999-03-11','','',''),
('MA2154922','3','55635','10','1','54380','34970','9960','Chèque','1999-11-15','1999-11-22','','',''),
('MA2210894','3','56400','11','1','55488','36281','7920','Chèque','2000-04-26','2000-04-24','','',''),
('MA2210894','3','60410','12','1','61530','40543','7920','Chèque','2001-04-17','2001-04-02','2001-04-23','',''),
('MA2210894','3','66510','13','1','67889','43973','9000','Chèque','2002-06-10','2002-05-21','2002-06-13','',''),
('MA2210894','3','68906','14','1','71017','46049','9000','Chèque','2003-04-24','2003-03-31','2003-04-30','',''),
('MA1999000','5','15476','10','1','14451','10853','3480','Effet','2003-12-30','2004-03-31','2004-04-01','',''),
('MA3076461','5','14359','10','1','12735','10992','2400','Chèque','2003-11-12','2003-10-31','2003-11-25','',''),
('MA2210894','5','14972','10','1','13673','10952','3480','Chèque','2003-08-29','2003-08-13','2003-09-12','',''),
('MA1999000','5','16633','11','1','84145','11770','3600','Effet','2005-02-11','2005-03-31','2005-04-01','',''),
('MA1199400','1','41150','13','2','83640','25119','1800','Chèque','2005-01-17','2005-01-17','2005-02-04','',''),
('MA1199400','1','41620','14','2','90897','55714','1800','Chèque','2005-12-12','2005-12-12','2005-12-26','',''),
('MA2106946','1','79444','1','5','96386','58190','1000','Chèque','2006-07-07','2006-07-07','2006-07-12','',''),
('MA1199400','1','41748','15','2','101874','60482','1800','Chèque','2007-04-03','2007-04-03','2007-04-09','',''),
('MA2106946','1','79832','1','5','102712','61787','1000','Chèque','2007-05-02','2007-05-02','2007-05-08','',''),
('MA2106946','1','46228','1','5','111666','67569','1000','Chèque','2008-05-16','2008-05-16','2008-05-21','',''),
('MA2106946','3','95065','19','1','112441','68176','3060','Chèque','2008-06-12','2008-06-12','2008-06-19','',''),
('MA3180409','10','2661','1','9','120274','72419','8956.8','Chèque','2009-04-13','2009-04-13','2009-04-16','',''),
('MA2116941','3','117595','22','1','138836','84825','240','Chèque','2011-05-16','2011-05-31','2011-06-02','',''),
('MA2116941','3','117595','22','1','138837','84825','240','Chèque','2011-05-16','2011-06-30','2011-07-04','',''),
('MA3264367','3','127799','24','2','158186','96811','600','Effet','2013-07-26','2013-08-30','2013-09-02','',''),
('MA3264367','3','127799','24','2','158187','96811','600','Effet','2013-07-26','2013-09-30','2013-10-01','',''),
('MA3264367','3','127799','24','2','158188','96811','600','Effet','2013-07-26','2013-10-30','2013-10-31','',''),
('MA3264367','3','127800','24','1','158189','97319','700','Effet','2013-07-26','2014-02-28','2014-03-03','',''),
('MA3264367','3','127800','24','1','158190','97319','700','Effet','2013-07-26','2014-03-30','2014-04-01','',''),
('MA3230384','3','144121','26','1','177393','109362','1920','Virement','2016-03-11','2016-03-10','2016-03-10','','');

INSERT INTO `courtier`(`code`, `nom_courtier`) VALUES ('00','');
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'EA' , 'Aziza EL ABOUBI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'EA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BN' , 'Nabil BOURHID' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BN') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'RBA' , 'Rachid BACHIRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'RBA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'ZH' , 'Zineb HARROUCH' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'ZH') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'JC' , 'Jihane CHBIHI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'JC') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AE' , 'Amina ERRABAH' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AE') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'ZA' , 'Zineb AQACHMAR' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'ZA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'HAB' , 'Hajji Abdlakrim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'HAB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SALAH' , 'salah boukrime' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SALAH') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'FHA' , 'FATIMA HormatAllah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'FHA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NEZHA' , 'Nezha NAJMAOUI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NEZHA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'HA' , 'Houda Akansous' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'HA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AD' , 'Administrateur' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AD') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'LL' , 'laila lazrak' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'LL') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NB' , 'NAJIB BELRHAZI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BK' , 'BENHLAL KARIM' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BK') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AA' , 'Adnane AABOUCHE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AT' , 'Amal Tazi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AT') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'GB' , 'Ghizlane Benkhadda' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'GB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'MD' , 'Khadija Falah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'MD') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'TFK' , 'Kamal TSOULI FAROUKH' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'TFK') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'IA' , 'Intissar ARGAZ' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'IA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'KH' , 'Khadija HARROUCH' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'KH') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'KJ' , 'Karim JALANI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'KJ') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'FZA' , 'Fatima Zohra ALAMI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'FZA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'MY' , 'Youssef MOUSTAOUI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'MY') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'FZE' , 'Fatima Ezzahra ANNACHAT' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'FZE') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BS' , 'Salma BACHRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BS') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SZ' , 'Zineb SROUT' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SZ') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AH' , 'Hamza AIT SAID OUALI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AH') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AB' , 'Amal BERNIATI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SANAA' , 'Sanaa Marhoume' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SANAA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'CHEMLAL' , 'Fatima Chemlal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'CHEMLAL') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'JALANI' , 'Rachida Jalani' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'JALANI') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AVOCAT' , 'AVOCAT' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AVOCAT') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'FERMEE' , 'STE FERMEE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'FERMEE') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'PTS' , 'PETITE SOMME' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'PTS') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NEJDI' , 'Mohamed Nejdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NEJDI') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BADAOUI' , 'Mohamed Badaoui' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BADAOUI') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BOUNRI' , 'Rachid Bounri' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BOUNRI') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'RAJAA' , 'Rajaa Tahiri' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'RAJAA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AMINA' , 'Amina Hachim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AMINA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'MO' , 'MOUSSARIA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'MO') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'KHALID' , 'KHALID MAHZOUL' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'KHALID') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'IABDOU' , 'Imane Abdou' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'IABDOU') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'OUSSAMA' , 'Oussama Bekouchi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'OUSSAMA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'WAFAA' , 'Wafaa Damouche' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'WAFAA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'ILHAM' , 'ILHAM' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'ILHAM') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BELRHAZI' , 'Najib BELRHAZI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BELRHAZI') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NEZHA' , 'NEZHA NAJMAOUI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NEZHA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NB' , 'NAJIB BELRHAZI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'IMANE' , 'Imane AMZIL' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'IMANE') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'ILHAM' , 'Ilham MAGHFOUR' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'ILHAM') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'HAJAR' , 'Hajah BOURHFIR' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'HAJAR') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'CHEMLAL' , 'Fatima CHEMLAL' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'CHEMLAL') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'OUMAIMA' , 'OUMAIMA BOUASSAMI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'OUMAIMA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SAMIRA' , 'SAMIRA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SAMIRA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NADA' , 'NADA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NADA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'KAOUTAR' , 'KAOUTAR' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'KAOUTAR') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NAWAL' , 'Nawal Khalil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NAWAL') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BOUZENNA' , 'Hajar BOUZENNA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BOUZENNA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SARA' , 'Sara BERRKKAL' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SARA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'HOUDA' , 'SAID HOUDA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'HOUDA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'NOHA' , 'Noha SABBAB' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'NOHA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'MERIEM' , 'Meriem OMAIDINE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'MERIEM') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'HIND' , 'Hind LAAWINE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'HIND') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'IDDER' , 'Camilia IDDER' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'IDDER') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'BENCHKROUN' , 'Majda Benchkroun' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'BENCHKROUN') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'TAM' , 'Bennani Tam' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'TAM') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'AHLAM' , 'Ahlam ELKERRAZI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'AHLAM') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SALIMA' , 'Salima Elyousfi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SALIMA') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'SROUT' , 'Zineb SROUT' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'SROUT') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 'KHATIB' , 'Najat KHATIB' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = 'KHATIB') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '730' , 'DOUMIRI Nouamane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '730') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '800' , 'BENNIS Hicham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '800') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '999' , 'KOMPASS MAROC' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '999') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '701' , 'CHRAIBI Abdelhafid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '701') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '411' , 'BERRADA Taieb' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '411') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '150' , 'ALAMI Brahim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '150') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '141' , 'EL MOKADDAM Mouhssine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '141') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '147' , 'SADAQ Rachida' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '147') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '133' , 'ZERAMDINI HfaÃ¯edh' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '133') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '128' , 'EL HORD Ilham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '128') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '129' , 'ERZINI Abdelmalek' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '129') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '99' , 'RECEPTION' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '99') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '106' , 'HAMCHI Boubker' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '106') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '82' , 'LEFORT Charlotte' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '82') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '75' , 'REZKI Noufissa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '75') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '70' , 'FAYE Alioune' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '70') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '21' , 'MORENO Thierry' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '21') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '50' , 'AHMADI Mohamed Moulay' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '50') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '11' , 'ALFONSI Marie Dominique' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '11') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '17' , 'LAYDI Driss' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '17') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '18' , 'ELHAMZAOUI Rachida' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '18') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '19' , 'MARKETING' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '19') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '425' , 'KEZZAZ Abdellatif' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '425') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '427' , 'EL ANDALOUSSI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '427') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '431' , 'OUTIZIAhmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '431') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '434' , 'LEBJY Amina' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '434') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '562' , 'BOUABID Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '562') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '584' , 'SKALLI Mohamed Kamal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '584') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '165' , 'DRAKA Saadia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '165') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '60' , 'HOURMATALLAH Fatima' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '60') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '810' , 'ADLAOUI Omar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '810') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '441' , 'SAIBI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '441') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '709' , 'BENCHEKROUN Hassan' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '709') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '865' , 'KASSI Nadia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '865') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '440' , 'RHAZAL Abdellah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '440') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '436' , 'ALAMI El Bachir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '436') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '726' , 'EL MOUDNI Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '726') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '437' , 'JAAKIK Souhail' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '437') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '732' , 'RAMLAOUANE Said' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '732') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '438' , 'CHOKRALLAH ABDELALAI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '438') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '25' , 'DIRECTION Commerciale' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '25') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '806' , 'ACHNINE Abdelghani' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '806') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '870' , 'BENZAHRA Abdelhak' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '870') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '875' , 'JELLAB' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '875') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '755' , 'KILAOUY Aziz' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '755') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '950' , 'BADAOUI BENNANI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '950') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '435' , 'EL ANDALOUSSIMustapha' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '435') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '600' , 'BENAMAR Ali' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '600') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '880' , 'HAJJI Abdelati' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '880') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '885' , 'CHAKRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '885') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '955' , 'NEJDI MOHAMED' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '955') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '956' , 'Rachid BOUNRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '956') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '160' , 'GZOULI HICHAM' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '160') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '480' , 'LOUDGHIRISamira' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '480') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '138' , 'TALIB Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '138') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '124' , 'Khadija EL BIGDI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '124') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '487' , 'kenza' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '487') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '610' , 'ADDIBAS Rachid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '610') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '965' , 'NEJDI - GHIZLANE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '965') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '966' , 'BOUNRI - SOFIANE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '966') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '960' , 'BADAOUI - MOUNA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '960') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '442' , 'GHIATE Khalid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '442') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '820' , 'KNINECH Youssef' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '820') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '830' , 'KABRITI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '830') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '443' , 'BOUTGLAYAbdelaziz' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '443') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '809' , 'DINAR BAKIOUI Adil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '809') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '990' , 'COMPTOIR RABAT' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '990') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '968' , 'Reclamation' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '968') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '969' , 'Bamzil Khadija' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '969') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '173' , 'ZLOURHI Mourad' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '173') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '175' , 'TAZI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '175') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '177' , 'BENLAMINE Mounir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '177') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '850' , 'SLAOUI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '850') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '860' , 'KHARBOUCH Mounir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '860') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '179' , 'LAHTOUTE Marouan' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '179') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '168' , 'BERRADA Hind' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '168') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '481' , 'MERZOUK Aziz' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '481') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '840' , 'HMIDI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '840') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '890' , 'CHARI Naima' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '890') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '812' , 'ZOUHADIYassine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '812') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '750' , 'KADIRI Mustapha' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '750') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '182' , 'Rachid CHOKRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '182') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '59' , 'CHEMLAL Fatima' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '59') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '61' , 'Houda AKANSOUS' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '61') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '895' , 'EL MADANI Boutaali' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '895') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '62' , 'Laila Lazrak' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '62') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '180' , 'BELARBI Boutaina' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '180') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '570' , 'MAHER Mustapha' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '570') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '705' , 'CHRAIBI Taib' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '705') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '845' , 'AHMADI Mohamed Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '845') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '991' , 'CALL CENTER' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '991') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '998' , 'Mme LaÃ¯la Lazrak' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '998') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '620' , 'Mastaki Sanaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '620') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '622' , 'Boucetta Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '622') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '624' , 'ISLAH MOHAMED' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '624') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '630' , 'BELYMAN Mohamed Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '630') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '626' , 'BAALAOUI Hanane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '626') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '640' , 'RAJRAJI ChouaÃ¯b' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '640') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '445' , 'KHABAR MEHDI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '445') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '970' , 'TEYBANI Ghizlane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '970') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '973' , 'JALANI Rachida' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '973') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '975' , 'TAZI Amal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '975') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '977' , 'MARHOUM SanaÃ¢' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '977') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '30' , 'NEZHA NAJMAOUI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '30') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '995' , 'Maxi Phone' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '995') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '64' , 'Lamia Safraoui' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '64') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '760' , 'COROLLEUR Sylvie' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '760') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '788' , 'REZKI Latifa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '788') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '963' , 'Amina HACHIM' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '963') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '971' , 'ZIALE Walid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '971') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '154' , 'LAHLOU Khalid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '154') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '156' , 'ROUCHDY Siham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '156') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '972' , 'SIFY Younes' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '972') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '65' , 'SEFRIOUI Lamia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '65') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '974' , 'ESSALEH Imane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '974') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '161' , 'TAOUDI Sana' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '161') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '164' , 'ALIOUI Rachid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '164') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '446' , 'KHABBAZ Driss' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '446') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '817' , 'GHSSAINE Jamal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '817') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '650' , 'ABOUZEID Yasmine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '650') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '655' , 'ALAOUI Hicham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '655') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '670' , 'AWAB Sara' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '670') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '660' , 'TAIBI Hicham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '660') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '680' , 'BATTAL Saadia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '680') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '992' , 'ADWEB' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '992') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '980' , 'BRUAL Thierry' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '980') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '825' , 'IDIANE Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '825') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '210' , 'KOUTARI El Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '210') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '214' , 'RAJI Lamia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '214') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '216' , 'MOUTI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '216') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '218' , 'MARRAKCHI Med Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '218') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '66' , 'LAAMIR Sarah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '66') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '993' , 'TAZI Amal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '993') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '994' , 'BENKHADDA Ghizlane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '994') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '996' , 'Mohamed EUHAIK' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '996') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '76' , 'REZKI Omar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '76') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '215' , 'HAMDI Daoudi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '215') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '220' , 'KHENBOUBI Issam' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '220') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '222' , 'MAROUANE Abdelkebir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '222') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '226' , 'NHILA Aziz' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '226') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '224' , 'HIYAJ Imane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '224') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '350' , 'ICHEGHCHAOUI Youssef' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '350') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '352' , 'TARGUILY Taoufik' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '352') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '328' , 'MOUKTAD ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '328') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '238' , 'EL MOUJAHID Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '238') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '240' , 'EL GHAZLANI Abdellah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '240') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '270' , 'ABBADI Ahmed Mounir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '270') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '250' , 'HAJIB BOUAMRI Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '250') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '260' , 'TAOUKIL Hicham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '260') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '280' , 'MAHDI Mohamed Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '280') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '300' , 'BENAISSA Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '300') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '485' , 'MOKHTARI Morad' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '485') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '450' , 'BOUALAM Youness' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '450') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '455' , 'CHABABE Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '455') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '332' , 'MANA Khadija' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '332') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '310' , 'SAHRAOUI Omar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '310') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '320' , 'CHAHBI Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '320') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '325' , 'LACHHAB Mustapha' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '325') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '330' , 'CHAHBI Abderrahman' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '330') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '335' , 'ELMRAH Youssef' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '335') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '305' , 'AZEF Zakaria' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '305') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '340' , 'SERDOUK Abdellah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '340') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '345' , 'TOUILTA Rabie' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '345') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '336' , 'TAHRI Hamza' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '336') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '342' , 'HANINE Abdelilah' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '342') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '338' , 'NOUQATI Tarik' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '338') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '355' , 'ABOULKHAIRAT Nadia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '355') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '360' , 'MABROUR Fatim Zahra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '360') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '365' , 'EL AZZOUZI Bahaeddine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '365') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '370' , 'MAZOUNI Ouarda' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '370') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '375' , 'BOUBAKRI Hafsa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '375') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '380' , 'RHOZZI Nabil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '380') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '387' , 'Bekouchi Ousama' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '387') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '385' , 'Mounia BENKANIA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '385') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '390' , 'Laraki Mohamed Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '390') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '805' , 'OULAD Lahoucine Faress' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '805') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '835' , 'ELOUAZANI Lahoucine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '835') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '326' , 'BOHTEY FayÃ§al' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '326') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '997' , 'Televente Telecontact' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '997') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '312' , 'EL BOUANANI Amira' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '312') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '314' , 'DAYI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '314') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '740' , 'LAROUSSINIE Raoul' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '740') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '307' , 'AITBRAIM Fouad' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '307') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '308' , 'MOULNAKHLAMohamed Ikbal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '308') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '317' , 'BOUGHALEB El Ghali' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '317') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '318' , 'EL YACOUBI Zineb' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '318') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '322' , 'MOUNCHIT Zakaria' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '322') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '989' , 'Televente 2' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '989') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '337' , 'SNOUSSI Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '337') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '339' , 'RAMZI Rabab' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '339') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '341' , 'OUHLAL Ibtissam' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '341') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '45' , 'MANSOUR Jamil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '45') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '313' , 'TANGI Houda' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '313') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '319' , 'ENNAJI Abdeljalil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '319') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '321' , 'FILALI Ghita' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '321') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '55' , 'EL QANDIL Souhail' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '55') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '323' , 'FARID Imane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '323') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '324' , 'BOUTAYBA RIDA' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '324') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '327' , 'BAKRIM Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '327') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '353' , 'BERDAI IsmaÃ¯l' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '353') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '354' , 'NSIAS Nabil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '354') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '68' , 'BERRADA Achraf' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '68') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '356' , 'EL KOUHLANI Adil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '356') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '357' , 'IDRISSI BOUTAYBI Chaimaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '357') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '372' , 'AABOUCHE Adnan' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '372') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '765' , 'CHARAFEDDINE Zakaria' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '765') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '377' , 'Nabil LAKSIR' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '377') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '374' , 'Alaoui Mdarhri Youssef' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '374') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '333' , 'HARROUCH Zineb' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '333') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '391' , 'ELAMRANI Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '391') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '392' , 'BENKIRAN Yousra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '392') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '393' , 'HALOUANI Imad' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '393') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '394' , 'SALLIH Fatima Zahra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '394') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '432' , 'KBIRI ALAOUI Younes' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '432') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '361' , 'HASSOUNI Hassan' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '361') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '362' , 'ELHARTI Sara' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '362') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '363' , 'ELKHALIDI Asmaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '363') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '67' , 'SIDKI Asmaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '67') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '397' , 'AQACHMAR Zineb' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '397') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '398' , 'CHADILI Bouchra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '398') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '379' , 'SAHRAOU Mohamed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '379') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '364' , 'Tchaghtchougha Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '364') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '366' , 'Kara Naciri Samia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '366') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '35' , 'MOUTAOUAKIL Mbarke' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '35') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '33' , 'BENHLAL Karim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '33') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '382' , 'AOUED Jihane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '382') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '384' , 'SAYDY Imane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '384') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '386' , 'KRIM Sara' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '386') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '373' , 'BENHRA Reda' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '373') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '383' , 'BINEBINE Othmane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '383') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '376' , 'CHBIHI Jihane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '376') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '255' , 'AIT EL MAJDOUB Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '255') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '315' , 'RHONI Hicham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '315') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '395' , 'SAMIR Sanaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '395') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '381' , 'ERRABAH Amina' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '381') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '388' , 'GARICH Kamilia' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '388') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '987' , 'Televente Kompass' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '987') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '396' , 'SAQI Omar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '396') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '399' , 'BOUARGANE Mohamed Badr' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '399') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '155' , 'LAZAAR Nabil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '155') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '378' , 'LEMCHAHHER Fatima Zahra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '378') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '344' , 'SALOUANE Salah Eddine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '344') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '346' , 'YOUSFI Salma' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '346') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '347' , 'OUARAR Faime Zahra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '347') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '348' , 'HICHY Adnane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '348') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '349' , 'BOUCHRAOUI Jihad' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '349') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '358' , 'NASSIR Kamal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '358') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '510' , 'BAALI Younes' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '510') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '520' , 'EL OUAZZANI Ilham' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '520') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '166' , 'LAHRICHI Karim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '166') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '144' , 'RKHA Maria' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '144') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '145' , 'OUKBICH BENSALAH Reda' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '145') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '433' , 'ZINE Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '433') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '369' , 'ECHAABI Ihsane' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '369') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '170' , 'BOUABDALLAHAmine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '170') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '837' , 'KHATTOU Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '837') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '157' , 'ABARAGH Ahmed' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '157') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '940' , 'ANNOUNE Amine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '940') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '945' , 'BELAHMER Bachir' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '945') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '367' , 'BENJELLOUN Abdelaziz' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '367') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '368' , 'MESKABI Tarek' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '368') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '371' , 'ESSAKHAR Sarra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '371') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '40' , 'TSOULI Kamal' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '40') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '334' , 'HAZZAZ Tahar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '334') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '331' , 'MOSSADAQ El Mehdi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '331') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '978' , 'Ahlam JAMRI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '978') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '979' , 'Aziz AHMADI' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '979') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '158' , 'NASIRI Ibrahim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '158') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '351' , 'EL KHALIDI Asmaa' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '351') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '359' , 'BOULHANA Rachida' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '359') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '530' , 'AITHADDOU Ilyas' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '530') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '389' , 'BACHIRI Rachid' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '389') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '585' , 'GHODRI Yacine' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '585') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '976' , 'BELKHOUYA Ahmed said' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '976') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '422' , 'RASSAM Samy' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '422') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '758' , 'FARIS Jamila' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '758') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '759' , 'Mohamed Hilaoui' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '759') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '761' , 'Lamia MANANE' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '761') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '762' , 'DEBBAOUI Youness' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '762') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '988' , 'ALAMI Fatima Zohra' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '988') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '304' , 'JALANI Karim' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '304') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '306' , 'JAMAL Saloua' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '306') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '309' , 'HARROUCH Khadija' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '309') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '303' , 'ARGAZ Intissar' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '303') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '54' , 'AHMADI Lachmi' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '54') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '672' , 'EL BASRI Youssef' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '672') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '302' , 'BOURHID Nabil' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '302') limit 1;
INSERT INTO `courtier`(`code`, `nom_courtier`) SELECT
 '26' , 'Nouveaux Vendeurs' FROM courtier WHERE NOT EXISTS
  (SELECT code FROM courtier WHERE code = '26') limit 1;
delete from courtier where code='00'