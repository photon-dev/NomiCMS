--
-- Удаление таблицы `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;

--
-- Структура таблицы `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
    `user_uid` int(10) UNSIGNED NOT NULL,
    `shift_time` int(10) NOT NULL DEFAULT '0',
    `local` varchar(2) NOT NULL DEFAULT 'ru',
    `theme` varchar(32) NOT NULL DEFAULT 'custom',
    `post_page` tinyint(2) NOT NULL DEFAULT '15'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT='Настройки пользователя';

--
-- Индексы таблицы `user_settings`
--

ALTER TABLE `user_settings`
    ADD PRIMARY KEY (`user_uid`);

--
-- Ограничения внешнего ключа таблицы `user_settings`
--
ALTER TABLE `user_settings`
    ADD CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
