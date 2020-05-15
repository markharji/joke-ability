<?php
session_start();

include_once 'dbconnect.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con, "SELECT * FROM users WHERE id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$user_id = $userRow['id'];



		    $id=mysqli_real_escape_string($con,$_POST['id']);

        $check=mysqli_query($con, "SELECT * FROM funny WHERE joke_id=$id && user_id=$user_id && (rate<>'funny' || rate<>'notfunny') ");
        $joke=mysqli_fetch_array($check);

        if($joke == ""){
        $sql= "INSERT INTO funny(user_id,joke_id,rate) values('$user_id','$id','funny')";
           if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
          } 
          else {
            echo json_encode(array("statusCode"=>201));
          }
          mysqli_close($con);
        }
        else{

          if($joke['rate'] == "notfunny"){
                $sql = "UPDATE `funny` 
            SET `rate`='funny' WHERE user_id=$user_id && joke_id=$id";
            if (mysqli_query($con, $sql)) {
              echo json_encode(array("statusCode"=>200));
            } 
            else {
              echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($con);
                    }
        }
?>