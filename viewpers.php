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
            font-family: Arial, sans-serif;
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
            max-width: 800px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Personnel List Styles */
        .personnel-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .person {
            width: calc(33.33% - 20px); /* Adjust according to your design */
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            box-sizing: border-box;
            cursor: pointer;
            position: relative;
        }

        .person img {
            width: 100%;
            border-radius: 8px; /* Keep the border radius for the personnel list */
            margin-bottom: 10px;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
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
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            overflow: auto;
            text-align: center;
        }

        .modal-content {
            margin: 10% auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 70%; /* Adjust width */
            max-width: 400px; /* Set maximum width */
            margin-left: auto;
            margin-right: auto;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Larger and Circular Popup Image */
        #modalImage {
            width: 100%;
            max-width: 200px; /* Set maximum width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 50%; /* Make the image circular */
            margin-bottom: 10px;
            display: block;
            margin: 0 auto; /* Center the image */
        }
        .delete-btn {
    position: absolute;
    top: 96%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: transparent;
    color: #36454F;
    border: none;
    cursor: pointer;
    padding: 0;
    font-size: 16px;
}

    </style>
</head>
<body>

<div class="container">
    <h2>View Personnel</h2>

    <!-- Filter by organization -->
    <div>
        <label for="organization">Filter by Organization:</label>
        <select id="organization" onchange="filterOrganization()">
            <option value="all">All</option>
            <option value="rdrrmc">RDRRMC</option>
            <option value="ldrrmos">LDRRMOS</option>
        </select>
    </div>

    <!-- Personnel Lists -->
    <div class="personnel-list" id="personnelList">
        <div class="row">
            <?php
            // Fetch data from the rdrrmc table
            $sql_rdrrmc = "SELECT * FROM rdrrmc";
            $result_rdrrmc = $conn->query($sql_rdrrmc);

            if ($result_rdrrmc && $result_rdrrmc->num_rows > 0) {
                while ($row_rdrrmc = $result_rdrrmc->fetch_assoc()) {
                    echo "<div class='person' data-org='rdrrmc' onclick='showDetails({$row_rdrrmc['id']})'>";                    echo "<button class='delete-btn' onclick='deletePerson({$row_rdrrmc['id']}, \"rdrrmc\")'><i class='fas fa-trash-alt'></i></button>"; // Delete button
                    $imageURL_rdrrmc = $row_rdrrmc['image'] ? 'uploads/' . $row_rdrrmc['image'] : 'uploads/default_image.jpg';
                    echo "<!-- Debug: Image URL: $imageURL_rdrrmc -->"; // Debugging statement
                    if (file_exists($imageURL_rdrrmc)) {
                        echo "<img src='{$imageURL_rdrrmc}' class='person-image'>";
                    } else {
                        echo "<p>Error: Image not found</p>";
                    }
                    echo "<p><strong>Agency:</strong> " . $row_rdrrmc['agency'] . "</p>";
                    echo "<p><strong>Head of Office:</strong> " . $row_rdrrmc['head_of_office'] . "</p>";
                    echo "<p><strong>Position:</strong> " . $row_rdrrmc['position_r'] . "</p>";
                    echo "<p><strong>Contact Number:</strong> " . $row_rdrrmc['contact_number_r'] . "</p>";
                    echo "</div>";
                }
            } else {
                // Display a message if no rdrrmc personnel found
                echo "<p>No RDRRMC personnel found</p>";
            }
            ?>
        </div>
        <div class="row">
        <?php
// Fetch data from the ldrrmos table
$sql_ldrrmos = "SELECT * FROM ldrrmos";
$result_ldrrmos = $conn->query($sql_ldrrmos);

if ($result_ldrrmos && $result_ldrrmos->num_rows > 0) {
    while ($row_ldrrmos = $result_ldrrmos->fetch_assoc()) {
        echo "<div class='person' data-org='ldrrmos' onclick='showDetails({$row_ldrrmos['id']})'>";
        echo "<button class='delete-btn' onclick='deletePerson({$row_ldrrmos['id']}, \"ldrrmos\")'><i class='fas fa-trash-alt'></i></button>"; // Delete button with trash icon
        $imageURL_ldrrmos = $row_ldrrmos['image'] ? 'uploads/' . $row_ldrrmos['image'] : 'uploads/default_image.jpg';
        echo "<!-- Debug: Image URL: $imageURL_ldrrmos -->"; // Debugging statement
        if (file_exists($imageURL_ldrrmos)) {
            echo "<img src='{$imageURL_ldrrmos}' class='person-image'>";
        } else {
            echo "<p>Error: Image not found</p>";
        }
        echo "<p><strong>Local Chief Executive:</strong> " . $row_ldrrmos['local_chief_executive'] . "</p>";
        echo "<p><strong>Position:</strong> " . $row_ldrrmos['position_l'] . "</p>";
        echo "<p><strong>Contact Number:</strong> " . $row_ldrrmos['contact_number_l'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row_ldrrmos['email_l'] . "</p>";
        echo "</div>";
    }
} else {
    // Display a message if no ldrrmos personnel found
    echo "<p>No LDRRMOS personnel found</p>";
}
?>

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

    // Function to show personnel details
    function showDetails(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById("modalImage").src = response.image;
                // Construct HTML to display all fields
                var detailsHTML = '';
                if (response.type === 'rdrrmc') {
                    detailsHTML += '</p>' +
                        '<p><strong>Agency:</strong> ' + response.agency + '</p>' +
                        '<p><strong>Head of Office:</strong> ' + response.head_of_office + '</p>' +
                        '<p><strong>Position:</strong> ' + response.position_r + '</p>' +
                        '<p><strong>Contact Number:</strong> ' + response.contact_number_r + '</p>' +
                        '<p><strong>Email:</strong> ' + response.email_r + '</p>' +
                        '<p><strong>Office Address:</strong> ' + response.office_address_r + '</p>';
                } else if (response.type === 'ldrrmos') {
                    detailsHTML +=  '</p>' +
                        '<p><strong>Local Chief Executive:</strong> ' + response.local_chief_executive + '</p>' +
                        '<p><strong>Local DRRM Officer:</strong> ' + response.local_drrm_officer + '</p>' +
                        '<p><strong>Position:</strong> ' + response.position_l + '</p>' +
                        '<p><strong>Designation:</strong> ' + response.designation + '</p>' +
                        '<p><strong>Contact Number:</strong> ' + response.contact_number_l + '</p>' +
                        '<p><strong>Email:</strong> ' + response.email_l + '</p>' +
                        '<p><strong>Office Address:</strong> ' + response.office_address_l + '</p>';
                }
                document.getElementById("modalDetails").innerHTML = detailsHTML;
                document.getElementById("myModal").style.display = "block";
            }
        };
        xhr.open("GET", "get_personnel_details.php?id=" + id, true);
        xhr.send();
    }

    // Function to close modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Filter personnel by organization
    var selectedOrg = "all"; // Default to show all organizations

   // Filter personnel by organization
function filterOrganization() {
    selectedOrg = document.getElementById("organization").value;
    var personnelLists = document.querySelectorAll(".personnel-list .person");
    personnelLists.forEach(function(person) {
        if (selectedOrg == "all" || person.getAttribute("data-org") == selectedOrg) {
            person.style.display = "block";
        } else {
            person.style.display = "none";
        }
    });
}



</script>

</body>
</html>
