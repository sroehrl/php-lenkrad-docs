<?php

namespace Configuration;

use Neoan\Database\Database;
use Neoan\Database\SqLiteAdapter;
use Neoan\Errors\NotFound;
use Neoan\Helper\Env;
use Neoan\NeoanApp;
use Neoan\Render\Renderer;
use Neoan\Request\Request;
use Neoan\Routing\AttributeRouting;
use Neoan\Store\Store;
use Neoan3\Apps\Template\Constants;

class Loader
{
    public function __invoke(NeoanApp $app): self
    {
        session_start();
        $app->invoke(new AttributeRouting('App'));
        $this->templating($app);
//        $this->database();
        return $this;
    }
    private function templating(NeoanApp $app): void
    {
        Store::write('pageTitle', 'My App');
        Renderer::setTemplatePath('src/views');
        NotFound::setTemplate('configuration/views/404.html');
        Renderer::setHtmlSkeleton('configuration/views/layout.html', 'main', [
            'title' => Store::dynamic('pageTitle'),
            'webPath' => $app->webPath,
            'year' => date('Y'),
            'currentRoute' => Store::dynamic('currentRoute'),
            'version' => $_SESSION['version'] ?? '0.2'
        ]);
        Constants::addCustomAttribute('version', function (\DOMAttr &$attr){
            $version = $attr->value;
            $firstLetter = substr($version,0,1);
            if(in_array($firstLetter,['<','>'])) {
                $version = substr($version,1);
                $proceed = match($firstLetter) {
                    '>' => floatval($_SESSION['version']) > floatval($version),
                    '<' => floatval($_SESSION['version']) < floatval($version)
                };
                if(!$proceed){
                    $attr->parentNode->parentNode->removeChild($attr->parentNode);
                }
                return;
            }

            if($version !== $_SESSION['version']){
                $attr->parentNode->parentNode->removeChild($attr->parentNode);
            }
        });
    }
    private function database(): void
    {

        Database::connect(new SqLiteAdapter([
            'location' => Env::get('DB_LOCATION', __DIR__ . '/database.db')
        ]));
    }
}