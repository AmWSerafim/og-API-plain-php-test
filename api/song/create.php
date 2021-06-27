<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../obj/song.php';

$database = new Database();
$db = $database->getConnection();

$song = new Song($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->title) &&
    !empty($data->album_name) &&
    !empty($data->year) &&
    !empty($data->artist_name) &&
    !empty($data->release_date)
) {

    $song->title        = $data->title;
    $song->album_name   = $data->album_name;
    $song->year         = $data->year;
    $song->artist_name  = $data->artist_name;
    $song->release_date = $data->release_date;

    if($song->create()){

        http_response_code(201);
        echo json_encode(array("message" => "Song created"), JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(503);
        echo json_encode(array("message" => "Song not created."), JSON_UNESCAPED_UNICODE);

    }
} else {

    http_response_code(400);
    echo json_encode(array("message" => "Song can't be created. Required data missing"), JSON_UNESCAPED_UNICODE);

}