<?php
require "database.php";

$inventoryId = $_POST["inventoryId"];
$inventoryName = $conn -> real_escape_string($_POST['inventoryName']);
$inventoryQuantity = $_POST['inventoryQuantity'];
$inventoryPrice = $_POST['inventoryPrice'];
$inventoryDateIn = $_POST['inventoryDateIn'];

// Validate file input to check if is not empty
if (! file_exists($_FILES["inventoryImage"]["tmp_name"])) {
    echo "Choose Image.";
    // header("Location: index.php");
    die();
}
else 
{
    // Get Image Dimension
    $fileinfo = @getimagesize($_FILES["inventoryImage"]["tmp_name"]);        
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["inventoryImage"]["name"], PATHINFO_EXTENSION);

    if (! in_array($file_extension, $allowed_image_extension)) {
        echo "Choose png, jpg, jpeg file.";
        // header("Location: index.php");
        die();
    }
    else {
        $fileName = $_FILES['inventoryImage']['name'];
        move_uploaded_file($_FILES['inventoryImage']['tmp_name'], "images/" . $fileName);
    }
    
}

$sql = "UPDATE inventory_table
SET name = '$inventoryName' , quantity = '$inventoryQuantity', price = '$inventoryPrice', dateIn = '$inventoryDateIn', image = '$fileName'
WHERE id = $inventoryId";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    die();
} 
?>