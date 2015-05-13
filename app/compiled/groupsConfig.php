<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/


$app = array();
foreach ( glob(dirname(__DIR__) . '/app/*/*.js') as $file ) {
    $app[] = $file;
}
foreach ( glob(dirname(__DIR__) . '/app/*/*/*.js') as $file ) {
    $app[] = $file;
}
foreach ( glob(dirname(__DIR__) . '/app/*/*/*/*.js') as $file ) {
    $app[] = $file;
}

foreach ( $app as &$file ) {
    $file = '/'.str_replace(dirname(__DIR__),'',$file);
}

$results = array(
    'app' => $app,
    'css' => array(
        //'//css/fonts.css',
        '//bootstrap.css'
    ),
);


return $results;