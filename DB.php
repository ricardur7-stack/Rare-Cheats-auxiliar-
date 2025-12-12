<?php
//$dbName = "libpro";
//$user = "libonline";
//$pwd = "HQAa9@3j@KD3Dbj";
//$host = "localhost";
//conn = new PDO('mysql:dbname='//.$dbName.';host='.$host, $user//, $pwd);
//api url filter
if(strpos($_SERVER['REQUEST_URI'],"DB.php")){
    require_once 'Utils.php';
    PlainDie();
}

$conn = new mysqli("localhost", "id17482624_p1", "lOljcF5C00!oI9JT", "id17482624_p");
if($conn->connect_error != null){
    die($conn->connect_error);
}