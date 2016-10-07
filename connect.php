<?php
$mysqli = new mysqli('localhost', 'wwrg-torrents', 'TaJ35Nme8Wc7EYQ8', 'wwrg-torrents');
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
