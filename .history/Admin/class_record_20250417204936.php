<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

// Handle class assignment form submit
if (isset($_POST['assign_teacher_btn'])) {
  $user_id = $_POST['user_id'];
  $class_id = $_POST['class_id'];

  $sql = "UPDATE classes SET user_id='$user_id' WHERE id='$class_id'";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['success']='Class Teacher Assigned succesfully';
  } else {
    $_SESSION['error']='Failed to assign class Teacher';
  }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Class Record</title>
  <?php include('partials/head.php') ;?>
  <script type="text/javascript">
		function deldata(name){
if(confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + name+ " " + " FROM THE LIST?"))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function enable(name){
if(confirm("ARE YOU SURE YOU WISH TO ENABLE " + " " + name+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
<script type="text/javascript">
		function disable(name){
if(confirm("ARE YOU SURE YOU WISH TO DISABLE " + " " + name+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function Assign(name){
if(confirm("ARE YOU SURE YOU WISH TO ASSIGN SUPERVISOR TO " + " " + name+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
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
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Class Record</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
<div class="card">
              <div class="card-header">
                <div>
                  <h5>This Table contains data about Class</h5>
                  <h6 class="style1">Make you assign teacher to class first 
                 
                  <button type="button" name="btnassign" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#assignTeacherModalTop">
                    Assign Class </button>
                
                  </h6>

                  <a href="add_class"><button type="submit" name="btnadd" class="btn btn-primary">New Class</button></a>

                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table width="626" height="98" class="table table-bordered table-striped" id="example1">
                  <thead>
                  <tr>
                    <th width="19">s/n</th>
                    <th width="81">Class</th>
                    <th width="25">Section</th>
                    <th width="35">Class Teacher</th>
                  <th width="150">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php 
        $data = $dbh->query("SELECT classes.*, users.name As teahcer, FROM classes INNER JOIN users ON classes.user_id=users.id WHERE classes.school_id='$school_id'")->fetchAll();
        $cnt = 1;
        foreach ($data as $row) {
        ?>
         <tr>


  <div class="modal fade" id="assignTeacherModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="assignTeacherLabel<?php echo $row['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignTeacherLabel<?php echo $row['id']; ?>">Assign Teacher to <?php echo htmlspecialchars($row['name']); ?><?php echo htmlspecialchars($row['section']); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>">
          <div class="mb-3">
            <label for="user_id" class="form-label">Select Teacher</label>
            <select name="user_id" class="form-control" required>
              <option value="">-- Select Teacher --</option>
              <?php 
              $classList = $dbh->query("SELECT * FROM users WHERE role='Teacher' and school_id = '$school_id' ORDER BY name desc")->fetchAll();
              foreach ($classList as $class) {
                echo "<option value='".$class['id']."'>".$class['name']."</option>";
               }
              ?>
            </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" name="assign_teacher_btn" class="btn btn-primary">Assign Teacher</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

    <td height="52"><?php echo $cnt; ?></td>
    <td>
      <img src="../<?php echo (!empty($row['photo'])) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'; ?>" width="50" height="50" style="object-fit:cover; border-radius:50%;" />
    </td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['section']); ?></td>
    <td><?php echo htmlspecialchars($row['teacher']); ?></td>
         <td>
           <a href="delete_class.php?id=<?php echo $row['id'];?>" onClick="return deldata();">
      <i class="fa fa-trash" aria-hidden="true" title="Delete Class Record"></i>
      </a>  
  <a href="edit_class?id=<?php echo $row['id'];?>"><i class="fa fa-edit" aria-hidden="true" title="Edit Record"></i>
  </a>
  <a href="#" data-bs-toggle="modal" data-bs-target="#assignTeacherModal<?php echo $row['id']; ?>">
          <i class="fa fa-chalkboard-teacher" aria-hidden="true" title="Assign Class"></i>
          </a>
     </td>
        </tr>
          <?php $cnt++; } ?>

                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>



              <div class="modal fade" id="assignTeacherModalTop" tabindex="-1" aria-labelledby="assignClassModalTopLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignTeacherModalTopLabel">Assign Teacher to Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="user_id" class="form-label">Select Teacher</label>
            <select name="user_id" class="form-control" required>
              <option value="">-- Select Teacher --</option>
              <?php 
          $userList = $dbh->query("SELECT * FROM users WHERE school_id='$school_id' AND class_id IS NULL")->fetchAll();               
          foreach ($studentList as $student) {
          echo "<option value='".$student['id']."'>".$student['fullname']."</option>";
          }
          ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="class_id" class="form-label">Select Class</label>
            <select name="class_id" class="form-control" required>
              <option value="">-- Select Class --</option>
              <?php 
              $classList = $dbh->query("SELECT * FROM classes WHERE school_id='$school_id'")->fetchAll();
              foreach ($classList as $class) {
                echo "<option value='".$class['id']."'>".$class['name']."".$class['section']."</option>";
              }
              ?>
            </select>
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="submit" name="assign_class_btn" class="btn btn-primary">Assign Class</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>




              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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

<!-- jQuery -->
<?php include('partials/bottom-script.php') ;?>

</body>
</html>
