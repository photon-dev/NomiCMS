--
-- Структура таблицы `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
    `uid` int(10) unsigned NOT NULL,
    `user_uid` int(10) NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=1 COMMENT='Мини-чат';

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

--- INSERT INTO `chat` (`uid`, `user_uid`, `message`, `date_write`) VALUES
--- (1, 1, '[b]Тестирование ютуба[/b]\r\n\r\n[youtube]https://youtu.be/8PCfDOB7KbQ[/youtube]', 1632578817);
