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


$person = "SELECT låntagare.Personid FROM låntagare WHERE '$password' = låntagare.Lösenord AND '$username' = låntagare.Namn ";
$perid = $conn->query($person);

if ($perid->num_rows > 0){
    while($row = $perid->fetch_assoc()) { 
        $personid = $row["Personid"];

    }
}

$free_bok = "SELECT bok.ISBN, bok.BokId, lån.lånid FROM bok LEFT JOIN lån ON bok.BokId = lån.BokId";
$res = $conn->query($free_bok);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] == NULL){
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


$free_ebok = "SELECT ebok.ISBN, ebok.eBokId, lån.lånid FROM ebok LEFT JOIN lån ON ebok.eBokId = lån.eBokId";
$res = $conn->query($free_ebok);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] == NULL){
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


$free_film = "SELECT film.ISBN, film.filmId, lån.lånid FROM film LEFT JOIN lån ON film.filmId = lån.filmId";
$res = $conn->query($free_film);
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($row["lånid"] == NULL){
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


if(isset($_POST["lan"])){
    

    if ($way == 1){
        $sql = "INSERT INTO lån (bokid,personid,Datum_för_utlaning,Datum_för_aterlamning) VALUES ('$id', '$personid', '2012-12-03', '2013-01-09')";
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
        $sql = "INSERT INTO lån (ebokid,personid,Datum_för_utlaning,Datum_för_aterlamning) VALUES ('$id', '$personid', '2012-12-03','2013-01-09')";
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
        $sql = "INSERT INTO lån (filmid,personid,Datum_för_utlaning,Datum_för_aterlamning) VALUES ('$id', '$personid', '2012-12-03','2013-01-09')";
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
        echo "oh no". $sql. "<br>". $conn->error;
    }
    
}

?>