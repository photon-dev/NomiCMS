<?php

// Индификатор поста, и действие
$postId = $postId ?? false;
$action = $action ?? false;

$go = (User::level() < 2) ? '/' : '/apanel/chat';

// Удалить сообщение
if ($action == 'del' && User::level() >= 3) {
    $postId = $db->guard($postId);
    $db->query("DELETE FROM `admin_chat` where `id` ='" . $postId . "'");

    go_exit('/apanel/chat');
}

// Ответить сообщение
if ($action == 'reply') {
    $tmp->header('admin_chat');
    $tmp->title('title', Language::config('admin_chat'));
    User::panel();

    $postId = $db->guard($postId);
    $ot = $db->fass("SELECT * FROM `admin_chat` where `id` = '" . $postId . "'");

    if($ot['kto'] != User::ID() && !empty($ot)) {

        if(isset($_REQUEST['submit'])) {
            $message = $db->guard($_POST['messages']);

            if(empty($message) || mb_strlen($_POST['messages'], 'UTF-8')<2) $error .= Language::config('no_message');

            if(!isset($error)) {
                $db->query("INSERT INTO `admin_chat` set `kto` = '" . User::ID() . "', `message` = '[rep]" . nickname($ot['kto']) . "[/rep] " . $message . "', `time` = '" . time() . "' ");
                $lid = $db->insert_id();

                User::new_notify($ot['kto'], 'rep_admin_chat', '/apanel/chat/' . $lid);

                $db->query("UPDATE `users` set `money` = money + 5 where `id` = '".User::ID()."'");
                header('location: /apanel/chat');
            }
        }

        $tmp->div('messages', '<div>' . Language::config('message') . ':<br />' . bb(smile($ot['message'])) . '</div><hr>' );

        bbcode();
        error($error);

        $tmp->div('main', '<form method="POST" name="message" action="">'.Language::config('message').':<br/><textarea name="messages"></textarea><br /><input type="submit" name="submit" value="'.Language::config('send').'" /></form>');
    } else {
        $tmp->show_error();
    }

    $tmp->div('menu', '<hr><a href="/apanel/chat">'.img('link.png').' '.Language::config('back').'</a>');
    $tmp->footer();
}

go_exit($go);
