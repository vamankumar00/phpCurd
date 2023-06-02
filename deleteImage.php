<?php
require "database.php";
$imageId = $_POST["id"];
$imagePath = $_POST["path"];

$sql = "DELETE FROM inventory_image_table WHERE imageId = '$imageId'";
$result = $conn->query($sql);
unlink($imagePath);

if ($result) {
    echo "Delete Successfully";
} else {
    echo "could not Delete";
}
die();
?>