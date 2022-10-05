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
                       <input type="submit" name="submit"><br>
        </div>
        <div id="ebok">
        Sök efter e-bok: <input type="text" name="ebok">
                         <input type="submit" name="submit2"><br>
        <div id="film">
        Sök efter film: <input type="text" name="film">
                        <input type="submit" name="submit3"><br>
        </div>
       <!-- Sök efter Författare/Regissör: <input type="text" name="skapare">
                                       <input type="submit" name="submit4"><br> 
       -->
    </form>
    <div id="output">
        <?php
            if(!empty($_POST["submit"])){
                $bok = $_POST["bok"];
                $sql = "SELECT * FROM bok WHERE bok.Titel LIKE '%$bok%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "Bok: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Antal sidor: ".$row["Antal_sidor"]." sidor"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit2"])){
                $ebok = $_POST["ebok"];
                $sql = "SELECT * FROM ebok WHERE ebok.Titel LIKE '%$ebok%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "E-bok: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Speltid: ".$row["Speltid"]." min"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                    }
                }else{
                    echo "0 results";
                }
            }

            if(!empty($_POST["submit3"])){
                $film = $_POST["film"];
                $sql = "SELECT * FROM film WHERE film.Titel LIKE '%$film%'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "Film: ".$row["Titel"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Speltid: ".$row["Speltid"]." min"."<br>";
                        echo "Utgivningsår: ".$row["Utgivningsar"]."<br>";
                        echo "ISBN: ".$row["ISBN"]."<br>";
                    }
                }else{
                    echo "0 results";
                }
            }

            /*if(!empty($_POST["submit4"])){
                $skapare = $_POST["skapare"];
                $sql = "SELECT * FROM skapare WHERE skapare.Namn LIKE '%$skapare%'";
                $sql2 ="SELECT * FROM film,skapare,bok,ebok WHERE skapare.ISBN = bok.ISBN AND skapare.Namn LIKE '%$skapare%' OR skapare.ISBN = ebok.ISBN AND skapare.Namn LIKE '%$skapare%' OR skapare.ISBN = film.ISBN AND skapare.Namn LIKE '%$skapare%'";
                $result = $conn->query($sql);
                $result2 = $conn->query($sql2);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "Namn: ".$row["Namn"]."<br>";
                    }
                }
                if($result2->num_rows > 0){
                    while($row2 = $result->fetch_assoc()){
                        echo "Namn: ".$row2["Titel"]."<br>";
                        echo "ISBN: ".$row2["ISBN"]."<br>";
                    }
                }else{
                    echo "0 results";
                }
            }*/
        ?>
    </div>
</body>
</html>