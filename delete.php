<?php
require "database.php";
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $image = $_POST["image"];
    $sql = "DELETE FROM inventory_table WHERE id=$id;";
    $result = $conn->query($sql);
    echo "$image";
    die();
    unlink($image);

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    }
}else {
    echo"Error";
}
?>
