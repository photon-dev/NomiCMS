--
-- Удаление таблицы `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;

--
-- Структура таблицы `user_journal`
--

CREATE TABLE IF NOT EXISTS `user_friends` (
    `uid` int(10) unsigned NOT NULL,
    `who` int(10) unsigned NOT NULL,
    `to_whom` int(10) unsigned NOT NULL,
    `status` enum('yes','no') NOT NULL DEFAULT 'no',
    `date_add` int(10) NOT NULL,
    `date_accept` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=3 COMMENT='Друзья';

--
-- Индексы таблицы `user_friends`
--

ALTER TABLE `user_friends`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD FOREIGN KEY (`who`) REFERENCES `user` (`uid`),
    ADD FOREIGN KEY (`to_whom`) REFERENCES `user` (`uid`),
    ADD KEY `who` (`who`),
    ADD KEY `to_whom` (`to_whom`);

--
-- Дамп данных таблицы `user_friends`
--

INSERT INTO `user_friends` (`uid`, `who`, `to_whom`, `status`, `date_add`, `date_accept`) VALUES
(1, 1, 2, 'yes', 1613296024, 1613296024),
(2, 2, 1, 'yes', 1613296024, 1613296024);
