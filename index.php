<?php

require "vendor/autoload.php";



$app = new \Slim\Slim();


$app->get('/', function () {
    require 'templates/base.html';
});
$app->get('/about' ,function () {
    echo "<pre>Written by Jared De Blander\n\n";
    passthru('git branch -v');
});
$app->run();

