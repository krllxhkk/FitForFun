<!-- ?php

$host = "localhost";
$user = "root";
$password = "";
$database = "project_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> -->
<?php

define('APPROOT', dirname(__DIR__));
define('URLROOT', 'http://localhost/fitforfun');
define('SITENAME', 'FitForFun');