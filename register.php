<?php
session_start();
include_once 'dbconnect.php';

$msg="";

if(isset($_POST['regbtn'])){
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $img=$_FILES['image']['name'];
    
        if (($_FILES['image']['name']!="")){
         $target_dir = "profile/";
         $file = time().$_FILES['image']['name'];
         $path = pathinfo($file);
         $filename = $path['filename'];
         $ext = $path['extension'];
         $temp_name = $_FILES['image']['tmp_name'];
         $path_filename_ext = $target_dir.$filename.".".$ext;
     }
     else{
     	$file = "noimage.png";
     }

         move_uploaded_file($temp_name,$path_filename_ext);
         $sql= "INSERT INTO users(firstname,lastname,username,password,email,profile_image) values('$fname','$lname','$username','$password','$email','$file')";
            if(mysqli_query($con, $sql)){
                  
                  ?>
                  <script>
                      alert("Successfully Registered");
                    location.replace("index.php")
                  </script>
                  <?php
                 }
                
              
            
            
     mysqli_close($con);

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Joke Ability</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/indexstyle.css">
</head>



<body>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Read some jokes and have some Fun!</p>
                        <a href="index.php" class="btn btn-info" style="width: 100px;">Login</a>
                    </div>
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register User</h3>
                                <?php echo $msg; ?>
                                <form method="POST" enctype="multipart/form-data">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="fname" placeholder="First Name *" value="" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name *" value="" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password *" value="" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Your Username*" value="" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" name="email" class="form-control" placeholder="Your Email*" value="" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" placeholder="Upload Profile*" value="" />
                                        </div>
                                        <input type="submit" class="btnRegister" name="regbtn" value="Register"/>
                                    </div>

                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>