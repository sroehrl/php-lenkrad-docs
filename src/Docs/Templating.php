<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/templating', '/docs/templating.html')]
class Templating implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Templating');
        return ['name' => 'Templating'];
    }
}