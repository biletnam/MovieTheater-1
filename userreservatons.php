<?php
include('config.php');
session_start();

?>
<html>
    <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style type="text/css">
             body{
        
        background-image: url("space.gif");
        background-repeat:no-repeat;
        background-size:cover;
      }
      .jumbotron{
          background-color:lightblue;
          color:black;
          font-family:Star_Trek;
          font-size: 90px;
         
      }
          
      
      @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #user_res{
          color:white;
          font-family: Star_Trek;
          background-color: lightblue;
      }
      #nav_bar_bar, #title_Future{
          font-family:Star_Trek;
          font-size:40px;
      }
      p{
          color:black;
          font-size:30px;
          font-weight:bold;
      }
      a{
          font-size:30px;
          font-weight:bold; 
      }
    </style>
    
    <body>
   

        <div class ="container">
            <div class = "jumbotron">
                <?php
               $name= $_SESSION['name'];
                //says hello to the user and displays the name of the movie
                echo "<h1> Hello ". $name. ", these are all of your ticket reservations!</h1>";
                ?>
            </div>
            <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a id="title_Future"class="navbar-brand" href="#">Future Films</a>
    </div>
    <ul id="nav_bar_bar" class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="userreservatons.php">Your Reservatons</a></li>
      <li><a href="SignIn.php">Logout</a></li>
    </ul>
  </div>
</nav>
            
            
<div id="user_res" class="list-group">
   <?php
   $email= $_SESSION['login'];
    $join = "Select *
            FROM Purchases 
            INNER JOIN ShowTimes 
            ON Purchases.ShowTime_ID = ShowTimes.Show_Time_ID 
            INNER JOIN Movie 
            ON ShowTimes.Movie_ID= Movie.movie_ID
            WHERE email = '$email'";
   //display a list of the users reservations          
            $list = mysqli_query($conn, $join);
            while($row = mysqli_fetch_array($list)){
   
   echo "
  <div class='list-group-item list-group-item-action flex-column align-items-start'>
    <div class = 'row'>
        <div class = 'col-sm-6'>
            <img src='/New Folder/movie_ID".$row['movie_ID'].".jpg' style = 'width: 100%'></img>
            </div>
        <div class = 'col-sm-6'>
            <h1>".$row['Title']."</h1>
            <p>Date: ". $row['Date']."</p>
            </br>
            <p>Time: ".$row['Time']."</p>
            </br>
            <p>".$row['user_purchase_num']." tickets reserved</p>
            <a href = 'deletereservation.php?ID=".$row['P_ID']."'>Delete reservation</a>
            </br>
            <a href = 'changereservation.php?ID=".$row['P_ID']."'>Edit reservation</a>
        </div>
    </div>
  </div>
  ";
            }
   ?>
  </div>

</body>
</html>
