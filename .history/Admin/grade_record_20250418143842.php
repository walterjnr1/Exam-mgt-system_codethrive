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
		function deldata(){
if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS GRADE FROM THE LIST?"))
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
              <li class="breadcrumb-item active">Grade Record</li>
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
                  <h5>This Table contains data about Grade</h5>
                  <a href="add_grade"><button type="submit" name="btnadd" class="btn btn-primary">New Grade</button></a>

                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table width="626" height="98" class="table table-bordered table-striped" id="example1">
                  <thead>
                  <tr>
                    <th width="19">s/n</th>
                    <th width="53">Grade</th>
                    <th width="73">Remark</th>
                    <th width="81">Min Score</th>
                    <th width="25">Max Score</th>
                    <th width="150">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php 
$data = $dbh->query("SELECT * FROM grades WHERE school_id='$school_id'")->fetchAll();
$cnt = 1;
foreach ($data as $row) {
?>
  <tr>

    <td height="52"><?php echo $cnt; ?></td>
    <td><?php echo htmlspecialchars($row['grade']); ?></td>
    <td><?php echo htmlspecialchars($row['remarks']); ?></td>
    <td><?php echo htmlspecialchars($row['min_score']); ?></td>
    <td><?php echo htmlspecialchars($row['max_score']); ?></td>
        <td>
         <a href="delete_hg.php?id=<?php echo $row['id'];?>" onClick="return deldata('<?php echo $row['fullname']; ?>');">
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
