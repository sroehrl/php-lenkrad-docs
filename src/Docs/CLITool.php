<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/cli', '/docs/clitool.html')]
class CLITool implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'CLITool');
        return ['name' => 'CLITool'];
    }
}