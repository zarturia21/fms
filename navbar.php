<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>

<nav id="sidebar" class='coloring5' >
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
        <a href="index.php?page=files" class="nav-item nav-files"><span class='icon-field'><i class="fa fa-file"></i></span> Files</a>
        <a href="index.php?page=addpers" class="nav-item nav-addpers"><span class='icon-field'><i class="fa fa-user-plus"></i></span> Add Personnel</a>
        <a href="index.php?page=viewpers" class="nav-item nav-viewpers"><span class='icon-field'><i class="fa fa-user-check"></i></span> View Personnel</a>
        <?php if($_SESSION['login_type'] == 1): ?>
            <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php endif; ?>
    </div>
    <img src="./image/ocd.png" class="navbar-image" alt="OCG Image">
</nav>

<script>
    // JavaScript code remains the same
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')

     // JavaScript code to add 'active' class to the corresponding navbar item
     $(document).ready(function() {
        // Get the current page from the URL parameter 'page'
        var currentPage = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';

        // Check if the current page is 'viewpers' or 'viewpers2'
        if (currentPage === 'viewpers' || currentPage === 'viewpers2') {
            $('.nav-viewpers').addClass('active');
        }
    });
</script>

</body>
</html>
