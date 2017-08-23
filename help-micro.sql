-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2017 at 01:14 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `help-micro`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1469962054),
('admin', '33', 1469996415),
('admin', '34', 1469996479),
('admin', '8', 1457030722),
('customer', '4', 1502355427),
('employee', '10', 1464244325),
('employee', '11', 1457110756),
('employee', '12', 1457110796),
('employee', '13', 1457110836),
('employee', '14', 1457110869),
('employee', '15', 1457514681),
('employee', '16', 1457110935),
('employee', '17', 1457110968),
('employee', '18', 1457110999),
('employee', '19', 1457111027),
('employee', '20', 1457111064),
('employee', '21', 1457111114),
('employee', '22', 1457111144),
('employee', '23', 1457111200),
('employee', '24', 1457111229),
('employee', '25', 1457111272),
('employee', '26', 1457514817),
('employee', '27', 1457609530),
('employee', '28', 1457622928),
('employee', '29', 1458058257),
('employee', '7', 1457030690),
('employee', '9', 1457030749);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `parent_id`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1457028578, 1503221918, NULL),
('category', 2, 'Category management', NULL, NULL, 1502357680, 1502357680, ''),
('category/create', 2, 'Category create', NULL, NULL, 1502357759, 1502357759, 'category'),
('category/delete', 2, 'Category delete', NULL, NULL, 1502357775, 1502357775, 'category'),
('category/index', 2, 'Category list', NULL, NULL, 1502357708, 1502357708, 'category'),
('category/update', 2, 'Category update', NULL, NULL, 1502357741, 1502357741, 'category'),
('category/view', 2, 'Category view', NULL, NULL, 1502357723, 1502357723, 'category'),
('characteristic-groups', 2, 'Characteristic group management', NULL, NULL, 1502464378, 1502464378, ''),
('characteristic-groups/create', 2, 'Characteristic group create', NULL, NULL, 1502464452, 1502464507, 'characteristic-groups'),
('characteristic-groups/delete', 2, 'Characteristic group delete', NULL, NULL, 1502464497, 1502464497, 'characteristic-groups'),
('characteristic-groups/index', 2, 'Characteristic group index', NULL, NULL, 1502464413, 1502464413, 'characteristic-groups'),
('characteristic-groups/update', 2, 'Characteristic group update', NULL, NULL, 1502464472, 1502464522, 'characteristic-groups'),
('characteristic-groups/view', 2, 'Characteristic group view', NULL, NULL, 1502464434, 1502464536, 'characteristic-groups'),
('characteristics', 2, 'Characteristic', NULL, NULL, 1502464596, 1502464600, ''),
('characteristics/create', 2, 'Characteristic create', NULL, NULL, 1502464653, 1502464653, 'characteristics'),
('characteristics/delete', 2, 'Characteristic delete', NULL, NULL, 1502464692, 1502464692, 'characteristics'),
('characteristics/index', 2, 'Characteristic index', NULL, NULL, 1502464616, 1502464616, 'characteristics'),
('characteristics/update', 2, 'Characteristic update', NULL, NULL, 1502464677, 1502464677, 'characteristics'),
('characteristics/view', 2, 'Characteristic view', NULL, NULL, 1502464635, 1502464635, 'characteristics'),
('comment', 2, 'Comment management', NULL, NULL, 1502891490, 1502891495, ''),
('comment/create', 2, 'Comment create', NULL, NULL, 1502891514, 1502891514, 'comment'),
('content', 2, 'Content management', NULL, NULL, 1469903227, 1469903227, ''),
('content/posts', 2, 'Posts management', NULL, NULL, 1469903256, 1469903256, 'content'),
('customer', 1, 'User on the site', NULL, NULL, 1502355334, 1502891588, NULL),
('dashboard/default/index', 2, 'Dashboard', NULL, NULL, 1468306058, 1468306516, ''),
('i18n', 2, 'Translation management', NULL, NULL, 1464245784, 1464245784, NULL),
('permit/access', 2, 'Role and permission management', NULL, NULL, 1457031451, 1457031915, NULL),
('products', 2, 'Products management', NULL, NULL, 1503221874, 1503221874, ''),
('settings', 2, 'Settings management', NULL, NULL, 1467648490, 1467819771, ''),
('settings/contact-form-settings/index', 2, 'Contact form settings list', NULL, NULL, 1470330678, 1470330678, 'settings'),
('settings/contact-form-settings/update', 2, 'Contact form settings update', NULL, NULL, 1470330545, 1470330545, 'settings'),
('settings/contact-form-settings/view', 2, 'Contact form settings view', NULL, NULL, 1470330524, 1470330524, 'settings'),
('settings/settings', 2, 'Setting components management', NULL, NULL, 1472991531, 1472991531, 'settings'),
('users', 2, 'User management', NULL, NULL, 1457028692, 1457031410, NULL),
('video', 2, 'Video management', NULL, NULL, 1502351888, 1502351888, ''),
('video/create', 2, 'Video create', NULL, NULL, 1502352993, 1502352993, 'video'),
('video/delete', 2, 'Video delete', NULL, NULL, 1502354596, 1502354596, 'video'),
('video/index', 2, 'Video list', NULL, NULL, 1502355291, 1502355291, 'video'),
('video/update', 2, 'Video update', NULL, NULL, 1502353406, 1502353406, 'video'),
('video/view', 2, 'Video view', NULL, NULL, 1502354310, 1502354310, 'video');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'category'),
('admin', 'characteristic-groups'),
('admin', 'characteristic-groups/create'),
('admin', 'characteristic-groups/delete'),
('admin', 'characteristic-groups/index'),
('admin', 'characteristic-groups/update'),
('admin', 'characteristic-groups/view'),
('admin', 'characteristics'),
('admin', 'characteristics/create'),
('admin', 'characteristics/delete'),
('admin', 'characteristics/index'),
('admin', 'characteristics/update'),
('admin', 'characteristics/view'),
('admin', 'comment'),
('admin', 'comment/create'),
('admin', 'content'),
('admin', 'content/posts'),
('admin', 'dashboard/default/index'),
('admin', 'i18n'),
('admin', 'permit/access'),
('admin', 'products'),
('admin', 'settings/contact-form-settings/index'),
('admin', 'settings/contact-form-settings/update'),
('admin', 'settings/contact-form-settings/view'),
('admin', 'settings/settings'),
('admin', 'users'),
('admin', 'video'),
('customer', 'category/index'),
('customer', 'comment/create'),
('customer', 'video/index'),
('employee', 'reports/jobs/create'),
('employee', 'reports/jobs/project-employee'),
('employee', 'users/users/change-password'),
('sales_organization', 'customers/customers/index'),
('sales_organization', 'users/users/change-password');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:19:"app\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1466665166;s:9:"updatedAt";i:1466665166;}', 1466665166, 1466665166),
('isAuthorManyToMany', 'O:29:"app\\rbac\\AuthorManyToManyRule":3:{s:4:"name";s:18:"isAuthorManyToMany";s:9:"createdAt";i:1467467624;s:9:"updatedAt";i:1467467624;}', 1467467624, 1467467624),
('isItself', 'O:19:"app\\rbac\\ItselfRule":3:{s:4:"name";s:8:"isItself";s:9:"createdAt";i:1467465859;s:9:"updatedAt";i:1467465859;}', 1467465859, 1467465859);

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categorylang`
--

CREATE TABLE IF NOT EXISTS `blog_categorylang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `blog_category_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_category_id` (`blog_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_postlang`
--

CREATE TABLE IF NOT EXISTS `blog_postlang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_post_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `created_at`, `updated_at`, `sort`, `parent_id`, `level`, `alias`, `enabled`, `is_deleted`, `image`) VALUES
(12, 1503222963, 1503321337, 1, NULL, 0, 'fiscal-registers', 1, 0, '/uploads/categories/images/3c15fe63-e89e-48f5-a215-3c54372bc445/2.jpg'),
(13, 1503223002, 1503321337, 0, NULL, 0, 'cash-registers', 1, 0, '/uploads/categories/images/1583ce6e-daa4-488b-be28-9e23b576dee7/1.jpeg'),
(14, 1503321306, 1503322737, 2, NULL, 0, 'computer-cash-systems', 1, 0, '/uploads/categories/images/020643ba-2c39-4167-9c37-10e2e1cb2897/1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categorylang`
--

CREATE TABLE IF NOT EXISTS `categorylang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `categorylang`
--

INSERT INTO `categorylang` (`id`, `language`, `category_id`, `title`, `description`) VALUES
(33, 'en', 12, 'Fiscal registers', ''),
(34, 'ru', 12, 'Фискальные регистраторы', ''),
(35, 'ua', 12, 'Фіскальні реєстратори', ''),
(36, 'en', 13, 'Cash registers', ''),
(37, 'ru', 13, 'Кассовые аппараты', ''),
(38, 'ua', 13, 'Касові апарати', ''),
(39, 'en', 14, 'Computer-cash systems', ''),
(40, 'ru', 14, 'Компьютерно-кассовые системы', ''),
(41, 'ua', 14, 'Комп''ютерно-касові системи', '');

-- --------------------------------------------------------

--
-- Table structure for table `characteristic`
--

CREATE TABLE IF NOT EXISTS `characteristic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `characteristic_group_id` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `characteristiclang`
--

CREATE TABLE IF NOT EXISTS `characteristiclang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `characteristic_id` int(11) NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `characteristic_group_id` (`characteristic_id`),
  KEY `characteristic_id` (`characteristic_id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `characteristic_group`
--

CREATE TABLE IF NOT EXISTS `characteristic_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `show_in_filter` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `characteristic_grouplang`
--

CREATE TABLE IF NOT EXISTS `characteristic_grouplang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `characteristic_group_id` int(11) NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `characteristic_group_id` (`characteristic_group_id`),
  KEY `characteristic_group_id_2` (`characteristic_group_id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `created_at`, `updated_at`, `text`, `user_id`, `parent_id`, `level`, `enabled`, `is_deleted`, `video_id`) VALUES
(12, 1502894238, 1502894238, 'Текст', 4, NULL, NULL, 1, 0, 2),
(13, 1502894739, 1502894739, 'Текст', 4, NULL, NULL, 1, 0, 2),
(17, 1502895408, 1502895408, 'Текст', 4, NULL, NULL, 1, 0, 2),
(18, 1502895447, 1502895447, 'Текст', 4, 12, NULL, 1, 0, 2),
(19, 1502895739, 1502895739, 'Текст', 4, 12, NULL, 1, 0, 2),
(20, 1502895747, 1502895747, 'Текст', 4, NULL, NULL, 1, 0, 2),
(21, 1502895761, 1502895761, 'Текст', 4, 18, NULL, 1, 0, 2),
(23, 1502895852, 1502895852, 'Текст inner', 4, NULL, NULL, 1, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iso_4217` varchar(10) NOT NULL,
  `sign` varchar(10) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `show_after_price` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `iso_4217`, `sign`, `is_default`, `show_after_price`) VALUES
(1, 'Гривня', 'UAH', '₴', 1, 1),
(2, 'Евро', 'EUR', '€', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `receivers` text,
  `alias` varchar(255) NOT NULL,
  `for_customer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `name`, `description`, `enabled`, `receivers`, `alias`, `for_customer`) VALUES
(5, 'Контактная форма', 'Информация с контактной формы', 1, 'artemkramov@gmail.com, artemkramov@yahoo.com', 'contact-form', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_templatelang`
--

CREATE TABLE IF NOT EXISTS `email_templatelang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `language` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email_template_id` (`email_template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `email_templatelang`
--

INSERT INTO `email_templatelang` (`id`, `email_template_id`, `subject`, `language`) VALUES
(13, 5, 'Contact form', 'en'),
(14, 5, 'Контактная форма', 'ru'),
(15, 5, 'Контактна форма', 'ua');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `default` smallint(6) NOT NULL DEFAULT '0',
  `date_update` int(11) NOT NULL,
  `date_create` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `url`, `local`, `name`, `default`, `date_update`, `date_create`, `currency_id`) VALUES
(1, 'en', 'en_EN', 'English', 0, 1463386881, 1463386881, 2),
(4, 'ru', 'ru_RU', 'Русский', 0, 1463386881, 1463386881, 1),
(5, 'ua', 'ua_UA', 'Українська', 1, 1463386881, 1463386881, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `bean_type` varchar(255) DEFAULT NULL,
  `bean_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `menu_type_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_direct` tinyint(1) NOT NULL DEFAULT '0',
  `is_new_tab` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `menu_type_id` (`menu_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `created_at`, `updated_at`, `sort`, `parent_id`, `bean_type`, `bean_id`, `url`, `enabled`, `menu_type_id`, `image`, `is_direct`, `is_new_tab`) VALUES
(1, 1503049918, 1503050171, 0, NULL, 'post', 1, NULL, 1, 1, NULL, 0, 0),
(2, 1503049959, 1503145024, 1, NULL, 'post', 5, NULL, 1, 1, NULL, 0, 0),
(3, 1503049991, 1503402854, 2, NULL, 'post', 6, NULL, 0, 1, NULL, 0, 0),
(4, 1503050071, 1503402854, 3, NULL, 'post', 1, 'shop', 1, 1, NULL, 0, 0),
(5, 1503050130, 1503402842, 5, NULL, 'post', 4, NULL, 1, 1, NULL, 0, 0),
(6, 1503050754, 1503326615, 1, 4, 'post', 1, 'product-category/fiscal-registers', 1, 1, NULL, 0, 0),
(7, 1503050811, 1503322764, 0, 4, 'post', 1, 'product-category/cash-registers', 1, 1, NULL, 0, 0),
(8, 1503053836, 1503054122, 0, NULL, 'post', 1, NULL, 1, 2, NULL, 0, 0),
(9, 1503053871, 1503145036, 1, NULL, 'post', 5, NULL, 1, 2, NULL, 0, 0),
(10, 1503053897, 1503402942, 3, NULL, 'post', 4, NULL, 1, 2, NULL, 0, 0),
(11, 1503322713, 1503323050, 2, 4, 'post', 1, 'product-category/computer-cash-systems', 1, 1, NULL, 0, 0),
(12, 1503402824, 1503402854, 4, NULL, 'post', 8, NULL, 1, 1, NULL, 0, 0),
(13, 1503402929, 1503402942, 2, NULL, 'post', 8, NULL, 1, 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menulang`
--

CREATE TABLE IF NOT EXISTS `menulang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `language` varchar(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `post_id` (`menu_id`),
  KEY `language` (`language`),
  KEY `menu_id` (`menu_id`),
  KEY `menu_id_2` (`menu_id`,`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `menulang`
--

INSERT INTO `menulang` (`id`, `menu_id`, `language`, `title`, `description`) VALUES
(1, 1, 'en', 'Home', ''),
(2, 1, 'ru', 'Главная', ''),
(3, 1, 'ua', 'Головна', ''),
(4, 2, 'en', 'About us', ''),
(5, 2, 'ru', 'О нас', ''),
(6, 2, 'ua', 'Про нас', ''),
(7, 3, 'en', 'Services', ''),
(8, 3, 'ru', 'Услуги', ''),
(9, 3, 'ua', 'Послуги', ''),
(10, 4, 'en', 'Product', ''),
(11, 4, 'ru', 'Продукция', ''),
(12, 4, 'ua', 'Продукція', ''),
(13, 5, 'en', 'Contacts', ''),
(14, 5, 'ru', 'Контакты', ''),
(15, 5, 'ua', 'Контакти', ''),
(16, 6, 'en', 'Fiscal registers', ''),
(17, 6, 'ru', 'Фискальные регистраторы', ''),
(18, 6, 'ua', 'Фіскальні реєстратори', ''),
(19, 7, 'en', 'Cash registers', ''),
(20, 7, 'ru', 'Кассовые аппараты', ''),
(21, 7, 'ua', 'Касові апарати', ''),
(22, 8, 'en', 'Home', ''),
(23, 8, 'ru', 'Главная', ''),
(24, 8, 'ua', 'Головна', ''),
(25, 9, 'en', 'About us', ''),
(26, 9, 'ru', 'О нас', ''),
(27, 9, 'ua', 'Про нас', ''),
(28, 10, 'en', 'Contacts', ''),
(29, 10, 'ru', 'Контакты', ''),
(30, 10, 'ua', 'Контакти', ''),
(31, 11, 'en', 'Computer-cash systems', ''),
(32, 11, 'ru', 'Компьютерно-кассовые системы', ''),
(33, 11, 'ua', 'Комп''ютерно-касові системи', ''),
(34, 12, 'en', 'Developers', ''),
(35, 12, 'ru', 'Разработчикам', ''),
(36, 12, 'ua', 'Розробникам', ''),
(37, 13, 'en', 'Developers', ''),
(38, 13, 'ru', 'Разработчикам', ''),
(39, 13, 'ua', 'Розробникам', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE IF NOT EXISTS `menu_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `alias`) VALUES
(1, 'Header', 'header'),
(2, 'Footer', 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(255) NOT NULL DEFAULT '',
  `translation` text,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(252, 'ru', '(не задано)'),
(252, 'ua', '(не задано)'),
(253, 'ru', 'Возникла внутренняя ошибка сервера.'),
(253, 'ua', 'Виникла внутрішня помилка сервера.'),
(254, 'ru', 'Вы уверены, что хотите удалить этот элемент?'),
(254, 'ua', 'Ви впевнені, що хочете видалити цей елемент?'),
(255, 'ru', 'Удалить'),
(255, 'ua', 'Видалити'),
(256, 'ru', 'Ошибка'),
(256, 'ua', 'Помилка'),
(257, 'ru', 'Загрузка файла не удалась.'),
(257, 'ua', 'Завантаження файлу не вдалося.'),
(258, 'ru', 'Главная'),
(258, 'ua', 'Головна'),
(259, 'ru', 'Неправильное значение параметра "{param}".'),
(259, 'ua', 'Отримано невірне значення для параметра "{param}".'),
(260, 'ru', 'Требуется вход.'),
(260, 'ua', 'Необхідно увійти'),
(261, 'ru', 'Отсутствуют обязательные аргументы: {params}'),
(261, 'ua', 'Відсутні обовʼязкові аргументи: {params}'),
(262, 'ru', 'Отсутствуют обязательные параметры: {params}'),
(262, 'ua', 'Відсутні обовʼязкові параметри: {params}'),
(263, 'ru', 'Нет'),
(263, 'ua', 'Ні'),
(264, 'ru', 'Ничего не найдено.'),
(264, 'ua', 'Нічого не знайдено.'),
(265, 'ru', 'Разрешена загрузка файлов только со следующими MIME-типами: {mimeTypes}.'),
(265, 'ua', 'Дозволені файли лише з наступними MIME-типами: {mimeTypes}.'),
(266, 'ru', 'Разрешена загрузка файлов только со следующими расширениями: {extensions}.'),
(266, 'ua', 'Дозволені файли лише з наступними розширеннями: {extensions}.'),
(267, 'ru', 'Страница не найдена.'),
(267, 'ua', 'Сторінка не знайдена.'),
(268, 'ru', 'Исправьте следующие ошибки:'),
(268, 'ua', 'Будь ласка, виправте наступні помилки:'),
(269, 'ru', 'Загрузите файл.'),
(269, 'ua', 'Будь ласка, завантажте файл.'),
(270, 'ru', 'Показаны записи <b>{begin, number}-{end, number}</b> из <b>{totalCount, number}</b>.'),
(270, 'ua', 'Показані <b>{begin, number}-{end, number}</b> із <b>{totalCount, number}</b> {totalCount, plural, one{запису} other{записів}}.'),
(271, 'ru', 'Файл «{file}» не является изображением.'),
(271, 'ua', 'Файл "{file}" не є зображенням.'),
(272, 'ru', 'Файл «{file}» слишком большой. Размер не должен превышать {formattedLimit}.'),
(272, 'ua', 'Файл "{file}" занадто великий. Розмір не повинен перевищувати {formattedLimit}.'),
(273, 'ru', 'Файл «{file}» слишком маленький. Размер должен быть более {formattedLimit}.'),
(273, 'ua', 'Файл "{file}" занадто малий. Розмір повинен бути більше, ніж {formattedLimit}.'),
(274, 'ru', 'Неверный формат значения «{attribute}».'),
(274, 'ua', 'Невірний формат значення "{attribute}".'),
(275, 'ru', 'Файл «{file}» слишком большой. Высота не должна превышать {limit, number} {limit, plural, one{пиксель} few{пикселя} many{пикселей} other{пикселя}}.'),
(275, 'ua', 'Зображення "{file}" занадто велике. Висота не повинна перевищувати {limit, number} {limit, plural, one{піксель} few{пікселя} many{пікселів} other{пікселя}}.'),
(276, 'ru', 'Файл «{file}» слишком большой. Ширина не должна превышать {limit, number} {limit, plural, one{пиксель} few{пикселя} many{пикселей} other{пикселя}}.'),
(276, 'ua', 'Зображення "{file}" занадто велике. Ширина не повинна перевищувати {limit, number} {limit, plural, one{піксель} few{пікселя} many{пікселів} other{пікселя}}.'),
(277, 'ru', 'Файл «{file}» слишком маленький. Высота должна быть более {limit, number} {limit, plural, one{пиксель} few{пикселя} many{пикселей} other{пикселя}}.'),
(277, 'ua', 'Зображення "{file}" занадто мале. Висота повинна бути більше, ніж {limit, number} {limit, plural, one{піксель} few{пікселя} many{пікселів} other{пікселя}}.'),
(278, 'ru', 'Файл «{file}» слишком маленький. Ширина должна быть более {limit, number} {limit, plural, one{пиксель} few{пикселя} many{пикселей} other{пикселя}}.'),
(278, 'ua', 'Зображення "{file}" занадто мале. Ширина повинна бути більше, ніж {limit, number} {limit, plural, one{піксель} few{пікселя} many{пікселів} other{пікселя}}.'),
(279, 'ru', 'Запрашиваемый файл представления "{name}" не найден.'),
(279, 'ua', 'Представлення "{name}" не знайдено.'),
(280, 'ru', 'Неправильный проверочный код.'),
(280, 'ua', 'Невірний код перевірки.'),
(281, 'ru', 'Всего <b>{count, number}</b> {count, plural, one{запись} few{записи} many{записей} other{записи}}.'),
(281, 'ua', 'Всього <b>{count, number}</b> {count, plural, one{запис} few{записи} many{записів} other{записи}}.'),
(282, 'ru', 'Не удалось проверить переданные данные.'),
(282, 'ua', 'Не вдалося перевірити передані дані.'),
(283, 'ru', 'Неизвестная опция: --{name}'),
(283, 'ua', 'Невідома опція : --{name}'),
(284, 'ru', 'Редактировать'),
(284, 'ua', 'Оновити'),
(285, 'ru', 'Просмотр'),
(285, 'ua', 'Переглянути'),
(286, 'ru', 'Да'),
(286, 'ua', 'Так'),
(287, 'ru', 'Вам не разрешено производить данное действие.'),
(287, 'ua', 'Вам не дозволено виконувати дану дію.'),
(288, 'ru', 'Вы не можете загружать более {limit, number} {limit, plural, one{файла} few{файлов} many{файлов} other{файла}}.'),
(288, 'ua', 'Ви не можете завантажувати більше {limit, number} {limit, plural, one{файла} few{файлів} many{файлів} other{файла}}.'),
(289, 'ru', 'через {delta, plural, =1{день} one{# день} few{# дня} many{# дней} other{# дня}}'),
(289, 'ua', 'через {delta, plural, =1{день} one{# день} few{# дні} many{# днів} other{# дні}}'),
(290, 'ru', 'через {delta, plural, =1{минуту} one{# минуту} few{# минуты} many{# минут} other{# минуты}}'),
(290, 'ua', 'через {delta, plural, =1{хвилину} one{# хвилину} few{# хвилини} many{# хвилин} other{# хвилини}}'),
(291, 'ru', 'через {delta, plural, =1{месяц} one{# месяц} few{# месяца} many{# месяцев} other{# месяца}}'),
(291, 'ua', 'через {delta, plural, =1{місяць} one{# місяць} few{# місяці} many{# місяців} other{# місяці}}'),
(292, 'ru', 'через {delta, plural, =1{секунду} one{# секунду} few{# секунды} many{# секунд} other{# секунды}}'),
(292, 'ua', 'через {delta, plural, =1{секунду} one{# секунду} few{# секунди} many{# секунд} other{# секунди}}'),
(293, 'ru', 'через {delta, plural, =1{год} one{# год} few{# года} many{# лет} other{# года}}'),
(293, 'ua', 'через {delta, plural, =1{рік} one{# рік} few{# роки} many{# років} other{# роки}}'),
(294, 'ru', 'через {delta, plural, =1{час} one{# час} few{# часа} many{# часов} other{# часа}}'),
(294, 'ua', 'через {delta, plural, =1{годину} one{# годину} few{# години} many{# годин} other{# години}}'),
(295, 'ru', 'прямо сейчас'),
(295, 'ua', 'саме зараз'),
(296, 'ru', 'введённое значение'),
(296, 'ua', 'введене значення'),
(297, 'ru', 'Значение «{value}» для «{attribute}» уже занято.'),
(297, 'ua', 'Значення «{value}» для «{attribute}» вже зайнято.'),
(298, 'ru', 'Необходимо заполнить «{attribute}».'),
(298, 'ua', 'Необхідно заповнити "{attribute}".'),
(299, 'ru', 'Значение «{attribute}» неверно.'),
(299, 'ua', 'Значення "{attribute}" не вірне.'),
(300, 'ru', 'Значение «{attribute}» не является правильным URL.'),
(300, 'ua', 'Значення "{attribute}" не є правильним URL.'),
(301, 'ru', 'Значение «{attribute}» не является правильным email адресом.'),
(301, 'ua', 'Значення "{attribute}" не є правильною email адресою.'),
(302, 'ru', 'Значение «{attribute}» должно быть равно «{requiredValue}».'),
(302, 'ua', 'Значення "{attribute}" має бути рівним "{requiredValue}".'),
(303, 'ru', 'Значение «{attribute}» должно быть числом.'),
(303, 'ua', 'Значення "{attribute}" має бути числом.'),
(304, 'ru', 'Значение «{attribute}» должно быть строкой.'),
(304, 'ua', 'Значення "{attribute}" має бути текстовим рядком.'),
(305, 'ru', 'Значение «{attribute}» должно быть целым числом.'),
(305, 'ua', 'Значення "{attribute}" має бути цілим числом.'),
(306, 'ru', 'Значение «{attribute}» должно быть равно «{true}» или «{false}».'),
(306, 'ua', 'Значення "{attribute}" має дорівнювати "{true}" або "{false}".'),
(311, 'ru', 'Значение «{attribute}» не должно превышать {max}.'),
(311, 'ua', 'Значення "{attribute}" не повинно перевищувати {max}.'),
(312, 'ru', 'Значение «{attribute}» должно быть не меньше {min}.'),
(312, 'ua', 'Значення "{attribute}" має бути більшим {min}.'),
(315, 'ru', 'Значение «{attribute}» должно содержать минимум {min, number} {min, plural, one{символ} few{символа} many{символов} other{символа}}.'),
(315, 'ua', 'Значення "{attribute}" повинно містити мінімум {min, number} {min, plural, one{символ} few{символа} many{символів} other{символа}}.'),
(316, 'ru', 'Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}.'),
(316, 'ua', 'Значення "{attribute}" повинно містити максимум {max, number} {max, plural, one{символ} few{символа} many{символів} other{символа}}.'),
(317, 'ru', 'Значение «{attribute}» должно содержать {length, number} {length, plural, one{символ} few{символа} many{символов} other{символа}}.'),
(317, 'ua', 'Значення "{attribute}" повинно містити {length, number} {length, plural, one{символ} few{символа} many{символів} other{символа}}.'),
(318, 'ru', '{delta, plural, =1{день} one{# день} few{# дня} many{# дней} other{# дня}} назад'),
(318, 'ua', '{delta, plural, =1{день} one{день} few{# дні} many{# днів} other{# дні}} тому'),
(319, 'ru', '{delta, plural, =1{минуту} one{# минуту} few{# минуты} many{# минут} other{# минуты}} назад'),
(319, 'ua', '{delta, plural, =1{хвилину} one{# хвилину} few{# хвилини} many{# хвилин} other{# хвилини}} тому'),
(320, 'ru', '{delta, plural, =1{месяц} one{# месяц} few{# месяца} many{# месяцев} other{# месяца}} назад'),
(320, 'ua', '{delta, plural, =1{місяць} one{# місяць} few{# місяці} many{# місяців} other{# місяці}} тому'),
(321, 'ru', '{delta, plural, =1{секунду} one{# секунду} few{# секунды} many{# секунд} other{# секунды}} назад'),
(321, 'ua', '{delta, plural, =1{секунду} one{# секунду} few{# секунди} many{# секунд} other{# секунди}} тому'),
(322, 'ru', '{delta, plural, =1{год} one{# год} few{# года} many{# лет} other{# года}} назад'),
(322, 'ua', '{delta, plural, =1{рік} one{# рік} few{# роки} many{# років} other{# роки}} тому'),
(323, 'ru', '{delta, plural, =1{час} one{# час} few{# часа} many{# часов} other{# часа}} назад'),
(323, 'ua', '{delta, plural, =1{година} one{# година} few{# години} many{# годин} other{# години}} тому'),
(324, 'ru', '{nFormatted} Б'),
(324, 'ua', '{nFormatted} Б'),
(325, 'ru', '{nFormatted} ГБ'),
(325, 'ua', '{nFormatted} Гб'),
(326, 'ru', '{nFormatted} ГиБ'),
(326, 'ua', '{nFormatted} ГіБ'),
(327, 'ru', '{nFormatted} КБ'),
(327, 'ua', '{nFormatted} Кб'),
(328, 'ru', '{nFormatted} КиБ'),
(328, 'ua', '{nFormatted} КіБ'),
(329, 'ru', '{nFormatted} МБ'),
(329, 'ua', '{nFormatted} Мб'),
(330, 'ru', '{nFormatted} МиБ'),
(330, 'ua', '{nFormatted} МіБ'),
(331, 'ru', '{nFormatted} ПБ'),
(331, 'ua', '{nFormatted} Пб'),
(332, 'ru', '{nFormatted} ПиБ'),
(332, 'ua', '{nFormatted} ПіБ'),
(333, 'ru', '{nFormatted} ТБ'),
(333, 'ua', '{nFormatted} Тб'),
(334, 'ru', '{nFormatted} ТиБ'),
(334, 'ua', '{nFormatted} ТіБ'),
(335, 'ru', '{nFormatted} {n, plural, one{байт} few{байта} many{байтов} other{байта}}'),
(335, 'ua', '{nFormatted} {n, plural, one{байт} few{байта} many{байтів} other{байта}}'),
(336, 'ru', '{nFormatted} {n, plural, one{гибибайт} few{гибибайта} many{гибибайтов} other{гибибайта}}'),
(336, 'ua', '{nFormatted} {n, plural, one{гібібайт} few{гібібайта} many{гібібайтів} other{гібібайта}}'),
(337, 'ru', '{nFormatted} {n, plural, one{гигабайт} few{гигабайта} many{гигабайтов} other{гигабайта}}'),
(337, 'ua', '{nFormatted} {n, plural, one{гігабайт} few{гігабайта} many{гігабайтів} other{гігабайта}}'),
(338, 'ru', '{nFormatted} {n, plural, one{кибибайт} few{кибибайта} many{кибибайтов} other{кибибайта}}'),
(338, 'ua', '{nFormatted} {n, plural, one{кібібайт} few{кібібайта} many{кібібайтів} other{кібібайта}}'),
(339, 'ru', '{nFormatted} {n, plural, one{килобайт} few{килобайта} many{килобайтов} other{килобайта}}'),
(339, 'ua', '{nFormatted} {n, plural, one{кілобайт} few{кілобайта} many{кілобайтів} other{кілобайта}}'),
(340, 'ru', '{nFormatted} {n, plural, one{мебибайт} few{мебибайта} many{мебибайтов} other{мебибайта}}'),
(340, 'ua', '{nFormatted} {n, plural, one{мебібайт} few{мебібайта} many{мебібайтів} other{мебібайта}}'),
(341, 'ru', '{nFormatted} {n, plural, one{мегабайт} few{мегабайта} many{мегабайтов} other{мегабайта}}'),
(341, 'ua', '{nFormatted} {n, plural, one{мегабайт} few{мегабайта} many{мегабайтів} other{мегабайта}}'),
(342, 'ru', '{nFormatted} {n, plural, one{пебибайт} few{пебибайта} many{пебибайтов} other{пебибайта}}'),
(342, 'ua', '{nFormatted} {n, plural, one{пебібайт} few{пебібайта} many{пебібайтів} other{пебібайта}}'),
(343, 'ru', '{nFormatted} {n, plural, one{петабайт} few{петабайта} many{петабайтов} other{петабайта}}'),
(343, 'ua', '{nFormatted} {n, plural, one{петабайт} few{петабайта} many{петабайтів} other{петабайта}}'),
(344, 'ru', '{nFormatted} {n, plural, one{тебибайт} few{тебибайта} many{тебибайтов} other{тебибайта}}'),
(344, 'ua', '{nFormatted} {n, plural, one{тебібайт} few{тебібайта} many{тебібайтів} other{тебібайта}}'),
(345, 'ru', '{nFormatted} {n, plural, one{терабайт} few{терабайта} many{терабайтов} other{терабайта}}'),
(345, 'ua', '{nFormatted} {n, plural, one{терабайт} few{терабайта} many{терабайтів} other{терабайта}}'),
(537, 'en', ''),
(537, 'nl', NULL),
(537, 'ru', 'Переводы'),
(537, 'ua', 'Переклади'),
(538, 'en', 'ID'),
(538, 'nl', NULL),
(538, 'ru', 'ID'),
(538, 'ua', 'ID'),
(538, 'uk', NULL),
(539, 'en', ''),
(539, 'nl', NULL),
(539, 'ru', 'Сообщение'),
(539, 'ua', 'Повідомлення'),
(540, 'en', ''),
(540, 'nl', NULL),
(540, 'ru', 'Категория'),
(540, 'ua', 'Категорія'),
(541, 'en', ''),
(541, 'nl', NULL),
(541, 'ru', 'Статус'),
(541, 'ua', 'Статус'),
(541, 'uk', NULL),
(542, 'en', ''),
(542, 'nl', NULL),
(542, 'ru', 'Переведено'),
(542, 'ua', 'Перекладено'),
(543, 'en', ''),
(543, 'nl', NULL),
(543, 'ru', 'Не переведено'),
(543, 'ua', 'Не перекладено'),
(544, 'en', NULL),
(544, 'nl', NULL),
(544, 'ru', NULL),
(544, 'ua', NULL),
(545, 'en', ''),
(545, 'nl', NULL),
(545, 'ru', 'Меню'),
(545, 'ua', 'Меню'),
(546, 'en', NULL),
(546, 'nl', NULL),
(546, 'ru', NULL),
(546, 'ua', NULL),
(547, 'en', ''),
(547, 'nl', NULL),
(547, 'ru', 'Профиль'),
(547, 'ua', 'Профіль'),
(548, 'en', ''),
(548, 'nl', NULL),
(548, 'ru', 'Пользователи'),
(548, 'ua', 'Користувачі'),
(549, 'en', ''),
(549, 'nl', NULL),
(549, 'ru', 'Данные продукта'),
(549, 'ua', 'Дані продукту'),
(550, 'en', ''),
(550, 'nl', NULL),
(550, 'ru', 'Бренды'),
(550, 'ua', 'Бренди'),
(551, 'en', ''),
(551, 'nl', NULL),
(551, 'ru', 'Логин'),
(551, 'ua', 'Логін'),
(552, 'en', ''),
(552, 'nl', NULL),
(552, 'ru', 'Настройки'),
(552, 'ua', 'Налаштування'),
(553, 'en', ''),
(553, 'nl', NULL),
(553, 'ru', 'Шаблоны'),
(553, 'ua', 'Шаблони'),
(554, 'en', ''),
(554, 'nl', NULL),
(554, 'ru', 'Валюта'),
(554, 'ua', 'Валюта'),
(555, 'en', ''),
(555, 'nl', NULL),
(555, 'ru', 'Обновить'),
(555, 'ua', 'Оновити'),
(556, 'en', ''),
(556, 'nl', NULL),
(556, 'ru', 'Перевод'),
(556, 'ua', 'Переклад'),
(557, 'en', ''),
(557, 'nl', NULL),
(557, 'ru', 'Назад к списку'),
(557, 'ua', 'Назад до списку'),
(558, 'ru', 'Значение «{attribute}» должно быть равно «{compareValueOrAttribute}».'),
(558, 'ua', 'Значення "{attribute}" повинно бути рівним "{compareValueOrAttribute}".'),
(559, 'ru', 'Значение «{attribute}» должно быть больше значения «{compareValueOrAttribute}».'),
(559, 'ua', 'Значення "{attribute}" повинно бути більшим значення "{compareValueOrAttribute}".'),
(560, 'ru', 'Значение «{attribute}» должно быть больше или равно значения «{compareValueOrAttribute}».'),
(560, 'ua', 'Значення "{attribute}" повинно бути більшим або дорівнювати значенню "{compareValueOrAttribute}".'),
(561, 'ru', 'Значение «{attribute}» должно быть меньше значения «{compareValueOrAttribute}».'),
(561, 'ua', 'Значення "{attribute}" повинно бути меншим значення "{compareValueOrAttribute}".'),
(562, 'ru', 'Значение «{attribute}» должно быть меньше или равно значения «{compareValueOrAttribute}».'),
(562, 'ua', 'Значення "{attribute}" повинно бути меншим або дорівнювати значенню "{compareValueOrAttribute}".'),
(563, 'ru', 'Значение «{attribute}» не должно быть равно «{compareValueOrAttribute}».'),
(563, 'ua', 'Значення "{attribute}" не повинно бути рівним "{compareValueOrAttribute}".'),
(564, 'ru', 'Значение «{attribute}» содержит неверную маску подсети.'),
(564, 'ua', 'Значення «{attribute}» містить неправильну маску підмережі.'),
(565, 'ru', 'Значение «{attribute}» не входит в список разрешенных диапазонов адресов.'),
(565, 'ua', 'Значення «{attribute}» не входить в список дозволених діапазонів адрес.'),
(566, 'ru', 'Значение «{attribute}» должно быть правильным IP адресом.'),
(566, 'ua', 'Значення «{attribute}» повинно бути правильною IP адресою.'),
(567, 'ru', 'Значение «{attribute}» должно быть IP адресом с подсетью.'),
(567, 'ua', 'Значення «{attribute}» повинно бути IP адресою з підмережею.'),
(568, 'ru', 'Значение «{attribute}» не должно быть подсетью.'),
(568, 'ua', 'Значення «{attribute}» не повинно бути підмережею.'),
(569, 'ru', 'Значение «{attribute}» не должно быть IPv4 адресом.'),
(569, 'ua', 'Значення «{attribute}» не повинно бути IPv4 адресою.'),
(570, 'ru', 'Значение «{attribute}» не должно быть IPv6 адресом.'),
(570, 'ua', 'Значення «{attribute}» не повинно бути IPv6 адресою.'),
(571, 'ru', '{delta, plural, one{# день} few{# дня} many{# дней} other{# дней}}'),
(571, 'ua', '{delta, plural, one{# день} few{# дні} many{# днів} other{# днів}}'),
(572, 'ru', '{delta, plural, one{# час} few{# часа} many{# часов} other{# часов}}'),
(572, 'ua', '{delta, plural, one{# година} few{# години} many{# годин} other{# годин}}'),
(573, 'ru', '{delta, plural, one{# минута} few{# минуты} many{# минут} other{# минут}}'),
(573, 'ua', '{delta, plural, one{# хвилина} few{# хвилини} many{# хвилин} other{# хвилин}}'),
(574, 'ru', '{delta, plural, one{# месяц} few{# месяца} many{# месяцев} other{# месяцев}}'),
(574, 'ua', '{delta, plural, one{# місяць} few{# місяця} many{# місяців} other{# місяців}}'),
(575, 'ru', '{delta, plural, one{# секунда} few{# секунды} many{# секунд} other{# секунд}}'),
(575, 'ua', '{delta, plural, one{# секунда} few{# секунди} many{# секунд} other{# секунд}}'),
(576, 'ru', '{delta, plural, one{# год} few{# года} many{# лет} other{# лет}}'),
(576, 'ua', '{delta, plural, one{# рік} few{# роки} many{# років} other{# років}}'),
(577, 'en', ''),
(577, 'ru', 'Обновлено'),
(577, 'ua', 'Оновлено'),
(578, 'en', ''),
(578, 'ru', 'Создать'),
(578, 'ua', 'Створити'),
(579, 'en', ''),
(579, 'ru', 'Пользователь'),
(579, 'ua', 'Користувач'),
(579, 'uk', NULL),
(580, 'en', ''),
(580, 'ru', 'Имя пользователя'),
(580, 'ua', 'Ім''я користувача'),
(581, 'en', NULL),
(581, 'ru', NULL),
(581, 'ua', NULL),
(581, 'uk', NULL),
(582, 'en', NULL),
(582, 'ru', NULL),
(582, 'ua', NULL),
(583, 'en', NULL),
(583, 'ru', NULL),
(583, 'ua', NULL),
(584, 'en', NULL),
(584, 'ru', NULL),
(584, 'ua', NULL),
(585, 'en', ''),
(585, 'ru', 'Создан'),
(585, 'ua', 'Створений'),
(585, 'uk', NULL),
(586, 'en', ''),
(586, 'ru', 'Обновлен'),
(586, 'ua', 'Оновлений'),
(586, 'uk', NULL),
(587, 'en', NULL),
(587, 'ru', NULL),
(587, 'ua', NULL),
(588, 'en', ''),
(588, 'ru', 'Новый пароль'),
(588, 'ua', 'Новий пароль'),
(589, 'en', ''),
(589, 'ru', 'Новый пароль (повторение)'),
(589, 'ua', 'Новий пароль (повторення)'),
(590, 'en', ''),
(590, 'ru', 'Роль'),
(590, 'ua', 'Роль'),
(591, 'en', 'Delete'),
(591, 'ru', 'Удалить'),
(591, 'ua', 'Видалити'),
(592, 'en', ''),
(592, 'ru', 'Вы уверены, что хотите удалить эту запись?'),
(592, 'ua', 'Ви впевнені, що хочете видалити цей запис?'),
(593, 'en', ''),
(593, 'ru', 'Роли'),
(593, 'ua', 'Ролі'),
(594, 'en', ''),
(594, 'ru', 'Бренд'),
(594, 'ua', 'Бренд'),
(595, 'en', ''),
(595, 'ru', 'Название'),
(595, 'ua', 'Назва'),
(596, 'en', ''),
(596, 'ru', 'Создать'),
(596, 'ua', 'Створити'),
(597, 'en', ''),
(597, 'ru', 'Шаблон'),
(597, 'ua', 'Шаблон'),
(598, 'en', ''),
(598, 'ru', 'Алиас'),
(598, 'ua', 'Аліас'),
(599, 'en', ''),
(599, 'ru', 'Текст'),
(599, 'ua', 'Текст'),
(600, 'en', ''),
(600, 'ru', 'Валюты'),
(600, 'ua', 'Валюти'),
(601, 'en', ''),
(601, 'ru', 'По умлочанию'),
(601, 'ua', 'За замовченням'),
(602, 'en', ''),
(602, 'ru', 'Нет'),
(602, 'ua', 'Ні'),
(603, 'en', ''),
(603, 'ru', 'Да'),
(603, 'ua', 'Так'),
(604, 'en', NULL),
(604, 'ru', NULL),
(604, 'ua', NULL),
(605, 'en', ''),
(605, 'ru', 'Вход'),
(605, 'ua', 'Вхід'),
(606, 'en', ''),
(606, 'ru', 'Логин'),
(606, 'ua', 'Логін'),
(606, 'uk', NULL),
(607, 'en', ''),
(607, 'ru', 'Войдите для начала Вашей сессии'),
(607, 'ua', 'Ввійдіть для початку Вашої сесії'),
(608, 'en', 'Sign out'),
(608, 'ru', 'Выход'),
(608, 'ua', 'Вихід'),
(609, 'en', 'Enabled'),
(609, 'ru', 'Включено'),
(609, 'ua', 'Ввімкнено'),
(610, 'en', NULL),
(610, 'ru', NULL),
(610, 'ua', NULL),
(611, 'en', NULL),
(611, 'ru', NULL),
(611, 'ua', NULL),
(612, 'en', NULL),
(612, 'ru', NULL),
(612, 'ua', NULL),
(613, 'en', ''),
(613, 'ru', 'Описание'),
(613, 'ua', 'Опис'),
(614, 'en', NULL),
(614, 'ru', NULL),
(614, 'ua', NULL),
(615, 'en', NULL),
(615, 'ru', NULL),
(615, 'ua', NULL),
(616, 'en', NULL),
(616, 'ru', NULL),
(616, 'ua', NULL),
(617, 'en', NULL),
(617, 'ru', NULL),
(617, 'ua', NULL),
(618, 'en', NULL),
(618, 'ru', NULL),
(618, 'ua', NULL),
(619, 'en', ''),
(619, 'ru', 'Сохранить'),
(619, 'ua', 'Зберегти'),
(620, 'en', ''),
(620, 'ru', 'Операция проведена успешно.'),
(620, 'ua', 'Операція проведена успішно.'),
(621, 'en', NULL),
(621, 'ru', NULL),
(621, 'ua', NULL),
(622, 'en', NULL),
(622, 'ru', NULL),
(622, 'ua', NULL),
(623, 'en', NULL),
(623, 'ru', NULL),
(623, 'ua', NULL),
(624, 'en', NULL),
(624, 'ru', NULL),
(624, 'ua', NULL),
(625, 'en', NULL),
(625, 'ru', NULL),
(625, 'ua', NULL),
(626, 'en', NULL),
(626, 'ru', NULL),
(626, 'ua', NULL),
(627, 'en', ''),
(627, 'ru', 'Записи'),
(627, 'ua', 'Записи'),
(628, 'en', ''),
(628, 'ru', 'Запись'),
(628, 'ua', 'Запис'),
(629, 'en', NULL),
(629, 'ru', NULL),
(629, 'ua', NULL),
(630, 'en', NULL),
(630, 'ru', NULL),
(630, 'ua', NULL),
(631, 'en', NULL),
(631, 'ru', NULL),
(631, 'ua', NULL),
(632, 'en', NULL),
(632, 'ru', NULL),
(632, 'ua', NULL),
(633, 'en', ''),
(633, 'ru', 'Страна'),
(633, 'ua', 'Країна'),
(633, 'uk', NULL),
(634, 'en', ''),
(634, 'ru', 'Населенный пункт'),
(634, 'ua', 'Населений пункт'),
(634, 'uk', NULL),
(635, 'en', ''),
(635, 'ru', 'Улица'),
(635, 'ua', 'Вулиця'),
(635, 'uk', NULL),
(636, 'en', ''),
(636, 'ru', 'Почтовый индекс'),
(636, 'ua', 'Поштовий індекс'),
(636, 'uk', NULL),
(637, 'en', NULL),
(637, 'ru', NULL),
(637, 'ua', NULL),
(638, 'en', NULL),
(638, 'ru', NULL),
(638, 'ua', NULL),
(639, 'en', NULL),
(639, 'ru', NULL),
(639, 'ua', NULL),
(640, 'en', NULL),
(640, 'ru', NULL),
(640, 'ua', NULL),
(641, 'en', NULL),
(641, 'ru', NULL),
(641, 'ua', NULL),
(642, 'en', NULL),
(642, 'ru', NULL),
(642, 'ua', NULL),
(643, 'en', NULL),
(643, 'ru', NULL),
(643, 'ua', NULL),
(644, 'en', NULL),
(644, 'ru', NULL),
(644, 'ua', NULL),
(645, 'en', NULL),
(645, 'ru', NULL),
(645, 'ua', NULL),
(646, 'en', NULL),
(646, 'ru', NULL),
(646, 'ua', NULL),
(647, 'en', NULL),
(647, 'ru', NULL),
(647, 'ua', NULL),
(648, 'en', NULL),
(648, 'ru', NULL),
(648, 'ua', NULL),
(649, 'en', NULL),
(649, 'ru', NULL),
(649, 'ua', NULL),
(650, 'en', NULL),
(650, 'ru', NULL),
(650, 'ua', NULL),
(651, 'en', NULL),
(651, 'ru', NULL),
(651, 'ua', NULL),
(652, 'en', NULL),
(652, 'ru', NULL),
(652, 'ua', NULL),
(653, 'en', NULL),
(653, 'ru', NULL),
(653, 'ua', NULL),
(654, 'en', NULL),
(654, 'ru', NULL),
(654, 'ua', NULL),
(655, 'en', NULL),
(655, 'ru', NULL),
(655, 'ua', NULL),
(656, 'en', NULL),
(656, 'ru', NULL),
(656, 'ua', NULL),
(657, 'en', NULL),
(657, 'ru', NULL),
(657, 'ua', NULL),
(658, 'en', 'Title'),
(658, 'ru', 'Заголовок'),
(658, 'ua', 'Заголовок'),
(659, 'en', 'Content'),
(659, 'ru', 'Контент'),
(659, 'ua', 'Контент'),
(660, 'en', 'Sort'),
(660, 'ru', 'Порядок'),
(660, 'ua', 'Порядок'),
(661, 'en', ''),
(661, 'ru', 'Родительський элемент'),
(661, 'ua', 'Батьківський елемент'),
(662, 'en', ''),
(662, 'ru', 'Тип сущности'),
(662, 'ua', 'Тип сутності'),
(663, 'en', ''),
(663, 'ru', 'Сущность'),
(663, 'ua', 'Сутність'),
(664, 'en', ''),
(664, 'ru', 'Введите URL вручную:'),
(664, 'ua', 'Введіть URL власноруч:'),
(665, 'en', 'Sort action'),
(665, 'ru', 'Сортировать'),
(665, 'ua', 'Сортувати'),
(666, 'en', ''),
(666, 'ru', 'Социальные сети'),
(666, 'ua', 'Соціальні мережі'),
(667, 'en', ''),
(667, 'ru', 'Социальная сеть'),
(667, 'ua', 'Соціальна мережа'),
(668, 'en', 'Page not found'),
(668, 'ru', 'Страница не найдена'),
(668, 'ua', 'Сторінку не знайдено'),
(669, 'en', ''),
(669, 'ru', 'Ошибка случилась в результате обработки Вашего запроса. '),
(669, 'ua', 'Помилка сталася в результаті обробки Вашого запиту.'),
(670, 'en', ''),
(670, 'ru', 'Напишите нам, если Вы думаете, что это серверная ошибка. Спасибо.'),
(670, 'ua', 'Напишіть нам, якщо Ви вважаєте, що це серверна помилка. Дякуємо.'),
(671, 'en', ''),
(671, 'ru', 'Склады'),
(671, 'ua', 'Склади'),
(672, 'en', ''),
(672, 'ru', 'Склад'),
(672, 'ua', 'Склад'),
(673, 'en', ''),
(673, 'ru', 'Где купить'),
(673, 'ua', 'Де купити'),
(674, 'en', ''),
(674, 'ru', 'Напишите нам'),
(674, 'ua', 'Напишіть нам'),
(675, 'en', ''),
(675, 'ru', 'Ваше имя'),
(675, 'ua', 'Ваше ім''я'),
(676, 'en', ''),
(676, 'ru', 'Ваш email'),
(676, 'ua', 'Ваш email'),
(677, 'en', ''),
(677, 'ru', 'Ваше сообщение'),
(677, 'ua', 'Ваше повідомлення'),
(678, 'en', ''),
(678, 'ru', 'Отправить'),
(678, 'ua', 'Відправити'),
(679, 'en', ''),
(679, 'ru', 'Адресат'),
(679, 'ua', 'Адресат'),
(680, 'en', ''),
(680, 'ru', 'Отправитель'),
(680, 'ua', 'Відправник'),
(681, 'en', ''),
(681, 'ru', 'Тема'),
(681, 'ua', 'Тема'),
(682, 'en', ''),
(682, 'ru', 'Настройки контактной формы'),
(682, 'ua', 'Налаштування контактної форми'),
(683, 'en', ''),
(683, 'ru', 'Контактная форма'),
(683, 'ua', 'Контактна форма'),
(684, 'en', ''),
(684, 'ru', 'Настройка контактной формы'),
(684, 'ua', 'Налаштування контактної форми'),
(685, 'en', ''),
(685, 'ru', 'Ваше сообщение успешно отправлено. Спасибо.'),
(685, 'ua', 'Ваше повідомлення успішно відправлене. Дякуємо.'),
(686, 'en', ''),
(686, 'ru', 'Слайдеры'),
(686, 'ua', 'Слайдери'),
(687, 'en', ''),
(687, 'ru', 'Слайдер'),
(687, 'ua', 'Слайдер'),
(688, 'en', ''),
(688, 'ru', 'Изображения'),
(688, 'ua', 'Зображення'),
(689, 'en', ''),
(689, 'ru', 'Изображение'),
(689, 'ua', 'Зображення'),
(690, 'en', NULL),
(690, 'ru', NULL),
(690, 'ua', NULL),
(691, 'en', NULL),
(691, 'ru', NULL),
(691, 'ua', NULL),
(692, 'en', ''),
(692, 'ru', 'Главная страница'),
(692, 'ua', 'Головна сторінка'),
(693, 'en', ''),
(693, 'ru', 'Родительская категория'),
(693, 'ua', 'Батьківська категорія'),
(694, 'en', ''),
(694, 'ru', 'Категории'),
(694, 'ua', 'Категорії'),
(695, 'en', ''),
(695, 'ru', 'Магазин'),
(695, 'ua', 'Магазин'),
(696, 'en', ''),
(696, 'ru', 'Группы характеристик'),
(696, 'ua', 'Групи характеристик'),
(697, 'en', ''),
(697, 'ru', 'Группа характеристик'),
(697, 'ua', 'Група характеристик'),
(698, 'en', ''),
(698, 'ru', 'Характеристики'),
(698, 'ua', 'Характеристики'),
(699, 'en', ''),
(699, 'ru', 'Характеристика'),
(699, 'ua', 'Характеристика'),
(700, 'en', ''),
(700, 'ru', 'Артикул'),
(700, 'ua', 'Артикул'),
(701, 'en', ''),
(701, 'ru', 'Цена'),
(701, 'ua', 'Ціна'),
(702, 'en', ''),
(702, 'ru', 'На складе'),
(702, 'ua', 'На складі'),
(703, 'en', ''),
(703, 'ru', 'Товары'),
(703, 'ua', 'Товари'),
(704, 'en', ''),
(704, 'ru', 'Товар'),
(704, 'ua', 'Товар'),
(704, 'uk', NULL),
(705, 'en', ''),
(705, 'ru', 'Выберите'),
(705, 'ua', 'Виберіть'),
(706, 'en', ''),
(706, 'ru', 'Простой товар'),
(706, 'ua', 'Простий товар'),
(707, 'en', ''),
(707, 'ru', 'Вариативный продукт'),
(707, 'ua', 'Варіативний продукт'),
(708, 'en', ''),
(708, 'ru', 'Тип'),
(708, 'ua', 'Тип'),
(709, 'en', ''),
(709, 'ru', 'Вариации'),
(709, 'ua', 'Варіації'),
(710, 'en', NULL),
(710, 'ru', NULL),
(710, 'ua', NULL),
(711, 'en', ''),
(711, 'ru', 'Галерея'),
(711, 'ua', 'Галерея'),
(712, 'en', ''),
(712, 'ru', 'Категории товаров'),
(712, 'ua', 'Категорії товарів'),
(713, 'en', ''),
(713, 'ru', 'Фильтр'),
(713, 'ua', 'Фільтр'),
(714, 'en', ''),
(714, 'ru', 'Категории товаров'),
(714, 'ua', 'Категорії товарів'),
(715, 'en', ''),
(715, 'ru', 'Просмотреть'),
(715, 'ua', 'Переглянути'),
(716, 'en', ''),
(716, 'ru', 'Временно отстутствует'),
(716, 'ua', 'Тимчасово відсутній'),
(717, 'en', ''),
(717, 'ru', 'Типы меню'),
(717, 'ua', 'Типи меню'),
(718, 'en', ''),
(718, 'ru', 'Тип меню'),
(718, 'ua', 'Тип меню'),
(719, 'en', ''),
(719, 'ru', 'Полезная информация'),
(719, 'ua', 'Корисна інформація'),
(719, 'uk', NULL),
(720, 'en', 'Clear'),
(720, 'ru', 'Очистить'),
(720, 'ua', 'Очистити'),
(721, 'en', 'result(s)'),
(721, 'ru', 'результат(а)'),
(721, 'ua', 'результат(и)'),
(722, 'en', ''),
(722, 'ru', 'Количество товаров:'),
(722, 'ua', 'Кількість товарів:'),
(723, 'en', ''),
(723, 'ru', 'Цена по спаданию'),
(723, 'ua', 'Ціна за спаданням'),
(724, 'en', ''),
(724, 'ru', 'Цена по возрастанию'),
(724, 'ua', 'Ціна за зростанням'),
(725, 'en', ''),
(725, 'ru', 'Сортировать по'),
(725, 'ua', 'Сортувати по'),
(726, 'en', ''),
(726, 'ru', 'Краткое описание'),
(726, 'ua', 'Короткий опис'),
(727, 'en', ''),
(727, 'ru', 'Показывать после цены'),
(727, 'ua', 'Показувати після ціни'),
(728, 'en', ''),
(728, 'ru', 'Добавить в корзину'),
(728, 'ua', 'Додати до кошику'),
(729, 'en', ''),
(729, 'ru', 'Выберите размер'),
(729, 'ua', 'Оберіть розмір'),
(730, 'en', ''),
(730, 'ru', 'Количество'),
(730, 'ua', 'Кількість'),
(731, 'en', ''),
(731, 'ru', 'Необходимо выбрать размер'),
(731, 'ua', 'Необхідно обрати розмір'),
(732, 'en', ''),
(732, 'ru', 'Необходимо ввести количество'),
(732, 'ua', 'Необхідно ввести кількість'),
(733, 'en', ''),
(733, 'ru', 'Добавить в список желаний'),
(733, 'ua', 'Додати до списку бажань'),
(734, 'en', ''),
(734, 'ru', 'Вход в личный кабинет'),
(734, 'ua', 'Вхід в особистий кабінет'),
(735, 'en', ''),
(735, 'ru', 'Пароль'),
(735, 'ua', 'Пароль'),
(736, 'en', ''),
(736, 'ru', 'Запомнить меня'),
(736, 'ua', 'Запам''ятати мене'),
(737, 'en', ''),
(737, 'ru', 'Вход'),
(737, 'ua', 'Вхід'),
(738, 'en', NULL),
(738, 'ru', NULL),
(738, 'ua', NULL),
(739, 'en', ''),
(739, 'ru', 'Забыли пароль?'),
(739, 'ua', 'Забули пароль?'),
(740, 'en', ''),
(740, 'ru', 'Неверный логин или пароль.'),
(740, 'ua', 'Невірний логін чи пароль.'),
(741, 'en', ''),
(741, 'ru', 'Регистрация'),
(741, 'ua', 'Реєстрація'),
(741, 'uk', NULL),
(742, 'en', ''),
(742, 'ru', 'Этот логин уже используется.'),
(742, 'ua', 'Цей логін вже використовується.'),
(743, 'en', ''),
(743, 'ru', 'Этот email уже используется.'),
(743, 'ua', 'Цей email вже використовується.'),
(744, 'en', ''),
(744, 'ru', 'Я хочу получать новости от Jenadin'),
(744, 'ua', 'Я хочу отримувати новини від Jenadin'),
(745, 'en', ''),
(745, 'ru', 'Подписка'),
(745, 'ua', 'Підписка'),
(746, 'en', ''),
(746, 'ru', 'Оставайтесь с нами'),
(746, 'ua', 'Залишайтеся з нами'),
(746, 'uk', NULL),
(747, 'en', ''),
(747, 'ru', 'Подписаться на новости'),
(747, 'ua', 'Підписатися на новини'),
(747, 'uk', NULL),
(748, 'en', ''),
(748, 'ru', 'Новинки'),
(748, 'ua', 'Новинки'),
(749, 'en', ''),
(749, 'ru', 'Новость'),
(749, 'ua', 'Новини'),
(750, 'en', ''),
(750, 'ru', 'Вы уверены, что хотите разослать новость?'),
(750, 'ua', 'Ви впевнені, що хочете розіслати новину?'),
(751, 'en', ''),
(751, 'ru', 'Видео'),
(751, 'ua', 'Відео'),
(752, 'en', ''),
(752, 'ru', 'Удалить'),
(752, 'ua', 'Видалити'),
(753, 'en', ''),
(753, 'ru', 'Комплекты'),
(753, 'ua', 'Комплекти'),
(754, 'en', ''),
(754, 'ru', 'Комплект'),
(754, 'ua', 'Комплект'),
(755, 'en', NULL),
(755, 'ru', NULL),
(755, 'ua', NULL),
(756, 'en', ''),
(756, 'ru', 'Как носить'),
(756, 'ua', 'Як носити'),
(757, 'en', ''),
(757, 'ru', 'Вам также может понравиться'),
(757, 'ua', 'Вам також може сподобатися'),
(758, 'en', ''),
(758, 'ru', 'Корзина'),
(758, 'ua', 'Кошик'),
(758, 'uk', NULL),
(759, 'en', ''),
(759, 'ru', 'Продолжить покупки'),
(759, 'ua', 'Продовжити покупки'),
(760, 'en', 'Price:'),
(760, 'ru', 'Цена:'),
(760, 'ua', 'Ціна:'),
(761, 'en', ''),
(761, 'ru', 'Сумма:'),
(761, 'ua', 'Сума:'),
(762, 'en', ''),
(762, 'ru', 'Корзина успешно обновлена.'),
(762, 'ua', 'Кошик успішно оновлено.'),
(763, 'en', ''),
(763, 'ru', 'В корзине нет товаров.'),
(763, 'ua', 'У кошику немає товарів.'),
(764, 'en', ''),
(764, 'ru', 'Сумма в корзине'),
(764, 'ua', 'Сума в кошику'),
(765, 'en', ''),
(765, 'ru', 'Итого'),
(765, 'ua', 'Разом'),
(765, 'uk', NULL),
(766, 'en', ''),
(766, 'ru', 'Оформить заказ'),
(766, 'ua', 'Оформити замовлення'),
(767, 'en', NULL),
(767, 'ru', NULL),
(767, 'ua', NULL),
(768, 'en', ''),
(768, 'ru', 'Размера нет на складе.'),
(768, 'ua', 'Розміру немає на складі.'),
(769, 'en', ''),
(769, 'ru', 'Сброс пароля'),
(769, 'ua', 'Скидання пароля'),
(770, 'en', 'Please fill out your email. A link to reset password will be sent there.'),
(770, 'ru', 'Пожалуйста, введите email. Ссылка для сброса пароля будет отправлена на этот адрес.'),
(770, 'ua', 'Будь ласка, введіть email. Посилання для скидування паролю буде відправлене на цю адресу.'),
(771, 'en', ''),
(771, 'ru', 'Сброс пароля для Jenadin'),
(771, 'ua', 'Скидання пароля для Jenadin'),
(772, 'en', ''),
(772, 'ru', 'Привет'),
(772, 'ua', 'Привіт'),
(773, 'en', ''),
(773, 'ru', 'Следуйте за ссылкой ниже для сброса пароля.'),
(773, 'ua', 'Слідуйте за посиланням нижче для скидування пароля.'),
(774, 'en', ''),
(774, 'ru', 'Нет пользователя с таким email.'),
(774, 'ua', 'Немає користувача з таким email.'),
(775, 'en', ''),
(775, 'ru', 'Проверьте email для дальнейших инструкций.'),
(775, 'ua', 'Перевірте email для подальших інструкцій.'),
(776, 'en', ''),
(776, 'ru', 'Сбросить пароль'),
(776, 'ua', 'Скинуть пароль'),
(777, 'en', ''),
(777, 'ru', 'Пожалуйста, выберите новый пароль:'),
(777, 'ua', 'Будь ласка, виберіть новий пароль:'),
(778, 'en', ''),
(778, 'ru', 'Новый пароль был сохранен.'),
(778, 'ua', 'Новий пароль був збережений.'),
(779, 'en', 'Hello, %s. (%s). From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.'),
(779, 'ru', 'Здравствуйте, %s (%s). В консоли вашего аккаунта вы можете просматривать недавние заказы, настроить адрес доставки и реквизиты оплаты, а также изменить пароль и анкету.'),
(779, 'ua', 'Привіт %s. (%s). В консолі Вашого акаунту Ви можете переглядати замовлення, налаштувати адресу доставки та реквізити оплати, а також змінити пароль і анкету.'),
(780, 'en', ''),
(780, 'ru', 'Выход'),
(780, 'ua', 'Вихід'),
(781, 'en', ''),
(781, 'ru', 'Детали профиля'),
(781, 'ua', 'Деталі профіля'),
(782, 'en', ''),
(782, 'ru', 'Адрес'),
(782, 'ua', 'Адреса'),
(783, 'en', ''),
(783, 'ru', 'Просмотр или редактирование даных пользователя.'),
(783, 'ua', 'Перегляд чи редагування даних користувача.'),
(784, 'en', ''),
(784, 'ru', 'Редактирование даных о адресе.'),
(784, 'ua', 'Редагування даних про адресу.'),
(785, 'en', ''),
(785, 'ru', 'Избранное'),
(785, 'ua', 'Вибране'),
(785, 'uk', NULL),
(786, 'en', ''),
(786, 'ru', 'Заказы'),
(786, 'ua', 'Замовлення'),
(787, 'en', ''),
(787, 'ru', 'Просмотр истории заказов.'),
(787, 'ua', 'Перегляд історії замовлень.'),
(788, 'en', ''),
(788, 'ru', 'Просмотр избранных товаров.'),
(788, 'ua', 'Перегляд вибраних товарів.'),
(789, 'en', ''),
(789, 'ru', 'Назад к просмотру профиля'),
(789, 'ua', 'Назад до перегляду профілю'),
(790, 'en', ''),
(790, 'ru', 'Профиль успешно обновлен.'),
(790, 'ua', 'Профіль успішно оновлений.'),
(791, 'en', ''),
(791, 'ru', 'Адрес'),
(791, 'ua', 'Адреса'),
(791, 'uk', NULL),
(792, 'en', ''),
(792, 'ru', 'Имя'),
(792, 'ua', 'Ім''я'),
(792, 'uk', NULL),
(793, 'en', ''),
(793, 'ru', 'Фамилия'),
(793, 'ua', 'Прізвище'),
(793, 'uk', NULL),
(794, 'en', ''),
(794, 'ru', 'Телефон'),
(794, 'ua', 'Телефон'),
(794, 'uk', NULL),
(795, 'en', ''),
(795, 'ru', 'Область'),
(795, 'ua', 'Область'),
(795, 'uk', NULL),
(796, 'en', ''),
(796, 'ru', 'Дом'),
(796, 'ua', 'Будинок'),
(796, 'uk', NULL),
(797, 'en', ''),
(797, 'ru', 'Квартира'),
(797, 'ua', 'Квартира'),
(797, 'uk', NULL),
(798, 'en', ''),
(798, 'ru', 'Адрес успешно обновлен.'),
(798, 'ua', 'Адреса успішно оновлена.'),
(799, 'en', ''),
(799, 'ru', 'Товар был успешно удален с избранных.'),
(799, 'ua', 'Товар був успішно видалений з вибраних.'),
(800, 'en', 'There is no product in your wish list.'),
(800, 'ru', 'В списке избранных нет товаров.'),
(800, 'ua', 'У списку вибраних немає товарів.'),
(801, 'en', ''),
(801, 'ru', 'Примечание'),
(801, 'ua', 'Замітка'),
(801, 'uk', NULL),
(802, 'en', ''),
(802, 'ru', 'Тип оплаты'),
(802, 'ua', 'Тип оплати'),
(802, 'uk', NULL),
(803, 'en', ''),
(803, 'ru', 'Заказ'),
(803, 'ua', 'Замовлення'),
(804, 'en', ''),
(804, 'ru', 'Оформление заказа'),
(804, 'ua', 'Оформлення замовлення'),
(804, 'uk', NULL),
(805, 'en', ''),
(805, 'ru', 'Детали оплаты'),
(805, 'ua', 'Деталі замовлення'),
(805, 'uk', NULL),
(806, 'en', ''),
(806, 'ru', 'Ваш заказ'),
(806, 'ua', 'Ваше замовлення'),
(806, 'uk', NULL),
(807, 'en', ''),
(807, 'ru', 'Общая цена'),
(807, 'ua', 'Загальна ціна'),
(807, 'uk', NULL),
(808, 'en', ''),
(808, 'ru', 'Типы оплаты'),
(808, 'ua', 'Типи оплати'),
(809, 'en', ''),
(809, 'ru', 'Разместить заказ'),
(809, 'ua', 'Розмістити замовлення'),
(809, 'uk', NULL),
(810, 'en', ''),
(810, 'ru', 'Получатели'),
(810, 'ua', 'Отримувачі'),
(811, 'en', ''),
(811, 'ru', 'Тема письма'),
(811, 'ua', 'Тема листа'),
(812, 'en', ''),
(812, 'ru', 'Шаблоны писем'),
(812, 'ua', 'Шаблони листів'),
(813, 'en', ''),
(813, 'ru', 'Шаблон письма'),
(813, 'ua', 'Шаблон листа'),
(814, 'en', ''),
(814, 'ru', 'Просмотр письма'),
(814, 'ua', 'Перегляд листа'),
(815, 'en', NULL),
(815, 'ru', NULL),
(815, 'ua', NULL),
(816, 'en', ''),
(816, 'ru', 'Имя "От кого"'),
(816, 'ua', 'Ім''я "Від кого"'),
(817, 'en', ''),
(817, 'ru', 'Адрес отправителя'),
(817, 'ua', 'Адреса відправника'),
(818, 'en', NULL),
(818, 'ru', NULL),
(818, 'ua', NULL),
(819, 'en', ''),
(819, 'ru', 'Настройки email'),
(819, 'ua', 'Налаштування email'),
(820, 'en', ''),
(820, 'ru', 'Настройка email'),
(820, 'ua', 'Налаштування email'),
(821, 'en', 'You have received an order from %s %s. The order is as follows:'),
(821, 'ru', 'Вы получили заказ от %s %s. Детали заказа:'),
(821, 'ua', 'Ви отримали замовлення від %s %s. Деталі замовлення:'),
(822, 'en', ''),
(822, 'ru', 'Информация о клиенте'),
(822, 'ua', 'Інформація про клієнта'),
(823, 'en', ''),
(823, 'ru', 'Спасибо!'),
(823, 'ua', 'Дякуємо!'),
(824, 'en', ''),
(824, 'ru', 'Ваш заказ принят!'),
(824, 'ua', 'Ваше замовлення прийняте!'),
(825, 'en', ''),
(825, 'ru', 'Наш менеджер свяжется с вами'),
(825, 'ua', 'Наш менеджер зв''яжеться з вами'),
(826, 'en', 'Hi there. Your recent order on Jenadin has been completed. Your order details are shown below for your reference:'),
(826, 'ru', 'Здравствуйте. Ваш недавний заказ от Jenadin был выполнен. Информация о заказе предоставлена ниже для вашего удобства:'),
(826, 'ua', 'Привіт. Ваше нещодавнє замовлення від Jenadin було завершено. Деталі Вашого замовлення, наведені нижче для вашої довідки:'),
(827, 'en', ''),
(827, 'ru', 'Ваш заказ успешно принят!'),
(827, 'ua', 'Ваше замовлення успішно прийняте!'),
(828, 'en', ''),
(828, 'ru', 'Номер'),
(828, 'ua', 'Номер'),
(829, 'en', ''),
(829, 'ru', 'В обработке'),
(829, 'ua', 'В обробці'),
(830, 'en', ''),
(830, 'ru', 'Оплачен'),
(830, 'ua', 'Оплачений'),
(831, 'en', ''),
(831, 'ru', 'Отказан'),
(831, 'ua', 'Відмовлений'),
(832, 'en', ''),
(832, 'ru', 'Ничего не выбрано'),
(832, 'ua', 'Нічого не вибрано'),
(833, 'en', ''),
(833, 'ru', 'Позиции'),
(833, 'ua', 'Позиції'),
(834, 'en', ''),
(834, 'ru', 'Ваша корзина пуста.'),
(834, 'ua', 'Ваш кошик пустий.'),
(835, 'en', ''),
(835, 'ru', 'Открыть меню'),
(835, 'ua', 'Відкрити меню'),
(835, 'uk', NULL),
(836, 'en', ''),
(836, 'ru', 'Поиск'),
(836, 'ua', 'Пошук'),
(836, 'uk', NULL),
(837, 'en', ''),
(837, 'ru', 'Назад'),
(837, 'ua', 'Назад'),
(837, 'uk', NULL),
(838, 'en', ''),
(838, 'ru', 'Мой кабинет'),
(838, 'ua', 'Мій кабінет'),
(838, 'uk', NULL),
(839, 'en', NULL),
(839, 'ru', NULL),
(839, 'ua', NULL),
(840, 'en', NULL),
(840, 'ru', NULL),
(840, 'ua', NULL),
(841, 'en', ''),
(841, 'ru', 'Процент, %'),
(841, 'ua', 'Відсоток, %');
INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(842, 'en', ''),
(842, 'ru', 'Акции'),
(842, 'ua', 'Акції'),
(843, 'en', ''),
(843, 'ru', 'Распродажа'),
(843, 'ua', 'Розпродаж'),
(844, 'en', ''),
(844, 'ru', 'Загрузить товары с коллекции:'),
(844, 'ua', 'Завантажити товари з колеції:'),
(845, 'en', NULL),
(845, 'ru', 'Вы уверены, что хотите добавить выбраную коллекцию?'),
(845, 'ua', 'Ви впевнені, що хочете додати обрану колекцію?'),
(846, 'en', 'Sale'),
(846, 'ru', 'Распродажа'),
(846, 'ua', 'Розпродаж'),
(847, 'en', ''),
(847, 'ru', 'Новинка'),
(847, 'ua', 'Новинка'),
(848, 'en', 'Novelties'),
(848, 'ru', 'Новинки'),
(848, 'ua', 'Новинки'),
(849, 'en', 'Novelty'),
(849, 'ru', 'Новинка'),
(849, 'ua', 'Новинка'),
(850, 'en', ''),
(850, 'ru', 'Размер и характеристики'),
(850, 'ua', 'Розмір і характеристики'),
(851, 'en', ''),
(851, 'ru', 'Примечания производителя'),
(851, 'ua', 'Замітки виробника'),
(852, 'en', ''),
(852, 'ru', 'Иконка'),
(852, 'ua', 'Іконка'),
(853, 'en', ''),
(853, 'ru', 'Таблица размеров'),
(853, 'ua', 'Таблиця розмірів'),
(854, 'en', 'Basket'),
(854, 'ru', 'Корзина'),
(854, 'ua', 'Кошик'),
(855, 'en', 'You have added the product to the basket:'),
(855, 'ru', 'Вы добавили товар в корзину:'),
(855, 'ua', 'Ви додали товар у кошик:'),
(856, 'en', ''),
(856, 'ru', 'Успешно добавлено'),
(856, 'ua', 'Успішно додано'),
(857, 'en', ''),
(857, 'ru', 'В ожидании оплаты'),
(857, 'ua', 'В очікуванні оплати'),
(858, 'en', 'Congratulations! You have placed your order. Below is the link to proceed the payment.'),
(858, 'ru', 'Поздравляем! Вы разместили заказ. Ниже ссылка для оплаты заказа.'),
(858, 'ua', 'Вітаємо! Ви розмістили своє замовлення. Нижче посилання для оплати замовлення. '),
(859, 'en', ''),
(859, 'ru', 'Результаты поиска:'),
(859, 'ua', 'Результати пошуку:'),
(860, 'en', NULL),
(860, 'ru', NULL),
(860, 'ua', NULL),
(861, 'en', ''),
(861, 'ru', 'Нет результатов, задовольняющих запрос:'),
(861, 'ua', 'Немає результатів, які задовольняють запит:'),
(862, 'en', ''),
(862, 'ru', 'Журналы'),
(862, 'ua', 'Журнали'),
(863, 'en', ''),
(863, 'ru', 'Журнал'),
(863, 'ua', 'Журнал'),
(864, 'en', ''),
(864, 'ru', 'Страницы'),
(864, 'ua', 'Сторінки'),
(865, 'en', ''),
(865, 'ru', 'Дата заказа'),
(865, 'ua', 'Дата замовлення'),
(866, 'en', NULL),
(866, 'ru', NULL),
(866, 'ua', NULL),
(867, 'en', ''),
(867, 'ru', 'Персональные данные'),
(867, 'ua', 'Персональні дані'),
(868, 'en', ''),
(868, 'ru', 'Данные о заказе'),
(868, 'ua', 'Дані замовлення'),
(869, 'en', ''),
(869, 'ru', 'Назад к списку заказов'),
(869, 'ua', 'Назад до списку замовлень'),
(870, 'en', 'Nothing was found.'),
(870, 'ru', 'Ничего не найдено.'),
(870, 'ua', 'Нічого не знайдено.'),
(871, 'en', ''),
(871, 'ru', 'SEO описание для категории товара'),
(871, 'ua', 'SEO опис для категорії товару'),
(872, 'en', NULL),
(872, 'ru', NULL),
(872, 'ua', NULL),
(873, 'en', NULL),
(873, 'ru', NULL),
(873, 'ua', NULL),
(874, 'en', NULL),
(874, 'ru', NULL),
(874, 'ua', NULL),
(875, 'en', NULL),
(875, 'ru', NULL),
(875, 'ua', NULL),
(876, 'en', NULL),
(876, 'ru', NULL),
(876, 'ua', NULL),
(877, 'en', NULL),
(877, 'ru', NULL),
(877, 'ua', NULL),
(878, 'en', 'You have added the product to the basket:'),
(878, 'ru', 'Вы добавили товар в корзину:'),
(878, 'ua', 'Ви додали товар у кошик:'),
(879, 'en', NULL),
(879, 'ru', NULL),
(879, 'ua', NULL),
(880, 'en', NULL),
(880, 'ru', NULL),
(880, 'ua', NULL),
(881, 'en', NULL),
(881, 'ru', NULL),
(881, 'ua', NULL),
(882, 'en', ''),
(882, 'ru', ''),
(882, 'ua', 'Error (#535) '),
(883, 'en', ''),
(883, 'ru', 'Перейти к сайту'),
(883, 'ua', 'Перейти до сайту'),
(884, 'en', ''),
(884, 'ru', 'Просмотр на сайте'),
(884, 'ua', 'Перегляд на сайті'),
(885, 'en', ''),
(885, 'ru', 'Предпросмотр'),
(885, 'ua', 'Перегляд'),
(886, 'en', ''),
(886, 'ru', 'Режим просмотра'),
(886, 'ua', 'Режим перегляду'),
(887, 'en', ''),
(887, 'ru', 'Коллекции'),
(887, 'ua', 'Колекції'),
(888, 'en', ''),
(888, 'ru', 'Ассортимент'),
(888, 'ua', 'Асортимент'),
(889, 'en', ''),
(889, 'ru', 'Интернет-магазин'),
(889, 'ua', 'Інтернет-магазин'),
(890, 'en', NULL),
(890, 'ru', NULL),
(890, 'ua', NULL),
(891, 'en', ''),
(891, 'ru', 'Главная страница'),
(891, 'ua', 'Головна сторінка'),
(892, 'en', ''),
(892, 'ru', 'Каталог изделий'),
(892, 'ua', 'Каталог виробів'),
(893, 'en', NULL),
(893, 'ru', NULL),
(893, 'ua', NULL),
(894, 'en', ''),
(894, 'ru', 'Прямой переход'),
(894, 'ua', 'Прямий перехід'),
(895, 'en', NULL),
(895, 'ru', NULL),
(895, 'ua', NULL),
(896, 'en', ''),
(896, 'ru', 'Главная'),
(896, 'ua', 'Головна'),
(897, 'en', NULL),
(897, 'ru', NULL),
(897, 'ua', NULL),
(898, 'en', NULL),
(898, 'ru', NULL),
(898, 'ua', NULL),
(899, 'en', ''),
(899, 'ru', 'Пароль (повтор)'),
(899, 'ua', 'Пароль (повтор)'),
(900, 'en', NULL),
(900, 'ru', NULL),
(900, 'ua', NULL),
(901, 'en', NULL),
(901, 'ru', NULL),
(901, 'ua', NULL),
(902, 'en', ''),
(902, 'ru', 'Показывать в фильтре'),
(902, 'ua', 'Показувати в фільтрі'),
(903, 'en', ''),
(903, 'ru', 'Описание доставки в товаре'),
(903, 'ua', 'Опис доставки в товарі'),
(904, 'en', ''),
(904, 'ru', 'Доставка'),
(904, 'ua', 'Доставка'),
(905, 'en', ''),
(905, 'ru', 'Юридический раздел'),
(905, 'ua', 'Юридичний розділ'),
(906, 'en', 'Name'),
(906, 'ru', 'Имя'),
(906, 'ua', 'Ім''я'),
(907, 'en', ''),
(907, 'ru', 'Спасибо, ваш пароль заменен.'),
(907, 'ua', 'Дякуємо, Ваш пароль змінений.'),
(908, 'en', 'Novelties'),
(908, 'ru', 'Новинки'),
(908, 'ua', 'Новинки'),
(909, 'en', ''),
(909, 'ru', 'Предзаказ'),
(909, 'ua', 'Передзамовлення'),
(910, 'en', ''),
(910, 'ru', 'ФИО'),
(910, 'ua', 'ПІБ'),
(911, 'en', ''),
(911, 'ru', 'Размер'),
(911, 'ua', 'Розмір'),
(912, 'en', 'Pre-order'),
(912, 'ru', 'Предзаказ'),
(912, 'ua', 'Передзамовлення'),
(913, 'en', 'Your request is accepted. Wait for the notification email when the product will be available.'),
(913, 'ru', 'Ваш запрос принят. Мы Вас проинформируем в случае наличия товара.'),
(913, 'ua', 'Ваш запит прийнято. Ми Вас проінформуємо у випадку наявності товару.'),
(914, 'en', ''),
(914, 'ru', 'Уважаемый(ая)'),
(914, 'ua', 'Шановний(а)'),
(915, 'en', 'The product you have requested is available now!'),
(915, 'ru', 'Товар, который Вы запрашивали, есть в наличии!'),
(915, 'ua', 'Товар, який Ви запитували, є в наявності!'),
(916, 'en', 'Go to the %s for selling it!'),
(916, 'ru', 'Переходите на %s для осуществления покупки!'),
(916, 'ua', 'Переходьте на %s для здійснення покупки!'),
(917, 'en', ''),
(917, 'ru', 'страницу товара'),
(917, 'ua', 'сторінку товару'),
(918, 'en', ''),
(918, 'ru', 'Предзаказы'),
(918, 'ua', 'Передзамовлення'),
(919, 'en', ''),
(919, 'ru', 'Новое окно'),
(919, 'ua', 'Нове вікно'),
(920, 'en', NULL),
(920, 'ru', NULL),
(920, 'ua', NULL),
(921, 'en', ''),
(921, 'ru', 'Юридический раздел'),
(921, 'ua', 'Юридичний розділ'),
(922, 'en', NULL),
(922, 'ru', NULL),
(922, 'ua', NULL),
(923, 'en', ''),
(923, 'ru', 'Подробнее'),
(923, 'ua', 'Детальніше'),
(924, 'en', ''),
(924, 'ru', 'Категории блога'),
(924, 'ua', 'Категорії блогу'),
(925, 'en', ''),
(925, 'ru', 'Категория блога'),
(925, 'ua', 'Категорія блогу'),
(926, 'en', ''),
(926, 'ru', 'Записи блога'),
(926, 'ua', 'Записи блогу'),
(927, 'en', ''),
(927, 'ru', 'Запись блога'),
(927, 'ua', 'Запис блогу'),
(928, 'en', ''),
(928, 'ru', 'Сопутствующий товар'),
(928, 'ua', 'Супутній товар'),
(929, 'en', ''),
(929, 'ru', 'Связи товаров'),
(929, 'ua', 'Зв''язки товарів'),
(930, 'en', ''),
(930, 'ru', 'Связь товаров'),
(930, 'ua', 'Зв''язок товарів'),
(931, 'en', ''),
(931, 'ru', 'Такая связь уже существует.'),
(931, 'ua', 'Такий зв''язок вже існує.'),
(932, 'en', ''),
(932, 'ru', 'Выберите, пожалуйста, разные товары'),
(932, 'ua', 'Виберіть, будь ласка, різні товари'),
(933, 'en', ''),
(933, 'ru', 'Перейти к профилю'),
(933, 'ua', 'Перейти до профілю'),
(934, 'en', ''),
(934, 'ru', 'Регистрация'),
(934, 'ua', 'Реєстрація'),
(935, 'en', ''),
(935, 'ru', 'Типы доставок'),
(935, 'ua', 'Типи доставок'),
(936, 'en', ''),
(936, 'ru', 'Тип доставки'),
(936, 'ua', 'Тип доставки'),
(937, 'en', ''),
(937, 'ru', 'Год'),
(937, 'ua', 'Рік'),
(938, 'en', ''),
(938, 'ru', 'Продолжительность'),
(938, 'ua', 'Тривалість'),
(939, 'en', ''),
(939, 'ru', 'Возрастное ограничение'),
(939, 'ua', 'Вікове обмеження'),
(940, 'en', ''),
(940, 'ru', 'Рейтинг'),
(940, 'ua', 'Рейтинг'),
(941, 'en', ''),
(941, 'ru', 'Дата сьемки'),
(941, 'ua', 'Дата зйомки'),
(942, 'en', ''),
(942, 'ru', 'Трейлер'),
(942, 'ua', 'Трейлер'),
(943, 'en', ''),
(943, 'ru', 'Количество просмотров'),
(943, 'ua', 'Кількість переглядів'),
(944, 'en', ''),
(944, 'ru', 'Удален'),
(944, 'ua', 'Видалений'),
(945, 'en', NULL),
(945, 'ru', NULL),
(945, 'ua', NULL),
(946, 'en', NULL),
(946, 'ru', NULL),
(946, 'ua', NULL),
(947, 'en', 'Innovative solutions to trade'),
(947, 'ru', 'Инновационные решения для торговли'),
(947, 'ua', 'Інноваційні рішення для торгівлі'),
(948, 'en', 'Many years of experience in the market'),
(948, 'ru', 'Многолетний опыт <br/> работы на рынке'),
(948, 'ua', 'Багаторічний досвід <br/> роботи на ринку'),
(949, 'en', ''),
(949, 'ru', 'Наши преимущества'),
(949, 'ua', 'Наші переваги'),
(950, 'en', ''),
(950, 'ru', 'Многолетний опыт'),
(950, 'ua', 'Багаторічний досвід'),
(951, 'en', 'We work in the market more than 20 year'),
(951, 'ru', 'Мы работаем на рынке больше 20 лет'),
(951, 'ua', 'Ми працюємо на ринку більше 20 років'),
(952, 'en', ''),
(952, 'ru', 'Современный подход'),
(952, 'ua', 'Сучасний підхід'),
(953, 'en', ''),
(953, 'ru', 'Мы используем инновационный подход для решения задач'),
(953, 'ua', 'Ми використовуємо інноваційний підхід для вирішення задач'),
(954, 'en', ''),
(954, 'ru', 'Универсальность'),
(954, 'ua', 'Універсальність'),
(955, 'en', ''),
(955, 'ru', 'Мы разрабатываем устройства исходя с требований разных стран'),
(955, 'ua', 'Ми розробляємо пристрої виходячи з вимог різних країн'),
(956, 'en', ''),
(956, 'ru', 'Наши партнеры'),
(956, 'ua', 'Наші партнери'),
(957, 'en', 'Address: Bazhana Ave, 16A, Kyiv, 02000'),
(957, 'ru', 'Адрес: ул. Бажана, 16А, Киев, 02000'),
(957, 'ua', 'Адреса: вул. Бажана, 16А, Київ, 02000'),
(958, 'en', ''),
(958, 'ru', 'Оставьте сообщение'),
(958, 'ua', 'Залиште повідомлення'),
(959, 'en', 'Help Micro Company presents a set of hardware and software technologies for<br/> trade automation and reception of utility and postal payments.'),
(959, 'ru', 'Компания Хелп-Микро представляет набор аппаратно-программных технологий для<br/> автоматизации торговли и приема коммунальных и почтовых платежей. '),
(959, 'ua', 'Компанія Хелп-Мікро представляє набір апаратно-програмних технологій для<br/> автоматизації торгівлі і прийому комунальних та поштових платежів.'),
(960, 'en', ''),
(960, 'ru', 'Наши достижения'),
(960, 'ua', 'Наші досягнення'),
(961, 'en', ''),
(961, 'ru', 'Файлы'),
(961, 'ua', 'Файли'),
(962, 'en', ''),
(962, 'ru', 'Файл'),
(962, 'ua', 'Файл'),
(963, 'en', 'Product'),
(963, 'ru', 'Продукция'),
(963, 'ua', 'Продукція'),
(964, 'en', ''),
(964, 'ru', 'Купить'),
(964, 'ua', 'Купити'),
(965, 'en', NULL),
(965, 'ru', NULL),
(965, 'ua', NULL),
(966, 'en', NULL),
(966, 'ru', NULL),
(966, 'ua', NULL),
(967, 'en', ''),
(967, 'ru', 'Полезные данные'),
(967, 'ua', 'Корисні дані'),
(968, 'en', ''),
(968, 'ru', 'Увеличить'),
(968, 'ua', 'Збільшити'),
(969, 'en', ''),
(969, 'ru', 'Полезные файлы'),
(969, 'ua', 'Корисні файли'),
(970, 'en', ''),
(970, 'ru', 'Скачать'),
(970, 'ua', 'Скачати'),
(971, 'en', ''),
(971, 'ru', 'Перейти на главную страницу'),
(971, 'ua', 'Перейти до головної сторінки'),
(972, 'en', ''),
(972, 'ru', 'Драйвер для Windows'),
(972, 'ua', 'Драйвер для Windows'),
(973, 'en', ''),
(973, 'ru', 'Инструкция обновления веб-интерфейса'),
(973, 'ua', 'Інструкція оновлення веб-інтерфейсу'),
(974, 'en', ''),
(974, 'ru', 'Перечень команд и описание протоколов обмена с внешними устройствами'),
(974, 'ua', 'Перелік команд і опис протоколів обміну з зовнішніми пристроями'),
(975, 'en', ''),
(975, 'ru', 'Обработка под 1С по HTTP протоколу'),
(975, 'ua', 'Обробка під 1С за протоколом HTTP'),
(976, 'en', ''),
(976, 'ru', 'Универсальный драйвер для 1С Предприятие'),
(976, 'ua', 'Універсальний драйвер для 1С Підприємство');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1455877224),
('m130524_201442_init', 1455877230),
('m140506_102106_rbac_init', 1457026314),
('m160220_100848_add_new_field_to_user', 1455963027),
('m160516_081703_lang', 1463386881),
('m160516_095736_lang_translations', 1463393919);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `alias` varchar(255) NOT NULL,
  `template` varchar(20) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `created_at`, `updated_at`, `enabled`, `alias`, `template`, `default`) VALUES
(1, 1502005649, 1503055902, 1, 'home', 'content-wide', 1),
(4, 1503066027, 1503066027, 1, 'contacts', 'content-wide', 0),
(5, 1503145005, 1503148236, 1, 'about-us', 'content', 0),
(6, 1503148677, 1503148690, 1, 'services', 'content', 0),
(7, 1503231608, 1503231608, 1, 'shop', 'content', 0),
(8, 1503398579, 1503402779, 1, 'developers', 'content', 0);

-- --------------------------------------------------------

--
-- Table structure for table `postlang`
--

CREATE TABLE IF NOT EXISTS `postlang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `language` varchar(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `language` (`language`),
  KEY `post_id_2` (`post_id`,`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `postlang`
--

INSERT INTO `postlang` (`id`, `post_id`, `language`, `title`, `content`) VALUES
(1, 1, 'en', 'Home', '<p>main home</p>'),
(2, 1, 'ru', 'Главная', '<p>главная страница</p>'),
(3, 1, 'ua', 'Головна', '<p>головна сторінка</p>'),
(10, 4, 'en', 'How to reach us', ''),
(11, 4, 'ru', 'Как нас найти', ''),
(12, 4, 'ua', 'Як нас знайти', ''),
(13, 5, 'en', 'About us', '<p class="lead" style="text-align: left;">The firm developed and introduced system cash registers of various models into production at OOO "Expotrade", NPF "Unisystem", JV "Link", GNPP "Elektronmash", SE "Kiev Radiozavod". Apparatuses successfully work in the offices of Ukrainian banks, Ukrpochta offices, as well as in the largest trade enterprises (Central Department Store, Children''s World, Department Store Ukraine).<br /> Specialists of the company have developed and implemented automated subsystems for managing the trading floor in these and other enterprises.<br /> The firm also has tremendous experience in the foreign market, as evidenced by the successful implementation of the company''s equipment in the Czech Republic, Bulgaria, Belarus and other countries.</p>'),
(14, 5, 'ru', 'О нас', '<p class="lead" style="text-align: left;">Фирмой разработаны и внедрены в производство на ООО "Экспотрейд", НПФ "Юнисистем", СП "Линк", ГНПП "Электронмаш", ГП "Киевский Радиозавод" системные кассовые аппараты различных моделей. Аппараты с успехом работают в отделениях банков Украины, отделениях "Укрпочты", а также в крупнейших торговых предприятиях (АО "Центральный Универмаг", AO "Детский мир", АО "Универмаг Украина").&nbsp;<br />Специалисты фирмы разработали и внедрили в этих и других предприятиях автоматизированные подсистемы управления торговым залом.<br />Фирма также имеет колоссальный опыт работы на иностранном рынке, чему&nbsp;свидетельствуют успешные внедрения аппаратов компании в Чехии, Болгарии, Беларуси и других странах.</p>'),
(15, 5, 'ua', 'Про нас', '<p class="lead" style="text-align: left;">Фірмою розроблені і впроваджені у виробництво на ТОВ "Експотрейд", НПФ "Юнісістем", СП "Лінк", ДНВП "Електронмаш", ДП "Київський Радіозавод" системні касові апарати різних моделей. Апарати з успіхом працюють у відділеннях банків України, відділеннях "Укрпошти", а також в найбільших торгівельних підприємствах (АТ "Центральний Універмаг", AO "Дитячий світ", АТ "Універмаг Україна").<br /> Фахівці фірми розробили і впровадили в цих та інших підприємствах автоматизовані підсистеми управління торговим залом.<br /> Фірма також має колосальний досвід роботи на іноземному ринку, чому свідчать успішні впровадження апаратів компанії в Чехії, Болгарії, Білорусі та інших країнах.</p>'),
(16, 6, 'en', 'Services', ''),
(17, 6, 'ru', 'Услуги', ''),
(18, 6, 'ua', 'Послуги', ''),
(19, 7, 'en', 'Product', ''),
(20, 7, 'ru', 'Продукция', ''),
(21, 7, 'ua', 'Продукція', ''),
(22, 8, 'en', 'Developers', '<p>Cash registers "Help Micro" have built-in web-server, which works on the port 80, and also have ability to work in TCP/IP networks. Exchange protocol is based on the HTTP protocol, JSON is used for data formatting.</p>\r\n<p>Protocol allows to:</p>\r\n<ul>\r\n<li>receive and synchronize information about receipts;</li>\r\n<li>signup the operator;</li>\r\n<li>work with integrated modem;</li>\r\n<li>configure options and check the state of the fiscal memory;</li>\r\n<li>configure options for working with TCP/IP network;</li>\r\n<li>configure types of payment;</li>\r\n<li>configure the appearance of the check;</li>\r\n<li>print reports.</li>\r\n</ul>\r\n<p>For more detailed information about the protocol please follow the link: <a href="https://onedrive.live.com/view.aspx?resid=D0A995B8978622E5!730&amp;app=Word&amp;authkey=!AGqp4kFSKtMCt3w" target="_blank" rel="noopener">protocol documentation</a>.&nbsp;&nbsp;</p>'),
(23, 8, 'ru', 'Разработчикам', '<p>Кассовые аппараты "Хелп Микро" имеют встроенный веб-сервер, который работает на порте 80, а также имеют возможность работы в сетях TCP/IP. Протокол работы с аппаратом базируется на протоколе HTTP, в качестве формата обмена данных используется JSON.</p>\r\n<p>Протокол позволяет:</p>\r\n<ul>\r\n<li>получать и синхронизировать информацию по чекам;</li>\r\n<li>регистрировать оператора и вести список операторов аппарата;</li>\r\n<li>работать со встроенным модемом ДПА,;</li>\r\n<li>настраивать параметры и проверять состояние фискальной памяти;</li>\r\n<li>настраивать параметры работы с сетью TCP/IP;</li>\r\n<li>настраивать параметры видов оплат;</li>\r\n<li>настраивать внешний вид чека;</li>\r\n<li>печатать отчеты.</li>\r\n</ul>\r\n<p>Для более подробного ознакомления с протоколом перейдите по ссылке: <a href="https://onedrive.live.com/view.aspx?resid=D0A995B8978622E5!730&amp;app=Word&amp;authkey=!AGqp4kFSKtMCt3w" target="_blank" rel="noopener">документация протокола обмена</a>.&nbsp;&nbsp;</p>'),
(24, 8, 'ua', 'Розробникам', '<p>Касові апарати "Хелп Мікро" містять вбудований веб-сервер, що працює на порті 80, а також мають можливість роботи в мережах TCP/IP. Протокол роботи з апаратом побудований на протоколі HTTP, як формат обміну даними використовується JSON.</p>\r\n<p>Протокол дозволяє:</p>\r\n<ul>\r\n<li>отримувати та синхронізувати інформацію про чеки;</li>\r\n<li>реєструвати оператора;</li>\r\n<li>працювати зі вбудованим модемом;</li>\r\n<li>налаштовувати параметри та перевіряти стан фіскальної пам''яті;</li>\r\n<li>налаштовувати параметри роботи з мережею TCP/IP;</li>\r\n<li>налаштовувати параметри видів оплат;</li>\r\n<li>налаштовувати зовнішній вигляд чеку;</li>\r\n<li>друкувати звіти.</li>\r\n</ul>\r\n<p>Для детальнішого ознайомлення з протоколом перейдіть за посиланням: <a href="https://onedrive.live.com/view.aspx?resid=D0A995B8978622E5!730&amp;app=Word&amp;authkey=!AGqp4kFSKtMCt3w" target="_blank" rel="noopener">документація протоколу обміну</a>.&nbsp;&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `enabled` int(11) NOT NULL,
  `vendor_code` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL,
  `image_color` varchar(255) DEFAULT NULL,
  `buy_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `created_at`, `updated_at`, `enabled`, `vendor_code`, `sort`, `price`, `in_stock`, `alias`, `type`, `currency_id`, `video`, `is_new`, `image_color`, `buy_link`) VALUES
(114, 1503223302, 1503472583, 1, 'MG-N707TS', NULL, 1200, NULL, 'MG-N707TS', 'simple', 1, NULL, 0, NULL, 'https://gera.com.ua/oborudovanie/fiskalnye-registratory/fiskalnyy-registrator-mg-n707ts/'),
(115, 1503478714, 1503483580, 1, 'MG-T787TL', NULL, 11, NULL, 'MG-T787TL', 'simple', 1, NULL, 0, NULL, 'https://gera.com.ua/oborudovanie/fiskalnye-registratory/fiskalnyy-registrator-mg-t787tl/'),
(116, 1503482892, 1503483880, 1, 'MG-P777TL', NULL, 1, NULL, 'MG-P777TL', 'simple', 1, NULL, 0, NULL, 'https://gera.com.ua/oborudovanie/fiskalnye-registratory/fiskalnyy-registrator-mg-p777tl/');

-- --------------------------------------------------------

--
-- Table structure for table `productlang`
--

CREATE TABLE IF NOT EXISTS `productlang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `size_fit` text NOT NULL,
  `editor_notes` text NOT NULL,
  `content` text NOT NULL,
  `short_description` text,
  `table_size` text NOT NULL,
  `search_text` text,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`,`language`),
  FULLTEXT KEY `search_text` (`search_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=364 ;

--
-- Dumping data for table `productlang`
--

INSERT INTO `productlang` (`id`, `product_id`, `language`, `title`, `size_fit`, `editor_notes`, `content`, `short_description`, `table_size`, `search_text`) VALUES
(340, 114, 'en', 'MG N707TS', '', '<p>The simplicity, affordable price and high quality are the basic qualities of the fiscal registrar MG-N707TS, which is ideal for small companies and private entrepreneurs.</p>\r\n<ul>\r\n<li>It is entered in the State Register of PPO of Ukraine and corresponds to the norms effective from January 1, 2015</li>\r\n<li>Built-in modem for on-line transfer of control tape in electronic form to the fiscal service</li>\r\n<li>Print speed up to 56 millimeters per second</li>\r\n<li>Great design</li>\r\n<li>High reliability</li>\r\n</ul>\r\n<p>MG-N707TS &mdash; a fiscal registrar based on a time-tested fiscal printer Bono-E, from the Polish company Novitus, a well-known European manufacturer of fiscal equipment. The registrar is equipped with a built-in customer indicator and has an exceptionally attractive design. Features of the fiscal registrar (PPO) MG-N707TS:</p>\r\n<ul>\r\n<li>Compliance with statutory regulations effective January 1, 2015</li>\r\n<li>Simple check tape loading (Easy-load technology)</li>\r\n<li>All necessary interfaces for easy connection to POS, PC, LAN, cash box</li>\r\n<li>Compatibility with software from leading Ukrainian manufacturers</li>\r\n<li>Quality service throughout Ukraine. Solving any problem during of 72 hours.</li>\r\n</ul>\r\n<p>The fiscal registrar MG-N707TS is ideal for small businesses and private entrepreneurs.</p>', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Software version:</td>\r\n<td>MG-07</td>\r\n</tr>\r\n<tr>\r\n<td>Buyer indicator:</td>\r\n<td>built-in luminescent, 5 rows of 16 characters</td>\r\n</tr>\r\n<tr>\r\n<td>Channels of access to the Internet:</td>\r\n<td>1 x Ethernet (RJ-45)</td>\r\n</tr>\r\n<tr>\r\n<td>Number of cashiers:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Number of keys:</td>\r\n<td>4 control buttons and navigation key</td>\r\n</tr>\r\n<tr>\r\n<td>Number of departments:</td>\r\n<td>15</td>\r\n</tr>\r\n<tr>\r\n<td>Number of characters in the product name:</td>\r\n<td>50</td>\r\n</tr>\r\n<tr>\r\n<td>Number of characters per line:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Number of goods:</td>\r\n<td>from 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Contents of delivery:</td>\r\n<td>Fiscal registrar, power supply, user guide, passport</td>\r\n</tr>\r\n<tr>\r\n<td>Control tape:</td>\r\n<td>Control tape in electronic form</td>\r\n</tr>\r\n<tr>\r\n<td>Printer model:</td>\r\n<td>Seiko LTPC 245 (Japan)</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with negative total:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with a positive result:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Connectable devices:</td>\r\n<td>PC, money box</td>\r\n</tr>\r\n<tr>\r\n<td>Color:</td>\r\n<td>Black</td>\r\n</tr>\r\n<tr>\r\n<td>Paper width:</td>\r\n<td>57,5 mm</td>\r\n</tr>\r\n<tr>\r\n<td>Print speed:</td>\r\n<td>56 mm/sec</td>\r\n</tr>\r\n<tr>\r\n<td>Interfaces of connection:</td>\r\n<td>1xRS-232, 1xUSB (В type), 1x(RJ-12, 6 V)</td>\r\n</tr>\r\n<tr>\r\n<td>Max. roll diameter:</td>\r\n<td>83 mm</td>\r\n</tr>\r\n<tr>\r\n<td>Presence of an auto-cutter:</td>\r\n<td>No</td>\r\n</tr>\r\n<tr>\r\n<td>Source of power:</td>\r\n<td>220 V, 50 Hz; adapter 9 V, 2 A</td>\r\n</tr>\r\n<tr>\r\n<td>Working temperature:</td>\r\n<td>+5&deg;C &hellip; +45&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Humidity:</td>\r\n<td>from 40 to 80% at a temperature of +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Dimensions:</td>\r\n<td>146 x 215 x 190 mm</td>\r\n</tr>\r\n<tr>\r\n<td>Weight:</td>\r\n<td>1,75 kg</td>\r\n</tr>\r\n<tr>\r\n<td>Guarantee:</td>\r\n<td>18 months</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p class="group inner list-group-item-text">Simplicity, affordable price and high quality are the main features of the fiscal registrar MG-N707TS, which is ideal for small companies and private entrepreneurs.</p>', '', 'FISCAL REGISTERS MG N707TS  SOFTWARE VERSION: MG-07 BUYER INDICATOR: BUILT-IN LUMINESCENT, 5 ROWS OF 16 CHARACTERS CHANNELS ACCESS TO THE INTERNET: 1 X ETHERNET (RJ-45) NUMBER CASHIERS: 32 KEYS: 4 CONTROL BUTTONS AND NAVIGATION KEY DEPARTMENTS: 15 IN PRODUCT NAME: 50 PER LINE: GOODS: FROM 8000 CONTENTS DELIVERY: REGISTRAR, POWER SUPPLY, USER GUIDE, PASSPORT CONTROL TAPE: TAPE ELECTRONIC FORM PRINTER MODEL: SEIKO LTPC 245 (JAPAN) TAX GROUPS WITH NEGATIVE TOTAL: A POSITIVE RESULT: CONNECTABLE DEVICES: PC, MONEY BOX COLOR: BLACK PAPER WIDTH: 57,5 MM PRINT SPEED: 56 MM/SEC INTERFACES CONNECTION: 1XRS-232, 1XUSB (В TYPE), 1X(RJ-12, 6 V) MAX. ROLL'),
(341, 114, 'ru', 'MG N707TS', '', '<p>Простота, доступная цена и высокое качество - основные качества фискального регистратора MG-N707TS, который идеально подходит для небольших компаний и частных предпринимателей.</p>\r\n<ul>\r\n<li>Введен в Государственный Реестр РРО Украины и соответствует нормам, действующим с 1 января 2015 года</li>\r\n<li>Встроенный модем для on-line передачи контрольной ленты в электронной форме (КЛЭФ) в фискальную службу</li>\r\n<li>Скорость печати до 56 миллиметров в секунду</li>\r\n<li>Великолепный дизайн</li>\r\n<li>Высокая надежность</li>\r\n</ul>\r\n<p>MG-N707TS &mdash; фискальный регистратор на базе проверенного временем фискального принтера Bono-E, от польской компании Novitus, известного европейского производителя фискальной техники. Регистратор оснащен встроенным индикатором клиента и имеет исключительно привлекательный дизайн. Особенности фискального регистратора (РРО) MG-N707TS:</p>\r\n<ul>\r\n<li>Соответствие законодательным нормам, действующим с 1 января 2015 г.</li>\r\n<li>Элементарная загрузка чековой ленты (технология Easy-load)</li>\r\n<li>Все необходимые интерфейсы для простого подключения к POS, ПК, локальной сети, денежному ящику</li>\r\n<li>Совместимость с ПО ведущих украинских производителей</li>\r\n<li>Качественный сервис на всей территории Украины. Решение любой проблемы в течение максимум 72 часов.</li>\r\n</ul>\r\n<p>Фискальный регистратор MG-N707TS идеально подходит для небольших предприятий и частных предпринимателей.</p>', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Версия ПО:</td>\r\n<td>MG-07</td>\r\n</tr>\r\n<tr>\r\n<td>Индикатор покупателя:</td>\r\n<td>встроенный люминесцентный, 5 рядов по 16 символов</td>\r\n</tr>\r\n<tr>\r\n<td>Каналы доступа в интернет:</td>\r\n<td>1 x Ethernet (RJ-45)</td>\r\n</tr>\r\n<tr>\r\n<td>Количество кассиров:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Количество клавиш:</td>\r\n<td>4 кнопки управления и клавиша навигации</td>\r\n</tr>\r\n<tr>\r\n<td>Количество отделов:</td>\r\n<td>15</td>\r\n</tr>\r\n<tr>\r\n<td>Количество символов в названии товара:</td>\r\n<td>50</td>\r\n</tr>\r\n<tr>\r\n<td>Количество символов в строке:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Количество товаров:</td>\r\n<td>от 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Комплект поставки:</td>\r\n<td>Фиск. регистратор, БП, руководство польз., паспорт</td>\r\n</tr>\r\n<tr>\r\n<td>Контрольная лента:</td>\r\n<td>КЛЭФ</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтера:</td>\r\n<td>Seiko LTPC 245 (Япония)</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с отрицательным итогом:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с положительным итогом:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Подключаемые устройства:</td>\r\n<td>ПК, денежный ящик</td>\r\n</tr>\r\n<tr>\r\n<td>Цвет:</td>\r\n<td>Черный</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина бумаги:</td>\r\n<td>57,5 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Скорость печати:</td>\r\n<td>56 мм/сек</td>\r\n</tr>\r\n<tr>\r\n<td>Интерфейсы подключения:</td>\r\n<td>1xRS-232, 1xUSB (тип В), 1x(RJ-12, 6 В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. диаметр рулона:</td>\r\n<td>83 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Наличие автообрезчика:</td>\r\n<td>Нет</td>\r\n</tr>\r\n<tr>\r\n<td>Источник питания:</td>\r\n<td>220 В, 50 Гц; адаптер 9 В, 2 А</td>\r\n</tr>\r\n<tr>\r\n<td>Рабочая температура:</td>\r\n<td>+5&deg;C &hellip; +45&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Влажность:</td>\r\n<td>от 40 до 80% при температуре +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритные размеры:</td>\r\n<td>146 x 215 x 190 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Вес:</td>\r\n<td>1,75 кг</td>\r\n</tr>\r\n<tr>\r\n<td>Гарантия:</td>\r\n<td>18 месяцев</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p class="group inner list-group-item-text">Простота, доступная цена и высокое качество - основные качества фискального регистратора MG-N707TS, который идеально подходит для небольших компаний и частных предпринимателей.</p>', '', 'ФИСКАЛЬНЫЕ РЕГИСТРАТОРЫ MG N707TS  ВЕРСИЯ ПО: MG-07 ИНДИКАТОР ПОКУПАТЕЛЯ: ВСТРОЕННЫЙ ЛЮМИНЕСЦЕНТНЫЙ, 5 РЯДОВ ПО 16 СИМВОЛОВ КАНАЛЫ ДОСТУПА В ИНТЕРНЕТ: 1 X ETHERNET (RJ-45) КОЛИЧЕСТВО КАССИРОВ: 32 КЛАВИШ: 4 КНОПКИ УПРАВЛЕНИЯ И КЛАВИША НАВИГАЦИИ ОТДЕЛОВ: 15 НАЗВАНИИ ТОВАРА: 50 СТРОКЕ: ТОВАРОВ: ОТ 8000 КОМПЛЕКТ ПОСТАВКИ: ФИСК. РЕГИСТРАТОР, БП, РУКОВОДСТВО ПОЛЬЗ., ПАСПОРТ КОНТРОЛЬНАЯ ЛЕНТА: КЛЭФ МОДЕЛЬ ПРИНТЕРА: SEIKO LTPC 245 (ЯПОНИЯ) НАЛОГОВЫЕ ГРУППЫ С ОТРИЦАТЕЛЬНЫМ ИТОГОМ: ПОЛОЖИТЕЛЬНЫМ ПОДКЛЮЧАЕМЫЕ УСТРОЙСТВА: ПК, ДЕНЕЖНЫЙ ЯЩИК ЦВЕТ: ЧЕРНЫЙ ШИРИНА БУМАГИ: 57,5 ММ СКОРОСТЬ ПЕЧАТИ: 56 ММ/СЕК ИНТЕРФЕЙСЫ ПОДКЛЮЧЕНИЯ: 1XRS-232, 1XUSB (ТИП В), 1X(RJ-12, 6 В) МАКС. ДИАМЕТР РУЛОНА: 83 НАЛИЧИЕ АВТООБРЕЗЧИКА: НЕТ ИСТОЧНИК ПИТАНИЯ:'),
(342, 114, 'ua', 'MG N707TS', '', '<p>Простота, доступна ціна та висока якість - основні якості фіскального реєстратора MG-N707TS, який ідеально підходить для невеликих компаній і приватних підприємців.</p>\r\n<ul>\r\n<li>Введений в Державний Реєстр РРО України і відповідає нормам, що діють з 1 січня 2015 року</li>\r\n<li>Вбудований модем для on-line передачі контрольної стрічки в електронній формі (КСЕФ) в фіскальну службу</li>\r\n<li>Швидкість друку до 56 міліметрів в секунду</li>\r\n<li>Чудовий дизайн</li>\r\n<li>Висока надійність</li>\r\n</ul>\r\n<p>MG-N707TS &mdash; фіскальний реєстратор на базі перевіреного часом фіскального принтера Bono-E, від польської компанії Novitus, відомого європейського виробника фіскальної техніки. Реєстратор оснащений вбудованим індикатором клієнта і має виключно привабливий дизайн. Особливості фіскального реєстратора (РРО) MG-N707TS:</p>\r\n<ul>\r\n<li>Відповідність законодавчим нормам, що діють з 1 січня 2015 р.</li>\r\n<li>Елементарне завантаження чекової стрічки (технологія Easy-load)</li>\r\n<li>Всі необхідні інтерфейси для простого підключення до POS, ПК, локальної мережі, грошового ящика</li>\r\n<li>Сумісність з ПЗ провідних українських виробників</li>\r\n<li>Якісний сервіс на всій території України. Вирішення будь-якої проблеми протягом максимум 72 годин.</li>\r\n</ul>\r\n<p>Фіскальний реєстратор MG-N707TS ідеально підходить для невеликих підприємств і приватних підприємців.</p>', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Версія ПЗ:</td>\r\n<td>MG-07</td>\r\n</tr>\r\n<tr>\r\n<td>Індикатор покупця:</td>\r\n<td>вбудований люмінесцентний, 5 рядів по 16 символів</td>\r\n</tr>\r\n<tr>\r\n<td>Канали доступу в інтернет:</td>\r\n<td>1 x Ethernet (RJ-45)</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість касирів:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість клавіш:</td>\r\n<td>4 кнопки керування і клавіша навігації</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість відділів:</td>\r\n<td>15</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість символів в назві товару:</td>\r\n<td>50</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість символів в рядку:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість товарів:</td>\r\n<td>від 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Комплект поставки:</td>\r\n<td>Фіск. реєстратор, БЖ, керівництво користувача, паспорт</td>\r\n</tr>\r\n<tr>\r\n<td>Контрольна стрічка:</td>\r\n<td>КСЕФ</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтера:</td>\r\n<td>Seiko LTPC 245 (Японія)</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з негативним підсумком:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з позитивним підсумком:</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>Пристрої, що підключаються:</td>\r\n<td>ПК, грошовий ящик</td>\r\n</tr>\r\n<tr>\r\n<td>Колір:</td>\r\n<td>Чорний</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина паперу:</td>\r\n<td>57,5 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Швидкість друку:</td>\r\n<td>56 мм/сек</td>\r\n</tr>\r\n<tr>\r\n<td>Інтерфейси підключення:</td>\r\n<td>1xRS-232, 1xUSB (тип В), 1x(RJ-12, 6 В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. діаметр рулону:</td>\r\n<td>83 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Наявність автообрізувальника:</td>\r\n<td>Ні</td>\r\n</tr>\r\n<tr>\r\n<td>Джерело живлення:</td>\r\n<td>220 В, 50 Гц; адаптер 9 В, 2 А</td>\r\n</tr>\r\n<tr>\r\n<td>Робоча температура:</td>\r\n<td>+5&deg;C &hellip; +45&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Вологість:</td>\r\n<td>від 40 до 80% за температури +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритні розміри:</td>\r\n<td>146 x 215 x 190 мм</td>\r\n</tr>\r\n<tr>\r\n<td>Вага:</td>\r\n<td>1,75 кг</td>\r\n</tr>\r\n<tr>\r\n<td>Гарантія:</td>\r\n<td>18 місяців</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p class="group inner list-group-item-text">Простота, доступна ціна та висока якість - основні якості фіскального реєстратора MG-N707TS, який ідеально підходить для невеликих компаній і приватних підприємців.</p>', '', 'ФІСКАЛЬНІ РЕЄСТРАТОРИ MG N707TS  ВЕРСІЯ ПЗ: MG-07 ІНДИКАТОР ПОКУПЦЯ: ВБУДОВАНИЙ ЛЮМІНЕСЦЕНТНИЙ, 5 РЯДІВ ПО 16 СИМВОЛІВ КАНАЛИ ДОСТУПУ В ІНТЕРНЕТ: 1 X ETHERNET (RJ-45) КІЛЬКІСТЬ КАСИРІВ: 32 КЛАВІШ: 4 КНОПКИ КЕРУВАННЯ І КЛАВІША НАВІГАЦІЇ ВІДДІЛІВ: 15 НАЗВІ ТОВАРУ: 50 РЯДКУ: ТОВАРІВ: ВІД 8000 КОМПЛЕКТ ПОСТАВКИ: ФІСК. РЕЄСТРАТОР, БЖ, КЕРІВНИЦТВО КОРИСТУВАЧА, ПАСПОРТ КОНТРОЛЬНА СТРІЧКА: КСЕФ МОДЕЛЬ ПРИНТЕРА: SEIKO LTPC 245 (ЯПОНІЯ) ПОДАТКОВІ ГРУПИ З НЕГАТИВНИМ ПІДСУМКОМ: ПОЗИТИВНИМ ПРИСТРОЇ, ЩО ПІДКЛЮЧАЮТЬСЯ: ПК, ГРОШОВИЙ ЯЩИК КОЛІР: ЧОРНИЙ ШИРИНА ПАПЕРУ: 57,5 ММ ШВИДКІСТЬ ДРУКУ: 56 ММ/СЕК ІНТЕРФЕЙСИ ПІДКЛЮЧЕННЯ: 1XRS-232, 1XUSB (ТИП В), 1X(RJ-12, 6 В) МАКС. ДІАМЕТР РУЛОНУ: 83 НАЯВНІСТЬ АВТООБРІЗУВАЛЬНИКА: НІ ДЖЕРЕЛО'),
(358, 115, 'en', 'MG T787TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Number of cashiers:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Number of characters in the product name:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Number of goods:</td>\r\n<td>8000</td>\r\n</tr>\r\n<tr>\r\n<td>Printer model:</td>\r\n<td>Toshiba TRST-A00.01.UA</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with negative total:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with a positive result:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Power supply:</td>\r\n<td>24 V, 2,5 A</td>\r\n</tr>\r\n<tr>\r\n<td>Monitor type:</td>\r\n<td>Liquid crystal / fluorescent</td>\r\n</tr>\r\n<tr>\r\n<td>Paper width:</td>\r\n<td>57,5 or 80,00</td>\r\n</tr>\r\n<tr>\r\n<td>Print type:</td>\r\n<td>Thermal printing</td>\r\n</tr>\r\n<tr>\r\n<td>Print speed:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Interfaces of connection:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24V)</td>\r\n</tr>\r\n<tr>\r\n<td>Max. roll diameter:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Presence of an auto-cutter:</td>\r\n<td>Yes</td>\r\n</tr>\r\n<tr>\r\n<td>Working temperature:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Humidity:</td>\r\n<td>from 40 to 80% at a temperature of +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Dimensions:</td>\r\n<td>150 х 185 х 142</td>\r\n</tr>\r\n<tr>\r\n<td>Weight:</td>\r\n<td>1,8 kg</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'FISCAL REGISTERS MG T787TL  NUMBER OF CASHIERS: 32 CHARACTERS IN THE PRODUCT NAME: 85 GOODS: 8000 PRINTER MODEL: TOSHIBA TRST-A00.01.UA TAX GROUPS WITH NEGATIVE TOTAL: 6 A POSITIVE RESULT: POWER SUPPLY: 24 V, 2,5 A MONITOR TYPE: LIQUID CRYSTAL / FLUORESCENT PAPER WIDTH: 57,5 OR 80,00 PRINT THERMAL PRINTING SPEED: 200 INTERFACES CONNECTION: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24V) MAX. ROLL DIAMETER: 76 PRESENCE AN AUTO-CUTTER: YES WORKING TEMPERATURE: +5&DEG;C &HELLIP; +40&DEG;C HUMIDITY: FROM 40 TO 80% AT TEMPERATURE +25&DEG;С DIMENSIONS: 150 Х 185 142 WEIGHT: 1,8 KG'),
(359, 115, 'ru', 'MG T787TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Количество кассиров:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Количество символов в названии товара:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Количество товаров:</td>\r\n<td>8000</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтера:</td>\r\n<td>Toshiba TRST-A00.01.UA</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с отрицательным итогом:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с положительным итогом:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Питание:</td>\r\n<td>24 В, 2,5 А</td>\r\n</tr>\r\n<tr>\r\n<td>Тип дисплея:</td>\r\n<td>жидкокристаллический / люминесцентный</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина бумаги:</td>\r\n<td>57,5 или 80,00</td>\r\n</tr>\r\n<tr>\r\n<td>Тип печати:</td>\r\n<td>Термопечать</td>\r\n</tr>\r\n<tr>\r\n<td>Скорость печати:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Интерфейсы подключения:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. диаметр рулона:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Наличие автообрезчика:</td>\r\n<td>Да</td>\r\n</tr>\r\n<tr>\r\n<td>Рабочая температура:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Влажность:</td>\r\n<td>от 40 до 80% при температуре +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритные размеры:</td>\r\n<td>150 х 185 х 142</td>\r\n</tr>\r\n<tr>\r\n<td>Вес:</td>\r\n<td>1,8 кг</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'ФИСКАЛЬНЫЕ РЕГИСТРАТОРЫ MG T787TL  КОЛИЧЕСТВО КАССИРОВ: 32 СИМВОЛОВ В НАЗВАНИИ ТОВАРА: 85 ТОВАРОВ: 8000 МОДЕЛЬ ПРИНТЕРА: TOSHIBA TRST-A00.01.UA НАЛОГОВЫЕ ГРУППЫ С ОТРИЦАТЕЛЬНЫМ ИТОГОМ: 6 ПОЛОЖИТЕЛЬНЫМ ПИТАНИЕ: 24 В, 2,5 А ТИП ДИСПЛЕЯ: ЖИДКОКРИСТАЛЛИЧЕСКИЙ / ЛЮМИНЕСЦЕНТНЫЙ ШИРИНА БУМАГИ: 57,5 ИЛИ 80,00 ПЕЧАТИ: ТЕРМОПЕЧАТЬ СКОРОСТЬ 200 ИНТЕРФЕЙСЫ ПОДКЛЮЧЕНИЯ: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В) МАКС. ДИАМЕТР РУЛОНА: 76 НАЛИЧИЕ АВТООБРЕЗЧИКА: ДА РАБОЧАЯ ТЕМПЕРАТУРА: +5&DEG;C &HELLIP; +40&DEG;C ВЛАЖНОСТЬ: ОТ 40 ДО 80% ПРИ ТЕМПЕРАТУРЕ +25&DEG;С ГАБАРИТНЫЕ РАЗМЕРЫ: 150 Х 185 142 ВЕС: 1,8 КГ'),
(360, 115, 'ua', 'MG T787TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Кількість касирів:</td>\r\n<td>32</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість символів в назві товару:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість товарів:</td>\r\n<td>8000</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтеру:</td>\r\n<td>Toshiba TRST-A00.01.UA</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з негативним підсумком:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з позитивним підсумком:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Живлення:</td>\r\n<td>24 В, 2,5 А</td>\r\n</tr>\r\n<tr>\r\n<td>Тип дисплея:</td>\r\n<td>рідкокристалічний / люмінесцентний</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина паперу:</td>\r\n<td>57,5 или 80,00</td>\r\n</tr>\r\n<tr>\r\n<td>Тип друку:</td>\r\n<td>Термодрук</td>\r\n</tr>\r\n<tr>\r\n<td>Швидкість друку:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Інтерфейси підключення:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. діаметр рулону:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Наявність автообрізувальника:</td>\r\n<td>Так</td>\r\n</tr>\r\n<tr>\r\n<td>Робоча температура:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Вологість:</td>\r\n<td>від 40 до 80% за температури +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритні розміри:</td>\r\n<td>150 х 185 х 142</td>\r\n</tr>\r\n<tr>\r\n<td>Вага:</td>\r\n<td>1,8 кг</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'ФІСКАЛЬНІ РЕЄСТРАТОРИ MG T787TL  КІЛЬКІСТЬ КАСИРІВ: 32 СИМВОЛІВ В НАЗВІ ТОВАРУ: 85 ТОВАРІВ: 8000 МОДЕЛЬ ПРИНТЕРУ: TOSHIBA TRST-A00.01.UA ПОДАТКОВІ ГРУПИ З НЕГАТИВНИМ ПІДСУМКОМ: 6 ПОЗИТИВНИМ ЖИВЛЕННЯ: 24 В, 2,5 А ТИП ДИСПЛЕЯ: РІДКОКРИСТАЛІЧНИЙ / ЛЮМІНЕСЦЕНТНИЙ ШИРИНА ПАПЕРУ: 57,5 ИЛИ 80,00 ДРУКУ: ТЕРМОДРУК ШВИДКІСТЬ 200 ІНТЕРФЕЙСИ ПІДКЛЮЧЕННЯ: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В) МАКС. ДІАМЕТР РУЛОНУ: 76 НАЯВНІСТЬ АВТООБРІЗУВАЛЬНИКА: ТАК РОБОЧА ТЕМПЕРАТУРА: +5&DEG;C &HELLIP; +40&DEG;C ВОЛОГІСТЬ: ВІД 40 ДО 80% ЗА ТЕМПЕРАТУРИ +25&DEG;С ГАБАРИТНІ РОЗМІРИ: 150 Х 185 142 ВАГА: 1,8 КГ'),
(361, 116, 'en', 'MG-P777TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Number of cashiers:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Number of characters in the product name:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Number of characters per line:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Number of goods:</td>\r\n<td>From 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Printer model:</td>\r\n<td>Seiko CAPD247E-E</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with negative total:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Tax groups with a positive result:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Power supply:</td>\r\n<td>24 V, 2,5 A</td>\r\n</tr>\r\n<tr>\r\n<td>Monitor type:</td>\r\n<td>Liquid crystal / fluorescent</td>\r\n</tr>\r\n<tr>\r\n<td>Paper width:</td>\r\n<td>57,5</td>\r\n</tr>\r\n<tr>\r\n<td>Print type:</td>\r\n<td>Thermal printing</td>\r\n</tr>\r\n<tr>\r\n<td>Print speed:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Interfaces of connection:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24V)</td>\r\n</tr>\r\n<tr>\r\n<td>Max. roll diameter:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Presence of an auto-cutter:</td>\r\n<td>Yes</td>\r\n</tr>\r\n<tr>\r\n<td>Working temperature:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Humidity:</td>\r\n<td>from 40 to 80% at a temperature of +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Dimensions:</td>\r\n<td>125 х 171 х 140</td>\r\n</tr>\r\n<tr>\r\n<td>Weight:</td>\r\n<td>1,5 kg</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'FISCAL REGISTERS MG-P777TL  NUMBER OF CASHIERS: 36 CHARACTERS IN THE PRODUCT NAME: 85 PER LINE: GOODS: FROM 8000 PRINTER MODEL: SEIKO CAPD247E-E TAX GROUPS WITH NEGATIVE TOTAL: 6 A POSITIVE RESULT: POWER SUPPLY: 24 V, 2,5 A MONITOR TYPE: LIQUID CRYSTAL / FLUORESCENT PAPER WIDTH: 57,5 PRINT THERMAL PRINTING SPEED: 200 INTERFACES CONNECTION: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24V) MAX. ROLL DIAMETER: 76 PRESENCE AN AUTO-CUTTER: YES WORKING TEMPERATURE: +5&DEG;C &HELLIP; +40&DEG;C HUMIDITY: FROM 40 TO 80% AT TEMPERATURE +25&DEG;С DIMENSIONS: 125 Х 171 140 WEIGHT: 1,5 KG'),
(362, 116, 'ru', 'MG-P777TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Количество кассиров:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Количество символов в названии товара:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Количество символов в строке:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Количество товаров:</td>\r\n<td>Не менее 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтера:</td>\r\n<td>Seiko CAPD247E-E</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с отрицательным итогом:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Налоговые группы с положительным итогом:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Питание:</td>\r\n<td>24 В, 2,5 А</td>\r\n</tr>\r\n<tr>\r\n<td>Тип дисплея:</td>\r\n<td>жидкокристаллический / люминесцентный</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина бумаги:</td>\r\n<td>57,5</td>\r\n</tr>\r\n<tr>\r\n<td>Тип печати:</td>\r\n<td>Термопечать</td>\r\n</tr>\r\n<tr>\r\n<td>Скорость печати:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Интерфейсы подключения:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. диаметр рулона:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Наличие автообрезчика:</td>\r\n<td>Да</td>\r\n</tr>\r\n<tr>\r\n<td>Рабочая температура:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Влажность:</td>\r\n<td>от 40 до 80% при температуре +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритные размеры:</td>\r\n<td>125 х 171 х 140</td>\r\n</tr>\r\n<tr>\r\n<td>Вес:</td>\r\n<td>1,5 кг</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'ФИСКАЛЬНЫЕ РЕГИСТРАТОРЫ MG-P777TL  КОЛИЧЕСТВО КАССИРОВ: 36 СИМВОЛОВ В НАЗВАНИИ ТОВАРА: 85 СТРОКЕ: ТОВАРОВ: НЕ МЕНЕЕ 8000 МОДЕЛЬ ПРИНТЕРА: SEIKO CAPD247E-E НАЛОГОВЫЕ ГРУППЫ С ОТРИЦАТЕЛЬНЫМ ИТОГОМ: 6 ПОЛОЖИТЕЛЬНЫМ ПИТАНИЕ: 24 В, 2,5 А ТИП ДИСПЛЕЯ: ЖИДКОКРИСТАЛЛИЧЕСКИЙ / ЛЮМИНЕСЦЕНТНЫЙ ШИРИНА БУМАГИ: 57,5 ПЕЧАТИ: ТЕРМОПЕЧАТЬ СКОРОСТЬ 200 ИНТЕРФЕЙСЫ ПОДКЛЮЧЕНИЯ: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В) МАКС. ДИАМЕТР РУЛОНА: 76 НАЛИЧИЕ АВТООБРЕЗЧИКА: ДА РАБОЧАЯ ТЕМПЕРАТУРА: +5&DEG;C &HELLIP; +40&DEG;C ВЛАЖНОСТЬ: ОТ 40 ДО 80% ПРИ ТЕМПЕРАТУРЕ +25&DEG;С ГАБАРИТНЫЕ РАЗМЕРЫ: 125 Х 171 140 ВЕС: 1,5 КГ'),
(363, 116, 'ua', 'MG-P777TL', '', '', '<table class="table table-striped">\r\n<tbody>\r\n<tr>\r\n<td>Кількість касирів:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість символів в назві товару:</td>\r\n<td>85</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість символів в рядку:</td>\r\n<td>36</td>\r\n</tr>\r\n<tr>\r\n<td>Кількість товарів:</td>\r\n<td>Не менше 8000</td>\r\n</tr>\r\n<tr>\r\n<td>Модель принтеру:</td>\r\n<td>Seiko CAPD247E-E</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з негативним підсумком:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Податкові групи з позитивним підсумком:</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>Живлення:</td>\r\n<td>24 В, 2,5 А</td>\r\n</tr>\r\n<tr>\r\n<td>Тип дисплея:</td>\r\n<td>рідкокристалічний / люмінесцентний</td>\r\n</tr>\r\n<tr>\r\n<td>Ширина паперу:</td>\r\n<td>57,5</td>\r\n</tr>\r\n<tr>\r\n<td>Тип друку:</td>\r\n<td>Термодрук</td>\r\n</tr>\r\n<tr>\r\n<td>Швидкість друку:</td>\r\n<td>200</td>\r\n</tr>\r\n<tr>\r\n<td>Інтерфейси підключення:</td>\r\n<td>RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В)</td>\r\n</tr>\r\n<tr>\r\n<td>Макс. діаметр рулону:</td>\r\n<td>76</td>\r\n</tr>\r\n<tr>\r\n<td>Наявність автообрізувальника:</td>\r\n<td>Так</td>\r\n</tr>\r\n<tr>\r\n<td>Робоча температура:</td>\r\n<td>+5&deg;C &hellip; +40&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td>Вологість:</td>\r\n<td>від 40 до 80% за температури +25&deg;С</td>\r\n</tr>\r\n<tr>\r\n<td>Габаритні розміри:</td>\r\n<td>125 х 171 х 140</td>\r\n</tr>\r\n<tr>\r\n<td>Вага:</td>\r\n<td>1,5 кг</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', '', 'ФІСКАЛЬНІ РЕЄСТРАТОРИ MG-P777TL  КІЛЬКІСТЬ КАСИРІВ: 36 СИМВОЛІВ В НАЗВІ ТОВАРУ: 85 РЯДКУ: ТОВАРІВ: НЕ МЕНШЕ 8000 МОДЕЛЬ ПРИНТЕРУ: SEIKO CAPD247E-E ПОДАТКОВІ ГРУПИ З НЕГАТИВНИМ ПІДСУМКОМ: 6 ПОЗИТИВНИМ ЖИВЛЕННЯ: 24 В, 2,5 А ТИП ДИСПЛЕЯ: РІДКОКРИСТАЛІЧНИЙ / ЛЮМІНЕСЦЕНТНИЙ ШИРИНА ПАПЕРУ: 57,5 ДРУКУ: ТЕРМОДРУК ШВИДКІСТЬ 200 ІНТЕРФЕЙСИ ПІДКЛЮЧЕННЯ: RS-232 (RJ45), USB-В (RNDIS), RJ12 (24В) МАКС. ДІАМЕТР РУЛОНУ: 76 НАЯВНІСТЬ АВТООБРІЗУВАЛЬНИКА: ТАК РОБОЧА ТЕМПЕРАТУРА: +5&DEG;C &HELLIP; +40&DEG;C ВОЛОГІСТЬ: ВІД 40 ДО 80% ЗА ТЕМПЕРАТУРИ +25&DEG;С ГАБАРИТНІ РОЗМІРИ: 125 Х 171 140 ВАГА: 1,5 КГ');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=262 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(255, 114, 12),
(257, 116, 12),
(258, 117, 12),
(259, 118, 12),
(260, 119, 12),
(261, 115, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_characteristic`
--

CREATE TABLE IF NOT EXISTS `product_characteristic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`characteristic_id`),
  KEY `characteristic_id` (`characteristic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_file`
--

CREATE TABLE IF NOT EXISTS `product_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `product_file`
--

INSERT INTO `product_file` (`id`, `file`, `product_id`, `sort`, `name`) VALUES
(52, '/uploads/products/114/file/RNDIS9624.zip', 114, 1, 'Driver for Windows'),
(53, '/uploads/products/114/file/Update-web-guide.pdf', 114, 2, 'Instruction for web-interface update'),
(54, '/uploads/products/114/file/Protokol_JSON_MG_N707TS203f.pdf', 114, 3, 'List of commands and description of communication protocols with external devices'),
(63, '/uploads/products/115/file/Gera_MG_N707TS_HTTP_v25.epf', 115, 1, 'Processing under 1C via HTTP protocol'),
(64, '/uploads/products/115/file/Ole_driver_MGT808TL.rar', 115, 2, 'Universal driver for 1C Enterprise'),
(65, '/uploads/products/116/file/Gera_MG_N707TS_HTTP_v25.epf', 116, 1, 'Processing under 1C via HTTP protocol'),
(66, '/uploads/products/116/file/Ole_driver_MGT808TL.rar', 116, 2, 'Universal driver for 1C Enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `product_gallery`
--

CREATE TABLE IF NOT EXISTS `product_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1678 ;

--
-- Dumping data for table `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `image`, `product_id`, `sort`) VALUES
(1661, '/uploads/products/114/1.jpeg', 114, 1),
(1662, '/uploads/products/114/2.jpg', 114, 2),
(1676, '/uploads/products/115/1.png', 115, NULL),
(1677, '/uploads/products/116/1.png', 116, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_relation`
--

CREATE TABLE IF NOT EXISTS `product_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_related_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`product_related_id`),
  KEY `product_id_2` (`product_id`),
  KEY `product_related_id` (`product_related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE IF NOT EXISTS `product_variation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `in_stock` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`characteristic_id`),
  KEY `characteristic_id` (`characteristic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `phone`) VALUES
(1, '+ 38 (044) 570-80-42');

-- --------------------------------------------------------

--
-- Table structure for table `settinglang`
--

CREATE TABLE IF NOT EXISTS `settinglang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `table_size` text NOT NULL,
  `seo_category_description` text NOT NULL,
  `product_delivery_description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_id` (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `settinglang`
--

INSERT INTO `settinglang` (`id`, `setting_id`, `language`, `table_size`, `seo_category_description`, `product_delivery_description`) VALUES
(1, 1, 'en', '', '', ''),
(2, 1, 'ru', '', '', ''),
(3, 1, 'ua', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider_item`
--

CREATE TABLE IF NOT EXISTS `slider_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slider_id` (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `source_message`
--

CREATE TABLE IF NOT EXISTS `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=977 ;

--
-- Dumping data for table `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(252, 'yii', '(not set)'),
(253, 'yii', 'An internal server error occurred.'),
(254, 'yii', 'Are you sure you want to delete this item?'),
(255, 'yii', 'Delete'),
(256, 'yii', 'Error'),
(257, 'yii', 'File upload failed.'),
(258, 'yii', 'Home'),
(259, 'yii', 'Invalid data received for parameter "{param}".'),
(260, 'yii', 'Login Required'),
(261, 'yii', 'Missing required arguments: {params}'),
(262, 'yii', 'Missing required parameters: {params}'),
(263, 'yii', 'No'),
(264, 'yii', 'No results found.'),
(265, 'yii', 'Only files with these MIME types are allowed: {mimeTypes}.'),
(266, 'yii', 'Only files with these extensions are allowed: {extensions}.'),
(267, 'yii', 'Page not found.'),
(268, 'yii', 'Please fix the following errors:'),
(269, 'yii', 'Please upload a file.'),
(270, 'yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.'),
(271, 'yii', 'The file "{file}" is not an image.'),
(272, 'yii', 'The file "{file}" is too big. Its size cannot exceed {formattedLimit}.'),
(273, 'yii', 'The file "{file}" is too small. Its size cannot be smaller than {formattedLimit}.'),
(274, 'yii', 'The format of {attribute} is invalid.'),
(275, 'yii', 'The image "{file}" is too large. The height cannot be larger than {limit, number} {limit, plural, one{pixel} other{pixels}}.'),
(276, 'yii', 'The image "{file}" is too large. The width cannot be larger than {limit, number} {limit, plural, one{pixel} other{pixels}}.'),
(277, 'yii', 'The image "{file}" is too small. The height cannot be smaller than {limit, number} {limit, plural, one{pixel} other{pixels}}.'),
(278, 'yii', 'The image "{file}" is too small. The width cannot be smaller than {limit, number} {limit, plural, one{pixel} other{pixels}}.'),
(279, 'yii', 'The requested view "{name}" was not found.'),
(280, 'yii', 'The verification code is incorrect.'),
(281, 'yii', 'Total <b>{count, number}</b> {count, plural, one{item} other{items}}.'),
(282, 'yii', 'Unable to verify your data submission.'),
(283, 'yii', 'Unknown option: --{name}'),
(284, 'yii', 'Update'),
(285, 'yii', 'View'),
(286, 'yii', 'Yes'),
(287, 'yii', 'You are not allowed to perform this action.'),
(288, 'yii', 'You can upload at most {limit, number} {limit, plural, one{file} other{files}}.'),
(289, 'yii', 'in {delta, plural, =1{a day} other{# days}}'),
(290, 'yii', 'in {delta, plural, =1{a minute} other{# minutes}}'),
(291, 'yii', 'in {delta, plural, =1{a month} other{# months}}'),
(292, 'yii', 'in {delta, plural, =1{a second} other{# seconds}}'),
(293, 'yii', 'in {delta, plural, =1{a year} other{# years}}'),
(294, 'yii', 'in {delta, plural, =1{an hour} other{# hours}}'),
(295, 'yii', 'just now'),
(296, 'yii', 'the input value'),
(297, 'yii', '{attribute} "{value}" has already been taken.'),
(298, 'yii', '{attribute} cannot be blank.'),
(299, 'yii', '{attribute} is invalid.'),
(300, 'yii', '{attribute} is not a valid URL.'),
(301, 'yii', '{attribute} is not a valid email address.'),
(302, 'yii', '{attribute} must be "{requiredValue}".'),
(303, 'yii', '{attribute} must be a number.'),
(304, 'yii', '{attribute} must be a string.'),
(305, 'yii', '{attribute} must be an integer.'),
(306, 'yii', '{attribute} must be either "{true}" or "{false}".'),
(307, 'yii', '{attribute} must be greater than "{compareValue}".'),
(308, 'yii', '{attribute} must be greater than or equal to "{compareValue}".'),
(309, 'yii', '{attribute} must be less than "{compareValue}".'),
(310, 'yii', '{attribute} must be less than or equal to "{compareValue}".'),
(311, 'yii', '{attribute} must be no greater than {max}.'),
(312, 'yii', '{attribute} must be no less than {min}.'),
(313, 'yii', '{attribute} must be repeated exactly.'),
(314, 'yii', '{attribute} must not be equal to "{compareValue}".'),
(315, 'yii', '{attribute} should contain at least {min, number} {min, plural, one{character} other{characters}}.'),
(316, 'yii', '{attribute} should contain at most {max, number} {max, plural, one{character} other{characters}}.'),
(317, 'yii', '{attribute} should contain {length, number} {length, plural, one{character} other{characters}}.'),
(318, 'yii', '{delta, plural, =1{a day} other{# days}} ago'),
(319, 'yii', '{delta, plural, =1{a minute} other{# minutes}} ago'),
(320, 'yii', '{delta, plural, =1{a month} other{# months}} ago'),
(321, 'yii', '{delta, plural, =1{a second} other{# seconds}} ago'),
(322, 'yii', '{delta, plural, =1{a year} other{# years}} ago'),
(323, 'yii', '{delta, plural, =1{an hour} other{# hours}} ago'),
(324, 'yii', '{nFormatted} B'),
(325, 'yii', '{nFormatted} GB'),
(326, 'yii', '{nFormatted} GiB'),
(327, 'yii', '{nFormatted} KB'),
(328, 'yii', '{nFormatted} KiB'),
(329, 'yii', '{nFormatted} MB'),
(330, 'yii', '{nFormatted} MiB'),
(331, 'yii', '{nFormatted} PB'),
(332, 'yii', '{nFormatted} PiB'),
(333, 'yii', '{nFormatted} TB'),
(334, 'yii', '{nFormatted} TiB'),
(335, 'yii', '{nFormatted} {n, plural, =1{byte} other{bytes}}'),
(336, 'yii', '{nFormatted} {n, plural, =1{gibibyte} other{gibibytes}}'),
(337, 'yii', '{nFormatted} {n, plural, =1{gigabyte} other{gigabytes}}'),
(338, 'yii', '{nFormatted} {n, plural, =1{kibibyte} other{kibibytes}}'),
(339, 'yii', '{nFormatted} {n, plural, =1{kilobyte} other{kilobytes}}'),
(340, 'yii', '{nFormatted} {n, plural, =1{mebibyte} other{mebibytes}}'),
(341, 'yii', '{nFormatted} {n, plural, =1{megabyte} other{megabytes}}'),
(342, 'yii', '{nFormatted} {n, plural, =1{pebibyte} other{pebibytes}}'),
(343, 'yii', '{nFormatted} {n, plural, =1{petabyte} other{petabytes}}'),
(344, 'yii', '{nFormatted} {n, plural, =1{tebibyte} other{tebibytes}}'),
(345, 'yii', '{nFormatted} {n, plural, =1{terabyte} other{terabytes}}'),
(537, 'common/modules/i18n', 'Translations'),
(538, 'common/modules/i18n', 'Id'),
(539, 'common/modules/i18n', 'Message'),
(540, 'common/modules/i18n', 'Category'),
(541, 'common/modules/i18n', 'Status'),
(542, 'common/modules/i18n', 'Translated'),
(543, 'common/modules/i18n', 'Not translated'),
(544, 'common/modules/i18n', 'Online'),
(545, 'common/modules/i18n', 'Menu'),
(546, 'common/modules/i18n', 'Dashboard'),
(547, 'common/modules/i18n', 'Profile'),
(548, 'common/modules/i18n', 'Users'),
(549, 'common/modules/i18n', 'Productdetails'),
(550, 'common/modules/i18n', 'Brands'),
(551, 'common/modules/i18n', 'Login'),
(552, 'common/modules/i18n', 'Settings'),
(553, 'common/modules/i18n', 'Templates'),
(554, 'common/modules/i18n', 'Currency'),
(555, 'common/modules/i18n', 'Update'),
(556, 'common/modules/i18n', 'Translation'),
(557, 'common/modules/i18n', 'Back to list'),
(558, 'yii', '{attribute} must be equal to "{compareValueOrAttribute}".'),
(559, 'yii', '{attribute} must be greater than "{compareValueOrAttribute}".'),
(560, 'yii', '{attribute} must be greater than or equal to "{compareValueOrAttribute}".'),
(561, 'yii', '{attribute} must be less than "{compareValueOrAttribute}".'),
(562, 'yii', '{attribute} must be less than or equal to "{compareValueOrAttribute}".'),
(563, 'yii', '{attribute} must not be equal to "{compareValueOrAttribute}".'),
(564, 'yii', '{attribute} contains wrong subnet mask.'),
(565, 'yii', '{attribute} is not in the allowed range.'),
(566, 'yii', '{attribute} must be a valid IP address.'),
(567, 'yii', '{attribute} must be an IP address with specified subnet.'),
(568, 'yii', '{attribute} must not be a subnet.'),
(569, 'yii', '{attribute} must not be an IPv4 address.'),
(570, 'yii', '{attribute} must not be an IPv6 address.'),
(571, 'yii', '{delta, plural, =1{1 day} other{# days}}'),
(572, 'yii', '{delta, plural, =1{1 hour} other{# hours}}'),
(573, 'yii', '{delta, plural, =1{1 minute} other{# minutes}}'),
(574, 'yii', '{delta, plural, =1{1 month} other{# months}}'),
(575, 'yii', '{delta, plural, =1{1 second} other{# seconds}}'),
(576, 'yii', '{delta, plural, =1{1 year} other{# years}}'),
(577, 'common/modules/i18n', 'Updated'),
(578, 'common/modules/i18n', 'Create '),
(579, 'common/modules/i18n', 'User'),
(580, 'common/modules/i18n', 'Username'),
(581, 'common/modules/i18n', 'Email'),
(582, 'common/modules/i18n', 'Authkey'),
(583, 'common/modules/i18n', 'Passwordhash'),
(584, 'common/modules/i18n', 'Passwordresettoken'),
(585, 'common/modules/i18n', 'Createdat'),
(586, 'common/modules/i18n', 'Updatedat'),
(587, 'common/modules/i18n', 'Logo'),
(588, 'common/modules/i18n', 'New Password'),
(589, 'common/modules/i18n', 'New Password Repeat'),
(590, 'common/modules/i18n', 'Role'),
(591, 'common/modules/i18n', 'Delete'),
(592, 'common/modules/i18n', 'Are you sure you want to delete this item?'),
(593, 'common/modules/i18n', 'Roles'),
(594, 'common/modules/i18n', 'Brand'),
(595, 'common/modules/i18n', 'Name'),
(596, 'common/modules/i18n', 'Create'),
(597, 'common/modules/i18n', 'Template'),
(598, 'common/modules/i18n', 'Alias'),
(599, 'common/modules/i18n', 'Text'),
(600, 'common/modules/i18n', 'Currencies'),
(601, 'common/modules/i18n', 'Default'),
(602, 'common/modules/i18n', 'No'),
(603, 'common/modules/i18n', 'Yes'),
(604, 'common/modules/i18n', 'ISO 4217'),
(605, 'common/modules/i18n', 'Sign'),
(606, 'common/modules/i18n', 'Sign in'),
(607, 'common/modules/i18n', 'Sign in to start your session'),
(608, 'common/modules/i18n', 'Sign out'),
(609, 'common/modules/i18n', 'Enabled'),
(610, 'common/modules/i18n', 'Access rules'),
(611, 'common/modules/i18n', 'Add new rule'),
(612, 'common/modules/i18n', 'Rule'),
(613, 'common/modules/i18n', 'Description'),
(614, 'common/modules/i18n', 'Create rule'),
(615, 'common/modules/i18n', 'Edit rule'),
(616, 'common/modules/i18n', 'Text description'),
(617, 'common/modules/i18n', 'Allowed access'),
(618, 'common/modules/i18n', 'Parent permission'),
(619, 'common/modules/i18n', 'Save'),
(620, 'common/modules/i18n', 'Operation is done successfully.'),
(621, 'common/modules/i18n', 'Edit rule: '),
(622, 'common/modules/i18n', 'Role management'),
(623, 'common/modules/i18n', 'Add role'),
(624, 'common/modules/i18n', 'Allowed accesses'),
(625, 'common/modules/i18n', 'Edit role: '),
(626, 'common/modules/i18n', 'Role name'),
(627, 'common/modules/i18n', 'Posts'),
(628, 'common/modules/i18n', 'Post'),
(629, 'common/modules/i18n', 'Customer number'),
(630, 'common/modules/i18n', 'Bankaccountnumber'),
(631, 'common/modules/i18n', 'Bankaccountname'),
(632, 'common/modules/i18n', 'Customer ID'),
(633, 'common/modules/i18n', 'Country'),
(634, 'common/modules/i18n', 'City'),
(635, 'common/modules/i18n', 'Street'),
(636, 'common/modules/i18n', 'Zip'),
(637, 'common/modules/i18n', 'Salutation'),
(638, 'common/modules/i18n', 'Date start'),
(639, 'common/modules/i18n', 'Date end'),
(640, 'common/modules/i18n', 'Invoice number'),
(641, 'common/modules/i18n', 'Invoice subtotal'),
(642, 'common/modules/i18n', 'Invoice VAT'),
(643, 'common/modules/i18n', 'Invoice total'),
(644, 'common/modules/i18n', 'Location'),
(645, 'common/modules/i18n', 'Amount'),
(646, 'common/modules/i18n', 'Pallet'),
(647, 'common/modules/i18n', 'Bar number'),
(648, 'common/modules/i18n', 'Dateregistrated'),
(649, 'common/modules/i18n', 'Storage code'),
(650, 'common/modules/i18n', 'Storage description'),
(651, 'common/modules/i18n', 'Storage basis'),
(652, 'common/modules/i18n', 'Storage amount'),
(653, 'common/modules/i18n', 'Storage date start'),
(654, 'common/modules/i18n', 'Storage date end'),
(655, 'common/modules/i18n', 'Storage percentage'),
(656, 'common/modules/i18n', 'Storage price'),
(657, 'common/modules/i18n', 'Storage date out'),
(658, 'common/modules/i18n', 'Title'),
(659, 'common/modules/i18n', 'Content'),
(660, 'common/modules/i18n', 'Sort'),
(661, 'common/modules/i18n', 'Parent menu'),
(662, 'common/modules/i18n', 'Bean type'),
(663, 'common/modules/i18n', 'Bean'),
(664, 'common/modules/i18n', 'Enter the URL manually:'),
(665, 'common/modules/i18n', 'Sort action'),
(666, 'common/modules/i18n', 'Social networks'),
(667, 'common/modules/i18n', 'Social network'),
(668, 'common/modules/i18n', 'Not Found (#404)'),
(669, 'common/modules/i18n', 'The above error occurred while the Web server was processing your request.'),
(670, 'common/modules/i18n', 'Please contact us if you think this is a server error. Thank you.'),
(671, 'common/modules/i18n', 'Stocks'),
(672, 'common/modules/i18n', 'Stock'),
(673, 'common/modules/i18n', 'Where to buy'),
(674, 'common/modules/i18n', 'Contact us'),
(675, 'common/modules/i18n', 'Your name'),
(676, 'common/modules/i18n', 'Your email'),
(677, 'common/modules/i18n', 'Your message'),
(678, 'common/modules/i18n', 'Send'),
(679, 'common/modules/i18n', 'To'),
(680, 'common/modules/i18n', 'From'),
(681, 'common/modules/i18n', 'Subject'),
(682, 'common/modules/i18n', 'Contact form settings'),
(683, 'common/modules/i18n', 'Contact form'),
(684, 'common/modules/i18n', 'Contact form setting'),
(685, 'common/modules/i18n', 'Your message was sent successfully. Thank you.'),
(686, 'common/modules/i18n', 'Sliders'),
(687, 'common/modules/i18n', 'Slider'),
(688, 'common/modules/i18n', 'Images'),
(689, 'common/modules/i18n', 'Image'),
(690, 'common/modules/i18n', 'Link'),
(691, 'common/modules/i18n', 'Bad Request (#400)'),
(692, 'common/modules/i18n', 'Default page'),
(693, 'common/modules/i18n', 'Parent category'),
(694, 'common/modules/i18n', 'Categories'),
(695, 'common/modules/i18n', 'Shop'),
(696, 'common/modules/i18n', 'Characteristic groups'),
(697, 'common/modules/i18n', 'Characteristic group'),
(698, 'common/modules/i18n', 'Characteristics'),
(699, 'common/modules/i18n', 'Characteristic'),
(700, 'common/modules/i18n', 'Vendor code'),
(701, 'common/modules/i18n', 'Price'),
(702, 'common/modules/i18n', 'In stock'),
(703, 'common/modules/i18n', 'Products'),
(704, 'common/modules/i18n', 'Product'),
(705, 'common/modules/i18n', 'Select'),
(706, 'common/modules/i18n', 'Simple product'),
(707, 'common/modules/i18n', 'Variation'),
(708, 'common/modules/i18n', 'Type'),
(709, 'common/modules/i18n', 'Variations'),
(710, 'common/modules/i18n', 'Размер'),
(711, 'common/modules/i18n', 'Gallery'),
(712, 'common/modules/i18n', 'Product categories '),
(713, 'common/modules/i18n', 'Filter'),
(714, 'common/modules/i18n', 'Product categories'),
(715, 'common/modules/i18n', 'View'),
(716, 'common/modules/i18n', 'Not available'),
(717, 'common/modules/i18n', 'Menu types'),
(718, 'common/modules/i18n', 'Menu type'),
(719, 'common/modules/i18n', 'Useful Information'),
(720, 'common/modules/i18n', 'Clear'),
(721, 'common/modules/i18n', 'Result(s)'),
(722, 'common/modules/i18n', 'Count of products:'),
(723, 'common/modules/i18n', 'Price High to Low'),
(724, 'common/modules/i18n', 'Price Low to High'),
(725, 'common/modules/i18n', 'Sort by'),
(726, 'common/modules/i18n', 'Short description'),
(727, 'common/modules/i18n', 'Show after price'),
(728, 'common/modules/i18n', 'Add to shopping bag'),
(729, 'common/modules/i18n', 'Choose your size'),
(730, 'common/modules/i18n', 'Count'),
(731, 'common/modules/i18n', 'You need to choose a size'),
(732, 'common/modules/i18n', 'You need to enter a count'),
(733, 'common/modules/i18n', 'Add to wish list'),
(734, 'common/modules/i18n', 'Enter to the cabinet'),
(735, 'common/modules/i18n', 'Password'),
(736, 'common/modules/i18n', 'Remember me'),
(737, 'common/modules/i18n', 'Enter'),
(738, 'common/modules/i18n', 'If you forgot your password you can'),
(739, 'common/modules/i18n', 'Forget password?'),
(740, 'common/modules/i18n', 'Incorrect username or password.'),
(741, 'common/modules/i18n', 'Signup'),
(742, 'common/modules/i18n', 'This username has already been taken.'),
(743, 'common/modules/i18n', 'This email address has already been taken.'),
(744, 'common/modules/i18n', 'I would like to receive news from Jenadin'),
(745, 'common/modules/i18n', 'Subscription'),
(746, 'common/modules/i18n', 'Stay in touch'),
(747, 'common/modules/i18n', 'Sign up for news'),
(748, 'common/modules/i18n', 'Novelties'),
(749, 'common/modules/i18n', 'Novelty'),
(750, 'common/modules/i18n', 'Are you sure you want to send novelty?'),
(751, 'common/modules/i18n', 'Video'),
(752, 'common/modules/i18n', 'Remove'),
(753, 'common/modules/i18n', 'Kits'),
(754, 'common/modules/i18n', 'Kit'),
(755, 'common/modules/i18n', 'remove'),
(756, 'common/modules/i18n', 'How to wear it'),
(757, 'common/modules/i18n', 'You may also like it'),
(758, 'common/modules/i18n', 'Basket'),
(759, 'common/modules/i18n', 'Continue shopping'),
(760, 'common/modules/i18n', 'Unit price:'),
(761, 'common/modules/i18n', 'Total:'),
(762, 'common/modules/i18n', 'Basket is updated successfully.'),
(763, 'common/modules/i18n', 'You basket is empty.'),
(764, 'common/modules/i18n', 'Sum in the basket'),
(765, 'common/modules/i18n', 'In total'),
(766, 'common/modules/i18n', 'Proceed checkout'),
(767, 'common/modules/i18n', 'The size is '),
(768, 'common/modules/i18n', 'The size is out of stock.'),
(769, 'common/modules/i18n', 'Request password reset'),
(770, 'common/modules/i18n', 'A link to reset password will be sent there.'),
(771, 'common/modules/i18n', 'Password reset for Jenadin'),
(772, 'common/modules/i18n', 'Hello'),
(773, 'common/modules/i18n', 'Follow the link below to reset your password:'),
(774, 'common/modules/i18n', 'There is no user with such email.'),
(775, 'common/modules/i18n', 'Check your email for further instructions.'),
(776, 'common/modules/i18n', 'Reset password'),
(777, 'common/modules/i18n', 'Please choose your new password:'),
(778, 'common/modules/i18n', 'New password was saved.'),
(779, 'common/modules/i18n', 'Hello, %s%. (%s). In your account you can see your orders.'),
(780, 'common/modules/i18n', 'Exit'),
(781, 'common/modules/i18n', 'Account details'),
(782, 'common/modules/i18n', 'Address book'),
(783, 'common/modules/i18n', 'View or change your sign-in information.'),
(784, 'common/modules/i18n', 'Edit address data.'),
(785, 'common/modules/i18n', 'Wish list'),
(786, 'common/modules/i18n', 'Orders'),
(787, 'common/modules/i18n', 'View your order history.'),
(788, 'common/modules/i18n', 'View your favourite products.'),
(789, 'common/modules/i18n', 'Back to profile view'),
(790, 'common/modules/i18n', 'Profile is updated successfully.'),
(791, 'common/modules/i18n', 'Address'),
(792, 'common/modules/i18n', 'First name'),
(793, 'common/modules/i18n', 'Last name'),
(794, 'common/modules/i18n', 'Phone'),
(795, 'common/modules/i18n', 'Region'),
(796, 'common/modules/i18n', 'Building'),
(797, 'common/modules/i18n', 'Flat'),
(798, 'common/modules/i18n', 'Address is updated successfully.'),
(799, 'common/modules/i18n', 'The product was removed from the wish list'),
(800, 'common/modules/i18n', 'There is no product in your wish list'),
(801, 'common/modules/i18n', 'Notes'),
(802, 'common/modules/i18n', 'Payment type'),
(803, 'common/modules/i18n', 'Order'),
(804, 'common/modules/i18n', 'Checkout'),
(805, 'common/modules/i18n', 'Payment details'),
(806, 'common/modules/i18n', 'Your order'),
(807, 'common/modules/i18n', 'Total price'),
(808, 'common/modules/i18n', 'Payment types'),
(809, 'common/modules/i18n', 'Place order'),
(810, 'common/modules/i18n', 'Receivers'),
(811, 'common/modules/i18n', 'Email subject'),
(812, 'common/modules/i18n', 'Email templates'),
(813, 'common/modules/i18n', 'Email template'),
(814, 'common/modules/i18n', 'Email preview'),
(815, 'common/modules/i18n', 'ID'),
(816, 'common/modules/i18n', 'Subject from'),
(817, 'common/modules/i18n', 'Email from'),
(818, 'common/modules/i18n', 'Footer'),
(819, 'common/modules/i18n', 'Email settings'),
(820, 'common/modules/i18n', 'Email setting'),
(821, 'common/modules/i18n', 'You got order from '),
(822, 'common/modules/i18n', 'Information about the client'),
(823, 'common/modules/i18n', 'Thanks!'),
(824, 'common/modules/i18n', 'Your order is accepted!'),
(825, 'common/modules/i18n', 'Our manager will contact you'),
(826, 'common/modules/i18n', 'Hi there. Your recent order on Jenadin has been completed.'),
(827, 'common/modules/i18n', 'Your order was accepted successfully!'),
(828, 'common/modules/i18n', 'Number'),
(829, 'common/modules/i18n', 'Concept'),
(830, 'common/modules/i18n', 'Paid'),
(831, 'common/modules/i18n', 'Refused'),
(832, 'common/modules/i18n', 'Nothing is selected'),
(833, 'common/modules/i18n', 'Positions'),
(834, 'common/modules/i18n', '	You basket is empty.'),
(835, 'common/modules/i18n', 'Open menu'),
(836, 'common/modules/i18n', 'Search'),
(837, 'common/modules/i18n', 'Back'),
(838, 'common/modules/i18n', 'My account'),
(839, 'common/modules/i18n', 'Created at'),
(840, 'common/modules/i18n', 'Updated at'),
(841, 'common/modules/i18n', 'Percentage'),
(842, 'common/modules/i18n', 'Sales'),
(843, 'common/modules/i18n', 'Sale'),
(844, 'common/modules/i18n', 'Load products from the collection:'),
(845, 'javascript', 'Are you sure you want to add this collection?'),
(846, 'common/modules/i18n', 'Sell-out'),
(847, 'common/modules/i18n', 'Latest'),
(848, 'common/modules/i18n', 'Novelties products'),
(849, 'common/modules/i18n', 'Latest product'),
(850, 'common/modules/i18n', 'Size & fit information'),
(851, 'common/modules/i18n', 'Editor notes'),
(852, 'common/modules/i18n', 'Icon'),
(853, 'common/modules/i18n', 'Table size'),
(854, 'javascript', 'Basket'),
(855, 'javascript', 'You have added to the basket:'),
(856, 'common/modules/i18n', 'Successfully added'),
(857, 'common/modules/i18n', 'Pay waited'),
(858, 'common/modules/i18n', 'Congratulations! You have placed your order.'),
(859, 'common/modules/i18n', 'Search results:'),
(861, 'common/modules/i18n', 'No results matching the query:'),
(862, 'common/modules/i18n', 'Magazines'),
(863, 'common/modules/i18n', 'Magazine'),
(864, 'common/modules/i18n', 'Pages'),
(865, 'common/modules/i18n', 'Order date'),
(866, 'common/modules/i18n', 'User data'),
(867, 'common/modules/i18n', 'Personal data'),
(868, 'common/modules/i18n', 'Order data'),
(869, 'common/modules/i18n', 'Back to order list'),
(870, 'common/modules/i18n', 'Nothing was found'),
(871, 'common/modules/i18n', 'Seo category description'),
(872, 'common/modules/i18n', 'Invalid Configuration'),
(873, 'common/modules/i18n', 'Ошибка (#2)'),
(874, 'common/modules/i18n', 'Error'),
(875, 'common/modules/i18n', 'Error (#8)'),
(876, 'common/modules/i18n', 'Розмір'),
(877, 'common/modules/i18n', 'javascript'),
(878, 'common/modules/i18n', 'You have added to the basket:'),
(879, 'common/modules/i18n', 'Database Exception (#42)'),
(880, 'common/modules/i18n', 'Unknown Property'),
(881, 'common/modules/i18n', 'Invalid Configuration (#101)'),
(882, 'common/modules/i18n', 'Error (#535)'),
(883, 'common/modules/i18n', 'Visit website'),
(884, 'common/modules/i18n', 'View on the site'),
(885, 'common/modules/i18n', 'Preview'),
(886, 'common/modules/i18n', 'Preview mode'),
(887, 'common/modules/i18n', 'Collections'),
(888, 'common/modules/i18n', 'Assortment'),
(889, 'common/modules/i18n', 'Internet-shop'),
(890, 'common/modules/i18n', 'Useful information'),
(891, 'common/modules/i18n', 'Main page'),
(892, 'common/modules/i18n', 'Product catalog'),
(893, 'common/modules/i18n', 'Create role'),
(894, 'common/modules/i18n', 'Direct link'),
(895, 'common/modules/i18n', 'Forbidden (#403)'),
(896, 'common/modules/i18n', 'Main'),
(897, 'common/modules/i18n', 'Ошибка (#1)'),
(898, 'common/modules/i18n', 'Ошибка'),
(899, 'common/modules/i18n', 'Password repeat'),
(900, 'common/modules/i18n', 'Database Exception (#42000)'),
(901, 'common/modules/i18n', 'Error (#-1)'),
(902, 'common/modules/i18n', 'Show in filter'),
(903, 'common/modules/i18n', 'Product delivery description'),
(904, 'common/modules/i18n', 'Delivery'),
(905, 'common/modules/i18n', 'Legacy rules'),
(906, 'common/modules/i18n', 'Designation'),
(907, 'common/modules/i18n', 'Thanks, your password was replaced.'),
(908, 'common/modules/i18n', 'New products'),
(909, 'common/modules/i18n', 'Pre-order'),
(910, 'common/modules/i18n', 'Full name'),
(911, 'common/modules/i18n', 'Size'),
(912, 'javascript', 'Pre-order'),
(913, 'common/modules/i18n', 'Your request is accepted.'),
(914, 'common/modules/i18n', 'Dear'),
(915, 'common/modules/i18n', 'Your product is available now!'),
(916, 'common/modules/i18n', 'Go to the product card for selling it.!'),
(917, 'common/modules/i18n', 'product card'),
(918, 'common/modules/i18n', 'Pre-orders'),
(919, 'common/modules/i18n', 'New tab'),
(920, 'common/modules/i18n', 'Legacy terms'),
(921, 'common/modules/i18n', 'Legacy section'),
(922, 'common/modules/i18n', 'Campaign'),
(923, 'common/modules/i18n', 'More'),
(924, 'common/modules/i18n', 'Blog categories'),
(925, 'common/modules/i18n', 'Blog category'),
(926, 'common/modules/i18n', 'Blog posts'),
(927, 'common/modules/i18n', 'Blog post'),
(928, 'common/modules/i18n', 'Product related'),
(929, 'common/modules/i18n', 'Product relations'),
(930, 'common/modules/i18n', 'Product relation'),
(931, 'common/modules/i18n', 'Such combination of products already exists.'),
(932, 'common/modules/i18n', 'Please choose the different products'),
(933, 'common/modules/i18n', 'Go to the profile'),
(934, 'common/modules/i18n', 'Registration'),
(935, 'common/modules/i18n', 'Delivery types'),
(936, 'common/modules/i18n', 'Delivery type'),
(937, 'common/modules/i18n', 'Year'),
(938, 'common/modules/i18n', 'Duration'),
(939, 'common/modules/i18n', 'Age limit'),
(940, 'common/modules/i18n', 'Rating'),
(941, 'common/modules/i18n', 'Date captured'),
(942, 'common/modules/i18n', 'Trailer'),
(943, 'common/modules/i18n', 'View number'),
(944, 'common/modules/i18n', 'Is deleted'),
(945, 'common/modules/i18n', 'Parent'),
(946, 'common/modules/i18n', 'Level'),
(947, 'common/modules/i18n', 'Main banner slider 1'),
(948, 'common/modules/i18n', 'Main banner slider 2'),
(949, 'common/modules/i18n', 'Our advantages'),
(950, 'common/modules/i18n', 'Years of experience'),
(951, 'common/modules/i18n', 'We work in the market more than 10 year'),
(952, 'common/modules/i18n', 'Modern approach'),
(953, 'common/modules/i18n', 'We use innovative approach for tasks solutions'),
(954, 'common/modules/i18n', 'Versatility'),
(955, 'common/modules/i18n', 'We develop devices due to requirements of different countries'),
(956, 'common/modules/i18n', 'Our partners'),
(957, 'common/modules/i18n', 'Contact page address'),
(958, 'common/modules/i18n', 'Leave your message'),
(959, 'common/modules/i18n', 'About us lead text'),
(960, 'common/modules/i18n', 'Our achievements'),
(961, 'common/modules/i18n', 'Files'),
(962, 'common/modules/i18n', 'File'),
(963, 'common/modules/i18n', 'Production'),
(964, 'common/modules/i18n', 'Buy'),
(965, 'common/modules/i18n', 'Buy link'),
(966, 'common/modules/i18n', 'Features'),
(967, 'common/modules/i18n', 'Useful data'),
(968, 'common/modules/i18n', 'Zoom'),
(969, 'common/modules/i18n', 'Useful files'),
(970, 'common/modules/i18n', 'Download'),
(971, 'common/modules/i18n', 'Go back to the homepage'),
(972, 'common/modules/i18n', 'Driver for Windows'),
(973, 'common/modules/i18n', 'Instruction for web-interface update'),
(974, 'common/modules/i18n', 'List of commands and description of communication protocols with external devices'),
(975, 'common/modules/i18n', 'Processing under 1C via HTTP protocol'),
(976, 'common/modules/i18n', 'Universal driver for 1C Enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `created_at`, `updated_at`, `enabled`, `sort`) VALUES
(1, 1470239099, 1470561474, 1, 0),
(2, 1470239372, 1470301178, 1, 1),
(3, 1470301277, 1470301952, 1, 2),
(4, 1470301377, 1470301952, 1, 3),
(5, 1470301462, 1470301952, 1, 4),
(6, 1470301549, 1470301952, 1, 5),
(7, 1470301622, 1473958884, 1, 7),
(8, 1470301713, 1473958884, 1, 8),
(9, 1470301868, 1473958884, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `stocklang`
--

CREATE TABLE IF NOT EXISTS `stocklang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_id` (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `stocklang`
--

INSERT INTO `stocklang` (`id`, `stock_id`, `title`, `content`, `language`) VALUES
(1, 1, 'Kiev', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Mod House", Geroyiv Stalingradu avenue, 10А, tel.+38 (044) 581 21 97</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ALDI"-Zabolotnogo street,37</div>\r\nArtMoll moll, 1st floor of the boutique gallery, tel. +38 (097) 393 29 27</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"GALLERY 48", Antonovicha street,48, tel.+38 (073) 484 84 03</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"FІOLET", Malyshko street, 3</div>\r\nKubyk mall (4-th floor), tel. +38 (098) 653 55 55</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Buro 38 August", V.Vasylkivska street, 13/1, tel. +38 (067) 483 34 08</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, Pushkinska street, 8, tel.+38 (095) 270 41 91</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Names''UA" , вул. Chervonogvardiyska street, 1C</div>\r\nProspekt mall (2-nd floor), tel. +38 (044) 220 36 73</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Polo Garage", Lunacharskogo street, 4</div>\r\nKomod mall, tel. +38 (044) 585 70 57</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ViloNNa", Moskovskiy avenue, 23</div>\r\nGorodok mall (2-nd floor), tel. +38 (044) 224 50 93, +38 (067) 273 67 42</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(2, 1, 'Киев', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Mod House", пр-т Героев Сталинграда, 10А, тел.+38 (044) 581 21 97</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ALDI"-ул.Заболотного,37</div>\r\nТРЦ АртМолл. 1-й этаж бутиковой галереи, тел. +38 (097) 393 29 27</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"GALLERY 48", ул.Антоновича,48, тел.+38 (073) 484 84 03</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ФІОЛЕТ", ул. Малышко, 3</div>\r\nТЦ "Кубик" (4-й этаж), тел. +38 (098) 653 55 55</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Buro 38 August", ул. Б.Васильковская, 13/1, тел. +38 (067) 483 34 08</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, ул. Пушкинская, 8, тел.+38 (095) 270 41 91</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Names''UA" , ул. Красногвардейская, 1В</div>\r\nТРЦ "Проспект" (2-й этаж), тел. +38 (044) 220 36 73</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Polo Garage", ул. Луначарского, 4</div>\r\nТРЦ "Комод", тел. +38 (044) 585 70 57</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ViloNNa", пр-т Московский, 23</div>\r\nТРЦ "Городок" (2-й этаж), тел. +38 (044) 224 50 93, +38 (067) 273 67 42</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(3, 1, 'Київ', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Mod House", пр-т Героїв Сталінграду, 10А, тел.+38 (044) 581 21 97</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ALDI"-вул.Заболотнього,37</div>\r\nТРЦ АртМолл. 1-й поверх бутикової галереї, тел. +38 (097) 393 29 27</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"GALLERY 48", вул.Антоновича,48, тел.+38 (073) 484 84 03</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ФІОЛЕТ", вул. Малишко, 3</div>\r\nТЦ "Кубик" (4-й поверх), тел. +38 (098) 653 55 55</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"Buro 38 August", вул. В.Васильківська, 13/1, тел. +38 (067) 483 34 08</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, вул. Пушкінська, 8, тел.+38 (095) 270 41 91</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Names''UA" , вул. Червоногвардійська, 1В</div>\r\nТРЦ "Проспект" (2-й поверх), тел. +38 (044) 220 36 73</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Polo Garage", вул. Луначарського, 4</div>\r\nТРЦ "Комод", тел. +38 (044) 585 70 57</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"ViloNNa", пр-т Московський, 23</div>\r\nТРЦ "Городок" (2-й поверх), тел. +38 (044) 224 50 93, +38 (067) 273 67 42</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua'),
(4, 2, 'Dnepropetrovsk', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"CROCUS", Gopner street,2, tel. +38 (056) 740 20 35</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(5, 2, 'Днепропетровск', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"CROCUS", ул.Гопнер,2, тел. +38 (056) 740 20 35</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'ru'),
(6, 2, 'Дніпропетровськ', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"CROCUS", вул.Гопнер,2, тел. +38 (056) 740 20 35</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua'),
(7, 3, 'Odesa', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, Lanzheronivska street, 21, tel. +38 (068) 900 76 85</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(8, 3, 'Одесса', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, ул.Ланжероновская, 21, тел. +38 (068) 900 76 85</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(9, 3, 'Одеса', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Showroom Burba, вул.Ланжеронівська, 21, тел. +38 (068) 900 76 85</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua'),
(10, 4, 'Lviv', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"DyZaynery.UA", Serbska street, 10, tel. +38 (068) 668 07 09, +38 (098) 127 34 55</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(11, 4, 'Львов', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"ДиZайнери.UA", ул. Сербская, 10, тел. +38 (068) 668 07 09, +38 (098) 127 34 55</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(12, 4, 'Львів', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"ДиZайнери.UA", вул. Сербська, 10, тел. +38 (068) 668 07 09, +38 (098) 127 34 55</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua'),
(13, 5, 'Kherson', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"ZEBRA", Gagarina street, 4, tel. +38 (099) 911 83 81</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(14, 5, 'Херсон', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"ЗЕБРА", ул.Гагарина, 4, тел. +38 (099) 911 83 81</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(15, 5, 'Херсон', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>"ЗЕБРА", вул.Гагаріна, 4, тел. +38 (099) 911 83 81</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua'),
(16, 6, 'Vinnytsia', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Fashion of Ukraine", Yunosti avenue, 43а</div>\r\nMagigrand mall, 2s. 2 f., tel. +38 (0432) 527 879, +38 (097) 293 64 33</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(17, 6, 'Винница', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Fashion of Ukraine", пр-т Юности, 43а</div>\r\nТРК "Магигранд", 2к. 2 эт., тел. +38 (0432) 527 879, +38 (097) 293 64 33</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(18, 6, 'Вінниця', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Fashion of Ukraine", пр-т Юності, 43а</div>\r\nТРК "Магигранд", 2к. 2 п., тел. +38 (0432) 527 879, +38 (097) 293 64 33</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'ua'),
(19, 7, 'Rivne', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Zaldiz", Makarova street, 23</div>\r\nEkvator mall, tel. +38 (0362) 460 502, +38 (050) 435 16 41, +38 (098) 036 70 29</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(20, 7, 'Ровно', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Zaldiz", ул. Макарова, 23</div>\r\nТРЦ "Экватор", тел. +38 (0362) 460 502, +38 (050) 435 16 41, +38 (098) 036 70 29</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(21, 7, 'Рівне', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>"Zaldiz", вул. Макарова, 23</div>\r\nТРЦ "Екватор", тел. +38 (0362) 460 502, +38 (050) 435 16 41, +38 (098) 036 70 29</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'ua'),
(22, 8, 'Lutsk', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>Gallery 1, Voli avenue, 42</div>\r\nGrand Volyn mall, boutique 5, tel. +38 (067) 332 24 20</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'en'),
(23, 8, 'Луцк', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>Gallery 1, пр-т Воли, 42</div>\r\nТЦ "Гранд Волынь", бутик 5, тел. +38 (067) 332 24 20</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(24, 8, 'Луцьк', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div>Gallery 1, пр-т Волі, 42</div>\r\nТЦ "Гранд Волинь", бутик 5, тел. +38 (067) 332 24 20</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'ua'),
(25, 9, 'Kirovograd', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Plasa mall, 1-st floor shop "NATALI", tel. +38 (095) 723 03 87</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en'),
(26, 9, 'Кировоград', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>ТЦ "Плаза", 1-й этаж м-н "НАТАЛИ", тел. +38 (095) 723 03 87</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ru'),
(27, 9, 'Кіровоград', '<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>ТЦ "Плаза", 1-й поверх м-н "НАТАЛІ", тел. +38 (095) 723 03 87</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'ua');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `crontab` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscription` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `logo`, `subscription`) VALUES
(1, 'admin', 'V-Cym0VAr8UvLBmmLSHJID6XlMaqaXyZ', '$2y$13$hg7vKc6Ath.Fk6X8NYVcwuoC2SqUCuCyJnCb2JjGgtoYiXYLoQWRS', 'z9dpcZFxYAMxYAP27d8sn3yPmFmD64zt_1501180297', 'artemkramov@yahoo.com', 10, 1455877362, 1501180297, NULL, 1),
(4, 'test', 'UiHg8-7YbLsB2XzVnQw7gX0jFAfmeIID', '$2y$13$vybbrdv99ndFh9d7BXiNqehrs/0m0NbaHfS5ja.xm5q0j989J.61W', NULL, 'artemkramov@gmail.com', 10, 1502300128, 1502355427, NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_templatelang`
--
ALTER TABLE `email_templatelang`
  ADD CONSTRAINT `email_templatelang_ibfk_1` FOREIGN KEY (`email_template_id`) REFERENCES `email_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
