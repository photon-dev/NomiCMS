<?php
$tmp->header('error');

$code = my_int($db->guard($_GET['code']));

$error_list = array('404' => '404 Not Found', '403' => '403 Forbidden');
$tmp->div('error', $error_list[$code]);

$tmp->home();
?>
