--
-- Удаление таблицы `chat`
--

DROP TABLE IF EXISTS `chat`;

--
-- Структура таблицы `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
    `uid` int(10) UNSIGNED NOT NULL,
    `user_uid` int(10) NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=1 COMMENT='Мини-чат';

--
-- Индексы таблицы `chat`
--

ALTER TABLE `chat`
    ADD PRIMARY KEY (`uid`),
    ADD KEY `user_uid` (`user_uid`);

--
-- AUTO_INCREMENT для таблицы `chat`
--

ALTER TABLE `chat`
    MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа таблицы `chat`
--

ALTER TABLE `chat`
    ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
