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
(1, 1, '[b]Тестирование ютуба[/b]\r\n\r\n[youtube]https://youtu.be/8PCfDOB7KbQ[/youtube]', 1632578817),
(2, 1, '[b]Тестирование смайлов[/b]\r\n\r\n:smile: :smile2: :smile3: :smile4: :smile5: :smileup: :smileangel: :wink:\r\n\r\n:grin: :grin2: :biggrin: :biggrin2: :lol: :lol2::lol3:\r\n\r\n:kissyes: :kissyes2: :kissyes3: :kisslove: :love: :love2: :lovestar:\r\n\r\n:think: :hugs: :qui:\r\n\r\n:tab: :tab2: :tab3: :tab4: :tab5: :tab6: :sad:\r\n\r\n:virus: :fire: :sssr:\r\n', 1632582310);
