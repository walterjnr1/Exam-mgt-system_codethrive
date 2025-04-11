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
            <h1>School settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">School settings</li>
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
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Upload School Logo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" enctype="multipart/form-data">
                
                <div class="card-body">
                  <div class="form-group">
                    <p>
                      <input id="imageInput" name="imageInput" type="file" class="form-control" onChange="display_img(this)" required/>
                    </p>
                    <p align="center">&nbsp;</p>
                    <p align="center">
                    <img src="../<?php echo $row_school['logo']; ?>" alt="school logo" id="logo-img" width="100" height="80" style="display: none;">
                    </p>
                   </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnlogo" class="btn btn-success">Save Changes</button>
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


        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <h3 class="card-title">Contact details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">School Name</label>
                    <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo $row_school['name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" name="txtaddress" class="form-control" id="exampleInputPassword1" value="<?php echo $row_school['address'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="txtemail" class="form-control" id="exampleInputEmail1" value="<?php echo $row_school['email'];?>">
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
                  <button type="submit" name="btncontact" class="btn btn-danger">Save Changes</button>
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

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Head</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary">Save Changes</button>
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
