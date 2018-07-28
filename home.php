<?php
include('config.php');
session_start();
//getting the users name
$user = $_SESSION['name'];

?>
<html>
    <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style type="text/css">
        th, td{
            padding:15;
            text-align: left;
        }
        .jumbotron{
            background:lightblue;
            color:black;
            font-size: 90px;
            text-align:center;
            font-family:Star_Trek;
            
        }
        /*.container-fluid{*/
        /*    background:lightblue;*/
        /*    color:white;*/
        /*    border-radius:10px;*/
        /*}*/
          body{
        
        background-image: url("space.gif");
        background-repeat:no-repeat;
        background-size:cover;
      }
      #header{
          background-color:lightblue;
      }
      @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #title_title, #navbar_bar1{
          font-family:Star_Trek;
          font-size:40px;
      }
    </style>
    <header>
        <div id="header" class=jumbotron>
            <img src="Website Title.png"></img>
        </div>
    </header>
    <body>
        <div class ="container">
            <div class = "jumbotron">
                <?php
                //saying hello to the user
                echo "<h1> Hello ". $user. "!</h1>";
                echo "<h2> Movie List</h2>";
                ?>
            </div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a id="title_title" class="navbar-brand" href="#">Future Films</a>
                        </div>
                        <ul id="navbar_bar1"class="nav navbar-nav">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="userreservatons.php">Your Reservatons</a></li>
                            <li><a href="SignIn.php">Logout</a></li>
                            </ul>
                            </div>
                            </nav>
                            
                            <div class = "list-group">
                                <?php
                                
                                //display the list of movies and all the info about the movies
                                $result = mysqli_query($conn,"SELECT * FROM Movie");
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['movie_ID'];
                                    //goes to ShowTImes.php and carries over the movie_id
                                    echo "<a href = 'ShowTimes.php?ID=".$row['movie_ID']."' class='list-group-item list-group-item-action flex-column align-items-start'>";
                                    echo 
                                    "<div class='d-flex w-100 justify-content-between'>
                                    <h3 class='mb-1'>".$row['Title']."</h3>
                                    <small> Rated ".$row['Rating']."</small>
                                    </div>
                                    <p class='mb-1'>".$row['Description']."</p>
                                    
                                        <div class='row'>
                                        <div class='col-sm-3'>
                                        </div>
                                        <div class='col-sm-6'>
                                        <div class='d-flex w-100 justify-content-between'>
                                        <img src = '/New Folder/movie_ID".$row['movie_ID'].".jpg' style = 'width:50%'>
                                        </div>
                                        </div>
                                        <div class='col-sm-3'>
                                        </div>
                                        </div>
                                    
                                    <small>";
                                    
                                     //cast and crew go in here 
                                     $join_Actor = "SELECT *
                                     FROM Assignment
                                     INNER JOIN Cast
                                     ON Assignment.C_ID = Cast.C_ID
                                     WHERE movie_ID = '$id' AND Job_Title = 'Actor'";
                                     
                                     $join_director = "SELECT *
                                     FROM Assignment
                                     INNER JOIN Cast
                                     ON Assignment.C_ID = Cast.C_ID
                                     WHERE movie_ID = '$id' AND Job_Title = 'Director'";
                                     //display the director of the movie 
                                     echo "Directed by ";
                                     $result_For_Director = mysqli_query($conn, $join_director);
                                     while($row3 = mysqli_fetch_array($result_For_Director)){
                                         echo $row3['Name'];
                                     }
                                     //show the stars of the movie
                                     echo "</br>";
                                     echo "Starring:";
                                     $result_For_Actor= mysqli_query($conn, $join_Actor);
                                     $count = 0;
                                     while($row2 = mysqli_fetch_array($result_For_Actor)){
                                         if($count++ > 0) echo ",";
                                         echo " ".$row2['Name'];
                                         
                                     }
                                    echo "</small>";
                                    echo "</a>";
                                }
                                ?>
                                </div>
                                </div>
                                </body>
                                </html>
                                
                                
                                
