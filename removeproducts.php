<?php
header('Content-Type: application/json');
require 'connection.php';

$id = filter_input(INPUT_POST, 'id');

$sql = "DELETE FROM products WHERE id='{$id}' ";

// $sql = "DELETE FROM products WHERE id=18";

    if($query = mysqli_query($link, $sql)){
        echo json_encode([ "status" => "ok", "msg" => "record is deleted" ]);
    } else{
    echo json_encode([ "status" => "error", "msg" => "record not deleted" ]);
}
