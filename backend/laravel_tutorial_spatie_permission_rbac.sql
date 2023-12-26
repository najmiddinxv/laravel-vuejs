-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2023 at 12:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `category_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_type`, `name`, `icon`, `image`, `order`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '{\"uz\":\"Sport yangiliklari\",\"ru\":\"Спортивные новости\",\"en\":\"Sports news\"}', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, '{\"uz\":\"Mahalliy yangiliklar\",\"ru\":\"Местные новости\",\"en\":\"Local news\"}', NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, '{\"uz\":\"Xorij yangiliklari\",\"ru\":\"Зарубежные новости\",\"en\":\"Foreign news\"}', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_15_173953_create_categories_table', 1),
(6, '2023_10_16_163224_create_posts_table', 1),
(7, '2023_10_26_153623_create_notifications_table', 1),
(8, '2023_11_01_160120_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(11, 'App\\Models\\User', 3),
(12, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Create', 'web', '2023-11-06 11:15:15', '2023-11-06 11:15:15'),
(2, 'Create', 'api', '2023-11-06 11:15:15', '2023-11-06 11:15:15'),
(3, 'Update', 'web', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(4, 'Update', 'api', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(5, 'Delete', 'web', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(6, 'Delete', 'api', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(7, 'Modify', 'web', '2023-11-06 11:15:15', '2023-11-06 11:15:15'),
(8, 'Modify', 'api', '2023-11-06 11:15:15', '2023-11-06 11:15:15'),
(9, 'Publish', 'web', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(10, 'Publish', 'api', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(11, 'View', 'web', '2023-11-06 11:15:55', '2023-11-06 11:15:55'),
(12, 'View', 'api', '2023-11-06 11:15:55', '2023-11-06 11:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `slug`, `description`, `body`, `image`, `view_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '\"Possimus rerum consequatur voluptas necessitatibus vitae.\"', 'possimus-rerum-consequatur-voluptas-necessitatibus-vitae', 'Dolorum sunt aut ea enim et.', 'At voluptates porro qui placeat sed soluta id reprehenderit. Magnam possimus nam consectetur alias. Tenetur fugiat ut laboriosam in.', 'https://via.placeholder.com/400x400.png/00ddee?text=optio', 495, 2, '2023-11-06 09:22:44', '2023-11-06 09:22:44'),
(2, 3, '\"Est incidunt qui consequatur deserunt nihil minima.\"', 'est-incidunt-qui-consequatur-deserunt-nihil-minima', 'Dolore soluta consequatur reprehenderit labore.', 'Harum incidunt similique magni tempore dolore. Voluptas aut error velit architecto id vel. Labore velit in eum delectus quod voluptates cupiditate. A possimus suscipit rerum consequatur aut molestiae.', 'https://via.placeholder.com/400x400.png/0033aa?text=ipsa', 926, 3, '2023-11-06 09:22:44', '2023-11-06 09:22:44'),
(3, 3, '\"Possimus nihil ab aliquid et aut omnis.\"', 'possimus-nihil-ab-aliquid-et-aut-omnis', 'Voluptatem totam omnis quo suscipit.', 'Placeat magni earum perferendis officiis magni hic sunt. At sint laudantium quod ut. Et molestias sed aliquam libero unde aut qui quas. Ut vel expedita perspiciatis repellat quas dicta.', 'https://via.placeholder.com/400x400.png/0088ff?text=maxime', 368, 0, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(4, 3, '\"Rem omnis voluptas dolores tempore officiis sed.\"', 'rem-omnis-voluptas-dolores-tempore-officiis-sed', 'Debitis fuga non deleniti assumenda accusantium aut.', 'Quibusdam voluptate est quo at est. Aut accusantium laudantium tempora similique et aperiam. Eos et iste dolor.', 'https://via.placeholder.com/400x400.png/009933?text=ad', 299, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(5, 2, '\"Ex accusamus nam quas est omnis totam.\"', 'ex-accusamus-nam-quas-est-omnis-totam', 'Vero est et a molestias aliquam cumque qui veniam.', 'Tempore illo reiciendis id magni impedit in. Reiciendis reprehenderit cum eaque ut. Dolores beatae optio facere et velit et. Eligendi quasi quam nisi ut ad vitae qui.', 'https://via.placeholder.com/400x400.png/00aa66?text=nemo', 765, 3, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(6, 3, '\"Totam facilis ut voluptas odio.\"', 'totam-facilis-ut-voluptas-odio', 'Voluptas aspernatur quos est non itaque quia explicabo.', 'Qui in voluptatum omnis quia ut ad odit. Aspernatur quod natus laborum et fugit. Aut aut nam consectetur qui et.', 'https://via.placeholder.com/400x400.png/006644?text=aliquid', 876, 3, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(7, 3, '\"Non dolorum id nam maxime libero et similique.\"', 'non-dolorum-id-nam-maxime-libero-et-similique', 'Perferendis magnam rerum quam beatae ut earum maxime.', 'Dicta dolores possimus odit atque. Ut in magnam velit dolorum eveniet. Numquam omnis nihil nihil maxime provident.', 'https://via.placeholder.com/400x400.png/000000?text=ipsum', 236, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(8, 3, '\"Quia quis quae hic.\"', 'quia-quis-quae-hic', 'Quis quae velit ratione ut cum earum.', 'Aperiam dignissimos enim quidem iure. Eligendi magnam laboriosam quaerat id omnis. Exercitationem ut harum repellendus in molestias qui et eum. Et voluptas non aspernatur aspernatur eaque. Voluptatem non eligendi cumque quia ex odio.', 'https://via.placeholder.com/400x400.png/007700?text=nihil', 790, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(9, 3, '\"Soluta voluptatem debitis laboriosam aperiam ipsa et delectus.\"', 'soluta-voluptatem-debitis-laboriosam-aperiam-ipsa-et-delectus', 'Cum nihil quia facere deleniti excepturi.', 'Nesciunt vitae ratione voluptatem quod et ipsum architecto. Nam magni aliquid soluta ut. Aliquam ipsa similique aut beatae soluta sit impedit ad. Accusamus autem velit vero nemo quos iusto.', 'https://via.placeholder.com/400x400.png/002222?text=non', 765, 2, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(10, 2, '\"Voluptas ea consequatur omnis corporis voluptates inventore quis.\"', 'voluptas-ea-consequatur-omnis-corporis-voluptates-inventore-quis', 'Nihil rerum aliquid nemo illum quaerat reiciendis.', 'Saepe libero labore voluptatem sed. Beatae et laboriosam aut dignissimos. Et tenetur repellendus soluta nemo.', 'https://via.placeholder.com/400x400.png/003388?text=iusto', 730, 2, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(11, 3, '\"Dolorum aut dignissimos dolorum alias temporibus quia.\"', 'dolorum-aut-dignissimos-dolorum-alias-temporibus-quia', 'Ea possimus assumenda quidem omnis corrupti nesciunt explicabo.', 'Optio culpa illum porro. Voluptatem repudiandae tenetur ab est saepe. Nemo eos dolorem molestias molestias neque. Ipsam pariatur ab cum quibusdam illo voluptatum consequatur.', 'https://via.placeholder.com/400x400.png/0000aa?text=ea', 713, 3, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(12, 2, '\"Asperiores aut velit tempora quod repellat incidunt.\"', 'asperiores-aut-velit-tempora-quod-repellat-incidunt', 'Qui eum voluptate sit molestiae delectus quo.', 'Quis sit hic nulla omnis dicta aut. Earum corrupti earum voluptatem odit modi omnis. Assumenda illum consequatur quas impedit ut deleniti.', 'https://via.placeholder.com/400x400.png/001122?text=rem', 657, 2, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(13, 3, '\"Et quaerat maiores omnis delectus.\"', 'et-quaerat-maiores-omnis-delectus', 'Dolores ut dolore quisquam repudiandae.', 'Id dolores voluptatem unde rerum. Dolor delectus natus non incidunt sequi. Dicta vel doloribus repellat atque quod quo id. Vel blanditiis velit vel commodi delectus recusandae et.', 'https://via.placeholder.com/400x400.png/0055aa?text=voluptates', 847, 3, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(14, 1, '\"Eligendi praesentium repellat aut consequuntur beatae maxime.\"', 'eligendi-praesentium-repellat-aut-consequuntur-beatae-maxime', 'Earum quo placeat illo unde.', 'Sed omnis minima nulla earum rem. Voluptas quia illo et exercitationem consequatur eveniet. Aut expedita quis omnis tempore iure aperiam architecto. Quod accusamus dolores ut totam dolores asperiores.', 'https://via.placeholder.com/400x400.png/0022dd?text=aut', 809, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(15, 2, '\"Quia voluptatem harum quasi.\"', 'quia-voluptatem-harum-quasi', 'Quae voluptatem dignissimos dolorem animi aut.', 'Dolore dolorem maiores illum cupiditate pariatur. Ducimus vitae reprehenderit iste sit beatae pariatur doloremque numquam. Maxime eos voluptatem molestiae eligendi modi veniam. Autem omnis sequi aspernatur dolores sit dolor molestias.', 'https://via.placeholder.com/400x400.png/005588?text=ea', 795, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(16, 1, '\"Sit aut aut omnis quibusdam.\"', 'sit-aut-aut-omnis-quibusdam', 'Iusto possimus velit illo quas magni in.', 'Odio voluptatem similique iusto accusamus. Qui ut culpa culpa eveniet consectetur itaque quo. Nesciunt alias et vitae et.', 'https://via.placeholder.com/400x400.png/00aa33?text=ut', 231, 1, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(17, 3, '\"Qui quos omnis libero iure veritatis et.\"', 'qui-quos-omnis-libero-iure-veritatis-et', 'Dolores illo voluptatem consequatur nihil cum.', 'A eveniet voluptas qui ex et. Suscipit eius porro sunt a quia voluptates accusantium.', 'https://via.placeholder.com/400x400.png/00ddee?text=nisi', 357, 3, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(18, 1, '\"Beatae minima modi eaque ea quia.\"', 'beatae-minima-modi-eaque-ea-quia', 'Sequi est aut quia ea quia.', 'Voluptates mollitia non sed iusto. Voluptate iusto qui qui autem. Officia vel rerum ut quasi deserunt est nisi. Voluptate est aliquid rem et architecto beatae.', 'https://via.placeholder.com/400x400.png/008899?text=quia', 240, 2, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(19, 3, '\"Rem velit qui suscipit eum assumenda quia architecto minima.\"', 'rem-velit-qui-suscipit-eum-assumenda-quia-architecto-minima', 'Voluptatem nostrum sint vel et quod ea ut.', 'Dolorem adipisci consequatur omnis dolore at natus sit. Numquam sint et aut eos quod non. Natus eos ut animi fugiat. Quae non nisi reprehenderit voluptatem rem voluptates deserunt laborum.', 'https://via.placeholder.com/400x400.png/00ee66?text=sed', 241, 0, '2023-11-06 09:22:45', '2023-11-06 09:22:45'),
(20, 2, '\"Placeat beatae velit voluptatum a vitae.\"', 'placeat-beatae-velit-voluptatum-a-vitae', 'Rerum exercitationem libero reiciendis quasi et quisquam placeat.', 'Minus sint non enim aspernatur. Ut omnis repellendus magni qui. Ut sapiente ea rerum cupiditate commodi consequatur. Et nostrum quis assumenda autem rerum.', 'https://via.placeholder.com/400x400.png/00dd88?text=sunt', 93, 2, '2023-11-06 09:22:45', '2023-11-06 09:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-11-06 11:13:43', '2023-11-06 11:13:43'),
(2, 'Admin', 'api', '2023-11-06 11:13:43', '2023-11-06 11:13:43'),
(3, 'Manager', 'web', '2023-11-06 11:14:18', '2023-11-06 11:14:18'),
(4, 'Manager', 'api', '2023-11-06 11:14:18', '2023-11-06 11:14:18'),
(5, 'User', 'web', '2023-11-06 11:14:18', '2023-11-06 11:14:18'),
(6, 'User', 'api', '2023-11-06 11:14:18', '2023-11-06 11:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(5, 1),
(7, 1),
(9, 1),
(11, 1),
(2, 2),
(4, 2),
(6, 2),
(8, 2),
(10, 2),
(12, 2),
(9, 3),
(11, 3),
(8, 4),
(10, 4),
(11, 5),
(12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
