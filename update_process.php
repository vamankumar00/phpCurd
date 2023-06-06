<?php
require "database.php";
$inventoryId = $_POST["inventoryId"];
$inventoryName = $conn->real_escape_string($_POST['inventoryName']);
$inventoryQuantity = $_POST['inventoryQuantity'];
$inventoryPrice = $_POST['inventoryPrice'];
$inventoryDateIn = $_POST['inventoryDateIn'];
$imageId = $_POST['imageId'];
$newImage = $_FILES['image']['name'];

// echo json_encode($images = $_FILES['image']);
// die();

if (count($imageId) === count($newImage)) {
    // Loop through the arrays simultaneously
    foreach ($imageId as $index => $id) {
        $image = $_FILES['image'];
        // echo "Image ID: " . $id . ", New Image: " . $image . "<br>";
        // die();
        if (empty($image)) {
            echo "Hi";
            die();
        } else {
            // $fileinfo = @getimagesize($_FILES["inventoryImage"]["tmp_name"]);
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
        }
        $file = basename($image['name'][$index]);
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);
        $fileName = date('YmdHis') . "$index." . $file_extension;
        $targetFilePath = "$inventoryId/" . $fileName;
        $imageSize = $image['size'][$index];
        $file_extension = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // echo json_encode($allowed_image_extension);
        // echo "<br/>";
        // echo json_encode($file_extension);
        // die();
        if (in_array($file_extension, $allowed_image_extension)) {
            // echo "$targetFilePath";
            // die();
            $ifMoved = move_uploaded_file($image['tmp_name'][$index], $targetFilePath);
            if ($ifMoved == 1) {
                $sqlForImagePath = "SELECT imagePath FROM inventory_image_table WHERE imageId = $id";
                $result2 = $conn->query($sqlForImagePath);

                $oldImagePath = mysqli_fetch_array($result2)['imagePath'];

                // echo json_encode($roww);
                // die();
                unlink($oldImagePath);
                $sqlForImageUpdate = "UPDATE inventory_image_table
                SET imagePath = '$targetFilePath' , imageExtension = '$file_extension', imageSize = '$imageSize'
                WHERE imageId = $id";
                $result1 = $conn->query($sqlForImageUpdate);
            }
        } else {
            echo "Choose png, jpg, jpeg file.";
        }
    }
} else {
    echo "Number of elements in the arrays does not match.";
}
// die();

$sql = "UPDATE inventory_table
SET name = '$inventoryName' , quantity = '$inventoryQuantity', price = '$inventoryPrice', dateIn = '$inventoryDateIn'
WHERE id = $inventoryId";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    die();
}
