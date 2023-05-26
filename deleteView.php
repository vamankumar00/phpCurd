<?php
require "database.php";
$id = $_GET["id"];
$sql = "SELECT * FROM inventory_table Where id = $id";
$result = $conn->query($sql);
$row= mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body class="d-flex justify-content-center bg-primary">
<form action="delete.php" method="post" style="padding-top: 4%; padding-left: 10%;" class="form-group col-6">
    <div class="text-white bg-dark form-group col-7">
    <input type="text" class="form-control" id="inventoryId" name="id" hidden value="<?php echo $row["id"]; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="inventoryName" name="inventoryName" disabled readonly value="<?php echo $row["name"]; ?>">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" disabled readonly value="<?php echo $row["quantity"]; ?>" >
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="inventoryPrice" name="inventoryPrice" disabled readonly value="<?php echo $row["price"]; ?>">
        </div>
        <div class="form-group">
            <label for="dateIn">Date In</label>
            <input type="date" class="form-control" id="inventoryDateIn" name="inventoryDateIn" disabled readonly value="<?php echo $row["dateIn"]; ?>">
        </div>
        <div class="form-group">
            <?php echo " <img src = \" ".$row["image"]. " \" width = \"100px\" height = \"100px\">"?>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="submit">Delete</button>
        </div>
        </div>
    </form>
</body>
</html>
