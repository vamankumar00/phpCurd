<?php
require "database.php";

$sqlInventory = "SELECT imagePath, inventoryId FROM inventory_image_table";
$result = $conn->query($sqlInventory);

$imageGetterArray = array();
while ($row = $result->fetch_assoc()) {
    $inventoryId = $row["inventoryId"];
    $imagePath = $row["imagePath"];
    $imageGetterArray[$inventoryId][] = $imagePath;
}
// echo $imageGetterArray[50][1];
for ($i = 0; $i <= count($imageGetterArray); $i++) {
    echo "Hi";
}
// $keys = array_keys($imageGetterArray);
// for ($i = 0; $i < count($imageGetterArray); $i++) {
//     echo $keys[$i] . "<br>";
//     foreach ($imageGetterArray[$keys[$i]] as $key => $value) {
//         echo $key . " : " . $value . "<br>";
//     }
//     echo "<br>";
// }
