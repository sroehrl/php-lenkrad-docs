<?php

namespace App\QuickStart;

use Neoan\NeoanApp;
use Neoan\Render\Renderer;
use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/quick-start', '/quickstart.html')]
class QuickStart implements Routable
{
    public function __invoke(NeoanApp $app): array
    {
        Renderer::setHtmlSkeleton('configuration/views/fresh.html', 'main', [
            'title' => 'LENKRAD by neoan.io',
            'webPath' => $app->webPath,
            'currentRoute' => Store::dynamic('currentRoute'),
            'year' => date('Y'),
            'delivered' => Store::dynamic('delivered'),
        ]);
        return ['name' => 'Quick Start'];
    }
}