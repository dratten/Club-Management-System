
--seed admin roles table--

TRUNCATE TABLE `adminroles`;

INSERT INTO `adminroles` (`roleID`, `roleName`) VALUES
(1, 'Dean of Students'),
(2, 'Administrative Assistant, DoS Office'),
(3, 'Deputy President, Students'' Council');

--end seed admin roles table--

--seed first admin--
TRUNCATE TABLE `admin`;

INSERT INTO `admin` (`staffID`, `firstName`, `lastName`, `userName`, `phone`, `suEmail`, `gender`, `roleID`, `status`, `password`, `dateRegistered`, `updated`, `deleted`) VALUES
(1426, 'Michael', 'Owiti', 'mowiti', '', 'mowiti@strathmore.edu', 'Male', 2, 1, '3299d4f6644e31f09f57666d18324b5d', '2017-04-04 01:10:49', '2017-04-26 09:57:30', 0),
(2247, 'Richard', 'Omoka', 'romoka', '0703034111', 'romoka@strathmore.edu', 'Male', 2, 1, '', '2017-04-26 16:38:16', '2017-04-26 16:38:16', 0);
--end seed first admin--


--seed clubs table--
TRUNCATE TABLE `clubs`;


INSERT INTO `clubs` (`clubID`, `clubName`, `yearStarted`, `yearRebranded`, `registrationFee`, `registrationBasis`, `dateRegistered`, `status`, `updated`, `password`) VALUES
('actuarialclub@strathmore.edu', 'Strathmore Actuarial Students Society', NULL, NULL, '100', 'Per Year', '2017-01-27 23:21:59', 1, '2017-02-28 09:26:17', '69323bc65c7740947dea93e51b47f385'),
('aiesec@strathmore.edu', 'AIESEC Strathmore', NULL, NULL, '500', 'Per Year', '2017-01-27 16:23:02', 1, '2017-04-25 16:23:43', '92135c4a4e95363d1e0bb1f7359b4ff9'),
('artclub@strathmore.edu', 'QALIZASANAA', NULL, NULL, '100', 'Per Year', '2017-01-27 23:20:17', 1, '2017-03-06 14:51:20', 'c95f0d4dccd345f5fcaf175f0acc3ae1'),
('businessclub@strathmore.edu', 'Strathmore Business Club', NULL, NULL, '500', 'Per Year', '2017-01-27 23:23:14', 1, '2017-02-28 16:52:37', '54d9bff7f7c4109a2ad069763e73ef23'),
('chineseclub@strathmore.edu', 'Chinese Club', NULL, NULL, '100', 'Per Year', '2017-02-02 04:19:27', 1, '2017-04-25 09:32:08', '547fb8b9ff9a23eab4cf0938729d80d5'),
('chorale@strathmore.edu', 'Strathmore Chorale', NULL, NULL, '300', 'Per Semester', '2017-01-27 16:22:27', 1, '2017-01-27 16:22:27', '71ac79a21ccf24d0840e9dc333e0f4bf'),
('debateclub@strathmore.edu', 'Strathmore Debate Society', NULL, NULL, '100', 'Per Year', '2017-01-27 16:21:41', 1, '2017-01-27 23:06:59', 'df500c4eaaf6f4c8b8bfdaa93f5f68d9'),
('deutschklub@strathmore.edu', 'Deutschklub', NULL, NULL, '100', 'Per Year', '2017-01-27 23:00:30', 1, '2017-03-26 07:51:56', '5916550a0d72782f22161c0555af9ef1'),
('enactus@strathmore.edu', 'Enactus Strathmore', NULL, NULL, '100', 'Per Year', '2017-01-27 23:09:38', 1, '2017-03-06 14:54:30', '5f0ceed7276128e9b7a954b95eb276b6'),
('firstaidclub@strathmore.edu', 'First Aid Club', NULL, NULL, '100', 'Per Year', '2017-02-02 04:18:37', 1, '2017-03-06 16:17:11', '78d94bdc2f1cf4579a6d7e2e0e8badc0'),
('frenchclub@strathmore.edu', 'Les Francophones de Strathmore University', NULL, NULL, '100', 'Per Year', '2017-01-27 23:17:13', 1, '2017-04-07 15:21:55', 'f6925ffaa75290c5bf4ca933163033ef'),
('japaneseclub@strathmore.edu', 'Japanese Club', NULL, NULL, '100', 'Per Year', '2017-01-27 23:12:25', 1, '2017-03-06 14:54:33', 'f0da70c8d0346d6ee021ee795433c6b1'),
('kmun@strathmore.edu', 'Kenya Model United Nations', NULL, NULL, '100', 'Per Year', '2017-01-27 23:13:11', 1, '2017-03-06 14:51:49', '1394c1cdb0216a638dffc394672cfe03'),
('readingclub@strathmore.edu', 'Reading Club', NULL, NULL, '100', 'Per Year', '2017-01-31 05:11:50', 1, '2017-03-06 14:51:26', 'db7dce89e5b8ecd3e5691073cb89c024'),
('researchclub@strathmore.edu', 'Strathmore Research Club', NULL, 2014, '100', 'Per Year', '2017-04-05 15:00:41', 1, '2017-04-19 05:54:07', '348bcae8e7c659c9c5e5e54a4b02e27d'),
('sep@strathmore.edu', 'Student Enterprise Program', NULL, NULL, '100', 'Per Year', '2017-01-27 23:24:26', 1, '2017-03-20 10:10:23', '1b286d56116ffd32c7a2c0272e0b8c7e'),
('shrec@strathmore.edu', 'Strathmore University Human Resource Club', NULL, NULL, '100', 'Per Year', '2017-01-27 23:25:20', 1, '2017-04-19 10:37:39', '21207a884ca7c27e790f714422092e0a'),
('spanishclub@strathmore.edu', 'El Club', NULL, NULL, '100', 'Per Year', '2017-01-27 23:34:08', 1, '2017-03-06 14:54:25', '315387bcc5b55816504e9b62d1beb710'),
('strathmoredramasociety@strathmore.edu', 'DRAMSOC ', NULL, NULL, '100', 'Per Year', '2017-02-09 18:14:52', 1, '2017-03-06 14:54:19', '4505736f97f301f347a0c4db8714e815'),
('strathmoreenvironmentalclub@strathmore.edu', 'Strathmore Environmental Club', NULL, NULL, '100', 'Per Year', '2017-02-13 08:04:33', 1, '2017-02-13 08:04:33', 'e986d31f6ba5840f498d939e0697556b'),
('suffesa@strathmore.edu', 'SUFFESA', NULL, NULL, '100', 'Per Year', '2017-01-27 23:29:57', 1, '2017-04-07 15:46:45', 'e0b981527493b88a9b52ae72ddd95e48'),
('suitsa@strathmore.edu', 'Strathmore University Information Technology Students Association', NULL, NULL, '100', 'Per Year', '2017-01-27 17:13:01', 1, '2017-03-06 14:54:40', 'a3d71735c8a1acab75f998e67e611ba9'),
('sumediagroup@strathmore.edu', 'Strathmore University Media Group', NULL, NULL, '300', 'Per Year', '2017-01-27 23:39:25', 1, '2017-01-27 23:39:25', '887be8d0168db6cb7e2a9cd8f6de4acf'),
('theband@strathmore.edu', 'Strathmore University Band', NULL, NULL, '100', 'Per Year', '2017-01-27 23:31:50', 1, '2017-03-01 18:13:40', '3a0c94aa2ad18ef75ea99f634be9010b'),
('toastmasters@strathmore.edu', 'Strathmore Toastmasters Gavel Club', 2016, NULL, '1500', 'Per Year', '2017-04-27 10:59:00', 1, '2017-04-27 10:59:00', '9af8f1e9bb54f3a281bc706854c30c3f');

--end seed clubs table--


--seed clubroles table--
TRUNCATE TABLE `clubroles`;

INSERT INTO `clubroles` (`roleID`, `roleName`, `description`) VALUES
(1, 'Patron', 'Directs and advises the club'),
(2, 'President', 'In overall charge of the club'),
(3, 'Deputy President', 'Assists the club president'),
(4, 'Secretary', 'In charge of club records'),
(5, 'Treasurer', 'In charge of club funds'),
(6, 'Organizing Secretary', 'Organizing club events'),
(7, 'Assistant Organizing Secretary', 'Supports the Organizing Secretary in his/her duties'),
(8, 'Marketing Director ', 'In charge of all club marketing'),
(9, 'Assistant Marketing Director', 'Supports the marketing director'),
(10, 'Public Relations Officer', 'In charge of all public relations'),
(11, 'Human Resource Officer', 'Helps acquire best talent to join the club'),
(12, 'Special Projects Coordinator', 'Guides and directs club projects'),
(13, 'Club Activities Cordinator', 'Coordinate Club activities'),
(14, 'Research Representative', ''),
(15, 'VP Finance', ''),
(16, 'VP Performance Managment', ''),
(17, 'VP Brand and Customer Experience', ''),
(18, 'VP Partnership Development', ''),
(19, 'VP Incoming Global Enterprenuer', ''),
(20, 'VP Outgoing Exchange', ''),
(21, 'VP Incoming Global Volunteer', '');
--end seed clubroles table--



--seed courses table--
TRUNCATE TABLE `courses`;


INSERT INTO `courses` (`courseID`, `courseName`, `faculty`) VALUES
('ACCA', 'Association of Chartered Certified Accountant', 'School of Accountancy'),
('BA-Comm', 'Bachelor of Arts in Communication', 'School of Humanities and Social Sciences'),
('BA-Dev.S&P', 'Bachelor of Arts in Development Studies and Philosophy', 'School of Humanities and Social Sciences'),
('BA-Int.St', 'Bachelor of Arts in International Studies', 'School of Humanities and Social Sciences'),
('BBIT', 'Bachelor of Business Information Technology', 'Faculty of Information Technology'),
('BBS-FE', 'Business Science in Financial Economics', 'Strathmore Institute of Mathematical Sciences'),
('BBS-FIN', 'Bachelor of Business Science in Finance', 'Strathmore Institute of Mathematical Sciences'),
('BCOM', 'Bachelor of Commerce', 'School of Management and Commerce'),
('BHM', 'Bachelor of Hospitality Management', 'School of Hospitality'),
('BIF', 'Bachelor of Science in  Informatics and Computer Science', 'Faculty of Information Technology'),
('BTC', 'Bachelor of Science in Telecommunications', 'Faculty of Information Technology'),
('CIM', 'Chartered Institute of Marketing', 'School of Management and Commerce'),
('CPA', 'Certified Public Accountants', 'School of Accountancy'),
('DBIT', 'Diploma in Information Technology', 'Faculty of Information Technology'),
('DBM', 'Diploma in Business Management', 'School of Management and Commerce'),
('ICS', 'ICS', 'FIT'),
('LLB', 'Bachelor of Laws', 'Law School'),
('MSc.IT', 'Master of Science in Information Technology', 'Faculty of Information Technology');

--end seed courses table--


--seed clubmembers table--
TRUNCATE TABLE `clubmembers`;

INSERT INTO `clubmembers` (`pID`, `suID`, `firstName`, `lastName`, `gender`, `suEmail`, `clubID`, `courseID`, `telNo`, `dateRegistered`, `payment`, `status`, `updated`, `deletionStatus`, `password`, `leadership`, `roleID`, `nominated`, `membership`) VALUES
(1, 84907, 'Cynthia', 'Mutuku', 'Female', 'cynthia.mutuku@strathmore.edu', 'researchclub@strathmore.edu', 'BCOM', '0702037727', '2017-04-26 11:22:32', 1, 1, '2017-04-26 11:02:00', 0, '', 1, 2, 1, 1),
(2, 83785, 'Arafa', 'Ndope', 'Female', 'arafa.ndope@strathmore.edu', 'aiesec@strathmore.edu', 'BTC', '0702866036', '2017-04-26 11:27:29', 0, 1, '2017-04-26 08:46:38', 0, '', 0, NULL, 1, 1),
(3, 82922, 'Alex', 'Osunga', 'Male', 'alex.osunga@strathmore.edu', 'strathmoreenvironmentalclub@strathmore.edu', 'BBIT', '0711416998', '2017-04-26 11:31:01', 0, 1, '2017-04-26 08:46:42', 0, '', 0, NULL, 1, 1),
(4, 94766, 'Angelica', 'Ogutu', 'Female', 'angelika.ogutu@strathmore.edu', 'spanishclub@strathmore.edu', 'BCOM', '0797379869', '2017-04-26 11:41:23', 0, 1, '2017-04-26 08:46:46', 0, '', 0, NULL, 1, 1),
(5, 8322, 'Jane Immaculate', 'Njoroge', 'Female', 'immaculate.njoroge@strathmore.edu', 'chineseclub@strathmore.edu', 'BBS-FE', '0739587097', '2017-04-26 11:44:04', 0, 1, '2017-04-26 08:46:54', 0, '', 0, NULL, 1, 1),
(6, 89125, 'Brian', 'Kimani', 'Male', 'brian.kimani@strathmore.edu', 'suitsa@strathmore.edu', 'BBIT', '0705243137', '2017-04-26 11:46:06', 0, 1, '2017-04-26 08:47:02', 0, '', 0, NULL, 1, 1),
(7, 78410, 'Anthony', 'Mwathi', 'Male', 'mwathiantonyit@gmail.com', 'japaneseclub@strathmore.edu', 'BBIT', '0771568843', '2017-04-26 11:49:00', 0, 1, '2017-04-26 08:49:00', 0, '', 0, NULL, 1, 1),
(8, 78269, 'Emilly', 'Gatobu', 'Female', 'emily.gatobu@strathmore.edu', 'businessclub@strathmore.edu', 'BCOM', '0703612289', '2017-04-26 11:51:56', 0, 1, '2017-04-28 12:27:36', 0, '', 1, 2, 0, 1),
(9, 94919, 'Trevor', 'Mukwaya', 'Male', 'trevor.mukwaya@gmail.com', 'chorale@strathmore.edu', 'BIF', '0790543878', '2017-04-26 11:56:36', 0, 1, '2017-04-26 08:56:36', 0, '', 0, NULL, 1, 1),
(10, 72862, 'Michael', 'Omugah', 'Male', 'michael.omugah@strathmore.edu', 'strathmoredramasociety@strathmore.edu', 'BCOM', '0708001115', '2017-04-26 11:58:27', 0, 1, '2017-04-26 08:59:02', 0, '', 0, NULL, 1, 1),
(11, 83329, 'Sandra', 'Ngaire', 'Female', 'sandra.ngaire@strathmore.edu', 'readingclub@strathmore.edu', 'BCOM', '0716387013', '2017-04-26 12:01:24', 0, 1, '2017-04-26 09:01:24', 0, '', 0, NULL, 1, 1),
(12, 89257, 'Fred', 'Muthusi', 'Male', 'fred.muthusi@strathmore.edu', 'kmun@strathmore.edu', 'LLB', '0725931506', '2017-04-26 12:03:20', 0, 1, '2017-04-26 09:03:20', 0, '', 0, NULL, 1, 1),
(13, 83563, 'Sandra', 'Barasa', 'Female', 'sandra.akochi@strathmore.edu', 'suffesa@strathmore.edu', 'BBS-FIN', '0700283404', '2017-04-26 12:05:55', 0, 1, '2017-04-26 09:06:21', 0, '', 0, NULL, 1, 1),
(14, 88354, 'Brigid', 'Mose', 'Male', 'bridgid.gesare@strathmore.edu', 'frenchclub@strathmore.edu', 'LLB', '0719747486', '2017-04-26 12:08:12', 0, 1, '2017-04-26 09:08:12', 0, '', 0, NULL, 1, 1),
(15, 78581, 'Stephen', 'Mokoro', 'Male', 'stephen.mokoro@strathmore.edu', 'researchclub@strathmore.edu', 'BBIT', '0719508386', '2017-04-26 14:03:41', 0, 1, '2017-05-02 04:08:44', 0, '', 1, 2, 1, 1),
(17, 83578, 'Karanja', 'Ng''ang''a', 'Male', 'wilfred.ng''ang''a715@strathmore.edu', 'toastmasters@strathmore.edu', 'BCOM', '0729665914', '2017-04-27 11:03:56', 0, 1, '2017-04-27 08:03:56', 0, '', 0, NULL, 1, 1),
(18, 75500, 'Lilian', 'Warutere', 'Female', 'lilywarutere@gmail.com', 'sumediagroup@strathmore.edu', 'BCOM', '0702200222', '2017-04-27 16:28:44', 0, 1, '2017-04-27 13:28:44', 0, '', 0, NULL, 1, 1),
(19, 82659, 'Cicily', 'Muriuki', 'Female', 'cicily.wangu@strathmore.edu', 'businessclub@strathmore.edu', 'BCOM', '0720354735', '2017-04-28 15:32:19', 1, 1, '2017-05-02 04:12:13', 0, '5d9521675536e816475162ee819b0a0c', 0, NULL, 0, 1);

--end seed clubmembers--
