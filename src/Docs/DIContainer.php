<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/dependency-injection', '/docs/dicontainer.html')]
class DIContainer implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'DIContainer');
        return ['name' => 'DIContainer'];
    }
}