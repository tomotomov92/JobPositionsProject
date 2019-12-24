<html>
    <head>
        <title>Open job positions for NBU students</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/job_offer.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    </head>
    <body>
        <?php
            include "header.php";
            include "BusinessLogic/Users.php";
            
            $users = new BusinessLogic\Users();

            // // Registration
            // $registrationResult = $users->registerUser("test@test.com", "testPassword", "Test", "Test", UserType_User);
            // if ($registrationResult->isSuccess) {
            //     echo("Registration successful");
            // } else {
            //     echo($registrationResult->errorMessage);
            // }

            // // Login
            // $loginResult = $users->loginUser('admin', 'admin', UserType_Administrator);
            // if ($loginResult->isSuccess) {
            //     echo("Login successful");
            // } else {
            //     echo($loginResult->errorMessage);
            // }

            // // Login
            // $loginResult = $users->loginUser('test@test.com', 'testPassword', UserType_User);
            // if ($loginResult->isSuccess) {
            //     echo("Login successful");
            // } else {
            //     echo($loginResult->errorMessage);
            // }

            // // Update Password
            // $updatePasswordResult = $users->updateUserPassword('test@test.com', 'testPassword', 'newTestPassword', UserType_User);
            // if ($updatePasswordResult->isSuccess) {
            //     echo("Password updated successfully");
            // } else {
            //     echo($updatePasswordResult->errorMessage);
            // }

            // // Update Verification Code
            // $users->generateAndSendVerificationEmail('test@test.com', UserType_User);

            // // Verify User
            // $userVerification = $users->verifyUser('test@test.com', '6747433a60b8e93e6f42d2f1024593b6c197c6e39e3e1a27f4d0a4745eac5d9a', UserType_User);
            // if ($userVerification->isSuccess) {
            //     echo("User verified successfully");
            // } else {
            //     echo($userVerification->errorMessage);
            // }
        ?>

        <?php include "footer.php" ?>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>