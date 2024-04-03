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






.login {
  overflow: hidden;
  background-color: #ebebeb;
  opacity: 90%;
  padding: 40px 30px 30px 30px;
  border-radius: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 450px;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-transition: -webkit-transform 300ms, box-shadow 300ms;
  -moz-transition: -moz-transform 300ms, box-shadow 300ms;
  transition: transform 300ms, box-shadow 300ms;
  box-shadow: 5px 10px 10px rgba(2, 128, 144, 0.2);
}
.login::before, .login::after {
  content: "";
  position: absolute;
  width: 600px;
  height: 600px;
  border-top-left-radius: 40%;
  border-top-right-radius: 45%;
  border-bottom-left-radius: 35%;
  border-bottom-right-radius: 40%;
  z-index: -1;
}
.login::before {
  left: 40%;
  bottom: -130%;
  background-color: rgba(69, 105, 144, 0.15);
  -webkit-animation: wawes 6s infinite linear;
  -moz-animation: wawes 6s infinite linear;
  animation: wawes 6s infinite linear;
}
.login::after {
  left: 35%;
  bottom: -125%;
  background-color: rgb(242 137 32 / 51%);
  -webkit-animation: wawes 7s infinite;
  -moz-animation: wawes 7s infinite;
  animation: wawes 7s infinite;
}
.login > input {
  font-family: "Asap", sans-serif;
  display: block;
  border-radius: 5px;
  font-size: 16px;
  background: white;
  width: 100%;
  border: 0;
  padding: 10px 10px;
  margin: 15px -10px;
}
.login > button {
  font-family: "Asap", sans-serif;
  cursor: pointer;
  color: #fff;
  font-size: 16px;
  text-transform: uppercase;
  width: 80px;
  border: 0;
  padding: 10px 0;
  margin-top: 10px;
  margin-left: -5px;
  border-radius: 5px;
  background-color: #f28920;
  -webkit-transition: background-color 300ms;
  -moz-transition: background-color 300ms;
  transition: background-color 300ms;
}
.login > button:hover {
  background-color: #f24353;
}

@-webkit-keyframes wawes {
  from {
    -webkit-transform: rotate(0);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
@-moz-keyframes wawes {
  from {
    -moz-transform: rotate(0);
  }
  to {
    -moz-transform: rotate(360deg);
  }
}
@keyframes wawes {
  from {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -ms-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0);
  }
  to {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
a {
  text-decoration: none;
  color: rgba(255, 255, 255, 0.6);
  position: absolute;
  right: 10px;
  bottom: 10px;
  font-size: 12px;
}

</style>

<body>

<div class="navbar"></div>
<div class="ocdt" style="font-size:1.5vw">OCD Caraga - Policy Development and Planning Section
<img src="img/logo.png" class="logo">

</div>

<main id="main">
  <form class="login" id="login-form">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
  </form>
</main>


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
$('#login-form').submit(function(e) {
  e.preventDefault();
  $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
  if ($(this).find('.alert-danger').length > 0)
    $(this).find('.alert-danger').remove();
  $.ajax({
    url: 'ajax.php?action=login',
    method: 'POST',
    data: $(this).serialize(),
    error: err => {
      console.log(err);
      $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
    },
    success: function(resp) {
      if (resp == 1) {
        location.reload('index.php?page=home');
      } else {
        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
        $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
      }
    }
  });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>
