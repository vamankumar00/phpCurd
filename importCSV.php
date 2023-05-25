<?php
require "database.php";

//   if (isset($_POST['submit']))
//     {
$fileMimes = array(
    'csv',
    'xlsx'
);

$file_extension = pathinfo($_FILES["fileCSV"]["name"], PATHINFO_EXTENSION);


// Validate selected file is a CSV file or not
if (!empty($_FILES["fileCSV"]['name']) && in_array($file_extension, $fileMimes)) {

    // Open uploaded CSV file with read-only mode
    $csvFile = fopen($_FILES["fileCSV"]['tmp_name'], 'r');

    // // Skip the first line
    // fgetcsv($csvFile);

    // Parse data from CSV file line by line   
    $data = " ";
    $i = 0;
    while (($getData = fgetcsv($csvFile, 1048576, ",")) !== FALSE) {
        $i += 1;

        // Get row data
        $name = $getData[0];
        $quantity = $getData[1];
        $price = $getData[2];
        $dateIn = $getData[3];
        $data .= "('$name', '$quantity', '$price', '$dateIn'),";

        if ($i == 1000) {
            $data = rtrim($data, ',');
            $sql = "INSERT INTO inventory_table (name, quantity, price, dateIn) VALUES $data";
            $result = $conn->query($sql);
            $i = 0;
            $data = " ";
        }
        // echo "<br>" .$i;
    }

    if ($i > 0) {
        $data = rtrim($data, ',');
        $sql = "INSERT INTO inventory_table (name, quantity, price, dateIn) VALUES $data";
        $result = $conn->query($sql);
        // $i = 0;
        // $data = " ";
    }

    // echo $sql;
    // die();


    // Close opened CSV file
    fclose($csvFile);


    // echo '<script>
    //             window.location = "index.php";
    //         </script>';
    header("Location: index.php");
} else {
    echo "Please select valid file";
}
// }

// $image = $getData[4];

// If user already exists in the database with the same email
// $query = "SELECT id FROM users WHERE email = '" . $getData[1] . "'";

// $check = mysqli_query($con, $query);

// if ($check->num_rows > 0)
// {
//     mysqli_query($conn, "UPDATE users SET name = '" . $name . "', created_at = NOW() WHERE email = '" . $email . "'");
// }
// else
// {
//     mysqli_query($con, "INSERT INTO users (name, email, created_at, updated_at) VALUES ('" . $name . "', '" . $email . "', NOW(), NOW())");
// }


?>