<html>
    <head>
        <title>Open job positions for NBU students</title>
    </head>
    <body>
        <?php
            include "header.php";
            include "BusinessLogic/Users.php";
            $users = new BusinessLogic\Users();
            $loginResult = $users->loginUser('admin','ad1min',1);
            if ($loginResult->isSuccess) {
                echo("Login successful");
            } else {
                echo($loginResult->errorMessage);
            }
        ?>
    </body>
</html>