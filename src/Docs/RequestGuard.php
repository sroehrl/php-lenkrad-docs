<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/requestguard', '/docs/requestguard.html')]
class RequestGuard implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'RequestGuard');
        return ['name' => 'RequestGuard'];
    }
}