<?php      
    include('connection.php'); 
    $name = $_POST['name'];

    //to prevent from mysqli injection  
    $name = stripcslashes($name);
    $name = mysqli_real_escape_string($con, $name);

    $sql = "INSERT INTO skapare (Namn) values ('$name')"; 
    $result = mysqli_query($con, $sql);

    header("Location: creatorAdded.html");
    exit();
?>