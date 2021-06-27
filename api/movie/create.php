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

if (
    !empty($data->title) &&
    !empty($data->year) &&
    !empty($data->director_name) &&
    !empty($data->release_date)
) {
    if(empty($data->description)){
        $description = "No description";
    } else {
        $description = $data->description;
    }

    $movie->title           = $data->title;
    $movie->description     = $description;
    $movie->year            = $data->year;
    $movie->director_name   = $data->director_name;
    $movie->release_date    = $data->release_date;

    if($movie->create()){

        http_response_code(201);
        echo json_encode(array("message" => "Movie created"), JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(503);
        echo json_encode(array("message" => "Movie not created."), JSON_UNESCAPED_UNICODE);

    }
} else {

    http_response_code(400);
    echo json_encode(array("message" => "Movie can't be created. Required data missing"), JSON_UNESCAPED_UNICODE);

}