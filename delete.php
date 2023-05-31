<?php

use LDAP\Result;

require "database.php";
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    // $sqlForImage = "SELECT image FROM inventory_table WHERE id=$id";
    // $resultOfImage = $conn->query($sqlForImage);
    // $imageUrl = $resultOfImage->fetch_assoc();
    // echo implode($imageUrl);
    // die();
    $sql = "DELETE FROM inventory_table WHERE id=$id";
    // unlink(implode($imageUrl));
    $result = $conn->query($sql);
    // print_r($sql);
    // die();

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    }
} else {
    echo "Error";
}
