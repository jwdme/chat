<?

require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/about', function() {

    echo 'Written by Jared De Blander';
})
$app->get('/', function ($name) {
    require 'templates/base.html';
});
$app->run();