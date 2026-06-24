-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 03, 2026 lúc 01:36 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `b4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(20,2) NOT NULL,
  `total` decimal(20,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(2, 1, 15, 2, 19720000.00, 39440000.00, '2025-10-15 08:49:49', '2025-10-22 01:34:29'),
(6, 1, 19, 2, 16490000.00, 32980000.00, '2025-10-22 01:54:26', '2025-10-22 02:03:20'),
(7, 1, 12, 1, 27980000.00, 27980000.00, '2025-10-22 02:52:23', '2025-10-22 02:52:23'),
(8, 1, 7, 1, 24990000.00, 24990000.00, '2025-10-22 03:24:52', '2025-10-22 03:24:52'),
(10, 11, 17, 1, 21355000.00, 21355000.00, '2026-04-03 11:27:51', '2026-04-03 11:34:18'),
(11, 11, 21, 1, 16190000.00, 16190000.00, '2026-04-03 11:33:35', '2026-04-03 11:33:35'),
(12, 11, 16, 1, 16490000.00, 16490000.00, '2026-04-03 11:34:09', '2026-04-03 11:34:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parentid`, `created_at`, `updated_at`) VALUES
(1, 'dtdd', NULL, '2025-10-01 03:16:20', '2025-10-01 03:16:20'),
(2, 'Laptop', NULL, '2025-10-01 03:16:47', '2025-10-01 03:16:47'),
(3, 'Phụ kiện', NULL, '2025-10-01 03:17:10', '2025-10-01 03:17:10'),
(4, 'Smartwatch', NULL, '2025-10-01 03:17:44', '2025-10-01 03:17:44'),
(5, 'Đồng hồ', NULL, '2025-10-01 03:18:05', '2025-10-01 03:18:05'),
(6, 'iphone', 1, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(7, 'Samsung', 1, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(8, 'Oppo', 1, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(9, 'Vivo', 1, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(10, 'MacBook', 2, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(11, 'Dell', 2, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(12, 'Hp', 2, '2025-10-07 14:26:28', '2025-10-07 14:26:28'),
(13, 'Asus', 2, '2025-10-07 14:26:28', '2025-10-07 14:26:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `display` bit(1) DEFAULT b'1',
  `stt` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `parentid`, `catid`, `display`, `stt`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', '/', NULL, NULL, b'1', 0, '2025-09-10 03:48:44', '2025-09-16 19:03:03'),
(2, 'Điện thoại', 'dtdd', NULL, 1, b'1', 0, '2025-09-17 01:25:44', '2025-09-17 01:25:44'),
(3, 'Laptop', 'laptop', NULL, 2, b'1', 0, '2025-09-16 18:57:07', '2025-09-16 18:57:07'),
(4, 'Phụ kiện', 'phu-kien', NULL, 3, b'1', 0, '2025-09-16 18:58:26', '2025-09-16 18:58:26'),
(5, 'Smartwatch', 'dong-ho-thong-minh', NULL, 4, b'1', 0, '2025-10-01 00:55:52', '2025-10-01 00:55:52'),
(6, 'Đồng hồ', 'dong-ho', NULL, 5, b'1', 0, '2025-10-01 00:56:23', '2025-10-01 00:56:23'),
(7, 'iphone', 'iphone', 2, 6, b'1', 0, '2025-10-01 03:25:12', '2025-10-01 03:25:12'),
(8, 'Samsung', 'samsung', 2, 7, b'1', 0, '2025-10-01 03:25:49', '2025-10-01 03:25:49'),
(9, 'Oppo', 'oppo', 2, 8, b'1', 0, '2025-10-01 03:26:47', '2025-10-01 03:26:47'),
(10, 'Vivo', 'vivo', 2, 9, b'1', 0, '2025-10-01 03:27:09', '2025-10-01 03:27:09'),
(11, 'MacBook', 'macbook', 3, 10, b'1', 0, '2025-10-01 03:28:10', '2025-10-01 03:28:10'),
(12, 'Dell', 'dell', 3, 11, b'1', 0, '2025-10-01 03:28:30', '2025-10-01 03:28:30'),
(13, 'Hp', 'hp', 3, 12, b'1', 0, '2025-10-01 03:28:44', '2025-10-01 03:28:44'),
(14, 'Asus', 'asus', 3, 13, b'1', 0, '2025-10-01 03:28:57', '2025-10-01 03:28:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `detail` text DEFAULT NULL,
  `color` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`color`)),
  `catid` int(11) DEFAULT 1,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `parent_id`, `price`, `detail`, `color`, `catid`, `img`, `created_at`, `updated_at`) VALUES
(1, 'realme C75 8GB/128GB', 'realme-c75-8gb-128gb', NULL, 4990000, 'Màn hình: IPS LCD 6.72\" Full HD+\nChip: Snapdragon 685\nRAM: 8 GB\nBộ nhớ: 128 GB\nCamera: 50MP\nPin: 5000 mAh, Sạc 33W', '[\"Xanh\", \"Đen\"]', 1, 'https://cdn.tgdd.vn/Products/Images/42/325833/realme-c75-xanh-thumb.jpg', '2025-10-07 13:28:13', '2025-10-07 13:28:13'),
(2, 'vivo V40 Lite 8GB/256GB', 'vivo-v40-lite-8gb-256gb', NULL, 8340000, 'Màn hình: 6.67\" Full HD+; Chip: Snapdragon 685 8 nhân; RAM: 8 GB; ROM: 256 GB; Hệ điều hành: Android 14', '[]', 9, 'https://cdn.tgdd.vn/Products/Images/42/329959/vivo-v40-lite-tim-thumb-600x600.jpg', '2025-10-07 13:31:09', '2025-10-07 13:31:09'),
(3, 'iPhone 16e 256GB', 'iphone-16e-256gb', 4, 19590000, 'Màn hình: ~6,1\" Super Retina XDR; Chip: Apple A18; RAM: 8 GB; ROM: 256 GB', '[\"Trắng\", \"Đen\"]', 6, 'https://cdn.tgdd.vn/Products/Images/42/334865/iphone-16e-trang-thumb-1-600x600.jpg', '2025-10-07 13:33:10', '2025-10-07 13:33:10'),
(4, 'iPhone 16e 128GB', 'iphone-16e-128gb', NULL, 15990000, 'Chip: Apple A18 6 lõi; RAM: 8 GB; ROM: 128 GB; Màu: Trắng, Đen', '[\"Trắng\", \"Đen\"]', 6, 'https://cdn.tgdd.vn/Products/Images/42/334865/iphone-16e-trang-thumb-1-600x600.jpg', '2025-10-07 13:34:32', '2025-10-07 13:34:32'),
(5, 'iPhone 16e 512GB', 'iphone-16e-512gb', 4, 25590000, 'Chip: Apple A18; RAM: 8 GB; ROM: 512 GB; Màu: Trắng, Đen', '[\"Trắng\", \"Đen\"]', 6, 'https://cdn.tgdd.vn/Products/Images/42/334865/iphone-16e-trang-thumb-1-600x600.jpg', '2025-10-07 13:37:09', '2025-10-07 13:37:09'),
(6, 'iPhone 17 Pro 256GB', 'iphone-17-pro', NULL, 34990000, 'Chip: Apple A19 Pro; RAM: 12 GB; ROM: 256 GB; Màn hình: 6,3\" ProMotion 120 Hz; Camera: 3×48 MP; Màu: Cam Vũ Trụ, Bạc, Xanh Đậm', '[\"Cam Vũ Trụ\", \"Bạc\", \"Xanh Đậm\"]', 6, 'https://cdn.tgdd.vn/Products/Images/42/342676/iphone-17-pro-cam-thumb-600x600.jpg', '2025-10-07 13:38:31', '2025-10-07 13:38:31'),
(7, 'iPhone 17 256GB', 'iphone-17', NULL, 24990000, 'Chip: Apple A19 Pro; RAM: 12 GB; ROM: 256 GB; Màn hình: 6,3\" ProMotion 120 Hz; Camera: 3×48 MP; Màu: Cam Vũ Trụ, Bạc, Xanh Đậm', '[\"Cam Vũ Trụ\", \"Bạc\", \"Xanh Đậm\"]', 6, 'https://cdn.tgdd.vn/Products/Images/42/342667/iphone-17-xanh-duong-thumb-2-600x600.jpg', '2025-10-07 13:40:22', '2025-10-07 13:40:22'),
(8, 'Samsung Galaxy S25 FE 5G 8GB/128GB', 'samsung-galaxy-s25-fe-5g-8gb-128gb', NULL, 14390000, 'Chip: Exynos 2400 10 nhân; RAM: 8 GB; ROM: 128 GB; Camera: sau 50 MP + 12 MP + 8 MP; Camera trước: 12 MP; Pin: 4900 mAh, sạc 45 W', '[\"Navy\", \"Jetblack\", \"Icyblue\", \"White\"]', 7, 'https://cdn.tgdd.vn/Products/Images/42/342560/samsung-galaxy-s25-fe-blue-thumbai-600x600.jpg', '2025-10-07 13:50:47', '2025-10-07 13:50:47'),
(9, 'Samsung Galaxy S25 FE 5G 8GB/256GB', 'samsung-galaxy-s25-fe-5g-8gb-256gb', 9, 18490000, 'Chip: Exynos 2400 10 nhân; RAM: 8 GB; ROM: 256 GB; Camera sau: 50 MP + 12 MP + 8 MP; Camera trước: 12 MP', '[\"Navy\", \"Jetblack\", \"Icyblue\", \"White\"]', 7, 'https://cdn.tgdd.vn/Products/Images/42/342560/samsung-galaxy-s25-fe-blue-thumbai-600x600.jpg', '2025-10-07 13:52:23', '2025-10-07 13:52:23'),
(10, 'Samsung Galaxy A17 5G 8GB/128GB', 'samsung-galaxy-a17-5g-8gb-128gb', NULL, 6190000, 'Màn hình: Super AMOLED 6,7\" Full HD+; Chip: Exynos 1330; RAM: 8 GB; ROM: 128 GB', '[\"Xanh\", \"Xám\", \"Đen\"]', 7, 'https://cdn.tgdd.vn/Products/Images/42/341688/galaxy-a17-5g-gray-thumbai-600x600.jpg', '2025-10-07 13:53:32', '2025-10-07 13:53:32'),
(11, 'Samsung Galaxy A07 4GB/64GB', 'samsung-galaxy-a07-4gb-64gb', NULL, 3090000, 'Hệ điều hành: Android 15; Chip: MediaTek Helio G99; RAM: 4 GB; ROM: 64 GB; Camera sau: 50 MP + 2 MP; Camera trước: 8 MP; Pin: ~5000 mAh; Sạc: 25 W', '[]', 7, 'https://cdn.tgdd.vn/Products/Images/42/341802/samsung-galaxy-a07-violet-thumb-600x600.jpg', '2025-10-07 13:55:23', '2025-10-07 13:55:23'),
(12, 'Samsung Galaxy S25 Ultra 5G 12GB/256GB', 'samsung-galaxy-s25-ultra-12gb-256gb', NULL, 27980000, 'Màn hình: Dynamic AMOLED 2X 6,9\" (3120×1440); RAM: 12 GB; ROM: 256 GB; Chip: Snapdragon 8 Elite For Galaxy; Hệ điều hành: One UI 7 (Android 15)', '[\"Xanh Dương\", \"Trắng/Bạc\", \"Xám\", \"Đen\"]', 7, 'https://cdn.tgdd.vn/Products/Images/42/333347/samsung-galaxy-s25-ultra-blue-thumbai-600x600.jpg', '2025-10-07 13:57:06', '2025-10-07 13:57:06'),
(13, 'Samsung Galaxy Z Fold7 5G 12GB/256GB', 'samsung-galaxy-z-fold7-12gb-256gb', NULL, 44990000, 'Camera chính 200 MP; Màn hình gập + màn hình ngoài; Thiết kế mỏng nhẹ; RAM: 12 GB; ROM: 256 GB', '[\"Xanh Navy\", \"Xám Metal\", \"Đen Jet\", \"Xanh Mint\"]', 7, 'https://cdn.tgdd.vn/Products/Images/42/338738/samsung-galaxy-z-fold7-black-thumb-1-600x600.jpg', '2025-10-07 13:59:16', '2025-10-07 13:59:16'),
(14, 'HP 15 fc0085AU R5 7430U (A6VV8PA)', 'hp-15-fc0085au-r5-7430u-a6vv8pa', NULL, 12990000, 'CPU: AMD Ryzen 5 7430U (6 nhân / 12 luồng, 2.30-4.30 GHz); RAM: 16 GB DDR4; SSD: 512 GB NVMe PCIe; Màn hình: 15,6\" Full HD chống chói; Pin: 3-cell 41 Wh; Hệ điều hành: Windows 11 Home SL; Kích thước: 359,8 × 236 × 18,6 mm; Khối lượng: ~1,59 kg', '[]', 12, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/327098/hp-15-fc0085au-r5-a6vv8pa-170225-110652-878-600x600.jpg', '2025-10-07 14:10:41', '2025-10-07 14:10:41'),
(15, 'Asus Vivobook Go 15 E1504FA R5 7520U (NJ776W)', 'asus-vivobook-go-15-e1504fa-r5-nj776w', NULL, 19720000, 'CPU: AMD Ryzen 5 7520U; RAM: 16 GB; SSD: 512 GB NVMe; Màn hình: 15,6\" Full HD; Hệ điều hành: Windows 11', '[]', 13, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/311178/asus-vivobook-go-15-e1504fa-r5-nj776w-140225-100949-251-600x600.jpg', '2025-10-07 14:11:38', '2025-10-07 14:11:38'),
(16, 'Dell Inspiron 15 3530 i5 N5I5530W1', 'dell-inspiron-15-3530-i5-n5i5530w1', NULL, 16490000, 'CPU: Intel Core i5 thế hệ 13 (10 nhân / 12 luồng); Màn hình: 15,6\" FHD 120 Hz; RAM: 16 GB DDR4; SSD: 512 GB NVMe; Pin: 41 Wh hoặc 54 Wh tùy cấu hình', '[]', 11, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/334803/dell-inspiron-15-3530-i5-n5i5530w1-thumb-638762534676491196-600x600.jpg', '2025-10-07 14:12:49', '2025-10-07 14:12:49'),
(17, 'Lenovo IdeaPad Slim 3 15IRH10 (83K1000HVN)', 'lenovo-ideapad-slim-3-15irh10-83k1000hvn', NULL, 21355000, 'CPU: Intel Core i5-13420H; RAM: 16 GB; SSD: 512 GB; Màn hình: 15,3\" WUXGA; Hệ điều hành: Windows 11; Thiết kế mỏng nhẹ (~1,62kg, dày ~17,9 mm)', '[]', 2, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/334442/lenovo-ideapad-slim-3-15irh10-i5-83k1000hvn-638775478046964172-600x600.jpg', '2025-10-07 14:13:31', '2025-10-07 14:13:31'),
(18, 'MacBook Air 13 inch M4 16GB/256GB', 'macbook-air-13-m4-16gb-256gb', NULL, 24290000, 'Màn hình: 13,6\" Liquid Retina; RAM: 16 GB; SSD: 256 GB; Chip: Apple M4; Pin: ~53,8 Wh; Thiết kế mỏng nhẹ, trọng lượng thấp', '[]', 10, 'https://cdn.tgdd.vn/Products/Images/44/335362/macbook-air-13-inch-m4-xanh-den-600x600.jpg', '2025-10-07 14:17:18', '2025-10-07 14:17:18'),
(19, 'Dell Inspiron 15 3520 i5 1235U (25P231)', 'dell-inspiron-15-3520-i5-25p231', NULL, 16490000, 'CPU: Intel Core i5-1235U (10 nhân / 12 luồng); RAM: 16 GB DDR4; SSD: 512 GB NVMe; Màn hình: 15,6\" Full HD 120 Hz chống chói; Pin: 41 Wh; Kích thước: 358,5 × 235,56 × 18,99 mm; Trọng lượng: ~1,9 kg; Hệ điều hành: Windows 11 Home + Office HS 2021', '[]', 11, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/321192/dell-inspiron-15-3520-i5-25p231-thumb-638754902669914908-600x600.jpg', '2025-10-07 14:18:55', '2025-10-07 14:18:55'),
(20, 'Lenovo Ideapad Slim 3 15AMN8 (82XQ00J0VN)', 'lenovo-ideapad-slim-3-15amn8-82xq00j0vn', NULL, 11990000, 'CPU: AMD Ryzen 5 7520U (4 nhân / 8 luồng); RAM: 16 GB; SSD: 512 GB; Màn hình: 15,6\" Full HD; Hệ điều hành: Windows 11', '[]', 2, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/325500/lenovo-ideapad-slim-3-15amn8-r5-82xq00j0vn-thumb-638754862828598408-600x600.jpg', '2025-10-07 14:19:28', '2025-10-07 14:19:28'),
(21, 'HP 240 G10 i5 B93GZAT', 'hp-240-g10-i5-b93gzat', NULL, 16190000, 'CPU: Intel Core i5-1334U; RAM: 16 GB DDR4; SSD: 512 GB NVMe; Màn hình: 14\" Full HD chống chói; Hệ điều hành: Windows 11 Home SL', '[\"Bạc\"]', 12, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/338207/hp-240-g10-i5-b93gzat-638851478028822363-600x600.jpg', '2025-10-07 14:20:09', '2025-10-07 14:20:09'),
(22, 'Asus Vivobook 15 X1504VA i3 NJ1634W', 'asus-vivobook-15-x1504va-i3-nj1634w', NULL, 10180000, 'CPU: Intel Core i3-1315U (6 nhân / 8 luồng); RAM: 8 GB; SSD: 512 GB; Màn hình: 15,6\" Full HD; Hệ điều hành: Windows 11', '[]', 13, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/44/334792/asus-vivobook-15-x1504va-i3-nj1634w-thumb-638760891054481940-600x600.jpg', '2025-10-07 14:20:46', '2025-10-07 14:20:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8BIKyMJmxkhTJMyxqnpvQ4JNV1EhtFf4TGOWripH', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibzlMNDQxenNMeUp5VU5SQklTZ2ZXVDlKdkhQNVVIQ2lWU1NTQnI2ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0IjtzOjU6InJvdXRlIjtzOjk6ImhvbWUuY2FydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1775216058),
('aLjOQ0D0dNcBx5benJI2DaP5Q7KO3urVma1UTdA7', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUprenlKdWJkakpxM3BBaWtGaWRNVTdsdTVJNG5EUlhOZ3M3bU82RiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIxIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612997),
('Fm63JYnVFHFBVbZP0L28v7zgELoBEOqqKUc4n14U', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzhVTFVKanVFV29wWUhjc2phc2hRSnRsbVU4Nm1MNDNoSUFGQWNvSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaG9tZS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1772457332),
('gQVoPCsSU8X7jomPRqm6AerzdhzzpnOTbqcfEbBf', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNXpEU3BKRlJBQm00dGpmdllVS1JjMm83ZkM1eTcyamFseXYzWFNZUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIwIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612704),
('JBJ0lvtkBbf6YjBIWafGGnpvKX4vbVItYOrxl4hU', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR2dZcW5TVXplNlNKNkdlRmVCeUxQOUtJeTVYYjFIcUxqU2poaDdQZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIxIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612702),
('jupY1qFTWgsgY6blcKtx73Y5vlHhlokm7HGMcNll', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWRhRmxUZWxJVENUb1ZDN0o5aDRvd1JQU3lFUDNQMko4UFFJcjJhRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8xOSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzE5IjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774611724),
('nmKQtbB2KebM1U0NiSak1hVDKGxWzzKp6I8mtOwj', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2l3UE1GRFZUenBrSW5LYUVEOTZoSmFGWWptMm9EV0pudmF5ZGhKaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIwIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612999),
('PE8kAdsVINX0zjyLZ5U7SFj5xpSFVfvzyrqfRtEX', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3RmRkdBdFNjdEZBM0ttRW5Fa0todXU5VTEwN3lpQjYzVWtCcUdETyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8xOSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzE5IjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774611726),
('veCBS65YzwvJZ4nhqB0x0BdQXvFc3ffcsD4yyvcV', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia3N3ZjdKbmdLdU96UWx1TzBUemRWSUFMTlBJaU1JWXFCVE1KcUptVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIwIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612999),
('waPEZpIfNR9S91MqORp8hmapSCAblGAk3PPUz6q6', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiblVmSmw2YUNDbk1oMDFhSDliRldhc3JRM3FVZ3FtcHpCNkhxTnlpeiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIxIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612703),
('Xcl56nmW2CDT5JrL2GTZWN5wRfEl4pr85kOoCnOX', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQnUxWDh6d1pRWHIyTk0xSXg2MjdLb3BBbTJZU0g2eXNoVTJUODRUbyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9iNC9wdWJsaWMvdGhlbS1zcC1naC8yMCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2I0L3B1YmxpYy90aGVtLXNwLWdoLzIwIjtzOjU6InJvdXRlIjtzOjEyOiJjYXJ0LmFkZGNhcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774612999),
('zWf81YnIA7IWtwdemIQBjR8y3cWLvE6WaR6LhID9', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWNUNVFCRVFSSnUzMWtXZ1hSdnBEV3dHWHZZVmlEaTlrYTVlVG9BcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pcGhvbmUvaXBob25lLTE3LTcuaHRtbCI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdC5kZXRhaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZ2lvLWhhbmciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1774613660);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '2025-10-14 18:01:43', '$2y$12$E79qgkE2N9IRqM4DcSPdb.15.pJMEIzKZan4tmXJmZi6bgb5WYNWK', 'dx9rrUaBsHlTAh6ry2OLccKWp5DNIcIXH4QpKUbfaGVlA3Vycdkc9diaVaJX', '2025-10-14 18:01:44', '2025-10-14 18:01:44'),
(2, 'trieu', 'trieu@gmail.com', NULL, '$2y$12$TXL6eEG6Zj4tKKYfDY8RROS.IHlBHNdmsJrmey6.20U68Wi6a8YMG', NULL, '2026-03-02 06:00:35', '2026-03-02 06:00:35'),
(3, 'âsas', 'aa@gmail.com', NULL, '$2y$12$ddGQs7bTyVBCqehFzFqLpuAJcQyN1U5/61Dlx5hD1HnIcppKdsMli', NULL, '2026-03-02 06:08:01', '2026-03-02 06:08:01'),
(4, 'Deptraibodoithe Triều', 'trieudeptraithe@gmail.com', NULL, '$2y$12$x3MXZAs12vgSwOoKdf0IEev1nbRcGteXh4olIQg2nOUXLk9wtHxJe', NULL, '2026-03-02 06:08:51', '2026-03-02 06:08:51'),
(6, 'trieu', 'trieu1@gmail.com', NULL, '$2y$12$6jArZrfRr2Nbl3nv0/kEuekJa2sfMv7bu1EB5WbLBPNlJdqim4uBa', NULL, '2026-03-27 05:01:14', '2026-03-27 05:01:14'),
(7, 'trieu1234', 'trieu123@gmail.com', NULL, '$2y$12$U0B947v8LN0YnKA249qwg.ROL7gHFSpyK9tyR8M1UCYXggmyCquVy', NULL, '2026-03-27 05:02:42', '2026-03-27 05:02:42'),
(8, 'trieu12345678', 'trieu123456782@gmail.com', NULL, '$2y$12$sxO7Wnu0t/gaDluzUhvfVeM.9tXwu7Uf76DIFl9b2MU4lHmwZgbHO', NULL, '2026-04-03 04:23:46', '2026-04-03 04:23:46'),
(10, 'trieu', 'trieudeptrai@gmail.com', NULL, '$2y$12$TXsVNnD6yJtPJFqd8GPHbe41CXyp9SnTsra1i/Q6XC9.oVt3U347u', NULL, '2026-04-03 04:25:44', '2026-04-03 04:25:44'),
(11, 'trieuchowyz', 'nguyenvantrieu1234@gmail.com', NULL, '$2y$12$I8lkegIDq15wAd33rTUnR.Hq5nSRAd7tOkkmy9IdMEIGov1f9MTLm', NULL, '2026-04-03 04:26:50', '2026-04-03 04:26:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_categories` (`catid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories` (`catid`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menu_categories` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
