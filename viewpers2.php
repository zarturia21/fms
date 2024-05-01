<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>View Personnel</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1050px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .row-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        /* Search Box Styles */
        .search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container label {
            margin-right: 10px;
            color: #333;
            font-weight: bold;
        }

        .search-container input[type=text] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            width: 300px;
            max-width: 100%;
            transition: border-color 0.3s ease;
        }

        .search-container input[type=text]:focus {
            border-color: #002858;
        }

        /* Select Organization Styles */
        .select-container {
            margin-left: 20px;
        }

        .select-container label {
            margin-right: 10px;
            color: #333;
            font-weight: bold;
        }

        .select-container select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .select-container select:focus {
            border-color: #002858;
        }

        /* Toggle View Button Styles */
        #toggleViewBtn {
            background-color: #002858;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #toggleViewBtn:hover {
            background-color: #001f42;
        }

        /* Personnel List Styles */
        .personnel-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .column {
            flex: 1 1 100%;
            max-width: 100%;
        }

        .personnel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .personnel-table th,
        .personnel-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .personnel-table th {
            background-color: #002858;
            color: #fff;
        }

        .personnel-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .personnel-table tr:hover {
            background-color: #ddd;
        }

        /* Orange Indicator for Organization Type */
        .org-indicator {
            background-color: #ff6f00;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Trash can icon styles */
        .trash-icon {
            color: gray;
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
            left: 20px;
        }

        /* Hover effect */
        .trash-icon:hover {
            color: red;
            transform: scale(1.2);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            text-align: center;
        }

        .modal-content {
            margin: 10% auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 70%;
            max-width: 500px;
            position: relative;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>View Personnel</h2>

    <script>
    function redirectToView() {
        window.location.href = 'http://localhost/fms/index.php?page=viewpers';
    }
</script>

<div class="row-container">
    <div class="search-container">
        <label for="search">Search:</label>
        <input type="text" id="search" oninput="searchPersonnel()">
    </div>

    <div class="select-container">
        <label for="orgSelect">Select Organization:</label>
        <select id="orgSelect" onchange="showSelectedOrg()">
            <option value="all">All</option>
            <option value="rdrrmc">RDRRMC</option>
            <option value="ldrrmos">LDRRMOS</option>
        </select>
    </div>

    <div>
        <button id="toggleViewBtn" onclick="redirectToView()">
            <i class="fas fa-eye"></i>
        </button>
    </div>
</div>


    <!-- Personnel Lists -->
    <div class="personnel-list" id="rdrrmcList" style="display: none;">
    <div class="column">
        <h3>RDRRMC Personnel</h3>
        <table class="personnel-table">
                <tr>
                    <th>Name of DRRM Focal Person</th>
                    <th>Position</th>
                    <th>Agency/Organization</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Actions</th> <!-- Added Actions column -->
                </tr>
                <?php
                // Fetch data from the rdrrmc table
                $sql_rdrrmc = "SELECT * FROM rdrrmc";
                $result_rdrrmc = $conn->query($sql_rdrrmc);

                if ($result_rdrrmc && $result_rdrrmc->num_rows > 0) {
                    while ($row_rdrrmc = $result_rdrrmc->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_rdrrmc['agency'] . "</td>";
                        echo "<td>" . $row_rdrrmc['position_r'] . "</td>";
                        echo "<td>" . $row_rdrrmc['agency_r'] . "</td>";
                        echo "<td>" . $row_rdrrmc['email_r'] . "</td>";
                        echo "<td>" . $row_rdrrmc['contact_number_r'] . "</td>";
                        echo "<td><i class='fas fa-trash-alt trash-icon' onclick='deletePerson(" . $row_rdrrmc['id'] . ", \"rdrrmc\")'></i></td>"; // Trashcan icon

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No RDRRMC personnel found</td></tr>";
                }
                ?>
            </table>
        </div>
            </div>
    <div class="personnel-list" id="ldrrmosList" style="display: none;">
    <div class="column">
        <h3>LDRRMOS Personnel</h3>
        <table class="personnel-table">
                <tr>
                    <th>Local Chief Executive</th>
                    <th>Position</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Province</th>
                    <th>Actions</th> <!-- Added Actions column -->
                </tr>
                <?php
                // Fetch data from the ldrrmos table
                $sql_ldrrmos = "SELECT * FROM ldrrmos";
                $result_ldrrmos = $conn->query($sql_ldrrmos);

                if ($result_ldrrmos && $result_ldrrmos->num_rows > 0) {
                    while ($row_ldrrmos = $result_ldrrmos->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_ldrrmos['local_chief_executive'] . "</td>";
                        echo "<td>" . $row_ldrrmos['position_l'] . "</td>";
                        echo "<td>" . $row_ldrrmos['contact_number_l'] . "</td>";
                        echo "<td>" . $row_ldrrmos['email_l'] . "</td>";
                        echo "<td>" . $row_ldrrmos['LGUs'] . "</td>";
                        echo "<td><i class='fas fa-trash-alt trash-icon' onclick='deletePerson(" . $row_ldrrmos['id'] . ", \"ldrrmos\")'></i></td>"; // Trashcan icon

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No LDRRMOS personnel found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
            </div>
<!-- Modal popup -->
<div id="myModal" class="modal" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <span class="close" onclick="closeModal()">&times;</span>
        <img src="" id="modalImage" class="person-image">
        <div class="person-details" id="modalDetails"></div>
    </div>
</div>

<script>
 function showSelectedOrg() {
        var selectedOrg = document.getElementById("orgSelect").value;
        if (selectedOrg === "rdrrmc") {
            document.getElementById("rdrrmcList").style.display = "block";
            document.getElementById("ldrrmosList").style.display = "none";
        } else if (selectedOrg === "ldrrmos") {
            document.getElementById("rdrrmcList").style.display = "none";
            document.getElementById("ldrrmosList").style.display = "block";
        } else {
            document.getElementById("rdrrmcList").style.display = "block";
            document.getElementById("ldrrmosList").style.display = "block";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Call showSelectedOrg() function to display both tables initially
        showSelectedOrg();
    });

    // Function to delete personnel
    function deletePerson(id, org) {
        if (confirm("Are you sure you want to delete this personnel?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Reload the page after successful deletion
                        window.location.reload();
                    } else {
                        alert("Failed to delete personnel.");
                    }
                }
            };
            xhr.open("GET", "delete_personnel.php?id=" + id + "&org=" + org, true);
            xhr.send();
        }
    }

    function showDetails(id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById("modalImage").src = response.image;
            // Construct HTML to display all fields including the indicator
            var detailsHTML = '';
            if (response.type === 'rdrrmc') {
                detailsHTML += '<p><strong></strong> <span class="org-indicator">RDRRMC</span></p>';
                detailsHTML += '<p><strong>Name of DRRM Focal Person:</strong> ' + response.agency + '</p>';
                detailsHTML += '<p><strong>Agency/Organization:</strong> ' + response.agency_r + '</p>';
                detailsHTML += '<p><strong>Position:</strong> ' + response.position_r + '</p>';
                detailsHTML += '<p><strong>Contact Number:</strong> ' + response.contact_number_r + '</p>';
                detailsHTML += '<p><strong>Email Address:</strong> ' + response.email_r + '</p>';
                detailsHTML += '<p><strong>Office Address:</strong> ' + response.office_address_r + '</p>';
                detailsHTML += '<button onclick="viewHeadChief(\'' + response.head_of_office + '\')">View Head Chief</button>';
            } else if (response.type === 'ldrrmos') {
                detailsHTML += '<p><strong></strong> <span class="org-indicator">LDRRMOS</span></p>';
                detailsHTML += '<p><strong>Local Chief Executive:</strong> ' + response.local_chief_executive + '</p>';
                detailsHTML += '<p><strong>Local DRRM Officer:</strong> ' + response.local_drrm_officer + '</p>';
                detailsHTML += '<p><strong>Position:</strong> ' + response.position_l + '</p>';
                detailsHTML += '<p><strong>Designation:</strong> ' + response.designation + '</p>';
                detailsHTML += '<p><strong>Contact Number:</strong> ' + response.contact_number_l + '</p>';
                detailsHTML += '<p><strong>Email:</strong> ' + response.email_l + '</p>';
                detailsHTML += '<p><strong>Office Address:</strong> ' + response.office_address_l + '</p>';
                detailsHTML += '<p><strong>Province:</strong> ' + response.LGUs + '</p>';
            }
            document.getElementById("modalDetails").innerHTML = detailsHTML;
            document.getElementById("myModal").style.display = "block";
        }
    };
    xhr.open("GET", "get_personnel_details.php?id=" + id, true);
    xhr.send();
}

function viewHeadChief(headOfOffice) {
    // Implement functionality to view head chief based on the headOfOffice parameter
    alert("Viewing Head Chief: " + headOfOffice);
}

// Function to close modal
function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

// Filter personnel by organization
var selectedOrg = "all"; // Default to show all organizations

// Search functionality
// Search functionality
function searchPersonnel() {
    var input, filter, tables, tr, td, i, txtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    tables = document.querySelectorAll(".personnel-table"); // Get all personnel tables
    
    // Loop through all personnel tables
    for (var t = 0; t < tables.length; t++) {
        tr = tables[t].getElementsByTagName('tr'); // Get all table rows within the current table
        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                var cell = td[j];
                if (cell) {
                    txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; // Break the inner loop, no need to continue searching other cells
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
}

</script>

</body>
</html>
