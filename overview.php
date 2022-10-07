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
    <link rel = "stylesheet" type = "text/css" href = "lon.css">  
    <title>bibliotek</title>
</head>
<body>
    <div id="sokida">
        <a id="sok" href="Main.php">tillback till söksida</a>
    </div> 
    <div id = "enskild">
      <?php
        $free_bok = "SELECT bok.titel, bok.BokId, lån.lånid FROM bok LEFT JOIN lån ON bok.BokId = lån.BokId";
        $res = $conn->query($free_bok);
        
        $lonad_bok = "SELECT bok.titel, låntagare.namn FROM bok,lån,låntagare WHERE bok.Bokid = lån.Bokid AND låntagare.Personid = lån.Personid";
        $result = $conn->query($lonad_bok);
        
        
        
        echo "Fria boker ";
        echo "<br>";
        if ($res->num_rows > 0) { 
            while($row = $res->fetch_assoc()) {
              if ($row["lånid"] == NULL){
                echo $row["titel"]. "<br>";
              }
            }
          } else {
            echo "alla lånade";
          }
        
        echo "<br>";
        echo "<br>";
        
        echo "Lånade boker ";
        echo "<br>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo $row["titel"]. " lånad av: ". $row["namn"]. "<br>";
            }
          } else {
            echo "alla fria";
          }
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        $free_ebok = "SELECT ebok.titel, ebok.eBokId, lån.lånid FROM ebok LEFT JOIN lån ON ebok.eBokId = lån.eBokId";
        $res = $conn->query($free_ebok);
        
        $lonad_ebok = "SELECT ebok.titel, låntagare.namn FROM ebok,lån,låntagare WHERE ebok.eBokId = lån.eBokId AND låntagare.Personid = lån.Personid" ;
        $result = $conn->query($lonad_ebok);
        
        
        
          echo "Fria E-boker ";
          echo "<br>";
          if ($res->num_rows > 0) {
              while($row = $res->fetch_assoc()) {
                if ($row["lånid"] == NULL){
                  echo $row["titel"]. "<br>";
                }
              }
            } else {
              echo "alla lånade";
            }
          
          echo "<br>";
          echo "<br>";
          
          echo "Lånade E-boker ";
          echo "<br>";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo $row["titel"]. " lånad av: ". $row["namn"]. "<br>";
              }
            } else {
              echo "alla fria";
            }
        
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        $free_film = "SELECT film.titel, film.filmId, lån.lånid FROM film LEFT JOIN lån ON film.filmId = lån.filmId";
        $res = $conn->query($free_film);
        
        $lonad_film = "SELECT film.titel, låntagare.namn FROM film,lån,låntagare WHERE film.filmid = lån.filmid AND låntagare.Personid = lån.Personid";
        $result = $conn->query($lonad_film);
        
        
        
        echo "Fria filmer ";
        echo "<br>";
        if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                  if ($row["lånid"] == NULL){
                    echo $row["titel"]. "<br>";
                  }
                }
            } else {
                echo "alla lånade";
            }
            
        echo "<br>";
        echo "<br>";
        
        echo "Lånade filmer ";
        echo "<br>";
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo $row["titel"]. " lånad av: ". $row["namn"]. "<br>";
                }
            } else {
                echo "alla fria";
            }
      ?>

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
    <form  id = "lonbutton" method = "post" action="lan.php">
        <input type="hidden" name="lan">
        <input type="text" name="ISBN" placeholder="ISBN av vilken bok/ebok/film som du vill låna"><br><br>
        <input type="submit" />
    </form>
</body>
</html>
