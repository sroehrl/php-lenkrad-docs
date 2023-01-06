<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/cors', '/docs/cors.html')]
class Cors implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Cors');
        return ['name' => 'Cors'];
    }
}