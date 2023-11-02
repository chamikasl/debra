<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Debra | Register</title>

  <?php include('./header.php'); ?>

</head>

<style>
  body {
    background: linear-gradient(to bottom, rgb(0 0 0 / 40%) 0%, rgb(245 242 240 / 45%) 100%), url(../assets/img/main-wallpaper.jpg);
    background-position: center;
  }


  main#main {
    width: 100%;
    height: calc(100%);
    background: white;
  }

  #login-right {
    position: absolute;
    right: 0;
    width: 40%;
    height: calc(100%);
    background: white;
    display: flex;
    align-items: center;
  }

  #login-right .card {
    margin: auto
  }
</style>

<body>

  <main id="main" class=" alert-info">
    <div id="login-right">
      <div class="card col-md-8">
        <div class="card-body">
          <form id="registration-form">
            <div class="form-group">
              <label for="name" class="control-label">Organization Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email" class="control-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="confirm_password" class="control-label">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <!-- Hidden fields for UID and user type -->
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="user_type" name="user_type" value="Partner">
            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary" id="register-button">Register</button></center>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#registration-form').submit(function(e) {
        e.preventDefault();

        // Validate passwords match
        if ($('#password').val() !== $('#confirm_password').val()) {
          alert('Passwords do not match!');
          return;
        }

        // Validate all fields are filled out
        if (!$('#name').val() || !$('#email').val() || !$('#password').val() || !$('#confirm_password').val()) {
          alert('All fields are required!');
          return;
        }

        $('#register-button').attr('disabled', true).html('Registering...');

        // Function to generate unique ID
        function generateUniqueId() {

          var randomNum = Math.floor(Math.random() * 1000);
          var randomNumPadded = ('00' + randomNum).slice(-7);

          return randomNumPadded;
        }

        // Generate UID
        var uniqueUserId = generateUniqueId();
        $('#id').val(uniqueUserId);

        var formData = $(this).serialize();

        // Make an API request
        $.ajax({
          url: 'https://localhost:7100/user/register',
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            user_type: $('#user_type').val(),
            id: $('#id').val(),
          }),
          error: function(err) {
            console.log(err);
            $('#register-button').removeAttr('disabled').html('Register');
          },
          success: function(resp) {
            console.log(resp);
            if (resp.success) {
              alert('Registration successful!');
              window.location.href = 'login.php';
            } else {
              alert(resp.message || 'Registration failed. Please check the form and try again.');
              $('#register-button').removeAttr('disabled').html('Register');
            }
          }

        });
      });
    });
  </script>

</body>

</html>