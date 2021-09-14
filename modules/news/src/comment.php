<?php

$commentId = $commentId ?? false;
$action = $action ?? false;

echo 'ID: ' . $commentId . '<br />';
switch ($action) {
	case 'otv':

		echo 'Ответ на комментарий';
		break;

	case 'edit':

		echo 'Редактирование комментария';
		break;

	case 'del':

		echo 'Удаление комментария';
		break;
}
