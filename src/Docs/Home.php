<?php

namespace App\Docs;

use Neoan\Request\Request;
use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs', '/docs/home.html')]
class Home implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Home');
        return [
            'name' => 'Home',
            'say' => Request::getQuery('say') ?? ''
        ];
    }
}