<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "bclp_db";
$conn = mysqli_connect($host,$user,$password,$db);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedule data based on schedId
if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
    $sql = "SELECT * FROM student WHERE studentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
    $stmt->close();
}

$conn->close();
?>
