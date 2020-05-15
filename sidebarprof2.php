				<?php 
			$totalres=mysqli_query($con, "SELECT * FROM users INNER JOIN jokes ON users.id = jokes.user_id INNER JOIN funny ON jokes.id = joke_id  WHERE users.id=$curid");
					$total=mysqli_num_rows($totalres);
					$tempfunnyrate=mysqli_query($con, "SELECT * FROM jokes INNER JOIN funny ON jokes.id = funny.joke_id WHERE jokes.user_id = $curid && funny.rate='funny'");
					$totalfunny=mysqli_num_rows($tempfunnyrate);
					$rating = ceil(($totalfunny/$total) * 100);					
				?>

			<div class="mb-4">
				<h3>Joker Profile!!</h3>
            	<div>Username: </i><?php echo $currentprof['username'] ?></div>
				<div>First Name: <?php echo $currentprof['firstname']?></div>
				<div>Last Name: <?php echo $currentprof['lastname']?></div>
				<div><?php if($rating>=85){
					echo "<span><img src='images/badge.png' height='50' width='30'></span>";
				} ?>Rating: <?php echo $rating."%";?></div>
          </form>