<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Student Record</title>
  <?php include('partials/head.php') ;?>
  <script type="text/javascript">
		function deldata(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + fullname+ " " + " FROM THE LIST?"))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function Activate(fullname){
if(confirm("ARE YOU SURE YOU WISH TO ACTIVATE " + " " + fullname+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
<script type="text/javascript">
		function deactivate(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DEACTIVATE " + " " + fullname+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function Assign(fullname){
if(confirm("ARE YOU SURE YOU WISH TO ASSIGN SUPERVISOR TO " + " " + fullname+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
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
              <li class="breadcrumb-item active">Student Record</li>
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
                  <h5>This Table contains data about Student</h5>
                  <a href="add_student"><button type="submit" name="btnadd" class="btn btn-primary">New Student</button></a>

                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>s/n</th>
                    <th>Photo</th>
                    <th>Admission No</th>
                    <th>FullName</th>
                    <th>Sex</th>
                    <th>DOB</th>
                    <th>Class</th>
                    <th>Parent Email</th>
                    <th>Parent Phone</th>
                    <th>Address</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Previous School</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 $data = $dbh->query("SELECT students.*,classes.name as class FROM students INNER JOIN classes ON students.class_id=classes.id where school_id='$school_id'")->fetchAll();
                 $cnt=1;
                  foreach ($data as $row) {
                 ?>
                  <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['section'] ?></td>

                    <td>
      <a href="delete_class.php?id=<?php echo $row['id'];?>" onClick="return deldata();">
      <i class="fa fa-trash" aria-hidden="true" title="Delete Record"></i>
      </a>  
  <a href="edit_class?id=<?php echo $row['id'];?>"><i class="fa fa-edit" aria-hidden="true" title="Edit Record"></i>
  </a>
     </td>
                  </tr>
                  <?php $cnt=$cnt+1;} ?>

                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
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
