--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `algo` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `level` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `status` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `about` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `coins` mediumint(8) unsigned NOT NULL DEFAULT '100',
  `avatar` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none.jpg',
  `ip` int(10) NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_c` enum('off','wait','on') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `time_signup` int(10) NOT NULL,
  `time_entry` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `login` (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Пользователь';