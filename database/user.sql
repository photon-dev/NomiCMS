
--
-- Удаление таблицы `user`
--

DROP TABLE IF EXISTS `user`;

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
    `uid` int(10) unsigned NOT NULL,
    `login` varchar(32) NOT NULL, -- Логин
    `password` varchar(60) NOT NULL, -- Пароль
    `level` enum('1','2','3','4') NOT NULL DEFAULT '1', -- Уровень пользователя
    `name` varchar(32) NOT NULL  DEFAULT '', -- Имя
    `first_name` varchar(64) NOT NULL DEFAULT '', -- Фамилия
    `gender` enum('male','female') NOT NULL DEFAULT 'male', -- Пол
    `country` varchar(64) NOT NULL DEFAULT '', -- Страна
    `city` varchar(32) NOT NULL DEFAULT '', -- Город
    `about` varchar(256) NOT NULL DEFAULT '', -- Обо мне
    `coins` mediumint(8) unsigned NOT NULL DEFAULT '100', -- Монеты
    `avatar` varchar(128) NOT NULL DEFAULT 'none.jpg',
    `tg` varchar(32) NOT NULL DEFAULT '', -- Телеграмм
    `ip` int(10) NOT NULL,
    `email` varchar(128) NOT NULL DEFAULT '',
    `email_c` enum('off','wait','on') NOT NULL DEFAULT 'off',
    `browser` varchar(255) NOT NULL DEFAULT '',
    `date_signup` int(10) NOT NULL,
    `date_entry` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=3 COMMENT='Пользователь';

--
-- Индексы таблицы `user`
--

ALTER TABLE `user`
    MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD KEY `login` (`login`),
    ADD KEY `password` (`password`),
    ADD KEY `ip` (`ip`);

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`uid`, `login`, `password`, `level`, `ip`, `date_signup`, `date_entry`) VALUES
(1, 'Photon', '$2y$10$AhPC/.083r11/N8x.66C7ujprrfrG4hDcozwciSvHYGV8UCc0B44G', '4', 2130706433, 1613315595, 1613315595),
(2, 'Tester', '$2y$10$3L5mXG3WJqM5hqK3olb1xO2aMtF1lq2fmHjFlRp1MrcdvWp6EI9Ry', '1', 2130706433, 1613315595, 1613315595);
