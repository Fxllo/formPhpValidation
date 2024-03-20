<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
if(!$conn) 
    header("HTTP/1.1 503 Internal Server Error");
else {
    if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (isset($_GET['id']))  {   
            $id = $_GET['id'];
        }
        $sql = "DELETE FROM student WHERE id=$id";
        if(mysqli_query($conn, $sql)) {
            header("HTTP/1.1 204 No Content");
        }
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
    }
}
?>