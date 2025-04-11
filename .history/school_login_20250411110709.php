
<?php 
//include('inc/config.php'); 
include('database/connect.php'); 
include('database/connect2.php'); 


if(isset($_POST["btnlogin"]))
{
    $code = rand(100000, 999999);
    $code = $_POST['txtcode'];
    $email = $_POST['txtemail'];

    // Check if email already exists
    $sql = "SELECT * FROM schools WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Email already exists. Please use a different email.';
    } else {
        // Create a SQL query to insert data into the schools table
        $sql = "INSERT INTO schools (name, address, email,code) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $address, $email, $code);

        if ($stmt->execute()) {
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
                $mail->addAddress($email); //Add a recipient

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
          <label for="phone" class="form-label">Address</label>
          <input type="text" class="form-control" name="txtaddress"  required>
        </div>
           
        <div class="d-grid">
          <button type="submit" name="btnsave" class="btn btn-primary">Register</button>
        </div>
      </form>
      <p>&nbsp;</p>
      <p>Already have account? <a href="school_login">login</a> </p>
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
