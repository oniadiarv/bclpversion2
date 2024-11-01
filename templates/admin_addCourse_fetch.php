
<?php
// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'bclp_db';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Fetch schedule data based on schedId
if (isset($_GET['schedId'])) {
    $schedId = $_GET['schedId'];
    $sql = "SELECT courseLvl FROM course WHERE courseId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $schedId);
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
