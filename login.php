<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Blog Site</title>
  
  <?php include('./header.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
  ?>

</head>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('img/ocdbkg.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 100%;
    width: 100%;
  }

  main#main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
  }

  .card {
    width: 35%;
  }

  .card-body {
    padding: 20px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  button.btn-primary {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #231e54;
    color: #fff;
    cursor: pointer;
  }

  button.btn-primary:hover {
    background-color: #0056b3;
  }

  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
  }

  .navbar {
	 position:  absolute;
    z-index: -1;
    width: 100%;
    height: 12%;
    top: 0%;
    left: 0%;
    opacity: 100%;
    background-color: #f5f4fd8f;
    display: block;
  }
  .logo {
	position:  absolute;
    width: 10%;
    height: auto;
    top: -53%;
    margin-left: -45vw;
  }

  .ocdt {
 position: absolute;
  top: 3.5%;
  left: 9%;
  width: 50%;
  height: auto;
  object-fit:fill;
}

</style>

<body>

<div class="navbar"></div>
<div class="ocdt" style="font-size:1.5vw">OCD Caraga - Policy Development and Planning Section
<img src="img/logo.png" class="logo">

</div>

  <main id="main">
    <div class="card">
      <div class="card-body">
        <form id="login-form">
          <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
        </form>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
  $('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'ajax.php?action=login',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

      },
      success: function(resp) {
        if (resp == 1) {
          location.reload('index.php?page=home');
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })
</script>
</html>
