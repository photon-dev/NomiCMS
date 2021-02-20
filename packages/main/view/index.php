<div class="news">
    <div>
        <span title="">
            📢 Привет <b><?php echo $welcome ?></b>
            <span class="nt">1 час назад</span>
        </span><br /><br />
        Ты попал на тестовый сайт, <span style="color: #f44336">Nomicms v3.0.1601b</span><br />
        Если вам так интерсно заходите время от времени.<br />
        Следите за разработкой новой версии.<br /><br />

        <span style="color: #f44336">Репозитории на github:</span><br />
        <a class="link_visual" target="_blank" href="https://github.com/Photon-Dev/NomiCMS/tree/develop-v3.0">Ознакомиться</a>
    </div>
</div>
<?php if ($logger) : ?>
<div class="menu">
    <a class="items" href="/user/leave" title="Выйти из профиля">
        <img src="/themes/custom/img/del_friend.png" alt="*" />
        Выйти из профиля
    </a>
</div>
<?php endif; ?>
