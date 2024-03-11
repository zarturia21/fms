<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>

<div class="ocdt">OCD Caraga - Policy Development and Planning Section</div>

<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <!-- Logo Container -->
            <div class="logo-container">
                <div class="logo">
                    <!-- Replace the src attribute value with the path to your own image -->
                    <img src="image/OCD.png" alt="Your Logo" width="50px" height="50px">
                </div>
            </div>
            <!-- End Logo Container -->
            <div class="col-md-2 float-right">
                <!-- Use PHP to echo the username dynamically -->
                <a href="ajax.php?action=logout" class="username"><?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : 'Guest'; ?> <i class="fa fa-power-off"></i></a>
            </div>
        </div>
    </div>
</nav>

</body>
</html>
