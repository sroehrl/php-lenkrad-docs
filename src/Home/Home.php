<?php

namespace App\Home;

use Neoan\NeoanApp;
use Neoan\Render\Renderer;
use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/', '/home.html')]
class Home implements Routable
{
    public function __invoke(NeoanApp $app): array
    {
        Renderer::setHtmlSkeleton('configuration/views/fresh.html', 'main', [
            'title' => 'LENKRAD by neoan.io',
            'webPath' => $app->webPath,
            'currentRoute' => Store::dynamic('currentRoute'),
            'year' => date('Y'),
            'delivered' => Store::dynamic('delivered'),
            'bar-color' => 'border-secondary'
        ]);
        return ['name' => 'Welcome'];
    }
}