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
    <form action="Index.php" method="POST">
        <div id="bok">
        Sök efter bok: <input type="text" name="bok">
                       <input type="submit" name="submit" value="Sök"><br>
        </div>
    </form>
    <form action="Index.php" method="POST">
        <div id="ebok">
        Sök efter e-bok: <input type="text" name="ebok">
                         <input type="submit" name="submit2" value="Sök"><br>
        </div>
    </form>
    <form action="Index.php" method="POST">
        <div id="film">
        Sök efter film: <input type="text" name="film">
                        <input type="submit" name="submit3" value="Sök"><br>
        </div>
    </form>
    <form action="Index.php" method="POST">
        <div id="skapare">
        Sök efter författare/regissör: <input type="text" name="skapare">
                                       <input type="submit" name="submit4"><br>
        </div>
    </form>
    <form action="Index.php" method="POST">
        <div id="genre">
        Sök efter genre: <input type="text" name="genre">
                         <input type="submit" name="submit5"><br>
        </div>
    </form>
    <form action="Index.php" method="POST">
        <div id="year">
        Sök efter utgivningsår: <input type="text" name="year">
                         <input type="submit" name="submit6"><br>
        </div>
    </form>
    <div id="output">
        <?php
            if(!empty($_POST["submit"])){
                $bok = $_POST["bok"];
                $sql = "SELECT * FROM bok,skapare WHERE skapare.Personid = bok.Personid AND bok.Titel LIKE '%$bok%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Bok: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Antal sidor: ".$row["Antal_sidor"]." sidor"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                        echo "Skapare: ".$row["Namn"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit2"])){
                $ebok = $_POST["ebok"];
                $sql = "SELECT * FROM ebok,skapare WHERE skapare.Personid = ebok.Personid AND ebok.Titel LIKE '%$ebok%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "E-bok: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Speltid: ".$row["Speltid"]." min"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                        echo "Skapare: ".$row["Namn"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit3"])){
                $film = $_POST["film"];
                $sql = "SELECT * FROM film,skapare WHERE skapare.Personid = film.Personid AND film.Titel LIKE '%$film%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Film: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Speltid: ".$row["Speltid"]." min"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                        echo "Skapare: ".$row["Namn"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit4"])){
                $skapare = $_POST["skapare"];
                $sql ="SELECT * FROM skapare join bok on skapare.Personid=bok.Personid where skapare.Namn LIKE '%$skapare%'";
                $sql2 ="SELECT * FROM skapare join ebok on skapare.Personid=ebok.Personid where skapare.Namn LIKE '%$skapare%'";
                $sql3 ="SELECT * FROM skapare join film on skapare.Personid=film.Personid where skapare.Namn LIKE '%$skapare%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row["Namn"]."<br>";
                        echo "Titel: ".$row["Titel"]."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row2["Namn"]."<br>";
                        echo "Titel: ".$row2["Titel"]."<br>";
                        echo "Utgivningsår: ".$row2["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Namn: ".$row3["Namn"]."<br>";
                        echo "Titel: ".$row3["Titel"]."<br>";
                        echo "Utgivningsår: ".$row3["Utgivningsar"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit5"])){
                $genre = $_POST["genre"];
                $sql ="SELECT * FROM bok join skapare on skapare.Personid=bok.Personid where bok.Genre LIKE '%$genre%'";
                $sql2 ="SELECT * FROM ebok join skapare on skapare.Personid=ebok.Personid where ebok.Genre LIKE '%$genre%'";
                $sql3 ="SELECT * FROM film join skapare on skapare.Personid=film.Personid where film.Genre LIKE '%$genre%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row["Namn"]."<br>";
                        
                        echo "</div>";
                    }
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row2["Titel"]."<br>";
                        echo "Genre: ".$row2["Genre"]."<br>";
                        echo "Utgivningsår: ".$row2["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row2["Namn"]."<br>";
                        echo "</div>";
                    }
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row3["Titel"]."<br>";
                        echo "Genre: ".$row3["Genre"]."<br>";
                        echo "Utgivningsår: ".$row3["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row3["Namn"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit6"])){
                $year = $_POST["year"];
                $sql ="SELECT * FROM bok join skapare on skapare.Personid=bok.Personid where bok.Utgivningsar LIKE '%$year%'";
                $sql2 ="SELECT * FROM ebok join skapare on skapare.Personid=ebok.Personid where ebok.Utgivningsar LIKE '%$year%'";
                $sql3 ="SELECT * FROM film join skapare on skapare.Personid=film.Personid where film.Utgivningsar LIKE '%$year%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row["Namn"]."<br>";
                        echo "</div>";
                    }
                }
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row2["Titel"]."<br>";
                        echo "Genre: ".$row2["Genre"]."<br>";
                        echo "Utgivningsår: ".$row2["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row2["Namn"]."<br>";
                        echo "</div>";
                    }
                }
                if($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()){
                        echo "<div class='sak'>";
                        echo "Titel: ".$row3["Titel"]."<br>";
                        echo "Genre: ".$row3["Genre"]."<br>";
                        echo "Utgivningsår: ".$row3["Utgivningsar"]."<br>";
                        echo "Skapare: ".$row3["Namn"]."<br>";
                        echo "</div>";
                    }
                }else{
                    echo "0 results";
                }
            }
        ?>
    </div>
</body>
</html>