   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <div class="sidebar-box pt-md-4">
	             <h3 style="text-align:center;">Top Jokes and Top Jokers</h3>
	             <hr>
	            </div>
	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Top Jokes</h3>
      				<ul class="categories">
	            	<?php 
	            		 $result= mysqli_query($con, "SELECT * , COUNT(joke_id) AS counts FROM jokes INNER JOIN funny ON jokes.id=joke_id WHERE rate='funny' GROUP BY joke_id  ORDER BY Counts DESC LIMIT 10;") or die (mysqli_error());
							while ($row= mysqli_fetch_array ($result) ){
							$id= $row['id'];	

	            	?>
	                <li><a href="topjoke.php?id=<?php echo $id;?>"><?php echo $row['title']; ?> <span></span><?php echo "(".$row['counts'].")"; ?></span></a></li>
	                <?php } ?>
	              </ul>
	            </div>

	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Top Jokers</h3>

	              <?php 
	              	$rating=0;
	            		 $jokers= mysqli_query($con, "SELECT *,COUNT(*) AS counts,users.id as profid FROM users INNER JOIN jokes ON users.id = jokes.user_id INNER JOIN funny ON jokes.id = joke_id WHERE rate='funny' GROUP BY users.id ORDER BY counts DESC LIMIT 5") or die (mysqli_error());
							while ($jokerrow= mysqli_fetch_array ($jokers) ){	
								$image = $jokerrow['profile_image'];
								$ids= $jokerrow['profid'];
									$totalres=mysqli_query($con, "SELECT * FROM jokes WHERE user_id=$ids");
									$total=mysqli_num_rows($totalres);
									
								
	            	?>
	              <div class="block-21 mb-4 d-flex">
	                <a class="blog-img mr-4" href="jokerprofile.php?id=<?php echo $ids."&page=1";?>" style="background-image: url(profile/<?php echo $image; ?>);"></a>
	                <div class="text">
	                  <h3 class="heading"><a href="jokerprofile.php?id=<?php echo $ids."&page=1";?>"><?php echo $jokerrow['firstname']." ".$jokerrow['lastname']; ?></a></h3>
	                  <div class="meta">
	                    <div><a href="jokerprofile.php?id=<?php echo $ids."&page=1";?>">@<?php echo $jokerrow['username']; ?></a></div>
	                    <div><a ><span>Total Jokes: </span><?php  echo $total; ?></a></div>
	                    <div><a ><span>Funny Jokes:</span><?php echo $jokerrow['counts']; ?> </a></div>
	                  </div>
	                </div>
	              </div>
	          <?php } ?>
	            </div>

	           
	          </div>
	          <script type=></script>
