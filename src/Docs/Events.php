<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/events', '/docs/in-development.html')]
class Events implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Events');
        return ['name' => 'Events'];
    }
}