<?php
// Include database connection
require_once("./db_connect.php");

if(isset($_POST['submit'])){
    // Get form data
    $image = $_FILES['image']['name'];
    $selectType = $_POST['selectType'];
    
    // Initialize variables for RDRRMC and LDRRMOs
    $agency = $head_of_office = $position_r = $contact_number_r = $email_r = $office_address_r = "";
    $local_chief_executive = $local_drrm_officer = $position_l = $designation = $contact_number_l = $email_l = $office_address_l = "";
    $focal_person_id = null;

    // Check if RDRRMC or LDRRMOs is selected
    if($selectType === "RDRRMC") {
        $agency = $_POST['agency'];
        $head_of_office = $_POST['head_of_office'];
        $position_r = $_POST['position_r'];
        $contact_number_r = $_POST['contact_number_r'];
        $email_r = $_POST['email_r'];
        $office_address_r = $_POST['office_address_r'];
    } elseif($selectType === "LDRRMOs") {
        $local_chief_executive = $_POST['local_chief_executive'];
        $local_drrm_officer = $_POST['local_drrm_officer'];
        $position_l = $_POST['position_l'];
        $designation = $_POST['designation'];
        $contact_number_l = $_POST['contact_number_l'];
        $email_l = $_POST['email_l'];
        $office_address_l = $_POST['office_address_l'];
    }

    // Check if focal person details are provided
    if(isset($_POST['drrm_focal_person']) && !empty($_POST['drrm_focal_person'])) {
        // Get focal person data
        $drrm_focal_person = $_POST['drrm_focal_person'];
        $focal_person_position = $_POST['focal_person_position'];
        $focal_person_contact = $_POST['focal_person_contact'];
        $focal_person_email = $_POST['focal_person_email'];
        $office_address_fp = $_POST['office_address_fp'];

        // Insert focal person data into the database
        $stmt = $conn->prepare("INSERT INTO FocalPersons (drrm_focal_person, focal_person_position, focal_person_contact, focal_person_email, office_address_fp) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $drrm_focal_person, $focal_person_position, $focal_person_contact, $focal_person_email, $office_address_fp);
        if ($stmt->execute()) {
            // Retrieve the ID of the inserted focal person
            $focal_person_id = $stmt->insert_id;
        } else {
            echo "<script>alert('Error inserting focal person: " . $stmt->error . "');</script>";
            exit(); // Exit the script if focal person insertion fails
        }
        $stmt->close();
    }

    // Handle file upload
    $upload_directory = "./uploads/";
    $image_tmp = $_FILES['image']['tmp_name'];
    $uploaded_image = uniqid() . '_' . $image;
    if (move_uploaded_file($image_tmp, $upload_directory . $uploaded_image)) {
        // File upload successful, proceed with inserting data into the database
        // Prepare insert query based on RDRRMC or LDRRMOs selection
       // Prepare insert query based on RDRRMC or LDRRMOs selection
if($selectType === "RDRRMC") {
    // Prepare insert query for RDRRMC table
    $stmt = $conn->prepare("INSERT INTO RDRRMC (image, agency, head_of_office, position_r, contact_number_r, email_r, office_address_r) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // Bind parameters for RDRRMC table
    $stmt->bind_param("sssssss", $uploaded_image, $agency, $head_of_office, $position_r, $contact_number_r, $email_r, $office_address_r);
} elseif($selectType === "LDRRMOs") {
    // Prepare insert query for LDRRMOs table
    $stmt = $conn->prepare("INSERT INTO LDRRMOs (image, local_chief_executive, local_drrm_officer, position_l, designation, contact_number_l, email_l, office_address_l) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Bind parameters for LDRRMOs table
    $stmt->bind_param("ssssssss", $uploaded_image, $local_chief_executive, $local_drrm_officer, $position_l, $designation, $contact_number_l, $email_l, $office_address_l);
}


        // Execute query
        if ($stmt->execute()) {
            echo "<script>alert('Record inserted successfully.');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close statement
        $stmt->close();
    } else {
        // File upload failed
        echo "<script>alert('Error uploading image.');</script>";
    }

    // Close connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php @include("includes/header.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php @include("includes/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Personnel</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <span style="color: brown"><h5>Personnel details</h5></span>
                                    <hr>
                                    <!-- Image upload -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="image">Upload Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required onchange="previewImage(this);">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div id="imagePreview" style="height: 150px; width: 50%;margin-left: 25%; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; border-radius: 5px; overflow: hidden;">
                                                <img id="preview" src="image/profiles.png" alt="Uploaded Image" style="max-width: 100%; max-height: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of image upload -->
                                    <!-- RDRRMC/LDRRMOs selection -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="selectType">Select Type</label>
                                            <select class="form-control" id="selectType" name="selectType" onchange="toggleInputBoxes()">
                                                <option value="RDRRMC">RDRRMC members</option>
                                                <option value="LDRRMOs">LDRRMOs</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- RDRRMC members input box -->
                                    <div id="RDRRMCInputBox">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="agency">Agency/Organization</label>
                                                <input type="text" class="form-control" id="agency" name="agency" placeholder="Agency/Organization">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="head_of_office">Name of Head of Office</label>
                                                <input type="text" class="form-control" id="head_of_office" name="head_of_office" placeholder="Name of Head of Office">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="position_r">Position</label>
                                                <input type="text" class="form-control" id="position_r" name="position_r" placeholder="Position">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="contact_number_r">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number_r" name="contact_number_r" placeholder="Contact Number">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email_r">Email Address</label>
                                                <input type="email" class="form-control" id="email_r" name="email_r" placeholder="Email Address">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="office_address_r">Office Address</label>
                                                <input type="text" class="form-control" id="office_address_r" name="office_address_r" placeholder="Office Address">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="showMoreDetails" onchange="toggleMoreDetails()">
                                                    <label class="form-check-label" for="showMoreDetails">Add Focal Person Instead</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="moreDetails" style="display: none;">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="drrm_focal_person">Name of DRRM Focal Person</label>
                                                    <input type="text" class="form-control" id="drrm_focal_person" name="drrm_focal_person" placeholder="Name of DRRM Focal Person">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_position">Position</label>
                                                    <input type="text" class="form-control" id="focal_person_position" name="focal_person_position" placeholder="Position">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_contact">Contact Number</label>
                                                    <input type="text" class="form-control" id="focal_person_contact" name="focal_person_contact" placeholder="Contact Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_email">Email Address</label>
                                                    <input type="email" class="form-control" id="focal_person_email" name="focal_person_email" placeholder="Email Address">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="office_address_fp">Office Address</label>
                                                    <input type="text" class="form-control" id="office_address_fp" name="office_address_fp" placeholder="Office Address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- LDRRMOs input box -->
                                    <div id="LDRRMOInputBox" style="display:none;">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="local_chief_executive">Local Chief Executive</label>
                                                <input type="text" class="form-control" id="local_chief_executive" name="local_chief_executive" placeholder="Local Chief Executive">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="local_drrm_officer">Local DRRM Officer</label>
                                                <input type="text" class="form-control" id="local_drrm_officer" name="local_drrm_officer" placeholder="Local DRRM Officer">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="position_l">Position</label>
                                                <input type="text" class="form-control" id="position_l" name="position_l" placeholder="Position">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="designation">Designation</label>
                                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="contact_number_l">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number_l" name="contact_number_l" placeholder="Contact Number">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email_l">Email Address</label>
                                                <input type="email" class="form-control" id="email_l" name="email_l" placeholder="Email Address">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="office_address_l">Office Address</label>
                                                <input type="text" class="form-control" id="office_address_l" name="office_address_l" placeholder="Office Address">
                                            </div>
                                            <div id="focalPersonCheckboxWrapper" class="form-group col-md-12" style="display: block;">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="showMoreDetails" onchange="toggleMoreDetails()">
        <label class="form-check-label" for="showMoreDetails">Add Focal Person Instead</label>
    </div>
</div>

                                        <div id="moreDetailsLDRRMO" style="display: none;">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="drrm_focal_person">Name of DRRM Focal Person</label>
                                                    <input type="text" class="form-control" id="drrm_focal_person" name="drrm_focal_person" placeholder="Name of DRRM Focal Person">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_position">Position</label>
                                                    <input type="text" class="form-control" id="focal_person_position" name="focal_person_position" placeholder="Position">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_contact">Contact Number</label>
                                                    <input type="text" class="form-control" id="focal_person_contact" name="focal_person_contact" placeholder="Contact Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="focal_person_email">Email Address</label>
                                                    <input type="email" class="form-control" id="focal_person_email" name="focal_person_email" placeholder="Email Address">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="office_address_fp">Office Address</label>
                                                    <input type="text" class="form-control" id="office_address_fp" name="office_address_fp" placeholder="Office Address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?php @include("includes/control-sidebar.php"); ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php @include("includes/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
   function toggleInputBoxes() {
    var selectType = document.getElementById("selectType").value;
    var RDRRMCInputBox = document.getElementById("RDRRMCInputBox");
    var LDRRMOInputBox = document.getElementById("LDRRMOInputBox");
    var moreDetails = document.getElementById("moreDetails");
    var moreDetailsLDRRMO = document.getElementById("moreDetailsLDRRMO");
    var focalPersonCheckboxWrapper = document.getElementById("focalPersonCheckboxWrapper");

    if (selectType === "RDRRMC") {
        RDRRMCInputBox.style.display = "block";
        LDRRMOInputBox.style.display = "none";
        moreDetails.style.display = "none";
        focalPersonCheckboxWrapper.style.display = "block"; // Show the checkbox wrapper
    } else if (selectType === "LDRRMOs") {
        RDRRMCInputBox.style.display = "none";
        LDRRMOInputBox.style.display = "block";
        moreDetailsLDRRMO.style.display = "none";
        focalPersonCheckboxWrapper.style.display = "none"; // Hide the checkbox wrapper
    }
}


    function toggleMoreDetails() {
        var moreDetails = document.getElementById("moreDetails");
        if (moreDetails.style.display === "none") {
            moreDetails.style.display = "block";
        } else {
            moreDetails.style.display = "none";
        }
    }

    function toggleMoreDetailsLDRRMO() {
        var moreDetailsLDRRMO = document.getElementById("moreDetailsLDRRMO");
        if (moreDetailsLDRRMO.style.display === "none") {
            moreDetailsLDRRMO.style.display = "block";
        } else {
            moreDetailsLDRRMO.style.display = "none";
        }
    }

    function previewImage(input) {
    var preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}


</script>
</body>
</html>
