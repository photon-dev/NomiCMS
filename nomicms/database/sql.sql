--
-- Дамп данных таблицы `user`
--

--
INSERT INTO `user` (`uid`, `login`, `password`, `level`, `ip`, `date_signup`, `date_entry`) VALUES
(1, 'Photon', '$2y$10$AhPC/.083r11/N8x.66C7ujprrfrG4hDcozwciSvHYGV8UCc0B44G', '4', 2130706433, 1613315595, 1613315595);

--
-- Дамп данных таблицы `user_soc`
--

INSERT INTO `user_soc` (`user_uid`,`tg`) VALUES
(1, 'photon_dev');

--
-- Дамп данных таблицы `user_settings`
--

INSERT INTO `user_settings` (`user_uid`) VALUES
(1);

--
-- Дамп данных таблицы `user_friends`
--

INSERT INTO `user_friends` (`uid`, `who`, `to_whom`, `status`, `date_add`, `date_accept`) VALUES
(1, 1, 2, 'yes', 1613296024, 1613296024);

--
-- Дамп данных таблицы `user_alerts`
--

INSERT INTO `user_alerts` (`uid`, `who`, `to_whom`, `message`, `url`, `date_write`) VALUES
(1, 2, 1, 'Ответил на ваш комментраий', '/news/1/comment/7453', 1613296024);
