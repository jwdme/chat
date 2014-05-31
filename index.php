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
    twig_render('about.html' , array());
}

function view_chatroom ($name) {
    twig_render('chatroom.html' , array('roomname' => $name));
}

function join_random () {

    header('Location: /' . random_string(12));
}

function create_room () {
    trim_post_data();
    if(!i sset($_POST['room']) || ! isset($_POST['password'])) {
        die('please complte the form!')

    } else {
        $pass = $_POST['password'];
        $room = $_POST['room'];
        if(strlen($pass) === 0){
            # No password sent to a room
            header('Location: /' . $room);
        } else {
            header('Location: /' . sha1($room . $pass));
        }
    }
    echo '<pre>';
    var_dump($_POST);
}
/*

Support functions

*/

function random_string ($length = 10) {
    $str_out = '';
    for($i = 0; $i < $length; $i++) {
        $str_out .= substr(
            str_shuffle(
                'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
            ),
            0,
            1
        );
    }
    return $str_out;
}
function twig_render($template, $vars) {
    global $twig;
    echo $twig->render($template, $vars);
}

function trim_post_data () {
    foreach($_POST as $key=>$value){
        $_POST[$key] = trim($value);
    }
}
/*

Routes

*/

$app->get('/',              'view_landing');
$app->get('/about',         'view_about');
$app->get('/random',        'join_random');
$app->get('/:name',         'view_chatroom');
$app->post('/create',       'create_room');
$app->run();
