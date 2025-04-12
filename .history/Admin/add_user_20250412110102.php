<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include('../inc/config.php'); 


if (isset($_POST['btnadd'])) {
  // Validate user input
  $email = $_POST['txtemail'];
  $password = $_POST['txtpassword'];
  $role = $_POST['cmdrole'];
  $name = $_POST['txtname'];
  $phone = $_POST['txtphone'];

  // Check if email already exists
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $error= "Email already exists!";
    exit;
  }

  // Check if password is more than 8 characters
  if (strlen($password) < 9) {
    $error= "Password must be more than 8 characters!";
    exit;
  }

  // Create user account
  $query = "INSERT INTO users (name, email, password, role, phone) VALUES ('$name', '$email', '$password', '$role', '$phone')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Send email notification
    $mail = new PHPMailer(true);

    try {
      // Server settings
      $mail->isSMTP(); // Send using SMTP
      $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
      $mail->SMTPAuth = true; // Enable SMTP authentication
      $mail->Username = 'ucnewspro@gmail.com'; // SMTP username
      $mail->Password = 'qbffuhedyrxdcciw'; // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
      $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      // Recipients
      $mail->setFrom("$app_email", "$app_name"); // Use a valid email address
      $mail->addAddress($email); // Add a recipient

      $message = "
<html>
<head>
<title>User Registration notification | $app_name</title>
</head>
<body>

<p><strong>Hello $name  ,</strong></p>

<p>You were registered as a $role to the  $app_name.</p>

<p><strong>code : </strong> $code</p>

<p>Please keep the code safe as it will used to login to your account.</p>
<p>Regards,</p>
<p>Grade Pulse Team</p>
</body>
</html>
";

      // Content
      $mail->isHTML(true); // Set email format to HTML
      $mail->Subject = 'User Registration notification| $app_name';
      $mail->Body = $message;
      $mail->send();

      $success= "Email sent successfully!";
    } catch (Exception $e) {
      $error= 'Email could not be sent. Please try again later. ' . $e->getMessage();
    }
  } else {
    $error= "Error: Unable to save data to database.";
  }
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
