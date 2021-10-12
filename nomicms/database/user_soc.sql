
--
-- Удаление таблицы `user_soc`
--

DROP TABLE IF EXISTS `user_soc`;

--
-- Структура таблицы `user_soc`
--

CREATE TABLE IF NOT EXISTS `user_soc` (
    `user_uid` int(10) unsigned NOT NULL,
    `vk` varchar(32) NOT NULL DEFAULT '', -- Вконтакте
    `tg` varchar(32) NOT NULL DEFAULT '', -- Телеграмм
    `ok` varchar(32) NOT NULL DEFAULT '', -- Однокласники
    `fb` varchar(32) NOT NULL DEFAULT '' -- Фэйсбук
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT='Социальные ссылки';

--
-- Индексы таблицы `user_soc`
--

ALTER TABLE `user_soc`
    ADD PRIMARY KEY (`user_uid`),
    ADD FOREIGN KEY (`user_uid`) REFERENCES `user` (`uid`);
