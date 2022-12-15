<?php
$host = "127.0.0.1:3306";
$user = "Yaroslav744";
$password ="Yaroslav744";
$database = "mrdemiurgen";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}
?>