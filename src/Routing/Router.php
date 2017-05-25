<?php

namespace pxgamer\WwrgTorrents\Routing;

use System\App;
use System\Request;
use System\Route;

/**
 * Class Router
 */
class Router
{
    public function __construct()
    {
        $app = App::instance();
        $app->request = Request::instance();
        $app->route = Route::instance($app->request);
        $route = $app->route;

        // Main
        $route->any('/', ['pxgamer\WwrgTorrents\Modules\Base\Controller', 'index']);
        $route->any('/search', ['pxgamer\WwrgTorrents\Modules\Torrents\Controller', 'search']);
        $route->any('/torrent/{id}:([0-9]+)', ['pxgamer\WwrgTorrents\Modules\Torrents\Controller', 'show']);

        // Route fallback for page not found
        $route->any('/*', ['pxgamer\WwrgTorrents\Modules\Base\Controller', 'error_not_found']);

        $route->end();
    }

    public static function redirect($location = '/')
    {
        if (!headers_sent()) {
            header('Location: ' . $location);
        }
    }
}