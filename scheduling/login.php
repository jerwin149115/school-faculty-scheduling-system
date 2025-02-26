<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('admin/db_connect.php');
ob_start();
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>School Faculty Scheduling System</title>

  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id']))
    header("location:index.php");
  ?>

  <style>
    body {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #343a40;
    }
    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h4 {
      text-align: center;
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 5px;
    }
    .btn-login {
      width: 100%;
      border-radius: 5px;
      font-weight: bold;
    }
    .alert {
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h4><b>Welcome To Faculty Scheduling System</b></h4>
    <form id="login-form">
      <div class="form-group">
        <label for="id_no" class="control-label">Enter Your Faculty ID No.</label>
        <input type="text" id="id_no" name="id_no" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-login">Login</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#login-form').submit(function(e) {
      e.preventDefault();
      let btn = $('.btn-login');
      btn.attr('disabled', true).html('Logging in...');
      
      if ($('.alert-danger').length) $('.alert-danger').remove();

      $.ajax({
        url: 'admin/ajax.php?action=login_faculty',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err) {
          console.log(err);
          btn.removeAttr('disabled').html('Login');
        },
        success: function(resp) {
          if (resp == 1) {
            location.href = 'index.php';
          } else {
            $('#login-form').prepend('<div class="alert alert-danger">Invalid Faculty ID. Please try again.</div>');
            btn.removeAttr('disabled').html('Login');
          }
        }
      });
    });
  </script>
</body>
</html>
