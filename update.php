<?php
require "database.php";
$id = $_GET["id"];

$sql = "SELECT * FROM inventory_table Where id = $id";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/app.bundle.css">
    <link rel="stylesheet" media="screen, print" href="smartadmin-html-full/dist/css/theme-demo.css">
    <script src="smartadmin-html-full/dist/js/app.bundle.js"></script>
    <script src="smartadmin-html-full/dist/js/vendors.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"> </script>
    <script type="text/javascript" src="js/validation.js"> </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body class="d-flex justify-content-center bg-primary">
    <form style="padding-top: 3%; padding-left: 10%;" onsubmit="return validateForm()" class="form-group col-6" action="create.php" method="POST" enctype="multipart/form-data">
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
                <button type="button" onclick="imagesFun('<?= $id?>')" id="imageButton" class="btn btn-default" data-toggle="modal" data-target="#default-images-modal-lg-center">
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
                                <h1>Hiiiii</h1>
                                <!-- <div id="details-Data">

                                </div> -->
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
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-secondary btn-lg btn-block" name="submit">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>

<script>
    // $(document).ready(function() {
        function imagesFun(invId) {
            var inventoryId = invId;
            // alert(inventoryId);
            $.ajax({
                url: "showImages.php",
                type: "POST",
                data: "inventoryId=" + inventoryId,
                success: function() {
                    //alert("hi");
                }
            });
        };  
    // });
</script>