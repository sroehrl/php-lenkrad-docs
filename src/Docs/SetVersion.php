<?php

namespace App\Docs;

use Neoan\Routing\Attributes\Get;
use Neoan\Routing\Interfaces\Routable;

#[Get('/api/version')]
class SetVersion implements Routable
{
    public function __invoke(): array
    {
        $_SESSION['version'] = \Neoan\Request\Request::getQuery('v');
        return ['version' => $_SESSION['version']];
    }
}