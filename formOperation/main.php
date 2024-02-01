<?php
$name = $surname = $class = $indirizzoFilter = $content = "";
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
$sql = "SELECT * FROM student WHERE 1 = 1";

if(isset($_POST["search"])){
    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
        $sql .= " AND name LIKE '%$name%'";
    }
    if (!empty($_POST["surname"])) {
        $surname = $_POST["surname"];
        $sql .= " AND surname LIKE '%$surname%'";
    }
    if (!empty($_POST["class"])) {
        $class = $_POST["class"];
        $sql .= " AND class LIKE '%$class%'";
    }
    if ($_POST["opz"] !== "ko") {
        $indirizzoFilter = $_POST["opz"];
        $sql .= " AND ind = '$indirizzoFilter'";
    }
}

$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($rows as $row) {
    $content .= "<tr>";
    $content .= "<td>" . $row["name"] . "</td>"
        . "<td>" . $row["surname"] . "</td>"
        . "<td>" . $row["class"] . "</td>"
        . "<td>" . $row["ind"] . "</td>"
        . "<td class='select'> <a href='details.php?id=" . $row['id'] . "' target='_blank' class='selectButton'>Details</a> 
                <a href='update.php?id=" . $row['id'] . "' target='_blank' class='selectButton'>Update</a>
                <a href='main.php?id=" . $row['id'] . "' class='selectButton' id='confirmDelete'>Delete</a>
        </td>";
};

if(isset($_POST['clear'])){ $name = $surname = $class = $indirizzoFilter = ""; }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM student WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Errore durante l'eliminazione del record: " . mysqli_error($conn);
    }
}

$indirizzi = mysqli_query($conn, "SELECT DISTINCT ind FROM student");
$indirizzi = mysqli_fetch_all($indirizzi, MYSQLI_ASSOC);

$options = "";
foreach ($indirizzi as $row) {
    $selected = ($indirizzoFilter == $row['ind']) ? "selected" : "";
    $options .= "<option value='" . $row['ind'] . "' $selected>" . $row['ind'] . "</option>";
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
        float: left;
    }

    input[type=submit]:hover, input[type=button]:hover {
        background-color: #45a049;
    }

    .selectButton {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .selectButton:hover {
        color: #5C6BC0;
        background-color: #f0f0f0;
    }

    .clearForm {
        width: 100%;
        background-color: #f44336;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: left;
        user-select: none;
    }
    .clearForm:hover {
        background-color: #d32f2f;
    }

    #confirmDiv {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    #confirmContent {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        text-align: center;
    }

    #yesButton, #noButton {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 2.5%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
</head>
<form action=main.php method=POST>
    <button name=clear class=clearForm>Clear Form</button>
    <table>
        <tr>
            <th>
                <input type=text name=name value=$name> Name
            </th>
            <th>
                <input type=text name=surname value=$surname> Surname
            </th>
            <th>
                <input type=text name=class value=$class> Class
            </th>
            <th>
                <select name=opz>
                    <option value=ko></option>
                    $options
                </select>
                Indirizzo
            </th>
        </tr>
        $content
    </table>
    <div id='footer'>
        <input type=submit name=search value=Search>
        <a href='create.php'><input type=button name=invio value=New></a>
    </div>
</form>
</html>";

echo $html;
?>