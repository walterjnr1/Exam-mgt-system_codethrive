<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../user_login");

}

if (isset($_POST['btnadd'])) {
  // Sanitize inputs
  $name = mysqli_real_escape_string($conn, $_POST['txtname']);
  $section = mysqli_real_escape_string($conn, $_POST['cmdsection']);

  // Validate inputs
  
      $query = "SELECT * FROM classes WHERE name = '$name' and section='$section'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $_SESSION['error'] = "Class already exists!";
      } else {

          $query = "INSERT INTO classes (school_id, name, section) VALUES ('$school_id', '$name', '$section')";
          $result = mysqli_query($conn, $query);

          if ($result) {
          
      $_SESSION['success']= "$name$section created successfully!";
    }else {
              $_SESSION['error'] = "Database error: Could not create class.";
          }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Add Academic Session</title>
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
            <h1>New Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Session</li>
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
                <h3 class="card-title">New Session</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Academic Year</label>
               <input type="text" name="txtyear" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtyear'] ?? ''; ?>">
            
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Term</label>
           <select id="cmdterm" name="cmdterm" class="form-control">
                        <option value="">--- Select Term --- </option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        
                    </select>               
            
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Start date</label>
               <input type="date" name="txtstart" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtstart'] ?? ''; ?>">
                </div>
            
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">End Date</label>
               <input type="date" name="txtend" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtend'] ?? ''; ?>">
                </div>
            
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
