-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table base_ecommerce.cart: 1 rows
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`id`, `code`, `qa_code`, `user_id`, `amount`, `status`, `state`, `address`, `delivery_date`, `created_at`, `updated_at`) VALUES
	(1, 'AAAABBBBSDJWDBUIASHDLBSB2132432', 'qrcode.png', 2, 56000, 1, 1, 'Ha Noi sad', NULL, '2021-04-14 09:44:54', '2021-04-14 04:33:37');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.cart_detail: 8 rows
DELETE FROM `cart_detail`;
/*!40000 ALTER TABLE `cart_detail` DISABLE KEYS */;
INSERT INTO `cart_detail` (`id`, `product_id`, `cart_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
	(2, 2, 1, 12, 1000, '2021-04-14 13:56:28', NULL),
	(3, 1, 1, 12, 1200, '2021-04-14 13:56:33', NULL),
	(4, 2, 1, 12, 1000, '2021-04-14 13:56:33', NULL),
	(5, 1, 1, 11, 1200, '2021-04-14 13:56:44', NULL),
	(6, 2, 1, 11, 1000, '2021-04-14 13:56:44', NULL),
	(7, 1, 1, 11, 1200, '2021-04-14 13:56:54', NULL),
	(8, 1, 1, 11, 1000, '2021-04-14 13:56:54', NULL),
	(9, 1, 1, 1, 150, '2021-04-14 13:57:04', NULL);
/*!40000 ALTER TABLE `cart_detail` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.category: 3 rows
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `description`, `sort`, `created_at`, `updated_at`, `slug`) VALUES
	(2, 'PC', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, neque at tincidunt auctor, ex tortor ultricies sapien, eu ultricies elit ante sit amet sapien. Ut maximus volutpat leo non eleifend. Nulla facilisi. Duis ac porta lacus, volutpat posuere nulla. Vivamus ac blandit erat. Cras quis neque nisl. Fusce accumsan convallis ligula, et finibus ipsum aliquet sed. Mauris eget ante turpis. Donec vel lectus vulputate leo feugiat faucibus. Nunc ultricies turpis id ipsum maximus mattis. Donec suscipit aliquet interdum. Integer ullamcorper, ex sed sodales consequat, arcu leo dapibus sem, sit amet accumsan tellus odio ac nisi. Praesent ut malesuada sapien, quis egestas magna. Integer laoreet consequat mauris in condimentum.</p>', 1, '2021-04-05 04:11:11', '2021-04-05 04:16:11', 'pc'),
	(3, 'Mobile', '<p>Nullam ac volutpat nisl. Nunc id scelerisque risus. Nullam pellentesque mattis erat, sit amet vestibulum ipsum facilisis quis. Praesent lacinia sollicitudin leo. Nullam lectus enim, suscipit vitae laoreet vel, accumsan in enim. Curabitur ullamcorper elit leo, in luctus felis congue vitae. Etiam tincidunt risus vel diam euismod, ac interdum diam mattis.</p>', 2, '2021-04-05 04:15:11', '2021-04-05 04:18:17', 'mobile'),
	(4, 'Electric', '<p>Proin vitae mi tempus, consectetur ligula id, eleifend diam. Praesent tellus est, pulvinar eget posuere nec, porttitor venenatis lectus. Cras sed felis id sem elementum ornare sit amet in mauris. Mauris congue dolor nisl, vitae pellentesque libero viverra ut. In hac habitasse platea dictumst. Nulla scelerisque magna turpis, sit amet tincidunt libero&nbsp;</p>', 3, '2021-04-05 04:15:35', '2021-04-05 04:18:22', 'electric');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.migrations: 0 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.paygates: 4 rows
DELETE FROM `paygates`;
/*!40000 ALTER TABLE `paygates` DISABLE KEYS */;
INSERT INTO `paygates` (`id`, `name`, `code`, `url`, `configs`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Ngân Lượng', 'nganluong', 'https://www.nganluong.vn/checkout.php', '{"RECEIVER":"demo@nganluong.vn","MERCHANT_ID":"36680","MERCHANT_PASS":"matkhauketnoi","currency":"vnd"}', '', '2020-11-27 09:58:17', '2021-04-01 03:36:28', NULL),
	(3, 'VNPAY', 'vnpay', 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html', '{"vnp_HashSecret":"BYOLXENKWJJQXKVVLRBKJHYMXEASMRCH","vnp_TmnCode":"DULCJHZU","currency":"vnd","url":"http:\\/\\/sandbox.vnpayment.vn\\/paymentv2\\/vpcpay.html"}', '', '2020-12-02 09:49:33', '2021-04-01 07:07:26', NULL),
	(4, 'PayPal', 'paypal', 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=', '{"SECRET_ID":"ED4XVsfGNc-px4RXweWGcE_IJ7GcR6gSMtf5dr6PGlJPndsRPOXtRe8c6f_eSywYLPBc7HczK6qFlcdM","CLIENT_ID":"AeYbemRrJQ94AKpZKo_sHSQJsdk8sH25QrfeDwiPhL8kEXxb962Xjs875juuJGsrPGCP5o2mb35jpqSq","SANBOX_ACCOUNT":"sb-nlqij3868487@business.example.com","VERSION":"53.0", "API_USERNAME" : "sb-nlqij3868487@business.example.com", "API_PASSWORD":"thanhnhan030796", "API_SIGNATURE":"A3CZZ6twi-WT-7ZwGQua95N4-iDJAoXTkTDd9WQ7kUjYBGT3y8pqxT4D", "VERSION" : "55.0"}', '', '2020-12-07 16:22:36', '2021-03-31 08:51:33', NULL),
	(5, 'MoMo', 'momo', 'https://test-payment.momo.vn', '{"partnerCode":"MOMO2RUK20210401","accessKey":"MarXljRRVSODYYom","secretKey":"hNKD0ueMaF4kDVR2MV92LEahFNRTOo2Z","currency":"vnd"}', 'momo.png', '2021-04-01 15:15:35', '2021-04-01 15:15:35', NULL);
/*!40000 ALTER TABLE `paygates` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.products: 2 rows
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `info`, `description`, `price`, `origin`, `code`, `qa_code`, `status`, `qty`, `created_at`, `updated_at`) VALUES
	(1, 'Vsmart live 4', 'vsmart-live-4', 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, neque at tincidunt auctor, ex tortor ultricies sapien, eu ultricies elit ante sit amet sapien. Ut maximus volutpat leo non eleifend. Nulla facilisi. Duis ac porta lacus, volutpat posuere nulla. Vivamus ac blandit erat. Cras quis neque nisl.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, neque at tincidunt auctor, ex tortor ultricies sapien, eu ultricies elit ante sit amet sapien. Ut maximus volutpat leo non eleifend. Nulla facilisi. Duis ac porta lacus, volutpat posuere nulla. Vivamus ac blandit erat. Cras quis neque nisl. Fusce accumsan convallis ligula, et finibus ipsum aliquet sed. Mauris eget ante turpis. Donec vel lectus vulputate leo feugiat faucibus. Nunc ultricies turpis id ipsum maximus mattis. Donec suscipit aliquet interdum. Integer ullamcorper, ex sed sodales consequat, arcu leo dapibus sem, sit amet accumsan tellus odio ac nisi. Praesent ut malesuada sapien, quis egestas magna. Integer laoreet consequat mauris in condimentum.</p>\r\n\r\n<p>Nullam ac volutpat nisl. Nunc id scelerisque risus. Nullam pellentesque mattis erat, sit amet vestibulum ipsum facilisis quis. Praesent lacinia sollicitudin leo. Nullam lectus enim, suscipit vitae laoreet vel, accumsan in enim. Curabitur ullamcorper elit leo, in luctus felis congue vitae. Etiam tincidunt risus vel diam euismod, ac interdum diam mattis.</p>\r\n\r\n<p>Proin vitae mi tempus, consectetur ligula id, eleifend diam. Praesent tellus est, pulvinar eget posuere nec, porttitor venenatis lectus. Cras sed felis id sem elementum ornare sit amet in mauris. Mauris congue dolor nisl, vitae pellentesque libero viverra ut. In hac habitasse platea dictumst. Nulla scelerisque magna turpis, sit amet tincidunt libero malesuada sit amet. Nam vitae sem eros. Praesent at consectetur diam, id porta erat. Donec erat metus, laoreet sed dignissim a, vehicula id velit.</p>', 4500000, 'VietNam', '3c07af49174f9420a6393b35a66b7bfa', NULL, 1, 1500, '2021-04-05 08:37:58', '2021-04-05 08:37:58'),
	(3, 'Vsmart live Be', 'vsmart-live-be', 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, neque at tincidunt auctor, ex tortor ultricies sapien, eu ultricies elit ante sit amet sapien. Ut maximus volutpat leo non eleifend. Nulla facilisi. Duis ac porta lacus, volutpat posuere nulla. Vivamus ac blandit erat. Cras quis neque nisl.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, neque at tincidunt auctor, ex tortor ultricies sapien, eu ultricies elit ante sit amet sapien. Ut maximus volutpat leo non eleifend. Nulla facilisi. Duis ac porta lacus, volutpat posuere nulla. Vivamus ac blandit erat. Cras quis neque nisl. Fusce accumsan convallis ligula, et finibus ipsum aliquet sed. Mauris eget ante turpis. Donec vel lectus vulputate leo feugiat faucibus. Nunc ultricies turpis id ipsum maximus mattis. Donec suscipit aliquet interdum. Integer ullamcorper, ex sed sodales consequat, arcu leo dapibus sem, sit amet accumsan tellus odio ac nisi. Praesent ut malesuada sapien, quis egestas magna. Integer laoreet consequat mauris in condimentum.</p>\r\n\r\n<p>Nullam ac volutpat nisl. Nunc id scelerisque risus. Nullam pellentesque mattis erat, sit amet vestibulum ipsum facilisis quis. Praesent lacinia sollicitudin leo. Nullam lectus enim, suscipit vitae laoreet vel, accumsan in enim. Curabitur ullamcorper elit leo, in luctus felis congue vitae. Etiam tincidunt risus vel diam euismod, ac interdum diam mattis.</p>\r\n\r\n<p>Proin vitae mi tempus, consectetur ligula id, eleifend diam. Praesent tellus est, pulvinar eget posuere nec, porttitor venenatis lectus. Cras sed felis id sem elementum ornare sit amet in mauris. Mauris congue dolor nisl, vitae pellentesque libero viverra ut. In hac habitasse platea dictumst. Nulla scelerisque magna turpis, sit amet tincidunt libero malesuada sit amet. Nam vitae sem eros. Praesent at consectetur diam, id porta erat. Donec erat metus, laoreet sed dignissim a, vehicula id velit.</p>', 4500000, 'VietNam', '3c07af49174f9420a6393b35a66b7bfa', NULL, 1, 1500, '2021-04-05 08:37:58', '2021-04-05 08:37:58');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.product_attitude: 3 rows
DELETE FROM `product_attitude`;
/*!40000 ALTER TABLE `product_attitude` DISABLE KEYS */;
INSERT INTO `product_attitude` (`id`, `product_id`, `attribute`, `value`, `sort`, `created_at`, `updated_at`) VALUES
	(3, 1, 'Pin', '5000mAh', 1, '2021-04-06 07:33:52', '2021-04-06 07:33:52'),
	(4, 1, 'Screen', '6.5inch', 2, '2021-04-06 07:34:04', '2021-04-06 07:34:04'),
	(5, 1, 'IOS', 'Android 10', 3, '2021-04-06 07:34:16', '2021-04-06 07:34:16');
/*!40000 ALTER TABLE `product_attitude` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.product_color: 6 rows
DELETE FROM `product_color`;
/*!40000 ALTER TABLE `product_color` DISABLE KEYS */;
INSERT INTO `product_color` (`id`, `product_id`, `color`, `created_at`, `updated_at`) VALUES
	(1, 1, '#000000', NULL, NULL),
	(2, 1, '#d03711', NULL, NULL),
	(5, 1, '#4c55cd', NULL, NULL),
	(6, 3, '#000000', NULL, NULL),
	(7, 3, '#000000', NULL, NULL),
	(8, 3, '#000000', NULL, NULL);
/*!40000 ALTER TABLE `product_color` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.product_img: 4 rows
DELETE FROM `product_img`;
/*!40000 ALTER TABLE `product_img` DISABLE KEYS */;
INSERT INTO `product_img` (`id`, `product_id`, `image`, `sort`, `created_at`, `updated_at`) VALUES
	(3, 2, '/image/products/image_2_105990876_594213958163917_1201112106328640992_n.jpg', 0, '2021-04-05 10:52:26', '2021-04-05 10:52:26'),
	(4, 1, '/image/products/image_1_105990876_594213958163917_1201112106328640992_n.jpg', 0, '2021-04-06 07:29:50', '2021-04-06 07:29:50'),
	(5, 1, '/image/products/image_1_ava.jpg', 0, '2021-04-06 07:29:55', '2021-04-06 07:29:55'),
	(6, 1, '/image/products/image_1_avaHostingerAndMail.jpg', 0, '2021-04-06 07:30:00', '2021-04-06 07:30:00');
/*!40000 ALTER TABLE `product_img` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.product_size: 3 rows
DELETE FROM `product_size`;
/*!40000 ALTER TABLE `product_size` DISABLE KEYS */;
INSERT INTO `product_size` (`id`, `product_id`, `size`, `created_at`, `updated_at`) VALUES
	(1, 1, 'S', NULL, NULL),
	(2, 1, 'X', NULL, NULL),
	(4, 1, 'XL', NULL, NULL);
/*!40000 ALTER TABLE `product_size` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.product_tags: 2 rows
DELETE FROM `product_tags`;
/*!40000 ALTER TABLE `product_tags` DISABLE KEYS */;
INSERT INTO `product_tags` (`id`, `product_id`, `tags_id`, `created_at`, `updated_at`) VALUES
	(12, 1, 3, '2021-04-06 14:33:40', NULL),
	(11, 1, 1, '2021-04-06 14:33:40', NULL);
/*!40000 ALTER TABLE `product_tags` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.rattings: 2 rows
DELETE FROM `rattings`;
/*!40000 ALTER TABLE `rattings` DISABLE KEYS */;
INSERT INTO `rattings` (`id`, `user_id`, `product_id`, `rattings`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 4, '2021-04-06 16:30:11', NULL),
	(2, 2, 3, 5, '2021-04-06 16:30:11', NULL);
/*!40000 ALTER TABLE `rattings` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.settings: ~43 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'favicon', '/storage/userfiles/images/nencer-fav.png', NULL, '2019-01-25 16:56:44'),
	(2, 'backendlogo', '/storage/userfiles/images/nencer-logo.png', NULL, '2019-01-25 16:56:44'),
	(3, 'name', 'Long Nguyen', NULL, '2019-01-25 16:56:44'),
	(4, 'title', 'Upload lưu trữ file không giới hạn, miễn phí và an toàn', NULL, '2019-01-25 16:56:44'),
	(5, 'description', 'Ứng dụng lõi của mọi phần mềm và hệ thống', NULL, '2019-01-25 16:56:44'),
	(6, 'language', 'N/A', NULL, '2019-01-25 16:56:44'),
	(7, 'phone', '943793984', NULL, '2019-01-25 16:56:44'),
	(8, 'twitter', 'fb.com/admin', NULL, '2019-01-25 16:56:44'),
	(9, 'email', 'nguyenlongit95@gmail.com', NULL, '2019-01-25 16:56:44'),
	(10, 'facebook', '35/45 Tran Thai Tong, Cau Giay, Ha Noi', NULL, '2019-01-25 16:56:44'),
	(11, 'logo', '/storage/userfiles/images/nencer.png', NULL, '2019-01-25 16:56:44'),
	(12, 'hotline', '0123456789', NULL, '2019-01-25 16:56:44'),
	(13, 'backendname', 'AdminLTE', NULL, '2019-01-25 16:56:44'),
	(14, 'backendlang', 'N/A', NULL, '2019-01-25 16:56:44'),
	(15, 'copyright', 'Website đang chờ xin giấy phép của bộ TTTT.', NULL, '2019-01-25 16:56:44'),
	(16, 'timezone', 'Asia/Ho_Chi_Minh', NULL, '2019-01-25 16:56:44'),
	(17, 'googleplus', 'fb.com/admin', NULL, '2019-01-25 16:56:44'),
	(18, 'websitestatus', 'ONLINE', NULL, '2019-01-25 16:56:44'),
	(19, 'address', '35/45 Tran Thai Tong, Cau Giay, Ha Noi', '2018-08-21 10:53:44', '2019-01-25 16:56:44'),
	(21, 'default_user_group', '2', '2018-08-21 11:06:25', '2019-01-25 16:56:44'),
	(22, 'twofactor', 'none', '2018-09-05 21:17:56', '2019-01-25 16:56:44'),
	(23, 'fronttemplate', 'default', '2018-09-25 13:29:14', '2019-01-25 16:56:44'),
	(24, 'offline_mes', 'Website đang bảo trì!', NULL, '2019-01-25 16:56:44'),
	(25, 'smsprovider', 'none', '2018-10-09 17:17:08', '2019-01-25 16:56:44'),
	(26, 'youtube', 'https://www.youtube.com/watch?v=neCmEbI2VWg', NULL, '2019-01-25 16:56:44'),
	(27, 'globalpopup', '0', NULL, '2019-01-25 16:56:44'),
	(28, 'globalpopup_mes', '<p>Chưa c&oacute; nội dung g&igrave;</p>', NULL, '2019-01-25 16:56:44'),
	(29, 'social_login', '0', NULL, '2019-01-25 16:56:44'),
	(30, 'google_analytic_id', '30', NULL, '2019-01-25 16:56:44'),
	(31, 'header_js', 'N/A', NULL, '2019-01-25 16:56:44'),
	(32, 'footer_js', 'N/A', NULL, '2019-01-25 16:56:44'),
	(33, 'home_tab_active', 'Softcard', NULL, '2019-01-25 16:56:44'),
	(34, 'fileSecretkey', '12345678', NULL, NULL),
	(35, 'affiliate', 'http://localhost/core/public/user/register/', NULL, '2019-01-14 15:33:48'),
	(36, 'top_bg', 'N/A', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(37, 'slide_bg', 'N/A', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(38, 'footer_bg', 'N/A', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(39, 'top_color', 'N/A', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(40, 'allow_transfer', '0', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(41, 'type_slider', 'slider', '2019-01-23 13:42:05', '2019-01-25 16:56:44'),
	(42, 'countdown', '30', NULL, '2019-01-25 16:56:44'),
	(43, 'footerlogo', '/storage/userfiles/images/nencer-logo-gray.png', NULL, NULL),
	(44, 'logo', '/storage/userfiles/images/nencer-logo.png', NULL, '2020-12-02 06:37:56');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.sliders: ~0 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.tags: 3 rows
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `tags`, `slug`, `sort`, `created_at`, `updated_at`) VALUES
	(1, 'Hot phone 2019', 'hot-phone-2019', 1, '2021-04-05 06:42:16', '2021-04-05 06:42:16'),
	(3, 'PC gaming 2021', 'pc-gaming-2021', 2, '2021-04-05 06:56:03', '2021-04-05 06:56:03'),
	(4, 'Sản phẩm bán chạy 2021', 'san-pham-ban-chay-2021', 3, '2021-05-07 08:19:55', '2021-05-07 08:19:55');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.users: 2 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'NguyenLong', 'nguyenlongit95@gmail.com', '2020-12-02 00:00:00', '$2y$10$/XiVXPWQ5Ol2RmUitWDmKebYsyMJfoS/ohx8Z5NTLbDd6zoot53fe', NULL, 0, NULL, '2020-12-02 07:50:30'),
	(2, 'LongNguyen', 'testAccount@gmail.com', NULL, '$2y$10$r3QBckUKEBrK/Y08Q4lAbe/SzrWr.qbrbjz.r6YFqjnMI6uEQGu8K', NULL, 2, '2020-12-07 08:08:58', '2020-12-07 08:08:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping data for table base_ecommerce.wishlist: 2 rows
DELETE FROM `wishlist`;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, NULL, NULL),
	(2, 3, 2, NULL, NULL);
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
