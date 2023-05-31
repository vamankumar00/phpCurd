<?php
require "database.php";
$array = ['Laptop', '2', '1500', '2023-05-22'];
$sql = "INSERT INTO inventory_table (name, quantity, price, dateIn, image) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]')";
$result = $conn->query($sql);

?>
                        <?php
                        if ($resultForImage->num_rows > 0) {
                            while ($row1 = $resultForImage->fetch_assoc()) {
                                $inventoryId = $row1["inventoryId"];
                                $imagePath = $row1["imagePath"];
                                $imageGetterArray[$inventoryId][] = $imagePath;
                            }
                            for ($i = 0; $i <= count($imageGetterArray); $i++) {

                                if (isset($imageGetterArray[$row["id"]][$i])) {
                                    if ($imageGetterArray[$row["id"]][$i] == "") {
                                        break;
                                    } else {
                                        echo '<td>
                                        <img class="d-block w-100" src="' . $imageGetterArray[$row["id"]][$i] . '" width="50px" height="30px">
                                        </td>';
                                    }
                                }

                                // echo $imageGetterArray[$row["id"]][$i];
                            }
                        }
                        ?>



                        <?php
                        if (isset($imageGetterArray[$inventoryId])) {
                            for ($i = 0; $i <= count($imageGetterArray); $i++) {
                                if (!isset($imageGetterArray[$row["id"]][$i])) {
                                    break;
                                } else {
                                    echo '<td>
                                        <img class="d-block w-100" src="' . $imageGetterArray[$row["id"]][$i] . '" width="50px" height="30px">
                                        </td>';
                                }
                            }

                            // echo $imageGetterArray[$row["id"]][$i];
                        }
                        ?>



                            <?php
                            $sqlForImage = "SELECT imagePath FROM inventory_image_table WHERE inventoryId = " . $row["id"] . "";
                            $resultForImage = $conn->query($sqlForImage);

                            if ($resultForImage->num_rows > 0) {
                                // output data of each row        
                                // $nu = 1;
                                while ($row1 = $resultForImage->fetch_assoc()) {
                                    echo '<div class="carousel-item active">
                                    <h1></h1>
                                    <img class="d-block w-100" src="' . $row1["imagePath"] . '" alt="Second slide" />
                                    <div class="carousel-caption d-none d-md-block">
                                    <h5 class="color-white opacity-70">
                                    Second slide label
                                    </h5>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit.
                                    </p>
                                    </div>
                                    </div>';
                                }
                            }
                            ?>

                                                    <?php
                                                    if (isset($imageGetterArray[$row["id"]])) {
                                                        for ($i = 0; $i < count($imageGetterArray[$row["id"]]); $i++) {
                                                            echo '<td>
                                        <img class="d-block w-100" src="' . $imageGetterArray[$row["id"]][$i] . '" width="50px" height="30px">
                                        </td>';
                                                        }
                                                    }
                                                    ?>