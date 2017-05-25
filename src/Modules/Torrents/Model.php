<?php

namespace pxgamer\WwrgTorrents\Modules\Torrents;

use pxgamer\WwrgTorrents\Server;

class Model
{
    public static function search($query = '', $category = null)
    {
        $query = '%' . $query . '%';

        $db = Server\Database::connect();

        if ($category) {
            $stmt = $db->prepare('SELECT *
                                        FROM torrents
                                        WHERE title LIKE :query
                                        AND category = :category
                                        ORDER BY id DESC');
            $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        } else {
            $stmt = $db->prepare('SELECT *
                                        FROM torrents
                                        WHERE title LIKE :query
                                        ORDER BY id DESC');
        }
        $stmt->bindParam(':query', $query, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function total()
    {
        $stmt = Server\Database::connect()->query('SELECT count(*) AS count FROM torrents');
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ)->count;
    }
}