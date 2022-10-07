<?php      
    include('connection.php');  
    $titel = $_POST['titel'];  
    $genre = $_POST['genre'];  
    $sidor = $_POST['sidor'];  
    $utgivning = $_POST['utgivning'];  
    $isbn = $_POST['isbn'];  
      
        //to prevent from mysqli injection  
        $titel = stripcslashes($titel);  
        $genre = stripcslashes($genre);  
        $sidor = stripcslashes($sidor);  
        $utgivning = stripcslashes($utgivning);  
        $isbn = stripcslashes($isbn);  
        $titel = mysqli_real_escape_string($con, $titel);  
        $genre = mysqli_real_escape_string($con, $genre);  
        $sidor = mysqli_real_escape_string($con, $sidor);  
        $utgivning = mysqli_real_escape_string($con, $utgivning);  
        $isbn = mysqli_real_escape_string($con, $isbn);  

        $sql = "INSERT INTO bok (Titel, Genre, Antal_sidor, Utgivningsar, ISBN) values ('$titel','$genre','$sidor','$utgivning','$isbn')"; 
        $result = mysqli_query($con, $sql);
        
        header("Location: bookAdded.html");
        exit();
?>