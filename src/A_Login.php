<html>
    <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
        <title>Administrator login</title>
		
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">

       
		
    </head>
	
    <body>
        <a href="/">Home</a>
        <a href="A_Login.php">Login</a>
        <a href="A_Registration.php">Registration</a>
        <br>
        <br>
        <br>
		
		<div class="container">
		
		<?php
    $errPass=$errName="";
    // $_POST['Fname']
  $msg = '';

    if(isset($_POST["registration"])){
      $host  = $_SERVER['HTTP_HOST'];
      $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $Reg = 'A_Registration.php';
      header("Location: http://$host$uri/$Reg");
    }

		if(isset($_POST["submit"]) && !empty($_POST['username']) 
               && !empty($_POST['password'])){
      if ($_POST['username'] == 'tutorialspoint' &&
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'tutorialspoint';
                  
                  echo 'You have entered valid use name and password';

                  } else {
                    $msg = 'Wrong username or password';
                  }
		if($valid){
			echo "The form has been submitted";
		}
	}
  ?>        
		
		
<h2>Login</h2>		
<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >

<div class="input-group input-group-sm">
  <!--<div class="input-group-prepend"> -->
  <div class="form-group">
	<h6>User Name</h6>
  <input type="text" class="form-control" name="username" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
 </div>

<div class="input-group input-group-sm">
  <div class="form-group">
	  <h6>Password</h6>
	  <input type="password" class="form-control" name="password" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
</div>

  <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-4">
    <button type="submit" class="btn purpleBtn" name="submit" 
    data-toggle="button" aria-pressed="false" autocomplete="off">Login</button>
        </div>
    </div>
    
    </div>
    <?php echo $msg; ?>
<br></br>
  
 <a class="font-weight-normal">Not yet a member?</a><a href="A_Registration.php" class="font-italic">        Sign up!</a>
</form>
</div>
</body>
</html>