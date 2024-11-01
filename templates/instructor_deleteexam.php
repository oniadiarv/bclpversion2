<?php
//Get Heroku ClearDB connection information
$host = "localhost";
$user = "root";
$password = "";
$db = "bclp_db";
$conn = mysqli_connect($host,$user,$password,$db);
// Delete item from table
$id = $_GET['userid']; // Get the ID of the item to delete
$sql = "DELETE FROM questions WHERE questionId = '$id'";
if ($conn->query($sql) === TRUE) {
    echo "Item deleted successfully";
    header("Location: instructor_exam.php");
} else {
    echo "Error deleting item: " . $conn->error;
}

// Close connection
$conn->close();
?>
