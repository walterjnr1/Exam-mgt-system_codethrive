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
  <title><?php echo $app_name; ?> | Grade Record</title>
  <?php include('partials/head.php') ;?>
  <script type="text/javascript">
		function deldata(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS GRADE FROM THE LIST?"))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function enable(fullname){
if(confirm("ARE YOU SURE YOU WISH TO ENABLE " + " " + fullname+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
<script type="text/javascript">
		function disable(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DISABLE " + " " + fullname+ " " + " ?"))
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
                <table width="626" height="98" class="table table-bordered table-striped" id="example1">
                  <thead>
                  <tr>
                    <th width="19">s/n</th>
                    <th width="53">Photo</th>
                    <th width="73">Admission No</th>
                    <th width="81">FullName</th>
                    <th width="25">Sex</th>
                    <th width="35">DOB</th>
                    <th width="37">Class</th>
                    <th width="48">Address</th>
                    <th width="48">Region</th>
                    <th width="61">Status</th>
                    <th width="150">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php 
$data = $dbh->query("SELECT students.*, classes.section As section,classes.name AS class FROM students INNER JOIN classes ON students.class_id=classes.id WHERE students.school_id='$school_id'")->fetchAll();
$cnt = 1;
foreach ($data as $row) {
?>
  <tr>

    <td height="52"><?php echo $cnt; ?></td>
    <td>
      <img src="../<?php echo (!empty($row['photo'])) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'; ?>" width="50" height="50" style="object-fit:cover; border-radius:50%;" />
    </td>
    <td><?php echo htmlspecialchars($row['admission_no']); ?></td>
    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
    <td><?php echo htmlspecialchars($row['sex']); ?></td>
    <td><?php echo htmlspecialchars($row['dob']); ?></td>
    <td><?php echo htmlspecialchars($row['class']); ?><?php echo htmlspecialchars($row['section']); ?></td>
    <td><?php echo htmlspecialchars($row['address']); ?></td>
    <td><?php echo htmlspecialchars($row['region']); ?></td>

    <td>
      <?php if ($row['status'] == 1) { ?>
        <span style="color: green;"><strong>Active</strong></span>
      <?php } else { ?>
        <span style="color: red;"><strong>Inactive</strong></span>
      <?php } ?>       
      </td>
       <td>
        <?php if ($row['status'] == 0) { ?>
        <a href="enable_disable_student.php?eid=<?php echo $row['id'];?>" onClick="return enable('<?php echo $row['fullname']; ?>');">
          <i class="fa fa-check" aria-hidden="true" title="Enable Student"></i>
        </a>
         <?php } else { ?>
        <a href="enable_disable_student.php?did=<?php echo $row['id'];?>" onClick="return disable('<?php echo $row['fullname']; ?>');">
          <i class="fa fa-times" aria-hidden="true" title="Disable Student"></i>
        </a>
          <?php } ?>
         <a href="delete_student.php?id=<?php echo $row['id'];?>" onClick="return deldata('<?php echo $row['fullname']; ?>');">
        <i class="fa fa-trash" aria-hidden="true" title="Delete Student Record"></i>
          </a>
          <a href="view_student.php?id=<?php echo $row['id'];?>">
        <i class="fa fa-eye" aria-hidden="true" title="View All Student Record"></i>
          </a>
          
      

        </td>
        </tr>
          <?php $cnt++; } ?>

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
