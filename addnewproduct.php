<?php
header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = Db::getInstance(); //

$title = filter_input(INPUT_POST, 'title');
$price = filter_input(INPUT_POST, 'price');
$description = filter_input(INPUT_POST, 'description');
$id = filter_input(INPUT_POST, 'id');

/*
$title = $connection->real_escape_string($title);
$price = $connection->real_escape_string($price);
$description = $connection->real_escape_string($description);*/
    
//$title = mysqli_escape_string($link, $title);
//$price = mysqli_escape_string($link, $price);
//$description = mysqli_escape_string($link, $description);


$sql = '';

if(!empty($id)) {

    $sql = "UPDATE products SET title='{$title}', description='{$description}', price='{$price}'  WHERE id='{$id}'";
    // In case id not empty update the existing record

} else {

    // $sql = "INSERT INTO products VALUES (null, '{$title}', '{$description}', '{$price}')";
    // In case id is empty, create a new record
    // prepare and bind
    $stmt = $connection->prepare("INSERT INTO products (title, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $title, $price, $description);

}

if(!empty($title) && !empty($price) && !empty($description)){

    $stmt->execute();

/*   if($query = $db->query($sql)){
        echo json_encode([ "status" => "ok", "msg" => "ok" ]);
    }*/

    
}else{
    echo json_encode([ "status" => "error", "msg" => "Complete all required fields" ]);
}
