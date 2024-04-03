<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: orange; /* Header color */
            color: #fff; /* Text color */
            font-weight: normal;
            border-right: 1px solid #ddd;
            cursor: pointer;
        }

        td {
            border-right: 1px solid #ddd;
            cursor: pointer;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Table row hover effect */
        tr:hover {
            background-color: #f9f9f9;
        }

        /* Modal popup styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            max-width: 600px;
            position: relative;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-content.show {
            opacity: 1;
            transform: scale(1);
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            cursor: pointer;
        }

        .person-details {
            margin-bottom: 20px;
            text-align: center;
        }

        .person-info {
            color: #444;
            text-align: left;
            margin-top: 20px;
        }

        .person-info p {
            margin: 5px 0;
            line-height: 1.5;
        }

        .person-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px auto;
            border: 5px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        /* Popup table styles */
        .popup-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #333;
            margin-bottom: 20px;
        }

        .popup-table th, .popup-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .popup-table th {
            background-color: orange; /* Header color */
            color: #fff; /* Text color */
            font-weight: normal;
            border-right: 1px solid #ddd;
        }

        .popup-table td {
            border-right: 1px solid #ddd;
        }

        .popup-table tr:last-child td {
            border-bottom: none;
        }

        /* Table row hover effect */
        .popup-table tr:hover {
            background-color: #f9f9f9;
        }

        /* Filter dropdown styles */
        .filter-dropdown {
            margin-bottom: 20px;
        }

        /* Cursor pointer for clickable rows and cells */
        tr:hover, td:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>View Personnel</h2>

    <!-- Display Table -->
    <table id="personnelTable">
        <thead>
            <tr class="header-row">
                <th>Agency</th>
                <th>Contact Number</th>
                <th>Head of Office</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch data from the rdrrmc table
            $sql = "SELECT * FROM rdrrmc";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-org='RDRRMC' onclick=\"showDetails('" . $row['id'] . "')\">";
                        echo "<td>" . $row['agency'] . "</td>";
                        echo "<td>" . $row['contact_number_r'] . "</td>";
                        echo "<td>" . $row['head_of_office'] . "</td>";
                        echo "<td>" . $row['position_r'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if no personnel found
                    echo "<tr><td colspan='4'>No personnel found</td></tr>";
                }
            } else {
                // Display an error message if the query fails
                echo "Error: " . $conn->error;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal popup -->
<div id="myModal" class="modal" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="person-details" id="modalDetails"></div>
    </div>
</div>

<script>
    function showDetails(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("modalDetails").innerHTML = xhr.responseText;
                document.getElementById("myModal").style.display = "block";
                setTimeout(function(){
                    document.querySelector('.modal-content').classList.add('show');
                }, 50);
            }
        };
        xhr.open("GET", "ajax.php?action=get_personnel_data&id=" + id, true);
        xhr.send();
    }

    function closeModal() {
        document.querySelector('.modal-content').classList.remove('show');
        setTimeout(function(){
            document.getElementById("myModal").style.display = "none";
        }, 300);
    }
</script>

</body>
</html>
