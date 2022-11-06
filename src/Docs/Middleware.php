<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/middleware', '/docs/in-development.html')]
class Middleware implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Middleware');
        return ['name' => 'Middleware'];
    }
}