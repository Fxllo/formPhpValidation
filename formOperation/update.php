<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
$name = $surname = $class = $indirizzo = $email = $phoneNumber = $id = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id = ". $id . "";
    
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $name = $row["name"];
        $surname = $row["surname"];
        $class = $row["class"];
        $indirizzo = $row["ind"];
        $email = $row["email"];
        $phoneNumber = $row["phoneNumber"];
    };
}


$indirizzi = mysqli_query($conn, "SELECT DISTINCT ind FROM student");
$indirizzi = mysqli_fetch_all($indirizzi, MYSQLI_ASSOC);

$options = "";
foreach ($indirizzi as $row) {
    $selected = ($indirizzo == $row['ind']) ? "selected" : "";
    $options .= "<option value='" . $row['ind'] . "' $selected>" . $row['ind'] . "</option>";
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
    }
    
    if ( !empty($_POST["surname"])) {
        $surname = $_POST["surname"];
    }
    
    if ( !empty($_POST["class"])) {
        $class = $_POST["class"];
    }
    
    if ($_POST["opz"] !== ""  || !empty($_POST["opz"])) {
        $indirizzo = $_POST["opz"];
    }

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
    }

    if (!empty($_POST["phoneNumber"]) || !empty($_POST["phoneNumber"])) {
        $phoneNumber = $_POST["phoneNumber"];
    }

    $sql = "UPDATE student SET name ='$name', surname='$surname', class='$class', ind='$indirizzo', email='$email', phoneNumber='$phoneNumber' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: main.php");
        exit;
    } else {
        echo "Errore durante l'eliminazione del record: " . mysqli_error($conn);
    }
}

$html = "
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    table {
        width: 70%;
        border-collapse: collapse;
        margin-top: 30px;
        margin-bottom: 10px;
        margin-left: auto;
        margin-right: auto;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 5px;
    }

    th {
        background-color: #f2f2f2;
    }

    .select {
        width: 29%;
        text-align: center;
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit], input[type=button] {
        width: 45%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 2.5%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover, input[type=button]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<form action=update.php method=POST>
<input type=hidden name=id value=$id>
    <table>
        <tr>
            <td>
                <input type=text name=name value=$name> Name
            </td>
            <td>
                <input type=text name=surname value=$surname> Surname
            </td>
            <td>
                <input type=text name=class value=$class> Class
            </td>
            <td>
                <select name=opz>
                    <option value=$indirizzo></option>
                    $options
                </select>
                Indirizzo
            </td>   
            <td>
                <input type=text name=email value=$email> Email
            </td>
            <td>
                <input type=text name=phoneNumber value=$phoneNumber> Phone Number
            </td>
        </tr>
    </table>
    <center>
        <input type=submit name=update value=Update>
    </center>
</form>
</body>
</html>";

echo $html;
?>