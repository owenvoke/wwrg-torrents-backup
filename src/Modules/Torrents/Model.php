<?php

namespace pxgamer\WwrgTorrents\Modules\Torrents;

use pxgamer\WwrgTorrents\Config;
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

    public static function cron()
    {
        $db = Server\Database::connect();
        $stmt = $db->prepare('INSERT IGNORE INTO torrents (title, info_hash, added, size, category, link)
                              VALUES(:title, :info_hash, :added, :size, :category, :link)');
        header("Content-Type: text/json, text/plain");
        $json_data = file_get_contents(Config\App::CRON_USER);

        $data = json_decode($json_data);
        $added = $failed = 0;
        $new = [];

        if (!isset($data->items) || !$data->items) {
            die();
        }

        foreach ($data->items as $item) {
            $stmt->bindParam(':title', $item->name, \PDO::PARAM_STR);
            $stmt->bindParam(':info_hash', $item->info_hash, \PDO::PARAM_STR);
            $stmt->bindParam(':added', $item->added, \PDO::PARAM_STR);
            $stmt->bindParam(':size', $item->size, \PDO::PARAM_INT);
            $stmt->bindParam(':category', $item->cat_parent, \PDO::PARAM_STR);
            $stmt->bindParam(':link', $item->id, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($db->lastInsertId() != 0) {
                    $added = $added + 1;
                    $new[] = str_replace('.', ' ', $item->name);
                }
            } else {
                $failed = $failed + 1;
            }
        }

        if (Config\App::ENV_MODE === Config\App::ENV_DEVELOPMENT) {
            Server\Logger::log(
                (object)[
                    "added" => $added,
                    "new" => $new,
                    "failed" => $failed
                ]
            );
        }

        echo json_encode(
            (object)[
                "added" => $added,
                "new" => $new,
                "failed" => $failed
            ]
        );
    }
}
