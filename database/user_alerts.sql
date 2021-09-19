--
-- Удаление таблицы `user_alerts`
--

DROP TABLE IF EXISTS `user_alerts`;

--
-- Структура таблицы `user_alerts`
--

CREATE TABLE IF NOT EXISTS `user_alerts` (
    `uid` int(10) unsigned NOT NULL,
    `who` int(10) unsigned NOT NULL,
    `to_whom` int(10) unsigned NOT NULL,
    `message` text NOT NULL,
    `url` varchar(255) NOT NULL,
    `read` enum('yes','no') NOT NULL DEFAULT 'no',
    `date_write` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=2 COMMENT='Оповещения';

--
-- Индексы таблицы `user_alerts`
--

ALTER TABLE `user_alerts`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD FOREIGN KEY (`who`) REFERENCES `user` (`uid`),
    ADD FOREIGN KEY (`to_whom`) REFERENCES `user` (`uid`),
    ADD KEY `who` (`who`),
    ADD KEY `to_whom` (`to_whom`);

--
-- Дамп данных таблицы `user_alerts`
--

INSERT INTO `user_alerts` (`uid`, `who`, `to_whom`, `message`, `url`, `date_write`) VALUES
(1, 2, 1, 'Ответил на ваш комментраий', '/news/1/comment/7453', 1613296024);
