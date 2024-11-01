<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "bclp_db";

    session_start(); 
    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d h:i:s"); 
    $con = mysqli_connect($host,$user,$password,$db); 
    
    //$userid = $_SESSION['userid'];
    //$userType = $_SESSION['userType'];

    $error=0;
    $msg="";
    
    if(isset($_REQUEST['submit']))
    {
      $userType = $_REQUEST['userType'];
      $barangay = $_REQUEST['barangay'];
      $fname = $_REQUEST['fname'];
      $mname = $_REQUEST['mname'];
      $lname = $_REQUEST['lname'];
      $email = $_REQUEST['email'];
      $username = $_REQUEST['username'];
      $pass = $_REQUEST['password'];
      $confirm = $_REQUEST['confirm'];
////start save image
      if($_FILES["image"]["error"] === 4){

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

//////end of save image
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
      if(empty($confirm))
      {
        $pass_error = "Please Enter Verification Password";
        $error=1;
      }

      if($pass != $confirm)
      {
        $pass_error = "Password Not Match!";
        $error=1;
      }

      if(empty($pass))
      {
        $match_error = "Please Enter Password";
        $error=1;
      }

      else if(strlen($pass) < 8)
      {
        $match_error = "At least 8 Characters length!";
        $error=1;
      }
     
     else if(!preg_match('#[0-9]#', $pass))
      {
        $match_error = "At least has 1 number!";
        $error=1;
      }
      else if(!preg_match('/[A-Z]/', $pass))
      {
        $match_error = "At least has 1 uppercase!";
        $error=1;
      }
      else if(!preg_match('/[^A-Za-z0-9]/', $pass))
      {
        $match_error = "At least has 1 special symbol!";
        $error=1;
      }
     
      else if(!preg_match('/[a-z]/', $pass))
      {
        $match_error = "At least has 1 lowercase!";
        $error=1;
      }

      

      if($error==0)
      {
        $pass = md5($pass);

        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        $query = "INSERT INTO users VALUES('','$userType','$barangay', '$fname','$mname','$lname','$email','$newImageName','$username','$pass')";
        mysqli_query($con, $query);

      if($query>0)
      {
        $msg = "Error!";
        
      }
      else
      {
        $insert_edit_id = mysqli_insert_id($con);
        $query = "INSERT INTO activity_log VALUES('','$userid', '$userType','Insert','allusers Table','$insert_edit_id','','','$time')";
        mysqli_query($con, $query);
        $_SESSION['message'] = "New Data Inserted Successfully!";
        header("Location: admin_manageuser.php?alert=New+User+add+successfully+!+!");
        exit();
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
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="DataTables/query.dataTables.min.css" rel="stylesheet" type="text/css">
    
   <!--
   <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--> 
   <link rel="stylesheet" href="css/style.css">
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
            <a class="navbar-brand ms-3 text-white " href="#">Barangay Computer Literacy Program</a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto pe-5">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="my-0 py-0" id = "profile" src="img/<?php echo $_SESSION['image']; ?>" title="<?php echo $_SESSION['image']; ?>">
                  <?php echo $_SESSION['userType']. " ". $_SESSION['username']?>
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
                <li class="breadcrumb-item active" aria-current="page">Add Users</li>
              </ol>
            </nav>

              <div class="container-fluid">
             
              <div class="card shadow-lg bg-body-tertiary rounded">
                <div class="card-header">
                    Add Users
                </div>
                <div >
                   <form action=""  method="POST" enctype="multipart/form-data">
                    
                   <div class="row  m-3" >
                        <div class = "col-3">
                            <label for="userType" class="form-label">User Type</label>
                            <select class="form-select pb-1" id="userType" name="userType" aria-label="Default select example">
                            <option selected value="">Select User Type</option>
                            <option value="Instructor">Instructor</option>
                            <option value="Administrator">Administrator</option>
                            </select>
                            <span class="text-danger"><?php if(!empty($userType_error)){ echo $userType_error; } ?></span>
                        </div>

                        <div class="col-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" placeholder="barangay"  value="<?php if(isset($barangay)){ echo $barangay; }?>">
                            <span class="text-danger"><?php if(!empty($barangay_error)){ echo $barangay_error; } ?></span>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-4 mt-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First " value="<?php if(isset($fname)){ echo $fname; }?>">
                            <span class="text-danger"><?php if(!empty($fname_error)){ echo $fname_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle"  value="<?php if(isset($mname)){ echo $mname; }?>">
                            <span class="text-danger"><?php if(!empty($mname_error)){ echo $mname_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last"  value="<?php if(isset($lname)){ echo $lname; }?>">
                            <span class="text-danger"><?php if(!empty($lname_error)){ echo $lname_error; } ?></span>
                        </div>
                        </div>

                                    
                    <div class="row m-3">
                        <div class="col-4 mt-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="@email" value="<?php if(isset($email)){ echo $email; }?>" >
                            <span class="text-danger"><?php if(!empty($email_error)){ echo $email_error; } ?></span>
                        </div>

                        
                        <div class="col-4 mt-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username"  value="<?php if(isset($username)){ echo $username; }?>" >
                            <span class="text-danger"><?php if(!empty($uname_error)){ echo $uname_error; } ?></span>
                        </div>

                        <div class="col-4 mt-3">
                            <label for="image" class="form-label">Upload Picture </label><br>
                            <input type="file" class="form-control" name="image" id = "image" accept=".jpg, .jpeg, .png" value="">
                            <span class="text-danger"><?php if(!empty($image_error)){ echo $image_error; } ?></span>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-6 mt-3">
                        <label for="pass" class="form-label">Password</label>
                                <div class="form-group input-group">
                                <input type="password" class="form-control" id="pass" name="password" placeholder="password" >
                                    <div class="input-group-text">
                                    <i class="fa fa-eye"></i>
                                    </div>
                                </div>
                                <span class="text-danger"><?php if(!empty($match_error)){ echo $match_error; } ?></span><br>
                            <label for="confirm" class="form-label mt-3">Confirm Password</label>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm password">
                                    
                                    <div class="input-group-text" onclick="password_show_hide2();">
                                <i class="fa fa-eye" id="show_eye2"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                            </div>
                                
                                </div>
                                <span class="text-danger"><?php if(!empty($pass_error)){ echo $pass_error; } ?></span>
                        </div>

                        
                        <div class="col-6">
                            <div class="pasCon">
                                        <p>Password must contains:</p>
                                    </div>
                                        <ul class="requirement-list">
                                            <li>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            <span>At least 8 Characters length</span>
                                                    
                                            </li>
                                            <li>
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                                            <span>At least has 1 number (0..9) </span>

                                            </li>
                                            <li>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            <span>At least has 1 lowercase (a..z) </span>
                                            </li>
                                            <li>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            <span>At least has 1 special symbol (!..$) </span>
                                            </li>
                                            <li>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            <span>At least has 1 uppercase (A..Z) </span>
                                            </li>
                                        </ul>
                            </div>
                        </div>

                        <div class="float-end mb-3 me-3">
                        <a href = "admin_manageuser.php">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        </a>
                        <button type="submit" name="submit" class="btn btn-primary">Add Now</button>
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
  <script src="jquery/jquery-3.7.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="DataTables/jquery.dataTables.min.js"></script>

  
  <Script>
    const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});

const passwordInput = document.querySelector(".form-group input");
    const eyeIcon = document.querySelector(".form-group i");
    const requirementList = document.querySelectorAll(".requirement-list li");
    //const requirementListIcon = document.querySelectorAll(".requirement-list span");
    
const requirements = [
   { regex: /.{8,}/, index: 0 },
    { regex: /[0-9]/, index: 1 },
    { regex: /[a-z]/, index: 2 },
    { regex: /[^A-Za-z0-9]/, index: 3 },
    { regex: /[A-Z]/, index: 4 },
]

       passwordInput.addEventListener("keyup",(e) => {
            requirements.forEach(item => {
           const isValid = item.regex.test(e.target.value);
        const requirementsItem = requirementList[item.index];

           if(isValid){
             requirementsItem.firstElementChild.className = "fa fa-check";
            requirementsItem.style.color ="blue";
            requirementsItem.style.fontSize ="17px";
             
            }else{
                requirementsItem.firstElementChild.className = "fa fa-circle";
                requirementsItem.style.color ="black";
                requirementsItem.style.fontSize ="15px";
                
            }
        });
        });

        eyeIcon.addEventListener("click",() => {
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
            eyeIcon.className = `fa fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
        });

function password_show_hide2() {
  var x = document.getElementById("confirm");
  var show_eye = document.getElementById("show_eye2");
  var hide_eye = document.getElementById("hide_eye2");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}

$(document).ready(function(){
  $('#myTable').DataTable();

});
  </Script>
  
  
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
  </body>
</html>