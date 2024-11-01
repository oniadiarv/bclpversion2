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
                <a class="navbar-brand ms-5 text-white" href="instructor_dashboard.php">BCLP System</a>
                </div>
            </nav>

             <!-- Sidebar Navigation -->
          <ul class="sidebar-nav p-0">
            <a href="instructor_dashboard.php">
              <li class="sidebar-header">
                 <span> DASHBOARD</span>
              </li>
            </a>
            <hr class="text-white my-0">
              <li class="sidebar-item">
                <a href="instructor_manageStudentTable.php" class="sidebar-link">
                <i class="fas fa-user-graduate"></i>
                    <span>Manage Student</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="instructor_manageEnrollees.php" class="sidebar-link">
                <i class="fas fa-users"></i>
                    <span>Manage Enrollees</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="instructor_schedule.php" class="sidebar-link">
                <i class="fas fa-calendar-alt"></i>
                    <span>Manage Schedule</span>
                </a>
            </li>
           

            <li class="sidebar-item">
                <a href="instructor_exam.php" class="sidebar-link">
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
                  <a href="instructor_manageReport.php" class="sidebar-link">
                  <i class="fas fa-chart-area"></i>
                      <span>Report</span>
                  </a>
              </li>
           
          </ul>
      </aside>
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
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay <?php echo $branch?>  Computer Literacy Program</a>

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
                                    <li><a class="dropdown-item" href="instructor_changePass.php">Change Password</a></li>
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
                        <li class="breadcrumb-item active" aria-current="page">Manage Password</li>
                    </ol>
                </nav>

                <div class="container-fluid">

                    <div class="card shadow-lg bg-body-tertiary rounded">
                        <div class="card-header">
                            Change Password
                        </div>
                        <div>
                            <div class="container col-lg-8 justify-content-center align-items-center my-3 ">

                                <form class="" action="" method="POST" enctype="multipart/form-data">

                                    <label for="cpassword">Current Password</label>
                                    <div class="form-group1 input-group">
                                        <input type="password" class="form-control" id="cpassword" name="cpassword">

                                        <div class="input-group-text" onclick="password_show_hide1();">
                                            <i class="fa fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>

                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        <?php if(!empty($current_error)){ echo $current_error; } ?>
                                    </span><br>

                                    <label for="npassword">New Password</label>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" id="npassword" name="npassword">

                                        <div class="input-group-text">
                                            <i class="fa fa-eye" id="nshow_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="nhide_eye"></i>
                                        </div>
                                    </div>


                                    <span class="text-danger">
                                        <?php if(!empty($new_error)){ echo $new_error; } ?>
                                    </span><br>

                                    <label for="confirm">Confirm Password</label>
                                    <div class="form-group1 input-group">
                                        <input type="password" class="form-control" id="confirm" name="confirm">

                                        <div class="input-group-text" onclick="password_show_hide2();">
                                            <i class="fa fa-eye" id="show_eye2"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>

                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        <?php if(!empty($confirm_error)){ echo $confirm_error; } ?>
                                    </span> <span class="text-danger">
                                        <?php if(!empty($match_error)){ echo $match_error; } ?>
                                    </span><br>

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

                            <div class="modal-footer mx-5 mb-5">
                                <button class="btn btn-primary" type="submit" name="change">Save</button>
                            </div>

                            </form>
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
                <a class="btn btn-primary" href="/bclp_logout">Logout</a>
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

            function password_show_hide1() {
            var x = document.getElementById("cpassword");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
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
        </Script>


        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>