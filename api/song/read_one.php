<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../obj/song.php';

$database = new Database();
$db = $database->getConnection();

$song = new Song($db);

if(isset($_GET['id'])){
    $song->id = $_GET['id'];
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Song ID not given"), JSON_UNESCAPED_UNICODE);
    die();
}

$song->readOne();

if ($song->title != null){

    $song_array = [
        "id"            => $song->id,
        "title"         => $song->title,
        "album_name"    => $song->album_name,
        "year"          => $song->year,
        "artist_name"   => $song->artist_name,
        "release_date"  => $song->release_date
    ];

    http_response_code(200);
    echo json_encode($song_array);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Movie not exists"), JSON_UNESCAPED_UNICODE);

}