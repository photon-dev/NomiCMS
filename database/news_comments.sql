--
-- Удаление таблицы `news`
--

DROP TABLE IF EXISTS `news_comments`;

--
-- Структура таблицы `news_comments`
--

DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE IF NOT EXISTS `news_comments` (
    `uid` int(10) unsigned NOT NULL,
    `news_uid` int(10) unsigned NOT NULL,
    `user_uid` int(10) unsigned NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) DEFAULT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=2 COMMENT='Комментарии новостей';

--
-- Индексы таблицы `news_comments`
--

ALTER TABLE `news_comments`
    ADD PRIMARY KEY (`uid`),
    ADD FOREIGN KEY (`news_uid`) REFERENCES `news` (`uid`),
    ADD KEY `user_uid` (`user_uid`);

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`uid`, `news_uid`, `user_uid`, `message`, `date_write`, `date_edit`) VALUES
(1, 1, 1, 'Ура. Ура. Ура', 1613296024, 1613296024);
COMMIT;
