<?php
 session_start(); 
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "bclp_db";
    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d h:i:s"); 

    $con = mysqli_connect($host,$user,$password,$db); 
    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d h:i:s"); 
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];

    function generate_id() {
        global $con;
        $sql = "SELECT MAX(courseId) AS max_courseId FROM course";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $max_id = $row['max_courseId'];
        if ($max_id == null) {
            $courseid = "CRS01";
        } else {
            $courseid = substr($max_id, 0, 3). str_pad(substr($max_id, 3) + 1, 2, '0', STR_PAD_LEFT);
        }
        return $courseid;
    }

    function save_course($courseid, $level, $title, $desc) {
        global $con;
        $sql = "INSERT INTO course (courseId, courseLvl, courseTitle, courseDesc) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $courseid, $level, $title, $desc);
        $stmt->execute();

        
    }

    
 
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $level = $_REQUEST['level'];
      $title = $_REQUEST['title'];
      $desc = $_REQUEST['desc'];
      $courseid = generate_id();
      save_course($courseid, $level, $title, $desc);
      echo "Course saved successfully!";
      $_SESSION['message'] = "New Data Inserted Successfully!";
      header("Location: admin_addCourse.php");
      

    }

    
?>
