<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';
$arr = array();
$folder_path = "http://localhost/dollarbuysell--php/media/icons/";

$stmt = $mysqli->query("SELECT * FROM `dollarbuysell--currencies` WHERE `active`<>0 ORDER BY `id` ASC");
if ($stmt->num_rows > 0) {
    while ($item = $stmt->fetch_object()) {
        array_push(
            $arr,
            array(
                "id" => $item->id,
                "name" => $item->name,
                "prefix" => $item->prefix,
                "src" => $folder_path . $item->icon,
            )
        );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
