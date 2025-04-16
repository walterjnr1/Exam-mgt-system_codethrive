<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include('config.php'); 


if(isset($_POST["btnsave"]))
{
    $admission_no = rand(100000, 999999);
   
    $school_id = $_POST['cmdschool'];
    $name = $_POST['txtname'];
    $sex = $_POST['cmdsex'];
    $dob = $_POST['txtdob'];
    $password = $_POST['txtpassword'];
    $phone = $_POST['txtphone'];
    $email = $_POST['txtemail'];
    $previous_school = $_POST['txtprevious_school'];

    // Check if email already exists
    $sql = "SELECT * FROM students WHERE parent_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Email already exists. Please use a different email.';
    } else {
        // Create a SQL query to insert data into the schools table
        $sql = "INSERT INTO students (school_id, admission_no, fullname, sex,dob,password,parent_email,parent_phone,previous_school) VALUES (?, ?,?,?,?,?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $school_id, $admission_no, $name, $sex,$dob,$password,$email,$phone,$previous_school);

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
                $mail->setFrom("$app_email","$app_name"); // Use a valid email address
                $mail->addAddress($email); //Add a recipient

                $message = "
<html>
<head>
<title>Student Registration | $app_name</title>
</head>
<body>

<p>Dear <strong> $name ,</strong></p>

<p>We are pleased to inform you that your registration has been successfully received..</p>

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
        $_SESSION['success'] = 'Student Data Saved Successfully';
        } else {
            $_SESSION['error'] = 'Problem Saving Student Data';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="../uploadImage/Logo/gradeplus.jpeg">
    <link rel="stylesheet" href="../Admin/dist/css/popup_style.css">

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
<div align="center">
  <p>&nbsp;</p>
  <p><img src="../uploadImage/Logo/gradeplus.jpeg" alt="gradepulse" width="186" height="95"></p>
</div>
<div class="container">
    <div class="form-container">
      <h4 class="form-title">Student Registration</h4>
      <form  action="" method="POST" >
      <div class="mb-3">
          <label for="password" class="form-label">School</label>
          <select name="cmdschool" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT * FROM schools ORDER BY name desc";
    echo '<option value=""> select school </option>';

    $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>            
    </div>
        <div class="mb-3">
          <label for="fullname" class="form-label">fullName</label>
          <input type="text" class="form-control" name="txtname" value="<?php echo $_POST['txtname'] ?? ''; ?>" required>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Sex</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="cmdsex" id="male" value="male">
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="cmdsex" id="female" value="female">
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" name="txtdob"  required>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Password</label>
          <input type="password" class="form-control" name="txtpassword"  value="<?php echo $_POST['txtpassword'] ?? ''; ?>"required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Class</label>
          <select name="cmdclass" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT * FROM classes where school_id='$_POST['cmdschool']' ORDER BY name desc";
    echo '<option value=""> select class </option>';

    $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>            
    </div>
          <div class="mb-3">
          <label for="email" class="form-label">Parent Email Address</label>
          <input type="email" class="form-control" name="txtemail" value="<?php echo $_POST['txtemail'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Parent Phone</label>
          <input type="tel" class="form-control" name="txtphone" value="<?php echo $_POST['txtphone'] ?? ''; ?>"required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Previous School</label>
          <input type="text" class="form-control" name="txtprevious_school" value="<?php echo $_POST['txtprevious_school'] ?? ''; ?>" required>
        </div>
        <div class="d-grid">
          <button type="submit" name="btnsave" class="btn btn-primary">Register</button>
        </div>
      </form>
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
    </script></body>
</html>
