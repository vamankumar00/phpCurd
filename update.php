<?php
require "database.php";
$id = $_GET["id"];

$sql = "SELECT * FROM inventory_table Where id = $id";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$sqlImage = "SELECT * FROM inventory_image_table Where inventoryId = $id";
$resultImage = $conn->query($sqlImage);

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
    <script type="text/javascript" src="js/jquery.js"> </script>
    <script type="text/javascript" src="js/validation.js"> </script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script> -->

</head>

<body class="d-flex justify-content-center bg-primary">
    <form style="padding-top: 3%; padding-left: 10%;" onsubmit="return validateForm()" class="form-group col-6" action="update_process.php" method="POST" enctype="multipart/form-data">
        <div class="text-white bg-dark form-group col-7">
            <input type="hidden" class="form-control" id="inventoryId" name="inventoryId" value="<?php echo $row["id"]; ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="inventoryName" name="inventoryName" value="<?php echo $row["name"]; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" value="<?php echo $row["quantity"]; ?>">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="inventoryPrice" name="inventoryPrice" value="<?php echo $row["price"]; ?>">
            </div>
            <div class="form-group">
                <label for="dateIn">Date In</label>
                <input type="date" class="form-control" id="inventoryDateIn" name="inventoryDateIn" value="<?php echo $row["dateIn"]; ?>">
            </div>
            <div class="form-group">
                <!-- <form action="updateSingleImage.php" method="POST"> -->
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#default-images-modal-lg-center">
                    Images
                </button>
                <div class="modal fade text-dark" id="default-images-modal-lg-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <?php
                                        if ($resultImage->num_rows > 0) {
                                            while ($imagesRow = $resultImage->fetch_assoc()) {
                                                $imageId = $imagesRow["imageId"];
                                                $imagePath = $imagesRow["imagePath"];
                                        ?>
                                                <td>
                                                    <img src="<?= $imagesRow["imagePath"] ?>" width="200px" height="250px">
                                                    <input type="hidden" class="form-control image_id" name="imageId[]">
                                                    <input type="file" name="image[]" class="form-control-file images_array" data-id='<?= $imageId ?>'>
                                                </td>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <!-- <button type="button" class="btn btn-primary">
                                    Save changes
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </form> -->
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-secondary btn-lg btn-block" name="submit">Submit</button>
            </div>
        </div>
    </form>
    <!-- <script src="smartadmin-html-full/dist/js/app.bundle.js"></script> -->
    <script src="smartadmin-html-full/dist/js/vendors.bundle.js"></script>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $(".images_array").change(function(e) {
            var id = $(this).data('id');
            var image_id = $(this).prev().val(id);
        });
    });
</script>