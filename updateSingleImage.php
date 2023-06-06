<?php
require "database.php";

$imageId = $_GET["id"];
$fileName = $_FILES['image']['name'];
die($fileName);


// // Validate file input to check if is not empty
// if (!file_exists($_FILES["path"]["tmp_name"])) {
//     echo "Choose Image.";
//     // header("Location: index.php");
//     die("Hiiii");
// } else {
//     // Get Image Dimension
//     $fileinfo = @getimagesize($_FILES["path"]["tmp_name"]);
//     $allowed_image_extension = array(
//         "png",
//         "jpg",
//         "jpeg"
//     );

//     // Get image file extension
//     $file_extension = pathinfo($_FILES["path"]["name"], PATHINFO_EXTENSION);

//     if (!in_array($file_extension, $allowed_image_extension)) {
//         echo "Choose png, jpg, jpeg file.";
//         // header("Location: index.php");
//         die();
//     } else {
//         $fileName = $_FILES['path']['name'];
//         move_uploaded_file($_FILES['path']['tmp_name'], "images/" . $fileName);
//     }
// }
// $sqlImageUpdate = "UPDATE inventory_image_table
// SET imagePath = '$inventoryName' , imageExtension = '$inventoryQuantity', imageSize = '$inventoryPrice'
// WHERE imageId = $imageId";
// $result1 = $conn->query($sqlImageUpdate);
