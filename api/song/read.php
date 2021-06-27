<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../obj/song.php';

$database = new Database();
$db = $database->getConnection();

$song = new Song($db);

$stmt = $song->read();
$num = $stmt->rowCount();

if ($num > 0) {

    $songs_array = [];
    $songs_array["records"] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $song_item = [
            "id"            => $id,
            "title"         => $title,
            "album_name"    => $album_name,
            "year"          => $year,
            "artist_name"   => $artist_name,
            "release_date"  => $release_date

        ];

        array_push($songs_array["records"], $song_item);
    }

    http_response_code(200);
    echo json_encode($songs_array);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Nothing found"), JSON_UNESCAPED_UNICODE);
}