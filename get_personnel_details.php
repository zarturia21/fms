<?php
// Include your database connection
include 'db_connect.php';

// Get the ID from the request
$id = $_GET['id'];

// Check if the ID corresponds to a record in the rdrrmc table
$sql_rdrrmc = "SELECT * FROM rdrrmc WHERE id = $id";
$result_rdrrmc = $conn->query($sql_rdrrmc);

// Check if the ID corresponds to a record in the ldrrmos table
$sql_ldrrmos = "SELECT * FROM ldrrmos WHERE id = $id";
$result_ldrrmos = $conn->query($sql_ldrrmos);

// Initialize response array
$response = array();

if ($result_rdrrmc && $result_rdrrmc->num_rows > 0) {
    // Fetch details for rdrrmc personnel
    $row_rdrrmc = $result_rdrrmc->fetch_assoc();
    // Construct the response array for rdrrmc
    $response['type'] = 'rdrrmc';
    $response['image'] = 'uploads/' . $row_rdrrmc['image']; // Adjust the image path here
    $response['agency'] = $row_rdrrmc['agency'];
    $response['head_of_office'] = $row_rdrrmc['head_of_office'];
    $response['position_r'] = $row_rdrrmc['position_r'];
    $response['contact_number_r'] = $row_rdrrmc['contact_number_r'];
    $response['email_r'] = $row_rdrrmc['email_r'];
    $response['office_address_r'] = $row_rdrrmc['office_address_r'];
} elseif ($result_ldrrmos && $result_ldrrmos->num_rows > 0) {
    // Fetch details for ldrrmos personnel
    $row_ldrrmos = $result_ldrrmos->fetch_assoc();
    // Construct the response array for ldrrmos
    $response['type'] = 'ldrrmos';
    $response['image'] = 'uploads/' . $row_ldrrmos['image']; // Adjust the image path here
    $response['local_chief_executive'] = $row_ldrrmos['local_chief_executive'];
    $response['local_drrm_officer'] = $row_ldrrmos['local_drrm_officer'];
    $response['position_l'] = $row_ldrrmos['position_l'];
    $response['designation'] = $row_ldrrmos['designation'];
    $response['contact_number_l'] = $row_ldrrmos['contact_number_l'];
    $response['email_l'] = $row_ldrrmos['email_l'];
    $response['office_address_l'] = $row_ldrrmos['office_address_l'];
    $response['LGUs'] = $row_ldrrmos['LGUs'];
} else {
    // Send an error response if the personnel is not found
    $response['error'] = 'Personnel not found';
}

// Send the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>
