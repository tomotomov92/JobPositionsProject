<html>
    <head>
        <title>Open job positions for NBU students</title>
    </head>
    <body>
        <a href="/">Home</a>
        
        <a href="/B_Login.php">Businesses</a>
        <a href="/Login.php">Users</a>
        <br>
        <br>
        <br>
        <?php
            include_once('api/Users/UsersController.php');
            $usersController = new UsersController();
            echo $usersController->getUsers();
        ?>
    </body>
</html>