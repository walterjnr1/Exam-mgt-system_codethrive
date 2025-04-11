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
    $_SESSION['success']='Logo Saved Successfully';
   }else{
      $_SESSION['error']='Problem Saving Logo';
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
            <div class="card card-primary">
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
                    <img src="../<?php echo $school_photo; ?>" alt="school photo" id="logo-img" width="100" height="80" style="display: none;">
                    </p>
                   </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnlogo" class="btn btn-primary">Save Changes</button>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Contact details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">School Name</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">phone 1</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">phone 2</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">P.O.Box</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Region</label>
                    <select id="cmdregion" class="form-control" >
                    <option value="">-- Select Region --</option>
  <option value="ashanti">Ashanti</option>
  <option value="brong-ahafo">Brong Ahafo</option>
  <option value="central">Central</option>
  <option value="eastern">Eastern</option>
  <option value="greater-accra">Greater Accra</option>
  <option value="northern">Northern</option>
  <option value="upper-east">Upper East</option>
  <option value="upper-west">Upper West</option>
  <option value="volta">Volta</option>
  <option value="western">Western</option>
  <option value="western-north">Western North</option>
  <option value="savannah">Savannah</option>
  <option value="north-east">North East</option>
  <option value="oti">Oti</option>
  <option value="bono-east">Bono East</option>
  <option value="ahafo">Ahafo</option>
  <option value="bono">Bono</option>
                  </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">District</label>
                    <select name="district" id="district">
  <option value="">-- Select District --</option>

  <optgroup label="Greater Accra Region">
    <option value="Accra Metropolitan">Accra Metropolitan</option>
    <option value="Tema Metropolitan">Tema Metropolitan</option>
    <option value="Ga East">Ga East</option>
    <option value="Ga South">Ga South</option>
    <option value="Ga West">Ga West</option>
    <option value="La Dade Kotopon">La Dade Kotopon</option>
    <!-- Add others here -->
  </optgroup>

  <optgroup label="Ashanti Region">
    <option value="Kumasi Metropolitan">Kumasi Metropolitan</option>
    <option value="Asokore Mampong">Asokore Mampong</option>
    <option value="Ejisu">Ejisu</option>
    <option value="Atwima Nwabiagya">Atwima Nwabiagya</option>
    <option value="Kwabre East">Kwabre East</option>
    <!-- Add others here -->
  </optgroup>

  <optgroup label="Eastern Region">
    <option value="New Juaben South">New Juaben South</option>
    <option value="Abuakwa South">Abuakwa South</option>
    <option value="Akuapim North">Akuapim North</option>
    <!-- Add others here -->
  </optgroup>

  <optgroup label="Northern Region">
    <option value="Tamale Metropolitan">Tamale Metropolitan</option>
    <option value="Sagnarigu">Sagnarigu</option>
    <!-- Add others here -->
  </optgroup>

  <optgroup label="Western Region">
    <option value="Sekondi-Takoradi">Sekondi-Takoradi</option>
    <option value="Tarkwa-Nsuaem">Tarkwa-Nsuaem</option>
    <!-- Add others here -->
  </optgroup>

  <!-- Continue for other regions: Volta, Central, Upper East, Upper West, Bono, Bono East, Oti, Savannah, North East, Ahafo, Western North -->

</select>

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
                  <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">School settings</h3>
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
                  <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">School settings</h3>
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
                  <button type="submit" class="btn btn-primary">Save Changes</button>
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
