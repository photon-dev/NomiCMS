--
-- Структура таблицы `user_soc`
--

DROP TABLE IF EXISTS `user_soc`;
CREATE TABLE `user_soc` (
  `user_id` int(10) unsigned NOT NULL,
  `vk` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tg` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ok` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fb` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_soc_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Социальные ссылки';