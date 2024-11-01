<?php
    session_start(); 

    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'bclp_db';
    
    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    date_default_timezone_set('Asia/Manila');
$timeLog = date("Y-m-d h:i:s");
$batch = date("Y");


    $username = $_SESSION['username']  ;
    $password = $_SESSION['password']  ;
    $isStudent = 'Student';
    $branch = $_SESSION['barangay'];
    $userType = $_SESSION['userType'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


if(isset($_GET['enrolleeId']))
{
    $userid = $_GET['enrolleeId'];

   // $stmt = "Select DISTINCT * from enrollee WHERE branch = '$branch' and enrolleeId = '$userid' and isStudent = 'Enrollee'";
  // $stmt = "Select DISTINCT * from enrollee  INNER JOIN assess_score ON enrollee.enrolleeId = assess_score.assessId  WHERE branch = '$branch' and enrollee.enrolleeId  = '$userid' and isStudent = 'Enrollee'";

   $stmt = "Select *
    FROM enrollee WHERE branch = '$branch' and enrolleeId  = '$userid' and isStudent = 'Enrollee'";

    $result = mysqli_query ($conn,$stmt);

    if (mysqli_num_rows($result)>0)
    {
        foreach( $result as $student)
        {
            $branch =  $student['branch']; echo '<br>'; 
            $sem =  $student['sem']; echo '<br>';
            $courseId = $student['courseId']; echo '<br>';
           $time = $student['time'];echo '<br>';
           $firstname = $student['firstname'];echo '<br>';
           $middlename = $student['middlename'];echo '<br>';
           $lastname = $student['lastname'];echo '<br>';
           $suffix = $student['suffix'];
           $dob = $student['dob']; echo '<br>';
           $age = $student['age']; echo '<br>';
           $sex = $student['sex'];echo '<br>';
           $status = $student['status']; echo '<br>';
           $email = $student['email'];echo '<br>';
           $contact = $student['contact'];echo '<br>';
           $educational = $student['educational']; echo '<br>';
           $barangay = $student['barangay']; echo '<br>';
           $district = $student['district']; echo '<br>';
           $province = $student['province']; echo '<br>';
           $completeAddress = $student['completeAddress']; echo '<br>';
           $score = $student['score']; echo '<br>';;
           $recommend = $student['recommend']; echo '<br>';;
                                                                        
           $conn->query("INSERT INTO student VALUES('','$branch','$sem','$courseId', '$time','$firstname','$middlename','$lastname','$suffix','$dob','$age','$sex','$status','$email','$contact','$educational','$barangay','$district','$province','$completeAddress','$score','$recommend','$batch','Student')");
               

            $query = "UPDATE enrollee SET isStudent = '$isStudent' where enrolleeId = '$userid'";
            $query_run = mysqli_query($conn, $query);

            $query2 = "INSERT INTO activity_log VALUES('','$userid', '$userType','$username','Add Student','$timeLog')";
            mysqli_query($conn, $query2);
        


   
                
                $conn->close();

                header("Location: instructor_manageEnrollees.php?alert=New+Student+Added+successfully+!+!"); 
                exit;
        }
        
    }
}
?>

