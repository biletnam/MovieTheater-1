<html>
    <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style type="text/css">
      #login{
        border-radius:5px;
        padding:6px 16px;
        background-color:white;
        border:1px solid lightgrey;
        color:black;
      }
      
      .container:hover{
        background-color:lightblue;
        color:white;
        padding:40px 90px 40px 40px;
        border:5px solid;
        margin:0;
        opacity:1.0;
      }
      .container{
        background-color:lightblue;
        color:white;
        padding:40px 90px 40px 40px;
        border:5px solid;
        margin:0;
        opacity:0.9;
      }
      body{
        
        background-image: url("space.gif");
        background-repeat:no-repeat;
        background-size:cover;
      }
      #header{
          background-color:lightblue;
          opacity:0.9;
      }
      .img{
        display: block;
        margin-left:auto;
        margin-right:auto;
      }
      p{
        color:red;
        font-weight:bold;
      }
      #head_2{
        font-family: Star_Trek;
        color:black;
        font-size:40px;
      }
       @font-face{
          font-family:Star_Trek;
          src: url(Star_Trek.ttf);
      }
      #email, #name{
        font-family: Star_Trek;
        color:black;
        font-size:30px;
      }
    </style>
     <header>
        <div id="header" class=jumbotron>
            <img src="Website Title.png"></img>
        </div>
    </header>
    <body>
  
  <div class = "container">
    <div class="row">
    <div class="col-sm-3">
    
    </div>
    <div class="col-sm-6">
       <h2 id="head_2">Sign Up or Sign In</h2>
  <form  method="post" >
      <label id="email" for="email">Email:</label>
      <input  type="email" name="Email" class="form-control" id="email" placeholder="Enter email">
      <label id="name"for="name">Name:</label>
      <input type="name" name = "Name" class="form-control" id="name" placeholder="Enter name">
    <button id="register" type = "submit" name = "register" class="btn btn-default">Sign up</button>
    <button id="login" type = "submit" name = "login" class "btn btn-default">Sign in</button>
  </form>
    </div>
    <div class="col-sm-3">
    </div>
  </div>
    
  </div>
</body>

<?php
include('config.php');
session_start();
//if the register button is pushed
if(isset($_POST['register']))
{


//set variables for both the inputs
$email = $_POST['Email'];
$name = $_POST['Name'];

//check to make sure the user didnt leave anything blank
if(empty($name) || empty($email)){
  echo "<p>you need to fill out both name and email</p>";
}else{
$sql2 = "SELECT * FROM User WHERE email = '$email' and name = '$name'";
$result2 = mysqli_query($conn, $sql2);
//check to see if the account exists
if(mysqli_num_rows($result2) >= 1){
  echo "<p>That account already exists</p>";
}else{
  //crete the account
  add_user($email,$name);
  echo "account created";
}
}

//if the login button is pushed 
}else if(isset($_POST['login'])){
  //set variables for both inputs
  $email = $_POST['Email'];
  $name = $_POST['Name'];
  //Query to get all attributes that corresspond to email and name
 $sql = "SELECT * FROM User WHERE email = '$email' and name = '$name'";
 //get the query 
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  
  //if the number of rows from that query equals one then sign in
  if($count ==1){
    //get the sessions variables 
  $_SESSION['login'] = $email;
  $_SESSION['name'] = $name;
    echo "success";
    //go to home.php
   header("Location: home.php");
   //if not then something is incorrect
  }else{
    echo "<p>incorrect name or email</p>";
  }
}

   // Runs select command on student table
	function add_user ($email, $name)
	{
		global $conn;

        $sql_u = "SELECT * FROM User WHERE email = '$email'";
        $res_u = mysqli_query($conn, $sql_u);
    
        if(mysqli_num_rows($res_u)>0){
            echo "Sorry... that email is already taken. Use another!";
        }else{
            
        $sql_i = mysqli_query($conn,"INSERT INTO User(email, name) VALUES ('$email', '$name')");
          
                
        }
	}

?>
</html>