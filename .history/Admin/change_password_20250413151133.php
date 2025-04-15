<?php 
include('../inc/config.php'); 
if (empty($_SESSION['user_id'])) {
  header("Location: ../user_login");
}

if(isset($_POST["btnchange"]))
{



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Change Password</title>
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
            <h1>School settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="text" name="txtoldpassword" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtpassword'] ?? ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="text" name="txtnewpassword" class="form-control" id="exampleInputPassword1" value="<?php echo $_POST['txtpassword'] ?? ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="email" name="txtconfirmpassword" class="form-control" id="exampleInputEmail1" value="">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">phone 1</label>
                    <input type="tel" name="txtphone1" class="form-control" id="exampleInputEmail1" value="<?php echo $row_school['phone1'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">phone 2</label>
                    <input type="tel" name="txtphone2" class="form-control" id="exampleInputPassword1" value="<?php echo $row_school['phone2'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">P.O.Box</label>
                    <input type="number" name="txtpobox" class="form-control" id="exampleInputEmail1" value="<?php echo $row_school['box'];?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Region</label>
                    <select id="region"  name="region"class="form-control" onchange="populateDistricts()">
                    <option value="<?php echo $row_school['region']  ?>" ><?php echo $row_school['region']  ?></option>
                    <option value="" >-- Select Region --</option>

                </select>     
                     </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">District</label>
                    <select id="district" name="district" class="form-control">
                    <option value="<?php echo $row_school['district']  ?>" ><?php echo $row_school['district']  ?></option>
                    <option value="">-- Select District --</option>
                    </select> 
                   </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">GPS Address</label>
                    <input type="text" name="txtgpsaddress" class="form-control" id="exampleInputEmail1" value="<?php echo $row_school['gpsaddress'];?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btncontact" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
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
