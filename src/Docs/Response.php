<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/response', '/docs/response.html')]
class Response implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Response');
        return ['name' => 'Response'];
    }
}