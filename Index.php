<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="bibliotek";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    if(!empty($_POST["submit"])){

    }

    if(!empty($_POST["submit2"])){
        
    }

    if(!empty($_POST["submit3"])){
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotek</title>
</head>
<body>
    <form action="Index.php" method="POST">
        Sök efter bok: <input type="text" name="bok">
                       <input type="submit" name="submit"><br>
        Sök efter e-bok: <input type="text" name="ebok">
                         <input type="submit" name="submit2"><br>
        Sök efter film: <input type="text" name="film">
                        <input type="submit" name="submit3"><br>
    </form>
</body>
</html>