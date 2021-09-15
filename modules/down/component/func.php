<?php

function downFileIcon($path) {
	$icon_dir = 'file_icon/';
	$ext = strtolower(end(explode('.', $path)));

	if (in_array($ext, array('jpg', 'png', 'gif', 'jpeg', 'svg', 'ico', 'psd')))
		return img($icon_dir . 'img.png');

	$ext_array = array(
		'zip' => img($icon_dir . 'zip.png'),
		'rar' => img($icon_dir . 'rar.png'),
		'txt' => img($icon_dir . 'txt.png'),
		'mp3' => img($icon_dir . 'mp3.png'),
		'mp4' => img($icon_dir . 'mp4.png')
	);

	$result = $ext_array[$ext];
    return ($result ? $result : img('file_icon/default.png'));
}
