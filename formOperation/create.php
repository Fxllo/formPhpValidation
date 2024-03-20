<?php
$name = $surname = $class = $indirizzo = $email = $telefono = "";
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
if (!$conn) {
    header("HTTP/1.1 503 Internal Server Error");
} else {
    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($obj["name"]))
                $name = $obj["name"];
            if ( !empty($obj["surname"]))
                $surname = $obj["surname"];
            if ( !empty($obj["class"]))
                $class = $obj["class"];
            if (!empty($obj["email"]))
                $email = $obj["email"];
            if (!empty($obj["phoneNumber"]))
                $telefono = $obj["phoneNumber"];
        $sql = "INSERT INTO student (name, surname, class, ind, email, phoneNumber) VALUES ('$name', '$surname', '$class', '$indirizzo', '$email', '$telefono')";
        if(mysqli_query($conn, $sql)) {
            echo json_encode(["message" => "Record inserted successfully"]);
        } else {
            echo json_encode(["message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
        }
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
    }
}
?>