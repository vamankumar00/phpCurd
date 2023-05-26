<?php
require "database.php";
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM inventory_table WHERE id=$id;";
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    }
}else {
    echo"Error";
}
?>
