<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';
$sender_id =$_GET['s'];
$receiver_id =$_GET['r'];

$stmt = $mysqli->query("SELECT `amount_send`, `amount_receive`, (SELECT `stock` FROM `dollarbuysell--currencies` WHERE `id`=$receiver_id) as `reserve`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=$sender_id) as `sender_name`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=$sender_id) as `sender_icon`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=$receiver_id) as `receiver_name`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `id`=$receiver_id) as `receiver_icon`, (SELECT `min` FROM `dollarbuysell--currencies` WHERE `id`=$sender_id) as `min` FROM `dollarbuysell--posts` WHERE `gateway_sender`=$sender_id AND `gateway_receiver`=$receiver_id ORDER BY `id` DESC");

if ($stmt->num_rows > 0) {
    $arr = [];
    while ($item = $stmt->fetch_object()) {
        $icon1 = 'http://localhost/dollarbuysell--php/media/icons/' . $item->sender_icon;
        $icon2 = 'http://localhost/dollarbuysell--php/media/icons/' . $item->receiver_icon;

        echo trim($item->amount_send .",". $item->amount_receive .",". $item->reserve.",". $item->min.",".$item->sender_name .",". $icon1 .",". $item->receiver_name.",". $icon2);
    }
}
