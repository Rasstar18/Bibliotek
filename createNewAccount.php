<?php      
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
    $adress = $_POST['adress'];  
    $telefon = $_POST['telefon'];  
    $email = $_POST['email'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $adress = stripcslashes($adress);  
        $telefon = stripcslashes($telefon);  
        $email = stripcslashes($email);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
        $adress = mysqli_real_escape_string($con, $adress);  
        $telefon = mysqli_real_escape_string($con, $telefon);  
        $email = mysqli_real_escape_string($con, $email);  

        $sql = "INSERT INTO låntagare (Namn, Adress, Telnr, email, Lösenord) values ('$username','$adress','$telefon','$email','$password')"; 
        $result = mysqli_query($con, $sql);
        
        header("Location: accountCreated.html");
        exit();
?>
