<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c3.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Album</title>
        </head>
        <body>
                        
        <!--data base-->   
        <?php
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dataBase = "db6";
            session_start();
            $user = $_SESSION['username'];
                        
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
            
            <div class="scrollmenu">         
                <a href="common.php" name="home">Home</a>                            
                </div>

                <div class="form1">
                  <br><br><br>
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1> All Massages:</h1>
                <?php
            $premiumc="SELECT EXISTS(SELECT * FROM Premium WHERE username='".$user."' )";
            $premch = $conn->query($premiumc);
            $rpremch = $premch->fetch_array();
            if($rpremch[0]!=0){
                $sqlnn="SELECT * FROM Premium WHERE username='".$user."' ";
            $rennsl = mysqli_query($conn, $sqlnn);
            $rownns = mysqli_fetch_assoc($rennsl);
            $rightdate = $rownns['expDate'];
            $date=date("Y-m-d");
            if($rightdate<$date){
                $sql ="DELETE FROM Premium WHERE username='".$user."'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('your premium account is up!');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
            }
                        }

                        echo'<h2> your favorit artist:</h2>';
                        $exif="SELECT EXISTS(SELECT ArtName, COUNT(ArtName) AS MOST_FREQ FROM Play WHERE username='".$user."' GROUP BY ArtName ORDER BY COUNT(ArtName) DESC )";
                        $resex = $conn->query($exif);
                        $rex = $resex->fetch_array();
                        if($rex[0]!=0){
                        $hmjr="SELECT ArtName, COUNT(ArtName) AS MOST_FREQ FROM Play WHERE username='".$user."' GROUP BY ArtName ORDER BY COUNT(ArtName) DESC ";
                        $rmjr = $conn->query($hmjr);
                        $rrmjr = mysqli_fetch_assoc($rmjr);
                        echo $rrmjr['ArtName'].' is your favorit artist<br>';
                        $gmjr="SELECT genre, COUNT(genre) AS MOST_FREQUENT FROM Album WHERE ArtName='".$rrmjr['ArtName']."' GROUP BY genre ORDER BY COUNT(genre) DESC ";
                $rgmjr = $conn->query($gmjr);
                $rrgmjr = mysqli_fetch_assoc($rgmjr);

                $nnsql="SELECT EXISTS(SELECT ArtName FROM Album WHERE genre='".$rrgmjr['genre']."' AND ArtName!='".$rrmjr['ArtName']."' LIMIT 1)";
                $resql = $conn->query($nnsql);
                $rsql = $resql->fetch_array();
                if($rsql[0]!=0){
                $agmjr="SELECT ArtName FROM Album WHERE genre='".$rrgmjr['genre']."' AND ArtName!='".$rrmjr['ArtName']."' LIMIT 1";
                $ragmjr = $conn->query($agmjr);
                $rragmjr = mysqli_fetch_assoc($ragmjr);
                echo 'Suggested artist: '.$rragmjr['ArtName'].'<br>';
                }
                else echo 'no suggested artist for you<br>';
              }
              else echo 'you dont have a favorit artist<br>';

              echo'<h2> top 5 songs:</h2>';
                $kdate=date('Y-m-d', strtotime("-7 days"));
                $ahmjr="SELECT Mname, COUNT(Mname) AS MOST_FR FROM Play WHERE pDate>'".$kdate."' GROUP BY Mname ORDER BY COUNT(Mname) DESC LIMIT 5";
                $armjr = $conn->query($ahmjr);
                while($arrmjr = $armjr->fetch_assoc()) {
                    echo $arrmjr['Mname'].',';
                 }
                 echo' are the most popular songs.<br>';

                 echo'<h2> artists from your contry:</h2>';
                 $sqlll = "SELECT * FROM User WHERE username ='".$user."'";
            $resulttt = mysqli_query($conn, $sqlll);
            $rowww = mysqli_fetch_assoc($resulttt);
            $loginType = $rowww['userType'];

               if($loginType=='L') {
                 $natio="SELECT nationality FROM Listener Where username='".$user."' ";
                $resunatio = mysqli_query($conn, $natio);
                $rownatio = mysqli_fetch_assoc($resunatio);
                 $intr="SELECT ArtName from Artist WHERE nationality='".$rownatio['nationality']."'  ";
                 $intrsn = $conn->query($intr);
                 if ($intrsn->num_rows > 0) {
                     while($reintrsn = $intrsn->fetch_array()) {
                         echo $reintrsn[0].'=><br>';

                         $sns = "SELECT DISTINCT AlbumTitle FROM Album WHERE ArtName='".$reintrsn[0]."'";
                         $snresult = $conn->query($sns);
                          if ($snresult->num_rows > 0) {
                            while($snrow = $snresult->fetch_assoc()) {
                         echo $snrow["AlbumTitle"].'<br>';
                }
        } else echo'didnt release album.';
                     }
                 }
              }
                else {
                  $natio="SELECT nationality FROM Artist Where username='".$user."' ";
                  $resunatio = mysqli_query($conn, $natio);
                  $rownatio = mysqli_fetch_assoc($resunatio);  
                   $intr="SELECT ArtName from Artist WHERE nationality='".$rownatio['nationality']."' AND  username!='".$user."' ";
                   $intrsn = $conn->query($intr);
                   if ($intrsn->num_rows > 0) {
                       while($reintrsn = $intrsn->fetch_array()) {
                        echo $reintrsn[0].'=><br>';

                        $sns = "SELECT DISTINCT AlbumTitle FROM Album WHERE ArtName='".$reintrsn[0]."'";
                        $snresult = $conn->query($sns);
                         if ($snresult->num_rows > 0) {
                           while($snrow = $snresult->fetch_assoc()) {
                        echo $snrow["AlbumTitle"].'<br>';
               }
       } else echo'didnt release album.';
                       }
                   }
                }
                

                $sqll = "SELECT * FROM User WHERE username ='".$user."'";
                $resultt = mysqli_query($conn, $sqll);
                $roww = mysqli_fetch_assoc($resultt);
                if($roww['userType']=='A'){
                echo'<h2> your fans:</h2>';
                $sqll2 = "SELECT * FROM Artist WHERE username ='".$user."'";
                $resultt2 = mysqli_query($conn, $sqll2);
                $roww2 = mysqli_fetch_assoc($resultt2);
                $sqll1 = "SELECT EXISTS(SELECT * FROM Play WHERE ArtName ='".$roww2['ArtName']."')";
                $resql1 = $conn->query($sqll1);
                $rsql1 = $resql1->fetch_array();
                if($rsql1[0]!=0){
                  $hmjr="SELECT username, COUNT(username) AS MOST_FREQ FROM Play WHERE ArtName='".$roww2['ArtName']."' GROUP BY username ORDER BY COUNT(username) DESC limit 1";
                        $rmjr = $conn->query($hmjr);
                        $rrmjr = mysqli_fetch_assoc($rmjr);
                        if($rrmjr['MOST_FREQ']>10){
                            if ($rmjr->num_rows > 0){
                                $hmjr="SELECT username, COUNT(username) AS MOST_FREQ FROM Play WHERE ArtName='".$roww2['ArtName']."' GROUP BY username ORDER BY COUNT(username) DESC limit 1";
                        $rmjr = $conn->query($hmjr);
                          while($arrmjr = $rmjr->fetch_assoc()) {
                            echo $arrmjr['username'].'<br>';
                         }
                        }
                        else echo'some thing is wrong';
                      }
                      else echo'<br>you dont have any fans yet.<br>';
                }
                else echo'<br>you dont have any fans yet.<br>';
                }


?>
          </body>
          </html>