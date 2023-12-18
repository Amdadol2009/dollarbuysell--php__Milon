<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");
ini_set('display_error', 1);

include '../db.php';

if ($_GET) {
    $id = $_GET['id'];
    $trx = $_GET['trx'];
    $acc = $_GET['acc'];

    $sql = "UPDATE `dollarbuysell--orders` SET `trx_id`=?, `account_no`=? WHERE `id`=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssi', $trx, $acc, $id);
    if ($stmt->execute()) {
        if ($referer == 'api') {
            echo json_encode(array(
                'status' => true
            ), JSON_UNESCAPED_UNICODE);
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        echo json_encode(array(
            'status' => false
        ), JSON_UNESCAPED_UNICODE);
    }
}

if(isset($_POST['toggle-state'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $sql = "UPDATE `dollarbuysell--orders` SET `status`=!`status` WHERE `id`=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    if ( $stmt->execute() ) {
        $sql = "UPDATE `dollarbuysell--users` SET `trx_count`=`trx_count` + 1 WHERE `id`=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $user_id);
        if ( $stmt->execute() ) {
            echo (true);
        }else{
            echo $mysqli->error;
        }
    }else{
        echo (false);
    }
}
