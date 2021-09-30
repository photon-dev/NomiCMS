<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Получить сессии
$session = $container->get('session');

$view->showed = true;

$captcha = (object) [
    'width' => '120',
    'height' => '60',
    'count' => '4',
    'size' => '18',
    'font' => WEB . 'fonts/Reef.otf',
    'letters' => [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ]
];

// Создание изображения
$image = imagecreatetruecolor($captcha->width, $captcha->height);
imagesavealpha($image, true);
$alpha = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $alpha);

// Нанесение "помех"
for($i = 0; $i < $captcha->count * 2; $i++)
{
    $color = imagecolorallocatealpha($image, rand(0, 255), rand(0, 255), rand(0, 255), 90);
    $letter = $captcha->letters[rand(0, sizeof($captcha->letters)-1)];
    $size = rand($captcha->size-4, $captcha->size+2);
    $width = rand($captcha->width*0.1, $captcha->width-$captcha->width*0.1);
    $height = rand($captcha->height*0.2, $captcha->height);
    imagettftext($image, $size, rand(0, 45), $width, $height, $color, $captcha->font, $letter);
}

// Нанесение символов
for($i = 0; $i < $captcha->count; $i++)
{
    $color = imagecolorallocatealpha($image, rand(50, 220), rand(50, 220), rand(50, 220), rand(20, 40));
    $letter = $captcha->letters[rand(0, sizeof($captcha->letters)-1)];
    $size = rand($captcha->size*2.1-1, $captcha->size*2.1+1);
    $width = ($i+1) * $captcha->size + rand(2, 4);
    $height = (($captcha->height*2)/3) + rand(0, 4);
    $code[] = $letter;
    imagettftext($image, $size, rand(0, 15), $width, $height, $color, $captcha->font, $letter);
}

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

header('Content-type: image/png');
imagepng($image);

$session->captcha = implode('', $code);

imagedestroy($image);
