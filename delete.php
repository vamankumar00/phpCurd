<?php
require "database.php";

    $id = $_GET["id"];
    $sql = "DELETE FROM inventory_table WHERE id=$id";
    $result = $conn->query($sql);
    $sqlForImageDlt = "DELETE FROM inventory_image_table WHERE inventoryId = $id";
    $result1 = $conn->query($sqlForImageDlt);
    

    if ($result === TRUE && $result1 === TRUE) {
        header("Location: index.php");
        die();
    }
?>
