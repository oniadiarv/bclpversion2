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
          .carousel-caption {
        bottom: 200px;
        z-index: 2;
    }

    .carousel-caption h5 {
        font-size: 70px; /* Adjusted font size */
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 25px;
        line-height: 1.2; /* Adjust line height for better spacing */
    }

    .carousel-caption p {
        width: 80%;
        margin: auto;
        font-size: 18px;
        line-height: 1.9;
    }

    @media (max-width: 768px) {
        .carousel-caption h5 {
            font-size: 30; /* Smaller font size for tablets */
        }
    }

    @media (max-width: 576px) {
        .carousel-caption h5 {
            font-size: 15px; /* Even smaller font size for mobile devices */
        }
    }

    .just{
        text-align: justify;
    }

        

        .carousel-inner::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(18, 17, 17, 0.7);
            z-index: 1;
        }

        #card-body {
            background-color: white;
            color: white;
        }

        .rounded {
            width: 50px;
            height: 50px;
            border-radius: 50%
        }
        #tago{
            display: None;
        }
        
        .form-control{
        outline: none;
        -moz-appearance:textfield;
        } 

        .form-control::-webkit-inner-spin-button,
        .form-control::-webkit-outer-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }

        @media (max-width: 991.98px) { /* Target devices with a width of 992px or less */
    .navbar-toggler {
        border-color: transparent; /* Optional: Remove border */
    }
    .navbar-toggler-icon {
        background-image: none; /* Remove default background image */
        width: 30px; /* Set width for the icon */
        height: 30px; /* Set height for the icon */
        position: relative; /* Positioning for pseudo-elements */
    }
    .navbar-toggler-icon:before,
    .navbar-toggler-icon:after {
        content: '';
        display: block;
        width: 100%;
        height: 4px; /* Thickness of the bars */
        background-color: white; /* Set color to white */
        position: absolute;
        left: 0;
        transition: all 0.3s; /* Smooth transition */
    }
    .navbar-toggler-icon:before {
        top: 0; /* Position the first bar */
    }
    .navbar-toggler-icon:after {
        bottom: 0; /* Position the last bar */
    }
    .navbar-toggler-icon:before {
        transform: translateY(15px); /* Adjust spacing */
    }
}

     @media (max-width: 576px) {
        .carousel-item img {
            max-height: 400px;
        }
    } 




    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <img src="static/webimg/logo.png" class="rounded mx-auto d-block me-2" alt="...">
            <a class="navbar-brand text-white" href="#">Barangay Computer Literacy Program</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pe-5 ">
                    <li class="nav-item ">
                        <a class="nav-link text-white" aria-current="page" href="#home">HOME</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-white" aria-current="page" href="#about">ABOUT</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-white" aria-current="page" href="#services">COURSE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact">CONTACT US</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <a class="navbar-brand mr-1" href="/login">
                            <button type="submit" class="btn btn-outline-primary text-white">Login</button>
                        </a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <hr id="home">
    <div class="my-4">
        <p>.</p>
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
    </div>

    <div class="container-fluid">
        <div class="mt-5 w-75 mx-auto" style="width: 50%; height: 100%;">
            <div id="carouselExampleCaptions" class="carousel slide">
                <section></section>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="static/webimg/post11.jpg" class="d-block w-100" style height="650px" alt="...">
                        <div class="carousel-caption">
                            <h5>BARANGAY COMPUTER LITERACY PROGRAM</h5>
                            <p>A Project from City Government of Pasig</p>
                            <p><a href="#about" class="btn btn-warning mt-3">Learn More</a></p>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="static/webimg/pic2.jpg" class="d-block w-100" style height="650px" alt="...">
                        <div class="carousel-caption">
                            <h5>BCLP Graduates</h5>
                            <p>Awarding Certificates of Completion</p>
                            <p><a href="#about" class="btn btn-warning mt-3">Learn More</a></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="static/webimg/post3.jpg" class="d-block w-100 " style height="650px" alt="...">
                        <div class="carousel-caption">
                            <h5>Computer Training</h5>
                            <p>Learn Basic Computer Skills for FREE</p>
                            <p><a href="#services" class="btn btn-warning mt-3">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div id="about">
        <br>
        <br>
    </div>

    <section class="about section-padding my-5">
        <div class="container">
            <div class="col-12 text-center">
                <h2>About Us</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="about-img">
                        <img src="static/webimg/training2.jpg" alt="" class="img-fluid" sizes="30px">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                    <div class="about-text">
                        <h2>The Barangay Computer Literacy Program (BCLP)</h2>
                        <p class="just"> was launched on 19 April 1999 in selected barangays (districts) in Pasig City.
                            The Barangay Computer Literacy Program (BCLP) is a training facility program funded by the
                            City Government of Pasig, under the supervision
                            of BCLP Administrators and computer instructors. Its main objective is to improve computer
                            literacy among the residents of Pasig and to give
                            equal opportunities to the marginalized population of the city helping them learn basic
                            computer skills for free to those who cannot afford
                            private computer lessons. BCLP is available in Pasig and for Pasig residents only.

                            <br><br>
                            Since 1992, BCLP has helped hundreds of thousands of students, employed and unemployed, to
                            learn basic to advanced computer skills for free.
                            Considered as a school-to-work transition programme, BCLP helps beneficiaries to enhance,
                            improve and develop computer skills, enabling them to compete in the digital world.
                            BCLP is available in Pasig and for Pasig residents only. Neighbouring communities may adopt
                            and implement the programme to give equal opportunities and training to
                            those who cannot afford private computer lessons.
                            <br><br>
                            The program runs on a trimester calendar and classes are held for two hours daily, Monday to
                            Friday. Each trimester has three levels:
                        <ul>
                            <ul>Level 1: Basic, Intermediate and Advanced Computer Concepts</ul>
                            <ul>Level 2: Photo and Graphics Enhancement Program</ul>
                            <ul>Level 3: Internet Essentials and Basic Web Page Design</ul>
                        </ul>
                        </p>
                        <p class = "just">
                        The participants are aged between 16 years old up to Senior Citizens, and most of them are
                        unemployed. It encourages the participants to finish the program by awarding
                        certificates of completion. BCLP has helped hundreds of thousands of students, employed and
                        unemployed, to learn basic to advanced computer skills for free. BCLP helps
                        beneficiaries to enhance, improve and develop computer skills, enabling them to compete in the
                        digital world.

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="services">
        <br>
        <br>
        <br>
    </div>

    <div class="container mb-5">
        <div class="card">
            <div id="card-body" class="card-body">
                <section class="services section-padding"></section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-header text-center text-black pb-5">
                                <h2>Our Courses</h2>
                                <p>
                                <p>The program is run and funded by the City Government of Pasig, Its main objective is
                                    to improve computer literacy among the residents of Pasig
                                    and to give equal opportunities to the marginalized population of the city. The
                                    program runs on a trimester calendar and classes are held for two hours daily,
                                    Monday to Friday.</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card text-white text-center bg-white pb-2">
                            <div id="card-body" class="card-body text-dark">
                                <div class="img-area mb-4">
                                    <img src="static/webimg/level1.png" alt="" class="img-fluid">
                                </div>
                                <h3 class="card-title">LEVEL 1</h3>
                                <p>Basic, Intermediate & Advance Computer Concepts</p>
                                <p>Microsoft Office for enrollees without prior knowledge equips them
                                    with essential skills, enhances their employability, increase efficiency,
                                    fosters confidence and independence, facilitates collaboration, promotes
                                    lifelong learning, and provide access to valuable support and resources
                                    for ongoing development.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card text-white text-center bg-white pb-2">
                            <div id="card-body" class="card-body text-dark">
                                <div class="img-area mb-4">
                                    <img src="static/webimg/level2.png" alt="" class="img-fluid">
                                </div>
                                <h3 class="card-title">LEVEL 2</h3>

                                <p>Photo and Graphic Enhancement Program</p>
                                <p>Adobe Photoshop CC (Creative Cloud) offers enrollees
                                    several significant benefits, especially for those involved in
                                    digital design, photography, and creative industries.<br>
                                    Enrolling in Adobe Photoshop CC empowers enrollees with advanced image
                                    editing capabilities, enhances their creative skills and workflow
                                    efficieny, and prepares them to excel in professions that require
                                    proficiency in digital design and photography.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card text-white text-center bg-white pb-2">
                            <div id="card-body" class="card-body text-dark">
                                <div class="img-area mb-4">
                                    <img src="static/webimg/level3.jpg" alt="" class="img-fluid">
                                </div>
                                <h3 class="card-title">LEVEL 3</h3>

                                <p>Internet Essetials & Basic, Webpage Design</p>
                                <p>Internet enhances individuals ability to access information, communicate
                                    effectively, conduct transactions securely, develop skills, and engage meaningfully
                                    in the digital age, contributing to personal growth and professional success.
                                    <br>
                                    learning Webpage design equips enrollees with valuable technical,
                                    creative, and professional skills that are essential for pursuing
                                    careers in digital design, web development, and related fields,
                                    offering opportunities for growth, innovation, and professinal fulfillment.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="button" class="btn btn-warning shadow-lg fs-3" data-bs-toggle="modal"
                    data-bs-target="#enroll">CLICK HERE ! ENROLL NOW !</button>
            </div>
            <div id="contact">
                <br>
                <br>
                <br>
            </div>

        </div>
    </div>


    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-1">
                        <h2>Contact Us</h2>
                        <p>Send us Message</p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                PASIG CITY HALL/BCLP DEPARTMENT - 4th floor BCLP Office
                                <span class="badge text-bg-primary rounded-pill">0915-123-4567</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                BCLP DELA PAZ TRAINING CENTER - 2nd floor Computer Room, Dela Paz brgy. Hall
                                <span class="badge text-bg-primary rounded-pill">0991-985-0336</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                BCLP MANGGAHAN NAPICO TRAINING CENTER - Napico Multipurpose Hall
                                <span class="badge text-bg-primary rounded-pill">0916-123-4567</span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="https://web.facebook.com/profile.php?id=100064005733673" target="_blank">
                            <img src="static/webimg/facebook.png" width="80" height="70" alt="Facebook">
                        </a>
                        <a href="https://www.gmail.com" target="_blank">
                            <img src="static/webimg/gmail.png" width="100" height="70" alt="Gmail">
                        </a>
                        <a href="https://www.yahoo.com" target="_blank">
                            <img src="static/webimg/yahoo.png" width="100" height="70" alt="Yahoo">
                        </a>
                    </div>

                    <br>
                    <br>
                </div>
            </div>
    </section>

    <!-- modal modal -->
    <div class="modal fade" id="enroll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Registration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body">
                    <form id="validationForm" action="/bclp_webpageAssessment" method="POST">
                        <div class="col-12">
    
                        <div class="form-group mb-3">
                                <div class="row">
                                <div class="col-sm-3 col-md-4 col-lg-3"><label for="branch">BCLP Site</label>
                                        <select class="form-control" id="barangay" name="branch" required>
                                            <option value= "">select</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3 col-md-4 col-lg-5"><label for="level">Course</label>
                                        <select class="form-control" id="course" name="level" required>
                                        <option value="">Select Course</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="time">Class Schedule</label>
                                        <select class="form-control" id="time" name="time" required>
                                        <option value="">Select Time</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="sem" name = "sem" readonly>

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
                                        <select class="form-control" id="suffix" name="suffix" required>
                                            <option value=""></option>
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
                                        <small class="form-text text-danger" id="ageError"></small>
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
                                        <input type="number" class="form-control" id="cellphone" name="cellphone" required>
                                        <small class="form-text text-danger" id="cellphoneError"></small>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <h5>Other Details</h5>
                            <hr>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label
                                            for="educationalAttainment">Educational
                                            Attainment</label>
                                        <select class="form-control" id="educationalAttainment"
                                            name="educationalAttainment" required>
                                            <option value=""></option>
                                            <option value="Elementary">Elementary</option>
                                            <option value="Highschool">Highschool</option>
                                            <option value="Senior High School">Senior Highschool</option>
                                            <option value="College">College</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label for="lastSchoolAttended">Last School
                                            Attended</label>
                                        <input type="text" class="form-control" id="lastSchoolAttended"
                                            name="lastSchoolAttended" pattern="[a-zA-Z/]*" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-2"><label for="schoolYear">School Year</label>
                                        <input type="number" class="form-control" id="schoolYear" name="schoolYear" pattern="[0-9]+" required>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-3"><label
                                            for="educationalBackground">Educational
                                            Background</label>
                                        <input type="text" class="form-control" id="educationalBackground"
                                            name="educationalBackground" pattern="[a-zA-Z\s]+" required>
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
                                            <option value="Bagong Ilog">Bagong Ilog</option>
                                            <option value="Bagong Katipunan">Bagong Katipunan</option>
                                            <option value="Bambang">Bambang</option>
                                            <option value="Buting">Buting</option>
                                            <option value="Dela Paz">Dela Paz</option>
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
                                            <option value="San Antonio">San Antonio</option>
                                            <option value="San Joaquin">San Joaquin</option>
                                            <option value="San Jose">San Jose</option>
                                            <option value="San Miguel">San Miguel</option>
                                            <option value="San Nicolas">San Nicolas</option>
                                            <option value="Santa Cruz">Santa Cruz</option>
                                            <option value="Santa Lucia">Santa Lucia</option>
                                            <option value="Santa Rosa">Santa Rosa</option>
                                            <option value="Santo Tomas">Santo Tomas</option>
                                            <option value="Santolan">Santolan</option>
                                            <option value="Sumilang">Sumilang</option>
                                            <option value="Ugong">Ugong</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-4 col-lg-4"><label for="district">District</label>
                                        <select class="form-control" id="district" name="district" required>
                                        <option value=""></option>
                                            <option value="District 1">District 1</option>
                                            <option value="District 2">District 2</option>
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


                        </div>

                        <div class="form-group form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">I Agree on <label class="form-check-label"
                                    for="terms">I
                                    Agree on <a href="#" data-toggle="modal" data-target="#termsModal">Terms &
                                        Conditions</a></label></label>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--terms/condition Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content" style="box-shadow: 0 0 10px rgba(0, 0, 0, 5);">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Terms and Conditions content -->
                    <h5>I. Collection of Personal Information</h5>
                    <p class="just">The BCLP enrollment system respects the privacy of individual's personal information. All
                        data collected during enrollment process including but not limited to name, contact details,
                        and academic records, will be used solely for administrative purposes related to enrollment
                        and academic activities. The system will ensure confidentiality, integrity, and security of
                        all collected data, and will not disclose or share it with any third parties without explicit
                        consent, except as required by law or academic policy. Individuals have the right to access,
                        correct and request deletion of their personal data stored in the system. By using the
                        enrollment system individuals consent to the collection, processing and storage of their
                        personal information in accordance with this privacy policy.</p>
                    <p class="just">Data protection is a matter of trust and your privacy is important to us. We shall therefore
                        only use your name and other information, which relates to you in the manner set out in this
                        Privacy Policy.</p>
                    <h5>II. Use and Disclosure of Personal Information</h5>
                    <p class="just">When you enroll to submit it or otherwise provide us with your personal information through
                        the platform, the personal information we collect may include your: Name, Address, Date of
                        Birth, Age, Sex, Class schedule, contact number, student photo, and educational background
                        that may be used to prevent fraud and help us to provide better services to you.</p>
                    <p class="just">We will only be to collect your personal information if you voluntarily submit the
                        information to us. If you choose not to submit your personal information to us or subsequently
                        withdraw your consent to our use of your personal information, we may not be able to provide
                        you with our services. You may access and update your personal information submitted to us at
                        any time.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end info Modal -->

    <script src="static/jquery/jquery-3.7.1.min.js"></script>
    <script src="static/js/bootstrap2.min.js"></script>
    <script src="static/js/bootstrap.bundle.js"></script>

    
<Script>
      $(document).ready(function() {
            $.getJSON('/get_barangays', function(data) {
                $.each(data, function(index, value) {
                    $('#barangay').append('<option value="' + value[0] + '">' + value[0] + '</option>');
                });
            });

            $('#barangay').change(function() {
                var barangay = $(this).val();
                $('#course').empty().append('<option value="">Select Course</option>');
                $('#time').empty().append('<option value="">Select Time</option>');
                $('#sem').val('');

                $.getJSON('/get_courses/' + barangay, function(data) {
                    $.each(data, function(index, value) {
                        $('#course').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                    });
                });
            });

            $('#course').change(function() {
                var courseId = $(this).val();
                $('#time').empty().append('<option value="">Select Time</option>');
                $('#sem').val('');

                $.getJSON('/get_time/' + courseId, function(data) {
                    $.each(data, function(index, value) {
                        $('#time').append('<option value="' + value[0] + '">' + value[0] + '</option>');
                        $('#sem').val(value[1]);
                    });
                });
            });
        });

        function calculateAge() {
        const dob = new Date(document.getElementById("dob").value);
        const now = new Date();
        const age = Math.floor((now - dob) / (365.25 * 24 * 60 * 60 * 1000));
        document.getElementById("age").value = age;
        }

        document.getElementById('validationForm').addEventListener('submit', function(event) {
            const contactInput = document.getElementById('cellphone').value;
            const ageInput = document.getElementById('age').value;

            // Validate contact number
            const contactPattern = /^09\d{9}$/; // Regex for 11 digits starting with 09
            if (!contactPattern.test(contactInput)) {
                document.getElementById('cellphoneError').innerText = 'Contact number must be 11 digits and start with 09.';
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Validate age
            const age = parseInt(ageInput, 10);
            if (age < 18 || age > 70) {
                document.getElementById('ageError').innerText = 'Age must be between 18 and 70 years.';
                event.preventDefault(); // Prevent form submission
                return;
            }
        });

        
    </script>
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> </script> -->
</body>

</html>
