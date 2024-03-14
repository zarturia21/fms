<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
        <a href="index.php?page=files" class="nav-item nav-files"><span class='icon-field'><i class="fa fa-file"></i></span> Files</a>
        <a href="index.php?page=addpers" class="nav-item nav-addpers"><span class='icon-field'><i class="fa fa-user-plus"></i></span> Add Personnel</a>
        <a href="index.php?page=viewpers" class="nav-item nav-viewpers"><span class='icon-field'><i class="fa fa-user-check"></i></span> View Personnel</a>
        <?php if($_SESSION['login_type'] == 1): ?>
            <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <h2>View Personnel</h2>
    <?php
    // Example code to display a list of personnel
    // You should replace this with your actual code to fetch and display personnel data
    $personnel = array(
        array("name" => "John Doe", "position" => "Manager", "department" => "Sales"),
        array("name" => "Jane Smith", "position" => "Developer", "department" => "IT"),
        array("name" => "Michael Johnson", "position" => "Designer", "department" => "Marketing")
    );
    ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personnel as $person): ?>
                <tr>
                    <td><?php echo $person['name']; ?></td>
                    <td><?php echo $person['position']; ?></td>
                    <td><?php echo $person['department']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    // JavaScript code remains the same
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

</body>
</html>
