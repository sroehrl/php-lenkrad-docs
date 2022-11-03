<?php

namespace App\Docs;

use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;

#[Web('/docs/cli-basics', '/docs/clibasics.html')]
class CLIBasics implements Routable
{
    public function __invoke(): array
    {
        Store::write('pageTitle', 'CLIBasics');
        return ['name' => 'CLIBasics'];
    }
}