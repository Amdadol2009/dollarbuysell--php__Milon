<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include 'db.php';

$stmt = $mysqli->query("SELECT * FROM `dollarbuysell--posts` ORDER BY `id` ASC");
if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
        array_push(
            $arr,
            array(
                "id" => $item->id,
                "name" => $item->name,
                "sell_price" => $item->sale_price,
                "buy_price" => $item->buy_price,
                "method" => $item->method,
                "src" => 'http://localhost/dollarbuysell--php/media/icons/'.$item->icon
            )
        );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
