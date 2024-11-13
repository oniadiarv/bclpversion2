<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCLP System</title>
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <!--
      <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
    <link rel="stylesheet" href="static/css/style.css">
    <style>
        #card-body {
            background-color: #ffffff;
            color: black;
        }

        #profile {
            width: 30px;
            height: 30px;
            border-radius: 50%
        }

        .navbar-brand {
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
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay  {{ user.barangay }} Computer Literacy Program</a>

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
                        <li class="breadcrumb-item active" aria-current="page">Create Assessment Test</li>
                    </ol>
                </nav>
                <div class="container-fluid">

                    <div class="card">
                        <div id="card-body" class="card-body ">
                            <div class="row">
                                <div class="col-6">
                                    <h2> Assessment Test</h2>
                                </div>
                                
                                <div class="col-6">
                                    <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#questioner">
                                    <i class="fas fa-plus"></i> Add Questions</a>
                                </div>
                                <hr>
                                <div>
                                    <form action="" method="post">
                                    {% for row in results %}
                                            <h5>
                                            {{ row[1] }}
                                            </h5>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input class="form-check-input" type="radio" name="answer"
                                                            value="Yes" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="form-check-input" type="radio" name="answer"
                                                            value="No" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            No
                                                        </label>
                                                    </div>
                                                    <div class="col-8">
                                                        <a href="/delete_instructor_exam/{{ row[0] }}"
                                                            class="btn btn-danger btn-md float-end m-1">Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                            {% endfor %}
                                      
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </main>
            <!--End Main Body-->
        </div>
    </div>
     <!--
    <div class="footer">
        <div class="navbar navbar-expand-lg bg-white border border-primary fixed-bottom">
            <div class="container-fluid">
                <div class="navbar-nav m-auto pe-5">
                    BCLP System @2024
                </div>
            </div>
        </div>
    </div>
-->
    <!-- Modal -->
    <div class="modal fade" id="questioner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="questionerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="questionerLabel">Assessment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/insert_instructor_exam" method="POST">
                        <div class="mt-3">
                            <label for="question" class="form-label">Assessment Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Now</button>
                        </div>
                    </form>
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
    <Script>
        const toggler = document.querySelector(".toggler-btn");
        toggler.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });

        $(document).ready(function() {
    $('a[data-bs-target="#editquestion"]').on('click', function() {
        var schedId = $(this).data('questionId');
        $('#questionId').val(schedId); // Set the hidden input with schedId

        // AJAX request to fetch schedule data
        $.ajax({
            url: 'instructor_schedule_fetch.php', // The PHP file that will handle the request
            type: 'GET',
            data: { schedId: schedId },
            success: function(response) {
                var data = JSON.parse(response);
                $('#scheduleCourse').val(data.courseId);
                $('#scheduleTime').val(data.time);
                $('#scheduleDay').val(data.day);
                $('#scheduleSem').val(data.sem);
                $('#scheduleStatus').val(data.status);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    });
});
        
    </Script>
    <script src="static/js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>
