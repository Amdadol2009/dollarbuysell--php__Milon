<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");
ini_set('display_error',1);

include '../db.php';

if ($_GET) {
    $email = $_GET['email'];
    $password = md5($_GET['password']);
    $referer = $_GET['referer'];

    $sql = "SELECT `id`,`name`,`email`,`mobile`,`trx_count`,`reg_date` FROM `dollarbuysell--users` WHERE `email` = ? AND `password` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();
    $numRows = $stmt->num_rows;
    if ($numRows > 0) {
        $stmt->bind_result($id, $name, $email, $phone,$trx_count,$reg_date);
        $stmt->fetch();
        if ($referer == 'api') {
            echo json_encode(array(
                'user_id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'trx_count' => $trx_count,
                'reg_date' => $reg_date,
            ), JSON_UNESCAPED_UNICODE);
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        if ($referer == 'api') {
            // echo ('null');
        }else{
            // echo $mysqli->error;
        }
        echo ('null');
    }
}
