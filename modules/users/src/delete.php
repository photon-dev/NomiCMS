<?php

$userId = $userId ?? 0;
$wallId = $wallId ?? 0;

$id = my_int($db->guard($userId));

$p=$db->fass("select * from `users` where `id` = '".$id."' ");

if(!$p) go_exit();

if(User::aut()){
	$del = $db->guard($wallId);
	$c=$db->fass("SELECT * FROM `wall` where `id` ='".$del."'");

	if(!$c) go_exit();

	if($c['kto'] == User::ID() || User::profile('level') >=2) {
		$db->query("DELETE FROM `wall` where `id` ='".$del."'");
		header('location: /us'.$id);
	}
} else {
	go_exit();
}
?>
