<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/dynamic-store', '/docs/dynamicstore.html')]
class DynamicStore implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'DynamicStore');
        return ['name' => 'DynamicStore'];
    }
}