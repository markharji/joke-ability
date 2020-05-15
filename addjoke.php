<?php
session_start();
date_default_timezone_set("Asia/Manila");
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con, "SELECT * FROM users WHERE id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$user_id = $userRow['id'];

if(isset($_POST['jokebtn'])){
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $date = date("Y-m-d h:i:s a");
         $sql= "INSERT INTO jokes(user_id,title,content,timePosted) values('$user_id','$title','$content','$date')";
            if(mysqli_query($con, $sql)){
                  ?>
                  <script>
                      alert("Successfully Add Joke");
                      location.replace("home.php?page=1");
                  </script>
                  <?php
                 }
        
            
     mysqli_close($con);

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Joke Ability</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li><a href="home.php?page=1">Home</a></li>
					<li><a href="jokers.php">Jokers</a></li>
					<li><a href="profile.php?page=1">My Jokes</a></li>
					<li class="colorlib-active"><a href="addjoke.php">Add Joke</a></li>
					<li><a href="logout.php?logout">Logout</a></li>

				</ul>
			</nav>

			<div class="colorlib-footer">
				<h1 id="colorlib-logo" class="mb-3"><a href="index.html" style="background-image: url(images/bg_1.jpg);">Joke <span>Ability</span></a></h1>
			<?php include "sidebarprof.php"; ?>
			</div>
		</aside> <!-- END COLORLIB-ASIDE -->
		<div id="colorlib-main">
			<section class="ftco-section contact-section px-md-4">
	      <div class="container">
	        <div class="row d-flex mb-5 contact-info">
	          <div class="col-md-12 mb-4">
	            <h2 class="h3">Add Your Joke Here!!!</h2>
	          </div>
	        </div>
	        <div class="row block-9">
	          <div class="col-lg-8 d-flex">
	            <form method="POST" class="bg-light p-5 contact-form">
	              <div class="form-group">
	                <input type="text" class="form-control" name="title" placeholder="Title">
	              </div>
	              <div class="form-group">
	                <textarea  id="" cols="30" rows="7" name="content" class="form-control" placeholder="Joke"></textarea>
	              </div>
	              <div class="form-group">
	                <input type="submit" value="Add Joke" name="jokebtn" class="btn btn-primary py-3 px-5">
	              </div>
	            </form>
	          
	          </div>

	          <div class="col-lg-4 d-flex">
	          	<div class="bg-light"> <img src="images/joketime.png" style="width: 100%;height:100%;"></div>
	          </div>
	        </div>
	      </div>
	    </section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>