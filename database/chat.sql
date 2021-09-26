--
-- Структура таблицы `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
    `uid` int(10) unsigned NOT NULL,
    `user_uid` int(10) NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=3 COMMENT='Мини-чат';

--
-- Индексы таблицы `chat`
--

ALTER TABLE `chat`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD KEY `user_uid` (`user_uid`);

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`uid`, `user_uid`, `message`, `date_write`) VALUES
(1, 1, 'Всем привет пользователи', 1632582260),
(2, 2, 'Дарова', 1613296024);
