<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

include('../inc/config.php'); 
if (empty($_SESSION['user_id'])) {
  header("Location: ../user_login");
}

if(isset($_POST["btnchange"]))
{

  $email = 'newleastpaysolution@gmail.com';
  $oldPassword = $_POST['txtoldpassword'];
  $newPassword = $_POST['txtnewpassword'];
  $confirmPassword = $_POST['txtconfirmpassword'];

  // Fetch current hash
  $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($currentHash);
  $stmt->fetch();
  $stmt->close();

  // Check if old password is correct
  if (!password_verify($oldPassword, $currentHash)) {
    $_SESSION['error'] = "Old password is incorrect.";
  }

  // Check if new password and confirm password are correct
  if ($newPassword !== $confirmPassword) {
    $_SESSION['error'] = "New password and confirm password do not match.";
  }

  // Check if new password is at least 8 characters long
  if (strlen($newPassword) < 8) {
    $_SESSION['error'] = "New password must be at least 8 characters long.";
  }

  $newHashed = password_hash($newPassword, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
  $stmt->bind_param("ss", $newHashed, $email);
  if ($stmt->execute()) {

      // Send new password via email
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->isSMTP(); //Send using SMTP
          $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
          $mail->SMTPAuth = true; //Enable SMTP authentication
          $mail->Username = 'ucnewspro@gmail.com'; //SMTP username
          $mail->Password = 'qbffuhedyrxdcciw'; //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
          $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
          //Recipients
          $mail->setFrom("$app_email", "$app_name"); 
          $mail->addAddress($email);

          $message = "
          <html>
          <head>
          <title>Password Update notification | $app_name</title>
          </head>
          <body>

          <p><strong>Hello,</strong></p>

          <p>We have received a request to change your password. Your new login credentials are provided below:</p>

          <p>New Password:<strong> $newPassword</strong></p>
          <p>(We recommend keeping this password secure for security purposes.)</p>
          <p>To log in, please visit: [https://gradepulse.com/user_login]</p>
          <p>If you did not request this change, please contact our support team immediately.</p>

          <p>Regards,</p>
          <p>$app_name Team</p>
          </body>
          </html>
          ";

          //Content
          $mail->isHTML(true); //Set email format to HTML
          $mail->Subject = "Password Update notification| $app_name";
          $mail->Body = $message;
          $mail->send();

          $_SESSION['success'] = 'Password changed successfully. Please check your email.';
          header("refresh:3; url=login");

      } catch (Exception $e) {
        $_SESSION['error'] = 'Password could not be sent. Please try again later. ';
      }
  } else {
    $_SESSION['error']= "Update failed.";
  }
  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Change Password</title>
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
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">&nbsp;</h3>
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" name="txtoldpassword" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtoldpassword'] ?? ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" name="txtnewpassword" class="form-control" id="exampleInputPassword1" value="<?php echo $_POST['txtnewpassword'] ?? ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="txtconfirmpassword" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtconfirmpassword'] ?? ''; ?>">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnchange" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
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
