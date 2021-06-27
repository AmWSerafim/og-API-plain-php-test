<?php
include_once '../config/code.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../obj/movie.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

$stmt = $movie->read();
$num = $stmt->rowCount();

if ($num > 0) {

    $movies_array = [];
    $movies_array["records"] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $movie_item = [
            "id"            => $id,
            "title"         => $title,
            "description"   => html_entity_decode($description),
            "year"          => $year,
            "director_name" => $director_name,
            "release_date"  => $release_date

        ];

        array_push($movies_array["records"], $movie_item);
    }

    http_response_code(200);
    echo json_encode($movies_array);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Nothing found"), JSON_UNESCAPED_UNICODE);
}