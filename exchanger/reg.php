<?php
header('Content-type: application/json; charset=utf8');
header("Access-Control-Allow-Origin: *");

include '../db.php';

if ($_GET) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $password = md5($_GET['password']);
    $phone = $_GET['phone'];
    $referer = $_GET['referer'];

    $sql = "INSERT INTO `dollarbuysell--users` ( `name`, `email`, `password`, `mobile`,`reg_date`) VALUES (?,?,?,?,NOW())";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $password, $phone);
    $stmt->execute();

    if ($referer == 'api') {
        echo json_encode(array(
            'user_id'=>$stmt->insert_id,
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone
        ),JSON_UNESCAPED_UNICODE);
    } else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
