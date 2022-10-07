<?php 
    session_start();     
    include('connection.php');  

    if(isset($_POST)){
        $_SESSION['pass'] = $_POST['pass'];
    }
    $username = $_POST['user'];  
    $password = $_SESSION['pass']; 


      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from administratör where Namn = '$username' and Lösenord = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Login successful (Administratör) </center></h1>";  
            header("Location: adminPage.html");
            exit();
        }  
        else{  
            $sql = "select *from låntagare where Namn = '$username' and Lösenord = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if ($count == 1){
                header("Location: Main.php");  
                exit(); 
            } else{
                echo "<h1> Login failed. Invalid username or password.</h1>";  
            }
        }     
?>  