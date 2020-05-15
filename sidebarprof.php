				<?php 
				$rating=0;
			$totalres=mysqli_query($con, "SELECT * FROM users INNER JOIN jokes ON users.id = jokes.user_id INNER JOIN funny ON jokes.id = joke_id  WHERE users.id=$user_id");
					$total=mysqli_num_rows($totalres);
					$tempfunnyrate=mysqli_query($con, "SELECT * FROM jokes INNER JOIN funny ON jokes.id = funny.joke_id WHERE jokes.user_id = $user_id && funny.rate='funny'");
					$totalfunny=mysqli_num_rows($tempfunnyrate);
					if($total!=0){
					$rating = ceil(($totalfunny/$total) * 100);		
					}			
				?>

			<div class="mb-4">
					<h3>About Me!!</h3>
            	<div>Username: </i><?php echo $userRow['username'] ?></div>
				<div>First Name: <?php echo $userRow['firstname']?></div>
				<div>Last Name: <?php echo $userRow['lastname']?></div>
				<div><?php if($rating>=85){
					echo "<span><img src='images/badge.png' height='50' width='30'></span>";
				} ?>Rating: <?php echo $rating."%";?></div>
          </form>