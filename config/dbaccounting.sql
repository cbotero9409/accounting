-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-12-2021 a las 22:41:23
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbordena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounting_notes`
--

CREATE TABLE `accounting_notes` (
  `id` int(11) NOT NULL,
  `fk_doc_type` int(11) DEFAULT NULL,
  `doc_number` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `class` tinyint(4) DEFAULT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `detail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fk_cost_center` int(11) DEFAULT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_type`
--

CREATE TABLE `account_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `account_type`
--

INSERT INTO `account_type` (`id`, `type`) VALUES
(1, 'Activo'),
(2, 'Pasivo'),
(3, 'Patrimonio'),
(4, 'Ingresos'),
(5, 'Egresos'),
(6, 'Indefinido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bills_attached_files`
--

CREATE TABLE `bills_attached_files` (
  `id` int(11) NOT NULL,
  `file` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fk_bill_of_sale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bills_attached_files`
--

INSERT INTO `bills_attached_files` (`id`, `file`, `fk_bill_of_sale`) VALUES
(4, '2-pc2.jpg', 2),
(5, '2-otro.pdf', 2),
(12, '5-usa.jpg', 5),
(16, '6-CUENTAS DE COBRO.odt', 6),
(19, '7-CertificadoPos_1152451727.pdf', 7),
(20, '7-CUENTAS DE COBRO.odt', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_of_sale`
--

CREATE TABLE `bill_of_sale` (
  `id` int(11) NOT NULL,
  `fk_doc_type` int(11) DEFAULT NULL,
  `doc_number` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `class` tinyint(4) NOT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `detail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cost_center` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `seller` int(11) DEFAULT NULL,
  `type_of_operation` tinyint(4) NOT NULL,
  `purchase_order_number` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `observations` text COLLATE utf8_spanish_ci NOT NULL,
  `reference` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `total_price` float NOT NULL,
  `cash` float DEFAULT NULL,
  `account_cash` int(11) DEFAULT NULL,
  `cash_payment_bank` float DEFAULT NULL,
  `bill_to_pay` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bill_of_sale`
--

INSERT INTO `bill_of_sale` (`id`, `fk_doc_type`, `doc_number`, `date`, `class`, `fk_municipality`, `detail`, `cost_center`, `client`, `seller`, `type_of_operation`, `purchase_order_number`, `observations`, `reference`, `total_price`, `cash`, `account_cash`, `cash_payment_bank`, `bill_to_pay`) VALUES
(2, 1, 'DNDV-2', '2021-11-18', 1, 159, 'Detalleeeeee', 2, 3, 5, 2, '12345', 'Observaciones Observaciones', 'Referencia aa', 67450000, 67000000, 5, 400000, 50000),
(3, 1, 'DNDV-3', '2021-11-18', 1, 140, 'd', 2, 2, 5, 1, '123', 'obs', 'ref', 1230, 1230, 3, NULL, NULL),
(5, 1, 'DNDV-4', '2021-11-18', 2, 134, 'd', 2, 3, 3, 2, '1236', 'obs', 'r', 1230, 1230, 3, NULL, NULL),
(6, 1, 'DNDV-5', '2021-11-19', 2, 37, 'Detalle', 1, 3, 5, 2, '12345', 'Observaciones', 'Referencia', 1230, 1230, 12, NULL, NULL),
(7, 1, 'DNDV-6', '2021-11-19', 2, 44, 'detalle', 2, 3, 3, 1, '123', 'obs', 'ref', 12300, 12300, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_to_pay`
--

CREATE TABLE `bill_to_pay` (
  `id` int(11) NOT NULL,
  `third_party` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `date_to_pay` date NOT NULL,
  `number_of_fees` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `fk_inovice` int(11) DEFAULT NULL,
  `fk_bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bill_to_pay`
--

INSERT INTO `bill_to_pay` (`id`, `third_party`, `account`, `date_to_pay`, `number_of_fees`, `fk_inovice`, `fk_bill`) VALUES
(1, 5, 26, '2021-11-20', '6', NULL, NULL),
(2, 2, 2, '2021-10-06', '3', 17, NULL),
(4, 3, 2, '2021-11-23', '10', 19, NULL),
(7, 3, 3, '2021-11-29', '8', NULL, 2),
(8, 3, 3, '2021-11-30', '', 21, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cash_bank`
--

CREATE TABLE `cash_bank` (
  `id` int(11) NOT NULL,
  `bank_account` int(11) DEFAULT NULL,
  `movement_type` tinyint(4) NOT NULL,
  `number` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date NOT NULL,
  `fk_invoice` int(11) DEFAULT NULL,
  `fk_bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cash_bank`
--

INSERT INTO `cash_bank` (`id`, `bank_account`, `movement_type`, `number`, `date`, `fk_invoice`, `fk_bill`) VALUES
(1, 2, 3, '353465467', '2021-10-28', NULL, NULL),
(2, 3, 2, '235446457546', '2021-10-13', NULL, NULL),
(3, 2, 2, '12345', '2021-10-14', NULL, NULL),
(4, 2, 1, '12345', '2021-10-19', 11, NULL),
(5, 2, 1, '12345', '2021-10-19', 12, NULL),
(6, 2, 1, '12345', '2021-10-19', 13, NULL),
(7, 2, 1, '12345', '2021-10-19', 14, NULL),
(8, 2, 1, '12345', '2021-10-19', NULL, NULL),
(9, 2, 1, '12345', '2021-10-06', 17, NULL),
(11, 2, 2, '12345', '2021-12-01', 19, NULL),
(12, 3, 1, '54321', '2021-11-17', 20, NULL),
(14, 3, 2, '12345', '2021-11-30', NULL, 2),
(16, 2, 2, '235', '2021-11-30', 21, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL,
  `cod_cc` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `short_name` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `manager` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_headquarter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `category_list`
--

INSERT INTO `category_list` (`id`, `cod_cc`, `name`, `short_name`, `type`, `manager`, `image`, `fk_headquarter`) VALUES
(6, 'cod 1', 'nom 1', 'n1', 'int', 'respo', 'img', 1),
(7, 'cod 2', 'nom 2', 'n2', 'float', 'respons1', '', 1),
(8, '', 'nom3', '', '', '', '', 1),
(10, '', 'hola', '', '', '', '', 3),
(11, '', 'cao', '', '', '', '', 3),
(12, 'df', 'sdf', 'sdf', 'sdf', 'dfs', 'sdf', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chart_accounts`
--

CREATE TABLE `chart_accounts` (
  `id` int(11) NOT NULL,
  `code` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `account` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `handle_third_parties` tinyint(4) DEFAULT NULL,
  `controls_indebtedness` tinyint(1) DEFAULT NULL,
  `handle_references` tinyint(1) DEFAULT NULL,
  `discriminate_by_third_party` tinyint(1) DEFAULT NULL,
  `demands_base_value` tinyint(1) DEFAULT NULL,
  `visible_in_selection` tinyint(1) DEFAULT NULL,
  `local_account` tinyint(1) DEFAULT NULL,
  `niif_account` tinyint(1) DEFAULT NULL,
  `fk_account` int(11) DEFAULT NULL,
  `use_niif_equivalent_account` tinyint(1) DEFAULT NULL,
  `fk_account_type` int(11) DEFAULT NULL,
  `class` tinyint(4) NOT NULL,
  `fk_tax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `chart_accounts`
--

INSERT INTO `chart_accounts` (`id`, `code`, `account`, `handle_third_parties`, `controls_indebtedness`, `handle_references`, `discriminate_by_third_party`, `demands_base_value`, `visible_in_selection`, `local_account`, `niif_account`, `fk_account`, `use_niif_equivalent_account`, `fk_account_type`, `class`, `fk_tax`) VALUES
(2, '1245', 'Derechos Fiduciarios', 2, 0, 0, 0, 0, 1, 1, 1, NULL, NULL, NULL, 0, NULL),
(3, '12345', 'Cuenta tipo 1', 1, 0, 1, 0, 1, 0, 0, 0, NULL, 1, 3, 1, NULL),
(5, '54321', 'Cuenta tipo 3', 0, 0, 0, 0, 0, 0, 1, 0, 2, 1, 3, 3, 2),
(12, '4545', '456456', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 2, 5, NULL),
(13, '4545464', '456456', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 4, 5, NULL),
(14, '3254', '34523', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 5, 5, NULL),
(16, '987654', 'Clase 1 modif', 1, 0, 1, 0, 0, 0, 1, 0, 3, 0, 5, 5, NULL),
(18, '463456456', '456456', 1, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 2, 1, NULL),
(19, '3454365', '3453245', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 4, 3, 2),
(20, '346565', '4563456', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 6, 5, NULL),
(21, '23542354', '324556', 0, 0, 0, 0, 1, 0, 0, 0, NULL, 0, 4, 1, NULL),
(22, '3452', '3245', 1, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 6, 3, 5),
(23, '3453245', '345345', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 2, 5, NULL),
(24, '2354345', '2345345', 1, 0, 0, 0, 1, 0, 0, 1, NULL, 0, 5, 5, NULL),
(26, '2354', '3245', 1, 1, 0, 1, 0, 0, 0, 0, NULL, 0, 4, 5, NULL),
(27, '234', '3245435', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 4, 5, NULL),
(28, '23345', '3452345', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 5, 5, NULL),
(29, '1', 'ACTIVO', 1, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 1, 1, NULL),
(31, '11', 'Disponible', 1, 0, 0, 0, 0, 0, 0, 0, 29, 0, 1, 1, NULL),
(32, '12', 'Inversiones', 1, 0, 0, 0, 0, 0, 0, 0, 29, 0, 1, 1, NULL),
(33, '1105', 'Caja', 1, 0, 0, 0, 0, 0, 0, 0, 31, 0, 1, 1, NULL),
(34, '1110', 'Bancos', 1, 0, 0, 0, 0, 0, 0, 0, 31, 0, 1, 1, NULL),
(35, '110505', 'Caja General', 1, 0, 0, 0, 0, 0, 0, 0, 33, 0, 1, 1, NULL),
(36, '110510', 'Cajas menores', 1, 0, 0, 0, 0, 0, 0, 0, 33, 0, 1, 1, NULL),
(37, '1205', 'Acciones', 1, 0, 0, 0, 0, 0, 0, 0, 32, 0, 1, 1, NULL),
(38, '1210', 'Cuotas o partes de interés social', 1, 0, 0, 0, 0, 0, 0, 0, 32, 0, 1, 1, NULL),
(39, '111005', 'Moneda nacional', 1, 0, 0, 0, 0, 0, 0, 0, 34, 0, 1, 1, NULL),
(40, '120505', 'Agricultura, ganadería, caza y silvicultura', 1, 0, 0, 0, 0, 0, 0, 0, 37, 0, 1, 1, NULL),
(41, '120510', 'Pesca', 1, 0, 0, 0, 0, 0, 0, 0, 37, 0, 1, 1, NULL),
(42, '121005', 'Agricultura, ganadería, caza y silvicultura', 1, 0, 0, 0, 0, 0, 0, 0, 38, 0, 1, 1, NULL),
(43, '2', 'PASIVO', 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 2, 2, NULL),
(46, '21', 'Obligaciones financieras', 2, 1, 0, 0, 0, 0, 0, 0, 43, 0, 2, 2, NULL),
(47, '22', 'Proveedores', 2, 1, 0, 0, 0, 0, 0, 0, 43, 0, 2, 2, NULL),
(48, '2105', 'Bancos nacionales', 2, 1, 0, 0, 0, 0, 0, 0, 46, 0, 2, 2, NULL),
(49, '2110', 'Bancos del exterior', 2, 1, 0, 0, 0, 0, 0, 0, 46, 0, 2, 2, NULL),
(50, '2205', 'Nacionales', 2, 1, 0, 0, 0, 0, 0, 0, 47, 0, 2, 2, NULL),
(51, '2210', 'Del exterior', 2, 1, 0, 0, 0, 0, 0, 0, 47, 0, 2, 2, NULL),
(52, '210505', 'Sobregiros', 2, 1, 0, 0, 0, 0, 0, 0, 48, 0, 2, 2, NULL),
(53, '211010', 'Pagares', 2, 1, 0, 0, 0, 0, 0, 0, 49, 0, 2, 2, NULL),
(54, '220510', 'Nacionales  ** 1 a la 98 **', 2, 1, 0, 0, 0, 0, 0, 0, 50, 0, 2, 2, NULL),
(55, '221005', 'Del exterior  ** 1 a la 98 **', 2, 1, 0, 0, 0, 0, 0, 0, 51, 0, 2, 2, NULL),
(56, '23', 'Nombre', 1, 0, 1, 0, 1, 0, 1, 0, NULL, 1, 1, 2, NULL),
(57, '1115', 'Cuenta Nueva Mod', 1, 0, 0, 0, 1, 0, 0, 0, 31, 0, 3, 1, NULL),
(58, '11050505', 'Cuenta', 0, 0, 0, 0, 0, 0, 0, 0, 35, 0, 1, 2, NULL),
(59, '11050510', 'Cuenta 2', 0, 0, 0, 0, 0, 0, 0, 0, 35, 0, 1, 2, NULL),
(60, '111010', 'Cuenta 10', 1, 0, 1, 0, 0, 0, 0, 1, 34, 1, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `business_name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `doc_type` tinyint(4) NOT NULL,
  `doc_number` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dv` tinyint(4) DEFAULT NULL,
  `short_name` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `manager` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `legal_representative` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `representative_doc` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `accountant` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `accountant_doc` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tax_auditor` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `auditor_doc` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `e_billing_management` tinyint(1) NOT NULL DEFAULT 0,
  `doc_platform` tinyint(1) NOT NULL DEFAULT 0,
  `own_email_sender` tinyint(1) NOT NULL DEFAULT 0,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cxc_term` tinyint(4) DEFAULT 30,
  `cxp_term` tinyint(4) DEFAULT 30,
  `interest_management` tinyint(1) NOT NULL DEFAULT 0,
  `electronic_billing` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `business_name`, `doc_type`, `doc_number`, `dv`, `short_name`, `manager`, `color`, `legal_representative`, `representative_doc`, `accountant`, `accountant_doc`, `tax_auditor`, `auditor_doc`, `e_billing_management`, `doc_platform`, `own_email_sender`, `fk_municipality`, `address`, `cxc_term`, `cxp_term`, `interest_management`, `electronic_billing`, `start_date`, `end_date`) VALUES
(5, 'Espacios Diseño Construcción', 4, '900238439', 7, 'EDC', 'Sebastian Echeverri', '#1c71d8', 'Sebastian Echeverri', '8125913', '', '', 'Diana Martínez', '1017133958', 1, 0, 0, 107, 'Cl 54 #63AA-89', 30, 30, 0, 'Identificación ante Insoft: 900238439\r\nId. tipo de documento: 31\r\nDoc...', '2019-01-01', '2099-12-31'),
(7, 'Alumina', 4, '987654', NULL, '', '', '#333333', '', '', '', '', '', '', 0, 0, 0, NULL, '', 30, 30, 0, '', NULL, NULL),
(8, 'asd', 4, '12', NULL, '', '', '#333333', '', '', '', '', '', '', 0, 0, 0, NULL, '', 30, 30, 0, '', NULL, NULL),
(9, 'Noel', 4, '12345', NULL, '', '', '#333333', '', '', '', '', '', '', 0, 0, 0, NULL, '', 30, 30, 0, '', NULL, NULL),
(10, 'Espacios DYC', 4, '12345', 8, 'EDC', 'Gerente', '#333333', 'Representante', '12345', '', '', 'Revisor', '54321', 1, 0, 1, 20, '', 30, 30, 0, 'Factura\r\nElectronica', '2021-11-17', '2021-11-30'),
(12, 'Empresa', 4, '123', 8, '', 'Elque sea', '#e01b24', 'Andres', '', '', '', '', '', 0, 0, 0, 140, '', 30, 30, 1, 'factura\r\nelec', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_label`
--

CREATE TABLE `company_label` (
  `id` int(11) NOT NULL,
  `main_title` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mt_size` tinyint(4) DEFAULT 14,
  `mt_color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subtitle` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subt_size` tinyint(4) DEFAULT 14,
  `subt_color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detail_size` tinyint(4) DEFAULT 14,
  `detail_color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `footer` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `footer_size` tinyint(4) DEFAULT 14,
  `footer_color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `header_type` tinyint(4) DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `company_label`
--

INSERT INTO `company_label` (`id`, `main_title`, `mt_size`, `mt_color`, `subtitle`, `subt_size`, `subt_color`, `detail`, `detail_size`, `detail_color`, `footer`, `footer_size`, `footer_color`, `logo`, `header_type`, `fk_company`) VALUES
(1, NULL, 14, '#62a0ea', NULL, 14, '#333333', NULL, 14, '#f6d32d', NULL, 14, '#333333', 'Espacios DYC.png', NULL, 10),
(3, 'titulo', 14, '#613583', '', 14, '#e01b24', 'det', 14, '#865e3c', '', 14, '#333333', '12-Empresa.png', 2, 12),
(4, '', 14, '#000000', '', 14, '#000000', '', 14, '#000000', '', 14, '#000000', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_type` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `web_page` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_supplier` int(11) DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL,
  `fk_headquarter` int(11) DEFAULT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `person_type`, `cell_phone`, `phone`, `email`, `address`, `web_page`, `fk_supplier`, `fk_company`, `fk_headquarter`, `fk_third`) VALUES
(1, 'Camilo Botero', 'Natural', '3216317798', '2606292', 'cbotero2709@gmail.com', 'Cir. 2 #68 (202)', NULL, 2, NULL, NULL, NULL),
(2, 'Vanesa', 'Jurídica', '2354344', '2345345345', 'vanesa@altsys.com.co', 'sdef3453456ffer', NULL, 3, NULL, NULL, NULL),
(3, 'Camilo Botero', 'Natural', '3216317798', '3276270', 'cbotero2709@gmail.com', 'Cir. 2 #68 (202)', NULL, 1, NULL, NULL, NULL),
(4, 'Vanesa', 'Jurídica', '2354344', '2345345345', 'vanesa@altsys.com.co', 'sdef3453456ffer', NULL, 1, NULL, NULL, NULL),
(5, 'Santiago', 'Natural', '23435345234', '23542345234', 'san@altsys', 'wdsef34543wdef', NULL, 1, NULL, NULL, NULL),
(6, 'Modal Benitez', 'Jurídica', '3214547451', '3214567', 'modal@gmail.com', 'modal 34 #54-61', NULL, 1, NULL, NULL, NULL),
(8, 'Camilo Botero Betancur', 'Natural', '3216317798', '3276270', 'botabeta@hotmail.com', 'Circular 2 #68-61 Apto 202', NULL, 1, NULL, NULL, NULL),
(10, 'Camilo Botero 1', 'Jurídica', '2354344', '2345345345', 'cbotero27@gmail.com', 'Cir. 2 #68 (202)', NULL, 1, NULL, NULL, NULL),
(15, 'Nuevo', 'Jurídica', '321', '260', 'nuevo@gmail.com', 'cra.75', NULL, 1, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL),
(19, '', '', '', '', '', NULL, NULL, NULL, 12, NULL, NULL),
(20, 'Camilo', 'Natural', '321631', '260', 'cbotero2709@gmail.com', NULL, NULL, NULL, NULL, 1, NULL),
(21, 'nombre contacto', '', '', '', '', NULL, NULL, NULL, NULL, 3, NULL),
(22, 'Pepito', '', '3276890', '', '', NULL, NULL, NULL, 5, NULL, NULL),
(23, 'contacto noel', '', '', '', '', NULL, NULL, NULL, NULL, 5, NULL),
(25, NULL, NULL, '321', '', '', NULL, '', NULL, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost_center`
--

CREATE TABLE `cost_center` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `short_name` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `manager` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `class_cc` tinyint(4) DEFAULT NULL,
  `group_class` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL,
  `fk_headquarter` int(11) DEFAULT NULL,
  `fk_cost_center` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cost_center`
--

INSERT INTO `cost_center` (`id`, `code`, `name`, `short_name`, `manager`, `class_cc`, `group_class`, `start_date`, `end_date`, `fk_company`, `fk_headquarter`, `fk_cost_center`) VALUES
(1, '101', 'DISEÑO', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(2, '102', 'CONSTRUCCION', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '122001', 'CAMBULO', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(4, '104004', 'Diseños Arquitectónicos', 'DA', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL),
(5, '700001', 'centro', 'c1', 'elquesea', 1, '3', '2021-12-01', '2021-12-17', 7, NULL, NULL),
(6, '5101', 'desde sede 1 empresa 5', '', '', NULL, '', NULL, NULL, 5, 1, NULL),
(7, '101001', 'desde centro de costo 101', '', '', NULL, '', NULL, NULL, 5, NULL, 1),
(8, '700002', 'centro 7', '', '', NULL, '', NULL, NULL, 7, NULL, NULL),
(9, '5102', 'sdgf', '', '', NULL, '', NULL, NULL, 5, 1, NULL),
(10, '101002', 'empresa 5 cc 101', '', '', 1, '', NULL, NULL, 5, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(2) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLÁNTICO'),
(11, 'BOGOTÁ, D.C.'),
(13, 'BOLÍVAR'),
(15, 'BOYACÁ'),
(17, 'CALDAS'),
(18, 'CAQUETÁ'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CÓRDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCÓ'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'NORTE DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(91, 'AMAZONAS'),
(94, 'GUAINÍA'),
(95, 'GUAVIARE'),
(97, 'VAUPÉS'),
(99, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_type`
--

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mask` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numbering_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `document_type`
--

INSERT INTO `document_type` (`id`, `code`, `name`, `mask`, `numbering_type`) VALUES
(1, '1740', 'Devolución de ventass', 'DNDV###@@@', 2),
(2, '8097', 'Orden de Pago', 'ODP@', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `economic_activity`
--

CREATE TABLE `economic_activity` (
  `id` int(11) NOT NULL,
  `code` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `economic_activity`
--

INSERT INTO `economic_activity` (`id`, `code`, `name`) VALUES
(1, '0010', 'Asalariados - Personas naturales cuyos ingresos provengan de la relación laboral'),
(2, '0112', 'Cultivo de arroz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense_list`
--

CREATE TABLE `expense_list` (
  `id` int(11) NOT NULL,
  `fk_chart_account` int(11) DEFAULT NULL,
  `concept` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `fk_cost_center` int(11) DEFAULT NULL,
  `fk_inovice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `expense_list`
--

INSERT INTO `expense_list` (`id`, `fk_chart_account`, `concept`, `price`, `fk_cost_center`, `fk_inovice`) VALUES
(1, 2, 'Ingreso 1', 10000, 2, NULL),
(2, 5, 'Concepto 1', 100000000, 2, NULL),
(3, 3, 'Concepto 2', 5000000, 1, NULL),
(4, 3, 'Conc', 10000000, 1, 17),
(5, 2, 'Concept', 1000000, 2, 17),
(13, 3, 'Concepto', 10000000, 1, 19),
(14, 5, 'Concepto2', 5000000, 2, 19),
(15, 2, 'Concepto 1', 100000, 1, 20),
(16, 3, 'Concepto 3', 300000, 3, 20),
(17, 5, 'gfddh', 1000, 1, 21),
(18, 3, 'sdfgv', 3000, 2, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `headquarters`
--

CREATE TABLE `headquarters` (
  `id` int(11) NOT NULL,
  `fk_company` int(11) DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `short_name` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `manager` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `default_category` tinyint(4) DEFAULT NULL,
  `cost_center_class` tinyint(4) DEFAULT NULL,
  `group_class` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `headquarters`
--

INSERT INTO `headquarters` (`id`, `fk_company`, `code`, `name`, `short_name`, `manager`, `fk_municipality`, `address`, `default_category`, `cost_center_class`, `group_class`, `start_date`, `end_date`) VALUES
(1, 5, '1', 'Sede 1', 'eps', 'Respon', 743, 'cir 2 #68', 2, 2, 'grupo 3', '2021-11-01', '2021-11-30'),
(2, 5, '2', 'Sede 2', '', '', NULL, '', NULL, NULL, '', NULL, NULL),
(3, 5, '3', 'Sede 3', '', '', NULL, '', NULL, NULL, '', '2021-11-25', NULL),
(4, 12, '1', 'Sede empresa 12', '', '', NULL, '', NULL, NULL, '', NULL, NULL),
(5, 9, '1', 'sede noel', '', '', 99, '', NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `income_list`
--

CREATE TABLE `income_list` (
  `id` int(11) NOT NULL,
  `fk_chart_account` int(11) DEFAULT NULL,
  `concept` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `fk_cost_center` int(11) DEFAULT NULL,
  `fk_bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `income_list`
--

INSERT INTO `income_list` (`id`, `fk_chart_account`, `concept`, `price`, `fk_cost_center`, `fk_bill`) VALUES
(29, 2, 'Concepto', 1000, 1, 6),
(33, 2, 'concepto', 10000, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventory`
--

INSERT INTO `inventory` (`id`, `item`) VALUES
(1, 'tubo'),
(2, 'cable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` int(11) NOT NULL,
  `fk_item` int(11) DEFAULT NULL,
  `code` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unit` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `price` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `last_price` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `fk_item`, `code`, `unit`, `price`, `date`, `last_price`, `last_date`, `fk_third`) VALUES
(32, 1, '', '3', '500', NULL, '', NULL, 12),
(33, 2, '', '2', '', NULL, '', NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `fk_doc_type` int(11) DEFAULT NULL,
  `doc_number` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `class` tinyint(4) DEFAULT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `detail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cost_center` int(11) DEFAULT NULL,
  `third_party` int(11) DEFAULT NULL,
  `reference` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `total_price` float NOT NULL,
  `cash` float DEFAULT NULL,
  `account_cash` int(11) DEFAULT NULL,
  `cash_payment_bank` float DEFAULT NULL,
  `bill_to_pay` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`id`, `fk_doc_type`, `doc_number`, `date`, `class`, `fk_municipality`, `detail`, `cost_center`, `third_party`, `reference`, `total_price`, `cash`, `account_cash`, `cash_payment_bank`, `bill_to_pay`) VALUES
(1, 1, 'FC1740', '2021-10-15', 1, 81, 'Detalleee', 1, 2, '123', 1417000, 1000000, 3, 417000, NULL),
(2, 1, '17403', '2021-10-15', 1, 452, 'Detalleee', 1, 2, 'Referenciaaa', 152600, 152000, 2, 600, NULL),
(3, 1, '174034', '2021-10-15', 1, 107, 'Detalleee', 1, 2, 'Referenciaaa', 10000000, 10000000, 2, NULL, NULL),
(4, 1, 'FC1740355', '2021-10-15', 1, 292, 'Detalleee', 1, 2, 'Referenciaaa', 14600000000, 10000000000, 2, NULL, NULL),
(5, 1, '17', '2021-10-15', 1, 107, 'Detalleee', 1, 2, 'Referenciaaa', 123000, 123000, 12, NULL, NULL),
(6, 1, '1740', '2021-10-19', 2, 36, 'Detalleee', 1, 3, 'Ref', 10230000, 10230000, 5, NULL, NULL),
(7, 1, '1740', '2021-10-19', 2, 152, 'De4talle', 1, 5, 'Ref', 12300000, 12300000, 5, NULL, NULL),
(8, 1, '1740', '2021-10-19', NULL, 152, 'De4talle', 1, 5, 'Ref', 12300000, 12300000, 5, NULL, NULL),
(9, 1, '1740', '2021-10-19', NULL, NULL, 'Det', 1, 5, 'Ref', 123000000, 123000000, 5, NULL, NULL),
(10, 1, '1740', '2021-10-19', 1, 373, 'Detalle', 1, 3, 'Referencia1', 114450000, 114400000, 2, 50000, NULL),
(11, 1, '1740', '2021-10-19', 1, 373, 'Detalle', 1, 3, 'Referencia1', 114450000, 114400000, 2, 50000, NULL),
(12, 1, '1740', '2021-10-19', 1, 373, 'Detalle', 1, 3, 'Referencia1', 114450000, 114400000, 2, 50000, NULL),
(13, 1, '1740', '2021-10-19', 1, 373, 'Detalle', 1, 3, 'Referencia1', 114450000, 114400000, 2, 50000, NULL),
(14, 1, '1740', '2021-10-19', 1, 373, 'Detalle', 1, 3, 'Referencia1', 114450000, 114400000, 2, 50000, NULL),
(16, 1, '1740', '2021-10-19', 1, 532, 'det', 1, 2, 'ref', 123000000, 123000000, 3, NULL, NULL),
(17, 1, '17402', '2021-10-19', 1, 366, 'Detalle', 1, 3, 'Refe', 11990000, 11000000, 3, 900000, 90000),
(19, 2, 'ODP-1', '2021-11-03', 2, 134, 'Detalle1mod', 2, 2, 'Referenciaaamod', 25350000, 16000000, 5, 5550000, 3800000),
(20, 1, 'DNDV-1740356', '2021-11-08', 1, 547, 'Detalleee', 1, 2, 'Referenciaaaa', 450000, 200000, 2, 150000, 100000),
(21, 1, 'DNDV-1740356', '2021-11-19', 2, 338, 'Nombre', 2, 5, 'ref', 3440, 3400, 3, 20, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movements_list`
--

CREATE TABLE `movements_list` (
  `id` int(11) NOT NULL,
  `fk_chart_account` int(11) DEFAULT NULL,
  `fk_cost_center` int(11) DEFAULT NULL,
  `observations` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `base_value` float DEFAULT NULL,
  `third_transaction` int(11) DEFAULT NULL,
  `movement_type` tinyint(4) DEFAULT NULL,
  `movement_number` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_active` int(11) DEFAULT NULL,
  `fk_acc_note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipality`
--

CREATE TABLE `municipality` (
  `id` int(6) UNSIGNED NOT NULL,
  `municipality` varchar(255) NOT NULL DEFAULT '',
  `fk_department` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `municipality`
--

INSERT INTO `municipality` (`id`, `municipality`, `fk_department`) VALUES
(1, 'Abriaquí', 5),
(2, 'Acacías', 50),
(3, 'Acandí', 27),
(4, 'Acevedo', 41),
(5, 'Achí', 13),
(6, 'Agrado', 41),
(7, 'Agua de Dios', 25),
(8, 'Aguachica', 20),
(9, 'Aguada', 68),
(10, 'Aguadas', 17),
(11, 'Aguazul', 85),
(12, 'Agustín Codazzi', 20),
(13, 'Aipe', 41),
(14, 'Albania', 18),
(15, 'Albania', 44),
(16, 'Albania', 68),
(17, 'Albán', 25),
(18, 'Albán (San José)', 52),
(19, 'Alcalá', 76),
(20, 'Alejandria', 5),
(21, 'Algarrobo', 47),
(22, 'Algeciras', 41),
(23, 'Almaguer', 19),
(24, 'Almeida', 15),
(25, 'Alpujarra', 73),
(26, 'Altamira', 41),
(27, 'Alto Baudó (Pie de Pato)', 27),
(28, 'Altos del Rosario', 13),
(29, 'Alvarado', 73),
(30, 'Amagá', 5),
(31, 'Amalfi', 5),
(32, 'Ambalema', 73),
(33, 'Anapoima', 25),
(34, 'Ancuya', 52),
(35, 'Andalucía', 76),
(36, 'Andes', 5),
(37, 'Angelópolis', 5),
(38, 'Angostura', 5),
(39, 'Anolaima', 25),
(40, 'Anorí', 5),
(41, 'Anserma', 17),
(42, 'Ansermanuevo', 76),
(43, 'Anzoátegui', 73),
(44, 'Anzá', 5),
(45, 'Apartadó', 5),
(46, 'Apulo', 25),
(47, 'Apía', 66),
(48, 'Aquitania', 15),
(49, 'Aracataca', 47),
(50, 'Aranzazu', 17),
(51, 'Aratoca', 68),
(52, 'Arauca', 81),
(53, 'Arauquita', 81),
(54, 'Arbeláez', 25),
(55, 'Arboleda (Berruecos)', 52),
(56, 'Arboledas', 54),
(57, 'Arboletes', 5),
(58, 'Arcabuco', 15),
(59, 'Arenal', 13),
(60, 'Argelia', 5),
(61, 'Argelia', 19),
(62, 'Argelia', 76),
(63, 'Ariguaní (El Difícil)', 47),
(64, 'Arjona', 13),
(65, 'Armenia', 5),
(66, 'Armenia', 63),
(67, 'Armero (Guayabal)', 73),
(68, 'Arroyohondo', 13),
(69, 'Astrea', 20),
(70, 'Ataco', 73),
(71, 'Atrato (Yuto)', 27),
(72, 'Ayapel', 23),
(73, 'Bagadó', 27),
(74, 'Bahía Solano (Mútis)', 27),
(75, 'Bajo Baudó (Pizarro)', 27),
(76, 'Balboa', 19),
(77, 'Balboa', 66),
(78, 'Baranoa', 8),
(79, 'Baraya', 41),
(80, 'Barbacoas', 52),
(81, 'Barbosa', 5),
(82, 'Barbosa', 68),
(83, 'Barichara', 68),
(84, 'Barranca de Upía', 50),
(85, 'Barrancabermeja', 68),
(86, 'Barrancas', 44),
(87, 'Barranco de Loba', 13),
(88, 'Barranquilla', 8),
(89, 'Becerríl', 20),
(90, 'Belalcázar', 17),
(91, 'Bello', 5),
(92, 'Belmira', 5),
(93, 'Beltrán', 25),
(94, 'Belén', 15),
(95, 'Belén', 52),
(96, 'Belén de Bajirá', 27),
(97, 'Belén de Umbría', 66),
(98, 'Belén de los Andaquíes', 18),
(99, 'Berbeo', 15),
(100, 'Betania', 5),
(101, 'Beteitiva', 15),
(102, 'Betulia', 5),
(103, 'Betulia', 68),
(104, 'Bituima', 25),
(105, 'Boavita', 15),
(106, 'Bochalema', 54),
(107, 'Bogotá D.C.', 11),
(108, 'Bojacá', 25),
(109, 'Bojayá (Bellavista)', 27),
(110, 'Bolívar', 5),
(111, 'Bolívar', 19),
(112, 'Bolívar', 68),
(113, 'Bolívar', 76),
(114, 'Bosconia', 20),
(115, 'Boyacá', 15),
(116, 'Briceño', 5),
(117, 'Briceño', 15),
(118, 'Bucaramanga', 68),
(119, 'Bucarasica', 54),
(120, 'Buenaventura', 76),
(121, 'Buenavista', 15),
(122, 'Buenavista', 23),
(123, 'Buenavista', 63),
(124, 'Buenavista', 70),
(125, 'Buenos Aires', 19),
(126, 'Buesaco', 52),
(127, 'Buga', 76),
(128, 'Bugalagrande', 76),
(129, 'Burítica', 5),
(130, 'Busbanza', 15),
(131, 'Cabrera', 25),
(132, 'Cabrera', 68),
(133, 'Cabuyaro', 50),
(134, 'Cachipay', 25),
(135, 'Caicedo', 5),
(136, 'Caicedonia', 76),
(137, 'Caimito', 70),
(138, 'Cajamarca', 73),
(139, 'Cajibío', 19),
(140, 'Cajicá', 25),
(141, 'Calamar', 13),
(142, 'Calamar', 95),
(143, 'Calarcá', 63),
(144, 'Caldas', 5),
(145, 'Caldas', 15),
(146, 'Caldono', 19),
(147, 'California', 68),
(148, 'Calima (Darién)', 76),
(149, 'Caloto', 19),
(150, 'Calí', 76),
(151, 'Campamento', 5),
(152, 'Campo de la Cruz', 8),
(153, 'Campoalegre', 41),
(154, 'Campohermoso', 15),
(155, 'Canalete', 23),
(156, 'Candelaria', 8),
(157, 'Candelaria', 76),
(158, 'Cantagallo', 13),
(159, 'Cantón de San Pablo', 27),
(160, 'Caparrapí', 25),
(161, 'Capitanejo', 68),
(162, 'Caracolí', 5),
(163, 'Caramanta', 5),
(164, 'Carcasí', 68),
(165, 'Carepa', 5),
(166, 'Carmen de Apicalá', 73),
(167, 'Carmen de Carupa', 25),
(168, 'Carmen de Viboral', 5),
(169, 'Carmen del Darién (CURBARADÓ)', 27),
(170, 'Carolina', 5),
(171, 'Cartagena', 13),
(172, 'Cartagena del Chairá', 18),
(173, 'Cartago', 76),
(174, 'Carurú', 97),
(175, 'Casabianca', 73),
(176, 'Castilla la Nueva', 50),
(177, 'Caucasia', 5),
(178, 'Cañasgordas', 5),
(179, 'Cepita', 68),
(180, 'Cereté', 23),
(181, 'Cerinza', 15),
(182, 'Cerrito', 68),
(183, 'Cerro San Antonio', 47),
(184, 'Chachaguí', 52),
(185, 'Chaguaní', 25),
(186, 'Chalán', 70),
(187, 'Chaparral', 73),
(188, 'Charalá', 68),
(189, 'Charta', 68),
(190, 'Chigorodó', 5),
(191, 'Chima', 68),
(192, 'Chimichagua', 20),
(193, 'Chimá', 23),
(194, 'Chinavita', 15),
(195, 'Chinchiná', 17),
(196, 'Chinácota', 54),
(197, 'Chinú', 23),
(198, 'Chipaque', 25),
(199, 'Chipatá', 68),
(200, 'Chiquinquirá', 15),
(201, 'Chiriguaná', 20),
(202, 'Chiscas', 15),
(203, 'Chita', 15),
(204, 'Chitagá', 54),
(205, 'Chitaraque', 15),
(206, 'Chivatá', 15),
(207, 'Chivolo', 47),
(208, 'Choachí', 25),
(209, 'Chocontá', 25),
(210, 'Chámeza', 85),
(211, 'Chía', 25),
(212, 'Chíquiza', 15),
(213, 'Chívor', 15),
(214, 'Cicuco', 13),
(215, 'Cimitarra', 68),
(216, 'Circasia', 63),
(217, 'Cisneros', 5),
(218, 'Ciénaga', 15),
(219, 'Ciénaga', 47),
(220, 'Ciénaga de Oro', 23),
(221, 'Clemencia', 13),
(222, 'Cocorná', 5),
(223, 'Coello', 73),
(224, 'Cogua', 25),
(225, 'Colombia', 41),
(226, 'Colosó (Ricaurte)', 70),
(227, 'Colón', 86),
(228, 'Colón (Génova)', 52),
(229, 'Concepción', 5),
(230, 'Concepción', 68),
(231, 'Concordia', 5),
(232, 'Concordia', 47),
(233, 'Condoto', 27),
(234, 'Confines', 68),
(235, 'Consaca', 52),
(236, 'Contadero', 52),
(237, 'Contratación', 68),
(238, 'Convención', 54),
(239, 'Copacabana', 5),
(240, 'Coper', 15),
(241, 'Cordobá', 63),
(242, 'Corinto', 19),
(243, 'Coromoro', 68),
(244, 'Corozal', 70),
(245, 'Corrales', 15),
(246, 'Cota', 25),
(247, 'Cotorra', 23),
(248, 'Covarachía', 15),
(249, 'Coveñas', 70),
(250, 'Coyaima', 73),
(251, 'Cravo Norte', 81),
(252, 'Cuaspud (Carlosama)', 52),
(253, 'Cubarral', 50),
(254, 'Cubará', 15),
(255, 'Cucaita', 15),
(256, 'Cucunubá', 25),
(257, 'Cucutilla', 54),
(258, 'Cuitiva', 15),
(259, 'Cumaral', 50),
(260, 'Cumaribo', 99),
(261, 'Cumbal', 52),
(262, 'Cumbitara', 52),
(263, 'Cunday', 73),
(264, 'Curillo', 18),
(265, 'Curití', 68),
(266, 'Curumaní', 20),
(267, 'Cáceres', 5),
(268, 'Cáchira', 54),
(269, 'Cácota', 54),
(270, 'Cáqueza', 25),
(271, 'Cértegui', 27),
(272, 'Cómbita', 15),
(273, 'Córdoba', 13),
(274, 'Córdoba', 52),
(275, 'Cúcuta', 54),
(276, 'Dabeiba', 5),
(277, 'Dagua', 76),
(278, 'Dibulla', 44),
(279, 'Distracción', 44),
(280, 'Dolores', 73),
(281, 'Don Matías', 5),
(282, 'Dos Quebradas', 66),
(283, 'Duitama', 15),
(284, 'Durania', 54),
(285, 'Ebéjico', 5),
(286, 'El Bagre', 5),
(287, 'El Banco', 47),
(288, 'El Cairo', 76),
(289, 'El Calvario', 50),
(290, 'El Carmen', 54),
(291, 'El Carmen', 68),
(292, 'El Carmen de Atrato', 27),
(293, 'El Carmen de Bolívar', 13),
(294, 'El Castillo', 50),
(295, 'El Cerrito', 76),
(296, 'El Charco', 52),
(297, 'El Cocuy', 15),
(298, 'El Colegio', 25),
(299, 'El Copey', 20),
(300, 'El Doncello', 18),
(301, 'El Dorado', 50),
(302, 'El Dovio', 76),
(303, 'El Espino', 15),
(304, 'El Guacamayo', 68),
(305, 'El Guamo', 13),
(306, 'El Molino', 44),
(307, 'El Paso', 20),
(308, 'El Paujil', 18),
(309, 'El Peñol', 52),
(310, 'El Peñon', 13),
(311, 'El Peñon', 68),
(312, 'El Peñón', 25),
(313, 'El Piñon', 47),
(314, 'El Playón', 68),
(315, 'El Retorno', 95),
(316, 'El Retén', 47),
(317, 'El Roble', 70),
(318, 'El Rosal', 25),
(319, 'El Rosario', 52),
(320, 'El Tablón de Gómez', 52),
(321, 'El Tambo', 19),
(322, 'El Tambo', 52),
(323, 'El Tarra', 54),
(324, 'El Zulia', 54),
(325, 'El Águila', 76),
(326, 'Elías', 41),
(327, 'Encino', 68),
(328, 'Enciso', 68),
(329, 'Entrerríos', 5),
(330, 'Envigado', 5),
(331, 'Espinal', 73),
(332, 'Facatativá', 25),
(333, 'Falan', 73),
(334, 'Filadelfia', 17),
(335, 'Filandia', 63),
(336, 'Firavitoba', 15),
(337, 'Flandes', 73),
(338, 'Florencia', 18),
(339, 'Florencia', 19),
(340, 'Floresta', 15),
(341, 'Florida', 76),
(342, 'Floridablanca', 68),
(343, 'Florián', 68),
(344, 'Fonseca', 44),
(345, 'Fortúl', 81),
(346, 'Fosca', 25),
(347, 'Francisco Pizarro', 52),
(348, 'Fredonia', 5),
(349, 'Fresno', 73),
(350, 'Frontino', 5),
(351, 'Fuente de Oro', 50),
(352, 'Fundación', 47),
(353, 'Funes', 52),
(354, 'Funza', 25),
(355, 'Fusagasugá', 25),
(356, 'Fómeque', 25),
(357, 'Fúquene', 25),
(358, 'Gachalá', 25),
(359, 'Gachancipá', 25),
(360, 'Gachantivá', 15),
(361, 'Gachetá', 25),
(362, 'Galapa', 8),
(363, 'Galeras (Nueva Granada)', 70),
(364, 'Galán', 68),
(365, 'Gama', 25),
(366, 'Gamarra', 20),
(367, 'Garagoa', 15),
(368, 'Garzón', 41),
(369, 'Gigante', 41),
(370, 'Ginebra', 76),
(371, 'Giraldo', 5),
(372, 'Girardot', 25),
(373, 'Girardota', 5),
(374, 'Girón', 68),
(375, 'Gonzalez', 20),
(376, 'Gramalote', 54),
(377, 'Granada', 5),
(378, 'Granada', 25),
(379, 'Granada', 50),
(380, 'Guaca', 68),
(381, 'Guacamayas', 15),
(382, 'Guacarí', 76),
(383, 'Guachavés', 52),
(384, 'Guachené', 19),
(385, 'Guachetá', 25),
(386, 'Guachucal', 52),
(387, 'Guadalupe', 5),
(388, 'Guadalupe', 41),
(389, 'Guadalupe', 68),
(390, 'Guaduas', 25),
(391, 'Guaitarilla', 52),
(392, 'Gualmatán', 52),
(393, 'Guamal', 47),
(394, 'Guamal', 50),
(395, 'Guamo', 73),
(396, 'Guapota', 68),
(397, 'Guapí', 19),
(398, 'Guaranda', 70),
(399, 'Guarne', 5),
(400, 'Guasca', 25),
(401, 'Guatapé', 5),
(402, 'Guataquí', 25),
(403, 'Guatavita', 25),
(404, 'Guateque', 15),
(405, 'Guavatá', 68),
(406, 'Guayabal de Siquima', 25),
(407, 'Guayabetal', 25),
(408, 'Guayatá', 15),
(409, 'Guepsa', 68),
(410, 'Guicán', 15),
(411, 'Gutiérrez', 25),
(412, 'Guática', 66),
(413, 'Gámbita', 68),
(414, 'Gámeza', 15),
(415, 'Génova', 63),
(416, 'Gómez Plata', 5),
(417, 'Hacarí', 54),
(418, 'Hatillo de Loba', 13),
(419, 'Hato', 68),
(420, 'Hato Corozal', 85),
(421, 'Hatonuevo', 44),
(422, 'Heliconia', 5),
(423, 'Herrán', 54),
(424, 'Herveo', 73),
(425, 'Hispania', 5),
(426, 'Hobo', 41),
(427, 'Honda', 73),
(428, 'Ibagué', 73),
(429, 'Icononzo', 73),
(430, 'Iles', 52),
(431, 'Imúes', 52),
(432, 'Inzá', 19),
(433, 'Inírida', 94),
(434, 'Ipiales', 52),
(435, 'Isnos', 41),
(436, 'Istmina', 27),
(437, 'Itagüí', 5),
(438, 'Ituango', 5),
(439, 'Izá', 15),
(440, 'Jambaló', 19),
(441, 'Jamundí', 76),
(442, 'Jardín', 5),
(443, 'Jenesano', 15),
(444, 'Jericó', 5),
(445, 'Jericó', 15),
(446, 'Jerusalén', 25),
(447, 'Jesús María', 68),
(448, 'Jordán', 68),
(449, 'Juan de Acosta', 8),
(450, 'Junín', 25),
(451, 'Juradó', 27),
(452, 'La Apartada y La Frontera', 23),
(453, 'La Argentina', 41),
(454, 'La Belleza', 68),
(455, 'La Calera', 25),
(456, 'La Capilla', 15),
(457, 'La Ceja', 5),
(458, 'La Celia', 66),
(459, 'La Cruz', 52),
(460, 'La Cumbre', 76),
(461, 'La Dorada', 17),
(462, 'La Esperanza', 54),
(463, 'La Estrella', 5),
(464, 'La Florida', 52),
(465, 'La Gloria', 20),
(466, 'La Jagua de Ibirico', 20),
(467, 'La Jagua del Pilar', 44),
(468, 'La Llanada', 52),
(469, 'La Macarena', 50),
(470, 'La Merced', 17),
(471, 'La Mesa', 25),
(472, 'La Montañita', 18),
(473, 'La Palma', 25),
(474, 'La Paz', 68),
(475, 'La Paz (Robles)', 20),
(476, 'La Peña', 25),
(477, 'La Pintada', 5),
(478, 'La Plata', 41),
(479, 'La Playa', 54),
(480, 'La Primavera', 99),
(481, 'La Salina', 85),
(482, 'La Sierra', 19),
(483, 'La Tebaida', 63),
(484, 'La Tola', 52),
(485, 'La Unión', 5),
(486, 'La Unión', 52),
(487, 'La Unión', 70),
(488, 'La Unión', 76),
(489, 'La Uvita', 15),
(490, 'La Vega', 19),
(491, 'La Vega', 25),
(492, 'La Victoria', 15),
(493, 'La Victoria', 17),
(494, 'La Victoria', 76),
(495, 'La Virginia', 66),
(496, 'Labateca', 54),
(497, 'Labranzagrande', 15),
(498, 'Landázuri', 68),
(499, 'Lebrija', 68),
(500, 'Leiva', 52),
(501, 'Lejanías', 50),
(502, 'Lenguazaque', 25),
(503, 'Leticia', 91),
(504, 'Liborina', 5),
(505, 'Linares', 52),
(506, 'Lloró', 27),
(507, 'Lorica', 23),
(508, 'Los Córdobas', 23),
(509, 'Los Palmitos', 70),
(510, 'Los Patios', 54),
(511, 'Los Santos', 68),
(512, 'Lourdes', 54),
(513, 'Luruaco', 8),
(514, 'Lérida', 73),
(515, 'Líbano', 73),
(516, 'López (Micay)', 19),
(517, 'Macanal', 15),
(518, 'Macaravita', 68),
(519, 'Maceo', 5),
(520, 'Machetá', 25),
(521, 'Madrid', 25),
(522, 'Magangué', 13),
(523, 'Magüi (Payán)', 52),
(524, 'Mahates', 13),
(525, 'Maicao', 44),
(526, 'Majagual', 70),
(527, 'Malambo', 8),
(528, 'Mallama (Piedrancha)', 52),
(529, 'Manatí', 8),
(530, 'Manaure', 44),
(531, 'Manaure Balcón del Cesar', 20),
(532, 'Manizales', 17),
(533, 'Manta', 25),
(534, 'Manzanares', 17),
(535, 'Maní', 85),
(536, 'Mapiripan', 50),
(537, 'Margarita', 13),
(538, 'Marinilla', 5),
(539, 'Maripí', 15),
(540, 'Mariquita', 73),
(541, 'Marmato', 17),
(542, 'Marquetalia', 17),
(543, 'Marsella', 66),
(544, 'Marulanda', 17),
(545, 'María la Baja', 13),
(546, 'Matanza', 68),
(547, 'Medellín', 5),
(548, 'Medina', 25),
(549, 'Medio Atrato', 27),
(550, 'Medio Baudó', 27),
(551, 'Medio San Juan (ANDAGOYA)', 27),
(552, 'Melgar', 73),
(553, 'Mercaderes', 19),
(554, 'Mesetas', 50),
(555, 'Milán', 18),
(556, 'Miraflores', 15),
(557, 'Miraflores', 95),
(558, 'Miranda', 19),
(559, 'Mistrató', 66),
(560, 'Mitú', 97),
(561, 'Mocoa', 86),
(562, 'Mogotes', 68),
(563, 'Molagavita', 68),
(564, 'Momil', 23),
(565, 'Mompós', 13),
(566, 'Mongua', 15),
(567, 'Monguí', 15),
(568, 'Moniquirá', 15),
(569, 'Montebello', 5),
(570, 'Montecristo', 13),
(571, 'Montelíbano', 23),
(572, 'Montenegro', 63),
(573, 'Monteria', 23),
(574, 'Monterrey', 85),
(575, 'Morales', 13),
(576, 'Morales', 19),
(577, 'Morelia', 18),
(578, 'Morroa', 70),
(579, 'Mosquera', 25),
(580, 'Mosquera', 52),
(581, 'Motavita', 15),
(582, 'Moñitos', 23),
(583, 'Murillo', 73),
(584, 'Murindó', 5),
(585, 'Mutatá', 5),
(586, 'Mutiscua', 54),
(587, 'Muzo', 15),
(588, 'Málaga', 68),
(589, 'Nariño', 5),
(590, 'Nariño', 25),
(591, 'Nariño', 52),
(592, 'Natagaima', 73),
(593, 'Nechí', 5),
(594, 'Necoclí', 5),
(595, 'Neira', 17),
(596, 'Neiva', 41),
(597, 'Nemocón', 25),
(598, 'Nilo', 25),
(599, 'Nimaima', 25),
(600, 'Nobsa', 15),
(601, 'Nocaima', 25),
(602, 'Norcasia', 17),
(603, 'Norosí', 13),
(604, 'Novita', 27),
(605, 'Nueva Granada', 47),
(606, 'Nuevo Colón', 15),
(607, 'Nunchía', 85),
(608, 'Nuquí', 27),
(609, 'Nátaga', 41),
(610, 'Obando', 76),
(611, 'Ocamonte', 68),
(612, 'Ocaña', 54),
(613, 'Oiba', 68),
(614, 'Oicatá', 15),
(615, 'Olaya', 5),
(616, 'Olaya Herrera', 52),
(617, 'Onzaga', 68),
(618, 'Oporapa', 41),
(619, 'Orito', 86),
(620, 'Orocué', 85),
(621, 'Ortega', 73),
(622, 'Ospina', 52),
(623, 'Otanche', 15),
(624, 'Ovejas', 70),
(625, 'Pachavita', 15),
(626, 'Pacho', 25),
(627, 'Padilla', 19),
(628, 'Paicol', 41),
(629, 'Pailitas', 20),
(630, 'Paime', 25),
(631, 'Paipa', 15),
(632, 'Pajarito', 15),
(633, 'Palermo', 41),
(634, 'Palestina', 17),
(635, 'Palestina', 41),
(636, 'Palmar', 68),
(637, 'Palmar de Varela', 8),
(638, 'Palmas del Socorro', 68),
(639, 'Palmira', 76),
(640, 'Palmito', 70),
(641, 'Palocabildo', 73),
(642, 'Pamplona', 54),
(643, 'Pamplonita', 54),
(644, 'Pandi', 25),
(645, 'Panqueba', 15),
(646, 'Paratebueno', 25),
(647, 'Pasca', 25),
(648, 'Patía (El Bordo)', 19),
(649, 'Pauna', 15),
(650, 'Paya', 15),
(651, 'Paz de Ariporo', 85),
(652, 'Paz de Río', 15),
(653, 'Pedraza', 47),
(654, 'Pelaya', 20),
(655, 'Pensilvania', 17),
(656, 'Peque', 5),
(657, 'Pereira', 66),
(658, 'Pesca', 15),
(659, 'Peñol', 5),
(660, 'Piamonte', 19),
(661, 'Pie de Cuesta', 68),
(662, 'Piedras', 73),
(663, 'Piendamó', 19),
(664, 'Pijao', 63),
(665, 'Pijiño', 47),
(666, 'Pinchote', 68),
(667, 'Pinillos', 13),
(668, 'Piojo', 8),
(669, 'Pisva', 15),
(670, 'Pital', 41),
(671, 'Pitalito', 41),
(672, 'Pivijay', 47),
(673, 'Planadas', 73),
(674, 'Planeta Rica', 23),
(675, 'Plato', 47),
(676, 'Policarpa', 52),
(677, 'Polonuevo', 8),
(678, 'Ponedera', 8),
(679, 'Popayán', 19),
(680, 'Pore', 85),
(681, 'Potosí', 52),
(682, 'Pradera', 76),
(683, 'Prado', 73),
(684, 'Providencia', 52),
(685, 'Providencia', 88),
(686, 'Pueblo Bello', 20),
(687, 'Pueblo Nuevo', 23),
(688, 'Pueblo Rico', 66),
(689, 'Pueblorrico', 5),
(690, 'Puebloviejo', 47),
(691, 'Puente Nacional', 68),
(692, 'Puerres', 52),
(693, 'Puerto Asís', 86),
(694, 'Puerto Berrío', 5),
(695, 'Puerto Boyacá', 15),
(696, 'Puerto Caicedo', 86),
(697, 'Puerto Carreño', 99),
(698, 'Puerto Colombia', 8),
(699, 'Puerto Concordia', 50),
(700, 'Puerto Escondido', 23),
(701, 'Puerto Gaitán', 50),
(702, 'Puerto Guzmán', 86),
(703, 'Puerto Leguízamo', 86),
(704, 'Puerto Libertador', 23),
(705, 'Puerto Lleras', 50),
(706, 'Puerto López', 50),
(707, 'Puerto Nare', 5),
(708, 'Puerto Nariño', 91),
(709, 'Puerto Parra', 68),
(710, 'Puerto Rico', 18),
(711, 'Puerto Rico', 50),
(712, 'Puerto Rondón', 81),
(713, 'Puerto Salgar', 25),
(714, 'Puerto Santander', 54),
(715, 'Puerto Tejada', 19),
(716, 'Puerto Triunfo', 5),
(717, 'Puerto Wilches', 68),
(718, 'Pulí', 25),
(719, 'Pupiales', 52),
(720, 'Puracé (Coconuco)', 19),
(721, 'Purificación', 73),
(722, 'Purísima', 23),
(723, 'Pácora', 17),
(724, 'Páez', 15),
(725, 'Páez (Belalcazar)', 19),
(726, 'Páramo', 68),
(727, 'Quebradanegra', 25),
(728, 'Quetame', 25),
(729, 'Quibdó', 27),
(730, 'Quimbaya', 63),
(731, 'Quinchía', 66),
(732, 'Quipama', 15),
(733, 'Quipile', 25),
(734, 'Ragonvalia', 54),
(735, 'Ramiriquí', 15),
(736, 'Recetor', 85),
(737, 'Regidor', 13),
(738, 'Remedios', 5),
(739, 'Remolino', 47),
(740, 'Repelón', 8),
(741, 'Restrepo', 50),
(742, 'Restrepo', 76),
(743, 'Retiro', 5),
(744, 'Ricaurte', 25),
(745, 'Ricaurte', 52),
(746, 'Rio Negro', 68),
(747, 'Rioblanco', 73),
(748, 'Riofrío', 76),
(749, 'Riohacha', 44),
(750, 'Risaralda', 17),
(751, 'Rivera', 41),
(752, 'Roberto Payán (San José)', 52),
(753, 'Roldanillo', 76),
(754, 'Roncesvalles', 73),
(755, 'Rondón', 15),
(756, 'Rosas', 19),
(757, 'Rovira', 73),
(758, 'Ráquira', 15),
(759, 'Río Iró', 27),
(760, 'Río Quito', 27),
(761, 'Río Sucio', 17),
(762, 'Río Viejo', 13),
(763, 'Río de oro', 20),
(764, 'Ríonegro', 5),
(765, 'Ríosucio', 27),
(766, 'Sabana de Torres', 68),
(767, 'Sabanagrande', 8),
(768, 'Sabanalarga', 5),
(769, 'Sabanalarga', 8),
(770, 'Sabanalarga', 85),
(771, 'Sabanas de San Angel (SAN ANGEL)', 47),
(772, 'Sabaneta', 5),
(773, 'Saboyá', 15),
(774, 'Sahagún', 23),
(775, 'Saladoblanco', 41),
(776, 'Salamina', 17),
(777, 'Salamina', 47),
(778, 'Salazar', 54),
(779, 'Saldaña', 73),
(780, 'Salento', 63),
(781, 'Salgar', 5),
(782, 'Samacá', 15),
(783, 'Samaniego', 52),
(784, 'Samaná', 17),
(785, 'Sampués', 70),
(786, 'San Agustín', 41),
(787, 'San Alberto', 20),
(788, 'San Andrés', 68),
(789, 'San Andrés Sotavento', 23),
(790, 'San Andrés de Cuerquía', 5),
(791, 'San Antero', 23),
(792, 'San Antonio', 73),
(793, 'San Antonio de Tequendama', 25),
(794, 'San Benito', 68),
(795, 'San Benito Abad', 70),
(796, 'San Bernardo', 25),
(797, 'San Bernardo', 52),
(798, 'San Bernardo del Viento', 23),
(799, 'San Calixto', 54),
(800, 'San Carlos', 5),
(801, 'San Carlos', 23),
(802, 'San Carlos de Guaroa', 50),
(803, 'San Cayetano', 25),
(804, 'San Cayetano', 54),
(805, 'San Cristobal', 13),
(806, 'San Diego', 20),
(807, 'San Eduardo', 15),
(808, 'San Estanislao', 13),
(809, 'San Fernando', 13),
(810, 'San Francisco', 5),
(811, 'San Francisco', 25),
(812, 'San Francisco', 86),
(813, 'San Gíl', 68),
(814, 'San Jacinto', 13),
(815, 'San Jacinto del Cauca', 13),
(816, 'San Jerónimo', 5),
(817, 'San Joaquín', 68),
(818, 'San José', 17),
(819, 'San José de Miranda', 68),
(820, 'San José de Montaña', 5),
(821, 'San José de Pare', 15),
(822, 'San José de Uré', 23),
(823, 'San José del Fragua', 18),
(824, 'San José del Guaviare', 95),
(825, 'San José del Palmar', 27),
(826, 'San Juan de Arama', 50),
(827, 'San Juan de Betulia', 70),
(828, 'San Juan de Nepomuceno', 13),
(829, 'San Juan de Pasto', 52),
(830, 'San Juan de Río Seco', 25),
(831, 'San Juan de Urabá', 5),
(832, 'San Juan del Cesar', 44),
(833, 'San Juanito', 50),
(834, 'San Lorenzo', 52),
(835, 'San Luis', 73),
(836, 'San Luís', 5),
(837, 'San Luís de Gaceno', 15),
(838, 'San Luís de Palenque', 85),
(839, 'San Marcos', 70),
(840, 'San Martín', 20),
(841, 'San Martín', 50),
(842, 'San Martín de Loba', 13),
(843, 'San Mateo', 15),
(844, 'San Miguel', 68),
(845, 'San Miguel', 86),
(846, 'San Miguel de Sema', 15),
(847, 'San Onofre', 70),
(848, 'San Pablo', 13),
(849, 'San Pablo', 52),
(850, 'San Pablo de Borbur', 15),
(851, 'San Pedro', 5),
(852, 'San Pedro', 70),
(853, 'San Pedro', 76),
(854, 'San Pedro de Cartago', 52),
(855, 'San Pedro de Urabá', 5),
(856, 'San Pelayo', 23),
(857, 'San Rafael', 5),
(858, 'San Roque', 5),
(859, 'San Sebastián', 19),
(860, 'San Sebastián de Buenavista', 47),
(861, 'San Vicente', 5),
(862, 'San Vicente del Caguán', 18),
(863, 'San Vicente del Chucurí', 68),
(864, 'San Zenón', 47),
(865, 'Sandoná', 52),
(866, 'Santa Ana', 47),
(867, 'Santa Bárbara', 5),
(868, 'Santa Bárbara', 68),
(869, 'Santa Bárbara (Iscuandé)', 52),
(870, 'Santa Bárbara de Pinto', 47),
(871, 'Santa Catalina', 13),
(872, 'Santa Fé de Antioquia', 5),
(873, 'Santa Genoveva de Docorodó', 27),
(874, 'Santa Helena del Opón', 68),
(875, 'Santa Isabel', 73),
(876, 'Santa Lucía', 8),
(877, 'Santa Marta', 47),
(878, 'Santa María', 15),
(879, 'Santa María', 41),
(880, 'Santa Rosa', 13),
(881, 'Santa Rosa', 19),
(882, 'Santa Rosa de Cabal', 66),
(883, 'Santa Rosa de Osos', 5),
(884, 'Santa Rosa de Viterbo', 15),
(885, 'Santa Rosa del Sur', 13),
(886, 'Santa Rosalía', 99),
(887, 'Santa Sofía', 15),
(888, 'Santana', 15),
(889, 'Santander de Quilichao', 19),
(890, 'Santiago', 54),
(891, 'Santiago', 86),
(892, 'Santo Domingo', 5),
(893, 'Santo Tomás', 8),
(894, 'Santuario', 5),
(895, 'Santuario', 66),
(896, 'Sapuyes', 52),
(897, 'Saravena', 81),
(898, 'Sardinata', 54),
(899, 'Sasaima', 25),
(900, 'Sativanorte', 15),
(901, 'Sativasur', 15),
(902, 'Segovia', 5),
(903, 'Sesquilé', 25),
(904, 'Sevilla', 76),
(905, 'Siachoque', 15),
(906, 'Sibaté', 25),
(907, 'Sibundoy', 86),
(908, 'Silos', 54),
(909, 'Silvania', 25),
(910, 'Silvia', 19),
(911, 'Simacota', 68),
(912, 'Simijaca', 25),
(913, 'Simití', 13),
(914, 'Sincelejo', 70),
(915, 'Sincé', 70),
(916, 'Sipí', 27),
(917, 'Sitionuevo', 47),
(918, 'Soacha', 25),
(919, 'Soatá', 15),
(920, 'Socha', 15),
(921, 'Socorro', 68),
(922, 'Socotá', 15),
(923, 'Sogamoso', 15),
(924, 'Solano', 18),
(925, 'Soledad', 8),
(926, 'Solita', 18),
(927, 'Somondoco', 15),
(928, 'Sonsón', 5),
(929, 'Sopetrán', 5),
(930, 'Soplaviento', 13),
(931, 'Sopó', 25),
(932, 'Sora', 15),
(933, 'Soracá', 15),
(934, 'Sotaquirá', 15),
(935, 'Sotara (Paispamba)', 19),
(936, 'Sotomayor (Los Andes)', 52),
(937, 'Suaita', 68),
(938, 'Suan', 8),
(939, 'Suaza', 41),
(940, 'Subachoque', 25),
(941, 'Sucre', 19),
(942, 'Sucre', 68),
(943, 'Sucre', 70),
(944, 'Suesca', 25),
(945, 'Supatá', 25),
(946, 'Supía', 17),
(947, 'Suratá', 68),
(948, 'Susa', 25),
(949, 'Susacón', 15),
(950, 'Sutamarchán', 15),
(951, 'Sutatausa', 25),
(952, 'Sutatenza', 15),
(953, 'Suárez', 19),
(954, 'Suárez', 73),
(955, 'Sácama', 85),
(956, 'Sáchica', 15),
(957, 'Tabio', 25),
(958, 'Tadó', 27),
(959, 'Talaigua Nuevo', 13),
(960, 'Tamalameque', 20),
(961, 'Tame', 81),
(962, 'Taminango', 52),
(963, 'Tangua', 52),
(964, 'Taraira', 97),
(965, 'Tarazá', 5),
(966, 'Tarqui', 41),
(967, 'Tarso', 5),
(968, 'Tasco', 15),
(969, 'Tauramena', 85),
(970, 'Tausa', 25),
(971, 'Tello', 41),
(972, 'Tena', 25),
(973, 'Tenerife', 47),
(974, 'Tenjo', 25),
(975, 'Tenza', 15),
(976, 'Teorama', 54),
(977, 'Teruel', 41),
(978, 'Tesalia', 41),
(979, 'Tibacuy', 25),
(980, 'Tibaná', 15),
(981, 'Tibasosa', 15),
(982, 'Tibirita', 25),
(983, 'Tibú', 54),
(984, 'Tierralta', 23),
(985, 'Timaná', 41),
(986, 'Timbiquí', 19),
(987, 'Timbío', 19),
(988, 'Tinjacá', 15),
(989, 'Tipacoque', 15),
(990, 'Tiquisio (Puerto Rico)', 13),
(991, 'Titiribí', 5),
(992, 'Toca', 15),
(993, 'Tocaima', 25),
(994, 'Tocancipá', 25),
(995, 'Toguí', 15),
(996, 'Toledo', 5),
(997, 'Toledo', 54),
(998, 'Tolú', 70),
(999, 'Tolú Viejo', 70),
(1000, 'Tona', 68),
(1001, 'Topagá', 15),
(1002, 'Topaipí', 25),
(1003, 'Toribío', 19),
(1004, 'Toro', 76),
(1005, 'Tota', 15),
(1006, 'Totoró', 19),
(1007, 'Trinidad', 85),
(1008, 'Trujillo', 76),
(1009, 'Tubará', 8),
(1010, 'Tuchín', 23),
(1011, 'Tulúa', 76),
(1012, 'Tumaco', 52),
(1013, 'Tunja', 15),
(1014, 'Tunungua', 15),
(1015, 'Turbaco', 13),
(1016, 'Turbaná', 13),
(1017, 'Turbo', 5),
(1018, 'Turmequé', 15),
(1019, 'Tuta', 15),
(1020, 'Tutasá', 15),
(1021, 'Támara', 85),
(1022, 'Támesis', 5),
(1023, 'Túquerres', 52),
(1024, 'Ubalá', 25),
(1025, 'Ubaque', 25),
(1026, 'Ubaté', 25),
(1027, 'Ulloa', 76),
(1028, 'Une', 25),
(1029, 'Unguía', 27),
(1030, 'Unión Panamericana (ÁNIMAS)', 27),
(1031, 'Uramita', 5),
(1032, 'Uribe', 50),
(1033, 'Uribia', 44),
(1034, 'Urrao', 5),
(1035, 'Urumita', 44),
(1036, 'Usiacuri', 8),
(1037, 'Valdivia', 5),
(1038, 'Valencia', 23),
(1039, 'Valle de San José', 68),
(1040, 'Valle de San Juan', 73),
(1041, 'Valle del Guamuez', 86),
(1042, 'Valledupar', 20),
(1043, 'Valparaiso', 5),
(1044, 'Valparaiso', 18),
(1045, 'Vegachí', 5),
(1046, 'Venadillo', 73),
(1047, 'Venecia', 5),
(1048, 'Venecia (Ospina Pérez)', 25),
(1049, 'Ventaquemada', 15),
(1050, 'Vergara', 25),
(1051, 'Versalles', 76),
(1052, 'Vetas', 68),
(1053, 'Viani', 25),
(1054, 'Vigía del Fuerte', 5),
(1055, 'Vijes', 76),
(1056, 'Villa Caro', 54),
(1057, 'Villa Rica', 19),
(1058, 'Villa de Leiva', 15),
(1059, 'Villa del Rosario', 54),
(1060, 'Villagarzón', 86),
(1061, 'Villagómez', 25),
(1062, 'Villahermosa', 73),
(1063, 'Villamaría', 17),
(1064, 'Villanueva', 13),
(1065, 'Villanueva', 44),
(1066, 'Villanueva', 68),
(1067, 'Villanueva', 85),
(1068, 'Villapinzón', 25),
(1069, 'Villarrica', 73),
(1070, 'Villavicencio', 50),
(1071, 'Villavieja', 41),
(1072, 'Villeta', 25),
(1073, 'Viotá', 25),
(1074, 'Viracachá', 15),
(1075, 'Vista Hermosa', 50),
(1076, 'Viterbo', 17),
(1077, 'Vélez', 68),
(1078, 'Yacopí', 25),
(1079, 'Yacuanquer', 52),
(1080, 'Yaguará', 41),
(1081, 'Yalí', 5),
(1082, 'Yarumal', 5),
(1083, 'Yolombó', 5),
(1084, 'Yondó (Casabe)', 5),
(1085, 'Yopal', 85),
(1086, 'Yotoco', 76),
(1087, 'Yumbo', 76),
(1088, 'Zambrano', 13),
(1089, 'Zapatoca', 68),
(1090, 'Zapayán (PUNTA DE PIEDRAS)', 47),
(1091, 'Zaragoza', 5),
(1092, 'Zarzal', 76),
(1093, 'Zetaquirá', 15),
(1094, 'Zipacón', 25),
(1095, 'Zipaquirá', 25),
(1096, 'Zona Bananera (PRADO - SEVILLA)', 47),
(1097, 'Ábrego', 54),
(1098, 'Íquira', 41),
(1099, 'Úmbita', 15),
(1100, 'Útica', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` text COLLATE utf8_spanish_ci NOT NULL,
  `fk_users` int(11) DEFAULT NULL,
  `fk_supplier` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `public` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notes`
--

INSERT INTO `notes` (`id`, `note`, `fk_users`, `fk_supplier`, `date`, `public`) VALUES
(1, 'Hola', NULL, NULL, '2021-09-06 09:56:35', 0),
(2, 'Hola with user', 2, NULL, '2021-09-07 08:59:38', 0),
(3, 'hola with user and company sdfsdfsdf', 2, 1, '2021-09-07 09:17:59', 0),
(5, 'constructor 2', 2, 2, '2021-09-07 09:40:25', 0),
(6, 'constructor 2.2.2', 2, 2, '2021-09-07 09:40:37', 0),
(7, 'alumina 2', 2, 3, '2021-09-07 09:40:52', 0),
(8, 'nota pepito homecenter', 8, 1, '2021-09-07 09:55:02', 0),
(10, 'note with public check', 2, 2, '2021-09-07 16:38:19', 1),
(11, 'asedfakrbetg349ty3498hfwoiefrihwthrehwegrgtrhytjruytyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeehhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 2, 2, '2021-09-08 09:41:04', 0),
(13, 'nueva publica alumina', 2, 3, '2021-09-08 12:27:11', 1),
(81, 'holaaaa 22', 2, 1, '2021-09-13 16:12:40', 1),
(82, 'nota de santiago publica', 10, 1, '2021-09-14 08:41:41', 1),
(83, 'nota de santiago no publica', 10, 1, '2021-09-14 08:41:56', 0),
(84, 'hola', 2, 1, '2021-09-14 15:33:34', 1),
(85, 'nota privada', 2, 1, '2021-09-15 09:13:01', 0),
(86, 'Nota', 10, 1, '2021-11-23 11:26:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payroll_taxes`
--

CREATE TABLE `payroll_taxes` (
  `id` int(11) NOT NULL,
  `concept` int(11) DEFAULT NULL,
  `fk_chart_account` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `payroll_taxes`
--

INSERT INTO `payroll_taxes` (`id`, `concept`, `fk_chart_account`) VALUES
(1, 2, NULL),
(14, 1, 13),
(29, 1, 13),
(15, 2, 13),
(30, 1, 14),
(50, 1, 16),
(51, 2, 16),
(46, 2, 20),
(47, 2, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portfolio_supplier`
--

CREATE TABLE `portfolio_supplier` (
  `id` int(11) NOT NULL,
  `fk_third` int(11) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `reference` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `seller` int(11) DEFAULT NULL,
  `fk_acc_note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_lines`
--

CREATE TABLE `products_lines` (
  `id` int(11) NOT NULL,
  `line` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products_lines`
--

INSERT INTO `products_lines` (`id`, `line`, `fk_third`) VALUES
(3, 'hola chao', 11),
(26, '23', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchased_products`
--

CREATE TABLE `purchased_products` (
  `id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `product` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `doc_number` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `price` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `movement_type` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `purchased_products`
--

INSERT INTO `purchased_products` (`id`, `code`, `product`, `unit`, `date`, `doc_number`, `price`, `movement_type`, `fk_third`) VALUES
(56, 'cod1', '1', '12', NULL, '', '', '', 12),
(57, '1243', '', '', NULL, '', '', '', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retentions`
--

CREATE TABLE `retentions` (
  `id` int(11) NOT NULL,
  `fk_parent_retention` int(11) DEFAULT NULL,
  `code` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `validity_start` date NOT NULL,
  `calculation_type` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `value` float DEFAULT NULL,
  `min_base_value` float DEFAULT NULL,
  `auto_calculation` tinyint(1) NOT NULL DEFAULT 0,
  `movement_type` tinyint(4) NOT NULL,
  `bill_to_pay` int(11) DEFAULT NULL,
  `how_affects` tinyint(4) NOT NULL,
  `payment_date_table` tinyint(4) NOT NULL,
  `third_party_alias` tinyint(4) NOT NULL,
  `expense_account` int(11) DEFAULT NULL,
  `cost_center` int(11) DEFAULT NULL,
  `obsolete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `retentions`
--

INSERT INTO `retentions` (`id`, `fk_parent_retention`, `code`, `name`, `validity_start`, `calculation_type`, `value`, `min_base_value`, `auto_calculation`, `movement_type`, `bill_to_pay`, `how_affects`, `payment_date_table`, `third_party_alias`, `expense_account`, `cost_center`, `obsolete`) VALUES
(1, 1, 'DPPE', 'Descuento por pronto pago', '2021-09-01', '1', 23, 10000, 0, 2, 3, 3, 2, 4, NULL, NULL, NULL),
(2, 2, 'IVA5RRC', 'ReteIVA a RC', '2021-09-15', '3', 34654400, 803000, 0, 2, 5, 2, 3, 5, NULL, NULL, NULL),
(3, 1, 'RAN', 'Retenciones y aportes de nómina', '2020-06-01', '1', NULL, 700000, 0, 1, 19, 1, 1, 1, NULL, NULL, NULL),
(4, 1, 'DPPE1', 'Descuento', '2021-01-01', '1', 14, 9800000, 0, 1, 5, 1, 2, 5, NULL, NULL, NULL),
(6, 3, 'RAN1', 'nomina1', '2021-01-01', '3', 32454, 325435, 1, 2, 5, 1, 6, 5, 5, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `reference` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clasification` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `total_price` float NOT NULL,
  `data_sheet` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL,
  `fk_type` int(11) DEFAULT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `fk_tax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `business_name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `supplier_type` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id`, `business_name`, `nit`, `phone`, `address`, `supplier_type`) VALUES
(1, 'hyco', '12378127', '1243123423', 'Calle 16 #30-40', 'Materiales'),
(2, 'homecenter', '900360646', '4414659', 'cra 78 #  25-56', 'Servicios'),
(3, 'constructor', '982123456', '4414659', 'cra 78 #  25-56', 'Alquiler'),
(4, 'Alumina', '21647234732', '2456789', 'Cra 89 #45-34', 'Materiales'),
(5, 'Ferrelectricos', '2343554', '12345345646', 'Cra 89 #45-34', 'Materiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `tax` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `value` float NOT NULL,
  `year` varchar(4) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `taxes`
--

INSERT INTO `taxes` (`id`, `tax`, `type`, `value`, `year`) VALUES
(1, 'Iva', 'IVA', 19, '2021'),
(2, 'ReteICA', 'ReteICA', 2, '2021'),
(5, 'Other', 'ReteICA', 23, '2019'),
(9, 'Other22', 'IVA', 30, '2010');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxes_configuration`
--

CREATE TABLE `taxes_configuration` (
  `id` int(11) NOT NULL,
  `iva` int(11) DEFAULT NULL,
  `retention` int(11) DEFAULT NULL,
  `rete_ica` int(11) DEFAULT NULL,
  `tax_cree` int(11) DEFAULT NULL,
  `auto_retention` int(11) DEFAULT NULL,
  `other` int(11) DEFAULT NULL,
  `other_2` int(11) DEFAULT NULL,
  `fk_chart_account` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `taxes_configuration`
--

INSERT INTO `taxes_configuration` (`id`, `iva`, `retention`, `rete_ica`, `tax_cree`, `auto_retention`, `other`, `other_2`, `fk_chart_account`) VALUES
(1, 2, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, NULL, 1, NULL, NULL, 2, NULL, NULL, NULL),
(9, 2, NULL, NULL, 2, NULL, NULL, NULL, 18),
(10, 2, NULL, NULL, NULL, NULL, NULL, 1, 21),
(11, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3),
(12, 2, NULL, 3, NULL, NULL, NULL, NULL, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxes_liquidation`
--

CREATE TABLE `taxes_liquidation` (
  `id` int(11) NOT NULL,
  `concept` int(11) DEFAULT NULL,
  `base_value` float NOT NULL,
  `observation` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `price` float NOT NULL,
  `account_to_affect` int(11) DEFAULT NULL,
  `third_party` int(11) DEFAULT NULL,
  `cc_active` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `fk_invoice` int(11) DEFAULT NULL,
  `fk_bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `taxes_liquidation`
--

INSERT INTO `taxes_liquidation` (`id`, `concept`, `base_value`, `observation`, `price`, `account_to_affect`, `third_party`, `cc_active`, `payment_date`, `fk_invoice`, `fk_bill`) VALUES
(1, 2, 0, 'Observacion 1', 230400, NULL, NULL, '1', '2021-10-02', NULL, NULL),
(2, 1, 105000000, 'Obs', 24150000, 3, 3, '', '2021-10-05', NULL, NULL),
(3, 4, 105000000, 'Observ', 14700000, 5, 3, '1', NULL, NULL, NULL),
(4, 1, 100000000, '', 23000000, 3, 3, '', NULL, 16, NULL),
(5, 1, 11000000, 'Observa', 2530000, 3, 3, '', '2021-10-06', 17, NULL),
(6, 4, 11000000, '', 1540000, 5, 3, '32', NULL, 17, NULL),
(16, 1, 15000000, 'Observacion1', 3450000, 3, 3, '', '2021-11-03', 19, NULL),
(17, 1, 15000000, 'observamod', 3450000, 3, 3, '', '2021-11-23', 19, NULL),
(18, 1, 15000000, 'obsermaod', 3450000, 3, 3, '', '2021-11-30', 19, NULL),
(19, 1, 400000, 'Observacion 1', 92000, 3, 3, '', '2021-11-17', 20, NULL),
(20, 4, 300000, 'Observacion 3', 42000, 5, 3, 'CC1', NULL, 20, NULL),
(23, 1, 71000000, 'Obseervacion1', 16330000, 3, 3, '', '2021-11-30', NULL, 2),
(24, 4, 71000000, 'Observacion 2', 9940000, 5, 3, '3', NULL, NULL, 2),
(25, 4, 71000000, 'Observacion 4', 9940000, 5, 3, '4', NULL, NULL, 2),
(46, 1, 1000, 'ob', 230, 3, 3, '', '2021-11-24', NULL, 5),
(51, 1, 1000, 'Observacion', 230, 3, 3, '', '2021-11-30', NULL, 6),
(52, 4, 4000, '', 560, 5, 3, '', NULL, 21, NULL),
(56, 1, 10000, '', 2300, 3, 3, '', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax_classification`
--

CREATE TABLE `tax_classification` (
  `id` int(11) NOT NULL,
  `fk_economic_activity` int(11) DEFAULT NULL,
  `tax_profile` tinyint(4) DEFAULT NULL,
  `pn` tinyint(1) NOT NULL DEFAULT 0,
  `pj` tinyint(1) NOT NULL DEFAULT 0,
  `pe` tinyint(1) NOT NULL DEFAULT 0,
  `to1` tinyint(1) NOT NULL DEFAULT 0,
  `ts` tinyint(1) NOT NULL DEFAULT 0,
  `rs` tinyint(1) NOT NULL DEFAULT 0,
  `rc` tinyint(1) NOT NULL DEFAULT 0,
  `gc` tinyint(1) NOT NULL DEFAULT 0,
  `av` tinyint(1) NOT NULL DEFAULT 0,
  `ar` tinyint(1) NOT NULL DEFAULT 0,
  `ag` tinyint(1) NOT NULL DEFAULT 0,
  `nc` tinyint(1) NOT NULL DEFAULT 0,
  `c1` tinyint(1) NOT NULL DEFAULT 0,
  `c2` tinyint(1) NOT NULL DEFAULT 0,
  `c3` tinyint(1) NOT NULL DEFAULT 0,
  `ri` tinyint(1) NOT NULL DEFAULT 0,
  `ee` tinyint(1) NOT NULL DEFAULT 0,
  `ie` tinyint(1) NOT NULL DEFAULT 0,
  `ed` tinyint(1) NOT NULL DEFAULT 0,
  `ni` tinyint(1) NOT NULL DEFAULT 0,
  `tax_administration` tinyint(4) DEFAULT NULL,
  `economic_clasification` tinyint(4) DEFAULT NULL,
  `declarant_class` tinyint(4) DEFAULT NULL,
  `iva` tinyint(1) DEFAULT 0,
  `ic` tinyint(1) DEFAULT 0,
  `iva_inc` tinyint(1) DEFAULT 0,
  `does_not_apply` tinyint(1) DEFAULT 0,
  `fk_company` int(11) DEFAULT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tax_classification`
--

INSERT INTO `tax_classification` (`id`, `fk_economic_activity`, `tax_profile`, `pn`, `pj`, `pe`, `to1`, `ts`, `rs`, `rc`, `gc`, `av`, `ar`, `ag`, `nc`, `c1`, `c2`, `c3`, `ri`, `ee`, `ie`, `ed`, `ni`, `tax_administration`, `economic_clasification`, `declarant_class`, `iva`, `ic`, `iva_inc`, `does_not_apply`, `fk_company`, `fk_third`) VALUES
(1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, 9, NULL),
(2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, 10, NULL),
(4, 1, 2, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 12, 21, 23, 0, 1, 0, 0, 12, NULL),
(5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, 5, NULL),
(6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 6),
(7, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 7),
(8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 8),
(9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 9),
(11, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 11),
(12, 1, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `third_attached_files`
--

CREATE TABLE `third_attached_files` (
  `id` int(11) NOT NULL,
  `file` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `third_attached_files`
--

INSERT INTO `third_attached_files` (`id`, `file`, `fk_third`) VALUES
(1, '10-Essay.pdf', 9),
(2, '2353-Essay_Lorena.pdf', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `third_parties`
--

CREATE TABLE `third_parties` (
  `id` int(11) NOT NULL,
  `code` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dv` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `doc_type` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tradename` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL,
  `juridical` tinyint(1) NOT NULL,
  `branch_office` tinyint(1) NOT NULL,
  `photo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `supplier` tinyint(1) NOT NULL,
  `client` tinyint(1) NOT NULL,
  `employee` tinyint(1) NOT NULL,
  `seller` tinyint(1) NOT NULL,
  `interested` tinyint(1) NOT NULL,
  `associate` tinyint(1) NOT NULL,
  `treatment` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profession` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `appointment` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genre` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `quick_code` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `processing_personal_data` tinyint(1) NOT NULL,
  `transactional_info` tinyint(1) NOT NULL,
  `promotional_info` tinyint(1) NOT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `standard_supplier` tinyint(1) NOT NULL,
  `payroll_entity_supplier` tinyint(1) NOT NULL,
  `block_payments` tinyint(1) NOT NULL,
  `payment_deadline` tinyint(4) DEFAULT NULL,
  `account_holder` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `account_number` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `account_bank` tinyint(4) DEFAULT NULL,
  `account_type` tinyint(4) DEFAULT NULL,
  `account_payment_method` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alternate_code` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `class` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `additional_notes` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_third` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `third_parties`
--

INSERT INTO `third_parties` (`id`, `code`, `dv`, `doc_type`, `name`, `tradename`, `visible`, `juridical`, `branch_office`, `photo`, `supplier`, `client`, `employee`, `seller`, `interested`, `associate`, `treatment`, `profession`, `company`, `appointment`, `genre`, `birthday`, `quick_code`, `processing_personal_data`, `transactional_info`, `promotional_info`, `fk_municipality`, `address`, `standard_supplier`, `payroll_entity_supplier`, `block_payments`, `payment_deadline`, `account_holder`, `account_number`, `account_bank`, `account_type`, `account_payment_method`, `alternate_code`, `class`, `additional_notes`, `fk_third`) VALUES
(3, '3', '3', 3, '123', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(4, '4', '4', 4, '1234', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(5, '5', '5', 1, '5', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(6, '7', '7', 1, '7', '', 0, 0, 0, '7.png', 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(7, '8', '8', 1, '8', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(8, '9', '9', 1, '9', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(9, '10', '10', 1, '1', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(11, '2353', '34', 1, 'dsgfd', '', 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', NULL, NULL, '', 0, 0, 0, NULL, '', 0, 0, 0, NULL, '', '', NULL, NULL, '', '', '', '', NULL),
(12, '243', '234', 1, '234', 'com', 0, 1, 0, '243.png', 0, 0, 1, 0, 0, 0, '', 'profe', '', '', NULL, '2021-12-21', '', 0, 0, 0, 1, '', 0, 1, 1, NULL, 'yo', '', NULL, NULL, '', 'alt', '', 'nota', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_service`
--

CREATE TABLE `type_service` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `conf_service` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `document` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fk_municipality` int(6) UNSIGNED DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `occupation` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `document`, `birthday`, `phone`, `address`, `fk_municipality`, `gender`, `occupation`, `user_type`, `email`, `password`, `photo`, `last_date`) VALUES
(2, 'Camilo Botero', '1152451727', '1994-09-27', '3216317798', 'Circular 2 #68-61', 1, 'Masculino', 'Desarrollador', 'Administrador', 'cbotero2709@gmail.com', '$2y$10$Lcvv05FzwXg5Bd0a.Zwqbu5xeis1tPiQOJ3NqFGe5.jtto3brq.uq', 'camilo.jpg', '2021-08-22'),
(7, 'Camilo Botero', '1152451727', '2021-08-01', '3216317798', 'Circular 2 #68-61', 547, 'Masculino', 'Desarrollador', 'Administrador', 'camilo12@gmail.com', '$2y$10$kvzRha5AZNTDL2PAjenOvOfuu7WWwyCmh4xhESa7XiaWP1Lcgu.m6', 'camilo_gmail_com.jpeg', '2021-12-29'),
(8, 'Pepito Perez', '94092709560', '2021-08-03', '3214547451', 'Cra 76 #34-51', 1087, 'Masculino', 'Vigilante', '3', 'pepito@hotmail.com', '$2y$10$rH6EnnVBP7R1I.cOIF5Q7u04YWz/f249SYhhvKuDoPnZ8E8Ca6IQW', 'pepito_hotmail_com.jpg', '2021-08-27'),
(10, 'Santiago', '38560754', '1500-07-31', '30089532123', 'Cra 76 #34-51', 503, 'Masculino', 'Vigilante', '4', 'santiago@gmail.com', '$2y$10$EiRie51KgiwHXU5.C6VDY.SOgFINhA/IxVm/e5lZm1hJT4jFCrx.W', 'santiago_gmail_com.jpeg', '2021-08-27'),
(16, 'Vanesa', '1283789237', '2021-08-15', '', '', NULL, '', '', '', '', '$2y$10$KQtZFA5Xe/y.SEdPdkfKYuPaNXZVVYsCt1b7slkzVc44.po8acuwy', NULL, '2021-08-31'),
(23, 'Vanesa', '1283789237', '2021-08-01', '30089532123', 'Cra 80 #45-78', 3, 'Femenino', 'Aseo', 'Oficina', 'vanesa@altsys.com', '$2y$10$QwpPJtBmgSYh/QVhWmQhPOXhcjgsJ5e7QY4GunB/emHmFkLCbXOCy', NULL, '2021-08-31'),
(46, 'Camilo', '1283789237', '2021-08-23', '3145678909', 'Cra 80 #45-78', 72, 'Masculino', 'Desarrollador', 'Administrador', 'camilo1@gmail.com', '$2y$10$IYR9gFJ0g1LzeN5cAv.x9ujgKK3B6wzL1FD0iGPZ7gZOgAn8AAOzq', 'camilo1_gmail_com.jpeg', '2021-08-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounting_notes`
--
ALTER TABLE `accounting_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_type` (`fk_doc_type`,`fk_municipality`,`fk_cost_center`);

--
-- Indices de la tabla `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bills_attached_files`
--
ALTER TABLE `bills_attached_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_of_sale` (`fk_bill_of_sale`);

--
-- Indices de la tabla `bill_of_sale`
--
ALTER TABLE `bill_of_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_type` (`fk_doc_type`,`fk_municipality`,`client`,`seller`,`account_cash`),
  ADD KEY `fk_municipality` (`fk_municipality`),
  ADD KEY `client` (`client`),
  ADD KEY `seller` (`seller`),
  ADD KEY `account_cash` (`account_cash`),
  ADD KEY `cost_center` (`cost_center`);

--
-- Indices de la tabla `bill_to_pay`
--
ALTER TABLE `bill_to_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `third_party` (`third_party`,`account`,`fk_inovice`),
  ADD KEY `account` (`account`),
  ADD KEY `fk_inovice` (`fk_inovice`),
  ADD KEY `fk_bill` (`fk_bill`);

--
-- Indices de la tabla `cash_bank`
--
ALTER TABLE `cash_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account` (`bank_account`,`fk_invoice`),
  ADD KEY `fk_invoice` (`fk_invoice`),
  ADD KEY `fk_bill` (`fk_bill`);

--
-- Indices de la tabla `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_headquarter` (`fk_headquarter`);

--
-- Indices de la tabla `chart_accounts`
--
ALTER TABLE `chart_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `fk_account_type` (`fk_account_type`),
  ADD KEY `fk_account` (`fk_account`),
  ADD KEY `fk_tax` (`fk_tax`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_municipality` (`fk_municipality`);

--
-- Indices de la tabla `company_label`
--
ALTER TABLE `company_label`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`fk_company`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`fk_supplier`),
  ADD KEY `fk_company_2` (`fk_company`),
  ADD KEY `fk_headquarter` (`fk_headquarter`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `cost_center`
--
ALTER TABLE `cost_center`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`fk_company`,`fk_headquarter`,`fk_cost_center`),
  ADD KEY `fk_headquarter` (`fk_headquarter`),
  ADD KEY `fk_cost_center` (`fk_cost_center`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indices de la tabla `economic_activity`
--
ALTER TABLE `economic_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expense_list`
--
ALTER TABLE `expense_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chart_account` (`fk_chart_account`,`fk_cost_center`,`fk_inovice`),
  ADD KEY `fk_cost_center` (`fk_cost_center`),
  ADD KEY `fk_inovice` (`fk_inovice`);

--
-- Indices de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`fk_company`,`fk_municipality`),
  ADD KEY `fk_municipality` (`fk_municipality`);

--
-- Indices de la tabla `income_list`
--
ALTER TABLE `income_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chart_account` (`fk_chart_account`,`fk_cost_center`,`fk_bill`),
  ADD KEY `fk_cost_center` (`fk_cost_center`),
  ADD KEY `fk_bill` (`fk_bill`);

--
-- Indices de la tabla `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item` (`fk_item`,`fk_third`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_type` (`fk_doc_type`,`fk_municipality`,`cost_center`,`third_party`,`account_cash`),
  ADD KEY `fk_municipality` (`fk_municipality`),
  ADD KEY `cost_center` (`cost_center`),
  ADD KEY `third_party` (`third_party`),
  ADD KEY `account_cash` (`account_cash`);

--
-- Indices de la tabla `movements_list`
--
ALTER TABLE `movements_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chart_account` (`fk_chart_account`,`fk_cost_center`,`third_transaction`,`fk_active`),
  ADD KEY `fk_acc_note` (`fk_acc_note`);

--
-- Indices de la tabla `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento_id` (`fk_department`);

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_users`),
  ADD KEY `fk_company` (`fk_supplier`);

--
-- Indices de la tabla `payroll_taxes`
--
ALTER TABLE `payroll_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class` (`fk_chart_account`,`concept`),
  ADD KEY `fk_retention` (`concept`);

--
-- Indices de la tabla `portfolio_supplier`
--
ALTER TABLE `portfolio_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_third` (`fk_third`,`seller`,`fk_acc_note`);

--
-- Indices de la tabla `products_lines`
--
ALTER TABLE `products_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `retentions`
--
ALTER TABLE `retentions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent_retention` (`fk_parent_retention`,`bill_to_pay`,`expense_account`,`cost_center`),
  ADD KEY `bill_to_pay` (`bill_to_pay`),
  ADD KEY `expense_account` (`expense_account`),
  ADD KEY `cost_center` (`cost_center`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`fk_company`),
  ADD KEY `fk_type` (`fk_type`),
  ADD KEY `fk_ciudad` (`fk_municipality`),
  ADD KEY `fk_tax` (`fk_tax`);

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `taxes_configuration`
--
ALTER TABLE `taxes_configuration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tax` (`fk_chart_account`),
  ADD KEY `iva` (`iva`,`retention`,`rete_ica`,`tax_cree`,`auto_retention`,`other`,`other_2`),
  ADD KEY `retention` (`retention`),
  ADD KEY `rete_ica` (`rete_ica`),
  ADD KEY `tax_cree` (`tax_cree`),
  ADD KEY `auto_retention` (`auto_retention`),
  ADD KEY `other` (`other`),
  ADD KEY `other_2` (`other_2`);

--
-- Indices de la tabla `taxes_liquidation`
--
ALTER TABLE `taxes_liquidation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concept` (`concept`,`fk_invoice`),
  ADD KEY `fk_invoice` (`fk_invoice`),
  ADD KEY `account_to_affect` (`account_to_affect`,`third_party`),
  ADD KEY `third_party` (`third_party`),
  ADD KEY `fk_bill` (`fk_bill`);

--
-- Indices de la tabla `tax_classification`
--
ALTER TABLE `tax_classification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_economic_activity` (`fk_economic_activity`,`fk_company`),
  ADD KEY `fk_company` (`fk_company`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `third_attached_files`
--
ALTER TABLE `third_attached_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `third_parties`
--
ALTER TABLE `third_parties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `fk_municipality` (`fk_municipality`,`fk_third`),
  ADD KEY `fk_third` (`fk_third`);

--
-- Indices de la tabla `type_service`
--
ALTER TABLE `type_service`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_municipality` (`fk_municipality`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounting_notes`
--
ALTER TABLE `accounting_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bills_attached_files`
--
ALTER TABLE `bills_attached_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `bill_of_sale`
--
ALTER TABLE `bill_of_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bill_to_pay`
--
ALTER TABLE `bill_to_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cash_bank`
--
ALTER TABLE `cash_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `chart_accounts`
--
ALTER TABLE `chart_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `company_label`
--
ALTER TABLE `company_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `cost_center`
--
ALTER TABLE `cost_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `economic_activity`
--
ALTER TABLE `economic_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expense_list`
--
ALTER TABLE `expense_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `income_list`
--
ALTER TABLE `income_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `movements_list`
--
ALTER TABLE `movements_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipality`
--
ALTER TABLE `municipality`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `payroll_taxes`
--
ALTER TABLE `payroll_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `portfolio_supplier`
--
ALTER TABLE `portfolio_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products_lines`
--
ALTER TABLE `products_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `purchased_products`
--
ALTER TABLE `purchased_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `retentions`
--
ALTER TABLE `retentions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `taxes_configuration`
--
ALTER TABLE `taxes_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `taxes_liquidation`
--
ALTER TABLE `taxes_liquidation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `tax_classification`
--
ALTER TABLE `tax_classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `third_attached_files`
--
ALTER TABLE `third_attached_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `third_parties`
--
ALTER TABLE `third_parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `type_service`
--
ALTER TABLE `type_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bills_attached_files`
--
ALTER TABLE `bills_attached_files`
  ADD CONSTRAINT `bills_attached_files_ibfk_1` FOREIGN KEY (`fk_bill_of_sale`) REFERENCES `bill_of_sale` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `bill_of_sale`
--
ALTER TABLE `bill_of_sale`
  ADD CONSTRAINT `bill_of_sale_ibfk_1` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_sale_ibfk_2` FOREIGN KEY (`fk_doc_type`) REFERENCES `document_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_sale_ibfk_3` FOREIGN KEY (`client`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_sale_ibfk_4` FOREIGN KEY (`seller`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_sale_ibfk_5` FOREIGN KEY (`account_cash`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_sale_ibfk_6` FOREIGN KEY (`cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `bill_to_pay`
--
ALTER TABLE `bill_to_pay`
  ADD CONSTRAINT `bill_to_pay_ibfk_1` FOREIGN KEY (`account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_to_pay_ibfk_2` FOREIGN KEY (`fk_inovice`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_to_pay_ibfk_3` FOREIGN KEY (`third_party`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_to_pay_ibfk_4` FOREIGN KEY (`fk_bill`) REFERENCES `bill_of_sale` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `cash_bank`
--
ALTER TABLE `cash_bank`
  ADD CONSTRAINT `cash_bank_ibfk_1` FOREIGN KEY (`bank_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cash_bank_ibfk_2` FOREIGN KEY (`fk_invoice`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cash_bank_ibfk_3` FOREIGN KEY (`fk_bill`) REFERENCES `bill_of_sale` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `category_list`
--
ALTER TABLE `category_list`
  ADD CONSTRAINT `category_list_ibfk_1` FOREIGN KEY (`fk_headquarter`) REFERENCES `headquarters` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `chart_accounts`
--
ALTER TABLE `chart_accounts`
  ADD CONSTRAINT `chart_accounts_ibfk_1` FOREIGN KEY (`fk_account_type`) REFERENCES `account_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chart_accounts_ibfk_3` FOREIGN KEY (`fk_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chart_accounts_ibfk_4` FOREIGN KEY (`fk_tax`) REFERENCES `taxes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `company_label`
--
ALTER TABLE `company_label`
  ADD CONSTRAINT `company_label_ibfk_1` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`fk_supplier`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_3` FOREIGN KEY (`fk_headquarter`) REFERENCES `headquarters` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_4` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `cost_center`
--
ALTER TABLE `cost_center`
  ADD CONSTRAINT `cost_center_ibfk_1` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cost_center_ibfk_2` FOREIGN KEY (`fk_headquarter`) REFERENCES `headquarters` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cost_center_ibfk_3` FOREIGN KEY (`fk_cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `expense_list`
--
ALTER TABLE `expense_list`
  ADD CONSTRAINT `expense_list_ibfk_1` FOREIGN KEY (`fk_chart_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_list_ibfk_2` FOREIGN KEY (`fk_cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_list_ibfk_3` FOREIGN KEY (`fk_inovice`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD CONSTRAINT `headquarters_ibfk_1` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `headquarters_ibfk_2` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `income_list`
--
ALTER TABLE `income_list`
  ADD CONSTRAINT `income_list_ibfk_1` FOREIGN KEY (`fk_chart_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `income_list_ibfk_2` FOREIGN KEY (`fk_cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `income_list_ibfk_3` FOREIGN KEY (`fk_bill`) REFERENCES `bill_of_sale` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_ibfk_1` FOREIGN KEY (`fk_item`) REFERENCES `inventory` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `inventory_items_ibfk_2` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`fk_doc_type`) REFERENCES `document_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_4` FOREIGN KEY (`third_party`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_5` FOREIGN KEY (`account_cash`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipality`
--
ALTER TABLE `municipality`
  ADD CONSTRAINT `municipality_ibfk_1` FOREIGN KEY (`fk_department`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`fk_users`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`fk_supplier`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `payroll_taxes`
--
ALTER TABLE `payroll_taxes`
  ADD CONSTRAINT `payroll_taxes_ibfk_2` FOREIGN KEY (`concept`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_taxes_ibfk_3` FOREIGN KEY (`fk_chart_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `products_lines`
--
ALTER TABLE `products_lines`
  ADD CONSTRAINT `products_lines_ibfk_1` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD CONSTRAINT `purchased_products_ibfk_1` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `retentions`
--
ALTER TABLE `retentions`
  ADD CONSTRAINT `retentions_ibfk_1` FOREIGN KEY (`fk_parent_retention`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `retentions_ibfk_2` FOREIGN KEY (`bill_to_pay`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `retentions_ibfk_3` FOREIGN KEY (`expense_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `retentions_ibfk_4` FOREIGN KEY (`cost_center`) REFERENCES `cost_center` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `services_ibfk_3` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `services_ibfk_4` FOREIGN KEY (`fk_tax`) REFERENCES `taxes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `services_ibfk_5` FOREIGN KEY (`fk_type`) REFERENCES `type_service` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `taxes_configuration`
--
ALTER TABLE `taxes_configuration`
  ADD CONSTRAINT `taxes_configuration_ibfk_10` FOREIGN KEY (`other_2`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_11` FOREIGN KEY (`fk_chart_account`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_4` FOREIGN KEY (`iva`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_5` FOREIGN KEY (`retention`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_6` FOREIGN KEY (`rete_ica`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_7` FOREIGN KEY (`tax_cree`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_8` FOREIGN KEY (`auto_retention`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_configuration_ibfk_9` FOREIGN KEY (`other`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `taxes_liquidation`
--
ALTER TABLE `taxes_liquidation`
  ADD CONSTRAINT `taxes_liquidation_ibfk_1` FOREIGN KEY (`concept`) REFERENCES `retentions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_liquidation_ibfk_2` FOREIGN KEY (`fk_invoice`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_liquidation_ibfk_3` FOREIGN KEY (`account_to_affect`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_liquidation_ibfk_4` FOREIGN KEY (`third_party`) REFERENCES `chart_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taxes_liquidation_ibfk_5` FOREIGN KEY (`fk_bill`) REFERENCES `bill_of_sale` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `tax_classification`
--
ALTER TABLE `tax_classification`
  ADD CONSTRAINT `tax_classification_ibfk_1` FOREIGN KEY (`fk_economic_activity`) REFERENCES `economic_activity` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_classification_ibfk_2` FOREIGN KEY (`fk_company`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_classification_ibfk_3` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `third_attached_files`
--
ALTER TABLE `third_attached_files`
  ADD CONSTRAINT `third_attached_files_ibfk_1` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `third_parties`
--
ALTER TABLE `third_parties`
  ADD CONSTRAINT `third_parties_ibfk_1` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `third_parties_ibfk_2` FOREIGN KEY (`fk_third`) REFERENCES `third_parties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_municipality`) REFERENCES `municipality` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
