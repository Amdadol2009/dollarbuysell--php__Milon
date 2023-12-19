<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

  $stmt = $mysqli->query("SELECT *, 
  (SELECT `name` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `from`, 
  (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `icon` 
  FROM `dollarbuysell--posts` ORDER BY `id` DESC");
  if ($stmt->num_rows > 0) {

    $arr = array();
    while ($item = $stmt->fetch_object()) {
      array_push(
        $arr,
        array(
            "id"=>$item->id,
          "sell" => $item->amount_send,
          "buy" => $item->amount_receive,
          "icon" => IMAGE_ROOT . '/media/icons/' . $item->icon,
        )
      );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}