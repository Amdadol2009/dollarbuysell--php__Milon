<?php
if($_POST):
$value= $_POST['notification-input'];
$query = "UPDATE `dollarbuysell--settings` SET `notification_text`=? WHERE `id`=1";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s",$value);
if($stmt->execute()){
    header("location: " . $_SERVER['HTTP_REFERER']);
}
endif;
?>

<form class="mb-2" method="post">
    <h4>Notification setting</h4>
    <div class="flex">
        <input class="form-control" id="notification-input" name="notification-input"/>
        <button class="btn-primary ms-3" type="submit">Save</button>
    </div>
</form>