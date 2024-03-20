<?php
$name = $surname = $class = $indirizzo = $email = $phoneNumber = $id = "";
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");

if (!$conn) {
    header("HTTP/1.1 503 Internal Server Error");
} else {
    $json = file_get_contents('php://input');
    $_PUT = json_decode($json, true);

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        if (!empty($_PUT["name"]))
            $name = $_PUT["name"];
        
        if ( !empty($_PUT["surname"])) 
            $surname = $_PUT["surname"];
        
        if ( !empty($_PUT["class"]))
            $class = $_PUT["class"];
    
        if (!empty($_PUT["email"]))
            $email = $_PUT["email"];
    
        if (!empty($_PUT["phoneNumber"]))
            $phoneNumber = $_PUT["phoneNumber"];

        $sql = "UPDATE student SET name ='$name', surname='$surname', class='$class', ind='$indirizzo', email='$email', phoneNumber='$phoneNumber' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["message" => "Record updated successfully"]);
        } else
            echo json_encode(["message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
    }  else {
        header("HTTP/1.1 405 Method Not Allowed");
    }
}
?>