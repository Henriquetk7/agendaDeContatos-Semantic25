<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contatos_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Falha na conexão!");
}

?>