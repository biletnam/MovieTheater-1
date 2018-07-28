<?php
include('config.php');
session_start();

echo $_GET['ID'];
$purchase_ID= $_GET['ID'];

//get the users current purchace number
$quary = "SELECT * FROM Purchases WHERE P_ID = '$purchase_ID'";
$result = mysqli_query($conn, $quary);
while($row = mysqli_fetch_array($result)){
    $showtimeid = $row['ShowTime_ID'];
    $userspurchasenumber = $row['user_purchase_num'];
}



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
      h2,h3{
          font-family:Star_Trek;
          color:black;
          background-color:lightblue;
          border-radius:6px;
          font-size:30px;
      }
      #para{
          font-family:Star_Trek;
          color:black;
          background-color:lightblue;
          border-radius:6px;
          font-size:30px;
          
      }
       @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #brandname, #navinavibar{
          font-family:Star_Trek;
          font-size:40px;
      }
      #hello_user{
          font-family:Star_Trek;
          background-color:lightblue;
          font-size:70px;
          opacity:0.9;
      }
    </style>
    
    <body>
        <div class ="container">
            <div id="hello_user" class = "jumbotron">
            
            <?php
            $user = $_SESSION['name'];
            //saying hello to the user
            echo "<h1> Hello ". $user. "!</h1>";
            echo "<h1>Set your new reservations</h1>";
            ?>
            </div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a id="brandname" class="navbar-brand" href="#">Future Films</a>
                        </div>
                        <ul id="navinavibar"class="nav navbar-nav">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="userreservatons.php">Your Reservatons</a></li>
                            <li><a href="SignIn.php">Logout</a></li>
                            </ul>
                            </div>
                            </nav>
                            
                            <?php
                            
                            $query2 = "SELECT * FROM ShowTimes WHERE Show_Time_ID = '$showtimeid'";
                            $result2 = mysqli_query($conn, $query2);
                            //get the number of purchaces for the showtime 
                            while($row2 = mysqli_fetch_array($result2)){
                                $showtimepurchasenum = $row2['purchase_num'];
                            }
                            //calculate how many tickets are left 
                            $ticketsleft = 30 - $showtimepurchasenum;
                            
                            
                            echo "<h3>You currently have $userspurchasenumber ticket(s) reserved for this showtime</h3>";
                            echo "<h2>There are $ticketsleft tickets left for this showtime </h2>";
                            
                            if(isset($_POST['getnewnumber'])){
                                //get the updated reservation number
                                $newnumber = $_POST['number'];
                                
                                if($newnumber > $userspurchasenumber ){
                                    //get the diffrence, tickets left and number of tickets purchaced 
                                    $difference = $newnumber - $userspurchasenumber;
                                    $ticketsleft = $ticketsleft - $difference;
                                    $showtimepurchasenum = $showtimepurchasenum + $difference;
                                }else if($newnumber < $userspurchasenumber){
                                    $difference = $userspurchasenumber - $newnumber;
                                    $ticketsleft = $ticketsleft + $difference;
                                    $showtimepurchasenum = $showtimepurchasenum - $difference;
                                }
                                echo $ticketsleft." ";
                                echo $showtimepurchasenum;
                                //check to see if it is equal to or over 30 
                                if($ticketsleft <= 30){
                                   
                                   //update showtimes and purchaces  
                                    $quary3 = "UPDATE ShowTimes 
                                    SET purchase_num = '$showtimepurchasenum'
                                    WHERE Show_Time_ID = $showtimeid";
                                    $result3 = mysqli_query($conn, $quary3);
                                    
                                    $quary4 = "UPDATE Purchases
                                    SET user_purchase_num = '$newnumber'
                                    WHERE P_ID = '$purchase_ID'";
                                    $result4 = mysqli_query($conn, $quary4);
                                    
                                    header("Refresh:0");
                                    
                                }else{
                                    echo "<p>too many tickets reserved</p>";
                                }
                                
                            }
                            ?>
                            <p id="para">Increase or decrease your reservation number: </p>
                            <form method = post>
                                <input type="number" name="number" min = "0" <?php echo "value = '$userspurchasenumber'"?>/>
                                <button name = "getnewnumber" type="submit" class="btn btn-primary">Edit Reservation</button>
                                </form>
                            </body>
                            
                            
                            
                            </html>