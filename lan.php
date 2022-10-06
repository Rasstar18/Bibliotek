<?php
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

echo $way;

if(isset($_POST["lan"])){
    
    $personid = $_POST["personid"];

    if ($way == 1){
        $sql = "INSERT INTO lån (bokid,personid,Datum_for_utlaning,Datum_for_aterlamning) VALUES ('$id', '$personid', '2012-12-03', '2013-01-09')";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("index.php");
            </script>
            <?php
        }
        else{
            echo "fuck det gick fel". $sql. "<br>". $conn->error;
            }
    }
    elseif ($way == 2){
        $sql = "INSERT INTO lån (ebokid,personid,datum_for_utlaning,datum_for_aterlamning) VALUES ('$id', '$personid', '2012-12-03','2013-01-09')";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("index.php");
            </script>
            <?php
        }
        else{
            echo "fuck det gick fel". $sql. "<br>". $conn->error;
            }
    }
    elseif ($way == 3){
        $sql = "INSERT INTO lån (filmid,personid,datum_for_utlaning,datum_for_aterlamning) VALUES ('$id', '$personid', '2012-12-03','2013-01-09')";
        if ($conn->query($sql)===TRUE){
            ?>
            <script>
                location.replace("index.php");
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