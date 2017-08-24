<?php
header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = Db::getInstance(); //

$id = filter_input(INPUT_POST, 'id');

$sql = "DELETE FROM products WHERE id=?";


    if($stmt = $db->mysqli()){
            $stmt = $db->mysqli()->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

        echo json_encode([ "status" => "ok", "msg" => "record is deleted" ]);

    } else {
        echo json_encode([ "status" => "error", "msg" => "record not deleted" ]);
    }
