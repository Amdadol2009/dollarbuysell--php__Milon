<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

$stmt = $mysqli->query("SELECT `name`, `prefix`, `stock`, `icon` FROM `dollarbuysell--currencies` ORDER BY `id` DESC");

if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
      array_push(
        $arr,
        array(
          "name" => $item->name,
          "prefix" => $item->prefix,
          "stock" => $item->stock,
          "icon" => IMAGE_ROOT . '/media/icons/' . $item->icon
        )
      );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  }