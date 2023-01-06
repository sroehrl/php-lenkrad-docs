<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/setup', '/docs/setup.html')]
class Setup implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'Setup');
        return ['name' => 'Setup'];
    }
}