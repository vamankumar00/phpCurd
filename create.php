<?php
require "database.php";



if (isset($_POST["submit"])) {
    $inventoryName = $_POST['inventoryName'];
    $inventoryQuantity = $_POST['inventoryQuantity'];
    $inventoryPrice = $_POST['inventoryPrice'];
    $inventoryDateIn = $_POST['inventoryDateIn'];
}
else {
    echo "Insert Data first!";
    die();
}
    // Validate file input to check if is not empty
    if (! file_exists($_FILES["inventoryImage"]["tmp_name"])) {
        $response = array(
            "type" => "error",
            "message" => "Choose image file to upload."
        );
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
            if (is_dir("images")) {
                $fileName = $_FILES['inventoryImage']['name'];
                move_uploaded_file($_FILES['inventoryImage']['tmp_name'], "images/" . $fileName);    
            }
            else {
                mkdir("images/");
                $fileName = $_FILES['inventoryImage']['name'];
                move_uploaded_file($_FILES['inventoryImage']['tmp_name'], "images/" . $fileName);    
            }
        }
      
    }

//image without validation
// if (isset($_FILES['inventoryImage'])) {
//     $fileName = $_FILES['inventoryImage']['name'];
//     move_uploaded_file($_FILES['inventoryImage']['tmp_name'], "images/" . $fileName);

// } else {
//     echo "image not found!";
//     die();
// }
//End Image 

if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
    $fileUrl = "images/$fileName";
    $sql = "INSERT INTO inventory_table (name, quantity, price, dateIn, image)
    VALUES ('$inventoryName', '$inventoryQuantity', '$inventoryPrice', '$inventoryDateIn', '$fileUrl')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


?>
