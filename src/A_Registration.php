
<html>
    <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
        <title>Administrator registration</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		
    </head>
    <body>
		
		<?php
		$servername   = "localhost";
		$database = "job_offers_db";
		$username = "user";
		$password = "password";

		// class Car
		// {
		// 	public $color;
		// 	public $type;
		// 	public $type1;
		// }

		// $myCar = new Car();
		// $myCar->color = 'red';
		// $myCar->type = 'sedan';
		// $myCar->type1 = 'sport';
	
		// $yourCar = new Car();
		// $yourCar->color = 'blue';
		// $yourCar->type = 'suv';
		// $yourCar->type1 = 'sport';
		
		// $yourCar1 = new Car();
		// $yourCar1->color = 'blue';
		// $yourCar1->type = 'suv';
		// $yourCar1->type1 = 'sport';
		// $cars = array($myCar, $yourCar, $yourCar1);
	
		
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
		//Check if email has been enterd and is valid
		// if(empty($_POST['email'])){
		// 	$errEmail='Please enter a valid e-mail addres';
		// 	$valid=false;
		// }
		// //Check the if first name has been entered
		// if(empty($_POST['fname'])){
		// 	$errName='Please enter your user name!';
		// 	$valid=false;
		// }
		// //Check the if last name has been entered
		// if(empty($_POST['lname'])){
		// 	$errName='Please enter your user name!';
		// 	$valid=false;
		// }
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
	<input type="text" minlength="4" name="fname" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">  <!-- data-bind="value: Rado"> -->
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
		<button type="submit" class="btn purpleBtn" style="float: right" data-toggle="button" aria-pressed="false" 
		autocomplete="off" name="submit">Registration</button>
		<!-- <button type="submit" class="btn" name="reg_user" 
    data-toggle="button" aria-pressed="false" autocomplete="off">Registration</button> -->
           <!-- <button class="btn btn-primary btn-sx" type="button">Confirm</button> -->
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
<!--
<table class="table">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
<?php foreach ($cars as $error) : ?>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $error->color ?></td>
	  <td><?php echo $error->type ?></td>
	  <td><?php echo $error->type1 ?></td>
	  <td>		<button type="submit" class="btn" name="xx" 
    data-toggle="button" aria-pressed="false" autocomplete="off">X</button> </td>
    </tr>
  </tbody>

  	<?php endforeach ?>
	  </table>
	  -->
</div>
</form>
</div>
</body>

<!-- <script>
function addTable() {
    var myTableDiv = document.getElementById("metric_results")
    var table = document.createElement('TABLE')
    var tableBody = document.createElement('TBODY')

    table.border = '1'
    table.appendChild(tableBody);

    var heading = new Array();
    heading[0] = "Request Type"
    heading[1] = "Group A"
    heading[2] = "Groub B"
    heading[3] = "Group C"
    heading[4] = "Total"

    var stock = new Array()
    stock[0] = new Array("Cars", "88.625", "85.50", "85.81", "987")
    stock[1] = new Array("Veggies", "88.625", "85.50", "85.81", "988")
    stock[2] = new Array("Colors", "88.625", "85.50", "85.81", "989")
    stock[3] = new Array("Numbers", "88.625", "85.50", "85.81", "990")
    stock[4] = new Array("Requests", "88.625", "85.50", "85.81", "991")

    //TABLE COLUMNS
    var tr = document.createElement('TR');
    tableBody.appendChild(tr);
    for (i = 0; i < heading.length; i++) {
        var th = document.createElement('TH')
        th.width = '75';
        th.appendChild(document.createTextNode(heading[i]));
        tr.appendChild(th);
    }

    //TABLE ROWS
    for (i = 0; i < stock.length; i++) {
        var tr = document.createElement('TR');
        for (j = 0; j < stock[i].length; j++) {
            var td = document.createElement('TD')
            td.appendChild(document.createTextNode(stock[i][j]));
            tr.appendChild(td)
        }
        tableBody.appendChild(tr);
    }  
    myTableDiv.appendChild(table)
}
</script> -->
</html>


