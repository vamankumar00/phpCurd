<?php
 require "database.php";

    $id = $_GET["id"];
    $sql = "DELETE FROM inventory_table WHERE id=$id";
    $result = $conn->query($sql);
    $sqlForImagePath = "SELECT imagePath FROM inventory_image_table WHERE inventoryId = $id";
    $result2 = $conn->query($sqlForImagePath);
    if ($result2->num_rows > 0) {

        while ($row = $result2->fetch_assoc()) {
            $imagePath = $row["imagePath"];
            if (is_file($imagePath)) {
                // echo $imagePath."<br/>";
                unlink($imagePath);
            }
        }
    }
    $sqlForImageDlt = "DELETE FROM inventory_image_table WHERE inventoryId = $id";
    $result1 = $conn->query($sqlForImageDlt);
    if ($result === TRUE && $result1 === TRUE) {
        header("Location: index.php");
        die();
    }
    else {
        echo "Data not deleted!";
        die();
    }
?>
