--
-- Удаление таблицы `user_soc`
--

DROP TABLE IF EXISTS `user_soc`;

--
-- Структура таблицы `user_soc`
--

CREATE TABLE IF NOT EXISTS `user_soc` (
    `user_uid` int(10) UNSIGNED NOT NULL,
    `vk` varchar(32) NOT NULL DEFAULT '', -- Вконтакте
    `tg` varchar(32) NOT NULL DEFAULT '', -- Телеграмм
    `ok` varchar(32) NOT NULL DEFAULT '', -- Однокласники
    `fb` varchar(32) NOT NULL DEFAULT '' -- Фэйсбук
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT='Социальные ссылки';

--
-- Индексы таблицы `user_soc`
--

ALTER TABLE `user_soc`
    ADD PRIMARY KEY (`user_uid`);

--
-- Ограничения внешнего ключа таблицы `user_soc`
--
ALTER TABLE `user_soc`
    ADD CONSTRAINT `user_soc_ibfk_1` FOREIGN KEY (`user_uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
