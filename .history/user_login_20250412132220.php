<?php
session_start();
include('database/connect2.php');

if(isset($_POST['btnlogin']))
{
  $email = $conn->real_escape_string($_POST['txtemail']);
  $password = $_POST['txtpassword'];

  $query = "SELECT u.id, u.email, u.password, u.school_id, s.code AS school_code
  FROM users u LEFT JOIN schools s ON u.school_id = s.id WHERE u.email = ? LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($user = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $user['password'])) {
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['role'] = $user['role'];
          $_SESSION['name'] = $user['name'];
          $_SESSION['logged']=time();

          header("Location: index"); // or wherever the user should land
      } else {
          $_SESSION['error'] = "Invalid password!";
      }
  } else {
      $_SESSION['error'] = "No user found with this email.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Admin/dist/css/popup_style.css">
  <link rel="icon" type="image/png" sizes="16x16" href="uploadImage/Logo/gradeplus.jpeg">

  <style>
    body {
      background: #f5f7fa;
    }

    .form-container {
      max-width: 600px;
      margin: 50px auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      margin-bottom: 25px;
      text-align: center;
      font-weight: bold;
      color: #2c3e50;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }

    @media (max-width: 576px) {
      .form-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <p>&nbsp;</p>
  <div class="container">
    <div class="form-container">
      <h2 class="form-title"><img src="uploadImage/Logo/gradeplus.jpeg" alt="gradeplus" width="219" height="112"></h2>
      <h2 class="form-title">School Login</h2>
      <form  action="" method="POST" >
       
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" name="txtemail" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Password</label>
          <input type="password" class="form-control" name="txtpassword"  required>
        </div>
           
        <div class="d-grid">
          <button type="submit" name="btnlogin" class="btn btn-primary">Login</button>
        </div>
      </form>
      <p>&nbsp;</p>
      <p>Not yet Registered? <a href="add_school">Register</a> </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong>
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong>
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
</body>
</html>
