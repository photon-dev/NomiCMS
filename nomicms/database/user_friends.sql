--
-- Удаление таблицы `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;

--
-- Структура таблицы `user_journal`
--

CREATE TABLE IF NOT EXISTS `user_friends` (
    `uid` int(10) UNSIGNED NOT NULL,
    `who` int(10) UNSIGNED NOT NULL,
    `to_whom` int(10) UNSIGNED NOT NULL,
    `status` enum('yes','no') NOT NULL DEFAULT 'no',
    `date_add` int(10) NOT NULL,
    `date_accept` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=1 COMMENT='Друзья';

--
-- Индексы таблицы `user_friends`
--
ALTER TABLE `user_friends`
    ADD PRIMARY KEY (`uid`),
    ADD KEY `who` (`who`),
    ADD KEY `to_whom` (`to_whom`);

--
-- AUTO_INCREMENT для таблицы `user_friends`
--
ALTER TABLE `user_friends`
    MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа таблицы `user_friends`
--
ALTER TABLE `user_friends`
    ADD CONSTRAINT `user_friends_ibfk_1` FOREIGN KEY (`who`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `user_friends_ibfk_2` FOREIGN KEY (`to_whom`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
