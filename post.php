<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include 'db.php';

$name = $_POST['name'];
$prefix = $_POST['prefix'];
$accNo = $_POST['accNo'];
$stock = $_POST['stock'];
$min = $_POST['min'];

$count = 0;
$upload_count = 0;

if (isset($_POST['add'])) {
    if (isset($_FILES["icon"]["name"]) && !empty($_FILES["icon"]["name"])) {
        // don't insert if file name empty

        $uploaded_file = $_FILES['icon']['tmp_name'];
        $upl_img_properties = getimagesize($uploaded_file);
        $file_name_id = uniqid();
        $new_file_name = $file_name_id;
        $folder_path = "./media/icons/";
        $img_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
        $image_type = $upl_img_properties[2];

        switch ($image_type) {
                //for PNG Image
            case IMAGETYPE_PNG:
                $image_type_id = imagecreatefrompng($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
                //for GIF Image
            case IMAGETYPE_GIF:
                $image_type_id = imagecreatefromgif($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagegif($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
                //for JPEG Image
            case IMAGETYPE_JPEG:
                $image_type_id = imagecreatefromjpeg($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagejpeg($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;

            default:
                echo "Please select a 'PNG', 'GIF'or JPEG image";
                exit;
                break;
        }
        // END


        $icon = $new_file_name . "." . $img_ext;

        if (move_uploaded_file($uploaded_file, $folder_path . $file_name_id . "." . $img_ext)) {

            $sql = "INSERT INTO `dollarbuysell--currencies` (`name`, `prefix`,`stock`,`icon`,`min`) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ssdsi', $name, $prefix, $stock, $icon, $min);
            $stmt->execute();

            header('location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $result['status'] =  "Not uploaded because of error #" . $_FILES["icon"]["error"];
        }
    } else {

        $sql = "INSERT INTO `dollarbuysell--currencies` (`name`, `prefix`,`stock`,`min`) VALUES (?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssdi', $name, $prefix, $stock, $min);
        if($stmt->execute()){
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo ($mysqli->error);
        }

    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit'];

    $sql = "UPDATE `dollarbuysell--currencies` SET `name`=?, `accNo`=?, `prefix`=?, stock=?, min=? WHERE `id`=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssdii', $name, $accNo, $prefix, $stock,$min, $id);
    $stmt->execute();
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

function image_resize($image_type_id, $img_width, $img_height)
{
    $target_width = 150;
    $target_height = 150;
    $target_layer = imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_type_id, 0, 0, 0, 0, $target_width, $target_height, $img_width, $img_height);
    return $target_layer;
}

if (isset($_GET['del']) && isset($_GET['id']) && isset($_GET['ref'])) {
    //Delete prev Images;
    $id = $_GET["id"];
    $ref = $_GET["ref"];

    unlink($ROOT . "./media/icons/" . $ref);

    $sql = "UPDATE `dollarbuysell--currencies` SET icon = null WHERE `id`=$id";
    $retval = $mysqli->query($sql);

    header('location: ' . $_SERVER['HTTP_REFERER']);
}
