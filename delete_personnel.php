<?php
include 'db_connect.php';

$id = $_GET['id'];
$org = $_GET['org'];

// Fetch the image file name from the database
$sql = "SELECT image FROM $org WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageFileName = $row['image'];

    // Delete the image file from the file system
    if ($imageFileName && file_exists('uploads/' . $imageFileName)) {
        unlink('uploads/' . $imageFileName);
    }

    // Delete the record from the database
    $deleteSql = "DELETE FROM $org WHERE id = $id";
    if ($conn->query($deleteSql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
} else {
    echo json_encode(array('success' => false));
}

$conn->close();
?>
