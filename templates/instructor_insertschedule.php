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

$username = $_SESSION['username']  ;
$password = $_SESSION['password']  ;
$userType = $_SESSION['userType'];


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $userid = $_POST['userid'];
    $courseId = $_POST['courseId'];
    $course = $_POST['courseTitle'];
    $time = $_POST['time'];
    $day = $_POST['day'];
    
    $sem = $_POST['sem'];
    $status = $_POST['status'];
    

    $sql = "INSERT INTO schedule VALUES ('','$userid','$courseId','$course','$time','$day','$sem','$status')";
    $conn->query($sql);

    $query = "INSERT INTO activity_log VALUES('','$userid', '$userType', '$username','Add Schedule','$timeLog')";
    mysqli_query($conn, $query);

    header("Location: ".$_SERVER["PHP_SELF"]);
    echo "Course saved successfully!";
      header("Location: instructor_schedule.php ?alert=Schedule+added+successfully+!+!");
    exit;

}


?>