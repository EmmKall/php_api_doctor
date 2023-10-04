<?php

/* Headers */
header("Access-Control-Allow-Origin: * ");
header('content-type: application/json; charset=utf-8, form-data');
header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, x-www-form-urlencoded");
header("Access-Control-Request-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, x-www-form-urlencoded");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

require 'vendor/autoload.php';

/* Dotenv */
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

include_once './public/index.php';



