<?php
require "database.php";
$id = $_GET["id"];
$sql = "DELETE FROM inventory_table WHERE id=$id;";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    die();
} 
?>