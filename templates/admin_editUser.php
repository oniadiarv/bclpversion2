<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "bclp_db";

    session_start();  
    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d h:i:s"); 
    $con = mysqli_connect($host,$user,$password,$db); 
  
    $error=0;
    $msg="";
    $userType =  $_SESSION['userType'];
   // $users_userid = $_SESSION['userid'];

    
////////////////////// callling data by userid
    if(isset($_GET['userid']))
    {
       $userid = $_GET['userid'];

        $userid = mysqli_real_escape_string($con, $_GET['userid']);
        $query = "SELECT * FROM users WHERE userid='$userid' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $allusers = mysqli_fetch_array($query_run);
          }
          else
          {
              echo "<h4>No Such Id Found</h4>";
          }
      }
////////////////////// end callling data by userid      

    
   
    if(isset($_REQUEST['update'])){

      $userid = $_REQUEST['userid'];
      $userType = $_REQUEST['userType'];
      $barangay = $_REQUEST['barangay'];
      $fname = $_REQUEST['fname'];
      $mname = $_REQUEST['mname'];
      $lname = $_REQUEST['lname'];
      $email = $_REQUEST['email'];
      $username = $_REQUEST['username'];

      if(empty($userType))
      {
        $userType_error = "Please choose Role";
        $error=1;
      }
      if(empty($barangay))
      {
        $barangay_error = "Please enter the First Name";
        $error=1;
      }
      if(empty($fname))
      {
        $fname_error = "Please enter the First Name";
        $error=1;
      }
      else if(!preg_match("/^[a-zA-Z ]*$/", $fname))
      {
        $fname_error = "Only letters are allowed";
        $error=1;
      }

      if(empty($mname))
      {
        $mname_error = "Please enter the Middle Name";
        $error=1;
      }
      else if(!preg_match("/^[a-zA-Z ]*$/", $mname))
      {
        $mname_error = "Only letters are allowed";
        $error=1;
      }

      if(empty($lname))
      {
        $lname_error = "Please enter the Last Name";
        $error=1;
      }
      else if(!preg_match("/^[a-zA-Z ]*$/", $lname))
      {
        $lname_error = "Only letters are allowed";
        $error=1;
      }

      if(empty($email))
      {
        $email_error = "Please enter the Email";
        $error=1;
      }
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $email_error = "Invalid Email Format";
        $error=1;
      }
      if(empty($username))
      {
        $uname_error = "Please enter User Name";
        $error=1;
      }

   
      if($_FILES["image"]["error"] == 4){

        $image_error = "Upload Image";
        $error=1;
        
      }
      else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
    
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if ( !in_array($imageExtension, $validImageExtension) ){
          $image_error = "Invalid Image Extension";
          $error=1;
      
        }
        else if($fileSize > 1000000){

          $image_error = "Image Size Is Too Large";
          $error=1;
        
        }
      }
      if($error==0){
      ////////////////////// updating data
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;
      $query = "UPDATE users SET userType ='$userType', barangay ='$barangay', fname='$fname', mname='$mname', lname= '$lname', email='$email', image='$newImageName' ,username= '$username' WHERE userid='$userid' ";
      $query_run = mysqli_query($con, $query);
      move_uploaded_file($tmpName, 'img/' . $newImageName);
  
      if($query_run)
      {
              ////////////////////// insert to activity log
        $query = "INSERT INTO activity_log VALUES('','$users_userid', '$userType','Edit','allusers Table','$userid','$olduser $oldfname $oldmname $oldlname $oldemail $olduname $oldnewImageName','$newuser $newfname $newmname $newlname $newemail $newuname $newImageName','$time')";
        mysqli_query($con, $query);
          $_SESSION['message'] = "Data Updated Successfully ";
          header("Location: admin_manageuser.php");
          exit(0);
      }
      else
      {
          $_SESSION['message'] = "Data Not Updated";
          header("Location: admin_manageuser.php");
          exit(0);
      }
    }
    }

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCLP System</title>
    
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="static/DataTables/query.dataTables.min.css" rel="stylesheet" type="text/css">
    
   <!--
   <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--> 
   <link rel="stylesheet" href="static/css/style.css">
  <style>
    .input-group-text{
    cursor: pointer;
  }
  #profile{
      width: 30px;
      height: 30px;
      border-radius: 50%
    }
    .navbar-brand{
      height: 50px
    }
  </style>
  </head>
  
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <aside id="sidebar" class="sidebar-toggle">

        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
            <a class="navbar-brand ms-5 text-white" href="#">BCLP System</a>
          </div>
        </nav>

          <!-- Sidebar Navigation -->
          <ul class="sidebar-nav p-0">
            <a href="admin_dashboard.php">
              <li class="sidebar-header">
                 <span> DASHBOARD</span>
              </li>
            </a>
            <hr class="text-white my-0">

            <li class="sidebar-item">
              <a href="admin_addCourse.php" class="sidebar-link">
              <i class="fas fa-tasks"></i>
                  <span>Manage Course</span>
              </a>
          </li>

            <li class="sidebar-item">
                <a href="admin_manageuser.php" class="sidebar-link">
                <i class="far fa-user"></i>
                    <span>Manage Users</span>
                </a>
            </li>

            
            <li class="sidebar-item">
                <a href="admin_auditTrail.php" class="sidebar-link">
                <i class="fas fa-file-signature"></i>
                    <span>Audit Trail</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                <i class="fas fa-print"></i>
                    <span>See all Reports</span>
                </a>
            </li>
  <!--
            <li class="sidebar-item">
              <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                  data-bs-target="#exam" aria-expanded="true" aria-controls="exam">
                  <i class="far fa-sticky-note"></i>
                  <span>See all Reports</span>
              </a>
              <ul id="exam" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                  <li class="sidebar-item ps-3">
                      <a href="#" class="sidebar-link text-black" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Assessment</a>
                  </li>
                  <li class="sidebar-item ps-3">
                      <a href="instructor_exam.html" class="sidebar-link text-black">Manage Assessment</a>
                  </li>
              </ul>
          </li>
-->
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
            <i class="fas fa-envelope"></i>
                <span>Notification</span>
            </a>
        </li>
            
              <li class="sidebar-item">
                  <a href="#" class="sidebar-link">
                  <i class="fas fa-cogs"></i>
                      <span>Setting</span>
                  </a>
              </li>
          </ul>
      </aside>

      
      <div class="main">
        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
            
            <button class="toggler-btn" type="button">
            <i class="fas fa-bars"></i>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-3 text-white " href="#">Barangay  {{ user.barangay }}  Computer Literacy Program</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto pe-5">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img id = "profile" src="static/img/{{ user.image }}" alt="User Image">
                                 {{ user.userType }} {{ user.username }}
                                </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logout">Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </nav>
        <!--Main Body-->
          <main class="p-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="admin_manageuser.php">Manage Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Users</li>
              </ol>
            </nav>

              <div class="container-fluid">
             
              <div class="card shadow-lg bg-body-tertiary rounded">
                <div class="card-header">
                    Add Users
                </div>
                <div >
                   <form action=""  method="POST" enctype="multipart/form-data">
                   <input type="hidden" class="form-control" id="userid" name="userid" value="<?= $allusers['userid'];?>">
                   <div class="row  m-3" >
                        <div class = "col-3">
                            <label for="userType" class="form-label">User Type</label>
                            <select class="form-select pb-1" id="userType" name="userType" aria-label="Default select example">
                            <option selected ><?= $allusers['userType'];?></option>
                            <option value="Instructor">Instructor</option>
                            <option value="Administrator">Administrator</option>
                            </select>
                            <span class="text-danger"><?php if(!empty($userType_error)){ echo $userType_error; } ?></span>
                        </div>

                        <div class="col-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" value="<?= $allusers['barangay'];?>" >
                            <span class="text-danger"><?php if(!empty($barangay_error)){ echo $barangay_error; } ?></span>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-4 mt-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="<?= $allusers['fname'];?>">
                            <span class="text-danger"><?php if(!empty($fname_error)){ echo $fname_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname" value="<?= $allusers['mname'];?>">
                            <span class="text-danger"><?php if(!empty($mname_error)){ echo $mname_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?= $allusers['lname'];?>">
                            <span class="text-danger"><?php if(!empty($lname_error)){ echo $lname_error; } ?></span>
                        </div>
                        </div>

                                    
                    <div class="row m-3">
                        <div class="col-4 mt-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $allusers['email'];?>" >
                            <span class="text-danger"><?php if(!empty($email_error)){ echo $email_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $allusers['username'];?>" >
                               <span class="text-danger"><?php if(!empty($uname_error)){ echo $uname_error; } ?></span>
                        </div>

                    </div>
                    <div class="col-4 m-4">
                            <label for="image" class="form-label">Uploaded Picture </label><br>
                            <img src="img/<?php echo $allusers['image']; ?>" width = 100 title="<?php echo $allusers['image']; ?>">
                            <input type="file" class="form-control" name="image" id = "image" accept=".jpg, .jpeg, .png" value="">
                            <span class="text-danger"><?php if(!empty($image_error)){ echo $image_error; } ?></span>
                        </div>

                        <div class="float-end mb-3 me-3">
                        <a href = "admin_manageuser.php">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        </a>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                   </form>
                </div>
                </div>
         
              </div>

          </main>     
          <!--End Main Body
      </div>
  </div>
  
  <div class="footer">
    <div class="navbar navbar-expand-lg bg-white border border-primary">
        <div class="container-fluid">
            <div class="navbar-nav m-auto pe-5">
               BCLP System @2024
            </div>
        </div>
    </div>
    </div>
   -->
 <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Users</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        
         
        


          
         


       
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->

 <!--Logout Modal-->
 <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="bclp_logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

  <!--<script src="script.js"></script>-->
  <script src="static/jquery/jquery-3.7.1.min.js"></script>
  <script src="static/js/bootstrap.bundle.js"></script>
  <script src="static/DataTables/jquery.dataTables.min.js"></script>

  
  <Script>
    const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});


$(document).ready(function(){
  $('#myTable').DataTable();

});
  </Script>
  
  
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
  </body>
</html>
