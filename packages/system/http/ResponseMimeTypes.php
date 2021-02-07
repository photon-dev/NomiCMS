<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http;

/**
 * Класс ResponseMimeTypes
 */
class ResponseMimeTypes
{
    public static $mimeTypes = [
        // Текст
        'txt' => 'text/plain',
        'html' => 'text/html',
        'css' => 'text/css',
        'manifest' => 'text/cache-manifest',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => ['application/xml', 'text/xml'],
        'xhtml' => ['application/xhtml+xml', 'application/xhtml', 'text/xhtml'],
        'webp' => 'image/webp',
        'rss' => 'application/rss+xml',
        'ics' => 'text/calendar',

        // Шрифтов
        'otf' => 'font/otf',
        'ttc' => 'font/ttf',
        'ttf' => 'font/ttf',
        'woff' => 'application/x-font-woff',

        // Другие типы
        'pdf' => 'application/pdf',
        'svgz' => 'image/svg+xml',
        'swf' => 'application/x-shockwave-flash',

        // Архивов
        'zip' => 'application/zip',

        // Аудио
        'midi' => 'audio/midi',
        'mp4a' => 'audio/mp4',
        'mp3' => 'audio/mpeg',
        'ogg' => 'audio/ogg',
        'aac' => 'audio/aac',
        'wav' => 'audio/vnd.wave',

        // Видео
        'avi' => 'video/x-msvideo',
        'ogv' => 'video/ogg',
        'webm' => 'video/webm',
        'mp4' => 'video/mp4',
        'qt' => 'video/quicktime',
        'flv' => 'video/x-flv',
        '3gp' => 'video/3gpp',
        '3gp2' => 'video/3gpp2',
        '3gpp' => 'video/3gpp',
        '3gpp2' => 'video/3gpp2',

        // Изображения
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'ico' => 'image/x-icon',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',

        // Psd
        'psd' => [
            'application/photoshop',
            'application/psd',
            'image/psd',
            'image/x-photoshop',
            'image/photoshop',
            'zz-application/zz-winassoc-psd',
        ]
    ];
}
