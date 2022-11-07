<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/custom-attributes', '/docs/in-development.html')]
class CustomAttributes implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'CustomAttributes');
        return ['name' => 'CustomAttributes'];
    }
}