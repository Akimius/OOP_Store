<?php

header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM products";

$db = Db::getInstance();

if(!empty($id)){
    $sql .= "WHERE id = {$id}";
}

if(!$query = $db->query($sql)) {
    json_encode(['status'=>'Error', 'msg'=>'Query failed']);
        die('Connection to the Database failed!!!');
}
    $products = [];
    while($row = $query->fetch_assoc()) {
        $products[] = $row;
    }
echo json_encode($products);


/*1. bind_param
1.5 убрать die рядом с json_encode, перед json_encode добавить echo (smiley)
2. повставлять заголовок с НТТР статусом и кодом ошибки, где надо*/