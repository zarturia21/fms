<?php
ob_start();
$action = isset($_GET['action']) ? $_GET['action'] : '';
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
    $login = $crud->login();
    if($login)
        echo $login;
}
if($action == 'logout'){
    $logout = $crud->logout();
    if($logout)
        echo $logout;
}
if($action == 'save_folder'){
    $save = $crud->save_folder();
    if($save)
        echo $save;
}
if($action == 'delete_folder'){
    $delete = $crud->delete_folder();
    if($delete)
        echo $delete;
}
if($action == 'delete_file'){
    $delete = $crud->delete_file();
    if($delete)
        echo $delete;
}
if($action == 'save_files'){
    $save = $crud->save_files();
    if($save)
        echo $save;
}
if($action == 'file_rename'){
    $save = $crud->file_rename();
    if($save)
        echo $save;
}
if($action == 'save_user'){
    $save = $crud->save_user();
    if($save)
        echo $save;
}
if($action == 'delete_user'){
    $delete = $crud->delete_user();
    if($delete)
        echo $delete;
}
if($action == 'get_options'){ // New block to handle get_options action
    if(isset($_POST['organization'])) {
        $organization = $_POST['organization']; // Retrieve selected organization
        // Generate options based on the selected organization
        $options = array();
        if ($organization == 'OCD') {
            $options = array(
                "Officer Order",
                "PPBER",
                "MAR",
                "OPC/OPCR",
                "NARRATIVE ACCOMPLISHMENT",
                "LETTER",
                "ACTIVITY DESIGN",
                "PROJECT PROPOSAL",
                "DF",
                "PROCUREMENT DOCS",
                "ATTENDANCE",
                "TRAVEL ORDER",
                "OTHER PLEASE SPECIFY",
                // Add more options as needed
            );
        } elseif ($organization == 'RDRRMC') {
            $options = array(
                "MEMORANDUM",
                "RESOLUTION",
                "MINUTES",
                "ATTENDANCE",
                "LETTERS",
                "AFTER ACTIVITY REPORT",
                "GAWAD KALASAG SEAL",
                "GAWAD KALASAG SPECIAL AWARD",
                "LOCAL DRRM PLAN REVIEW",
                "TRAVEL ORDER",
                // Add more options as needed
            );
        }
        // Return options as HTML
        foreach ($options as $option) {
            echo '<option value="' . $option . '">' . $option . '</option>';
        }
    }
}
?>

<?php
include 'db_connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'get_personnel_data') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // Check if the personnel ID exists in the rdrrmc table
    $sql_rdrrmc = "SELECT * FROM rdrrmc WHERE id = $id";
    $result_rdrrmc = $conn->query($sql_rdrrmc);

    // Check if the personnel ID exists in the ldrrmos table
    $sql_ldrrmos = "SELECT * FROM ldrrmos WHERE id = $id";
    $result_ldrrmos = $conn->query($sql_ldrrmos);

    // Display personnel details based on the table where the ID is found
    if ($result_rdrrmc->num_rows > 0) {
        $row = $result_rdrrmc->fetch_assoc();
        echo "<h3>Personnel Details</h3>";
        echo "<img src='" . $row['image'] . "' class='person-image'>"; // Display the image
        echo "<p>ID: " . $row['id'] . "</p>";
        echo "<p>Agency: " . $row['agency'] . "</p>";
        echo "<p>Head of Office: " . $row['head_of_office'] . "</p>";
        echo "<p>Position: " . $row['position_r'] . "</p>";
        echo "<p>Contact Number: " . $row['contact_number_r'] . "</p>";
        echo "<p>Email: " . $row['email_r'] . "</p>";
        echo "<p>Office Address: " . $row['office_address_r'] . "</p>";
    } elseif ($result_ldrrmos->num_rows > 0) {
        $row = $result_ldrrmos->fetch_assoc();
        echo "<h3>Personnel Details</h3>";
        echo "<img src='" . $row['image'] . "' class='person-image'>"; // Display the image
        echo "<p>ID: " . $row['id'] . "</p>";
        echo "<p>Local Chief Executive: " . $row['local_chief_executive'] . "</p>";
        echo "<p>Local DRRM Officer: " . $row['local_drrm_officer'] . "</p>";
        echo "<p>Position: " . $row['position_l'] . "</p>";
        echo "<p>Designation: " . $row['designation'] . "</p>";
        echo "<p>Contact Number: " . $row['contact_number_l'] . "</p>";
        echo "<p>Email: " . $row['email_l'] . "</p>";
        echo "<p>Office Address: " . $row['office_address_l'] . "</p>";
    } else {
        echo "No personnel found";
    }
}
?>
