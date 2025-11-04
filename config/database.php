<?php
$host = getenv('DB_HOST') ?: 'localhost';
$db = getenv('DB_NAME') ?: 'proyutu';
$username = getenv('DB_USER') ?: 'proyutu';
$password = getenv('DB_PASS') ?: '12345678';


return [
    "driver"    => "mysql",
    // HOST debe ser el nombre del servicio de la BD en Docker Compose ('db')\par
    "host"      => $host,
    "database"  => $db,
    "username"  => $username,
    "password"  => $password,
    "charset"   => "utf8mb4",
    "options"   => [
        PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    
]];


