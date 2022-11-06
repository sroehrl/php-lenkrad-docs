<?php

namespace App\Search;

use Neoan\NeoanApp;
use Neoan\Request\Request;
use Neoan\Routing\Attributes\Get;
use Neoan\Routing\Interfaces\Routable;

#[Get('/api/search')]
class Search implements Routable
{
    private string $searchIndex = __DIR__ . '/searchIndex.json';
    private array $searchable;
    public function __invoke(NeoanApp $app): array
    {
        if(!file_exists($this->searchIndex) || filemtime($this->searchIndex) < time() - (60*60*24)) {
            $this->searchable =  $this->searchIndex($app);
        } else {
            $this->searchable = json_decode(file_get_contents($this->searchIndex), true);
        }
        return $this->search();

    }
    public function search(): array
    {
        $results = [
            'topics' => [],
            'sections' => [],
            'text' => []
        ];
        $searchString = Request::getQuery('query');
        foreach ($this->searchable as $route) {
            // topic?
            if(str_contains($route['topic'], $searchString)){
                $results['topics'][] = [
                    'link' => $route['url'],
                    'headline' => strtoupper($route['topic']),
                    'context' => $route['description']
                ];
            }

            // headlines
            foreach ($route['headlines'] as $headline) {
                if(str_contains(strtolower($headline['title']), $searchString)){
                    $term = 'id="' . $headline['id'] . '">';
                    $results['sections'][] = [
                        'link' => $route['url'] . '#' . $headline['id'],
                        'topic' => strtoupper($route['topic']),
                        'headline' => strtoupper($headline['title']),
                        'context' => $headline['context']
                    ];
                }
            }
            // then content
            $hits = preg_match_all('/(.{1,120})' . $searchString . '(.{1,120})/', $route['content'], $contentMatches);
            if($hits){

                foreach ($contentMatches as $i => $contentMatch){
                    $context = trim(strip_tags($contentMatch[0]));
                    if(!empty($context)){
                        $results['text'][] = [
                            'link' => $route['url'],
                            'context' => '...' . $context . '...'
                        ];
                    }


                }

            }
        }

        return $results;
    }
    private function contentMatchEvaluation(): array
    {
        return [
            'link' => '',
            'headline' => '',
            'context' => ''
        ];
    }

    private function provideContext(string $term, string $fullContent, int $offset = 0): array
    {
        $cleanContent = trim(strip_tags($fullContent));
//        var_dump($cleanContent);
        $naturalOffset = strpos(strtolower($cleanContent), strtolower($term));
        $context = substr($cleanContent, $naturalOffset + $offset, 300);
        $clean = trim(preg_replace('/\n\s*/', ' ', $context)) . '...';
        return [
            'context' => $clean
        ];
    }

    private function searchIndex(NeoanApp $app): array
    {
        $fileIndex = [];
        foreach (glob($app->appPath . '/views/docs/*.html') as $file){
            $fileContent = file_get_contents($file);
            preg_match('/<h1[^>]*>([^<]+)/i', $fileContent, $topicMatches);
            preg_match_all('/<h\d\sid="([^"]+)[^>]+>([^<]+)<\/h\d>/i', $fileContent, $headlineMatches, PREG_SET_ORDER);
            $fileContent = preg_replace('/\n\s+/', ' ', $fileContent);
            $headlines = [];
            foreach ($headlineMatches as $hit) {

                $headlines[] = [
                    'id' => $hit[1],
                    'title' => $hit[2],
                    'context' => trim(strip_tags(substr($fileContent, strpos($fileContent, $hit[0]) + strlen($hit[0]), 400)))
                ];
            }

            $url = preg_match('/<!--\s*url:\s+(\S+)/i', $fileContent, $matches);
            // remove comments
            $fileContent = preg_replace('/<!--[^>]>/','', $fileContent);
            $fileIndex[] = [
                'file' => $file,
                'topic' => strtolower($topicMatches[1]),
                'description' => $this->provideContext(strtolower($topicMatches[1]), $fileContent, strlen(strtolower($topicMatches[1])))['context'],
                'content' => $fileContent,
                'headlines' => $headlines,
                'url' => $url ? $matches[1] : '/docs'
            ];

        }
        file_put_contents($this->searchIndex, json_encode($fileIndex));
        return $fileIndex;
    }
}