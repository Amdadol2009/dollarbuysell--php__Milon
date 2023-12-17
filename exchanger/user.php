<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';
$uid = $_GET['uid'];

// Output arrays
$arr = array();

// Output object
$sql = "SELECT `id`,`name`,`email`,`mobile`,`trx_count`,`reg_date` FROM `dollarbuysell--users` WHERE `id` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $uid);
$stmt->execute();
$stmt->store_result();
$numRows = $stmt->num_rows;
if ($numRows > 0) {
	$stmt->bind_result($id, $name, $email, $phone, $trx_count, $reg_date);
	while ($stmt->fetch()) {
		array_push(
			$arr,
			array(
				'user_id' => $id,
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'trx_count' => $trx_count,
				'reg_date' => $reg_date,
			)
		);
	}
	echo json_encode(
		$arr,
		JSON_UNESCAPED_UNICODE
	);
}
