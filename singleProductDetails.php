<?php

require "database.php";

$inventoryId = $_POST["inventoryId"];

$sql = "SELECT * FROM inventory_table WHERE id = '$inventoryId'";
$result = $conn->query($sql);
$row= mysqli_fetch_array($result);

$output = "";
if (mysqli_num_rows($result) > 0) {
    $output = '
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" disabled readonly value="'.$row["quantity"].'" >
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="inventoryPrice" name="inventoryPrice" disabled readonly value="'.$row["price"].'">
    </div>
    <div class="form-group">
        <label for="dateIn">Date In</label>
        <input type="date" class="form-control" id="inventoryDateIn" name="inventoryDateIn" disabled readonly value="'.$row["dateIn"].'">
    </div>
';
echo $output;
}else{
    echo"No record found.";
}
?>
