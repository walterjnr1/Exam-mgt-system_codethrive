<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}

if (isset($_POST['btnadd'])) {

  // Sanitize inputs
  $grade = mysqli_real_escape_string($conn, $_POST['cmdgrade']);
  $max_score = mysqli_real_escape_string($conn, $_POST['txtmax_score']);
  $min_score = mysqli_real_escape_string($conn, $_POST['txtmin_score']);
  $remark = mysqli_real_escape_string($conn, $_POST['cmdremark']);

  
  // Validate inputs
      $query = "SELECT * FROM grades WHERE school_id='$teacher' and max_score='$subject' and min_score='$class' or remark='$remark'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $_SESSION['error'] = "Grading system  already exists!";
      } else {

          $query = "INSERT INTO subject_teacher (school_id, min_score, max_score, grade, remark) VALUES ('$school_id', '$min_score', '$max_score', '$grade', '$remark')";
          $result = mysqli_query($conn, $query);

      if ($result) {
      $_SESSION['success']= "Grading system Saved successfully!";
    }else {
              $_SESSION['error'] = "Database Error: Could not saved Subject Allocation";
          }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Subject Allocation to teachers</title>
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
            <h1>Subject Allocation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subject Allocation</li>
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
                <h3 class="card-title">Subject Allocation</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-12">
            <div class="form-group">
           <label for="exampleInputEmail1">Teacher</label>
           <select name="cmdteacher" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT * FROM users where school_id='$school_id' and role='Teacher'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>              
      </div>
            
            </div>
             <div class="col-md-12">
            <div class="form-group">
           <label for="exampleInputEmail1">Subject</label>
           <select name="cmdsubject" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT * FROM subjects WHERE school_id = '$school_id'";
    $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>
                </div>
            
            </div>

             <div class="col-md-12">
            <div class="form-group">
           <label for="exampleInputEmail1">Class Name</label>
           <select name="cmdclass" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT MIN(id) as id, name FROM classes WHERE school_id = '$school_id' GROUP BY name ORDER BY name desc";

    $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>                
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
