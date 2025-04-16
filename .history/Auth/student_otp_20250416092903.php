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


    //delete otp from otps table
    $delete_otp_query = "DELETE FROM otps WHERE email = '$email'";
    
    //how to update database in students table
    


       


      $admission_no = $_SESSION['admission_no'];
      $name = $_SESSION['name'];

      // Create a new PHPMailer instance
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
<title>Student Registration | $app_name</title>
</head>
<body>

<p>Dear <strong> $name ,</strong></p>

<p>We are pleased to inform you that your registration has been completed.</p>

<p><strong>Registration Details:</strong></p>

<p>Name: <strong>$name</strong></p>

<p>Email: <strong>$email</strong></p>

<p>Student ID: <strong>$admission_no</strong></p>

<p>Class: <strong>N/A</strong></p>

<p>House: <strong>N/A</strong></p>

<p>Kindly ensure that all required documents are submitted to the registration office. If you have not yet completed this process, please do so at your earliest convenience.</p>

<p>For any inquiries or assistance regarding your registration, feel free to contact us at $app_name.

We look forward to having you as part of our academic community.</p>

<p>Warm regards,</p>
<p>$app_name Team</p>
</body>
</html>
";

  //Content
  $mail->isHTML(true); //Set email format to HTML
  $mail->Subject = "Student Registration | $app_name";
  $mail->Body = $message;
  $mail->send();

  } catch (Exception $e) {
  $_SESSION['error'] = "Notification could not be sent. Please Contact Admin via $app_name ";

  }
  $_SESSION['success'] = 'Student Registration was Successfully';

  } else {
    $_SESSION['error'] ='Invalid or expired OTP. Please try again.';
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

