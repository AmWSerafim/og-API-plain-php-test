<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../obj/movie.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

$data = json_decode(file_get_contents("php://input"));

var_dump($data);

if(!empty($data->id)) {
    $movie->id = $data->id;

    if ($movie->delete()) {

        http_response_code(200);
        echo json_encode(array("message" => "Movie deleted successfully"), JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(503);
        echo json_encode(array("message" => "Movie wasn't deleted"));
    }

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Movie ID not given"), JSON_UNESCAPED_UNICODE);

}