<?php

header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

$query = "SELECT * FROM `dollarbuysell--settings`";
$stmt = $mysqli->query($query);

if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
      array_push(
        $arr,
        array(
          "id" => $item->id,
          "notification" => $item->notification_text,
        )
      );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  }
  