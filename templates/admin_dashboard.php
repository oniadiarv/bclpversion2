<?php
 session_start(); 

 $host = "localhost";
 $user = "root";
 $password = "";
 $db = "bclp_db";
 $con = mysqli_connect($host,$user,$password,$db);

 $query = "select * from student where sex = 'Male'";
 $run = mysqli_query($con,$query);

 if($male_total = mysqli_num_rows($run)){
    $male_total;
 }

 $query = "select * from student where sex = 'Female'";
 $run = mysqli_query($con,$query);

 if($female_total = mysqli_num_rows($run)){
    $female_total;
 }

 $query = "select * from student where courseId = 'CRS01'";
 $run = mysqli_query($con,$query);

 if($crs1_total = mysqli_num_rows($run)){
    $crs1_total;
 }

 $query = "select * from student where courseId = 'CRS02'";
 $run = mysqli_query($con,$query);

 if($crs2_total = mysqli_num_rows($run)){
    $crs2_total;
 }

 $query = "select * from student where courseId = 'CRS03'";
 $run = mysqli_query($con,$query);

 if($crs3_total = mysqli_num_rows($run)){
    $crs3_total;
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
    <!--charts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <!--end charts-->
   <!--
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--> 
   <link rel="stylesheet" href="static/css/style.css">
   <style>
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
            <a class="navbar-brand ms-5 py-2 text-white" href="#">BCLP System</a>
          </div>
        </nav>

          <!-- Sidebar Navigation -->
          <ul class="sidebar-nav p-0">
            <a href="/admin_dashboard">
              <li class="sidebar-header">
                 <span> DASHBOARD</span>
              </li>
            </a>
            <hr class="text-white my-0">

            <li class="sidebar-item">
              <a href="/admin_addCourse" class="sidebar-link">
              <i class="fas fa-tasks"></i>
                  <span>Manage Course</span>
              </a>
          </li>

            <li class="sidebar-item">
                <a href="/admin_manageuser" class="sidebar-link">
                <i class="far fa-user"></i>
                    <span>Manage Users</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="/admin_auditTrail" class="sidebar-link">
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
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>

              <div class="card shadow-lg mb-5 bg-body-tertiary rounded">
                <div class="card-body bg-white">
                  <div class="row">
                    <div class="col-6 mt-5">
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>

                    <div class="col-6 m-0">
                    <div
                       id="myChart2" style="width:100%; max-width:600px; height:500px;">
                    </div>
                    </div>

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
  <SCript>
    const toggler = document.querySelector(".toggler-btn");
      toggler.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("collapsed");
      });
////////////////////////////////////////////////////////////////////////////////
      var xValues = ["Male", "Female"];
      var yValues = [<?php echo "$male_total";?>, <?php echo "$female_total";?>];
      var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
      ];

      new Chart("myChart", {
        type: "pie",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          title: {
            display: true,
            text: "Total of Students - Male and Female"
          }
        }
      });
////////////////////////////////////////////////////////////////////
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        // Set Data
        const data = google.visualization.arrayToDataTable([
          ['Contry', 'Mhl'],
          ['Level 1: Basic Computer',<?php echo "$crs1_total";?>],
          ['Level 2: Photoshop',<?php echo "$crs2_total";?>],
          ['Level 3: Basic Web',<?php echo "$crs3_total";?>]
        ]);

        // Set Options
        const options = {
          title:'Total Student per Level/Course',
          is3D:true
        };

        // Draw
        const chart = new google.visualization.PieChart(document.getElementById('myChart2'));
        chart.draw(data, options);

        }
  </SCript>
  <script src="static/js/bootstrap.bundle.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
  </body>
</html>