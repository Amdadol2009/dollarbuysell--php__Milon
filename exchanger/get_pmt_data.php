<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';
$id = $_GET['id'];
//echo 'id='.$id;

// $stmt = $mysqli->query("SELECT *
// ,(SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, 
// (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`, 
// (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `icon1`, 
// (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `icon2`, 
// (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `prefix1`, 
// (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `prefix2`, 
// (SELECT `account_no` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `accountNo1`, 
// (SELECT `account_no` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `accountNo2` 
// FROM `dollarbuysell--orders` WHERE `id` = $id ");

$stmt = $mysqli->query("SELECT *
,(SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, 
(SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`, 
(SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `icon1`, 
(SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `icon2`, 
(SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `prefix1`, 
(SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `prefix2`, 
(SELECT `account_no` FROM `dollarbuysell--posts` WHERE `id`=`send_gateway`) as `accountNo1`, 
(SELECT `account_no` FROM `dollarbuysell--posts` WHERE `id`=`receive_gateway`) as `accountNo2` 
FROM `dollarbuysell--orders` WHERE `id` = $id ");

if ($stmt->num_rows > 0) {
	$arr = array();
	while ($item = $stmt->fetch_object()) {
		array_push(
			$arr,
			array(
				"id" => $item->id,
				"sender" => $item->sender,
				"receiver" => $item->receiver,
				"amount_sent" => $item->amount_sent,
				"amount_receive" => $item->amount_receive,
				"trx_id" => $item->trx_id,
				"user_id" => $item->user_id,
				"date" => $item->date,
				"prefix1" => $item->prefix1,
				"prefix2" => $item->prefix2,
				"accountNo1" => $item->accountNo1,
				"accountNo2" => $item->accountNo2,
				
				"src1" => 'http://localhost/dollarbuysell--php_Milon/media/icons/'.$item->icon1,
				"src2" => 'http://localhost/dollarbuysell--php_Milon/media/icons/'.$item->icon2,
			)
		);
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
