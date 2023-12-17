<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");
ini_set('display_error', 1);

include '../db.php';

if ($_GET) {
    $sender_gateway = $_GET['sender_gateway'];
    $receiver_gateway = $_GET['receiver_gateway'];
    $amount_sent = $_GET['sent'];
    $amount_receive = $_GET['receive'];
    $user_id = $_GET['user_id'];
    $referer = $_GET['referer'];
    $trx_no = isset($_GET['trx_no'])?$_GET['trx_no']:null;


    //TODO
    //insert code here

    $sql = "INSERT INTO `dollarbuysell--orders` (`send_gateway`, `receive_gateway`, `amount_sent`, `amount_receive`, `user_id`, `date`) VALUES (?,?,?,?,?,NOW())";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('iissi', $sender_gateway, $receiver_gateway, $amount_sent, $amount_receive, $user_id);
    if ($stmt->execute()) {
        if ($referer == 'api') {
            echo json_encode(array(
                'id' => $stmt->insert_id
            ), JSON_UNESCAPED_UNICODE);
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        echo json_encode(array(
            'status' => $mysqli->error
        ), JSON_UNESCAPED_UNICODE);
    }
}
