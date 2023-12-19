<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

if(isset($_GET['latest-exchanges'])){
    $stmt = $mysqli->query("SELECT *, 
  (SELECT `name` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `from`, 
  (SELECT `name` FROM `dollarbuysell--currencies` WHERE `receive_gateway`=`id`) as `to`, 
  (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `icon1`, 
  (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `receive_gateway`=`id`) as `icon2`, 
  (SELECT SUBSTRING_INDEX(`email`,'@',1) FROM `dollarbuysell--users` WHERE `id`=`user_id`) as `username`, 
  (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `receive_gateway`=`id`) as `prefix` FROM `dollarbuysell--orders` ORDER BY `id` DESC");

  if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
      array_push(
        $arr,
        array(
          "from" => $item->from,
          "to" => $item->to,
          "amount_receive" => $item->amount_receive,
          "prefix" => $item->prefix,
          "date" => $item->date,
          "status" => $item->status,
          "username" => $item->username,
          "src1" => IMAGE_ROOT . '/media/icons/' . $item->icon1,
          "src2" => IMAGE_ROOT . '/media/icons/' . $item->icon2,
        )
      );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  }
}else{
  $stmt = $mysqli->query("SELECT *, 
  (SELECT `name` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `from`, 
  (SELECT `name` FROM `dollarbuysell--currencies` WHERE `receive_gateway`=`id`) as `to`, 
  (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `icon1`, 
  (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `receive_gateway`=`id`) as `icon2`, 
  (SELECT `stock` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `stock`, 
  (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `send_gateway`=`id`) as `prefix` FROM `dollarbuysell--orders` ORDER BY `id` DESC");
  
  if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
      array_push(
        $arr,
        array(
          "id" => $item->id,
          "from" => $item->from,
          "to" => $item->to,
          "amount_sent" => $item->amount_sent,
          "amount_receive" => $item->amount_receive,
          "account_no" => $item->account_no,
          "trx_id" => $item->trx_id,
          "date" => $item->date,
          "src1" => IMAGE_ROOT . '/media/icons/' . $item->icon1,
          "src2" => IMAGE_ROOT . '/media/icons/' . $item->icon2,
        )
      );
    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  }
}

