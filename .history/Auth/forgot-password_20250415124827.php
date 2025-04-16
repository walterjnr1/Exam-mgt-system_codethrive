<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(0);

require 'vendor/autoload.php';
include('database/connect2.php');
include('database/connect.php');

$app_name = 'Grade Pulse';
$app_email = 'support@gradepulse.com';

if (isset($_POST["btnsubmit"])) {
  $email = $_POST['txtemail'];
  
  
  // Generate new password
  $newPassword = bin2hex(random_bytes(6)); // 6-char password
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  
  // Update in database
  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
  $stmt->bind_param("ss", $hashedPassword, $email);
  $stmt->execute();
  
  //send notification via email
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
      $mail->setFrom("$app_email","$app_name"); // Use a valid email address
      $mail->addAddress($email); //Add a recipient

          $message = "
          <html>
          <head>
          <title>Password Request notification | $app_name</title>
          </head>
          <body>
  
          <p><strong>Hello $name,</strong></p>
  
          <p>We have received a request to reset your password. Your new login credentials are provided below:</p>
  
          <p>New Password:<strong> $newPassword</strong></p>
          <p>(We recommend Reseting this password after logging in for security purposes.)</p>
          <p>To Reset your password , please click the link below:</p>
          <p>    <a href='$resetLink'  <button class='btn btn-warning'>Reset Password</button></a></p>
          <p>If you did not request this change, please contact our support team immediately.</p>
  
          <p>Regards,</p>
          <p>$app_name Team</p>
          </body>
          </html>
          ";
  
          //Content
          $mail->isHTML(true); //Set email format to HTML
          $mail->Subject = "Password Request notification| $app_name";
          $mail->Body = $message;
          $mail->send();
  
  
          $_SESSION['success']  = "If your Email Exist a New password will be sent to {$email}.";
  } catch (Exception $e) {
    $_SESSION['error'] ="Mailer Error: {$mail->ErrorInfo}";
  }
  
  $conn->close();
  } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $app_name ?>-Forgot Password</title>
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

  <p align="center">&nbsp;</p>
  <p align="center"><span class="form-title"><img src="../uploadImage/Logo/gradeplus.jpeg" alt="gradeplus" width="181" height="85"></span></p>
  <div class="container">
    <div class="form-container">
      <h2 class="form-title">&nbsp;</h2>
      <h4 class="form-title">Forgot Password </h4>
      <form  action="" method="POST" >
       
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" name="txtemail" required>
        </div>

   
           
        <div class="d-grid">
          <button type="submit" name="btnsubmit" class="btn btn-primary">Reset</button>
        </div>
      </form>
      <p>&nbsp;</p>
      <p>Login here <a href="user_login">Login</a> </p>
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
