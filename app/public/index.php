<?php
session_start();
?>

<DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="index.css" />
        <title>Acceuil-Hotel-Neptune</title>
        <link rel="icon" type="image/png" sizes="16x16" href="Logo-Neptune.png" />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet" />
    </head>

    <body>
        <div class="container">
            <div class="nav">
                <div class="logo">
                    <img src="./images/logo.svg" alt="Logo Hotel Neptune" />
                </div>
                <div class='button-nav'>
                    <?php if (isset($_SESSION['usersId'])) { ?>
                    <form action="controllers/Users.php" method="POST">
                        <input type="hidden" name="type" value="logout">
                        <input type="submit" class="Login" value="Log Out">
                    </form>
                    <a class="Register" href="reservation/index.php">Reserver</a>
                    <?php } else { ?>
                    <a href="register/index.php" class="Register">Register</a>
                    <button class="Login"><a href="login/index.php">Login</a></button>
                    <?php } ?>
                </div>
                <!-- <div class="button-nav">
                    <a href="register/index.php" class="Register">Register</a>
                    <button class="Login"><a href="login/index.php">Login</a></button>
                </div> -->
            </div>
            <div class="page">
                <div class="texte">
                    <h1 class="titre-texte">HOTEL NEPTUNE</h1>

                    <p class="para">
                        Profitez d'un séjour confortable ! 53 chambres à votre
                        disposition, une réception 24/7, une piscine, un restaurant, la
                        plage à 300m...
                    </p>
                </div>
                <div class="image-hotel">
                    <img src="./images/Images.png" alt="Photos Hotel" />
                </div>
            </div>
        </div>
    </body>

    </html>
</DOCTYPE>