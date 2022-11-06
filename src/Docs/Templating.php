<?php

namespace App\Docs;

use App\Search\Search;
use Neoan\NeoanApp;
use Neoan\Routing\Interfaces\Routable;
use Neoan\Routing\Attributes\Web;
use Neoan\Store\Store;
use Neoan\Request\Request;

#[Web('/docs/templating', '/docs/templating.html')]
class Templating implements Routable
{
    public function __invoke(NeoanApp $app): array
    {
        Store::write('pageTitle', 'Templating');
        $search = new Search();
        Request::setQueries([...Request::getQueries(), 'query' => 'model']);
        return [
            'name' => 'Templating',
            'boolean' => true,
            'today' => date('m/d/Y'),
            'results' => $search($app)['sections'],

        ];
    }
}