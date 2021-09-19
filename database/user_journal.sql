--
-- Удаление таблицы `user_journal`
--

DROP TABLE IF EXISTS `user_journal`;

--
-- Структура таблицы `user_journal`
--

CREATE TABLE IF NOT EXISTS `user_journal` (
    `uid` int(10) unsigned NOT NULL,
    `who` int(10) unsigned NOT NULL,
    `to_whom` int(10) unsigned NOT NULL,
    `message` text NOT NULL,
    `url` varchar(255) NOT NULL,
    `read` enum('ok','no') NOT NULL DEFAULT 'no',
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=2 COMMENT='Оповещения';

--
-- Индексы таблицы `user_journal`
--

ALTER TABLE `user_journal`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD FOREIGN KEY (`who`) REFERENCES `user` (`uid`),
    ADD FOREIGN KEY (`to_whom`) REFERENCES `user` (`uid`),
    ADD KEY `who` (`who`),
    ADD KEY `to_whom` (`to_whom`);

--
-- Дамп данных таблицы `user_journal`
--

INSERT INTO `user_journal` (`uid`, `who`, `to_whom`, `message`, `url`, `date_write`, `date_edit`) VALUES
(1, 1, 2, 'Ответил на ваш комментраий', '/news/1/comment/7453', 1613296024, 0);
