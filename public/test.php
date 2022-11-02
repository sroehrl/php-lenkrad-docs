<?php

namespace Test;

use App\Docs\Home;
use Neoan\NeoanApp;
use Neoan\Request\Request;

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$app = new NeoanApp($root . '/src', __DIR__);
\Neoan\Routing\Route::get('/', Home::class)->view('src/views/home.html')
    ->response([\Neoan\Response\Response::class, 'html']);
$app->run();

