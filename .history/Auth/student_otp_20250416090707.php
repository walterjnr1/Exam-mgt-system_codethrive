<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include('config.php'); 

if (empty($_SESSION['otp'])) {
  header("Location: add_student");
}

if (isset($_POST['btnverify'])) {
  $otp = $_POST['otp'];
  $email = $_SESSION['email']; // Assuming student ID is stored in session

  // Check if OTP is valid and not expired (15 minutes)
  $otp_query = "SELECT * FROM otps WHERE email = '$email' AND otp = '$otp' AND TIMESTAMPDIFF(MINUTE, created_at, NOW()) < 15";
  $result = mysqli_query($conn, $otp_query);

  if (mysqli_num_rows($result) > 0) {
      // OTP is valid, send welcome email
      $student_email = $_SESSION['student_email'];
      $admission_number = $_SESSION['admission_number'];

      // Create a new PHPMailer instance
      $mail = new PHPMailer(true);

      // Set mailer to use SMTP
      $mail->isSMTP();

      // Set SMTP host and port
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;

      // Set SMTP authentication
      $mail->SMTPAuth = true;
      $mail->Username = 'your_email@gmail.com';
      $mail->Password = 'your_password';

      // Set mail sender and recipient
      $mail->setFrom('your_email@gmail.com', 'Your Name');
      $mail->addAddress($student_email, $student_name);

      // Set email subject and body
      $mail->Subject = 'Welcome to Our Institution!';
      $mail->Body = 'Dear ' . $student_name . ',<br><br>
          Congratulations on your admission to our institution! Your admission number is ' . $admission_number . '.<br><br>
          We welcome you to our community and look forward to seeing you on campus.<br><br>
          Best regards,<br>
          Your Name';

      // Send email
      if (!$mail->send()) {
          echo 'Error sending email: ' . $mail->ErrorInfo;
      } else {
          echo 'Email sent successfully!';
      }
  } else {
      echo 'Invalid or expired OTP. Please try again.';
  }
}

// Close database connection
mysqli_close($conn);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $app_name; ?> - OTP verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Admin/dist/css/popup_style.css">

  <style>
    .otp-input {
      width: 60px;
      height: 60px;
      font-size: 24px;
      text-align: center;
      margin: 0 5px;
    }
  </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card p-4 shadow-lg" style="max-width: 700px; width: 100%; height:40% " >
    <h4 class="text-center mb-4">Enter OTP Code to complete your registration </h4>
    <form action="validate_otp.php" method="POST" id="otpForm">
      <div class="d-flex justify-content-center mb-3">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 0)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 1)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 2)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 3)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 4)">
      </div>
      <div class="d-grid">
          <button type="submit" name="btnverify" class="btn btn-primary">Verify</button>
        </div>
          </form>
  </div>

  <script>
    function moveToNext(input, index) {
      const inputs = document.querySelectorAll('.otp-input');
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    }
  </script>

</body>
</html>
