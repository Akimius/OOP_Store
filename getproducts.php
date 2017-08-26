<?php
// the page works for both get all products and edit product
header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM products";

$db = Db::getInstance();

if(!empty($id)){
    $sql .=" " . "WHERE id = {$id}"; // should be a space before where!!!
}

if(!$query = $db->query($sql)) {
    
    json_encode(['status'=>'Error', 'msg'=>'Query failed']);
        die('Connection to the Database failed');
}
    $products = [];
    while($row = $query->fetch_assoc()) {
        $products[] = $row;
    }
echo json_encode($products);


/*1. bind_param
1.5 убрать die рядом с json_encode, перед json_encode добавить echo (smiley)
2. повставлять заголовок с НТТР статусом и кодом ошибки, где надо*/

/*
if(!empty($id)) {

    // $sql = "UPDATE products SET title='{$title}', description='{$description}', price='{$price}'  WHERE id='{$id}'";
    $sql = "UPDATE products SET title=?, description=?, price=?  WHERE id=?";
    // In case id not empty update the existing record

} else {
    // In case id is empty, create a new record
    $sql = "INSERT INTO products (title, price, description) VALUES (?, ?, ?)";
}

if(!empty($title) && !empty($price) && !empty($description)){

   if($stmt = $db->mysqli()){

       $stmt = $db->mysqli()->prepare($sql);
       $stmt->bind_param("sds", $title, $price, $description);
       $stmt->execute();

       echo json_encode([ "status" => "ok", "msg" => "ok" ]);
    }

    
}else{
    echo json_encode([ "status" => "error", "msg" => "Complete all required fields" ]);
}*/