<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

$stmt = $mysqli->query("SELECT *, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `from`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `gateway_receiver`=`id`) as `to`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `icon1`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `gateway_receiver`=`id`) as `icon2`, (SELECT `stock` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `stock`, (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `prefix` FROM `dollarbuysell--posts` ORDER BY `id` DESC");

if ($stmt->num_rows > 0) {
  $arr = array();
  while ($item = $stmt->fetch_object()) {
    array_push(
      $arr,
      array(
        "id" => $item->id,
        "from" => $item->from,
        "to" => $item->to,
        "amount_send" => $item->amount_send,
        "amount_receive" => $item->amount_receive,
        "src1" => 'http://localhost/dollarbuysell--php/media/icons/' . $item->icon1,
        "src2" => 'http://localhost/dollarbuysell--php/media/icons/' . $item->icon2,
      )
    );
  }
  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
