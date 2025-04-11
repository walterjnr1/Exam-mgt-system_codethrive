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
<title>School Registration notification | Authur Javis University</title>
</head>
<body>

<p><strong>Hello $student_name,</strong></p>

<p>Your Reqest has been created submited successfully.</p>

<p><strong>Request ID : </strong> $request_id</p>
<p><strong>Status : </strong> $Approved</p>
<p><strong>Track Number : </strong> $track_number</p>


<p>Regards,</p>
<p>Authur Javis University Team</p>
</body>
</html>
";

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Request Submission notification| Authur Javis University';
    $mail->Body = $message;
    $mail->send();

    //echo "Email sent successfully!";
} catch (Exception $e) {
    //echo 'Email could not be sent. Please try again later. ' . $e->getMessage();
    $_SESSION['error'] = 'Email could not be sent. Please try again later. ';

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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> |Add School </title>
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
            <h1>Add School</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add School</li>
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
                <h3 class="card-title">Add School</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form  action="" method="POST" >
            <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">School Name</label>
            <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['txtname']) ? $_POST['txtname'] : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="txtemail" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['txtemail']) ? $_POST['txtemail'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" name="txtaddress" class="form-control" id="exampleInputPassword1" value="<?php echo isset($_POST['txtaddress']) ? $_POST['txtaddress'] : ''; ?>">
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
             </div>

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
