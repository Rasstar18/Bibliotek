<?php      
    include('connection.php');  
    $titel = $_POST['titel'];  
    $genre = $_POST['genre'];  
    $playtime = $_POST['playtime'];  
    $utgivning = $_POST['utgivning'];  
    $isbn = $_POST['isbn'];  
      
        //to prevent from mysqli injection  
        $titel = stripcslashes($titel);  
        $genre = stripcslashes($genre);  
        $playtime = stripcslashes($playtime);  
        $utgivning = stripcslashes($utgivning);  
        $isbn = stripcslashes($isbn);  
        $titel = mysqli_real_escape_string($con, $titel);  
        $genre = mysqli_real_escape_string($con, $genre);  
        $playtime = mysqli_real_escape_string($con, $playtime);  
        $utgivning = mysqli_real_escape_string($con, $utgivning);  
        $isbn = mysqli_real_escape_string($con, $isbn);  

        $sql = "INSERT INTO film (Titel, Genre, Speltid, Utgivningsar, ISBN) values ('$titel','$genre','$playtime','$utgivning','$isbn')"; 
        $result = mysqli_query($con, $sql);
        
        header("Location: filmAdded.html");
        exit();
?>