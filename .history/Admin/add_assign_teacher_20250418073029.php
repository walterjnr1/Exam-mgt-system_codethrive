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
  <title><?php echo $app_name; ?> | Assign Class Teacher</title>
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
              <li class="breadcrumb-item active">Assign Class Teacher</li>
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
                  <h5>This Table contains data about Class Teachers</h5>
                
                  <button type="button" name="btnassign" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#assignTeacherModalTop">
                    Assign Class Teacher</button>
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
        $data = $dbh->query("SELECT ct.id, c.name AS class_name, c.section, t.name AS teacher_name, 
        s.session_name, tr.term_name, ct.assigned_date FROM class_teachers ct  JOIN classes c ON ct.class_id = c.id
        JOIN teachers t ON ct.teacher_id = t.id JOIN sessions s ON ct.session_id = s.id
        JOIN terms tr ON ct.term_id = tr.id where school_idORDER BY ct.assigned_date DESC")->fetchAll();
        $cnt = 1;
        foreach ($data as $row) {
        ?>
         <tr>
    <td height="52"><?php echo $cnt; ?></td>
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
          $userList = $dbh->query("SELECT * FROM users WHERE role='Teacher' AND school_id='$school_id'")->fetchAll();               
          foreach ($userList as $user) {
          echo "<option value='".$user['id']."'>".$user['name']."</option>";
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
          <button type="submit" name="assign_teacher_btn" class="btn btn-primary">Assign Teacher</button>
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
