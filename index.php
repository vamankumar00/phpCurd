<?php  
require "database.php";
    // variable to store number of rows per page
    $limit = 7;  
    // query to retrieve all rows from the table Countries
    $getQuery = "SELECT * FROM inventory_table";    
    // get the result
    $result = $conn->query($getQuery) ;
    $total_rows = mysqli_num_rows($result);    
    // get the required number of pages
    $total_pages = ceil ($total_rows / $limit);    
    // update the active page number
    if (!isset ($_GET['page']) ) {  
        $page_number = 1;  
    } else {  
        $page_number = $_GET['page'];  
    }    
    // get the initial page number
    $initial_page = ($page_number-1) * $limit;   
    // get data of selected rows per page    
    $getQuery = "SELECT *FROM inventory_table LIMIT " . $initial_page . ',' . $limit;  
    $result = $conn->query($getQuery);       
    //display the retrieved result on the webpage  
    // while ($row = mysqli_fetch_array($result)) {  
    //     echo $row['ID'] . ' ' . $row['Country'] . '</br>';  
    // }    
    // show page number with link   
    // for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

        //  echo '<a href = "index.php?page=' . $page_number . '">' . $page_number . ' </a>';  

    // }

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body class="bg-primary">
    <form action="importCSV.php" method="POST" enctype="multipart/form-data">
    <div class="p-3 mb-2 bg-dark text-white fit-content">
        <a style="float : left" href="create.php" type="submit" class="btn btn-primary border-dark">Create</a>
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
        // $nu = 1;
        while($row = $result->fetch_assoc()) {
    ?>
    <tbody>
        <tr>
        <?php echo "<td>" .$row["id"]. "</td>"; ?>
        <?php echo "<td>" .$row["name"]. "</td>"; ?>
        <?php echo "<td>" .$row["quantity"]. "</td>"; ?>
        <?php echo "<td>" .$row["price"]. "</td>"; ?>
        <?php echo "<td>" .$row["dateIn"]. "</td>"; ?>
        <?php echo "<td> <img src=\"" .$row["image"]. "\" width=\"50px\" height=\"30px\"> </td>" ?>
        <?php echo "<td> <a href=\"update.php?id=".$row["id"]."\"> Edit </a> <a href=\"details.php?id=".$row["id"]."\"> Details </a> <a href=\"deleteView.php?id=".$row["id"]."\"> Delete </a> </td>" ?>
        </tr>
        <?php }}
    $conn->close(); 
    ?>
    </tbody>
    </table>
    <nav aria-label="Page navigation example" >
        <ul class="pagination bg-dark">
            <li class="page-item"><a class="page-link" href="<?php if($page_number <= 1) { echo '#'; } else { echo "index.php?page=".($page_number - 1); } ?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="<?php if($page_number >= 0) { echo "index.php?page=".($page_number); } ?>"><?php echo $page_number ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if($page_number >= 0) { echo "index.php?page=".($page_number+1); } ?>"><?php echo ($page_number+1) ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if($page_number >= 0) { echo "index.php?page=".($page_number+2); } ?>"><?php echo ($page_number+2) ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php if($page_number >= $total_pages) { echo '#'; } else { echo "index.php?page=".($page_number + 1); } ?>">Next</a></li>
        </ul>
    </nav>
</body>
</html>