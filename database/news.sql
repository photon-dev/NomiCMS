--
-- Удаление таблицы `news`
--

DROP TABLE IF EXISTS `news`;

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
    `uid` int(10) unsigned NOT NULL,
    `user_uid` int(10) unsigned NOT NULL,
    `name` varchar(256) NOT NULL,
    `message` text NOT NULL,
    `date_write` int(10) NOT NULL,
    `date_edit` int(10) DEFAULT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=2 COMMENT='Новости';

--
-- Индексы таблицы `news`
--

ALTER TABLE `news`
    MODIFY `uid` AUTO_INCREMENT,
    ADD PRIMARY KEY (`uid`),
    ADD KEY `user_uid` (`user_uid`);

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`uid`, `user_uid`, `name`, `message`, `date_write`, `date_edit`) VALUES
(1, 1, 'Nomicms v3.0', '[blue]Добрый день. У нас для вас две новости.[/blue]\r\n\r\n[b]1[/b] Ведётся разработка новой версии.\r\n[b]2[/b] Но, к сожалению дата выхода неизвестна.\r\n\r\n[red]Что ждать в новой версии[/red]\r\n\r\n[b]1[/b] Переход на новую систему.\r\n[b]2[/b] Пакеты теперь заменят модульность.\r\n[b]3[/b] Новая админ-панель.\r\n[b]4[/b] Маршрутизация (Routing). И многое другое.\r\n\r\n[red]Системные требования[/red]\r\n\r\n[b]1[/b] PHP: 7.2\r\n[b]2[/b] Apache 2.4\r\n[b]3[/b] MySQL: 5.6 MySQL Native Driver (mysqlnd)\r\n[b]4[/b] Поддержка функционала .htaccess\r\n\r\n[b]Подробности[/b]\r\n[url=http://t.me/nomicms]Telegram[/url]\r\n\r\n[red]У вас есть уникальная возможность, на момент разработки тестировать новую версию.[/red]\r\n\r\n[b]Тестовый сайт[/b]\r\n[b]Логин[/b] Tester\r\n[b]Пароль[/b] Tester\r\n[url=http://l9288528.beget.tech/]Тестировать[/url]', 1614270297, 1614270297);
