<?php
  session_start();
  include_once 'dbconnect.php';
$error="";
  if(isset($_SESSION['user'])!="")
  {
     header("Location: home.php");
  }
    if(isset($_POST['loginbtn']))
    {
    $user = mysqli_real_escape_string($con,$_POST['username']);
    $upass = mysqli_real_escape_string($con,$_POST['pass']);

    
    $res=mysqli_query($con,"SELECT * FROM users WHERE username='$user'");
    $row=mysqli_fetch_array($res);
      if($row['password']==$upass)
    { 
      $_SESSION['user'] = $row['id'];
      $uname=$row['username'];
      header("Location: home.php?page=1"); 
    }
    else{
        $error="<p style='color:red;text-align:center;'><strong>Incorrect Username or Password</strong></p>";
        }
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
                        <a href="register.php" class="btn btn-info" style="width: 100px;">Register</a>
                    </div>
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Login User</h3>
                                <form method="POST" enctype="multipart/form-data">
                                <div class="row register-form">
                                    <div class="col-md-9" style="margin: auto">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Username *" value="" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="pass" placeholder="Password *" value="" required/>
                                        </div>
                                      <div><?php echo $error; ?></div>
                                        <div class="form-group">
                                          <input type="submit" class="btnRegister" name="loginbtn" value="login"/>
                                        </div>         
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