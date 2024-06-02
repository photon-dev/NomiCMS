DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE `user_settings` (
  `user_id` int(10) unsigned NOT NULL,
  `time_shift` int(10) NOT NULL DEFAULT '0',
  `local` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ru',
  `theme` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'custom',
  `post_page` tinyint(2) NOT NULL DEFAULT '15',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Настройки пользователя';
