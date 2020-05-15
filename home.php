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
<style>
	.btns{
		color:grey;
		cursor: pointer;
	}
</style>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="home.php?page=1">Home</a></li>
					<li><a href="jokers.php">Jokers</a></li>
					<li><a href="profile.php?page=1">My Jokes</a></li>
					<li><a href="addjoke.php">Add Joke</a></li>
					<li><a href="logout.php?logout">Logout</a></li>

				</ul>
			</nav>

			<div class="colorlib-footer">
				<h1 id="colorlib-logo" class="mb-3"><a href="home.php?page=1" style="background-image: url(images/bg_1.jpg);">Joke <span>Ability</span></a></h1>
				<?php include "sidebarprof.php"; ?>
				</div>
			
			</div>
		</aside> <!-- END COLORLIB-ASIDE -->
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
	    		<div class="row d-flex">
	    			<div class="col-xl-8 py-5 px-md-5">
	    				<div class="row pt-md-4">
	    						 <?php 
	    						 $color="";
	    						 $page=$_GET['page'];	
									if($page=="" || $page=="1"){
										$page1=0;
									}
									else{
										$page1=($page*10)-10;
									}
								        $result= mysqli_query($con, "SELECT * FROM jokes order by id DESC LIMIT $page1, 10") or die (mysqli_error());
								                    while ($row= mysqli_fetch_array ($result) ){
								                    	 $id=$row['id'];
								                    	 $userid=$row['user_id'];
								                  $tempres=mysqli_query($con, "SELECT * FROM users WHERE id=$userid");
								                  $tempUser=mysqli_fetch_array($tempres);
								                  $tempjokeres=mysqli_query($con, "SELECT * FROM funny WHERE joke_id=$id && user_id= $user_id");
								                  $tempjoke=mysqli_fetch_array($tempjokeres);
								             	  $image = $tempUser['profile_image'];
								                       
								     ?>     
			    			<div class="col-md-12">
									<div class="blog-entry ftco-animate d-md-flex">
										<a href="jokerprofile.php?id=<?php echo $tempUser['id']."&page=1";?>" class="img img-2" style="background-image: url(profile/<?php echo $image; ?>);"></a>
										<div class="text text-2 pl-md-4">
				              <h3 class="mb-2"><a ><?php echo $row['title'] ?></a></h3>
				              <div class="meta-wrap">
									<p class="meta">
				              		<span><i class="icon-calendar mr-2"></i><?php echo $row['timePosted'] ?></span>
				              		<span><a >Joke By: </a></span>
				              		<span>@<a href="jokerprofile.php?id=<?php echo $tempUser['id']."&page=1";?>"><?php echo $tempUser['username']?></a></span>
				              	</p>
			              	</div>
				              <p class="mb-4"><?php echo $row['content'] ?></p>
				              <div style="display: flex;justify-content: space-around;">
				              <a class="btn-custom btns" id="<?php echo "funny".$id; ?>" 
				              	style="<?php 	if($tempjoke['rate']=="funny"){
								                  		echo "color:blue";
								                  	}?>"
				              	onclick="rateFunny(<?php echo $id; ?>)">Funny 🤣</span></a>
				              <a class="btn-custom btns"  id="<?php echo "notfunny".$id; ?>" style="<?php 	if($tempjoke['rate']=="notfunny"){
								                  		echo "color:red";
								                  	}?>" onclick="rateNotFunny(<?php echo $id; ?>)">Not Funny 😒</span></a>
				         	  </div>
				            </div>
									</div>
							</div>
						<?php } ?>
			    		</div><!-- END-->
			    		<div class="row">


			          <div class="col">
			            <div class="block-27">
			              <?php
					$result1=mysqli_query($con, "SELECT * FROM jokes") or die (mysql_error());
					$count=mysqli_num_rows($result1);
				
					$count=$count/10;
					$a=ceil($count);

				echo "<a class='btn btn-danger' style='margin-right:20px;color:white' disabled>Page:</a>";
					for($b=1; $b<=$a; $b++){
							?><a style="color:white" href="home.php?page=<?php echo $b; ?>" 
								class="btn btn-<?php if($page==$b){
									echo "success";}
									else{
										echo "info";
									}?> center-inline-block"
								><?php echo $b."   "; ?></a><?php
							
						}
					?>
			            </div>
			          </div>
			        </div>
			    	</div>
	    			<?php include "sidebar.php";?><!-- END COL -->
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
  <script src="js/main.js"></script>
    

  <script>

function rateFunny(id){
    $.ajax({
                url: "rateFunny.php",
                type: "POST",
                async: false,
                data: {
                    "id": id,    
                },
                success: function(d){
                	$("#funny"+id).css("color","blue");	
                	$("#notfunny"+id).css("color","grey");			
                	var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
								
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
                    
                }
            });
};

function rateNotFunny(id){
    $.ajax({
                url: "rateNotFunny.php",
                type: "POST",
                async: false,
                data: {
                    "id": id,    
                },
                success: function(d){
                	$("#funny"+id).css("color","grey");	
                	$("#notfunny"+id).css("color","red");			
                	var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){					
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
                    
                }
            });
};

</script>
  </body>
</html>