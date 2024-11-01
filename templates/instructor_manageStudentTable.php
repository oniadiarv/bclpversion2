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
                <a href="/instructor_manageStudentTable" class="sidebar-link">
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
                        <a class="navbar-brand ms-3 text-white " href="#">Barangay  <?php echo $branch?> Computer Literacy Program</a>

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
                  <li class="breadcrumb-item active" aria-current="page">Manage Enrollee's</li>
                </ol>
                </nav>
            
                <div class="card shadow-lg p-3 mb-1 bg-body-tertiary rounded">
                    <div class="card-body bg-white text-black ">
                        <form method = "post">
                            <div class="col-12">
                                  <div class="row">
                                    <div class = "col-6"></div>
                                        <div class="col-sm-2 col-md-4 col-lg-2">
                                                <select class="form-control" id="sem" name="sem" required>
                                                <option value=""></option>
                                                    <option value="1st">1st sem</option>
                                                    <option value="2nd">2nd sem</option>
                                                    <option value="3rd">3rd sem</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2 col-md-4 col-lg-2">
                                                <select class="form-control" id="course" name="course" required>
                                                <option value=""></option>
                                                    <option value="CRS01">Course 1</option>
                                                    <option value="CRS02">Course 2</option>
                                                    <option value="CRS03">Course 3</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 col-md-2 col-lg-2">
                                            <button type="submit" name = "search" class="btn btn-primary"  style="width:100%"> SEARCH</button>
                                            </div>
                                            <input type="hidden" name="year" placeholder="Year" value = "<?php echo $year?>" required>
                                            <input type="hidden" name="barangay" placeholder="Barangay" value = "<?php echo $branch?>" required>
                                    </div>
                                </div>
                            </form>
                            <canvas id="myChart" width="400" height="100"></canvas>
                        </div>
                    </div>

                    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body bg-white text-black ">
                    <div class="table-responsive"> 
                    <table id="myTable" class="table table-hover pt-1 ">
                        <thead class='table-primary'>
                            {% for row in Student%}
                            <tr >
                              
                                <th>Course</th>
                                <th>Time</th>
                                <th>Semester</th>
                                <th>Name</th>

                                <th>Sex</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Need to Improve</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tr>
                            
                            <td>
                                <?= {{row.studentId}}?>
                            </td>
                            <td>
                                <?= $allStudent['time']?>
                            </td>
                            <td>
                                <?= $allStudent['sem']?>
                            </td>
                           
                            <td>
                                <?= $allStudent['firstname']?> <?= $allStudent['middlename']?> <?= $allStudent['lastname']?> <?= $allStudent['suffix']?>
                            </td>
                            <td>
                                <?= $allStudent['sex']?>
                            </td>
                            <td>
                                <?= $allStudent['email']?>
                            </td>
                            <td>
                                <?= $allStudent['contact']?>
                            </td>
                            <td>
                                <?= $allStudent['recommend']?>
                            </td>

                            <td>
                                    <a href="#?studentId=<?= $allStudent['studentId']; ?>" style="width:100%" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#editStudent" data-studentId="<?= $allStudent['studentId']; ?>">View</a>
                            </td>
                        </tr>

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
     <!-- edit Modal -->
   <div class="modal fade" id="editStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Student Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body">
                    <form id="editStudentForm">
                        <div class="col-12">
 
                        <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="branch">Semester:</label>
                                    <input type="text" class="form-control" id="sem" name="sem" readonly>
                                    </div>

                                    <div class="col-sm-3 col-md-4 col-lg-5"><label for="level">Course</label>
                                        <input type="text" class="form-control" id="course" name="level" readonly>
                                      
                                    </div>

                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="time">Class Schedule</label>
                                        <input type="text" class="form-control" id="time" name="time" readonly>
                                      
                                    </div>

                                </div>
                            </div>
                            
                            <hr>

                            <div class="form-group  mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-3">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName"
                                            pattern="[a-zA-Z\s]+" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-3">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName"
                                            pattern="[a-zA-Z\s]+" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-3">
                                        <label for="middleName">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middleName"
                                            pattern="[a-zA-Z\s]+" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-2">
                                        <label for="suffix">Suffix</label>
                                        <select class="form-control" id="suffix" name="suffix">
                                            <option value=" "></option>
                                            <option value="Jr">Jr.</option>
                                            <option value="Sr">Sr.</option>
                                            <option value="Ma">Ma.</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" onchange="calculateAge()" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-2"><label for="age">Age</label>
                                        <input type="text" class="form-control" id="age" name="age" readonly>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-2"><label for="sex">Sex</label>
                                        <select class="form-control" id="sex" name="sex" required>
                                        <option value=""></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-2"><label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                        <option value=""></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="cellphone">Cellphone</label>
                                        <input type="number" class="form-control" id="cellphone" name="cellphone"required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label
                                            for="educationalAttainment">Educational
                                            Attainment</label>
                                        <select class="form-control" id="educationalAttainment"
                                            name="educationalAttainment" required>
                                            <option value=""></option>
                                            <option value="Elementary">Elementary</option>
                                            <option value="Highschool">Highschool</option>
                                            <option value="SeniorHighschool">Senior Highschool</option>
                                            <option value="College">College</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <h5>Address</h5>
                            <hr>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="barangay">Barangay</label>
                                        <select class="form-control" id="barangay" name="barangay" required>
                                        <option value=""></option>
                                            <option value="BagongIlog">Bagong Ilog</option>
                                            <option value="BagongKatipunan">Bagong Katipunan</option>
                                            <option value="Bambang">Bambang</option>
                                            <option value="Buting">Buting</option>
                                            <option value="DelaPaz">Dela Paz</option>
                                            <option value="Kalawaan">Kalawaan</option>
                                            <option value="Kapasigan">Kapasigan</option>
                                            <option value="Kapitolyo">Kapitolyo</option>
                                            <option value="Malinao">Malinao</option>
                                            <option value="Manggahan">Manggahan</option>
                                            <option value="Maybunga">Maybunga</option>
                                            <option value="Oranbo">Oranbo</option>
                                            <option value="Palatiw">Palatiw</option>
                                            <option value="Pinagbuhatan">Pinagbuhatan</option>
                                            <option value="Pineda">Pineda</option>
                                            <option value="Rosario">Rosario</option>
                                            <option value="Sagad">Sagad</option>
                                            <option value="SanAntonio">San Antonio</option>
                                            <option value="SanJoaquin">San Joaquin</option>
                                            <option value="SanJose">San Jose</option>
                                            <option value="SanMiguel">San Miguel</option>
                                            <option value="SanNicolas">San Nicolas</option>
                                            <option value="SantaCruz">Santa Cruz</option>
                                            <option value="SantaLucia">Santa Lucia</option>
                                            <option value="SantaRosa">Santa Rosa</option>
                                            <option value="SantoTomas">Santo Tomas</option>
                                            <option value="Santolan">Santolan</option>
                                            <option value="Sumilang">Sumilang</option>
                                            <option value="Ugong">Ugong</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="district">District</label>
                                        <select class="form-control" id="district" name="district" required>
                                        <option value=""></option>
                                            <option value="District1">District 1</option>
                                            <option value="District2">District 2</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="province">City</label>
                                        <input type="text" class="form-control" id="province" name="province" pattern="[a-zA-Z\s]+" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="completeAddress">House # / Street</label>
                                <input type="text" class="form-control" id="completeAddress" name="completeAddress" pattern="[a-zA-Z0-9/-/.]*" required>
                            </div>

                            <div class="form-group mb-3 col-sm-3 col-md-4 col-lg-4">
                                <label for="isStudent">Status:</label>
                                <select class="form-control" id="isStudent" name="isStudent" required>
                                        <option value="Student">Select Status</option>
                                            <option value="Graduate">Graduate</option>
                                            <option value="Drop-Out">Drop-Out</option>
                                        </select>
                            </div>


                        </div>

                        <input type="hidden" id="studentId" name="studentId">


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name = "update" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

<!-- end of edit Modal -->

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

        function calculateAge() {
        const dob = new Date(document.getElementById("dob").value);
        const now = new Date();
        const age = Math.floor((now - dob) / (365.25 * 24 * 60 * 60 * 1000));
        document.getElementById("age").value = age;
        }



    $(document).ready(function() {
        $('#editStudent').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var studentId = button.data('studentid'); // Extract info from data-* attributes
            
            // Update the modal's content
            var modal = $(this);
            modal.find('#studentId').val(studentId);
            
            // AJAX call to fetch student data
            $.ajax({
                url: 'instructor_manageStudentTable_fetch.php', // The PHP file that fetches data
                type: 'GET',
                data: { studentId: studentId },
                success: function(response) {
                    var data = JSON.parse(response);
                    modal.find('#sem').val(data.sem);
                    modal.find('#course').val(data.courseId);
                    modal.find('#time').val(data.time);
                    modal.find('#lastName').val(data.lastname);
                    modal.find('#firstName').val(data.firstname);
                    modal.find('#middleName').val(data.middlename);

                    modal.find('#suffix').val(data.suffix);
                    modal.find('#dob').val(data.dob);
                    modal.find('#age').val(data.age);
                    modal.find('#sex').val(data.sex);
                    modal.find('#status').val(data.status);
                    modal.find('#cellphone').val(data.contact);
                    modal.find('#email').val(data.email);
                    modal.find('#educationalAttainment').val(data.educational);

                    modal.find('#barangay').val(data.barangay);
                    modal.find('#district').val(data.district);
                    modal.find('#province').val(data.province);
                    modal.find('#completeAddress').val(data.completeAddress);
                    modal.find('#isStudent').val(data.isStudent);
                    

                }
            });
        });
    });

    const ctx = document.getElementById('myChart').getContext('2d');
        const labels = <?php echo json_encode(array_keys($graphData)); ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Recommendations Graph',
                data: <?php echo json_encode(array_values($graphData)); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 5,
                fill: false
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const myChart = new Chart(ctx, config);
            </Script>


            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>