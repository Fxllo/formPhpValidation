<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
$id = $_GET['id'];
$sql = "SELECT * FROM student WHERE id = ". $id . "";

$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$content .= "<tr>";
$content .= "<td>" . $rows[0]["name"] . "</td>"
    . "<td>" . $rows[0]["surname"] . "</td>"
    . "<td>" . $rows[0]["class"] . "</td>"
    . "<td>" . $rows[0]["ind"] . "</td>"
    . "<td>" . $rows[0]["email"] . "</td>"
    . "<td>" . $rows[0]["phoneNumber"] . "</td>"
    . "</tr>";

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
    </style>
    </head>
    <body>
        <center>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Class</th>
                        <th>Indirizzo</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    $content
                </tbody>
            </table>
        </center>
    </body>
";

echo $html; 
?>