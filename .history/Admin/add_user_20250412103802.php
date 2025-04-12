<?php 
include('../inc/config.php'); 


if(isset($_POST["btnlogo"]))
{

$image= addslashes(file_get_contents($_FILES['imageInput']['tmp_name']));
$image_name= addslashes($_FILES['imageInput']['name']);
$image_size= getimagesize($_FILES['imageInput']['tmp_name']);
move_uploaded_file($_FILES["imageInput"]["tmp_name"],"../uploadImage/Logo/" . $_FILES["imageInput"]["name"]);			
$logo_path="uploadImage/Logo/" . $_FILES["imageInput"]["name"];
			
$sql = " update schools set logo='$logo_path' where id='$school_id'";
   if (mysqli_query($conn, $sql)) {
    header( "refresh:2;url= update_school" );

    $_SESSION['success']='Logo Saved Successfully';
   }else{
      $_SESSION['error']='Problem Saving Logo';
}
}else if(isset($_POST["btncontact"])) {
  $school_name = $_POST['txtname'];
  $school_address = $_POST['txtaddress'];
  $school_email = $_POST['txtemail'];
  $school_phone1 = $_POST['txtphone1'];
  $school_phone2 = $_POST['txtphone2'];
  $school_pobox = $_POST['txtpobox'];
  $school_region = $_POST['region'];
  $school_district = $_POST['district'];
  $school_gpsaddress = $_POST['txtgpsaddress'];

  $sql = "UPDATE schools SET name = :name, address = :address, email = :email, phone1 = :phone1, phone2 = :phone2, box = :box, region = :region, district = :district, gpsaddress = :gpsaddress WHERE id = :id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':name', $school_name);
  $stmt->bindParam(':address', $school_address);
  $stmt->bindParam(':email', $school_email);
  $stmt->bindParam(':phone1', $school_phone1);
  $stmt->bindParam(':phone2', $school_phone2);
  $stmt->bindParam(':box', $school_pobox);
  $stmt->bindParam(':region', $school_region);
  $stmt->bindParam(':district', $school_district);
  $stmt->bindParam(':gpsaddress', $school_gpsaddress);
  $stmt->bindParam(':id', $school_id);

  if ($stmt->execute()) {
    //header("Location: update");
    $_SESSION['success']='School Contact details Saved Successfully';
  } else {
    $_SESSION['error']='Problem Saving School Contact details';
  }

  $stmt->closeCursor();
}if(isset($_POST["btnheadmaster"]))
{
  $name = $_POST['txtname'];

$image= addslashes(file_get_contents($_FILES['signatureInput']['tmp_name']));
$image_name= addslashes($_FILES['signatureInput']['name']);
$image_size= getimagesize($_FILES['signatureInput']['tmp_name']);
move_uploaded_file($_FILES["signatureInput"]["tmp_name"],"../uploadImage/Signature/" . $_FILES["signatureInput"]["name"]);			
$Signature_path="uploadImage/Signature/" . $_FILES["signatureInput"]["name"];
			
$sql = " update schools set headmaster_name= '$name', headmaster_signature ='$Signature_path' where id='$school_id'";
   if (mysqli_query($conn, $sql)) {
    $_SESSION['success']='Signature Saved Successfully';
   }else{
    $_SESSION['error']='Problem Saving Signature';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | School setting</title>
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
            <h1>New User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New User</li>
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
                <h3 class="card-title">New User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form  action="" method="POST">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['txtname']) ? $_POST['txtname'] : $row_school['name']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="txtpassword" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['txtpassword']) ? $_POST['txtpassword'] : $row_school['email']; ?>">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Role</label>
                      <select id="cmdrole"  name="cmdrole"class="form-control" >
                    <option value="" >-- Select Role --</option>
                    <option value="Admin" <?php echo isset($_POST['cmdrole']) && $_POST['cmdrole'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Teacher" <?php echo isset($_POST['cmdrole']) && $_POST['cmdrole'] == 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                    </select>            
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Phone</label>
                        <input type="tel" name="txtphone" class="form-control" id="exampleInputPassword1" value="<?php echo isset($_POST['txtphone']) ? $_POST['txtphone'] : $row_school['address']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="txtemail" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['txtemail']) ? $_POST['txtemail'] : $row_school['email']; ?>">
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnlogo" class="btn btn-primary">Save</button>
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
