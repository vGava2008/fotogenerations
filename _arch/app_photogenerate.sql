-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2019 г., 10:10
-- Версия сервера: 5.5.53
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app_photogenerate`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute`
--

CREATE TABLE `attribute` (
  `attribute_id` int(11) NOT NULL,
  `attribute_group_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_group_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(2, 1, 2, '2019-11-06 16:40:05', '2019-11-06 16:40:05');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_description`
--

CREATE TABLE `attribute_description` (
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute_description`
--

INSERT INTO `attribute_description` (`attribute_id`, `language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Первый слой', '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(1, 2, 'First Layout', '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(1, 3, 'First Layout3', '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(1, 4, 'First Layout', '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(1, 5, 'First Layout', '2019-10-29 10:18:34', '2019-10-29 10:40:10'),
(2, 1, 'Второй слой', '2019-11-06 16:40:05', '2019-11-06 16:40:05'),
(2, 2, 'Second Layout', '2019-11-06 16:40:05', '2019-11-06 16:40:05'),
(2, 3, 'Second Layout', '2019-11-06 16:40:05', '2019-11-06 16:40:05'),
(2, 4, 'Second Layout', '2019-11-06 16:40:05', '2019-11-06 16:40:05'),
(2, 5, 'Second Layout', '2019-11-06 16:40:05', '2019-11-06 16:40:05');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_group`
--

CREATE TABLE `attribute_group` (
  `attribute_group_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute_group`
--

INSERT INTO `attribute_group` (`attribute_group_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-10-28 13:39:02', '2019-10-29 10:07:47');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_group_description`
--

CREATE TABLE `attribute_group_description` (
  `attribute_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute_group_description`
--

INSERT INTO `attribute_group_description` (`attribute_group_id`, `language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Оттенки', '2019-10-28 13:39:02', '2019-10-29 10:07:47'),
(1, 2, 'Shades', '2019-10-28 13:39:02', '2019-10-29 10:07:47'),
(1, 3, 'Shades', '2019-10-28 13:39:02', '2019-10-29 10:07:47'),
(1, 4, 'Shades', '2019-10-28 13:39:02', '2019-10-29 10:07:47'),
(1, 5, 'Shades', '2019-10-28 13:39:02', '2019-10-29 10:07:47');

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_second_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_second_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_left` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_right` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_center_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_third_center_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_centr` text COLLATE utf8mb4_unicode_ci,
  `published` tinyint(4) DEFAULT NULL,
  `seo_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `language_id` int(10) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `main_image`, `second_image`, `title_second_image`, `title_second_level`, `text_left`, `text_right`, `third_center_image`, `title_third_center_image`, `text_centr`, `published`, `seo_link`, `category_id`, `language_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Новости', 'uploads/KWNCcXPDs1hwEKfeXMDLyHfx3vyOhUgmGMaXysnP.jpeg', 'uploads/YvSTORf56h8fdsjPol2FUZGbriquIzaLNgKS4guo.jpeg', 'Новости', 'Новости', 'Новости', 'Новости', 'uploads/B96J9CxOxVZYLKsZ61HfAaf7J8fpnMZpiGS6lzcy.jpeg', 'Новости', 'Новости', 1, 'news_blog', 8, 1, NULL, NULL, '2019-10-10 10:33:34', '2019-10-10 12:48:10'),
(1, 'Новости', 'uploads/KWNCcXPDs1hwEKfeXMDLyHfx3vyOhUgmGMaXysnP.jpeg', 'uploads/YvSTORf56h8fdsjPol2FUZGbriquIzaLNgKS4guo.jpeg', 'Новости', 'Новости', 'Новости', 'Новости', 'uploads/B96J9CxOxVZYLKsZ61HfAaf7J8fpnMZpiGS6lzcy.jpeg', 'Новости', 'Новости', 1, 'news_blog', 8, 2, NULL, NULL, '2019-10-10 10:33:34', '2019-10-10 12:48:10'),
(1, 'Новости', 'uploads/KWNCcXPDs1hwEKfeXMDLyHfx3vyOhUgmGMaXysnP.jpeg', 'uploads/YvSTORf56h8fdsjPol2FUZGbriquIzaLNgKS4guo.jpeg', 'Новости', 'Новости', 'Новости', 'Новости', 'uploads/B96J9CxOxVZYLKsZ61HfAaf7J8fpnMZpiGS6lzcy.jpeg', 'Новости', 'Новости', 1, 'news_blog', 8, 3, NULL, NULL, '2019-10-10 10:33:34', '2019-10-10 12:48:10'),
(1, 'Новости', 'uploads/KWNCcXPDs1hwEKfeXMDLyHfx3vyOhUgmGMaXysnP.jpeg', 'uploads/YvSTORf56h8fdsjPol2FUZGbriquIzaLNgKS4guo.jpeg', 'Новости', 'Новости', 'Новости', 'Новости', 'uploads/B96J9CxOxVZYLKsZ61HfAaf7J8fpnMZpiGS6lzcy.jpeg', 'Новости', 'Новости', 1, 'news_blog', 8, 4, NULL, NULL, '2019-10-10 10:33:34', '2019-10-10 12:48:10'),
(1, 'Новости', 'uploads/KWNCcXPDs1hwEKfeXMDLyHfx3vyOhUgmGMaXysnP.jpeg', 'uploads/YvSTORf56h8fdsjPol2FUZGbriquIzaLNgKS4guo.jpeg', 'Новости', 'Новости', 'Новости', 'Новости', 'uploads/B96J9CxOxVZYLKsZ61HfAaf7J8fpnMZpiGS6lzcy.jpeg', 'Новости', 'Новости', 1, 'news_blog', 8, 5, NULL, NULL, '2019-10-10 10:33:34', '2019-10-10 12:48:10');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_show` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `language_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `image`, `image_show`, `title`, `seo_link`, `parent_id`, `published`, `language_id`, `created_at`, `updated_at`) VALUES
(5, NULL, NULL, 'Тест', 'test', 0, 1, 1, '2019-06-13 14:11:01', '2019-06-13 14:25:43'),
(5, NULL, NULL, 'Test2', 'test', 0, 1, 2, '2019-06-13 14:11:01', '2019-06-13 14:25:43'),
(5, NULL, NULL, 'Test3', 'test', 0, 1, 3, '2019-06-13 14:11:01', '2019-06-13 14:25:43'),
(5, NULL, NULL, 'Test4', 'test', 0, 1, 4, '2019-06-13 14:11:01', '2019-06-13 14:25:43'),
(5, NULL, NULL, 'Test5', 'test', 0, 1, 5, '2019-06-13 14:11:01', '2019-06-13 14:25:43'),
(6, 'uploads/SUgFLLidULtirGp9z1fhEJH5uj5bwtttj5FjmpQM.jpeg', NULL, '1', '1234', 0, 1, 1, '2019-06-20 09:54:38', '2019-06-20 16:05:13'),
(6, 'uploads/SUgFLLidULtirGp9z1fhEJH5uj5bwtttj5FjmpQM.jpeg', NULL, '2', '1234', 0, 1, 2, '2019-06-20 09:54:38', '2019-06-20 16:05:13'),
(6, 'uploads/SUgFLLidULtirGp9z1fhEJH5uj5bwtttj5FjmpQM.jpeg', NULL, '3', '1234', 0, 1, 3, '2019-06-20 09:54:38', '2019-06-20 16:05:13'),
(6, 'uploads/SUgFLLidULtirGp9z1fhEJH5uj5bwtttj5FjmpQM.jpeg', NULL, '4', '1234', 0, 1, 4, '2019-06-20 09:54:38', '2019-06-20 16:05:13'),
(6, 'uploads/SUgFLLidULtirGp9z1fhEJH5uj5bwtttj5FjmpQM.jpeg', NULL, '5', '1234', 0, 1, 5, '2019-06-20 09:54:38', '2019-06-20 16:05:13'),
(7, 'uploads/TT1co7FcqWT1xKUUGcJbJ0QZbad2yuJlpcDwZbdd.jpeg', NULL, 'Тест', 'test232', 0, 1, 1, '2019-06-20 11:08:51', '2019-06-20 11:08:51'),
(7, 'uploads/TT1co7FcqWT1xKUUGcJbJ0QZbad2yuJlpcDwZbdd.jpeg', NULL, 'Test2', 'test232', 0, 1, 2, '2019-06-20 11:08:51', '2019-06-20 11:08:51'),
(7, 'uploads/TT1co7FcqWT1xKUUGcJbJ0QZbad2yuJlpcDwZbdd.jpeg', NULL, 'Test3', 'test232', 0, 1, 3, '2019-06-20 11:08:51', '2019-06-20 11:08:51'),
(7, 'uploads/TT1co7FcqWT1xKUUGcJbJ0QZbad2yuJlpcDwZbdd.jpeg', NULL, 'Test4', 'test232', 0, 1, 4, '2019-06-20 11:08:51', '2019-06-20 11:08:51'),
(7, 'uploads/TT1co7FcqWT1xKUUGcJbJ0QZbad2yuJlpcDwZbdd.jpeg', NULL, 'Test5', 'test232', 0, 1, 5, '2019-06-20 11:08:51', '2019-06-20 11:08:51'),
(8, 'uploads/4RD4PRov2upnHmbL3TO8MECl9m7p9vYDpaN6NzSJ.jpeg', NULL, 'Новости', 'news', 0, 1, 1, '2019-10-10 10:26:33', '2019-10-10 10:26:33'),
(8, 'uploads/4RD4PRov2upnHmbL3TO8MECl9m7p9vYDpaN6NzSJ.jpeg', NULL, 'News', 'news', 0, 1, 2, '2019-10-10 10:26:33', '2019-10-10 10:26:33'),
(8, 'uploads/4RD4PRov2upnHmbL3TO8MECl9m7p9vYDpaN6NzSJ.jpeg', NULL, 'News', 'news', 0, 1, 3, '2019-10-10 10:26:33', '2019-10-10 10:26:33'),
(8, 'uploads/4RD4PRov2upnHmbL3TO8MECl9m7p9vYDpaN6NzSJ.jpeg', NULL, 'News', 'news', 0, 1, 4, '2019-10-10 10:26:33', '2019-10-10 10:26:33'),
(8, 'uploads/4RD4PRov2upnHmbL3TO8MECl9m7p9vYDpaN6NzSJ.jpeg', NULL, 'News', 'news', 0, 1, 5, '2019-10-10 10:26:33', '2019-10-10 10:26:33'),
(9, 'uploads/8iTGK1LyhANuCEYIsd3kBDpEXv8kUB3cRupoppaU.jpeg', NULL, 'Идеи', 'ideas', 0, 1, 1, '2019-10-11 08:28:31', '2019-10-11 08:28:31'),
(9, 'uploads/8iTGK1LyhANuCEYIsd3kBDpEXv8kUB3cRupoppaU.jpeg', NULL, 'Ideas', 'ideas', 0, 1, 2, '2019-10-11 08:28:31', '2019-10-11 08:28:31'),
(9, 'uploads/8iTGK1LyhANuCEYIsd3kBDpEXv8kUB3cRupoppaU.jpeg', NULL, 'Ideas', 'ideas', 0, 1, 3, '2019-10-11 08:28:31', '2019-10-11 08:28:31'),
(9, 'uploads/8iTGK1LyhANuCEYIsd3kBDpEXv8kUB3cRupoppaU.jpeg', NULL, 'Ideas', 'ideas', 0, 1, 4, '2019-10-11 08:28:31', '2019-10-11 08:28:31'),
(9, 'uploads/8iTGK1LyhANuCEYIsd3kBDpEXv8kUB3cRupoppaU.jpeg', NULL, 'Ideas', 'ideas', 0, 1, 5, '2019-10-11 08:28:31', '2019-10-11 08:28:31');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `language_id`) VALUES
(1, 'Украина', 1),
(2, 'Россия', 1),
(3, 'Ukraine', 2),
(4, 'Russian', 2),
(5, 'Україна', 3),
(6, 'Россія', 3),
(7, 'Белоруссия', 1),
(8, 'Белорусь', 2),
(9, 'Белорусь', 3),
(10, 'Белорусь', 4),
(11, 'Белорусь', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `customer_group`
--

CREATE TABLE `customer_group` (
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `customer_group`
--

INSERT INTO `customer_group` (`customer_group_id`, `name`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Клиенты', 'Обычные клиенты', 2, '2019-11-18 12:35:04', '2019-11-19 08:58:12'),
(2, 'Администратор', 'Администраторы', 1, '2019-11-19 08:58:07', '2019-11-19 08:58:07');

-- --------------------------------------------------------

--
-- Структура таблицы `ideas`
--

CREATE TABLE `ideas` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_second_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_second_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_left` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_right` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_center_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_third_center_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_centr` text COLLATE utf8mb4_unicode_ci,
  `published` tinyint(4) DEFAULT NULL,
  `seo_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `language_id` int(10) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ideas`
--

INSERT INTO `ideas` (`id`, `title`, `main_image`, `second_image`, `title_second_image`, `title_second_level`, `text_left`, `text_right`, `third_center_image`, `title_third_center_image`, `text_centr`, `published`, `seo_link`, `category_id`, `language_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Идеи1', 'uploads/VzTzJitQVoNfRuq5iC0NUyv52YXlKnE7TFSuD7Fs.jpeg', 'uploads/dWfPEBOdCbSUAYvWoHzfeHNTF1oBJihqU45NzSBH.jpeg', 'Идеи', 'Идеи', 'Идеи', 'Идеи', 'uploads/P16vGHDGX0YZ23PERRQBYIRr4EQR58VIBvqL6Iq4.jpeg', 'Идеи', 'Идеи', 1, 'ideas_blog', 9, 1, NULL, NULL, '2019-10-11 09:04:36', '2019-10-11 09:04:51'),
(1, 'Идеи', 'uploads/VzTzJitQVoNfRuq5iC0NUyv52YXlKnE7TFSuD7Fs.jpeg', 'uploads/dWfPEBOdCbSUAYvWoHzfeHNTF1oBJihqU45NzSBH.jpeg', 'Идеи', 'Идеи', 'Идеи', 'Идеи', 'uploads/P16vGHDGX0YZ23PERRQBYIRr4EQR58VIBvqL6Iq4.jpeg', 'Идеи', 'Идеи', 1, 'ideas_blog', 9, 2, NULL, NULL, '2019-10-11 09:04:36', '2019-10-11 09:04:51'),
(1, 'Идеи', 'uploads/VzTzJitQVoNfRuq5iC0NUyv52YXlKnE7TFSuD7Fs.jpeg', 'uploads/dWfPEBOdCbSUAYvWoHzfeHNTF1oBJihqU45NzSBH.jpeg', 'Идеи', 'Идеи', 'Идеи', 'Идеи', 'uploads/P16vGHDGX0YZ23PERRQBYIRr4EQR58VIBvqL6Iq4.jpeg', 'Идеи', 'Идеи', 1, 'ideas_blog', 9, 3, NULL, NULL, '2019-10-11 09:04:36', '2019-10-11 09:04:51'),
(1, 'Идеи', 'uploads/VzTzJitQVoNfRuq5iC0NUyv52YXlKnE7TFSuD7Fs.jpeg', 'uploads/dWfPEBOdCbSUAYvWoHzfeHNTF1oBJihqU45NzSBH.jpeg', 'Идеи', 'Идеи', 'Идеи', 'Идеи', 'uploads/P16vGHDGX0YZ23PERRQBYIRr4EQR58VIBvqL6Iq4.jpeg', 'Идеи', 'Идеи', 1, 'ideas_blog', 9, 4, NULL, NULL, '2019-10-11 09:04:36', '2019-10-11 09:04:51'),
(1, 'Идеи', 'uploads/VzTzJitQVoNfRuq5iC0NUyv52YXlKnE7TFSuD7Fs.jpeg', 'uploads/dWfPEBOdCbSUAYvWoHzfeHNTF1oBJihqU45NzSBH.jpeg', 'Идеи', 'Идеи', 'Идеи', 'Идеи', 'uploads/P16vGHDGX0YZ23PERRQBYIRr4EQR58VIBvqL6Iq4.jpeg', 'Идеи', 'Идеи', 1, 'ideas_blog', 9, 5, NULL, NULL, '2019-10-11 09:04:36', '2019-10-11 09:04:51');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 'Русский', 'ru', NULL, NULL),
(2, 'English', 'en', NULL, NULL),
(3, 'Latviešu', 'lv', NULL, NULL),
(4, 'Eesti', 'et', NULL, NULL),
(5, 'Lietuvių', 'lt', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `image`, `title`, `seo_link`, `published`, `language_id`, `created_at`, `updated_at`) VALUES
(2, 'uploads/b56DTGTkgOt9P7MUdtMA047DjXl0dDdHjidlKcmH.jpeg', 'Caterpillar', 'caterpillar', 1, 1, '2019-10-25 13:02:46', '2019-10-25 13:30:24'),
(2, 'uploads/b56DTGTkgOt9P7MUdtMA047DjXl0dDdHjidlKcmH.jpeg', 'Caterpillar', 'caterpillar', 1, 2, '2019-10-25 13:02:46', '2019-10-25 13:30:24'),
(2, 'uploads/b56DTGTkgOt9P7MUdtMA047DjXl0dDdHjidlKcmH.jpeg', 'Caterpillar', 'caterpillar', 1, 3, '2019-10-25 13:02:46', '2019-10-25 13:30:24'),
(2, 'uploads/b56DTGTkgOt9P7MUdtMA047DjXl0dDdHjidlKcmH.jpeg', 'Caterpillar', 'caterpillar', 1, 4, '2019-10-25 13:02:46', '2019-10-25 13:30:24'),
(2, 'uploads/b56DTGTkgOt9P7MUdtMA047DjXl0dDdHjidlKcmH.jpeg', 'Caterpillar', 'caterpillar', 1, 5, '2019-10-25 13:02:46', '2019-10-25 13:30:24');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_10_08_121310_create_questions_table', 1),
(2, '2019_10_15_123146_create_product_options_table', 2),
(3, '2019_10_15_130207_create_options_table', 3),
(4, '2019_10_17_132129_create_option_descriptions_table', 4),
(5, '2019_10_21_132452_create_products_table', 5),
(6, '2019_10_22_121011_create_product_descriptions_table', 6),
(7, '2019_10_23_134804_create_product_connections_table', 7),
(8, '2019_10_28_132900_create_product_attributes_table', 8),
(9, '2019_10_28_134053_create_attributes_table', 8),
(10, '2019_10_28_135007_create_attribute_descriptions_table', 8),
(11, '2019_10_28_135213_create_attribute_groups_table', 8),
(12, '2019_10_28_135632_create_attribute_group_descriptions_table', 8),
(13, '2019_11_07_124255_create_product_images_table', 9),
(14, '2019_11_13_133650_create_option_values_table', 10),
(15, '2019_11_13_134221_create_option_value_descriptions_table', 10),
(16, '2019_11_18_134215_create_product_discounts_table', 11),
(17, '2019_11_18_135714_create_customer_groups_table', 12),
(18, '2019_11_20_104431_create_product_specials_table', 13),
(19, '2019_11_21_130455_create_user_tags_table', 14),
(20, '2019_11_21_132854_create_user_filters_table', 15),
(21, '2014_10_12_100000_create_password_resets_table', 16);

-- --------------------------------------------------------

--
-- Структура таблицы `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `option`
--

INSERT INTO `option` (`id`, `option_id`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'select', 1, '2019-10-14 21:00:00', '2019-11-14 12:13:52'),
(7, 3, 'radio', 2, '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(8, 4, 'radio', 2, '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(9, 5, 'radio', 1, '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(10, 6, 'select', 3, '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(11, 7, 'radio', 5, '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(13, 9, 'radio', 4, '2019-11-14 12:44:55', '2019-11-14 12:55:20');

-- --------------------------------------------------------

--
-- Структура таблицы `option_description`
--

CREATE TABLE `option_description` (
  `option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `option_description`
--

INSERT INTO `option_description` (`option_id`, `language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Размеры', '2019-10-16 21:00:00', '2019-11-14 12:13:52'),
(1, 2, 'Dimensions', '2019-10-16 21:00:00', '2019-11-14 12:13:52'),
(1, 3, 'Dimensions', '2019-11-11 22:00:00', '2019-11-14 12:13:52'),
(1, 4, 'Dimensions', '2019-11-11 22:00:00', '2019-11-14 12:13:52'),
(1, 5, 'Dimensions', '2019-11-11 22:00:00', '2019-11-14 12:13:52'),
(3, 1, 'Цвета', '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(3, 2, 'Colors', '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(3, 3, 'Colors', '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(3, 4, 'Colors', '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(3, 5, 'Colors', '2019-11-12 12:39:47', '2019-11-12 12:39:47'),
(4, 1, '0', '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(4, 2, '0', '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(4, 3, '0', '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(4, 4, '0', '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(4, 5, '0', '2019-11-14 12:24:06', '2019-11-14 12:24:06'),
(5, 1, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(5, 2, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(5, 3, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(5, 4, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(5, 5, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(6, 1, '3', '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(6, 2, '3', '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(6, 3, '3', '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(6, 4, '3', '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(6, 5, '3', '2019-11-14 12:34:10', '2019-11-14 12:34:10'),
(7, 1, 'Удаление', '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(7, 2, 'Deleting', '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(7, 3, 'Deleting', '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(7, 4, 'Deleting', '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(7, 5, 'Deleting', '2019-11-14 12:34:52', '2019-11-14 13:54:47'),
(9, 1, 'Тестирование', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(9, 2, 'Testing', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(9, 3, 'Testing', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(9, 4, 'Testing', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(9, 5, 'Testing', '2019-11-14 12:44:55', '2019-11-14 12:55:20');

-- --------------------------------------------------------

--
-- Структура таблицы `option_value`
--

CREATE TABLE `option_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `option_value`
--

INSERT INTO `option_value` (`id`, `option_value_id`, `option_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'uploads/q6c2nzyh6RjrLZH1z77VtYdHmGKKF5Svkty04WFi.jpeg', 1, '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(2, 2, 1, 'uploads/bun4w9Xl5BlV2cjheSXLKXKaPJgvtZIu6aIIX89o.jpeg', 2, '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(3, 3, 5, 'uploads/PayhTMPlSNQDpkc18E4Apwrb8IxbJq4OgaqK1b4O.jpeg', 2, '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(5, 5, 9, 'uploads/7QWJpP6zek03w3n2bJD1F69n59aGjlOR0CI4zsyz.png', 1, '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(6, 6, 9, 'uploads/XfORsaWXozCfT6o1EtBpjfhXIs04psgnjRH3e8GW.jpeg', 3, '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(10, 8, 7, 'uploads/e3BIds3Jn7NxYOwqATEfgMujavjqvlf3kHzFtFZj.jpeg', 1, '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(11, 9, 7, 'uploads/6tDezR2a0RxZfHSqLYUVwSq72yt6ZL7vIlLryAYk.png', 2, '2019-11-14 13:54:48', '2019-11-14 13:54:48');

-- --------------------------------------------------------

--
-- Структура таблицы `option_value_description`
--

CREATE TABLE `option_value_description` (
  `id` int(11) UNSIGNED NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `option_value_description`
--

INSERT INTO `option_value_description` (`id`, `option_value_id`, `language_id`, `option_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Тест', '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(2, 1, 2, 1, 'Test2', '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(3, 1, 3, 1, 'Test', '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(4, 1, 4, 1, 'Test', '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(5, 1, 5, 1, 'Test', '2019-11-12 22:00:00', '2019-11-14 12:13:52'),
(6, 2, 1, 1, '1', '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(7, 2, 2, 1, '2', '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(8, 2, 3, 1, '3', '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(9, 2, 4, 1, '4', '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(10, 2, 5, 1, '5', '2019-11-14 12:13:52', '2019-11-14 12:13:52'),
(11, 3, 1, 5, '1', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(12, 3, 2, 5, '2', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(13, 3, 3, 5, '3', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(14, 3, 4, 5, '4', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(15, 3, 5, 5, '5', '2019-11-14 12:30:45', '2019-11-14 12:30:45'),
(16, 5, 1, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(17, 5, 2, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(18, 5, 3, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(19, 5, 4, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(20, 5, 5, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(21, 6, 1, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(22, 6, 2, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(23, 6, 3, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(24, 6, 4, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(25, 6, 5, 9, '4', '2019-11-14 12:44:55', '2019-11-14 12:55:20'),
(26, 1, 1, 1, 'Deleting', '2019-11-14 12:56:30', '2019-11-14 12:56:30'),
(27, 1, 2, 1, 'Deleting', '2019-11-14 12:56:30', '2019-11-14 12:56:30'),
(28, 1, 3, 1, 'Deleting', '2019-11-14 12:56:30', '2019-11-14 12:56:30'),
(29, 1, 4, 1, 'Deleting', '2019-11-14 12:56:30', '2019-11-14 12:56:30'),
(30, 1, 5, 1, 'Deleting', '2019-11-14 12:56:30', '2019-11-14 12:56:30'),
(31, 8, 1, 7, 'Deleting', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(32, 8, 2, 7, 'Deleting', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(33, 8, 3, 7, 'Deleting', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(34, 8, 4, 7, 'Deleting', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(35, 8, 5, 7, 'Deleting', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(36, 9, 1, 7, 'Deleting2', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(37, 9, 2, 7, 'Deleting2', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(38, 9, 3, 7, 'Deleting2', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(39, 9, 4, 7, 'Deleting2', '2019-11-14 13:54:48', '2019-11-14 13:54:48'),
(40, 9, 5, 7, 'Deleting2', '2019-11-14 13:54:48', '2019-11-14 13:54:48');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('alexandr.shvets1996@gmail.com', '$2y$10$jUQSKjiIsUShg6Livd9LkuLnef3SfXn133d0iRFnBOK/aLzPl5s5e', '2019-11-22 15:59:44');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`product_id`, `model`, `sku`, `quantity`, `price`, `category_id`, `manufacturer_id`, `created_at`, `updated_at`) VALUES
(5, 'Product 4', '7603', 7, 100, 9, 2, '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(6, 'Product 4', '7604', 100, 100, 5, 0, '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(7, 'Product 4', '7606', 929, 100, 7, NULL, '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(8, 'Product 3', '7603', 7, 200, 5, NULL, '2019-11-20 11:57:25', '2019-11-20 11:57:25');

-- --------------------------------------------------------

--
-- Структура таблицы `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `product_id`, `attribute_id`, `language_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 'Имя', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(2, 6, 1, 2, 'Имя 2', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(3, 6, 1, 3, 'Имя 3', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(4, 6, 1, 4, 'Имя 4', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(5, 6, 1, 5, 'Имя 5', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(11, 6, 2, 1, 'Name', '2019-11-08 11:58:54', '2019-11-20 13:02:18'),
(12, 6, 2, 2, 'Name 2', '2019-11-08 11:58:54', '2019-11-20 13:02:18'),
(13, 6, 2, 3, 'Name 3', '2019-11-08 11:58:54', '2019-11-20 13:02:18'),
(14, 6, 2, 4, 'Name 4', '2019-11-08 11:58:54', '2019-11-20 13:02:18'),
(15, 6, 2, 5, 'Name 5', '2019-11-08 11:58:54', '2019-11-20 13:02:18');

-- --------------------------------------------------------

--
-- Структура таблицы `product_description`
--

CREATE TABLE `product_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_description`
--

INSERT INTO `product_description` (`product_id`, `language_id`, `name`, `description`, `meta_description`, `meta_keyword`, `tag`, `created_at`, `updated_at`) VALUES
(5, 1, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(5, 2, 'Product Test EN', 'Product Test', 'Product Test', 'Product Test', 'Product Test', '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(5, 3, 'Product Test', 'Product Test', 'Product Test', 'Product Test', 'Product Test', '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(5, 4, 'Product Test', 'Product Test', 'Product Test', 'Product Test', 'Product Test', '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(5, 5, 'Product Test', 'Product Test', 'Product Test', 'Product Test', 'Product Test', '2019-10-23 08:59:55', '2019-11-15 10:54:18'),
(6, 1, 'Название', 'Название', 'Название', 'Название', 'Название', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(6, 2, 'Название', 'Название', 'Название', 'Название', 'Название', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(6, 3, 'Название', 'Название', 'Название', 'Название', 'Название', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(6, 4, 'Название', 'Название', 'Название', 'Название', 'Название', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(6, 5, 'Название', 'Название', 'Название', 'Название', 'Название', '2019-10-31 13:20:13', '2019-11-20 13:02:18'),
(7, 1, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(7, 2, 'Product Test EN', 'Product Test EN', 'Product Test EN', 'Product Test EN', 'Product Test EN', '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(7, 3, 'Product Test LT', 'Product Test LT', 'Product Test LT', 'Product Test LT', 'Product Test LT', '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(7, 4, 'Product Test EE', 'Product Test EE', 'Product Test EE', 'Product Test EE', 'Product Test EE', '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(7, 5, 'Product Test LT', 'Product Test LT', 'Product Test LT', 'Product Test LT', 'Product Test LT', '2019-11-08 09:26:50', '2019-11-08 09:26:50'),
(8, 1, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-20 11:57:25', '2019-11-20 11:57:25'),
(8, 2, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-20 11:57:25', '2019-11-20 11:57:25'),
(8, 3, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-20 11:57:25', '2019-11-20 11:57:25'),
(8, 4, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-20 11:57:25', '2019-11-20 11:57:25'),
(8, 5, 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', 'Product Test Ru', '2019-11-20 11:57:25', '2019-11-20 11:57:25');

-- --------------------------------------------------------

--
-- Структура таблицы `product_discount`
--

CREATE TABLE `product_discount` (
  `product_discount_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_discount`
--

INSERT INTO `product_discount` (`product_discount_id`, `product_id`, `customer_group_id`, `quantity`, `priority`, `price`, `date_start`, `date_end`) VALUES
(1, 6, 1, 16, 1, 160, '2019-11-01', '2019-11-30'),
(2, 6, 1, 17, 2, 140, '2019-11-01', '2019-11-30'),
(3, 8, 1, 16, 2, 133, '2019-11-01', '2019-11-30');

-- --------------------------------------------------------

--
-- Структура таблицы `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 6, 'uploads/q6c2nzyh6RjrLZH1z77VtYdHmGKKF5Svkty04WFi.jpeg', 1, '2019-11-07 12:49:25', '2019-11-20 13:02:18'),
(3, 7, 'uploads/M3xvu6pxAnuAxQPXbRa5thtYjLMwNobB3wEBD1K5.jpeg', NULL, '2019-11-08 09:26:50', '2019-11-08 09:26:50');

-- --------------------------------------------------------

--
-- Структура таблицы `product_option`
--

CREATE TABLE `product_option` (
  `product_option_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_option`
--

INSERT INTO `product_option` (`product_option_id`, `product_id`, `option_id`, `option_value`, `required`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '125x324x34', 1, '2019-10-16 21:00:00', '2019-10-16 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `product_special`
--

CREATE TABLE `product_special` (
  `product_special_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_special`
--

INSERT INTO `product_special` (`product_special_id`, `product_id`, `customer_group_id`, `priority`, `price`, `date_start`, `date_end`) VALUES
(1, 6, 1, 1, 155, '2019-11-06', '2019-12-01'),
(2, 6, 1, 2, 145, '2019-11-01', '2019-12-01');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `title`, `text_info`, `language_id`, `published`, `created_at`, `updated_at`) VALUES
(1, 'Русский?', 'Русский      2', 1, 1, '2019-10-08 11:17:31', '2019-10-10 12:36:42'),
(1, 'English?', 'English', 2, 1, '2019-10-08 11:17:31', '2019-10-10 12:36:42'),
(1, 'Latviešu?', 'Latviešu2', 3, 1, '2019-10-08 11:17:31', '2019-10-10 12:36:42'),
(1, 'Eesti?', 'Eesti', 4, 1, '2019-10-08 11:17:31', '2019-10-10 12:36:42'),
(1, 'Lietuvių?', 'Lietuvių', 5, 1, '2019-10-08 11:17:31', '2019-10-10 12:36:42');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `region_name`, `language_id`) VALUES
(1, 'Донецкая обл.', 1),
(2, 'Киевская обл.', 1),
(3, 'Donetsk region', 2),
(4, 'Kiev region', 2),
(5, 'Донецька обл.', 3),
(6, 'Київська обл.', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` int(10) DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `user_tag_id` int(11) DEFAULT NULL,
  `user_sex_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `phone`, `address`, `city`, `index_address`, `country`, `region`, `remember_token`, `admin`, `customer_group_id`, `user_tag_id`, `user_sex_id`, `language_id`, `created_at`, `updated_at`) VALUES
(1, 'Александр Сергеевич', 'Швец', 'alexandr.shvets96@gmail.com', '35dc435ceb0f3482a85a5b39885e4741', '+380664606741', 'м-р Западный, 11', 'г. Мирноград', '85320', 1, 1, 'VXtNHBYNNatVa20WwyimixjgW3B0J6lzw7YvV3YEcATseGWLGtQGjd2VAbGf', 1, 2, 1, 1, 1, '2019-05-28 08:34:55', '2019-11-21 12:31:51'),
(7, 'Test', 'User', 'alexandr.shvets1996@gmail.com', '35dc435ceb0f3482a85a5b39885e4741', '+380664606741', 'Address', 'Mirnograd', '85320', 1, 1, '3iqNe03GPo3euTBC9KU1f1Nejq4YnXo1uzk3L6myM3P31pUuRpip6DMqOjxA', NULL, 1, 1, NULL, 0, '2019-11-22 13:18:50', '2019-11-22 14:04:11');

-- --------------------------------------------------------

--
-- Структура таблицы `user_filter`
--

CREATE TABLE `user_filter` (
  `user_filter_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_filter`
--

INSERT INTO `user_filter` (`user_filter_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Заказал 6 месяцев назад', NULL, '2019-11-21 11:43:02', '2019-11-21 11:43:02'),
(2, 'Заказал 12 месяцев назад', NULL, '2019-11-21 11:43:30', '2019-11-21 11:43:30');

-- --------------------------------------------------------

--
-- Структура таблицы `user_tag`
--

CREATE TABLE `user_tag` (
  `user_tag_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_tag`
--

INSERT INTO `user_tag` (`user_tag_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Новый', 'Новый клиент', '2019-11-21 11:19:59', '2019-11-21 11:23:55'),
(2, 'Состоятельный', '(один заказ от суммы 100 евро, авто)', '2019-11-21 11:20:27', '2019-11-21 11:20:27'),
(3, 'Нежелательный', 'Нежелательный', '2019-11-21 11:24:40', '2019-11-21 11:24:40'),
(4, 'Любимый', 'Любимый', '2019-11-21 11:24:50', '2019-11-21 11:24:50'),
(5, 'Постоянный', '(заказывал 2 и более раз, присваивать авто)', '2019-11-21 11:25:07', '2019-11-21 11:25:07'),
(6, 'Юр. лицо', 'Юр. лицо', '2019-11-21 11:25:21', '2019-11-21 11:25:21'),
(7, 'Партнер/специалист', 'Партнер/специалист', '2019-11-21 11:25:34', '2019-11-21 11:25:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`customer_group_id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `option_value`
--
ALTER TABLE `option_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `option_value_description`
--
ALTER TABLE `option_value_description`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`product_discount_id`);

--
-- Индексы таблицы `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Индексы таблицы `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`product_option_id`);

--
-- Индексы таблицы `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`product_special_id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_filter`
--
ALTER TABLE `user_filter`
  ADD PRIMARY KEY (`user_filter_id`);

--
-- Индексы таблицы `user_tag`
--
ALTER TABLE `user_tag`
  ADD PRIMARY KEY (`user_tag_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `customer_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `option_value`
--
ALTER TABLE `option_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `option_value_description`
--
ALTER TABLE `option_value_description`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `product_discount_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `product_option`
--
ALTER TABLE `product_option`
  MODIFY `product_option_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `product_special`
--
ALTER TABLE `product_special`
  MODIFY `product_special_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `user_filter`
--
ALTER TABLE `user_filter`
  MODIFY `user_filter_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user_tag`
--
ALTER TABLE `user_tag`
  MODIFY `user_tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
