<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="static/css/style.css">
   <style>
      #card-body {
            background-color: white;
            color: white;
        }
   </style>
</head>
<body> 
    <div class="container">
        <div class="container text-center my-4">
            <h1>Assessment Test</h1>
        </div>
        <div class="card shadow-lg bg-body-tertiary rounded">
            <div id = "card-body" class="card-body text-black">
            <form action="/bclp_webpageSave" method="POST">
            {% for question in questions %}
            <div>
                <h5>{{ question[1] }}</h5>
            </div>
            <div class="row mb-2">
                <div class="col-3 col-sm-2 ms-5">
                  <h5><input class="form-check-input" type="radio" name="question_{{ question[0] }}" value="yes" required> Yes</h5>
                 </div> 
                 <div class="col-3 col-sm-2 ms-5">
                 <h5><input class="form-check-input" type="radio" name="question_{{ question[0] }}" value="no" required> No</h5>
                </div>
            </div>
        {% endfor %}

                    <input type="hidden" name="branch" value="{{branch}}">
                    <input type="hidden" name="level" value="{{course}}">
                    <input type="hidden" name="time" value="{{time}}">
                    <input type="hidden" name="sem" value="{{sem}}">

                    <input type="hidden" name="lastName" value="{{lastName}}">
                    <input type="hidden" name="firstName" value="{{firstName}}">
                    <input type="hidden" name="middleName" value="{{middleName}}">
                    <input type="hidden" name="suffix" value="{{suffix}}">
                    <input type="hidden" name="dob" value="{{dob}}">
                    <input type="hidden" name="age" value="{{age}}">
                    <input type="hidden" name="sex" value="{{gender}}">
                    <input type="hidden" name="status" value="{{status}}">

                    <input type="hidden" name="tawag" value="{{numero}}"> 
                    <input type="hidden" name="email" value="{{email}}">
                    <input type="hidden" name="educationalAttainment" value="{{education}}">
                    <input type="hidden" name="lastSchoolAttended" value="{{lastSchoolAttended}}">
                    <input type="hidden" name="schoolYear" value="{{schoolYear}}">
                    <input type="hidden" name="educationalBackground" value="{{educationalBackground}}">
                    <input type="hidden" name="barangay" value="{{barangay}}">
                    <input type="hidden" name="district" value="{{district}}">
                    <input type="hidden" name="province" value="{{province}}">
                    <input type="hidden" name="completeAddress" value="{{completeAddress}}">
              
                 <input type="hidden" name="totalquestion" value="{{ questions|length }}">
                <div class="float-end">
                    <button type="submit" class="btn btn-primary" name="submit_answers">Submit Answers</button>
                </div>
                
            </form>
            </div>
        </div>
    </div>


<script src="static/jquery/jquery-3.7.1.min.js"></script>
    <script src="static/js/bootstrap2.min.js"></script>
    <script src="static/js/bootstrap.bundle.js"></script>

</body>
</html>
