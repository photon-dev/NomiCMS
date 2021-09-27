<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Список эмодзи
 */
return [
    '\:(\w+):/\[cit\](.*?)\[\/cit\]/s' => '',
    /\[cit\](.*?)\[\/cit\]/s

    'tag' => [
        ':-('
    ],
    'codes' => [
        'smile',
        'smile2',
        'smile3'
    ],
    [
        'tag' => [':-)', ':)'],
        'code' => '\1F614'
    ]
	//'sad' => '\1F614', /* Грусть */
    //'grin' => '\1F600' /* Ухмылка */
];
