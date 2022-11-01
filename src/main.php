<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/firstp.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
</head>
<body>
<?php

$err = "";
$servername = "localhost";
$username = "username";
$password = "password";
$dataBase = "db6";
$err = "";

$conn = new mysqli($servername, $username, $password, $dataBase);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>

    <div class="scrollmenu">
    <a href="signup.php" name="home">Sign Up</a>
    <a href="login.php" name="home">Log In</a>
    <a href="adminlog.php" name="home">Admin</a>
    ||
    <a href="delaccount.php" name="home">Delete Account</a>
    <a href="repass.php" name="home">Password Recovery</a>
  </div> 
  <div class="Pic">
  <img alt="bl"
      src="pics/jgif.gif"
		class="images"
    />
    </div> 

    <?php
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dataBase = "db6";

        $conn = new mysqli($servername, $username, $password, $dataBase);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    
        //$sql = "CREATE DATABASE mydb";
       // <!-- src="orng.gif" -->
        
        $sql = "CREATE TABLE IF NOT EXISTS User (
             username VARCHAR(30) NOT NULL UNIQUE,
             pass VARCHAR(150) NOT NULL,
             hashedpass VARCHAR(150) NOT NULL,
             email varchar(50) NOT NULL UNIQUE,
             userType CHAR(1) NOT NULL,
             PRIMARY KEY(username,userType,email),
             CHECK (userType IN ('L', 'A'))
             
        )";
        if ($conn->query($sql) === TRUE) {
           //echo "u Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Playlist (
          pName VARCHAR(30) NOT NULL,
          username VARCHAR(30) NOT NULL,
          Mname VARCHAR(50) NOT NULL,
          addDate DATE NOT NULL,
          ArtName VARCHAR(30) NOT NULL,
          FOREIGN KEY (username)
            REFERENCES User (username)
          ON DELETE CASCADE
          ON UPDATE CASCADE,
          FOREIGN KEY (Mname)
            REFERENCES Music (Mname)
          ON DELETE CASCADE
          ON UPDATE CASCADE,
           FOREIGN KEY (ArtName)
            REFERENCES Artist (ArtName)
           ON DELETE CASCADE
           ON UPDATE CASCADE
          
     )";
     if ($conn->query($sql) === TRUE) {
        //echo "p Table created successfully ";
     } else {
       echo "Error creating table: " . $conn->error;
     }

     $sql = "CREATE TABLE IF NOT EXISTS SharedPlaylist (
      pName VARCHAR(30) NOT NULL,
      mainUsername VARCHAR(30) NOT NULL,
      addUsername VARCHAR(30) NOT NULL,
      FOREIGN KEY (mainUsername)
        REFERENCES Playlist (username)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
      FOREIGN KEY (addUsername)
        REFERENCES User (username)
      ON DELETE CASCADE
      ON UPDATE CASCADE
      
      
 )";
 if ($conn->query($sql) === TRUE) {
    //echo "p Table created successfully ";
 } else {
   echo "Error creating table: " . $conn->error;
 }

        $sql = "CREATE TABLE IF NOT EXISTS Artist ( 
          ArtName VARCHAR(30) NOT NULL PRIMARY KEY,
          nationality VARCHAR(50) NOT NULL,
          startDate  DATE NOT NULL,
          username VARCHAR(30) NOT NULL,
          userType CHAR(1) NOT NULL,
          resType CHAR(10) NOT NULL,
          -- FOREIGN KEY (resType)
          --   REFERENCES Adminn (resType)
          -- ON DELETE CASCADE
          -- ON UPDATE CASCADE,
          FOREIGN KEY (username,userType)
            REFERENCES User (username,userType)
          ON DELETE CASCADE
          ON UPDATE CASCADE

        )";
        if ($conn->query($sql) === TRUE) {
           //echo "a Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Listener (
          firstName VARCHAR(50) NOT NULL,
          lastName VARCHAR(50) NOT NULL,
          nationality VARCHAR(50) NOT NULL,
          DateOfBirth DATE NOT NULL,
          username VARCHAR(30) NOT NULL,
          userType CHAR(1) NOT NULL,
          FOREIGN KEY (username,userType)
            REFERENCES User (username,userType)
          ON DELETE CASCADE
          ON UPDATE CASCADE
             
        )";
        if ($conn->query($sql) === TRUE) {
           //echo "l Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Premium (
          cardNo VARCHAR(50) NOT NULL,
          expcardDate DATE NOT NULL,
          buyDate DATE NOT NULL,
          expDate DATE NOT NULL,
          username VARCHAR(30) NOT NULL,
          userType CHAR(1) NOT NULL,
          PRIMARY KEY(cardNo,expDate),
          FOREIGN KEY (username,userType)
            REFERENCES User (username,userType)
          ON DELETE CASCADE
          ON UPDATE CASCADE
             
        )";
        if ($conn->query($sql) === TRUE) {
           //echo "pr Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Album (
          AlbumTitle VARCHAR(50) NOT NULL,
          genre VARCHAR(50) NOT NULL,
          regDate DATE NOT NULL,
          Mname VARCHAR(50) NOT NULL,
          Mtime VARCHAR(50) NOT NULL,
          ArtName VARCHAR(30) NOT NULL,
          FOREIGN KEY (Mname,Mtime)
            REFERENCES Music (Mname,Mtime)
          ON DELETE CASCADE
          ON UPDATE CASCADE,
           FOREIGN KEY (ArtName)
            REFERENCES Artist (ArtName)
           ON DELETE CASCADE
          ON UPDATE CASCADE

        )";

        if ($conn->query($sql) === TRUE) {
           //echo "al Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Music (
          Mname VARCHAR(50) NOT NULL,
          Mtime VARCHAR(50) NOT NULL,
          ArtName VARCHAR(30) NOT NULL,
          report VARCHAR(70) NOT NULL,
          PRIMARY KEY(Mname,Mtime,ArtName),
          FOREIGN KEY (ArtName)
            REFERENCES Artist (ArtName)
          ON DELETE CASCADE
          ON UPDATE CASCADE

        )";
        if ($conn->query($sql) === TRUE) {
           //echo "m Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS Play (
          Mname VARCHAR(50) NOT NULL,
          pDate DATE NOT NULL,
          ArtName VARCHAR(30) NOT NULL,
          username VARCHAR(30) NOT NULL,
          FOREIGN KEY (ArtName,Mname)
            REFERENCES Music (ArtName,Mname)
          ON DELETE CASCADE
          ON UPDATE CASCADE,
          FOREIGN KEY (username)
            REFERENCES User (username)
          ON DELETE CASCADE
          ON UPDATE CASCADE

        )";
        if ($conn->query($sql) === TRUE) {
           //echo "m Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        // $sql = "CREATE TABLE IF NOT EXISTS Adminn (
        //   resType CHAR(10) NOT NULL PRIMARY KEY           
        // )";

        // if ($conn->query($sql) === TRUE) { 
        //    //echo "ad Table created successfully ";
        // } else {
        //   echo "Error creating table: " . $conn->error;
        // }

        $sql = "CREATE TABLE IF NOT EXISTS QuestionsList (
          question VARCHAR(30) NOT NULL, 
          username VARCHAR(30) NOT NULL,
          answer VARCHAR(30) NOT NULL,
          FOREIGN KEY ( username )
            REFERENCES User (username)
          ON DELETE CASCADE
          ON UPDATE CASCADE
        )";

        if ($conn->query($sql) === TRUE) {
           //echo "q Table created successfully ";
        } else {
          echo "Error creating table: " . $conn->error;
        }

      $sql = "CREATE TABLE IF NOT EXISTS Follow (
        firstUsername VARCHAR(30) NOT NULL, 
        secondUsername VARCHAR(30) NOT NULL,
        FOREIGN KEY ( firstUsername )
          REFERENCES User(username)
          ON DELETE CASCADE
        ON UPDATE CASCADE,
        FOREIGN KEY ( secondUsername )
          REFERENCES User(username)
        ON DELETE CASCADE
        ON UPDATE CASCADE
     
      )";

      if ($conn->query($sql) === TRUE) {
         //echo "rc Table created successfully ";
      } else {
        echo "Error creating table: " . $conn->error;
      }
      ?>
    
</body>
</html>