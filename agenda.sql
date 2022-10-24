-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-10-2022 a las 21:36:31
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresstypes`
--

DROP TABLE IF EXISTS `addresstypes`;
CREATE TABLE IF NOT EXISTS `addresstypes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `addresstypes`
--

INSERT INTO `addresstypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sin etiqueta', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(2, 'Casa', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(3, 'Trabajo', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(4, 'Otro', '2022-10-24 17:30:19', '2022-10-24 17:30:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactaddresses`
--

DROP TABLE IF EXISTS `contactaddresses`;
CREATE TABLE IF NOT EXISTS `contactaddresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `contact_id` bigint UNSIGNED NOT NULL,
  `addresstype_id` bigint UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactaddresses_contact_id_foreign` (`contact_id`),
  KEY `contactaddresses_addresstype_id_foreign` (`addresstype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `contactaddresses`
--

INSERT INTO `contactaddresses` (`id`, `contact_id`, `addresstype_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'AVENIDA NARANJAL 123', '2022-10-25 01:40:27', '2022-10-25 01:40:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactphones`
--

DROP TABLE IF EXISTS `contactphones`;
CREATE TABLE IF NOT EXISTS `contactphones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `contact_id` bigint UNSIGNED NOT NULL,
  `phonetype_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactphones_contact_id_foreign` (`contact_id`),
  KEY `contactphones_phonetype_id_foreign` (`phonetype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `contactphones`
--

INSERT INTO `contactphones` (`id`, `contact_id`, `phonetype_id`, `phone`, `created_at`, `updated_at`) VALUES
(5, 2, 2, '918363389', '2022-10-25 01:40:27', '2022-10-25 01:40:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `last_name`, `nickname`, `business`, `email`, `created_at`, `updated_at`) VALUES
(2, 'Carlos', 'Zavaleta', 'Developer', 'Carlos SAC', NULL, '2022-10-25 00:09:04', '2022-10-25 01:40:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_13_000000_create_contacts_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2022_10_24_153510_create_phonetypes_table', 1),
(6, '2022_10_24_153513_create_contactphones_table', 1),
(7, '2022_10_24_154416_create_addresstypes_table', 1),
(8, '2022_10_24_154510_create_contactaddresses_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phonetypes`
--

DROP TABLE IF EXISTS `phonetypes`;
CREATE TABLE IF NOT EXISTS `phonetypes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `phonetypes`
--

INSERT INTO `phonetypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sin etiqueta', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(2, 'Móvil', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(3, 'Trabajo', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(4, 'Casa', '2022-10-24 17:30:19', '2022-10-24 17:30:19'),
(5, 'Principal', '2022-10-24 17:30:19', '2022-10-24 17:30:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', 'Zavaleta', 'carloszavaletaramirez@gmail.com', NULL, '$2y$10$fbapl1hiC.Se3wFEkBE8musA2MARyLkUjxjSAUmx.Boig9orJ7Nca', NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactaddresses`
--
ALTER TABLE `contactaddresses`
  ADD CONSTRAINT `contactaddresses_addresstype_id_foreign` FOREIGN KEY (`addresstype_id`) REFERENCES `addresstypes` (`id`),
  ADD CONSTRAINT `contactaddresses_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);

--
-- Filtros para la tabla `contactphones`
--
ALTER TABLE `contactphones`
  ADD CONSTRAINT `contactphones_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `contactphones_phonetype_id_foreign` FOREIGN KEY (`phonetype_id`) REFERENCES `phonetypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
