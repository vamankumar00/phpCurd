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
$sqlInventory = "SELECT imagePath, inventoryId FROM inventory_image_table";
$resultForImage = $conn->query($sqlInventory);

$imageGetterArray = array();
if ($resultForImage->num_rows > 0) {
    while ($row1 = $resultForImage->fetch_assoc()) {
        $inventoryId = $row1["inventoryId"];
        $imagePath = $row1["imagePath"];
        $imageGetterArray[$inventoryId][] = $imagePath;
    }
}
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Date In</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row        
            // $nu = 1;
            while ($row = $result->fetch_assoc()) {
        ?>
                <tbody>
                    <tr>
                        <?php echo "<td>" . $row["id"] . "</td>"; ?>
                        <?php echo "<td>" . $row["name"] . "</td>"; ?>
                        <?php echo "<td>" . $row["quantity"] . "</td>"; ?>
                        <?php echo "<td>" . $row["price"] . "</td>"; ?>
                        <?php echo "<td>" . $row["dateIn"] . "</td>"; ?>
                        <td>
                            <button type="button" class="btn btn-lg btn-default" data-toggle="modal" data-target=".image-modal-fullscreen">
                                Modal Fullscreen
                            </button>
                            <!-- Fullscreen Modal -->
                            <div class="modal fade modal-fullscreen image-modal-fullscreen" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content h-100 border-0 shadow-0 bg-fusion-800">
                                        <button type="button" class="close p-sm-2 p-md-4 text-white fs-xxl position-absolute pos-right mr-sm-2 mt-sm-1 z-index-space" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                        <div class="modal-body p-0">
                                            <div id="example-carousel-fullscreen" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#example-carousel-fullscreen" data-slide-to="0" class=""></li>
                                                    <li data-target="#example-carousel-fullscreen" data-slide-to="1" class="active"></li>
                                                    <li data-target="#example-carousel-fullscreen" data-slide-to="2" class=""></li>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <!-- <div class="carousel-item">
                                                        <img class="d-block w-100" src="img/demo/relax-full.jpg" alt="First slide" />
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="color-white opacity-70">
                                                                First slide label
                                                            </h5>
                                                            <p>
                                                                Nulla vitae elit libero, a pharetra
                                                                augue mollis interdum.
                                                            </p>
                                                        </div>
                                                    </div> -->
                                                    <div class="carousel-item active">

                                                        <?php
                                                        if (isset($imageGetterArray[$row["id"]])) {
                                                            for ($i = 0; $i < count($imageGetterArray[$row["id"]]); $i++) {
                                                                echo ' <img class="d-block w-100" width="200px" height="200px" src="' . $imageGetterArray[$row["id"]][$i] . '" alt="Second slide" /> ';
                                                                //                         echo '<td>
                                                                // <img class="d-block w-100" src="' . $imageGetterArray[$row["id"]][$i] . '" width="50px" height="30px">
                                                                // </td>';
                                                            }
                                                        }
                                                        ?>
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="color-white opacity-70">
                                                                Second slide label
                                                            </h5>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="carousel-item">
                                                        <img class="d-block w-100" src="img/demo/sea-full.jpg" alt="Third slide" />
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="color-white opacity-70">
                                                                Third slide label
                                                            </h5>
                                                            <p>
                                                                Praesent commodo cursus magna, vel
                                                                scelerisque nisl consectetur.
                                                            </p>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <!-- <a class="carousel-control-prev" href="#example-carousel-fullscreen" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#example-carousel-fullscreen" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php echo "<td> <a href=\"update.php?id=" . $row["id"] . "\"> Edit </a> <a href=\"details.php?id=" . $row["id"] . "\"> Details </a> <a href=\"deleteView.php?id=" . $row["id"] . "\"> Delete </a> </td>" ?>
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