<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCLP System</title>

    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="static/DataTables/query.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--
   <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
    <link rel="stylesheet" href="static/css/style.css">
    <style>
        .input-group-text {
            cursor: pointer;
        }

        #profile {
            width: 30px;
            height: 30px;
            border-radius: 50%
        }

        .navbar-brand {
            height: 50px
        }

.image-container {
    position: relative;
    display: inline-block; /* Ensures the container only takes up as much space as the image */
}

.image-container img {
    display: block; /* Removes the bottom space under the image */
    width: 100%; /* Ensures the image is responsive */
}

.image-container h4 {
    font-family: 'Times New Roman', Times, serif; /* Specifies the font family */
    font-style: italic; /* Applies the italic style */
    font-size: 29px; 
    position: absolute; /* Allows positioning relative to the container */
    top: 44%; /* Centers vertically */
    left: 50%; /* Centers horizontally */
    transform: translate(-50%, -50%); /* Adjusts the position to truly center the text */
    color: black; /* Ensures the text is visible over the image */
    text-align: center; /* Centers the text */
    padding: 10px; /* Adds some padding around the text */
}

        
    </style>
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
            <a href="/instructor_certificate" class="sidebar-link">
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
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay   {{ user.barangay }}  Computer Literacy Program</a>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto pe-5">
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img id = "profile" src="static/img/{{ user.image }}" alt="User Image">
                                {{ user.userType }} {{ user.username }}
                                </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#logout">Log Out</a></li>
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
                  <li class="breadcrumb-item"><a href="/instructor_dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Enrollee's</li>
                </ol>
                </nav>
            
                <div class="card shadow-lg p-3 mb-1 bg-body-tertiary rounded">
                    <div class="card-body bg-white text-black ">
                        <form action ="/instructor_search_certificate"method = "post">
                            <div class="col-12">
                                  <div class="row">
                                    <div class = "col-6"></div>  
                                        <div class="col-sm-2 col-md-4 col-lg-2 mb-1">
                                        <input type="text" class="form-control" id="batch" name="batch" placeholder="Year" required>
                                            </div>
                                            <div class="col-sm-2 col-md-4 col-lg-2 mb-1">
                                                <select class="form-control" id="course" name="course" required>
                                                <option value=""> Select Course</option>
                                                    <option value="CRS01">Basic, Intermediate & Advance Computer Concepts</option>
                                                    <option value="CRS02">Photo and Graphic Enhancement Program</option>
                                                    <option value="CRS03">Internet Essetials & Basic, Webpage Design</option>
                                                </select>
                                     

                                            </div>
                                            <div class="col-sm-4 col-md-2 col-lg-2">
                                            <button type="submit" name = "search" class="btn btn-primary"  style="width:100%"> SEARCH</button>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body bg-white text-black ">
                    <div class="table-responsive"> 
                    <table id="myTable" class="table table-hover pt-1 ">
                        <thead class='table-primary'>
                            <tr >
                              
                                <th>Course</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {% for row in results %}
                        <tr>
                            
                            <td>
                               {{ row[3] }}
                            </td>
                           
                           
                            <td>
                                {{ row[5] }}
                                {{ row[6] }}.
                                {{ row[7] }}
                                {{ row[8] }}
                            </td>
                            <td>
                                    <a href="/instructor_search_certificate{{ row[0] }}" style="width:100%" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#certificate{{ row[0] }}">Print Certificate</a>
                            </td>
                        </tr>
                        <!-- edit Modal -->
                        <div class="modal fade" id="certificate{{ row[0] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
                                        <div class="modal-header">
                                           
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div> 
                                            <div class="modal-body ">


                                           <div class="modal-body">

                                           
                                                <div class="image-container">
                                                {% for row in certs %}
                                                    <img src="static/webimg/{{row.1}}" class="img-fluid" width="800" title="{{row.1}}">
                                                    {% endfor %}
                                                    <h4 id="name">{{ row[5] }} {{ row[6] }}. {{ row[7] }}, {{ row[8] }}</h4>
                                                </div>
                                           
                                        </div>



                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <button onclick="printModalContent()" name = "print" class="btn btn-primary">Print</button>
                                                </div>
                                        </div>
                                </div>
                            </div>

<!-- end of edit Modal -->

                      {%endfor%}
                    </table>


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
     

<!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Users</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input-group">
                                <input type="password" class="form-control" id="pass" name="password"
                                    placeholder="password" required>
                                <i class="fa fa-eye"></i>
                            </div>
                        </div>
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
                    <a class="btn btn-primary" href="/bclp_logout">Logout</a>
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

               
                $(document).ready(function () {
                    $('#myTable').DataTable();

                });

                function printModalContent() {
        var printContents = document.querySelector('.modal-body').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload(); // Reload the page to restore the original content
    }
                    
            </Script>
            
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>
