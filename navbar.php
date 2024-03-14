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
        <a href="index.php?page=addusers" class="nav-item nav-addpers"><span class='icon-field'><i class="fa fa-user-plus"></i></span> Add Personel</a>
        <a href="index.php?page=viewusers" class="nav-item nav-viewpers"><span class='icon-field'><i class="fa fa-user-check"></i></span> View Personel</a>
        <?php if($_SESSION['login_type'] == 1): ?>
            <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    // JavaScript code remains the same
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

</body>
</html>
