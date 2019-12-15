<html>
    <head>
        <title>Open job positions for NBU students</title>
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
    </body>
</html>