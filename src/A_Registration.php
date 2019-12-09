
<html>
    <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
        <title>Administrator registration</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		
    </head>
    <body>
    	<a href="/">Home</a>
        <a href="http://localhost/project/JobPositionsProject-master/src/A_Login.php">Login</a>
        <a href="http://localhost/project/JobPositionsProject-master/src/A_Registration.php">Registration</a>
        <br>
        <br>
        <br>
		
		<?php
		$servername   = "localhost";
		$database = "job_offers_db";
		$username = "user";
		
			
		$eerEmail=$errPass=$errName=$msg="";
		if(isset($_POST["xx"])){
			$email= $_POST['email'];
			$fname= $_POST['fname'];
			$lname= $_POST['lname'];
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];

			// $sql = "INSERT INTO users (id, username, email, password) 
			// 		  VALUES('1', $fname, '$lname', '7878')";
					$myCar1 = new Car();
					$myCar1->color = $fname;
					$myCar1->type = $lname;
					$myCar1->type1 = $password_1;

					array_push($cars, $myCar1);
			if ($db->query($sql) === TRUE) {
				echo "New record created successfully";
			
					
			} else {
				echo "Error: " . $sql ;
			}	  
		}

		if(isset($_POST["submit1"])){
			
		/*-- declare the variables */
		$email= $_POST['email'];
		$fname= $_POST['fname'];
		$lname= $_POST['lname'];
		$password_1 = $_POST['password_1'];
		$password_2 = $_POST['password_2'];
        $valid=true;
		
		if(empty($_POST['email']) 
		|| empty($_POST['fname'])
		|| empty($_POST['lname'])
		|| empty($_POST['password_1'])
		|| empty($_POST['password_2'])){
			$msg = "Please fill all the fields!";
			$valid=false;
		}
	
		//Check if a valid password has been entered
		if(empty($_POST['password_1']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
            $errPass= '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
            $valid=false;
		}
		//Check if a valid rep-password has been entered
		if(empty($_POST['password_2']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
            $errPass= '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
            $valid=false;
		}
		if($valid){
			echo "The form has been submitted";
		} else {
			$msg = "Please fill all the fields!";
		}

	} 

	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 

	$_SESSION['success'] = "";
	
	// REGISTER USER

	
	if (isset($_POST['submit']) && !empty($_POST['email']) 
	&& !empty($_POST['fname'])
	&& !empty($_POST['lname'])
	&& !empty($_POST['password_1'])
	&& !empty($_POST['password_2'])
	&& (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password_1"]) === 0)
	&& (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password_2"]) === 0)
	) {
		$db = mysqli_connect('localhost', 'root', '', 'job_offers_db');

		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($fname)) { array_push($errors, "fname is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
			$password = md5($password_1);//encrypt
			$query = "INSERT INTO users(
				EmailAddress,
				PASSWORD,
				PasswordSalt,
  				PasswordVersionId,
				FirstName,
				LastName,
				UserTypeId,
				TimeOfRegistration,
				RequirePasswordChange,
				PasswordTriesLeft,
				isVerified,
				isActive
			)
			VALUES(
				'$email',
				'$password_1',
				'$password',
              	'1',
				'$fname',
				'$lname',
				'3',
				'2019-11-27',
				'1',
				'2',
				'1',
				'1'
			)";
			if(mysqli_query($db, $query)){
			array_push($errors, "Insert succesful");
			} else{
			array_push($errors, "ERROR: Could not able to execute $query. " . mysqli_error($db));
			}
			
			$_SESSION['email'] = $email;
			$_SESSION['success'] = "You are now logged in";
			

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
  ?>        
		
		
<h2>Create Account</h2>		
<form role="form" method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<!----------------------------------------------E-mail ---------------------------------------------------->
<div class="input-group input-group-sm">
  <div class="form-group">
	  <h6>E-mail</h6>
	  <input type="email" name="email" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
</div>
<!----------------------------------------------Fisrt name ---------------------------------------------------->
<div class="input-group input-group-sm">
  <!--<div class="input-group-prepend"> -->
  <div class="form-group">
	<h6>First name</h6>
	<input type="text" minlength="4" name="fname" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
  </div>
 </div>
 <!-------------------------------------------- Last name ------------------------------------------------------>
<div class="input-group input-group-sm">
  <!--<div class="input-group-prepend"> -->
  <div class="form-group">
	<h6>Last name</h6>
	<input type="text" minlength="4" name="lname" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
 </div>
 
<!-------------------------------------------- Password ------------------------------------------------------>
<div class="input-group input-group-sm">
  <!--<div class="input-group-prepend"> -->
  <div class="form-group">
	<h6>Password</h6>
	<input type="password" minlength="8" name="password_1" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  <!-- <?php echo $errPass?> -->
 </div>
 <!-------------------------------------------- Repeat password ------------------------------------------------------>
<div class="input-group input-group-sm">
  <!--<div class="input-group-prepend"> -->
  <div class="form-group">
	<h6>Repeat password</h6>
	<input type="password" name="password_2"class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  <!-- <?php echo $errPass?> -->
 </div>
  <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-4">
		<button type="submit" class="btn purpleBtn"  data-toggle="button" aria-pressed="false" 
		autocomplete="off" name="submit">Registration</button>
        </div>
		</div>
		</div>

		<?php echo $msg; ?>
		<?php  if (count($errors) > 0) : ?>

  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>

<?php  endif ?>

</html>


