<?php
$conn = mysqli_connect("localhost", "root", "", "formOperationPhp");
if (isset($_GET['yesButton'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM student WHERE id=$id";
    if(mysqli_query($conn, $sql)) {
        header("Location: main.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else if (isset($_GET['noButton'])) {
    header("Location: main.php");
    exit;
}

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .confirm {
            color: white;
            border: none;
            cursor: pointer;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
        }
        .confirm[name="yesButton"] {
            background-color: #4CAF50; 
            border: none;
        }
        .confirm[name="yesButton"]:hover {
            background-color: #45a049;
        }
        .confirm[name="noButton"] {
            background-color: #f44336; 
            border: none;
        }
        .confirm[name="noButton"]:hover {
            background-color: #da190b;
        }
        .containerResponde {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100wh;
        }
    </style>
</head>
<body>
    <center>
    <h1>Are you sure you want to delete this record?</h1>
    <div class="containerResponde">
        <form action="delete.php" method="get">
            <input type="hidden" name="id" value=' . $_GET['id'] . '>
            <input type="submit" class="confirm" name="yesButton" value="Yes">
        </form>
        <form action="main.php" method="get">
            <input type="submit" class="confirm" name="noButton" value="No">
        </form>
    </div>
</center>
</body>
</html>';

echo $html;
?>