<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../obj/movie.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

if(isset($_GET['id'])){
    $movie->id = $_GET['id'];
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Movie ID not given"), JSON_UNESCAPED_UNICODE);
    die();
}

$movie->readOne();

if ($movie->title != null){

    $movie_array = [
        "id"            => $movie->id,
        "title"         => $movie->title,
        "description"   => $movie->description,
        "year"          => $movie->year,
        "director_name" => $movie->director_name,
        "release_date"  => $movie->release_date
    ];

    http_response_code(200);
    echo json_encode($movie_array);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Movie not exists"), JSON_UNESCAPED_UNICODE);

}