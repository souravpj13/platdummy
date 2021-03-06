<?php
include("../api/include/dbConnect.php");
$dbConn = new DB_Connect();
$conn = $dbConn->connect();

if( isset( $_POST['add'] ) ){
    
    if( !$_POST['name'] ){
        $nameError = "Please enter your name";   
        }
    else{
        $formName = $_POST['name'];
    }
    
    if( !$_POST['email'] ){
        $emailError = "Please enter your email";   
    }
    else{
        $formEmail = $_POST['email'];
    }
    
    if( !$_POST['contact'] ){
        $contactError = "Please enter your contact";   
}
    else{
        $formContact = $_POST['contact'];
    }
    if( !$_POST['area'] ){
        $areaError = "Please enter your area";   
}
    else{
        $formArea = $_POST['area'];
    }
    if( !$_POST['lots'] ){
        $lotsError = "Please enter number of lots";   
}
    else{
        $formLots = $_POST['lots'];
    }
    if( !$_POST['fileToUpload'] ){
        $imageError = "Please select the image";   
    }
    else{
        $formImage = $_POST['fileToUpload'];
    }
    
    $emailQuery = "SELECT email FROM builders_info WHERE email = '$formEmail'";
    $emailResult = mysqli_query($conn, $emailQuery);
    if( mysqli_num_rows( $emailResult ) == 0 ){
    
    if( $formName && $formEmail && $formContact && $formLots && $formImage && $formArea ){
        $addBuilderQuery = "INSERT INTO builders_info (builder_id, builder_name, email, status, updated_at, created_at, contact) 
                    VALUES (NULL,'$formName', '$formEmail', 'active', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '$formContact' ) ";
        $addAreaQuery = "INSERT INTO areas_info ( area_id, builder_id, area_name, lots, primary_image, images, status, updated_at, created_at ) VALUES ( NULL, LAST_INSERT_ID() , '$formArea', '$formLots', '$formImage', '', 'active', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP() )";
        if( mysqli_query($conn, $addBuilderQuery) && mysqli_query($conn, $addAreaQuery) ){
                 echo "<div class='alert alert-success'>Successfully Changed</div>";
        }      
    else{
        echo "<div class='alert alert-danger'>Please check your internet connection or try again later.</div>";
        }
    
        }
    }
    
    else{
                echo "<div class='alert alert-danger'>User already exist.</div>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add New</title>
        
        <!--        Bootstrap-->
       <link rel="stylesheet" href="../AdminLTE-3.0.1/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE-3.0.1/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="../logout.php"><i
            class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Plat Dummy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="../admin-panel.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Builders 
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="area.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Areas 
              </p>
            </a>
          </li>
            
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Builder</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Builders</a></li>
              <li class="breadcrumb-item active">Add New</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
            <form role="form" method="post" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input style="text-transform:capitalize;" type="text" class="form-control" id="name" placeholder="Enter name" value="<?php echo $builderName; ?>" name="name">
                      <small><?php echo $nameError;?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $builderEmail; ?>" name="email">
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" placeholder="Enter contact number" value="<?php echo $builderContact; ?>" name="contact">
                  </div>
                  <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" id="area" placeholder="Enter area" value="<?php echo $builderArea; ?>" name="area">
                  </div>
                    <div class="form-group">
                    <label for="lots">Total Lots in Area</label>
                    <input type="text" class="form-control" id="lots" placeholder="Enter number of lots" value="<?php echo $builderLots; ?>" name="lots">
                  </div>
                    
                  <div class="form-group">
                    <label>Primary Image</label>
                    <div class="margin-bottom margin-top">
                        <input type="file" class="form-control" name="fileToUpload" id="avatar">
                        <small class="text-danger"> <?php echo $logoError; ?></small>
                    </div><br> 
                      <label id="labelForAvatar" for="avatar">
                     <img src="<?php echo $builderPrImage; ?>" style="width:200px;" id="imgupload">
                    </label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add">Add New</button>
                </div>
              </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../AdminLTE-3.0.1/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../AdminLTE-3.0.1/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE-3.0.1/dist/js/adminlte.min.js"></script>
    <script type="text/javascript">
        
        function readFile() {
    if(this.files[0].size > 1000000){
        alert("File must be less than 1MB");
       this.value = "";
    }
    else{
          if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.onload = function(e) {
              document.getElementById("imgupload").src = e.target.result;
              document.getElementById("imgupload").style.width = "200px";
                
            };
            FR.readAsDataURL( this.files[0] );
          }
        }
}

        var el= document.getElementById("avatar");
        
        if(el){
        el.addEventListener("change", readFile, false);
        }
    </script>
    </body>
</html>