<?php  

require "database.php";

    // variable to store number of rows per page

    $limit = 10;  

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

    for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

        echo '<a href = "index.php?page=' . $page_number . '">' . $page_number . ' </a>';  

    }    

?>