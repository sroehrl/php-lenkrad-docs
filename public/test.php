<?php

use Neoan\NeoanApp;

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$app = new NeoanApp($root . '/src', __DIR__);
\Neoan\Routing\Route::get('/')->inject([
    'msg' => "running"
]);
$app->run();