DELETE FROM `officialsroles` WHERE `studentID`=83223;
DELETE FROM `clubofficials` WHERE `studentID`=83223;

INSERT INTO `clubmembers` (`pID`, `suID`, `firstName`, `lastName`, `gender`, `suEmail`, `clubID`, `courseID`, `telNo`, `dateRegistered`, `payment`, `status`, `updated`, `deletionStatus`, `password`, `leadership`, `roleID`, `nominated`, `membership`) VALUES (NULL, '83223', 'Jane', 'Njoroge', 'Female', 'immaculate.njoroge@strathmore.edu', 'chineseclub@strathmore.edu', 'BBS-FE', '0739587097', '0000-00-00 00:00:00.000000', '0', '1', '0000-00-00 00:00:00.000000', '0', '', '0', NULL, '1', '1');

INSERT INTO `clubmembers` (`pID`, `suID`, `firstName`, `lastName`, `gender`, `suEmail`, `clubID`, `courseID`, `telNo`, `dateRegistered`, `payment`, `status`, `updated`, `deletionStatus`, `password`, `leadership`, `roleID`, `nominated`, `membership`) VALUES (NULL, '84598', 'Mitchelle', 'Morema', 'Female', 'moremamitchelle@gmail.com', 'businessclub@strathmore.edu', 'BCOM', '0712238140', '0000-00-00 00:00:00.000000', '0', '1', '0000-00-00 00:00:00.000000', '0', '', '0', NULL, '1', '1');

