<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotek";
$way = 0;
$id = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "<br>";


$ISBN = $_POST["ISBN"];
$password = $_SESSION['pass'];
$username = $_SESSION['user'];

$person = "SELECT låntagare.Personid FROM låntagare WHERE '$password' = låntagare.Lösenord AND '$username' = låntagare.Namn";
$perid = $conn->query($person);

if ($perid->num_rows > 0){
    while($row = $perid->fetch_assoc()) { 
        $personid = $row["Personid"];

    }
}


$bok = "SELECT bok.ISBN, bok.BokId, lån.lånid FROM bok LEFT JOIN lån ON bok.BokId = lån.BokId";
$res = $conn->query($bok);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] != NULL){
            if ($ISBN == $row["ISBN"]){
                $id = $row["BokId"];
                $way = 1;
                break;
            }
          }

    }
} else {
    echo "big bug";
}

$ebok = "SELECT ebok.ISBN, ebok.eBokId, lån.lånid FROM ebok LEFT JOIN lån ON ebok.eBokId = lån.eBokId";
$res = $conn->query($ebok);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] != NULL){
            if ($ISBN == $row["ISBN"]){
                $id = $row["eBokId"];
                $way = 2;
                break;
            }
        }
        
    }
} else {
    echo "big bug";
}

$film = "SELECT film.ISBN, film.filmId, lån.lånid FROM film LEFT JOIN lån ON film.filmId = lån.filmId";
$res = $conn->query($film);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] != NULL){
            if ($ISBN == $row["ISBN"]){
                $id = $row["filmId"];
                $way = 3;
                break;
            }
        }
    }
} else {
    echo "big bug";
}

echo $way. "<br>";
echo $id. "<br>";
echo $personid. "<br>";


if(isset($_POST["gelan"])){
    

    if ($way == 1){
        $sql = "DELETE FROM lån WHERE $id = lån.Bokid AND $personid = lån.personid";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("overview.php");
            </script>
            <?php
        }
        else{
            echo "fuck det gick fel". $sql. "<br>". $conn->error;
            }
    }
    elseif ($way == 2){
        $sql = "DELETE FROM lån WHERE $id = lån.eBokid AND $personid = lån.personid";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("overview.php");
            </script>
            <?php
        }
        else{
            echo "fuck det gick fel". $sql. "<br>". $conn->error;
            }
    }
    elseif ($way == 3){
        $sql = "DELETE FROM lån WHERE $id = lån.filmId AND $personid = lån.personid";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("overview.php");
            </script>
            <?php
        }
        else{
            echo "fuck det gick fel". $sql. "<br>". $conn->error;
            }
    }
    else{
        echo "oh no";
    }
    
}

?>