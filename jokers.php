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
					<li ><a href="home.php?page=1">Home</a></li>
					<li class="colorlib-active"><a href="jokers.php">Jokers</a></li>
					<li><a href="profile.php?page=1">My Jokes</a></li>
					<li><a href="addjoke.php">Add Joke</a></li>
					<li><a href="logout.php?logout">Logout</a></li>
					
				</ul>
			</nav>

			<div class="colorlib-footer">
				<h1 id="colorlib-logo" class="mb-4"><a href="index.html" style="background-image: url(images/bg_1.jpg);">Jokers <span>List</span></a></h1>
				<?php include "sidebarprof.php"; ?>
				
			</div>
		</aside> 
		<div id="colorlib-main">
			<section class="ftco-section">
				<div class="container">
					<div class="row px-md-4">

	 					<?php 
	 						$rating=0;
							$result= mysqli_query($con, "SELECT * FROM users order by id DESC") or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
									$id=$row['id'];
									$image = $row['profile_image'];
									$latestres = mysqli_query($con, "SELECT * FROM jokes where user_id=$id order by id DESC limit 1");
									$latest = mysqli_fetch_array($latestres);

									$totalres=mysqli_query($con, "SELECT * FROM users INNER JOIN jokes ON users.id = jokes.user_id INNER JOIN funny ON jokes.id = joke_id  WHERE users.id=$id");
									$total=mysqli_num_rows($totalres);
								    $tempfunnyrate=mysqli_query($con, "SELECT * FROM jokes INNER JOIN funny ON jokes.id = funny.joke_id WHERE jokes.user_id = $id && funny.rate='funny'");
								    $totalfunny=mysqli_num_rows($tempfunnyrate);
								    if($totalfunny){
								    $rating = ceil(($totalfunny/$total) * 100);
									}
								    if($rating >= 85){
								          
						?> 
						<div class="col-md-12">
							<div class="blog-entry ftco-animate d-md-flex">
								<a href="jokerprofile.php?id=<?php echo $id."&page=1";?>" class="img img-2" style="background-image: url(profile/<?php echo $row['profile_image']; ?>);"></a>
								<div class="text text-2 pl-md-4">
		              <h3 class="mb-2"><?php echo $row['firstname']." ".$row['lastname']; ?></h3>
		              <div class="meta-wrap">
										<p class="meta">
		              		<span><a href="jokerprofile.php?id=<?php echo $id."&page=1";?>">@<?php echo $row['username']; ?></a></span>
		              		<span><a ><i class="icon-folder-o mr-2"></i>Jokes Counter: </a></span>
		              		<span style="color:black"><?php echo $total; ?></span>


		              	</p>
	              	</div>
		              <p class="mb-4"><span><img src="images/badge.png" height="60" width="40"></span>Rating: <?php echo $rating."%"; ?><br>
		              	<h4>Latest Joke</h4>
		              	<h5>Title: <?php echo $latest['title'] ?></h5>
		              	<?php echo $latest['content'] ?>

</p>
		              <p><a href="jokerprofile.php?id=<?php echo $id."&page=1";?>" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
		            </div>
							</div>
						</div>
					<?php }} ?>
						
					<div class="row">
	          <div class="col text-center text-md-left">
	            <div class="block-27">
	              
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