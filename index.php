<?php
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
echo "Connected successfully";
echo "<br>";


$free_bok = "SELECT bok.titel FROM bok,lån WHERE bok.Bokid = lån.bokid";
$res = $conn->query($free_bok);

$lonad_bok = "SELECT bok.titel FROM bok,lån WHERE bok.Bokid != lån.bokid";
$result = $conn->query($lonad_bok);

echo "lånade böker ";
echo "<br>";
if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
      echo "titel: " . $row["titel"]. "<br>";
    }
  } else {
    echo "all free";
  }

echo "<br>";
echo "<br>";

echo "fria böker ";
echo "<br>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "titel: " . $row["titel"]. "<br>";
    }
  } else {
    echo "all free";
  }
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$free_ebok = "SELECT ebok.titel FROM ebok,lån WHERE ebok.eBokid = lån.ebokid";
$res = $conn->query($free_ebok);

$lonad_ebok = "SELECT ebok.titel FROM ebok,lån WHERE ebok.eBokid != lån.ebokid";
$result = $conn->query($lonad_ebok);



  echo "lånade E-böker ";
  echo "<br>";
  if ($res->num_rows > 0) {
      while($row = $res->fetch_assoc()) {
        echo "titel: " . $row["titel"]. "<br>";
      }
    } else {
      echo "all free";
    }
  
  echo "<br>";
  echo "<br>";
  
  echo "fria E-böker ";
  echo "<br>";
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "titel: " . $row["titel"]. "<br>";
      }
    } else {
      echo "all free";
    }

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$free_film = "SELECT film.titel FROM film,lån WHERE film.filmid = lån.filmid";
$res = $conn->query($free_film);

$lonad_film = "SELECT film.titel FROM film,lån WHERE film.filmid != lån.filmid";
$result = $conn->query($lonad_film);



echo "lånade filmer ";
echo "<br>";
if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
        echo "titel: " . $row["titel"]. "<br>";
        }
    } else {
        echo "all free";
    }
    
echo "<br>";
echo "<br>";

echo "fria filmer ";
echo "<br>";
if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "titel: " . $row["titel"]. "<br>";
        }
    } else {
        echo "all free";
    }
    
echo "<br>";
echo "<br>";
echo "<br>";

echo "antal ";
echo "<br>";
$clac = "SELECT bok.ISBN, bok.titel, COUNT(*) FROM bok,lån WHERE bok.bokid != lån.bokid GROUP BY bok.ISBN";   
$rescalc = $conn->query($clac);

if ($rescalc->num_rows > 0) {
    while($row = $rescalc->fetch_assoc()) {
        echo "titel: " . $row["titel"]. " ISBN: ". $row["ISBN"]. " number: ". $row["COUNT(*)"]. "<br>";
    }
} else {
    echo "no thing in bas";
}
echo "<br>";
echo "<br>";

echo "antal ";
echo "<br>";
$clac = "SELECT ebok.ISBN, ebok.titel, COUNT(*) FROM ebok,lån WHERE ebok.ebokid != lån.ebokid GROUP BY ebok.ISBN";   
$rescalc = $conn->query($clac);

if ($rescalc->num_rows > 0) {
    while($row = $rescalc->fetch_assoc()) {
        echo "titel: " . $row["titel"]. " ISBN: ". $row["ISBN"]. " number: ". $row["COUNT(*)"]. "<br>";
    }
} else {
    echo "no thing in bas";
}
echo "<br>";
echo "<br>";

echo "antal ";
echo "<br>";
$clac = "SELECT film.ISBN, film.titel, COUNT(*) FROM film,lån WHERE film.filmid != lån.filmid GROUP BY film.ISBN";   
$rescalc = $conn->query($clac);

if ($rescalc->num_rows > 0) {
    while($row = $rescalc->fetch_assoc()) {
        echo "titel: " . $row["titel"]. " ISBN: ". $row["ISBN"]. " number: ". $row["COUNT(*)"]. "<br>";
    }
} else {
    echo "no thing in bas";
}

echo "<br>";
echo "<br>";
echo "<br>";

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotek</title>
    <form method = "post">
        <input type="hidden" name="lan">
        <input type="text" name="ISBN" placeholder="ISBN av vilken bok/ebok/film som du vill låna"><br><br>
        <input type="text" name="personid" placeholder="personid"><br><br>
        <input type="submit" />
    </form>
</head>
<body>
    
</body>
</html>