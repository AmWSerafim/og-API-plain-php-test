<?php

$api_url = "http://og-php-test/api";

$ch = curl_init();

if($_GET['action'] == 'read'){

    $url = $api_url . "/song/read.php";

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

    $url = $api_url . "/song/read_one.php?id=2";

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

    $url = $api_url . "/song/create.php";
    $data = [
        "title"         => "Test1",
        "album_name"    => "Description",
        "year"          => "2021",
        "artist_name"   => "Al Kis",
        "release_date"  => "2020-01-01 10:20:00"
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

    $url = $api_url . "/song/update.php?id=3";
    $data = [
        "title"         => "upd title",
        "album_name"    => "upd Description",
        "year"          => "2025",
        "artist_name"   => "Upd Al Kis",
        "release_date"  => "2025-01-01 00:00:00"
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

    $url = $api_url . "/song/delete.php";
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