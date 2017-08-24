<?php
header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = Db::getInstance(); //

$id = filter_input(INPUT_POST, 'id');

$title = filter_input(INPUT_POST, 'title');
$price = filter_input(INPUT_POST, 'price');
$description = filter_input(INPUT_POST, 'description');

/*$title = $db->mysqli()->real_escape_string($title);
$price = $db->mysqli()->real_escape_string($price);
$description = $db->mysqli()->real_escape_string($description);*/




if(!empty($id)) {

    $sql = "UPDATE products SET title='{$title}', description='{$description}', price='{$price}'  WHERE id='{$id}'";
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
}
