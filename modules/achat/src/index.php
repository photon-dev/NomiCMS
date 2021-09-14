<?php

$tmp->header('admin_chat');

$ms = (empty($ms) ? null : my_int($_GET['ms']));

$posts=$db->fass_c("SELECT COUNT(*) as count FROM `admin_chat`");

$tmp->title('title', Language::config('admin_chat'). ' ('.$posts.')');
User::panel();

if (User::level() < 3) {
	 go_exit();
}

$total = intval((($posts-1) / $num) + 1);
if (empty($page) or $page < 0) $page = 1;
if ($page > $total) $page = $total;
$start = $page * $num - $num;
$ch = $db->query("select * from `admin_chat` ORDER BY time DESC LIMIT ".$start.", ".$num."");

if(isset($_REQUEST['submit'])) {
	$message = $db->guard($_POST['messages']);

	if (empty($message) || mb_strlen($_POST['messages'], 'UTF-8')<2) $error .= Language::config('no_message');

	if(!isset($error)) {
		$db->query("INSERT INTO `admin_chat` set `kto` = '".User::ID()."', `message` = '".$message."', `time` = '".time()."' ");
		header('location: /apanel/chat');
	}
}

if(isset($_GET['ms'])) {
	$msg=$db->fass("select * from `admin_chat` where `id` = '".$ms."'");
	if (!empty($msg)) {
		echo '<div class="messages no_read"><div>'.nick_new($msg['kto']).'<span class="times">'. times($msg['time']).'</span>'.(($msg['kto'] != User::ID()) ? '<a class="answer" href="/apanel/chat/otv'.$msg['id'].'">'.img('answer.png').'</a>' : NULL ).' <br/>'.bb(smile($msg['message'])).'</div></div><hr>';
	}
}

error($error);

$tmp->div('menu', '<a href="/apanel/chat?'.rand(101, 999).' ">'.img('refresh.png').' '.Language::config('refresh').'</a>');
bbcode();
$tmp->div('main', '<form method="POST" name="message" action="">'.Language::config('message').':<br/><textarea name="messages"></textarea><br /><input type="submit" name="submit" value="'.Language::config('send').'" /></form>');


if (!$posts) {
	$tmp->div('main', Language::config('no_messages'));
} else {
	echo '<div class="messages">';
	while($chat=$ch->fetch_assoc()) {
		echo '<hr><div>'.nick_new($chat['kto']).'<a class="de" href="/apanel/chat/'.$chat['id'].'/del">'.img('delete.png').'</a><span class="times">'. times($chat['time']).'</span>'.(($chat['kto'] != User::ID() && User::aut()) ? '<a class="answer" href="/apanel/chat/'.$chat['id'].'/otv">'.img('answer.png').'</a>' : NULL ).' <br/>'.bb(smile($chat['message'])).'</div>';
	}
	echo '</div>';

	page('?');
}


$tmp->back('apanel');
?>
