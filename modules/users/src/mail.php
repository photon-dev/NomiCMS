<?php

$action = $action ?? NULL;

$tmp->header('email');
$tmp->title('title', Language::config('email_ttl'));
User::panel();

//var_dump($route);

switch ($action) {

	default:

		if (User::profile('email') != null) {
			go_exit('?verify');
		}

		echo 'default';

	break;
	case 'verify':

		if(User::profile('email_c') == 1 or User::profile('email') == null) {
			//go_exit('email');
		}

		echo 'verify';

	break;
	case 'activate':

		$code = $_GET['code'] ?? null;

		echo 'activate ' . $code;

	break;
}

$tmp->back('edit');
?>
