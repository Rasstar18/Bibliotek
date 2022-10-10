<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotek";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<br>";
echo "<br>";
echo "<br>";

$password = $_SESSION['pass'];

$person = "SELECT låntagare.Personid FROM låntagare WHERE '$password' = låntagare.Lösenord";
$perid = $conn->query($person);

if ($perid->num_rows > 0){
    while($row = $perid->fetch_assoc()) { 
        $personid = $row["Personid"];

    }
}



?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "lon.css">  
    <title>bibliotek</title>
</head>
<body>
    <div id="sokida">
        <a id="sok" href="Main.php">tillback till söksida</a>
    </div> 

    <div id = "rak">
      <?php
      echo "Antal boker ";
      echo "<br>";
      $clac = "SELECT bok.titel, bok.ISBN, COUNT(*) FROM bok GROUP BY bok.ISBN";   
      $rescalc = $conn->query($clac);
      
      
      
      if ($rescalc->num_rows > 0) {
          while($row = $rescalc->fetch_assoc()) {
      
            $froga = "SELECT COUNT(*) FROM lån l inner JOIN bok b ON b.Bokid = l.Bokid WHERE b.ISBN = ?";
            $stmt = $conn->prepare($froga);
            $stmt->bind_param("s", $row["ISBN"]);
            $stmt->execute();
        
            $anticalc = $stmt->get_result();
      
            if($anticalc->num_rows > 0){
                $antirow = $anticalc->fetch_assoc();
                echo "Titel: " . $row["titel"].  " :Antal: ". $row["COUNT(*)"] - $antirow["COUNT(*)"]. "<br>". " ISBN: ". $row["ISBN"] . "<br>". "<br>";
            }
            else{
              echo "Titel: " . $row["titel"].  " :Antal: ". $row["COUNT(*)"]. "<br>". " ISBN: ". $row["ISBN"] . "<br>". "<br>";
            }
            
            
          }
      } else {
          echo "no thing in bas";
      }
      echo "<br>";
      echo "<br>";
      
      echo "Antal E-boker ";
      echo "<br>";
      $clac = "SELECT ebok.titel, ebok.ISBN, COUNT(*) FROM ebok GROUP BY ebok.ISBN";   
      $rescalc = $conn->query($clac);
      
      if ($rescalc->num_rows > 0) {
        while($row = $rescalc->fetch_assoc()) {
      
          $froga = "SELECT COUNT(*) FROM lån l inner JOIN ebok b ON b.eBokid = l.eBokid WHERE b.ISBN = ?";
          $stmt = $conn->prepare($froga);
          $stmt->bind_param("s", $row["ISBN"]);
          $stmt->execute();
      
          $anticalc = $stmt->get_result();
      
          if($anticalc->num_rows > 0){
              $antirow = $anticalc->fetch_assoc();
              echo "Titel: " . $row["titel"]. " ISBN: ". $row["ISBN"] . " antal: ". $row["COUNT(*)"] - $antirow["COUNT(*)"].  "<br>";
          }
          else{
            echo "Titel: " . $row["titel"]. " ISBN: ". $row["ISBN"] . " antal: ". $row["COUNT(*)"].  "<br>";
          }
          
          
        }
      } else {
        echo "no thing in bas";
      }
      echo "<br>";
      echo "<br>";
      
      echo "Antal filmer ";
      echo "<br>";
      $clac = "SELECT f.*, sum(case when l.Lånid is null then 1 else 0 end) inne FROM `film` f left outer join lån l on l.Filmid = f.filmid GROUP BY f.ISBN   ";   
      $rescalc = $conn->query($clac);
      
      if ($rescalc->num_rows > 0) {
          while($row = $rescalc->fetch_assoc()) {
              echo "Titel: " . $row["Titel"]. " ISBN: ". $row["ISBN"]. " antal: ". $row["inne"]. "<br>";
          }
      } else {
          echo "no thing in bas";
      }

      ?>
    </div>
    <div id = "boklon">
      <?php

      echo "Dina lånade boker";
      echo "<br>";
      echo "<br>";
      $bok = "SELECT bok.titel, bok.BokId, lån.lånid FROM bok LEFT JOIN lån ON bok.BokId = lån.BokId AND $personid = lån.personid";
      $res = $conn->query($bok);
      $result = $conn->query($bok);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if ($row["lånid"] != NULL){
            echo $row["titel"]. "<br>";
          }
        }
      } else {
        echo "alla fria";
      }

      ?>
    </div>
    <div id = "eboklon">
      <?php

      echo "Dina lånade eboker";
      echo "<br>";
      echo "<br>";
      $ebok = "SELECT ebok.titel, ebok.eBokId, lån.lånid FROM ebok LEFT JOIN lån ON ebok.eBokId = lån.eBokId AND $personid = lån.personid";
      $res = $conn->query($ebok);
      $result = $conn->query($ebok);


      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if ($row["lånid"] != NULL){
            echo $row["titel"]. "<br>";
          }
        }
      } else {
        echo "alla fria";
      }

      ?>
    </div>
    <div id = "filmlon">
      <?php

      echo "Dina lånade filmer";
      echo "<br>";
      echo "<br>";
      $film = "SELECT film.titel, film.filmId, lån.lånid FROM film LEFT JOIN lån ON film.filmId = lån.filmId AND $personid = lån.personid";
      $res = $conn->query($film);
      $result = $conn->query($film);


      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if ($row["lånid"] != NULL){
            echo $row["titel"]. "<br>";
          }
        }
      } else {
        echo "alla fria";
      }

      ?>
    </div>
    <div id = "who">
      <?php
      $username = $_SESSION['user'];
      echo "Hej ". $username
      ?>
    </div>

    <form  id = "lonbutton" method = "post" action="lan.php">
        <input type="hidden" name="lan">
        <input type="text" name="ISBN" placeholder="ISBN av vad du vill låna"><br><br>
        <input type="submit" />
    </form>
    <form  id = "gebutton" method = "post" action="gelan.php">
        <input type="hidden" name="gelan">
        <input type="text" name="ISBN" placeholder="ISBN av vad du vill lämna tillbacka"><br><br>
        <input type="submit" />
    </form>
</body>
</html>
