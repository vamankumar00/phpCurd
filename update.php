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
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <form action="update_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="inventoryId" name="inventoryId" required value="<?php echo $row["id"]; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="inventoryName" name="inventoryName" required value="<?php echo $row["name"]; ?>">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" required value="<?php echo $row["quantity"]; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="inventoryPrice" name="inventoryPrice" required value="<?php echo $row["price"]; ?>">
        </div>
        <div class="form-group">
            <label for="dateIn">Date In</label>
            <input type="date" class="form-control" id="inventoryDateIn" name="inventoryDateIn" required value="<?php echo $row["dateIn"]; ?>">
        </div>
        <div class="form-group">
        <?php echo " <img src = \" ./images/" .$row["image"]. " \" width = \"100px\" height = \"100px\">"?>
            <input type="file" class="form-control-file" id="inventoryImage" name="inventoryImage"> 
        </div>
        <button type="submit" class="btn btn-primary"> Submit </button>
    </form>
</body>
</html>