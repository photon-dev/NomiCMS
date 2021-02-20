<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакета forum
 */
return [
    [
        'url' => '/forum',
        'package' => 'forum',
        'src' => 'index'
    ],
    [
        'url' => '/forum/{num}',
        'package' => 'forum',
        'src' => 'section',
        'params' => [
            'forumId'
        ]
    ],
    [
        'url' => '/forum/{num}/{num}',
        'package' => 'forum',
        'src' => 'section.sub',
        'params' => [
            'forumId', 'forumSubId'
        ]
    ],
    [
        'url' => '/forum/{num}/{num}/{num}',
        'package' => 'forum',
        'src' => 'topic',
        'params' => [
            'forumId', 'forumSubId', 'topicId'
        ]
    ],
    [
        'url' => '/forum/topic/{num}/{str}',
        'package' => 'forum',
        'src' => 'topic.action',
        'params' => [
            'topicId', 'action'
        ]
    ],
    [
        'url' => '/forum/post/{num}/{str}',
        'package' => 'forum',
        'src' => 'post',
        'params' => [
            'postId', 'action'
        ]
    ]
];
