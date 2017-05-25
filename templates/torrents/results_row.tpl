<tr>
    <td><a class="no-underline" target="_blank"
           href="//worldwidetorrents.eu/torrents-details.php?id={$torrent->link}">{$torrent->title}</a></td>
    <td class="date-column"><span class="pull-right">{$torrent->added|absolute_time}</span></td>
    <td class="category-column"><span class="pull-right">{$torrent->category}</span></td>
    <td class="hash-column">{$torrent->info_hash}</td>
    <td class="size-column"><span class="pull-right">{$torrent->size|file_size}</span></td>
    <td>{pxgamer\WwrgTorrents\Modules\Torrents\Helper::magnetLink($torrent->info_hash, $torrent->title)}</td>
</tr>