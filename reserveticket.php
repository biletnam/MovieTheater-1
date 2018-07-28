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
      h3{
          background-color:lightblue;
          font-family:Star_Trek;
          font-size:40px;
          color:black;
          border-radius:5px;
          opacity:0.9;
      }
      #brand_brand, #navi_bar{
          font-family:Star_Trek;
          font-size:40px;
      }
       @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #greeting{
          font-family:Star_Trek;
          background-color: lightblue;
          color:black;
          opacity:0.9;
      }
    </style>
    <body>
              
        
      <div class ="container">
            <div id="greeting"class = "jumbotron">
              
                <?php
                //getting the users email and name
                $name = $_SESSION['name'];
                $email = $_SESSION['login'];
                $title = $_GET['title'];
               //echo "movie name is ".$title;
                //saying hello 
                echo "<h1> Hello ". $name. "!</h1>";
                echo "<h2>Select how many tickets you would like to reserve for ".$title ."</h2>";
                ?>
            </div>
            <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a id="brand_brand"class="navbar-brand" href="#">Future Films</a>
    </div>
    <ul id="navi_bar"class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="userreservatons.php">Your Reservatons</a></li>
      <li><a href="SignIn.php">Logout</a></li>
    </ul>
  </div>
</nav>
             <?php
             //getting the showtime ID from the form on the previous page
             $id = $_GET['id'];
            
             ?>
             
             <?php
             
             $quary2 = "SELECT * FROM ShowTimes WHERE Show_Time_ID = '$id'";
             $result2 = mysqli_query($conn, $quary2);
             
             //get the number of reservations for the showtime
             while($row =mysqli_fetch_array($result2)){
                 $reservations= $row['purchase_num'];
             }
             //calculate how many tickets are left 
             $numberofticketsleft = 30 - $reservations;
             echo "<h3> There are ".$numberofticketsleft." tickets left</h3>";
             
             
             //when the button from the form is pushed above put the reservation inside the datebase 
             if(isset($_POST['getnumber'])){
                 $quantity = $_POST['number'];
                 
               $quary=  "SELECT * FROM Purchases WHERE ShowTime_ID = '$id' AND email = '$email'";
               $result = mysqli_query($conn, $quary);
               
            
            $newreservation = $reservations + $quantity;
               echo "</br> New reservation: ".$newreservation;
               
               //check to make sure it is not over 30 tickets
                            if($reservations < 30 && $newreservation <= 30){
            
            //check to see if the row exists ot now 
                            if(mysqli_num_rows($result) > 0){
                   //update the row 
                   echo "the row exists";
                   $updatequary = "UPDATE Purchases
                   SET user_purchase_num = user_purchase_num + '$quantity'
                   WHERE ShowTime_ID = '$id' AND email = '$email'";
                   $updateresul = mysqli_query($conn, $updatequary);
               }else{
                   //create a new row 
                   echo "the row doesnt exist";
                   $insertQuery = "INSERT INTO Purchases(ShowTime_ID, email, user_purchase_num) 
                   VALUES ('$id', '$email', '$quantity') ";
                   $insertresult = mysqli_query($conn, $insertQuery);
               }
               //update the showtimes purchaces
                $showtimeupdate = "UPDATE ShowTimes
               SET purchase_num = purchase_num + '$quantity'
               WHERE Show_Time_ID = '$id'";
               $showtimeresult = mysqli_query($conn, $showtimeupdate);
               //refresh the page 
               echo "<meta http-equiv='refresh' content='1'>";
                 //if it equals 30 or is over 30 then tell the user that the reservation is full 
             }else if($reservations = 30 || $newreservation > 30){
                 echo "<h4>reservations full</h4>";
             }
               }
               
    
             ?>
              <form method = post>
                 <input type="number" name="number" min = "0" value = "0"/>
                   <button name = "getnumber" type="submit" class="btn btn-primary">Reserve Tickets</button>
             </form>
             
            </div>
            
        
            </body>
            </html>
            
            <?php
            //update function. use this whenever you finish adding something in the database
            function run_update ($sql){
                global $conn;
                if($conn->query($sql) === TRUE){
                    //echo "Database updated successfully <br>";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
 ?>