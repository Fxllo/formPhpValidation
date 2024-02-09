<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
if (isset($_POST['invio'])) {
    if (!empty($_POST["name"]))
        $name = $_POST["name"];
    if ( !empty($_POST["surname"]))
        $surname = $_POST["surname"];
    if ( !empty($_POST["class"]))
        $class = $_POST["class"];
    if ($_POST["opz"] !== "")
        $indirizzo = $_POST["opz"];
    if (!empty($_POST["email"]))
        $email = $_POST["email"];
    if (!empty($_POST["phoneNumber"]))
        $telefono = $_POST["phoneNumber"];
    if (isset($_FILES["userFile"])) {
        $file = $_FILES["userFile"];
        $fileExt = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowed = array("jpg", "jpeg", "png");
        if(!in_array($fileExt, $allowed)){
            die("Formato non valido");
        }
        $maxSize = 5 * 1024 * 1024;
        if($file["size"] > $maxSize){
            die("File troppo grande, max 5MB");
        }
        $randomString = substr(md5(uniqid()), 0, 10);
        $newFileName = "tmp_" . $randomString;
        $uploadDir = "temp/";
        
    }
    
    $sql = "INSERT INTO student (name, surname, class, ind, email, phoneNumber) VALUES ('$name', '$surname', '$class', '$indirizzo', '$email', '$telefono')";
    mysqli_query($conn, $sql);
}

$html = "
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
        }
        .form-container {
            width: 300px;
            margin: 0 auto;
            padding-top: 50px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        input[type='file'] {
            background-color: white;
            border: 2px solid #ccc;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            cursor: pointer;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href='main.php' class='back-button'>Back to Hub</a>
    <div class='form-container'>
        <form action='create.php' method='post' enctype='multipart/form-data'>
            <input type='text' name='name' placeholder='Name' required>
            <input type='text' name='surname' placeholder='Surname' required>
            <input type='text' name='class' placeholder='Class' required>
            <select name=opz required>
                <option value=''>Seleziona l'indirizzo</option>
                <option value='Informatico'>Informatico</option>
                <option value='Rel. Int.'>Rel. Int.</option>
                <option value='Grafico'>Grafico</option>
                <option value='Scientifico'>Scientifico</option>
            </select>
            <input type='email' name='email' placeholder='Email' required>
            <input type='tel' name='phoneNumber' placeholder='Phone Number' required>
            <input type='file' name='userFile' value='Carica Foto'>
            <input type='submit' name='invio' value='Invia'>
        </form>
    </div>
</body>
</html>";

echo $html;
?>