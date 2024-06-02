--
-- Структура таблицы `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;
CREATE TABLE `user_friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `who` int(10) unsigned NOT NULL,
  `to_whom` int(10) unsigned NOT NULL,
  `status` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `date_add` int(10) NOT NULL,
  `date_accept` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `who` (`who`),
  KEY `to_whom` (`to_whom`),
  CONSTRAINT `user_friends_ibfk_2` FOREIGN KEY (`to_whom`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_friends_ibfk_4` FOREIGN KEY (`who`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Друзья';