-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2015 at 05:27 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `refugee`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `actions_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`actions_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`actions_id`, `menu_id`, `name`, `value`) VALUES
(1, 1, 'View', 3),
(56, 31, 'Add', 1),
(6, 11, 'View', 3),
(7, 31, 'Edit', 2),
(53, 28, 'Add', 1),
(54, 28, 'Edit', 2),
(55, 28, 'View', 3),
(57, 31, 'View', 3),
(112, 54, 'View', 3),
(118, 55, 'Add', 1),
(167, 28, 'View Profile', 5);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `native` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `accepted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=199 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `nationality`, `native`, `accepted`) VALUES
(1, 'Afghanistan', 'Afghan', 'No', 'Yes'),
(2, 'Albania', 'Albanian', 'No', 'Yes'),
(3, 'Algeria', 'Algerian', 'No', 'Yes'),
(4, 'Andorra', 'Andorran', 'No', 'Yes'),
(5, 'Angola', 'Angolan', 'No', 'Yes'),
(6, 'Antigua and Barbuda', 'Antiguans, Barbudans', 'No', 'Yes'),
(7, 'Argentina', 'Argentinean', 'No', 'Yes'),
(8, 'Armenia', 'Armenian', 'No', 'Yes'),
(9, 'Australia', 'Australian', 'Yes', 'Yes'),
(10, 'Austria', 'Austrian', 'No', 'Yes'),
(11, 'Azerbaijan', 'Azerbaijani', 'No', 'Yes'),
(12, 'The Bahamas', 'Bahamian', 'No', 'Yes'),
(13, 'Bahrain', 'Bahraini', 'No', 'Yes'),
(14, 'Bangladesh', 'Bangladeshi', 'No', 'Yes'),
(15, 'Barbados', 'Barbadian', 'No', 'Yes'),
(16, 'Belarus', 'Belarusian', 'No', 'Yes'),
(17, 'Belgium', 'Belgian', 'No', 'Yes'),
(18, 'Belize', 'Belizean', 'No', 'Yes'),
(19, 'Benin', 'Beninese', 'No', 'Yes'),
(20, 'Bhutan', 'Bhutanese', 'No', 'Yes'),
(21, 'Bolivia', 'Bolivian', 'No', 'Yes'),
(22, 'Bosnia', 'Bosnian', 'No', 'Yes'),
(23, 'Botswana', 'Motswana (singular), Batswana (plural)', 'No', 'Yes'),
(24, 'Brazil', 'Brazilian', 'No', 'Yes'),
(25, 'Brunei', 'Bruneian', 'No', 'Yes'),
(26, 'Bulgaria', 'Bulgarian', 'No', 'Yes'),
(27, 'Burkina Faso', 'Burkinabe', 'No', 'Yes'),
(28, 'Burundi', 'Burundian', 'No', 'Yes'),
(29, 'Cambodia', 'Cambodian', 'No', 'Yes'),
(30, 'Cameroon', 'Cameroonian', 'No', 'Yes'),
(31, 'Canada', 'Canadian', 'Yes', 'Yes'),
(32, 'Cape Verde', 'Cape Verdian', 'No', 'Yes'),
(33, 'Central African Republic', 'Central African', 'No', 'Yes'),
(34, 'Chad', 'Chadian', 'No', 'Yes'),
(35, 'Chile', 'Chilean', 'No', 'Yes'),
(36, 'China', 'Chinese', 'No', 'Yes'),
(37, 'Colombia', 'Colombian', 'No', 'Yes'),
(38, 'Comoros', 'Comoran', 'No', 'Yes'),
(39, 'Congo, Republic of the', 'Congolese', 'No', 'Yes'),
(40, 'Congo, Democratic Republic of the', 'Congolese', 'No', 'Yes'),
(41, 'Costa Rica', 'Costa Rican', 'No', 'Yes'),
(42, 'Cote d''Ivoire', 'Ivorian', 'No', 'Yes'),
(43, 'Croatia', 'Croatian', 'No', 'Yes'),
(44, 'Cuba', 'Cuban', 'No', 'Yes'),
(45, 'Cyprus', 'Cypriot', 'No', 'Yes'),
(46, 'Czech Republic', 'Czech', 'No', 'Yes'),
(47, 'Denmark', 'Danish', 'No', 'Yes'),
(48, 'Djibouti', 'Djibouti', 'No', 'Yes'),
(49, 'Dominica', 'Dominican', 'No', 'Yes'),
(50, 'Dominican Republic', 'Dominican', 'No', 'Yes'),
(51, 'East Timor', 'East Timorese', 'No', 'Yes'),
(52, 'Ecuador', 'Ecuadorean', 'No', 'Yes'),
(53, 'Egypt', 'Egyptian', 'No', 'Yes'),
(54, 'El Salvador', 'Salvadoran', 'No', 'Yes'),
(55, 'Equatorial Guinea', 'Equatorial Guinean', 'No', 'Yes'),
(56, 'Eritrea', 'Eritrean', 'No', 'Yes'),
(57, 'Estonia', 'Estonian', 'No', 'Yes'),
(58, 'Ethiopia', 'Ethiopian', 'No', 'Yes'),
(59, 'Fiji', 'Fijian', 'No', 'Yes'),
(60, 'Finland', 'Finnish', 'No', 'Yes'),
(61, 'France', 'French', 'No', 'Yes'),
(62, 'Gabon', 'Gabonese', 'No', 'Yes'),
(63, 'The Gambia', 'Gambian', 'No', 'Yes'),
(64, 'Georgia', 'Georgian', 'No', 'Yes'),
(65, 'Germany', 'German', 'No', 'Yes'),
(66, 'Ghana', 'Ghanaian', 'No', 'Yes'),
(67, 'Greece', 'Greek', 'No', 'Yes'),
(68, 'Grenada', 'Grenadian', 'No', 'Yes'),
(69, 'Guatemala', 'Guatemalan', 'No', 'Yes'),
(70, 'Guinea', 'Guinean', 'No', 'Yes'),
(71, 'Guinea-Bissau', 'Guinea-Bissauan', 'No', 'Yes'),
(72, 'Guyana', 'Guyanese', 'No', 'Yes'),
(73, 'Haiti', 'Haitian', 'No', 'Yes'),
(74, 'Honduras', 'Honduran', 'No', 'Yes'),
(75, 'Hungary', 'Hungarian', 'No', 'Yes'),
(76, 'Iceland', 'Icelander', 'No', 'Yes'),
(77, 'India', 'Indian', 'No', 'Yes'),
(78, 'Indonesia', 'Indonesian', 'No', 'Yes'),
(79, 'Iran', 'Iranian', 'No', 'Yes'),
(80, 'Iraq', 'Iraqi', 'No', 'Yes'),
(81, 'Ireland', 'Irish', 'Yes', 'Yes'),
(82, 'Israel', 'Israeli', 'No', 'Yes'),
(83, 'Italy', 'Italian', 'No', 'Yes'),
(84, 'Jamaica', 'Jamaican', 'No', 'Yes'),
(85, 'Japan', 'Japanese', 'No', 'Yes'),
(86, 'Jordan', 'Jordanian', 'No', 'Yes'),
(87, 'Kazakhstan', 'Kazakhstani', 'No', 'Yes'),
(88, 'Kenya', 'Kenyan', 'No', 'Yes'),
(89, 'Kiribati', 'I-Kiribati', 'No', 'Yes'),
(90, 'Korea, North', 'North Korean', 'No', 'Yes'),
(91, 'Korea, South', 'South Korean', 'No', 'Yes'),
(92, 'Kuwait', 'Kuwaiti', 'No', 'Yes'),
(93, 'Kyrgyz Republic', 'Kirghiz', 'No', 'Yes'),
(94, 'Laos', 'Laotian', 'No', 'Yes'),
(95, 'Latvia', 'Latvian', 'No', 'Yes'),
(96, 'Lebanon', 'Lebanese', 'No', 'Yes'),
(97, 'Lesotho', 'Mosotho', 'No', 'Yes'),
(98, 'Liberia', 'Liberian', 'No', 'Yes'),
(99, 'Libya', 'Libyan', 'No', 'Yes'),
(100, 'Liechtenstein', 'Liechtensteiner', 'No', 'Yes'),
(101, 'Lithuania', 'Lithuanian', 'No', 'Yes'),
(102, 'Luxembourg', 'Luxembourger', 'No', 'Yes'),
(103, 'Macedonia', 'Macedonian', 'No', 'Yes'),
(104, 'Madagascar', 'Malagasy', 'No', 'Yes'),
(105, 'Malawi', 'Malawian', 'No', 'Yes'),
(106, 'Malaysia', 'Malaysian', 'No', 'Yes'),
(107, 'Maldives', 'Maldivan', 'No', 'Yes'),
(108, 'Mali', 'Malian', 'No', 'Yes'),
(109, 'Malta', 'Maltese', 'No', 'Yes'),
(110, 'Marshall Islands', 'Marshallese', 'No', 'Yes'),
(111, 'Mauritania', 'Mauritanian', 'No', 'Yes'),
(112, 'Mauritius', 'Mauritian', 'No', 'Yes'),
(113, 'Mexico', 'Mexican', 'No', 'Yes'),
(114, 'Federated States of Micronesia', 'Micronesian', 'No', 'Yes'),
(115, 'Moldova', 'Moldovan', 'No', 'Yes'),
(116, 'Monaco', 'Monegasque', 'No', 'Yes'),
(117, 'Mongolia', 'Mongolian', 'No', 'Yes'),
(118, 'Morocco', 'Moroccan', 'No', 'Yes'),
(119, 'Mozambique', 'Mozambican', 'No', 'Yes'),
(120, 'Myanmar (Burma)', 'Burmese', 'No', 'Yes'),
(121, 'Namibia', 'Namibian', 'No', 'Yes'),
(122, 'Nauru', 'Nauruan', 'No', 'Yes'),
(123, 'Nepal', 'Nepalese', 'No', 'Yes'),
(124, 'Netherlands', 'Dutch', 'No', 'Yes'),
(125, 'New Zealand', 'New Zealander', 'Yes', 'Yes'),
(126, 'Nicaragua', 'Nicaraguan', 'No', 'Yes'),
(127, 'Niger', 'Nigerien', 'No', 'Yes'),
(128, 'Nigeria', 'Nigerian', 'No', 'Yes'),
(129, 'Norway', 'Norwegian', 'No', 'Yes'),
(130, 'Oman', 'Omani', 'No', 'Yes'),
(131, 'Pakistan', 'Pakistani', 'No', 'Yes'),
(132, 'Palau', 'Palauan', 'No', 'Yes'),
(133, 'Panama', 'Panamanian', 'No', 'Yes'),
(134, 'Papua New Guinea', 'Papua New Guinean', 'No', 'Yes'),
(135, 'Paraguay', 'Paraguayan', 'No', 'Yes'),
(136, 'Peru', 'Peruvian', 'No', 'Yes'),
(137, 'Philippines', 'Filipino', 'No', 'Yes'),
(138, 'Poland', 'Polish', 'No', 'Yes'),
(139, 'Portugal', 'Portuguese', 'No', 'Yes'),
(140, 'Qatar', 'Qatari', 'No', 'Yes'),
(141, 'Romania', 'Romanian', 'No', 'Yes'),
(142, 'Russia', 'Russian', 'No', 'Yes'),
(143, 'Rwanda', 'Rwandan', 'No', 'Yes'),
(144, 'Saint Kitts and Nevis', 'Kittian and Nevisian', 'No', 'Yes'),
(145, 'Saint Lucia', 'Saint Lucian', 'No', 'Yes'),
(146, 'Samoa', 'Samoan', 'No', 'Yes'),
(147, 'San Marino', 'Sammarinese', 'No', 'Yes'),
(148, 'Sao Tome and Principe', 'Sao Tomean', 'No', 'Yes'),
(149, 'Saudi Arabia', 'Saudi Arabian', 'No', 'No'),
(150, 'Senegal', 'Senegalese', 'No', 'Yes'),
(151, 'Serbia and Montenegro', 'Serbian', 'No', 'Yes'),
(152, 'Seychelles', 'Seychellois', 'No', 'Yes'),
(153, 'Sierra Leone', 'Sierra Leonean', 'No', 'Yes'),
(154, 'Singapore', 'Singaporean', 'No', 'Yes'),
(155, 'Slovakia', 'Slovak', 'No', 'Yes'),
(156, 'Slovenia', 'Slovene', 'No', 'Yes'),
(157, 'Solomon Islands', 'Solomon Islander', 'No', 'Yes'),
(158, 'Somalia', 'Somali', 'No', 'Yes'),
(159, 'South Africa', 'South African', 'Yes', 'Yes'),
(160, 'Spain', 'Spanish', 'No', 'Yes'),
(161, 'Sri Lanka', 'Sri Lankan', 'No', 'Yes'),
(162, 'Sudan', 'Sudanese', 'No', 'Yes'),
(163, 'Suriname', 'Surinamer', 'No', 'Yes'),
(164, 'Swaziland', 'Swazi', 'No', 'Yes'),
(165, 'Sweden', 'Swedish', 'No', 'Yes'),
(166, 'Switzerland', 'Swiss', 'No', 'Yes'),
(167, 'Syria', 'Syrian', 'No', 'Yes'),
(168, 'Taiwan', 'Taiwanese', 'No', 'Yes'),
(169, 'Tajikistan', 'Tadzhik', 'No', 'Yes'),
(170, 'Tanzania', 'Tanzanian', 'No', 'Yes'),
(171, 'Thailand', 'Thai', 'No', 'Yes'),
(172, 'Togo', 'Togolese', 'No', 'Yes'),
(173, 'Tonga', 'Tongan', 'No', 'Yes'),
(174, 'Trinidad and Tobago', 'Trinidadian', 'No', 'Yes'),
(175, 'Tunisia', 'Tunisian', 'No', 'Yes'),
(176, 'Turkey', 'Turkish', 'No', 'Yes'),
(177, 'Turkmenistan', 'Turkmen', 'No', 'Yes'),
(178, 'Tuvalu', 'Tuvaluan', 'No', 'Yes'),
(179, 'Uganda', 'Ugandan', 'No', 'Yes'),
(180, 'Ukraine', 'Ukrainian', 'No', 'Yes'),
(181, 'United Arab Emirates', 'Emirian', 'No', 'Yes'),
(182, 'United Kingdom', 'British', 'Yes', 'Yes'),
(183, 'United States', 'American', 'Yes', 'Yes'),
(184, 'Uruguay', 'Uruguayan', 'No', 'Yes'),
(185, 'Uzbekistan', 'Uzbekistani', 'No', 'Yes'),
(186, 'Vanuatu', 'Ni-Vanuatu', 'No', 'Yes'),
(187, 'Vatican City (Holy See)', 'none', 'No', 'Yes'),
(188, 'Venezuela', 'Venezuelan', 'No', 'Yes'),
(189, 'Vietnam', 'Vietnamese', 'No', 'Yes'),
(190, 'Yemen', 'Yemeni', 'No', 'Yes'),
(191, 'Zambia', 'Zambian', 'No', 'Yes'),
(192, 'Zimbabwe', 'Zimbabwean', 'No', 'Yes'),
(193, 'Palestine', 'Palestinian', 'No', 'Yes'),
(194, 'Herzegovina', 'Herzegovinian', 'No', 'Yes'),
(195, '', '0', '', ''),
(196, '', '0', '', ''),
(197, '', '0', '', ''),
(198, '', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_of_donation` date NOT NULL,
  `name_of_association` varchar(255) NOT NULL,
  `name_of_donator` varchar(255) NOT NULL,
  `what_was_donated_please_specify` varchar(255) NOT NULL,
  `name_aid_of_receiver_from` varchar(255) NOT NULL,
  `any_other_info` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `date_of_donation`, `name_of_association`, `name_of_donator`, `what_was_donated_please_specify`, `name_aid_of_receiver_from`, `any_other_info`, `month`, `year`, `created_date`) VALUES
(1, '2015-02-20', 'fdgd', 'gffdg', 'gfgsd', 'gdgdg', 'sdg', 'dgsdg', 'sdg', '2015-02-25 00:00:00'),
(2, '0000-00-00', 'fghfh', 'dfh', 'dfh', 'dfh', 'dfhf', 'February', '2012', '2015-02-14 05:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `home_visit`
--

CREATE TABLE IF NOT EXISTS `home_visit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_of_visit` date NOT NULL,
  `association_name` varchar(255) NOT NULL,
  `location_of_visit` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `full_name_of_family_visited` varchar(255) NOT NULL,
  `name_of_visitor_from_association` varchar(255) NOT NULL,
  `was_help_given` varchar(255) NOT NULL,
  `another_visit_short_reason` varchar(255) NOT NULL,
  `pictures_video_taken` varchar(255) NOT NULL,
  `any_other_information` varchar(255) NOT NULL,
  `special_case` varchar(255) NOT NULL,
  `special_case_more_info` varchar(255) NOT NULL,
  `level_of_need` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `home_visit`
--

INSERT INTO `home_visit` (`id`, `date_of_visit`, `association_name`, `location_of_visit`, `id_no`, `full_name_of_family_visited`, `name_of_visitor_from_association`, `was_help_given`, `another_visit_short_reason`, `pictures_video_taken`, `any_other_information`, `special_case`, `special_case_more_info`, `level_of_need`, `month`, `year`, `created_date`) VALUES
(1, '2035-11-07', 'jk', 'jk', 'jk', 'jk', 'jk', 'jk', 'jk', '0', 'k', '', 'k', '', 'October', '2016', '2015-02-14 06:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `menu_action`
--

CREATE TABLE IF NOT EXISTS `menu_action` (
  `menu_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller2` text COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theme` enum('school') COLLATE utf8_unicode_ci NOT NULL,
  `rights` enum('0','1','2','3','4','5','6','7','8','9','10','11','12') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0''=>''default'',''1''=>''add'',''2''=>''edit'',''3''=>''view'',''4''=>''delete'',''5''=>''edit_profile'',''6''=>''add_note'',''7''=>''view_own'',''8''=>''Male Photo'',''9''=>''Female Photo'',''10''=>''Male Student Photo'',''11''=>''Female Student Photo'',''12''=>''view_department_comment''',
  `is_active` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `is_display` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`menu_action_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=232 ;

--
-- Dumping data for table `menu_action`
--

INSERT INTO `menu_action` (`menu_action_id`, `menu_id`, `name`, `lang_name`, `controller`, `controller2`, `action`, `controller_action`, `theme`, `rights`, `is_active`, `is_display`, `display_order`) VALUES
(1, 1, 'Home', 'home', 'home', '', 'index', '', 'school', '3', '1', '1', 1),
(36, 11, 'Privilage', 'privilage', 'add_privilege', '', 'index', '', 'school', '3', '1', '1', 19),
(37, 31, 'List Role', 'list_role', 'list_role', '', 'index', '', 'school', '3', '1', '1', 17),
(38, 31, 'Add Role', 'add_role', 'list_role', '', 'add', '', 'school', '1', '1', '0', 0),
(39, 31, 'Edit Role', 'edit_role', 'list_role', '', 'edit', '', 'school', '2', '1', '0', 0),
(40, 28, 'List User', 'list_user', 'list_user', '', 'index', '', 'school', '3', '1', '1', 18),
(41, 28, 'Add User', 'add_user', 'list_user', '', 'add', '', 'school', '1', '1', '0', 0),
(42, 28, 'Edit User', 'edit_user', 'list_user', '', 'edit', '', 'school', '2', '1', '0', 0),
(107, 54, 'Documents', 'documents', 'documents', '', 'index', '', 'school', '3', '1', '1', 31),
(106, 55, 'Add Document', 'add_document', 'documents', '', 'add_document', '', 'school', '1', '1', '1', 32),
(158, 28, 'Edit Profile', 'edit_profile', 'list_user', '', 'edit_profile', '', 'school', '5', '1', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE IF NOT EXISTS `menu_master` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` int(11) NOT NULL,
  `is_active` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `is_main` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_id`, `parent_id`, `name`, `lang_menu_name`, `display_order`, `is_active`, `is_main`) VALUES
(1, 0, 'Home', 'home', 1, '1', '1'),
(11, 0, 'Privilege', 'privilege', 11, '1', '1'),
(28, 0, 'Staff List', 'staff_user_sub', 0, '1', '0'),
(31, 0, 'Role', 'role_sub', 0, '1', '0'),
(55, 53, 'Add Documents', 'add_document', 10, '1', '0'),
(54, 53, 'List Documents', 'documents', 10, '1', '0'),
(53, 0, 'Documents', 'documents', 10, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `recover_password`
--

CREATE TABLE IF NOT EXISTS `recover_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `recover_password`
--

INSERT INTO `recover_password` (`id`, `user_id`, `token`, `email`, `date_added`) VALUES
(9, 2462, '244d7fce9bc67b2fa56cda2f54800370dcc5df52', 'james@pro-linguo.com', '2014-10-27 14:47:30'),
(10, 2439, '0193f711b4643f3c8f78e15fe98e89a32d15e553', 'Jamaisman@hotmail.com', '2014-10-27 14:50:38'),
(89, 2010, '8fb43b82d214e6011a52b63c4a296b5de3e46294', 'romanoanna224@gmail.com', '2014-12-01 08:19:14'),
(18, 2427, '86fc6bd25115bab1bbec6534872ffd75b44d09cf', 'aclouston.c@KSU.EDU.SA', '2014-11-05 10:59:30'),
(23, 100063, '31e4833507b934566ed133dc31a958ea0e89def4', 'Laila.fawzi90@gmail.com', '2014-11-06 06:47:35'),
(25, 100063, 'fdbaf30d93aca53db8992c5b73171b64d5d50bc6', 'laila.fawzi90@gmail.com', '2014-11-06 09:23:18'),
(28, 124, '63cee46f07d39f3fbc6a61b40bb6d7fd608629e0', 'mhabashi.c@ksu.edu.sa', '2014-11-08 18:28:41'),
(38, 100054, '6fc702672ac1f0fb87ab57d5d3537035e28a22c5', 'spiritofmichaelasean@gmail.com', '2014-11-12 11:02:22'),
(41, 604, 'f10e10a198691a2787ac8bea38d17f7ba7978e6a', 'mayahammoud82@GMAIL.COM', '2014-11-12 12:26:29'),
(92, 2175, '158f805d0a8965d7d18fea520e62ecd16f870303', 'melodysaudi123@gmail.com', '2014-12-02 11:29:43'),
(97, 147, '54262cfae0a472642fae3d4a0cca3935bb92c787', 'ssiddiqui.c@ksu.edu.sa', '2014-12-03 13:04:19'),
(100, 2, 'cf5498f88f118e6443f65c06437436c9f511ae35', 'mohohassan.c@ksu.edu.sa', '2015-02-09 11:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `refugee`
--

CREATE TABLE IF NOT EXISTS `refugee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_data_entry` date NOT NULL,
  `association_name` varchar(255) NOT NULL,
  `location_of_association` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `nationality_id_no` varchar(255) NOT NULL,
  `un_id` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `previous_occupation` varchar(255) NOT NULL,
  `are_you_able_to_work` int(11) NOT NULL,
  `what_skills_do_you_have_for_working` varchar(255) NOT NULL,
  `what_qualifications_do_you_have` varchar(255) NOT NULL,
  `are_you_sick` int(11) NOT NULL,
  `need_of_medicationequipment` int(11) NOT NULL,
  `if_yes_please_specify` text NOT NULL,
  `where_do_you_live_location` varchar(255) NOT NULL,
  `do_you_live_in_tent_house` int(11) NOT NULL,
  `what_is_it_that_you_need_most` varchar(255) NOT NULL,
  `how_many_children_do_you_have` varchar(255) NOT NULL,
  `childrens_names_ages_genders` text NOT NULL,
  `other_family_members_names_ages_genders` text NOT NULL,
  `contact_details_email_skype_whatsapp` varchar(255) NOT NULL,
  `name_administrator` varchar(255) NOT NULL,
  `any_other_information` text NOT NULL,
  `special_case` int(11) NOT NULL,
  `special_case_more_info` text NOT NULL,
  `total_number_of_people_in_house` int(11) NOT NULL,
  `telephone_no` varchar(15) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `refugee`
--

INSERT INTO `refugee` (`id`, `date_of_data_entry`, `association_name`, `location_of_association`, `full_name`, `age`, `gender`, `nationality`, `nationality_id_no`, `un_id`, `marital_status`, `previous_occupation`, `are_you_able_to_work`, `what_skills_do_you_have_for_working`, `what_qualifications_do_you_have`, `are_you_sick`, `need_of_medicationequipment`, `if_yes_please_specify`, `where_do_you_live_location`, `do_you_live_in_tent_house`, `what_is_it_that_you_need_most`, `how_many_children_do_you_have`, `childrens_names_ages_genders`, `other_family_members_names_ages_genders`, `contact_details_email_skype_whatsapp`, `name_administrator`, `any_other_information`, `special_case`, `special_case_more_info`, `total_number_of_people_in_house`, `telephone_no`, `month`, `year`, `created_by`, `created_date`) VALUES
(1, '0000-00-00', 'fghfgh', 'hfdhfd', 'hdfhfd', 0, 'dfh', '0', '', '', '', '', 0, '', '0', 0, 0, '', '', 0, '', '', '', '', '', '', '', 0, '', 0, '', 'March', 2014, 0, '2015-02-14 08:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--
-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `login_enabled` tinyint(1) NOT NULL,
  `register_enabled` tinyint(1) NOT NULL,
  `install_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `members_per_page` tinyint(4) NOT NULL,
  `admin_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `home_page` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `default_theme` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login_attempts` tinyint(4) NOT NULL,
  `recaptcha_theme` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'white',
  `email_protocol` tinyint(4) NOT NULL DEFAULT '1',
  `sendmail_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '/usr/sbin/sendmail',
  `smtp_host` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ssl://smtp.googlemail.com',
  `smtp_port` smallint(6) NOT NULL DEFAULT '465',
  `smtp_user` mediumblob NOT NULL,
  `smtp_pass` mediumblob NOT NULL,
  `site_title` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'CI_Membership',
  `cookie_expires` int(11) NOT NULL,
  `password_link_expires` int(11) NOT NULL,
  `activation_link_expires` int(11) NOT NULL,
  `disable_all` tinyint(1) NOT NULL,
  `site_disabled_text` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `login_enabled`, `register_enabled`, `install_enabled`, `members_per_page`, `admin_email`, `home_page`, `default_theme`, `login_attempts`, `recaptcha_theme`, `email_protocol`, `sendmail_path`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `site_title`, `cookie_expires`, `password_link_expires`, `activation_link_expires`, `disable_all`, `site_disabled_text`) VALUES
(1, 1, 1, 0, 10, 'info@elsdportal.net', 'home', 'school', 5, 'white', 2, '/usr/sbin/sendmail', 'ssl://smtp.googlemail.com', 465, 0x392b515646545a5a6b34727651625041454a785036645a763255304b49696f3151705a3263306562495243614349655533594a35416452695a725144736d777950374c77506c554e346c66634449427a6b30322b51673d3d, 0x572b742b6969334a70482f3367664767492b77695a6a75386659635845524d7659314d375958545956503779422f2b7a7a6779635348792b7a576f696762446c2f4d6670612f506861617a71746e782f4d5752424c773d3d, 'ELSD Portal', 259200, 43200, 43200, 0, 'This website is momentarily offline.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_roll_id` bigint(20) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('M','F') COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `login_attempts` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nonce` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_roll_id` (`user_roll_id`),
  KEY `active` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=105431 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_roll_id`, `username`, `password`, `email`, `first_name`, `last_name`, `address1`, `city`, `state`, `country`, `zip`, `birth_date`, `gender`, `cell_phone`, `last_login_date`, `login_attempts`, `profile_picture`, `nonce`, `created_date`, `updated_date`, `active`) VALUES
(100000, 1, 'administrator', 'bb7e7a7610e6ee23f7a1946c5a0b88ea0be5e1d3a316c59b354a7f91ce8cf247b51c63027969b8c1e8f1c1d939632a65797a03fb29ee0f5a2192149cd4259ed0', 'chaichai21@hotmail.com', 'Muhammad', 'Abdullah', 'address1', 'Roseau', '', '', '00767', '1977-01-09', 'M', '898989899898', '2015-02-14 13:38:13', 0, 'e084ab5e0d44626e6d4ef24395444395.png', 'b05d1b27733282d3c8f181ad5605d66f', '2012-09-27 12:49:32', '2015-01-22 10:22:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE IF NOT EXISTS `users_log` (
  `user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_roll_id` bigint(20) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username_new` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `section_title_name` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email_new` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_uni_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `track` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_date` datetime NOT NULL,
  `academic_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `first_name_arabic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `name_suffix` varchar(20) CHARACTER SET latin1 NOT NULL,
  `address1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `address2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `city` varchar(100) CHARACTER SET latin1 NOT NULL,
  `state` varchar(100) CHARACTER SET latin1 NOT NULL,
  `zip` varchar(20) CHARACTER SET latin1 NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(100) CHARACTER SET latin1 NOT NULL,
  `gender` enum('M','F') CHARACTER SET latin1 NOT NULL,
  `language_known` varchar(100) CHARACTER SET latin1 NOT NULL,
  `work_phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `home_phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `cell_phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `cell_phone_new` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login_date` datetime NOT NULL,
  `login_attempts` int(11) NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nonce` varchar(32) CHARACTER SET latin1 NOT NULL,
  `elsd_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `coordinator` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `coordinator_new` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ca_lead_teacher` bigint(64) NOT NULL,
  `campus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campus_id` int(11) NOT NULL,
  `campus_id_new` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `active` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `discontinue` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `discontinue_date` date NOT NULL,
  `discontinue_week_id` int(11) NOT NULL,
  `status_old` tinyint(2) NOT NULL,
  `status_new` tinyint(2) NOT NULL,
  `change_by` int(11) NOT NULL DEFAULT '0',
  `change_date` datetime NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_update` int(1) NOT NULL DEFAULT '0',
  `change_field` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_log_id`),
  KEY `section_id` (`section_id`),
  KEY `user_roll_id` (`user_roll_id`),
  KEY `active` (`active`),
  KEY `student_uni_id` (`student_uni_id`),
  KEY `user_id` (`user_id`),
  FULLTEXT KEY `academic_status` (`academic_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_privilege`
--

CREATE TABLE IF NOT EXISTS `user_custom_privilege` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_action_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE IF NOT EXISTS `user_privilege` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_action_id` int(11) NOT NULL,
  `user_roll_id` int(11) NOT NULL,
  `is_active` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_roll`
--

CREATE TABLE IF NOT EXISTS `user_roll` (
  `user_roll_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_roll_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`user_roll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;

--
-- Dumping data for table `user_roll`
--

INSERT INTO `user_roll` (`user_roll_id`, `user_roll_name`) VALUES
(1, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
