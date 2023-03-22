<?php
include_once '../helpers/session_helper.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="index.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="container">
        <a target="_blank" href="../index.php">
            <div class="logo">
                <img src="Logo-Hotel-Neptune.png" alt="Logo Hotel Neptune" />
            </div>
        </a>

        <?php flash('login') ?>

        <form action="../controllers/Users.php" method="POST" class="box">

            <input type="hidden" name="type" value="login">

            <label class="boxInput">
                Email

                <input type="text" name="name/email" placeholder="Email...">
            </label>


            <label class="boxInput">
                Password

                <input type="password" name="usersPwd" placeholder="Password...">
            </label>


            <div class="button-submit">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>