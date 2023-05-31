<?php
require "database.php";

// print_r($_REQUEST);

if (isset($_POST["submit"])) {
    $inventoryName = $_POST['inventoryName'];
    $inventoryQuantity = $_POST['inventoryQuantity'];
    $inventoryPrice = $_POST['inventoryPrice'];
    $inventoryDateIn = $_POST['inventoryDateIn'];
    $newDate = date("Y-m-d", strtotime($inventoryDateIn));
    $fileNames = array_filter($_FILES['inventoryImage']['name']);
    $insertValuesSQL = "";

    // Validate file input to check if is not empty -------- image
    if (empty($fileNames)) {
        echo "Hi";
        die();
    } else {
        // $fileinfo = @getimagesize($_FILES["inventoryImage"]["tmp_name"]);
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
    } // -------------image End

    // $fileUrl = "$inventoryName/$fileName";
    $sql = "INSERT INTO inventory_table (name, quantity, price, dateIn)
    VALUES ('$inventoryName', '$inventoryQuantity', '$inventoryPrice', '$newDate')";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        // $sqlExtractLastId = "SELECT MAX(id) FROM inventory_table";
        // $resultIdFromDb = $conn->query($sqlExtractLastId);
        // $row = mysqli_fetch_row($resultIdFromDb);
        // $resultId = $row[0];
        // echo $resultId;
        // die();
        $resultId = mysqli_insert_id($conn);

        // $sql = "SELECT name FROM inventory_table WHERE id=$resultId";
        // $result = $conn->query($sql);
        // $data = mysqli_fetch_row($result);


        if (!(is_dir("$resultId"))) {
            mkdir("$resultId/");
        }
        foreach ($_FILES['inventoryImage']['name'] as $key => $val) {
            $fileName = basename($_FILES['inventoryImage']['name'][$key]);
            $targetFilePath = "$resultId/" . $fileName;
            $imageSize = $_FILES['inventoryImage']['size'][$key];
            // print_r($imageSize);
            // die();
            // Get image file extension
            $file_extension = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Choose png, jpg, jpeg file.";
                // header("Location: index.php");
                die();
            } else {
                move_uploaded_file($_FILES['inventoryImage']['tmp_name'][$key], $targetFilePath);
                $insertValuesSQL .= "('" . $targetFilePath . "','" . $file_extension . "','" . $imageSize . "','" . $resultId . "'),";
            }
        }

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $sqlImageTable = "INSERT INTO inventory_image_table(imagePath, imageExtension, imageSize, inventoryId) VALUES $insertValuesSQL";
            // print_r($sqlImageTable);
            // die();
            $resultInsertInvId = $conn->query($sqlImageTable);
            header("Location: index.php");
            die();
        } else {
            echo "Error 1";
        }
    } else {
        echo "Error 2";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/app.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="validation.js"> </script>
    <script src="smartadmin-html-full\dist\js\formplugins\bootstrap-datepicker\bootstrap-datepicker.js"></script>

</head>

<body class="d-flex justify-content-center bg-primary"></body>
<form name=createForm onsubmit="return validateForm()" style="padding-top: 6%; padding-left: 10%;" class="form-group col-6" action="" method="POST" enctype="multipart/form-data">
    <div class="text-white bg-dark form-group col-7">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="inventoryName" name="inventoryName">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="inventoryQuantity" name="inventoryQuantity">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="inventoryPrice" name="inventoryPrice" required>
        </div>
        <div class="form-group">
            <label for="dateIn">Date In</label>
            <div class="input-group">
                <input type="text" class="form-control " id="inventoryDateIn" name="inventoryDateIn">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>
            </div>
            <!-- <input type="date" class="form-control" id="inventoryDateIn" name="inventoryDateIn" required > -->
        </div>
        <div class="form-group">
            <label for="imageUpload">Upload Image</label>
            <input type="file" class="form-control-file" id="inventoryImage" name="inventoryImage[]" multiple required>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="submit">Submit</button>
        </div>
    </div>
</form>
</body>

</html>
<script>
    var controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }
    $('#inventoryDateIn').datepicker({
        orientation: "top left",
        todayHighlight: true,
        templates: controls
    });
</script>