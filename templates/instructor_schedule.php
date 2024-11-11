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
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay {{ user.barangay }}  Computer Literacy Program</a>

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
                  <li class="breadcrumb-item"><a href="instructor_dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create schedule</li>
                </ol>
                </nav>
                {%with messages = get_flashed_messages()%}
                    {%if messages%}
                        {% for message in messages %}
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{message}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                        {%endfor%}
                    {%endif%}
                {%endwith%}
              
                <div class="card shadow-lg mb-5 bg-body-tertiary rounded">
                <div class="card-body bg-white text-black ">
                <div class="container">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#setSchedule" aria-label="Set Schedule">
                        <i class="fas fa-plus"></i>Set Schedule</a>
                    </div>
                    </div>
                <div class="table-responsive">  
              

                    <table id="myTable" class="table table-hover pt-1">
                        <thead class='table-primary'>
                            <tr>
                                <th>Course Title</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Semester</th>
                                <th>Status</th>
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
                            </td>
                            <td>
                            {{ row[4] }}
                            </td>
                            <td>
                            {{ row[6] }}
                            </td>
                            <td>
                            {{ row[7] }}
                            </td>

                            <td>
                            <a href="/update_instructor_schedule{{ row[0] }}" style="width:100%" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#editSchedule{{ row[0] }}">View</a>
                           
                            </td>
                        </tr>
                        <!-- edit schedule -->
                            <div class="modal fade" id="editSchedule{{ row[0] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editScheduledropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editScheduleLabel">Edit Schedule</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form id="editScheduleForm" action="{{ url_for('update_instructor_schedule') }}" method = "POST">
                                    <div class="mb-3">
                                        <label for="scheduleTime" class="form-label">Time:</label>
                                        <input type="text" class="form-control" id="scheduleTime" name="time" value="{{row.4}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="scheduleDate" class="form-label">Day:</label>
                                        <input type="text" class="form-control" id="scheduleDay" name="day" value="{{row.5}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="scheduleYear" class="form-label">Semester: </label>
                                        <input type="text" class="form-control" id="scheduleSem" name="sem" value="{{row.6}}">
                                    </div>
                                    <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select" id="scheduleStatus" name="status" aria-label="Default select example">
                                                        <option selected value = "{{row.7}}" required>{{row.7}}</option>
                                                        <option value="Close">Close</option>
                                                        <option value="Open">Open</option>
                                                    </select>
                                    </div>

                                    
                                    <input type="hidden" id="schedId" name="schedId" value="{{row.0}}">
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name= "update" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            
                                </div>
                            </div>
                            </div>
                    <!-- edit schedule -->
                        {% endfor %}
                    </table>
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

            <!-- add course Modal -->
            <div class="modal fade" id="setSchedule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="setScheduleLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="setScheduleLabel">Set Schedules</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ url_for('insert_instructor_schedule') }}" method="post">
                                <div class="mb-3">
                                <input type="hidden" class="form-control" name = "userid" value = "{{ user.userid }}">
                                <input type="hidden" class="form-control" id="courseTitle" name = "courseTitle">
                                <label for="level" class="form-label">Course</label>
                                <select id="courseId" class="form-select" name="courseId">
                                    <option value="">Select a course</option>
                                </select>
                              
                                </div>
                                

                                <div class="mb-3">
                                    <label for="day" class="form-label">Day</label>
                                    <input type="text" class="form-control" id="day" name="day" placeholder = "ex. Mon-Fri" required>
                                </div>

                                <div class="mb-3">
                                    <label for="time" class="form-label">Time</label>
                                    <select class="form-select" id="time" name="time" aria-label="Default select example">
                                        <option selected value = "" required>select time</option>
                                        <option value="8:00 - 10:00 am">8:00 - 10:00 am</option>
                                        <option value="10:00 - 12:00 noon">10:00 - 12:00 noon</option>
                                        <option value="1:00 - 3:00 pm">1:00 - 3:00 pm</option>
                                        <option value="3:00 - 5:00 pm">3:00 - 5:00 pm</option>
                                    </select>
                                </div>
                                

                                <div class="mb-3">
                                    <label for="sem" class="form-label">Semester</label>
                                    <select class="form-select" id="sem" name="sem" aria-label="Default select example">
                                        <option selected value = "" required>select semester</option>
                                        <option value="1st">1st Sem</option>
                                        <option value="2nd">2nd Sem</option>
                                        <option value="3rd">3nd Sem</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" aria-label="Default select example">
                                        <option selected value = "" required>select status</option>
                                        <option value="Close">Close</option>
                                        <option value="Open">Open</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end add course Modal -->

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

                passwordInput.addEventListener("keyup", (e) => {
                    requirements.forEach(item => {
                        const isValid = item.regex.test(e.target.value);
                        const requirementsItem = requirementList[item.index];

                        if (isValid) {
                            requirementsItem.firstElementChild.className = "fa fa-check";
                            requirementsItem.style.color = "blue";
                            requirementsItem.style.fontSize = "17px";

                        } else {
                            requirementsItem.firstElementChild.className = "fa fa-circle";
                            requirementsItem.style.color = "black";
                            requirementsItem.style.fontSize = "15px";

                        }
                    });
                });

                eyeIcon.addEventListener("click", () => {
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

                $(document).ready(function () {
                    $('#myTable').DataTable();

                });

            $(document).ready(function() {
            $.getJSON('/get_course_titles', function(data) {
                $.each(data, function(index, value) {
                    $('#courseId').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                });
            });

            $('#courseId').change(function() {
                var selectedCourseId = $(this).val();
                $.getJSON('/get_course_titles', function(data) {
                    $.each(data, function(index, value) {
                        if (value[0] === selectedCourseId) {
                            $('#courseTitle').val(value[1]);
                        }
                    });
                });
            });
        });
</script>



            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>
