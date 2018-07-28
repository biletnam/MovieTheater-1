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
      #nav1, #brandbrandbrand{
          font-family:Star_Trek;
          font-size:40px;
          
                }
    
      .container{
          background-color:lightblue;
          color:black;
          border-radius:7px;
      }
      .jumbotron{
          background-color:lightblue;
          color:black;
          font-family:Star_Trek;
          font-size: 70px;
      }
      @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #select_date{
          font-family: Star_Trek;
          font-size:30px;
      }
    </style>

    <body>
      
      <?php
      //getting the movie ID
      $ID = $_GET['ID'];
      //echo "The id is ".$ID;
      //Queery for movie title where movie_ID equals te movie_ID if the movie that was clicked on
        $result_For_Title = mysqli_query($conn,"SELECT Title FROM Movie WHERE movie_ID ='$ID'");
          //looping through data base to get that query 
        while($row = mysqli_fetch_array($result_For_Title)){
                   $Title = $row['Title'];
               }
      
      ?>
      
        
      <div class ="container">
            <div class = "jumbotron">
                <?php
                //says hello to the user and displays the name of the movie
                echo "<h3 style = 'position: absolute; '>Movie Times For ".$Title."</h3>";
                ?>
            </div>
                          <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a id="brandbrandbrand"class="navbar-brand" href="#">Future Films</a>
    </div>
    <ul id="nav1" class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="userreservatons.php">Your Reservatons</a></li>
      <li><a href="SignIn.php">Logout</a></li>
    </ul>
  </div>
</nav>
                
                    <div class="row">
    <div class="col-sm-3">
    
    </div>
    <div class="col-sm-6">
          <form method = "post">
                
                <label id="select_date" for="MovieDate">Select a date:</label>
                <input type="date" name="moviedate">
                 <button type="gettimes" name = "time" class="btn btn-default">Submit</button>
                </form>
                
                 <?php
        //if the button from the form above is pushed 
         if(isset($_POST['time'])){
                    //store the inputted date in the date variable 
                  $date = $_POST['moviedate'];
                  //query to get show times for the movie_ID and date
                 $result_For_times = mysqli_query($conn, "SELECT * FROM ShowTimes WHERE Date = '$date' and Movie_ID = '$ID'");
                 //display a table that has all movie times
                  echo "<h3>Movie Times For $date</h3>";
                 
                 echo "<ul class='list-group'>";
 echo "<li class='list-group-item'>";
 //display the movie times for the movie 
 $count = 0;
while($row = mysqli_fetch_array($result_For_times)){
    if($count++>0) echo ",";
    //goees to reserveticket.php and carries over the showtimeID and movie title when clicked 
echo " <a href ='reserveticket.php?id=".$row['Show_Time_ID']."&title=".$Title."' >".$row['Time']."</a>";
}
echo "</li>";
echo "</ul>";
                }
                
                 
            
        ?>
    </div>
    <div class="col-sm-3">
     
    </div>
  </div>
                
        
       
                </div>
</body>
</html>