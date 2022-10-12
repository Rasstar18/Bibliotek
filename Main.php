<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="bibliotek";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bibliotek.css"> 
    <title>Bibliotek</title>
</head>
<body>
    <div id="start">
        <h2>HEJ OCH VÄLKOMMEN TILL DETTA BIBLIOTEK</h2>
    </div> 
    <div id="startsida">
        <a id = "startsid" href="index.html">Tillbaka till inlogg</a>
    </div>   
    <div id="lansida">
        <a id = "lan" href="overview.php">till lånsida</a>
    </div>  
    <form action="Main.php" method="POST">
        <div id="titel">
        Sök efter en titel: <input type="text" name="titel">
                       <input type="submit" name="submit" value="Sök"><br>
        </div>
    </form>
    <form action="Main.php" method="POST">
        <div id="skapare">
        Sök efter författare/regissör: <input type="text" name="skapare">
                                       <input type="submit" name="submit4"><br>
        </div>
    </form>
    <form action="Main.php" method="POST">
        <div id="genre">
        Sök efter genre: <input type="text" name="genre">
                         <input type="submit" name="submit5"><br>
        </div>
    </form>
    <form action="Main.php" method="POST">
        <div id="year">
        Sök efter utgivningsår: <input type="text" name="year">
                         <input type="submit" name="submit6"><br>
        </div>
    </form>
    <div id="output">
        <?php

            if(!empty($_POST["submit"])){
                $titel = $_POST["titel"];
                $sql = "SELECT * FROM bok JOIN connect on bok.Bokid = connect.Bokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE bok.Titel LIKE '%$titel%'";
                $sql2 = "SELECT * FROM ebok JOIN connect on ebok.Ebokid = connect.Ebokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE ebok.Titel LIKE '%$titel%'";
                $sql3 = "SELECT * FROM film JOIN connect on film.filmid = connect.filmid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE film.Titel LIKE '%$titel%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                
                if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $bokid = $row["Bokid"];
                            $title = $row["Titel"];
                            $Mediatyp = $row["Media"];
                            $Genre = $row["Genre"];
                            $Antal_sidor = $row["Antal_sidor"];
                            $Utgivningsar = $row["Utgivningsar"];
                            $ISBN = $row["ISBN"];
                            $skapare = $row["Namn"];
                            echo "<div class='sak'>";
                            echo "Titel: ".$title."<br>";
                            echo "Mediatyp: ".$Mediatyp."<br>";
                            echo "Genre: ".$Genre."<br>";
                            echo "Antal sidor: ".$Antal_sidor." sidor"."<br>";
                            echo "Utgivningsår: ".$Utgivningsar."<br>";
                            echo "ISBN: ".$ISBN."<br>";
                            echo "Skapare: ".$skapare."<br>";
                            echo "</div>";
                        }
                        
                        
                    
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        $ebokid = $row2["Ebokid"];
                        $title = $row2["Titel"];
                        $Mediatyp = $row2["Media"];
                        $Genre = $row2["Genre"];
                        $Speltid = $row2["Speltid"];
                        $Utgivningsar = $row2["Utgivningsar"];
                        $ISBN = $row2["ISBN"];
                        $skapare = $row2["Namn"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        $title = $row3["Titel"];
                        $Mediatyp = $row3["Media"];
                        $Genre = $row3["Genre"];
                        $Speltid = $row3["Speltid"];
                        $Utgivningsar = $row3["Utgivningsar"];
                        $ISBN = $row3["ISBN"];
                        $skapare = $row3["Namn"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit4"])){
                $skapare = $_POST["skapare"];
                $sql = "SELECT * FROM bok JOIN connect on bok.Bokid = connect.Bokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE skapare.Namn LIKE '%$skapare%'";
                $sql2 = "SELECT * FROM ebok JOIN connect on ebok.Ebokid = connect.Ebokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE skapare.Namn LIKE '%$skapare%'";
                $sql3 = "SELECT * FROM film JOIN connect on film.filmid = connect.filmid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE skapare.Namn LIKE '%$skapare%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row["Namn"]."<br>";
                        echo "Titel: ".$row["Titel"]."<br>";
                        echo "Mediatyp: ".$row["Media"]."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row2["Namn"]."<br>";
                        echo "Titel: ".$row2["Titel"]."<br>";
                        echo "Mediatyp: ".$row2["Media"]."<br>";
                        echo "Utgivningsår: ".$row2["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row3["Namn"]."<br>";
                        echo "Titel: ".$row3["Titel"]."<br>";
                        echo "Mediatyp: ".$row3["Media"]."<br>";
                        echo "Utgivningsår: ".$row3["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit5"])){
                $genre = $_POST["genre"];
                $sql = "SELECT * FROM bok JOIN connect on bok.Bokid = connect.Bokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE bok.Genre LIKE '%$genre%'";
                $sql2 = "SELECT * FROM ebok JOIN connect on ebok.Ebokid = connect.Ebokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE ebok.Genre LIKE '%$genre%'";
                $sql3 = "SELECT * FROM film JOIN connect on film.filmid = connect.filmid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE film.Genre LIKE '%$genre%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $title = $row["Titel"];
                        $skapare = $row["Namn"];
                        $Mediatyp = $row["Media"];
                        $Genre = $row["Genre"];
                        $Antal_sidor = $row["Antal_sidor"];
                        $Utgivningsar = $row["Utgivningsar"];
                        $ISBN = $row["ISBN"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Antal sidor: ".$Antal_sidor." sidor"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        $title = $row2["Titel"];
                        $skapare = $row2["Namn"];
                        $Mediatyp = $row2["Media"];
                        $Genre = $row2["Genre"];
                        $Speltid = $row2["Speltid"];
                        $Utgivningsar = $row2["Utgivningsar"];
                        $ISBN = $row2["ISBN"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        $title = $row3["Titel"];
                        $skapare = $row3["Namn"];
                        $Mediatyp = $row3["Media"];
                        $Genre = $row3["Genre"];
                        $Speltid = $row3["Speltid"];
                        $Utgivningsar = $row3["Utgivningsar"];
                        $ISBN = $row3["ISBN"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit6"])){
                $year = $_POST["year"];
                $sql = "SELECT * FROM bok JOIN connect on bok.Bokid = connect.Bokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE bok.Utgivningsar LIKE '%$year%'";
                $sql2 = "SELECT * FROM ebok JOIN connect on ebok.Ebokid = connect.Ebokid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE ebok.Utgivningsar LIKE '%$year%'";
                $sql3 = "SELECT * FROM film JOIN connect on film.filmid = connect.filmid INNER JOIN skapare on skapare.Personid = connect.Personid WHERE film.Utgivningsar LIKE '%$year%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                            $title = $row["Titel"];
                            $skapare = $row["Namn"];
                            $Mediatyp = $row["Media"];
                            $Genre = $row["Genre"];
                            $Antal_sidor = $row["Antal_sidor"];
                            $Utgivningsar = $row["Utgivningsar"];
                            $ISBN = $row["ISBN"];
                            echo "<div class='sak'>";
                            echo "Titel: ".$title."<br>";
                            echo "Mediatyp: ".$Mediatyp."<br>";
                            echo "Genre: ".$Genre."<br>";
                            echo "Antal sidor: ".$Antal_sidor." sidor"."<br>";
                            echo "Utgivningsår: ".$Utgivningsar."<br>";
                            echo "ISBN: ".$ISBN."<br>";
                            echo "Skapare: ".$skapare."<br>";
                            echo "</div>";
                    }
                   
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        $title = $row2["Titel"];
                        $skapare = $row2["Namn"];
                        $Mediatyp = $row2["Media"];
                        $Genre = $row2["Genre"];
                        $Speltid = $row2["Speltid"];
                        $Utgivningsar = $row2["Utgivningsar"];
                        $ISBN = $row2["ISBN"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        $title = $row3["Titel"]; 
                        $skapare = $row3["Namn"];
                        $Mediatyp = $row3["Media"];
                        $Genre = $row3["Genre"];
                        $Speltid = $row3["Speltid"];
                        $Utgivningsar = $row3["Utgivningsar"];
                        $ISBN = $row3["ISBN"];
                        echo "<div class='sak'>";
                        echo "Titel: ".$title."<br>";
                        echo "Mediatyp: ".$Mediatyp."<br>";
                        echo "Genre: ".$Genre."<br>";
                        echo "Speltid: ".$Speltid." min"."<br>";
                        echo "Utgivningsår: ".$Utgivningsar."<br>";
                        echo "ISBN: ".$ISBN."<br>";
                        echo "Skapare: ".$skapare."<br>";
                        echo "</div>";
                    }
                    
                }else{
                    echo "0 results";
                }
            }

            
            
            /*function getCreator($skapare){
                $servername="localhost";
                $username="root";
                $password="";
                $dbname="bibliotek";

                $conn = new mysqli($servername, $username, $password, $dbname);
                $sqli = "SELECT Personid FROM connect JOIN skapare on connect.Personid = skapare.Personid 
                                               JOIN bok on bok.Bokid = connect.Bokid 
                                               JOIN ebok on ebok.Ebokid = connect.Ebokid 
                                               JOIN film on film.filmid = connect.filmid";
                $check = $conn->query($sqli);
                $skapare = "";
                foreach($check as $row){
                    $skapare.= $row['Namn'].", ";   
                }
                return $skapare;
            }*/
        ?>
    </div>
</body>
</html>