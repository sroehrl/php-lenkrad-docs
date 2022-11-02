<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/routing', '/docs/routing.html')]
class Routing implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Routing');
        return ['name' => 'Routing'];
    }
}