<?php
include('../connect.php');
$json_feed = 'https://worldwidetorrents.eu/api/group/torrents/?id=3';
header("Content-Type: application/json, text/json, text/plain");
$json_data = file_get_contents($json_feed);

$data = json_decode($json_data);
$stmtSelect = $mysqli->prepare("SELECT COUNT(*) FROM torrents WHERE link = ?");
$added = $failed = 0;
$new = [];
foreach ($data->items as $d) {
    $stmtSelect->bind_param("i", $d->id);
    $stmtSelect->execute();
    $stmtSelect->bind_result($exists);
    $stmtSelect->fetch();
	$stmtSelect->reset();
    if ($exists === 0) {
		$stmtInsert = $mysqli->prepare("INSERT INTO torrents (title, info_hash, added, size, category, link) VALUES(?, ?, ?, ?, ?, ?)");
		$stmtInsert->bind_param("sssssi", $d->name, $d->info_hash, $d->added, $d->size, $d->cat_parent, $d->id);
		if ($stmtInsert->execute()) {
			$added = $added + 1;
			$new[] = str_replace('.', ' ', $d->name);
		}
		else {
			$failed = $failed + 1;
		}
		$stmtInsert->close();
	}
}
echo json_encode(
    (object)[
        "added" => $added,
        "new" => $new,
        "failed" => $failed
    ],
    JSON_PRETTY_PRINT);