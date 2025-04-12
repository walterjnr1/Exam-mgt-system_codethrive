<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include('../inc/config.php'); 


if (isset($_POST['btnadd'])) {
  // Sanitize inputs
  $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
  $password = $_POST['txtpassword'];
  $role = mysqli_real_escape_string($conn, $_POST['cmdrole']);
  $name = mysqli_real_escape_string($conn, $_POST['txtname']);
  $phone = mysqli_real_escape_string($conn, $_POST['txtphone']);

  // Validate inputs
  if (strlen($password) < 9) {
      $_SESSION['error'] = "Password must be more than 8 characters!";
  } else {
      $query = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $_SESSION['error'] = "Email already exists!";
      } else {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          $query = "INSERT INTO users (school_id, name, email, password, role, phone) 
                    VALUES ('$school_id', '$name', '$email', '$hashedPassword', '$role', '$phone')";
          $result = mysqli_query($conn, $query);

          if ($result) {
              // Send welcome email
              $mail = new PHPMailer(true);
              try {
                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'ucnewspro@gmail.com';
                  $mail->Password = 'qbffuhedyrxdcciw'; // Use an app-specific password for Gmail
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                  $mail->Port = 465;

                  $mail->setFrom($app_email, $app_name);
                  $mail->addAddress($email);

                  $message = "
                  <html><body>
                  <p>Hello $name,</p>
                  <p>Welcome to <strong>$app_name</strong>!</p>
                  <p>Email: <strong>$email</strong><br>
                  School Code: <strong>$school_code</strong><br>
                  Password: <strong>$password</strong></p>
                  <p>Regards,<br>$app_name Team</p>
                  </body></html>";

                  $mail->isHTML(true);
                  $mail->Subject = "Welcome to $app_name, $name!";
                  $mail->Body = $message;
                  $mail->send();

                  $_SESSION['success'] = "Account created successfully!";
              } catch (Exception $e) {
                  $_SESSION['error'] = "Email could not be sent. {$mail->ErrorInfo}";
              }
          } else {
              $_SESSION['error'] = "Database error: Could not insert user.";
          }
      }
  }
  header("Location: signup_form.php"); // Redirect to form or dashboard
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | School setting</title>
  <?php include('partials/head.php') ;?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partials/navbar.php') ;?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <?php include('partials/sidebar.php') ;?>
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtname'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="txtpassword" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtpassword'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <select id="cmdrole" name="cmdrole" class="form-control">
                        <option value="" <?php echo $_POST['cmdrole'] == '' ? 'selected' : ''; ?>>-- Select Role --</option>
                        <option value="Admin" <?php echo $_POST['cmdrole'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Teacher" <?php echo $_POST['cmdrole'] == 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="tel" name="txtphone" class="form-control" id="exampleInputPassword1" value="<?php echo $_POST['txtphone'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="txtemail" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtemail'] ?? ''; ?>">
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" name="btnadd" class="btn btn-primary">Save</button>
    </div>
</form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>

         
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>  <?php include('partials/footer.php') ;?></strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('partials/bottom-script.php') ;?>

</body>
</html>
