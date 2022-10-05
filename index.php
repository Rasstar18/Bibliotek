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
    
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotek</title>
</head>
<body>
    
</body>
</html>