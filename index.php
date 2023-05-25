<?php
require "database.php";
$sql = "SELECT * FROM inventory_table";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>
    <form action="importCSV.php" method="POST" enctype="multipart/form-data">
    <div class="p-3 mb-2 bg-dark text-white" style="heigth:fit content">
        <a style="float : left" href="create.html" type="submit" class="btn btn-primary">Create</a>
        <div class="p-3 mb-2 bg-dark text-white" style="float : right">
        <input type="file" class="btn btn-primary" id="file" name="fileCSV"/>
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
        $nu = 1;
        while($row = $result->fetch_assoc()) {
    ?>
    <tbody>
        <tr>
        <?php echo "<td>" .$nu++. "</td>"; ?>
        <?php echo "<td>" .$row["name"]. "</td>"; ?>
        <?php echo "<td>" .$row["quantity"]. "</td>"; ?>
        <?php echo "<td>" .$row["price"]. "</td>"; ?>
        <?php echo "<td>" .$row["dateIn"]. "</td>"; ?>
        <?php echo "<td> <img src=\"" .$row["image"]. "\" width=\"50px\" height=\"30px\"> </td>" ?>
        <?php echo "<td> <a href=\"update.php?id=".$row["id"]."\"> Edit </a> <a href=\"details.php?id=".$row["id"]."\"> Details </a> <a href=\"delete.php?id=".$row["id"]."\"> Delete </a> </td>" ?>
        </tr>
        <?php }}
    $conn->close(); 
    ?>
    </tbody>
    </table>

</body>
</html>