<?php

namespace App\StarterProjects;

use Neoan\NeoanApp;
use Neoan\Render\Renderer;
use Neoan\Routing\Attributes\Web;
use Neoan\Routing\Interfaces\Routable;
use Neoan\Store\Store;

#[Web('/starter-projects', '/starter-projects.html')]
class StarterProjects implements Routable
{
    public function __invoke(NeoanApp $app): array
    {
        Renderer::setHtmlSkeleton('configuration/views/fresh.html', 'main', [
            'title' => 'LENKRAD by neoan.io',
            'webPath' => $app->webPath,
            'currentRoute' => Store::dynamic('currentRoute'),
            'year' => date('Y'),
            'delivered' => Store::dynamic('delivered'),
            'name' => 'Starter Projects',
            'bar-color' => 'border-accent'
        ]);
        return [];
    }
}