<?php
// Include database connection
include 'db_connect.php';

if (isset($_GET['headOfOffice'])) {
    $headOfOffice = $_GET['headOfOffice'];
    
    // Fetch head chief details from the database
    $sql = "SELECT * FROM rdrrmc WHERE head_of_office = '$headOfOffice'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return head chief details as JSON response
        echo json_encode($row);
    } else {
        // Return error message if head chief details not found
        echo json_encode(array('error' => 'Head chief details not found'));
    }
} else {
    // Return error message if headOfOffice parameter is not set
    echo json_encode(array('error' => 'Parameter headOfOffice is missing'));
}
?>
