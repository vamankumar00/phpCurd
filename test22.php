<?php
require "database.php";
$sqlInventory = "SELECT imageId, imagePath, inventoryId FROM inventory_image_table";
$resultForImage = $conn->query($sqlInventory);

$imageGetterArray = array();
if ($resultForImage->num_rows > 0) {
    while ($row1 = $resultForImage->fetch_assoc()) {
        $imageId = $row1["imageId"];
        $inventoryId = $row1["inventoryId"];
        $imagePath = $row1["imagePath"];
        $imageGetterArray['path'][$inventoryId][] = $imagePath;
        $imageGetterArray['id'][$inventoryId][] = $imageId;
    }
    
}

// for ($i=0; $i <count($imageGetterArray);  $i++) { 
    echo"<pre/>";
    print_r($imageGetterArray['path'][$inventoryId][0]); 
    // for ($j=0; $j < count($imageGetterArray[$inventoryId]); $j++) { 
    //     echo"<pre/>";
    //     print_r($imageGetterArray);
    // }
    die();
// }
?>
