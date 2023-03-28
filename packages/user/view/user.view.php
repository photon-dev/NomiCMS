<?php

use Nomicms\Component\Text\Misc;
use Nomicms\Component\Text\DateTime;

?>
<div class="main">
</div>
<div class="main">
    <img class="ava_orig" src="/uploads/avatars/<?php echo $profile->avatar; ?>" alt="*"><br />
    <?php echo Misc::output($profile->status); ?><br /><br />
    <ul>
        <li>
            Логин: <?php echo $profile->login; ?>
        </li>
        <li>
            UID:  <?php echo $profile->uid; ?>
        </li>
        <li>
            COINS: <?php echo $profile->coins; ?>
        </li>
    </ul><br />
    <ul>
        <li>
            Имя: <?php echo $profile->name; ?>
        </li>
        <li>
            Фамилия: <?php echo $profile->first_name; ?>
        </li>
        <li>
            Пол: <?php echo ($profile->gender == 'male') ? 'Мужской' : 'Женский'; ?>
        </li>
        <li>
            Страна: <?php echo $profile->country; ?>
        </li>
        <li>
            Город: <?php echo $profile->city; ?>
        </li>
        <li>
            Обо мне: <?php echo $profile->about; ?>
        </li>
    </ul><br />
    <ul>
        <li>
            Последний визит: <?php echo DateTime::times($profile->date_entry); ?>
        </li>
        <li>
            Дата регистрации: <?php echo DateTime::times($profile->date_signup); ?>
        </li>
    </ul>
</div>
