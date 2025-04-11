
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
include('../inc/config.php'); 



if(isset($_POST["btnadd"]))
{

  //generate random 6 digit number
  $code = rand(100000, 999999);
    // Assuming the form data is stored in variables $school_name, $school_address, etc.
    $name = $_POST['txtname'];
    $address = $_POST['txtaddress'];
    $email = $_POST['txtemail'];

    // Check if email already exists
    $sql = "SELECT * FROM schools WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Email already exists. Please use a different email.';
    } else {
        // Create a SQL query to insert data into the schools table
        $sql = "INSERT INTO schools (name, address, email,code) VALUES ('$name', '$address', '$email','$code')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {

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
    $mail->setFrom('support@gradepulse.com', 'Grade Pulse'); // Use a valid email address
    $mail->addAddress($student_email); //Add a recipient

    $message = "
<html>
<head>
<title>School Registration notification | Grade Pulse</title>
</head>
<body>

<p><strong>Hello $name  ,</strong></p>

<p>Your school registration was successful.</p>

<p><strong>code : </strong> $code</p>

<p>Please keep the code safe as it will used to login to your account.</p>
<p>Regards,</p>
<p>Grade Pulse Team</p>
</body>
</html>
";

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'School Registration notification| Grade Pulse';
    $mail->Body = $message;
    $mail->send();

    //echo "Email sent successfully!";
} catch (Exception $e) {
    //echo 'Email could not be sent. Please try again later. ' . $e->getMessage();
    $_SESSION['error'] = 'Notification could not be sent. Please Contact Admin. ';

  }


            $_SESSION['success'] = 'School Data Saved Successfully';
        } else {
            $_SESSION['error'] = 'Problem Saving School Data';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

  <div class="container">
    <div class="form-container">
      <h2 class="form-title">School Registration</h2>
      <form  action="" method="POST" >
        <div class="mb-3">
          <label for="fullname" class="form-label">School Name</label>
          <input type="text" class="form-control" name="txtname" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" name="txtemail" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Address</label>
          <input type="text" class="form-control" name="txtadress"  required>
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male">
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female">
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>
        </div>

        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
