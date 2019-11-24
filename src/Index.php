<html>
    <head>
        <title>Open job positions for NBU students</title>
    </head>
    <body>
        <?php
            include "header.php";
            include "api/Users/UsersController.php";
            $users = new UsersController();
            $users->getUserForLogin('admin','admin',1);
        ?>
    </body>
</html>