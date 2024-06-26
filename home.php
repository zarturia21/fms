<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loading.css">
    <script src="script.js"></script>
    <style>

    body, h1, h2, h3, h4, h5, h6, p, a, span, i, b, large, input, th, td {
        font-family: "Century Gothic", sans-serif;
    }


    /* ----------------------------- */
    /* Styling for the four boxes */
    .custom-card {
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    width: 235px; /* Set the desired width */
    height: 150px; /* Set the desired height */
    margin-left: 20px; /* Add margin to the left */
}

/* Styling for the specific boxes */
.users-box, .files-box, .rdrrmc-count-box, .ldrrmos-count-box {
    background-color: #3498db; /* Blue */
    color: #fff; /* White text */
}

/* Additional styling for specific boxes */
.files-box, .users-box {
    background-color: #f39c12; /* Orange */
    color: #000; /* Black text */
}


.custom-card:hover {
    transform: translateY(-5px);
}

/* Users box */
.users-box {
    background-color: #04264f; /* Blue */
    color: #fff; /* White text */
}

/* Files box */
.files-box {
    background-color: #2196F3; /* Orange */
    color: #000; /* Black text */
}

/* RDRRMC Count box */
.rdrrmc-count-box {
    background-color: #f1bc1b; /* Green */
    color: #fff; /* White text */
}

/* LDRRMOS Count box */
.ldrrmos-count-box {
    background-color: #FF9800; /* Purple */
    color: #fff; /* White text */
}

.card-body {
    position: relative;
    margin-top: -50px;
}

.card-body h4 {
    font-size: 17px; /* Adjust the font size for h4 */
    margin-top: 50px;
}

.card-body h3 {
    font-size: 30px; /* Adjust the font size for h3 */
}

.card-icon {
    position: absolute;
    right: 20px;
    bottom: 10px;   
    font-size: 3em;
    color: rgba(255, 255, 255, 0.5);
}

span.card-icon {
        position: absolute;
        font-size:2em;
        bottom: 0em;
        color: #ffffff80;
    }

/* Updated CSS to adjust the font size of the file icons */

.number-top-right {
    position: absolute;
    bottom: 10px;
    left: 30px;
    margin: 0;
}

    /* FOR THE 4 CSS BOXES COOL DESIGN*/

    .custom-menu {
        z-index: 1000;
        position: absolute;
        background-color: #ffffff;
        border: 1px solid #0000001c;
        border-radius: 5px;
        padding: 8px;
        min-width: 13vw;
    }


    a.custom-menu-list {
        width: 100%;
        display: flex;
        color: #4c4b4b;
        font-weight: 600;
        font-size: 1em;
        padding: 1px 11px;
        max-width: 200px; /* Adjust the maximum width as needed */
        white-space: nowrap; /* Prevent the text from wrapping */
        overflow: hidden; /* Hide the overflow text */
        text-overflow: ellipsis; /* Add ellipsis (...) for overflow text */
    }


    .file-item {
        cursor: pointer;
    }

    a.custom-menu-list:hover,
    .file-item:hover,
    .file-item.active {
        background: #80808024;
    }

    table th,
    td {
        /*border-left:1px solid gray;*/
    }

    a.custom-menu-list span.icon {
        width: 1em;
        margin-right: 5px;
    }

    .sorter {
        width: 300px; /* Adjust the width as needed */
    }

    #descriptionSorter {
        width: 300px; /* Adjust the width as needed */
        margin-top: -50px;
    }

    #descriptionSorterContainer {
    display: flex;
    justify-content: flex-end; /* Align the content to the right */
    z-index: 9999999;
}


    /* Custom styling for the table */
#file-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Fixed table layout */

}

#file-table th,
#file-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    color: #333; /* Dark text color */
    font-size: 14px; /* Uniform font size */
}

/* Header styling */
#file-table th {
    background-color: #3a55ed; /* Orange background color */
    color: #fff; /* White text color */
    font-weight: bold;
    padding-top: 16px;
    padding-bottom: 16px;
    border-bottom: 2px solid #000000; /* Orange border bottom */
    text-transform: uppercase; /* Uppercase text */
}

/* Alternate row background color for better readability */
#file-table tr:nth-child(even) {
    background-color: #f2f2f2; /* Light gray background color */
}

/* Hover effect for rows */
#file-table tr:hover {
    background-color: #e0e0e0; /* Lighter gray background color on hover */
}

/* File icon styling */
#file-table .fa {
    margin-right: 10px;
    color: #ff8c00; /* Orange icon color */
}

/* Add a subtle shadow to the table */
#file-table {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle box-shadow */
}

/* Adjustments for smaller screens */
@media screen and (max-width: 600px) {
    #file-table th, #file-table td {
        padding: 10px; /* Reduce padding for smaller screens */
        font-size: 12px; /* Reduce font size for smaller screens */
    }
}


/* Styling the search container */

#searchContainer {
    margin-bottom: 20px;
}

/* Styling the search input */
#searchInput {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    font-size: 16px;
    margin-top: -69px;
}

/* Styling the search icon */


/* Styling the search input on hover and focus */
#searchInput:hover,
#searchInput:focus {
    border-color: #666;
    outline: none;
}

/* Adjustments for smaller screens */
@media screen and (max-width: 600px) {
    .row {
        display: flex;
        flex-direction: column;
        align-items: flex-end; /* Align items to the right */
    }

    .col-md-8 {
        order: 2; /* Reorder the empty column to be at the end */
    }
}


.input-group-prepend {
    position: relative; /* Make the container relative */
    left: 21vw; /* Adjust the left position as needed */
    top: -3.6vw; /* Align the icon vertically */
    z-index: 999; /* Ensure the icon stays above other content */
    transform: translateY(-50%); /* Center the icon vertically */
}



</style>
</head>
<body>
    <!-- Add the loading screen HTML -->
    <div class="loading-screen">
    <img src="image/ocd.png" alt="OCD Logo" class="ocd-logo">
    <img src="image/giflod.gif" alt="Loading..." class="loading-gif">
</div>

<br>

<div class="containe-fluid">
    <?php include('db_connect.php');
    include 'db_connect.php';

    include 'db_connect.php';

    // Count the number of uploaded files for RDRRMC
    $sql_rdrrmc_count = "SELECT COUNT(*) AS rdrrmc_count FROM rdrrmc";
    $result_rdrrmc_count = $conn->query($sql_rdrrmc_count);
    $rdrrmc_count = $result_rdrrmc_count->fetch_assoc()['rdrrmc_count'];
    
    // Count the number of uploaded files for LDRRMOS
    $sql_ldrrmos_count = "SELECT COUNT(*) AS ldrrmos_count FROM ldrrmos";
    $result_ldrrmos_count = $conn->query($sql_ldrrmos_count);
    $ldrrmos_count = $result_ldrrmos_count->fetch_assoc()['ldrrmos_count'];
    
    // Count the number of users
    $sql_user_count = "SELECT COUNT(*) AS user_count FROM users";
    $result_user_count = $conn->query($sql_user_count);
    $user_count = $result_user_count->fetch_assoc()['user_count'];
    
    
    $files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");

    
    ?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">

            <a href="http://localhost/fms/index.php?page=users">
                <div class="card custom-card users-box ml-4 float-left">
            <div class="card-body text-white">
                <h4><b>Users</b></h4>
                <hr>
                <span class="card-icon"><i class="fa fa-users"></i></span>
                <h3 class="text-right number-top-right"><b><?php echo $conn->query('SELECT * FROM users')->num_rows ?></b></h3>
            </div>
        </div></a>

        <a href="http://localhost/fms/index.php?page=files">
        <div class="card custom-card files-box ml-4 float-left">

            <div class="card-body text-white">
                <h4><b>Files</b></h4>
                <hr>
                <span class="card-icon"><i class="fa fa-file"></i></span>
                <h3 class="text-right number-top-right"><b><?php echo $conn->query('SELECT * FROM files')->num_rows ?></b></h3>
            </div>
        </div></a>

        <a href="http://localhost/fms/index.php?page=viewpers">
        <div class="card custom-card rdrrmc-count-box ml-4 float-left">
       
            <div class="card-body text-white">
                <h4><b>RDRRMC File Count</b></h4>
                <hr>
                <span class="card-icon"><i class="fa fa-file"></i></span>
                <h3 class="text-right number-top-right"><b><?php echo $rdrrmc_count; ?></b></h3>
            </div>
        </div></a>

        <a href="http://localhost/fms/index.php?page=viewpers">
        <div class="card custom-card ldrrmos-count-box ml-4 float-left">
       
            <div class="card-body text-white">
                <h4><b>LDRRMOS File Count</b></h4>
                <hr>
                <span class="card-icon"><i class="fa fa-file"></i></span>
                <h3 class="text-right number-top-right"><b><?php echo $ldrrmos_count; ?></b></h3>
                </div>
            </div></a>

        </div>
    </div>
</div>


<div class="column mt-3 ml-3 mr-3">
    <div class="row">
        <div class="col-md-4 mb-3">
            <select class="form-control sorter" id="organizationSorter">
                <option value="">Sort by Organization</option>
                <option value="OCD">OCD</option>
                <option value="RDRRMC">RDRRMC</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <select class="form-control" id="yearSorter">
                <option value="">All Year</option>
                <?php
                for ($year = 2010; $year <= 2030; $year++) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="row mt-3 ml-3 mr-3">
    <div class="col-md-8 mb-3"></div> <!-- Empty column to occupy space -->
    <div class="col-md-4 mb-3">
        <!-- Search Bar -->
        <div class="input-group">
            <div class="input-group-prepend">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
        </div>
    </div>
    <div class="col-md-3.5 mb-3" id="descriptionSorterContainer">
        <select class="form-control" id="descriptionSorter" style="display: none;">
            <option value="">All File</option>
            <!-- Description options will be dynamically populated here -->
        </select>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<div class="row mt-3 ml-3 mr-3">
 
        <div class="card-body">
            <div class="file-table-container">
                <table width="100%" id="file-table">
                    <thead>
                        <tr>
                            <th width="12%" class="">Uploader</th>
                            <th width="35%" class="">Filename</th>
                            <th width="15%" class="">Upload Date</th>
                            <th width="15%" class="">Description</th>
                            <th width="15%" class="">Organization</th>
                            <th width="15%" class="">File Year</th>
                        </tr>
                        
                    
                <!-- Table content goes here -->
           <?php
                    while ($row = $files->fetch_assoc()) :
                        $name = explode(' ||', $row['name']);
                        $name = isset($name[1]) ? $name[0] . "(" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
                        $img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
                        $doc_arr = array('doc', 'docx');
                        $pdf_arr = array('pdf', 'ps', 'eps', 'prn');
                        $icon = 'fa-file';
                        if (in_array(strtolower($row['file_type']), $img_arr))
                            $icon = 'fa-image';
                        if (in_array(strtolower($row['file_type']), $doc_arr))
                            $icon = 'fa-file-word';
                        if (in_array(strtolower($row['file_type']), $pdf_arr))
                            $icon = 'fa-file-pdf';
                        if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
                            $icon = 'fa-file-excel';
                        if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
                            $icon = 'fa-file-archive';
                    ?>
 <tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>" data-organization="<?php echo $row['organization'] ?>" data-description="<?php echo $row['description'] ?>" data-year="<?php echo $row['year'] ?>">
                            <td><i><?php echo ucwords($row['uname']) ?></i></td>
                            <td>
                                <large>
                                    <span><i class="fa <?php echo $icon ?>"></i></span>
                                    <b> <?php echo $name ?></b>
                                </large>
                                <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
                            </td>
                            <td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
                            <td><i><?php echo $row['description'] ?></i></td>
                            <td><i><?php echo $row['organization'] ?></i></td>
                            <td><i><?php echo $row['year'] ?></i></td>

                        </tr>

                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="menu-file-clone" style="display: none;">
    <a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
</div>
<script>
    //FILE
    $('.file-item').bind("contextmenu", function(event) {
        event.preventDefault();

        $('.file-item').removeClass('active')
        $(this).addClass('active')
        $("div.custom-menu").hide();
        var custom = $("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.download').attr('data-id', $(this).attr('data-id'))
        custom.appendTo("body")
        custom.css({ top: event.pageY + "px", left: event.pageX + "px" });


        $("div.file.custom-menu .download").click(function(e) {
            e.preventDefault()
            window.open('download.php?id=' + $(this).attr('data-id'))
        })

    })
    $(document).bind("click", function(event) {
        $("div.custom-menu").hide();
        $('#file-item').removeClass('active')

    });
    $(document).keyup(function(e) {

        if (e.keyCode === 27) {
            $("div.custom-menu").hide();
            $('#file-item').removeClass('active')

        }
    })

    $(document).ready(function() {
    // Function to perform filtering based on selected organization, description, and year
    function filterFiles() {
        var organization = $('#organizationSorter').val();
        var description = $('#descriptionSorter').val();
        var year = $('#yearSorter').val();

        // Perform the sorting and filtering
        $('.file-item').each(function() {
            var organizationMatch = true;
            var descriptionMatch = true;
            var yearMatch = true;

            if (organization && $(this).data('organization') !== organization) {
                organizationMatch = false;
            }
            if (description && $(this).data('description') !== description) {
                descriptionMatch = false;
            }
            if (year && $(this).data('year').toString() !== year) {
                yearMatch = false;
            }

            if (organizationMatch && descriptionMatch && yearMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Populate description dropdown based on the selected organization
    $('#organizationSorter').change(function() {
        var organization = $(this).val();
        if (organization === 'OCD') {
            $('#descriptionSorter').html(`
                <option value="">All Description</option>
                <option value="Officer Order">Office Order</option>
                <option value="PPBER">PPBER</option>
                <option value="MAR">MAR</option>
                <option value="OPC/OPCR">OPC/OPCR</option>
                <option value="NARRATIVE ACCOMPLISHMENT">NARRATIVE ACCOMPLISHMENT</option>
                <option value="LETTER">LETTER</option>
                <option value="ACTIVITY DESIGN">ACTIVITY DESIGN</option>
                <option value="PROJECT PROPOSAL">PROJECT PROPOSAL</option>
                <option value="DF">DF</option>
                <option value="PROCUREMENT DOCS">PROCUREMENT DOCS</option>
                <option value="ATTENDANCE">ATTENDANCE</option>
                <option value="TRAVEL ORDER">TRAVEL ORDER</option>
            `).show();
        } else if (organization === 'RDRRMC') {
            $('#descriptionSorter').html(`
                <option value="">All File</option>
                <option value="MEMORANDUM">MEMORANDUM</option>
                <option value="RESOLUTION">RESOLUTION</option>
                <option value="MINUTES">MINUTES</option>
                <option value="ATTENDANCE">ATTENDANCE</option>
                <option value="LETTERS">LETTERS</option>
                <option value="AFTER ACTIVITY REPORT">AFTER ACTIVITY REPORT</option>
                <option value="GAWAD KALASAG SEAL">GAWAD KALASAG SEAL</option>
                <option value="GAWAD KALASAG SPECIAL AWARD">GAWAD KALASAG SPECIAL AWARD</option>
                <option value="LOCAL DRRM PLAN REVIEW">LOCAL DRRM PLAN REVIEW</option>
                <option value="TRAVEL ORDER">TRAVEL ORDER</option>
            `).show();
        } else {
            $('#descriptionSorter').html('<option value="">Sort by Description</option>').hide();
        }

        // Perform filtering based on selected organization, description, and year
        filterFiles();
    });

    // Handle sorting when description dropdown value changes
    $('#descriptionSorter').change(function() {
        // Perform filtering based on selected organization, description, and year
        filterFiles();
    });

    // Handle sorting when year sorter dropdown value changes
    $('#yearSorter').change(function() {
        // Perform filtering based on selected organization, description, and year
        filterFiles();
    });
});

$(document).ready(function() {
    // Search function
    var searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            var searchText = $('#searchInput').val().trim().toLowerCase();
            $('.file-item').each(function() {
                var uploader = $(this).find('td:nth-child(1)').text().toLowerCase();
                var filename = $(this).find('td:nth-child(2)').text().toLowerCase();
                var uploadDate = $(this).find('td:nth-child(3)').text().toLowerCase();
                var description = $(this).find('td:nth-child(4)').text().toLowerCase();
                var organization = $(this).find('td:nth-child(5)').text().toLowerCase();
                var fileYear = $(this).find('td:nth-child(6)').text().toLowerCase();

                // Check for partial matches
                var partialMatch = function(text, query) {
                    return text.indexOf(query) !== -1;
                };

                // Check for exact matches
                var exactMatch = function(text, query) {
                    return text === query;
                };

                // Check for case sensitivity
                var caseSensitive = function(text, query) {
                    return text.includes(query);
                };

                // Filter based on search options
                if ((uploader.includes(searchText) && uploader !== '') ||
                    (filename.includes(searchText) && filename !== '') ||
                    (uploadDate.includes(searchText) && uploadDate !== '') ||
                    (description.includes(searchText) && description !== '') ||
                    (organization.includes(searchText) && organization !== '') ||
                    (fileYear.includes(searchText) && fileYear !== '')) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }, 300); // Delay in milliseconds before starting the search
    });
});

</script>
</body>
</html>
