<?php

session_start();

require("database.php");

$id = $_GET['id'];

$userid = $_SESSION['user']['id'];

$query = "DELETE FROM finances WHERE id = '$id' AND user_id = '$userid' ";
$result = mysqli_query($conn, $query);

if(!empty($result)){
    header("location: /finances");}
else{
    echo "error";
}