<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}
$student_id= $_GET['id'];
$stmt = $dbh->query("SELECT students.*, classes.name AS class FROM students INNER JOIN classes ON students.class_id=classes.id WHERE students.id='$student_id$' and students.school_id='$school_id'");
$row_student = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> |Complete Student data</title>
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
            <h1>Student Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Data</li>
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
                <h3 class="card-title">Complete Student Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-6">
            <div class="form-group">
           <label for="">Student Name :<strong> <?php echo $row_student['fullname']  ?></strong></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Admission ID: <?php echo $row_student['admission_no']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Class: <?php echo $row_student['class']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Sex: <?php echo $row_student['sex']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Date of Birth: <?php echo $row_student['dob']  ?></label>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Boarding Status: <?php echo $row_student['day_boarding']  ?></label>
              </div>
              <div class="form-group">
           <label for="exampleInputEmail1">House Name: <?php echo $row_student['house']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Parent Email: <?php echo $row_student['parent_email']  ?></label>
            </div>
            </div>
            <div class="col-md-6">
            
            
            <div class="form-group">
           <label for="exampleInputEmail1">Parent Phone: <?php echo $row_student['parent_phone']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Address: <?php echo $row_student['address']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">District: <?php echo $row_student['day_boarding']  ?></label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Region:</label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Photo</label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Previous School:</label>
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Status</label>
            </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" name="btnview" class="btn btn-primary">Print</button>
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
