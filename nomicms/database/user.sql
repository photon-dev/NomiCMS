
--
-- Удаление таблицы `user`
--

DROP TABLE IF EXISTS `user`;

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
    `uid` int(10) unsigned NOT NULL,
    `login` varchar(20) NOT NULL, -- Логин
    `algo` varchar(7) NOT NULL, -- Алгоритм шифрования токена
    `token` varchar(60) NOT NULL, -- Токен
    `level` enum('1','2','3','4') NOT NULL DEFAULT '1', -- Уровень пользователя
    `name` varchar(32) NOT NULL  DEFAULT '', -- Имя
    `first_name` varchar(64) NOT NULL DEFAULT '', -- Фамилия
    `gender` enum('male','female') NOT NULL DEFAULT 'male', -- Пол
    `status` varchar(256) NOT NULL DEFAULT '', -- Статус
    `country` varchar(64) NOT NULL DEFAULT '', -- Страна
    `city` varchar(32) NOT NULL DEFAULT '', -- Город
    `about` varchar(512) NOT NULL DEFAULT '', -- Обо мне
    `coins` mediumint(8) unsigned NOT NULL DEFAULT '100', -- Монеты
    `avatar` varchar(128) NOT NULL DEFAULT 'none.jpg', -- Аватар
    `ip` int(10) NOT NULL, -- Ip адрес
    `email` varchar(128) NOT NULL DEFAULT '',
    `email_c` enum('off','wait','on') NOT NULL DEFAULT 'off',
    `browser` varchar(255) NOT NULL DEFAULT '',
    `date_signup` int(10) NOT NULL,
    `date_entry` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=1 COMMENT='Пользователь';

--
-- Индексы таблицы `user`
--

ALTER TABLE `user`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD KEY `login` (`login`),
    ADD KEY `token` (`token`),
    ADD KEY `ip` (`ip`);
