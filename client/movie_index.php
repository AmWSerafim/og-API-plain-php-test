<?php

$api_url = "http://og-php-test/api";
$ch = curl_init();

if($_GET['action'] == 'read'){

    $url = $api_url . "/movie/read.php";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization: Basic '.base64_encode("user_login:user_pass")
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result);

    var_dump($result);

} elseif ($_GET['action'] == 'read_one') {

    $url = $api_url . "/movie/read_one.php?id=2";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization: Basic '.base64_encode("user_login:user_pass")
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result);

    var_dump($result);

} elseif ($_GET['action'] == 'create'){

    $url = $api_url . "/movie/create.php";
    $data = [
        "title"           => "Test1",
        "description"     => "Description",
        "year"            => "2021",
        "director_name"   => "Al Kis",
        "release_date"    => "2020-01-01 10:20:00"
    ];

    $data_json = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization: Basic '.base64_encode("user_login:user_pass")
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result);

    var_dump($result);

} elseif ($_GET['action'] == 'update') {

    $url = $api_url . "/movie/update.php?id=3";
    $data = [
        "title" => "upd title",
        "description" => "upd Description",
        "year" => "2025",
        "director_name" => "Upd Al Kis",
        "release_date" => "2025-01-01 00:00:00"
    ];
    $data_json = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization: Basic '.base64_encode("user_login:user_pass")
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result);

    var_dump($result);
} elseif ($_GET['action'] == 'delete') {

    $url = $api_url . "/movie/delete.php";
    $data = [
        "id" => 5
    ];
    $data_json = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization: Basic '.base64_encode("user_login:user_pass")
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result);

    var_dump($result);
}

curl_close($ch);