<?php
 session_start(); 
 $db_host = 'localhost';
 $db_username = 'root';
 $db_password = '';
 $db_name = 'bclp_db';
 
 // Create connection
 $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
 $username = $_SESSION['username']  ;
 $password = $_SESSION['password']  ;


 if(isset($_REQUEST['save'])){

    $courseId = $_REQUEST['courseId'];
    $level = $_REQUEST['level'];
    $title = $_REQUEST['title'];
    $desc = $_REQUEST['desc'];

    $query = "UPDATE course SET courseLvl = '$level', courseTitle = '$title' , courseDesc = '$desc' where courseId  = '$courseId'";
    $query_run = mysqli_query($conn,$query);
    
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
                    <a class="navbar-brand ms-5 text-white" href="#">BCLP System</a>
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
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay Computer Literacy Program</a>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto pe-5">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="my-0 py-0" id="profile" src="img/<?php echo $_SESSION['image']; ?>"
                                            title="<?php echo $_SESSION['image']; ?>">
                                        <?php echo $_SESSION['userType']. " ". $_SESSION['username']?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
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
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                    </ol>
                </nav>

                <div class="container-fluid border  shadow-lg bg-body-tertiary rounded">
                    <div class="col-2 ms-auto p-2">
                        <button type="button" class="btn btn-primary" style="width:100%" data-bs-toggle="modal"
                            data-bs-target="#addcourse">
                            <i class="fas fa-plus"></i> Add Course
                        </button>
                    </div>

                    <table id="myTable" class="table table-hover pt-1">
                        <thead class='table-primary'>
                            <tr>
                                <th>Id</th>
                                <th>Level</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php
                  $host = "localhost";
                  $user = "root";
                  $password = "";
                  $db = "bclp_db";
               
                  $con = mysqli_connect($host,$user,$password,$db);

                    $stmt = "Select * from course";
                        $result = mysqli_query ($con,$stmt);

                        if (mysqli_num_rows($result)>0)
                        {
                        foreach( $result as $allcourses)
                        {
                          ?>
                        <tr>
                            <td>
                                <?= $allcourses['courseId']?>
                            </td>
                            <td>
                                <?= $allcourses['courseLvl']?>
                            </td>
                            <td>
                                <?= $allcourses['courseTitle']?>
                            </td>
                            <td>
                                <?= $allcourses['courseDesc']?>
                            </td>




                            <td>
                            <a href="admin_deleteCourse.php?userid=<?= $allcourses['courseId']; ?>" style="width:100%"
                                    class="btn btn-danger btn-md">Delete</a>
                            </td>
                        </tr>

                        <?php
                        }
                        } else {
                          echo "<h5> No Record Found </h5>";
                        }
                  ?>
                    </table>


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
        <!-- 
        <div class="modal fade" id="editcourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addcourseLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addcourseLabel">Edit Course</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="editScheduleForm">
                                <div class="mb-3">
                                    <label for="level" class="form-label">Course Level</label>
                                    <input type="text" class="form-control" id="level" name="level">
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Course Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Course Description</label>
                                    <textarea class="form-control" id="desc" rows="6" name="desc"></textarea>
                                </div>
                                <input type="text" id="courseId" name="courseId">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name= "save" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
             end add course Modal -->
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
            <div class="modal fade" id="addcourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addcourseLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addcourseLabel">Add Courses</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="admin_insertCourse.php" method="post">
                                <div class="mb-3">
                                    <label for="level" class="form-label">Course Level</label>
                                    <input type="text" class="form-control" id="level" name="level">
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Course Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Course Description</label>
                                    <textarea class="form-control" id="desc" rows="6" name="desc"></textarea>
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
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
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
                    $('.edit-course').on('click', function() {
                        var schedId = $(this).data('schedid');
                        $('#courseId').val(schedId); // Set the hidden input with schedId

                        // AJAX request to fetch schedule data
                        $.ajax({
                            url: 'admin_addCourse_fetch.php', // The PHP file that will handle the request
                            type: 'GET',
                            data: { schedId: schedId },
                            success: function(response) {
                                var data = JSON.parse(response);
                                $('#level').val(data.courseLvl);
                                $('#title').val(data.courseTitle);
                                $('#desc').val(data.courseDesc);
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error: ' + status + error);
                            }
                        });
                    });
                });
            </Script>


            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>