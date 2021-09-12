<?php
Class Language {
	private static $lang = array();

	public static function config($var)
	{
		if (empty(self::$lang)) {
			$lng = User::settings('language');

			if (file_exists(SYS . '/lang/'.$lng.'/lang.ini')) {
				self::$lang = parse_ini_file(SYS . '/lang/'.$lng.'/lang.ini');
				return self::$lang[$var];
			}
		} else {
			return self::$lang[$var];
		}
	}

}
?>
