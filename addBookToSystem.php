<?php      
    include('connection.php'); 
    $titel = $_POST['titel'];  
    $genre = $_POST['genre'];  
    $sidor = $_POST['sidor'];  
    $utgivning = $_POST['utgivning'];  
    $isbn = $_POST['isbn']; 
    $författare = $_POST['författare'];
    $författare2 = $_POST['författare2'];
    $författare3 = $_POST['författare3'];  

      
        //to prevent from mysqli injection  
        $titel = stripcslashes($titel);  
        $genre = stripcslashes($genre);  
        $sidor = stripcslashes($sidor);  
        $utgivning = stripcslashes($utgivning);  
        $isbn = stripcslashes($isbn);  
        $författare = stripcslashes($författare);  
        $författare2 = stripcslashes($författare2);  
        $författare3 = stripcslashes($författare3);  
        $titel = mysqli_real_escape_string($con, $titel);  
        $genre = mysqli_real_escape_string($con, $genre);  
        $sidor = mysqli_real_escape_string($con, $sidor);  
        $utgivning = mysqli_real_escape_string($con, $utgivning);  
        $isbn = mysqli_real_escape_string($con, $isbn);  
        $författare = mysqli_real_escape_string($con, $författare);
        $författare2 = mysqli_real_escape_string($con, $författare2);
        $författare3 = mysqli_real_escape_string($con, $författare3);

        $sql = "INSERT INTO bok (Titel, Genre, Media, Antal_sidor, Utgivningsar, ISBN) values ('$titel','$genre','Bok','$sidor','$utgivning','$isbn')"; 
        $result = mysqli_query($con, $sql);

        $last_id = $con->insert_id;
        
        $sql = "INSERT INTO connect (Personid, Bokid) values ('$författare','$last_id')"; 
        $result = mysqli_query($con, $sql);
        
        if (!empty($författare2)){
            $sql = "INSERT INTO connect (Personid, Bokid) values ('$författare2','$last_id')"; 
            $result = mysqli_query($con, $sql);
        }

        if (!empty($författare3)){
            $sql = "INSERT INTO connect (Personid, Bokid) values ('$författare3','$last_id')"; 
            $result = mysqli_query($con, $sql);
        }

        header("Location: bookAdded.html");
        exit();
?>