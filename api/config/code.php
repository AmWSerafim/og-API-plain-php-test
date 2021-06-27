<?php
define("USER_LOGIN", 'user_login');
define("USER_PASSWORD", 'user_pass');

if($_SERVER['PHP_AUTH_USER'] != USER_LOGIN || $_SERVER['PHP_AUTH_PW'] != USER_PASSWORD ){
    http_response_code(500);
    echo json_encode(array("message" => "Access denied for given access data"), JSON_UNESCAPED_UNICODE);
    die();
}