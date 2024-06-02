DROP TABLE IF EXISTS `user_alerts`;
CREATE TABLE `user_alerts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `who` int(10) unsigned NOT NULL,
  `to_whom` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `date_write` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `who` (`who`),
  KEY `to_whom` (`to_whom`),
  CONSTRAINT `user_alerts_ibfk_1` FOREIGN KEY (`who`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_alerts_ibfk_2` FOREIGN KEY (`to_whom`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Оповещения';