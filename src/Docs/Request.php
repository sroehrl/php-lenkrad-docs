<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/request', '/docs/request.html')]
class Request implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Request');
        return ['name' => 'Request', 'method' => \Neoan\Request\Request::getRequestMethod()];
    }
}