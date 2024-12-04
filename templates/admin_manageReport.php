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
                <a href="/admin_manageReport" class="sidebar-link">
                <i class="fas fa-print"></i>
                    <span>See all Reports</span>
                </a>
            </li>

                <li class="sidebar-item">
                    <a href="/admin_notification" class="sidebar-link">
                        <i class="fas fa-envelope"></i>
                        <span>Notification</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin_setting" class="sidebar-link">
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
                  <li class="breadcrumb-item"><a href="/admin_dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Reports</li>
                </ol>
                </nav>
                    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="col-12 mb-2">
    <div class="row">
        <div class="col-12">
        <form method="POST" action="{{ url_for('search_admin_manageReport') }}">
                        <div class="row">
                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <select class="form-control" id = "course" name="course">
                            <option value="">Select Course</option>
                        </select>
                        </div>

                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <select class="form-control" name="sem">
                            <option value="">Select Semester</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                            <option value="3rd">3rd Semester</option>
                        </select>
                        </div>

                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <select class="form-control" name="status">
                            <option value="student">Student</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Drop-Out">Drop-Out</option>
                        </select>
                        </div>

                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <select class="form-control" id = "branch" name="branch">
                            <option value="">Select Site</option>
                        </select>
                        </div>

                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <input type="text" class="form-control" id="batch" name="batch" placeholder="Year" required>
                        </div>

                        <div class="col-sm-3 col-md-4 col-lg-2">
                        <button class="btn btn-primary float-end" type="submit">Search</button>
                        </div>
                        </div>
                        
                    </form>
        </div>
    </div>
</div>
                <div class="card-body bg-white text-black ">
                  <div class="table-responsive">
                    {% if results %}
                        <table class="table table-hover pt-1" id="dataTable">
                            <thead class='table-primary'>
                                <tr >
                                    <th>Name</th>
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
                                </tr>
                            </thead>
                            {% for row in results %}
                            <tr>
                            <input type="text" value = "{{ row[1] }}" id = "myBarangay">
                                <td> {{ row[5] }} {{ row[6] }} {{ row[7] }}</td>
                                <td> {{ row[19] }} {{ row[16] }} {{ row[18] }}</td>
                                <td> {{ row[13] }}</td>
                                <td> {{ row[14] }}</td>
                                <td> {{ row[10] }}</td>
                                <td> {{ row[9] }}</td>
                                <td> {{ row[11] }}</td>
                                <td> {{ row[12] }}</td>
                                <td> {{ row[15] }}</td>
                                <td> {{ row[3] }}</td>
                                <td> {{ row[2] }}</td>
                                <td> {{ row[22] }}</td>
                            </tr>
                            {% endfor %}
                        </table>
                        {% endif %}  
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
            <script src="static/jquery/jquery-3.7.1.min.js"></script>
            <script src="static/js/bootstrap.bundle.js"></script>
            <script src="static/DataTables/jquery.dataTables.min.js"></script>


            <Script>
                const toggler = document.querySelector(".toggler-btn");
                toggler.addEventListener("click", function () {
                    document.querySelector("#sidebar").classList.toggle("collapsed");
                });
                
                function printTable() {
                    // Get the table element
                    var table = document.getElementById("dataTable").outerHTML;
                    var myBarangay = document.getElementById("myBarangay").value;
                    // Create a new window
                    var newWindow = window.open('', '', 'height=600,width=800');
                    
                    // Write the HTML for the new window
                    newWindow.document.write('<html><head><title>Print Table</title>');
                    newWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
                    newWindow.document.write('</head><body>');
                    newWindow.document.write('<h1 class="text-center">Barangay ' + myBarangay+' Reports</h1>'); // Header for printing
                    newWindow.document.write(table);
                    newWindow.document.write('</body></html>');
                    
                    // Close the document to render the content
                    newWindow.document.close();
                    
                    // Wait for the content to load before printing
                    newWindow.onload = function() {
                        newWindow.print();
                        newWindow.close();
                    };
                }

                function downloadExcel() {
                    var table = document.querySelector('table');
                    var myBarangay = document.getElementById("myBarangay").value;
                    var excel = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
                    excel += '<head><meta charset="UTF-8"><style>table { border-collapse: collapse; } th, td { border: 1px solid black; }</style></head>';
                    excel += '<body>';
                    excel += '<h1><center> Barangay' + ' ' +myBarangay+ ' '+ 'Report </center></h1>';
                    excel += '<div>' + table.outerHTML + '</div>';
                    excel += '</body></html>';

                    var blob = new Blob([excel], { type: 'application/vnd.ms-excel' });
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'BCLP_Report.xls';
                    link.click();
                }

                $(document).ready(function() {
                    $.getJSON('/admin_get_course', function(data) {
                        $.each(data, function(index, value) {
                            $('#course').append('<option value="' + value[0] + '">' + value[0] + '</option>');
                        });
                    });
                })

                $(document).ready(function() {
                    $.getJSON('/admin_get_site', function(data) {
                        $.each(data, function(index, value) {
                            $('#branch').append('<option value="' + value[0] + '">' + value[0] + '</option>');
                        });
                    });
                })
            </Script>


            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
</body>

</html>
