--
-- Удаление таблицы `user_alerts`
--

DROP TABLE IF EXISTS `user_alerts`;

--
-- Структура таблицы `user_alerts`
--

CREATE TABLE IF NOT EXISTS `user_alerts` (
    `uid` int(10) UNSIGNED NOT NULL,
    `who` int(10) UNSIGNED NOT NULL,
    `to_whom` int(10) UNSIGNED NOT NULL,
    `message` text NOT NULL,
    `url` varchar(255) NOT NULL,
    `read` enum('yes','no') NOT NULL DEFAULT 'no',
    `date_write` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=1 COMMENT='Оповещения';

--
-- Индексы таблицы `user_alerts`
--

ALTER TABLE `user_alerts`
    ADD PRIMARY KEY (`uid`),
    ADD KEY `who` (`who`),
    ADD KEY `to_whom` (`to_whom`);

--
-- AUTO_INCREMENT для таблицы `user_alerts`
--

ALTER TABLE `user_alerts`
    MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа таблицы `user_alerts`
--

ALTER TABLE `user_alerts`
    ADD CONSTRAINT `user_alerts_ibfk_1` FOREIGN KEY (`who`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `user_alerts_ibfk_2` FOREIGN KEY (`to_whom`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
