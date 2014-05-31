<?php

require "vendor/autoload.php";

define('TWIG_TEMPLATE_PATH',        __DIR__ . '/templates');
define('TWIG_TEMPLATE_CACHE_PATH',  false);

$app = new \Slim\Slim();

$loader = new Twig_Loader_Filesystem(TWIG_TEMPLATE_PATH);
$twig = new Twig_Environment(
    $loader,
    array(
        # Define the path to our templates
        'cache' => TWIG_TEMPLATE_CACHE_PATH,

        # Use new templates as soon as they are updated
        'auto_reload' => true
    )
);

/*

Callback functions

*/

function view_landing () {
    twig_render('landing.html' , array());
}

function view_about () {
    echo 'Written by Jared De Blander';
}

function view_chatroom ($name) {
    twig_render('chatroom.html' , array('roomname' => $name));
}

function create_room () {
    echo '<pre>';
    var_dump($_POST);
}
/*

Support functions

*/

function twig_render($template, $vars) {
    global $twig;
    echo $twig->render($template, $vars);
}

/*

Routes

*/

$app->get('/',              'view_landing');
$app->get('/about',         'view_about');
$app->get('/:name',         'view_chatroom');
$app->post('/create',       'create_room');
$app->run();
