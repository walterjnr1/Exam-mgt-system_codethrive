<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../user_login");

}
  $id= $_GET['id'];
  $stmt = $dbh->query("SELECT s.id as sid,  st.id as st_id, u.name AS teacher,u.id AS uid, s.name AS subject, c.name AS class,c.id AS cid FROM subject_teacher st JOIN users u ON st.user_id = u.id JOIN subjects s ON st.subject_id = s.id
  JOIN classes c ON st.class_id = c.id where st.id='$id'");
  $row_allocation = $stmt->fetch();

  if (isset($_POST['btnedit'])) {
  // Sanitize inputs
  $subject = mysqli_real_escape_string($conn, $_POST['cmdsubject']);
  $class = mysqli_real_escape_string($conn, $_POST['cmdclass']);
  $teacher = mysqli_real_escape_string($conn, $_POST['cmdteacher']);

      
    $sql = "UPDATE subject_teacher SET user_id=?,subject_id=? , class_id=?  where id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$teacher,$subject,$class,$id]);
    if($stmt) {
      //redirect and refresh to another page after 3 seconds
      header("Refresh: 2; URL=subject_allocation_record");
          $_SESSION['success']= "Subject Allocation Updated successfully!";
          } else {
          $_SESSION['error'] = "Database error: Could not Update Subject Allocation.";
          }
      }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Edit Subject Allocation</title>
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
            <h1>Edit Subject Allocation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Subject Allocation</li>
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
                <h3 class="card-title">Edit Subject Allocation</h3>
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
    echo '<option value="' . $row_allocation['uid'] . '">' . $row_allocation['uid'] . '</option>';
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>     
    </div>  

    <div class="form-group">
      <label for="exampleInputEmail1">Subject</label>
      <select name="cmdsubject" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT * FROM subjects where school_id='$school_id'";
    $result = mysqli_query($conn, $query);
    echo '<option value="' . $row_allocation['sid'] . '">' . $row_allocation['sid'] . '</option>';
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>     
    </div>  


    <div class="form-group">
      <label for="exampleInputEmail1">Class</label>
      <select name="cmdclasss" class="form-control" id="exampleInputEmail1" required>
       <?php 
    // Assuming you have a database connection established
    $query = "SELECT MIN(id) as id, name FROM classes WHERE school_id = '$school_id' GROUP BY name ORDER BY name desc";
    $result = mysqli_query($conn, $query);
    echo '<option value="' . $row_allocation['cid'] . '">' . $row_allocation['cid'] . '</option>';
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    ?>
     </select>     
    </div>  

    </div>
     
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" name="btnedit" class="btn btn-primary">Save Changes</button>
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
