<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/deploy', '/docs/in-development.html')]
class Deploy implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Deploy');
        return ['name' => 'Deploy'];
    }
}