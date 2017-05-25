<?php

namespace pxgamer\WwrgTorrents\Modules\Torrents;

use pxgamer\WwrgTorrents\Modules\Torrents;
use pxgamer\WwrgTorrents\Routing;

class Controller extends Routing\Base
{
    public function search()
    {
        $data = new \stdClass();

        $query = $this->request->query['q'] ?? null;
        $category = $this->request->query['c'] ?? null;

        $data->torrents = Torrents\Model::search($query, $category);

        $this->smarty->display(
            'torrents/search.tpl',
            [
                'data' => $data
            ]
        );
    }
}