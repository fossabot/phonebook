<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 13.05.15
 * Time: 22:54
 */

return array(
    'GUEST' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'USER' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            'GUEST',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'ADMIN' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'USER',
        ),
        'bizRule' => null,
        'data' => null
    ),
);
