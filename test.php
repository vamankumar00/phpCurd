<?php
require "database.php";
$array = ['Laptop', '2', '1500', '2023-05-22'];
$sql = "INSERT INTO inventory_table (name, quantity, price, dateIn, image) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]')";
$result = $conn->query($sql);

?>