<?php
require "database.php";

$limit = 7;
$getQuery = "SELECT * FROM inventory_table";
$result = $conn->query($getQuery);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows / $limit);
if (!isset($_GET['page'])) {
    $page_number = 1;
} else {
    $page_number = $_GET['page'];
}
$initial_page = ($page_number - 1) * $limit;
$getQuery = "SELECT *FROM inventory_table LIMIT " . $initial_page . ',' . $limit;
$result = $conn->query($getQuery);
$sqlInventory = "SELECT imageId, imagePath, inventoryId FROM inventory_image_table";
$resultForImage = $conn->query($sqlInventory);

$imageGetterArray = array();
// $imageIdGetterArray = array();
if ($resultForImage->num_rows > 0) {
    while ($row1 = $resultForImage->fetch_assoc()) {
        $imageId = $row1["imageId"];
        $inventoryId = $row1["inventoryId"];
        $imagePath = $row1["imagePath"];
        // $imageGetterArray[$inventoryId][] = $imagePath;
        // $imageIdGetterArray[$inventoryId][] = $imageId;
        $imageGetterArray['path'][$inventoryId][] = $imagePath;
        $imageGetterArray['id'][$inventoryId][] = $imageId;
    }
}
// echo"<pre/>";
//     print_r($imageGetterArray); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/app.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/theme-demo.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

</head>

<body class="bg-primary">

    <form action="importCSV.php" method="POST" enctype="multipart/form-data">
        <div class="p-3 mb-2 bg-dark text-white fit-content">
            <a style="float : left" href="create.php" type="submit" class="btn btn-primary border-dark">Create</a>
            <div class="p-3 mb-2 bg-dark text-white" style="float : right">
                <input type="file" class="btn btn-primary" id="file" name="fileCSV" />
                <button type="submit" class="btn btn-primary">Import Data</button>
            </div>
        </div>
    </form>
    <table class="table table-dark">
        <thead>
            <tr>
                <!-- <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Date In</th>
                <th scope="col">Image</th> -->
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $invId = $row["id"];
        ?>
                    <tr>
                        <?php echo "<td>" . $row["id"] . "</td>"; ?>
                        <?php echo "<td>" . $row["name"] . "</td>"; ?>
                        <!-- Old Code In test.php -->
                        <!-- Detial Modal Starts Here -->
                        <td>
                            <button type="button" onclick="detailsFun(<?= $invId?>)" id="detailButton" class="btn btn-default" data-toggle="modal" data-target="#default-details-modal-lg-center">
                                Details
                            </button>
                        </td>
                        <div class="modal fade" id="default-details-modal-lg-center" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="details-Data">

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detial Modal End Here -->
                        <td>
                            <button type="button" class="btn btn-lg btn-default" data-toggle="modal" data-target="#abc-<?= $row["id"] ?>">
                                Images
                            </button>
                            <?php
                            if (isset($imageGetterArray['id'][$row["id"]])) {

                            ?>

                                <!-- NEW -->

                                <div class="modal fade modal-fullscreen" id="abc-<?= $row["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content h-100 border-0 shadow-0 bg-fusion-800">
                                            <button type="button" class="close p-sm-2 p-md-4 text-white fs-xxl position-absolute pos-right mr-sm-2 mt-sm-1 z-index-space" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>

                                            <div class="modal-body p-0">
                                                <div id="example-carousel-fullscreen-<?= $row["id"] ?>" class="carousel slide" data-ride="carousel">
                                                    <?php
                                                    for ($i = 0; $i < count($imageGetterArray['id'][$row["id"]]); $i++) {
                                                        $active = "";
                                                        if ($i == 0) {
                                                            $active = "active";
                                                        }

                                                    ?>
                                                        <ol class="carousel-indicators">
                                                            <li data-target="#example-carousel-fullscreen-<?= $row["id"] ?>" data-slide-to="<?= $i ?>" class="<?= $active ?>"></li>
                                                        </ol>
                                                        <div class="close p-sm-2 p-md-4 text-white fs-xxl position-absolute pos-left mr-sm-2 mt-sm-1 z-index-space">
                                                            <button type="danger" class="btn btn-dark" id="deleteImage" onclick="deleteFun()" value="<?= $imageGetterArray['id'][$row["id"]][$i] ?>" data-path="<?= $imageGetterArray['path'][$row["id"]][$i] ?>" style="float:left">delete</button>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="carousel-inner">
                                                        <?php for ($j = 0; $j < count($imageGetterArray['path'][$row["id"]]); $j++) {
                                                            $active = "";
                                                            if ($j == 0) {
                                                                $active = "active";
                                                            }

                                                        ?>
                                                            <div class="carousel-item <?= $active ?>">
                                                                <img class="d-block w-100" src="<?= $imageGetterArray['path'][$row["id"]][$j] ?>" alt="First slide" width="500px" height="500px" />
                                                                <div class="carousel-caption d-none d-md-block">
                                                                </div>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#example-carousel-fullscreen-<?= $row["id"] ?>" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#example-carousel-fullscreen-<?= $row["id"] ?>" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- NEW END -->

                        </td>
                    <?php
                            }
                    ?>
                    <?php echo "<td> <a href=\"update.php?id=" . $row["id"] . "\"> Edit </a> 
                    <a href=\"details.php?id=" . $row["id"] . "\"> Details </a> 
                    <a href=\"delete.php?id=" . $row["id"] . "\"> Delete </a> </td>" ?>
                    </tr>
            <?php
            }
        }
            ?>
                </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination bg-dark">
            <li class="page-item"><a class="page-link" href="<?php if ($page_number <= 1) {
                                                                    echo '#';
                                                                } else {
                                                                    echo "index.php?page=" . ($page_number - 1);
                                                                } ?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="<?php if ($page_number >= 0) {
                                                                    echo "index.php?page=" . ($page_number);
                                                                } ?>"><?php echo $page_number ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if ($page_number >= 0) {
                                                                    echo "index.php?page=" . ($page_number + 1);
                                                                } ?>"><?php echo ($page_number + 1) ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if ($page_number >= 0) {
                                                                    echo "index.php?page=" . ($page_number + 2);
                                                                } ?>"><?php echo ($page_number + 2) ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if ($page_number >= $total_pages) {
                                                                    echo '#';
                                                                } else {
                                                                    echo "index.php?page=" . ($page_number + 1);
                                                                } ?>">Next</a></li>
        </ul>
    </nav>
    <script src="smartadmin-html-full/dist/js/app.bundle.js"></script>
    <script src="smartadmin-html-full/dist/js/vendors.bundle.js"></script>
</body>

</html>
<script>
    function deleteFun() {

        var id = $('#deleteImage').val();
        var path = $('#deleteImage').data('path');


        $.ajax({
            type: "POST",
            url: "deleteSingleImage.php",
            data: "id=" + id + "&path=" + path,
        }).done(function(res) {
            if (res == "Delete Successfully") {
                location.reload();
            } else {
                alert(res);
            }
        });

    };
</script>

<script>
        function detailsFun(kuchh){
            var inventoryId = kuchh;
            // alert(inventoryId);
            $.ajax({
                url : "singleProductDetails.php",
                type : "POST",
                data : "inventoryId="+inventoryId,
                success : function(data){
                    $("#details-Data").html(data);
                }
            });
    };
</script>