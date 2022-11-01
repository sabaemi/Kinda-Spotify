<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
<?php
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dataBase = "db6";
            session_start();
            $user = $_SESSION['user'];
            //$user1=$_SESSION['user'];
            $conn = new mysqli($servername, $username, $password, $dataBase);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
                                    
            ?>     
            <br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>PROFILE</h1>
            <?php
$nn="SELECT userType FROM User WHERE username='".$user."' ";
            $re = mysqli_query($conn, $nn);
            $r = mysqli_fetch_assoc($re);
            $llaa = $r['userType'];
            echo'<h2>Name</h2>';
            echo 'UserName : '.$user.'<br>';
            if($llaa=='L'){
                $le="SELECT firstName,lastName FROM listener WHERE username='".$user."'";
                $rele = $conn->query($le);  
            $rrel = mysqli_fetch_assoc($rele);
            echo 'Name : '.$rrel['firstName']." ".$rrel['lastName'].'<br>';
             }
            
            if($llaa=='A'){
                $le="SELECT ArtName FROM Artist WHERE username='".$user."'";
                $rele = $conn->query($le);
                $rrel = mysqli_fetch_assoc($rele);
                echo 'ArtName : '.$rrel['ArtName'].'<br>';
                $nnl="SELECT EXISTS(SELECT genre, COUNT(genre) AS MOST_FREQUENT FROM Album WHERE ArtName='".$rrel['ArtName']."' GROUP BY genre ORDER BY COUNT(genre) DESC )";
            $rel = $conn->query($nnl);
            $rl = $rel->fetch_array();
                if($rl[0]!=0){
                $hmjr="SELECT genre, COUNT(genre) AS MOST_FREQUENT FROM Album WHERE ArtName='".$rrel['ArtName']."' GROUP BY genre ORDER BY COUNT(genre) DESC ";
                $rmjr = $conn->query($hmjr);
                $rrmjr = mysqli_fetch_assoc($rmjr);
                echo 'Genre : '.$rrmjr['genre'].'<br>';
                   echo'<h2>Albums</h2>';
            }
                $puseral="SELECT DISTINCT AlbumTitle FROM Album WHERE ArtName='".$rrel['ArtName']."' ";
                $respual = $conn->query($puseral);
                if ($respual->num_rows > 0){
                while($purowal = $respual->fetch_array()){
                echo '⦿'.$purowal[0].'  <br>';
            $pooal="SELECT DISTINCT regDate FROM Album WHERE AlbumTitle='".$purowal[0]."' AND ArtName='".$rrel['ArtName']."' ";
            $pooresultal = $conn->query($pooal);
                if ($pooresultal->num_rows > 0) {
                    while($poorowal = $pooresultal->fetch_array()) {
                        echo '◦reg date:'.$poorowal[0].'<br>';
                    }
            }


    }
        }
        echo'<h2>Popularity</h2>';
        echo 'Most Popular Songs :<br>';
        $intr="SELECT Mname,ArtName from Playlist WHERE pName='Liked Songs' AND ArtName='".$rrel['ArtName']."' 
        intersect SELECT Mname,ArtName from Play WHERE ArtName='".$rrel['ArtName']."' ";
$intrsn = $conn->query($intr);
if ($intrsn->num_rows > 0) {
    while($reintrsn = $intrsn->fetch_array()) {
        echo '⦿'.$reintrsn[0].'<br>';
    }
}
        }


        $sql1 = "SELECT secondUsername FROM Follow  Where firstUsername='".$user."' ";
        $sq1="SELECT COUNT(secondUsername)FROM Follow Where firstUsername='".$user."' ";
        $aps = $conn->query($sq1);
        while($rps = $aps->fetch_array()) {
          echo 'NO. Followings : ';
         echo $rps[0].'<br>';   
       }
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
        echo "<h2>Followings</h2>";
        while($row1 = $result1->fetch_assoc()) {
            echo  $row1["secondUsername"]. '<br>';
        }
      }


      $sql2 = "SELECT firstUsername FROM Follow  Where secondUsername='".$user."' ";
      $sq2="SELECT COUNT(firstUsername)FROM Follow Where secondUsername='".$user."' ";
        $aps2 = $conn->query($sq2);
        while($rps2 = $aps2->fetch_array()) {
          echo 'NO. Followers :';
         echo $rps2[0].'<br>';   
       }
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        //echo "<table><tr><th>Followers</th></tr>";
        echo "<h2>Followers</h2>";
        while($row2 = $result2->fetch_assoc()) {
            //echo "<tr><td>" . $row2["firstUsername"]. "</td></tr>";
            echo  $row2["firstUsername"]. '<br>';
        }
        //echo "</table>";
}
            ?>

            <?php
            echo'<h2>Playlists : </h2>';
            $puser="SELECT DISTINCT pName FROM Playlist WHERE username='".$user."'";
            $respu = $conn->query($puser);
            if ($respu->num_rows > 0){
            while($purow = $respu->fetch_array()){
            echo '⦿'.$purow[0].'  <br>'; 
            $psns = "SELECT COUNT(Mname) FROM Playlist WHERE pName='".$purow[0]."' AND username='".$user."'";
            $psnresult = $conn->query($psns);
            if ($psnresult->num_rows > 0) {
                while($psnrow = $psnresult->fetch_array()) {
                    echo '◦No. Songs : '.$psnrow[0].'<br>';
                }
        }
        $poo="SELECT DISTINCT addDate FROM Playlist WHERE pName='".$purow[0]."' AND username='".$user."'";
        $pooresult = $conn->query($poo);
            if ($pooresult->num_rows > 0) {
                while($poorow = $pooresult->fetch_array()) {
                    echo '◦Last Update:'.$poorow[0].'<br>';
                }
        }
}
    }
            
            
            
            
            ?>
            <br>
            <input type="submit" class="hmbtn" name="cancel" value="Home"> 
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['cancel'])) {
                header("Location: common.php");
               }
            ?>
            </from>
            </div>
</body>
</html>