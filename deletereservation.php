<?php
include('config.php');
session_start();

$userpurchaceID = $_GET['ID'];
echo "user purchace ID ".$userpurchaceID;

$getsurrentpurchasenum = "SELECT * FROM Purchases WHERE P_ID = '$userpurchaceID'";
$result = mysqli_query($conn, $getsurrentpurchasenum);
while($row = mysqli_fetch_array($result)){
    $purchacenum = $row['user_purchase_num'];
    $showtimeID = $row['ShowTime_ID'];
}

$delete = "DELETE FROM Purchases WHERE P_ID = '$userpurchaceID'";
$result1 = mysqli_query($conn, $delete);

$updateshowtime = "UPDATE ShowTimes SET purchase_num = purchase_num - '$purchacenum' WHERE Show_Time_ID = '$showtimeID'";
$result2 = mysqli_query($conn, $updateshowtime);

header("Location: userreservatons.php");



?>