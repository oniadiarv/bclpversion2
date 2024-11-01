<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'bclp_db';

 $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
// Delete item from table
$id = $_GET['userid']; // Get the ID of the item to delete
$sql = "DELETE FROM course WHERE courseId = '$id'";
if ($conn->query($sql) === TRUE) {
    echo "Item deleted successfully";
    header("Location: admin_addCourse.php");
} else {
    echo "Error deleting item: " . $conn->error;
}

// Close connection
$conn->close();
?>