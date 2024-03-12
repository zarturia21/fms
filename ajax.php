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
