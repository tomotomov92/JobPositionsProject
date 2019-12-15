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
            // $registrationResult = $users->createUser("test@test.com", "testPassword", "Test", "Test", UserType_User);
            // if ($registrationResult->isSuccess) {
            //     echo("Registration successful");
            // } else {
            //     echo($registrationResult->errorMessage);
            // }

            // // Login
            // $loginResult = $users->loginUser('test@test.com', 'testPassword', UserType_User);
            // if ($loginResult->isSuccess) {
            //     echo("Login successful");
            // } else {
            //     echo($loginResult->errorMessage);
            // }

            // // UpdatePassword
            // $updatePasswordResult = $users->updateUserPassword('test@test.com', 'testPassword', 'newTestPassword', UserType_User);
            // if ($updatePasswordResult->isSuccess) {
            //     echo("Password updated successfully");
            // } else {
            //     echo($updatePasswordResult->errorMessage);
            // }
        ?>
    </body>
</html>