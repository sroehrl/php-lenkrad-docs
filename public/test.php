<?php

namespace Test;

use App\Docs\Home;
use Neoan\Enums\ResponseOutput;
use Neoan\NeoanApp;
use Neoan\Render\Renderer;
use Neoan\Request\Request;
use Neoan\Response\Response;

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$app = new NeoanApp($root . '/src', __DIR__);
Response::setDefaultOutput(ResponseOutput::HTML);
Renderer::setTemplatePath('src/views');
Renderer::setHtmlSkeleton(
    'configuration/views/fresh.html', // our skeleton HTML
    'main',     // our component placement
    [
        'year' => '2000',
        'title' => 'My App'
    ]           // lastly, we can set default variables used in our skeleton
);

\Neoan\Routing\Route::get('/', Home::class)
    ->view('/home.html');
//    ->response([\Neoan\Response\Response::class, 'html']);
$app->run();

