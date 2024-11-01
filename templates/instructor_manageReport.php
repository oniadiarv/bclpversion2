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
   
        #myTable{
            table-layout:fixed;
            width: 100%;
        }
        td{
            font-size: 15px;
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
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay <?php echo $branch?> Computer Literacy Program</a>

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
                  <li class="breadcrumb-item"><a href="instructor_dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Report</li>
                </ol>
                </nav>
                    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body bg-white text-black ">
                    <div class="table-responsive">
<div class="col-12 mb-2">
    <div class="row">
        <div class="col-12">
        <form method="POST" action="">
                    <input type="hidden" value = "<?php echo $fname;?> <?php echo $mname;?> <?php echo $lname;?>" id = "name">
                        <input type="hidden" value = "<?php echo $batch;?>" name = "year">
                        <div class="row">
                        <div class="col-sm-3 col-md-4 col-lg-3">
                        <select class="form-control" name="course">
                            <option value="">Select Course</option>
                            <option value="CRS01">CRS01</option>
                            <option value="CRS02">CRS02</option>
                            <option value="CRS03">CRS03</option>
                        </select>
                        </div>
                        <div class="col-sm-3 col-md-4 col-lg-3">
                        <select class="form-control" name="sem">
                            <option value="">Select Semester</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                            <option value="3rd">3rd Semester</option>
                        </select>
                        </div>
                        <div class="col-sm-3 col-md-4 col-lg-3">
                        <input type = "hidden" value ="<?php echo $branch;?>" name="barangay">
                        <select class="form-control" name="status">
                            <option value="student">Student</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Drop-Out">Drop-Out</option>
                        </select>
                        </div>
                        <div class="col-sm-3 col-md-4 col-lg-3">
                        <button class="btn btn-primary float-end" type="submit">Search</button>
                        </div>
                        </div>
                        
                    </form>
        </div>
    </div>
</div>
                    

                    <table class="table table-hover pt-1">
                        <thead class='table-primary'>
                            <tr >
                                <th>STUDENT ID</th>
                                <th>SURNAME</th>
                                <th>FIRSTNAME</th>
                                <th>MIDDLENAME</th>
                                <th>ADDRESS</th>
                                <th>EMAIL ADDRESS</th>
                                <th>CONTACT</th>
                                <th>AGE</th>
                                <th>BIRTHDAY</th>
                                <th>GENDER</th>
                                <th>CIVIL STATUS</th>
                                <th>EDUCATION ATTAINMENT</th>
                                <th>COURSE ID</th>
                                <th>SEMESTER</th>
                                <th>BATCH/YEAR</th>
                                <th>STATUS</th>

                            </tr>
                        </thead>
                           
                    </table>
                            
                    </div>
                     </div>
                     <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary ms-4 d-flex float-end " onclick="printTable()">Print</button>
                                <button class="btn btn-primary d-flex float-end " onclick="downloadExcel()">Download</button>
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

                function printTable() {
            var printContents = document.body.innerHTML;
            var tableContents = document.querySelector('table').outerHTML;
            var userName = document.getElementById("name").value;
            var headDepartment = "Head Department"; // Replace with dynamic department name
            var newWindow = window.open('', '', 'height=800,width=1000');
            newWindow.document.write('<html><head><title>BCLP Report</title></head><body>');
            newWindow.document.write('<h1><center>BCLP Report</center></h1>');
            newWindow.document.write(tableContents);
            newWindow.document.write('<br>');
            newWindow.document.write('<p>' + userName + '</p>');
            newWindow.document.write('<footer>' + headDepartment + '</footer>');
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }

        function downloadExcel() {
            var table = document.querySelector('table');
            var userName = "User Name"; // Replace with actual user name
            var headDepartment = "Head Department"; // Replace with actual department

            var excel = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            excel += '<head><meta charset="UTF-8"><style>table { border-collapse: collapse; } th, td { border: 1px solid black; }</style></head>';
            excel += '<body>';
            excel += '<h1 style="text-align:center;">BCLP Report</h1>';
            excel += '<div>' + table.outerHTML + '</div>';
            excel += '<footer style="text-align:center;">' + userName + '<br>' + headDepartment + '</footer>';
            excel += '</body></html>';

            var blob = new Blob([excel], { type: 'application/vnd.ms-excel' });
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'BCLP_Report.xls';
            link.click();
        }
            </Script>


            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>