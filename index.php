<?php

require "vendor/autoload.php";

define('TWIG_TEMPLATE_PATH',        'templates/');
define('TWIG_TEMPLATE_CACHE_PATH',  false);

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

$app = new \Slim\Slim();


$app->get('/', function () {
    require 'templates/base.html';
});
$app->get('/about' ,function () {
    echo "<pre>Written by Jared De Blander\n\n";
    passthru('git branch -v');
});
$app->get('/:' , function ($name) {
    echo $twig->render($template, (''));
});
$app->post('/create' , function () {
    echo '<pre>';
    var_dump($_POST);
})
$app->run();

