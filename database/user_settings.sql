--
-- Удаление таблицы `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;

--
-- Структура таблицы `user_settings`
--
CREATE TABLE IF NOT EXISTS `user_settings` (
    `uid` int(10) unsigned NOT NULL,
    `user_uid` int(10) unsigned NOT NULL,
    `shift_time` int(10) NOT NULL DEFAULT '0',
    `local` varchar(2) NOT NULL DEFAULT 'ru',
    `theme` varchar(32) NOT NULL DEFAULT 'custom',
    `post_page` tinyint(2) NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=3 COMMENT='Настройки пользователя';

--
-- Индексы таблицы `user_settings`
--

ALTER TABLE `user_settings`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD FOREIGN KEY (`user_uid`) REFERENCES `user` (`uid`);

--
-- Дамп данных таблицы `user_settings`
--

INSERT INTO `user_settings` (`uid`, `user_uid`) VALUES
(1, 1),
(2, 2);
