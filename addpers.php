<?php
// Include database connection
require_once("./db_connect.php");

if(isset($_POST['submit'])){
    // Get form data
    $image = $_FILES['image']['name'];
    $agency = $_POST['agency'];
    $head_of_office = $_POST['head_of_office'];
    $position_r = $_POST['position_r'];
    $contact_number_r = $_POST['contact_number_r'];
    $email_r = $_POST['email_r'];
    $office_address_r = $_POST['office_address_r'];
    $local_chief_executive = $_POST['local_chief_executive'];
    $local_drrm_officer = $_POST['local_drrm_officer'];
    $position_l = $_POST['position_l'];
    $designation = $_POST['designation'];
    $contact_number_l = $_POST['contact_number_l'];
    $email_l = $_POST['email_l'];
    $office_address_l = $_POST['office_address_l'];

    // Check if RDRRMC or LDRRMOs is selected
    $selectType = $_POST['selectType'];
    if($selectType === "RDRRMC") {
        // Prepare insert query for RDRRMC table
        $stmt = $conn->prepare("INSERT INTO RDRRMC (image, agency, head_of_office, position_r, contact_number_r, email_r, office_address_r) VALUES (?, ?, ?, ?, ?, ?, ?)");
        // Bind parameters for RDRRMC table
        $stmt->bind_param("sssssss", $image, $agency, $head_of_office, $position_r, $contact_number_r, $email_r, $office_address_r);
    } elseif($selectType === "LDRRMOs") {
        // Prepare insert query for LDRRMOs table
        $stmt = $conn->prepare("INSERT INTO LDRRMOs (image, local_chief_executive, local_drrm_officer, position_l, designation, contact_number_l, email_l, office_address_l) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        // Bind parameters for LDRRMOs table
        $stmt->bind_param("ssssssss", $image, $local_chief_executive, $local_drrm_officer, $position_l, $designation, $contact_number_l, $email_l, $office_address_l);
    }
    
    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Record inserted successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    
    // Close statement
    $stmt->close();

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
                                                    <label class="form-check-label" for="showMoreDetails">Add Focal Person</label>
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
                                    <div id="LDRRMOsInputBox" style="display: none;">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="local_chief_executive">Name of Local Chief Executive</label>
                                                <input type="text" class="form-control" id="local_chief_executive" name="local_chief_executive" placeholder="Name of Local Chief Executive">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="local_drrm_officer">Name of Local DRRM Officer</label>
                                                <input type="text" class="form-control" id="local_drrm_officer" name="local_drrm_officer" placeholder="Name of Local DRRM Officer">
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php @include("includes/footer.php"); ?>
</div>
<!-- ./wrapper -->
<?php @include("includes/foot.php"); ?>
<script>
    function toggleInputBoxes() {
        var selectType = document.getElementById("selectType").value;
        var LDRRMOsInputBox = document.getElementById("LDRRMOsInputBox");
        var RDRRMCInputBox = document.getElementById("RDRRMCInputBox");

        if (selectType === "RDRRMC") {
            LDRRMOsInputBox.style.display = "none";
            RDRRMCInputBox.style.display = "block";
        } else if (selectType === "LDRRMOs") {
            LDRRMOsInputBox.style.display = "block";
            RDRRMCInputBox.style.display = "none";
        }
    }

    function toggleMoreDetails() {
        var showMoreDetails = document.getElementById("showMoreDetails");
        var moreDetails = document.getElementById("moreDetails");

        if (showMoreDetails.checked) {
            moreDetails.style.display = "block";
        } else {
            moreDetails.style.display = "none";
        }
    }

    function previewImage(input) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('preview');
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>