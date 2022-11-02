<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/models', '/docs/models.html')]
class Models implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Models');
        return ['name' => 'Models'];
    }
}