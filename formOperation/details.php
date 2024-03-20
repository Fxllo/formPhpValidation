<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
if(!$conn) {
    header("HTTP/1.1 503 Internal Server Error");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $sql = "SELECT * FROM student WHERE id = ". $id . "";
        
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $json = json_encode($rows);
        echo $json;
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
    }
}
?>