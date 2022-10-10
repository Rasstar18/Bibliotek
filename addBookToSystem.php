<?php      
    include('connection.php'); 
    $titel = $_POST['titel'];  
    $genre = $_POST['genre'];  
    $sidor = $_POST['sidor'];  
    $utgivning = $_POST['utgivning'];  
    $isbn = $_POST['isbn']; 
    $författare = $_POST['författare'];  
      
        //to prevent from mysqli injection  
        $titel = stripcslashes($titel);  
        $genre = stripcslashes($genre);  
        $sidor = stripcslashes($sidor);  
        $utgivning = stripcslashes($utgivning);  
        $isbn = stripcslashes($isbn);  
        $författare = stripcslashes($författare);  
        $titel = mysqli_real_escape_string($con, $titel);  
        $genre = mysqli_real_escape_string($con, $genre);  
        $sidor = mysqli_real_escape_string($con, $sidor);  
        $utgivning = mysqli_real_escape_string($con, $utgivning);  
        $isbn = mysqli_real_escape_string($con, $isbn);  
        $författare = mysqli_real_escape_string($con, $författare);

        $sql = "INSERT INTO bok (Titel, Genre, Media, Antal_sidor, Utgivningsar, ISBN) values ('$titel','$genre','Bok','$sidor','$utgivning','$isbn')"; 
        $result = mysqli_query($con, $sql);

        if ($con->query($sql) === TRUE){
            $last_id = $con->insert_id;
        }
        $sql = "INSERT INTO connect (Personid, Bokid) values ('$författare','$last_id')"; 
        $result = mysqli_query($con, $sql);
        
        header("Location: bookAdded.html");
        exit();
?>