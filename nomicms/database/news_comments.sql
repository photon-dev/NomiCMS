--
-- Удаление таблицы `news_comments`
--

DROP TABLE IF EXISTS `news_comments`;

--
-- Структура таблицы `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
    `uid` int(10) UNSIGNED NOT NULL,
    `news_uid` int(10) UNSIGNED NOT NULL,
    `user_uid` int(10) UNSIGNED NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=1 COMMENT='Комментарии новостей';

--
-- Индексы таблицы `news_comments`
--
ALTER TABLE `news_comments`
    ADD PRIMARY KEY (`uid`),
    ADD KEY `news_uid` (`news_uid`),
    ADD KEY `user_uid` (`user_uid`);

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news_comments`
    MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа таблицы `news_comments`
--
ALTER TABLE `news_comments`
    ADD CONSTRAINT `news_comments_ibfk_1` FOREIGN KEY (`news_uid`) REFERENCES `news` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `news_comments_ibfk_2` FOREIGN KEY (`user_uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`uid`, `news_uid`, `user_uid`, `message`, `date_write`, `date_edit`) VALUES
(1, 1, 1, 'Ура. Ура. Ура', 1613296024, 1613296024);
