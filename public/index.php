<?php

use Configuration\Loader;
use Neoan\Enums\GenericEvent;
use Neoan\Event\Event;
use Neoan\NeoanApp;
use Neoan\Request\Request;
use Neoan\Store\Store;

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', true);


$start = microtime(true);

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$app = new NeoanApp($root . '/src', __DIR__ , $root);
$app->invoke(new Loader());
Event::on(GenericEvent::BEFORE_RENDERING, function($event) use($start){
    $uri = Request::getRequestUri();
    Store::write('currentRoute', $uri);
    Store::write('delivered', number_format(microtime(true) - $start,3));
});
$app->run();