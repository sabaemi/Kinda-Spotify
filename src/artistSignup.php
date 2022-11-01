<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artist Sign Up</title>
</head>
<body>

<!--data base-->   
<?php
 //echo filter_input(INPUT_GET,'username', FILTER_SANITIZE_URL);

        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dataBase = "db6";
        session_start();
        $user = $_SESSION['username'];
        $err = "";
        $ArtName = $nationality = $startDate = $resType = NULL;

        $conn = new mysqli($servername, $username, $password, $dataBase);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["submitInfo"])) {
            if (empty($_POST["ArtName"]) || empty($_POST["nationality"])|| empty($_POST["startDate"])) {
                //$err = "all fields are required";
                echo "<script>alert('all fields are required');</script>";
            } 
            else {

                $ArtName = test_input($_POST["ArtName"]);
                $nationality = test_input($_POST["nationality"]);
                $startDate = $_POST["startDate"];

                //echo $available;
                $sql = "INSERT INTO `Artist` (`ArtName`, `nationality`, `startDate`,
                  `username`, `userType`, `resType` ) VALUES ('$ArtName', '$nationality', '$startDate', '$user', 'A','Checking' )";
                 if ($conn->query($sql) === TRUE) {
                //echo "registered successfully";
                echo "<script>alert('registered successfully');
                window.location.href='main.php';</script>";
                //header("Location: main.php");
                //session_start();
                //$_SESSION['username'] = $user;
                } else {
                echo "Error: " . $conn->error;
                }
            }
                               
            }

            function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
?><div class="form1">
                    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                    <?php echo' <h1 >'.$user.'</h1>'; ?>
                        <br>
                        ArtName: <input type="text" name="ArtName">
                        <br><br>
                        nationality: <input type="text" name="nationality">
                        <br><br>
                        startDate: <input type="date" name="startDate">
                        <br><br>
                        <span class="error"><?php echo $err;?></span>
                        <br><br>
                        <input type="submit" class="sbmtbtn" name="submitInfo" value="Submit">  
                    </form>
                    </div>

</body>
</html>