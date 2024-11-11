<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCLP System</title>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
            <a class="navbar-brand ms-5 text-white" href="/instructor_dashboard">BCLP System</a>
          </div>
        </nav>

          <!-- Sidebar Navigation -->
          <ul class="sidebar-nav p-0">
            <a href="/instructor_dashboard">
              <li class="sidebar-header">
                 <span> DASHBOARD</span>
              </li>
            </a>
            <hr class="text-white my-0">
              <li class="sidebar-item">
                <a href="/instructor_search_manageStudentTable" class="sidebar-link">
                <i class="fas fa-user-graduate"></i>
                    <span>Manage Student</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/instructor_manageEnrollees" class="sidebar-link">
                <i class="fas fa-users"></i>
                    <span>Manage Enrollees</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="/instructor_schedule" class="sidebar-link">
                <i class="fas fa-calendar-alt"></i>
                    <span>Manage Schedule</span>
                </a>
            </li>
           

            <li class="sidebar-item">
                <a href="/instructor_exam" class="sidebar-link">
                <i class="fas fa-sticky-note"></i>
                    <span>Assessment Test</span>
                </a>
            </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
            <i class="fas fa-certificate"></i>
                <span>Certificates</span>
            </a>
        </li>
              <li class="sidebar-item">
                  <a href="/instructor_manageReport" class="sidebar-link">
                  <i class="fas fa-chart-area"></i>
                      <span>Report</span>
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

              <div class="container-fluid">
                
        <br>

                  <div class="row">
                        <div class="col-sm-4 ">
                        <div class="card">
                            <div class="card-body ">
                              <p class="card-text ">Total Number of Enrollees</p>
                            <h1 class="card-title text-end">
                            <span style="font-size: 40px"> 
                            {{enrollee}}
                                  </span>
                            </h1>
                            <div class="text-end">
                              <hr class="text-white">
                            <a class="card-body  fs-5" href="/instructor_manageEnrollees">>></a>
                            </div>
                          </div>
                        </div>
                        </div>

                        <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body ">
                              <p class="card-text ">Total Number of Student</p>
                            <h1 class="card-title text-end">
                            {{student}}
                            </h1>
                            <div class="text-end">
                              <hr class="text-white">
                            <a class="card-body  fs-5" href="/instructor_manageStudentTable" > >></a>
                          </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                            <div class="card-body ">
                              <p class="card-text">Total Number of Class</p>
                                <h1 class="card-title text-end">
                                {{classs}} 
                                </h1>
                                <div class="text-end">
                                  <hr class="text-white">
                                <a class="card-body fs-5" href="/instructor_schedule"> >></a>
                            </div>
                          </div>
                            </div>
                        </div>         
                    </div>
<hr>
                  <br>

                  <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                          <div class="card-body">
                            <p class="card-text ">Total Number of Male</p>
                            <h1 class="card-title text-end">
                            {{male}} 
                            </h1>
                           <div class="text-end">
                            <hr class="text-white">
                           
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="card">
                          <div class="card-body ">
                            <p class="card-text ">Total Number of Female</p>
                            <h1 class="card-title text-end">
                            {{female}} 
                            </h1>
                            <div class="text-end">
                              <hr class="text-white">
                       
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="card">
                          <div class="card-body ">
                            <p class="card-text ">Total Number of Teenager</p>
                            <h1 class="card-title text-end">
                            {{teen}} 
                            </h1>
                            <div class="text-end">
                              <hr class="text-white">
                            
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="card">
                          <div class="card-body ">
                            <p class="card-text ">Total Number of Senior</p>
                            <h1 class="card-title text-end">
                            {{senior}} 
                            </h1>
                            <div class="text-end">
                              <hr class="text-white">
                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
 
              </div>
<div>
  <br><br>
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
        <a class="btn btn-primary" href="/bclp_logout">Logout</a>
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
  </SCript>
  <script src="static/js/bootstrap.bundle.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
  </body>
</html>
