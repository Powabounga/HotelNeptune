<?php
require_once '../helpers/session_helper.php';
require '../models/User.php';
require '../models/Chambre.php';

if (!isset($_SESSION['admin'])) {
    redirect('/index.php');
}

if (!$_SESSION['admin']) {
    redirect('/index.php');
}

$user = new User;
$chambre = new Chambre;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../global.css">
    <script type='module' src='../script.js'></script>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
   <header>
        <div class="container nav">
            <a href="/">
                <img src="../images/logo.svg" alt="Logo Hotel Neptune" />
            </a>

            <nav>
                <ul>
                    <?php if (isset($_SESSION['userId'])) : ?>
                    <li>
                        <a href="/reservation">Reservation</a>
                    </li>
                    <li>
                        <a href="../controllers/Users.php?q=logout">Logout</a>
                    </li>
                    <?php if ($_SESSION['admin']) : ?>
                    <li>
                        <a href="/admin">Admin</a>
                    </li>
                    <?php endif; ?>
                    <?php else : ?>
                    <li>
                        <a href="/register">Register</a>
                    </li>
                    <li>
                        <a href="/login">Login</a>
                    </li>
                    <?php endif; ?>

                    <button class='menu-btn'><img class='close' src="../images/close.svg"
                            alt="close mobile menu icon"></button>
                </ul>

                <button class="menu-btn"><img class='burger' src="../images/burger.svg" alt="menu burger icon"></button>
            </nav>
        </div>
    </header>

    <main>
        <div class='mainContainer'>
            <div class='editContainer'>
                <div class='editChambres editBox'>
                    <h2>Chambres</h2>
                    <div class='editContent'>
                        <?php
                        $chambresCount = $user->getAllChambresCount();
                        echo "<p>$chambresCount</p>";
                        ?>

                        <a href="/admin/chambres.php">Edit</a>
                    </div>
                </div>

                <div class='editUsers editBox'>
                    <h2>Users</h2>
                    <div class='editContent'>
                        <?php
                        $userCount = $user->getAllUsersCount();
                        echo "<p>$userCount</p>";
                        ?>
                        <a href="/admin/users.php">Edit</a>
                    </div>
                </div>
            </div>

            <section>
                <h2 class='statsTitle'>Stats</h2>

                <div class='stat'>
                    <h3>Rooms Booked</h3>

                    <label>
                        <span class="sr-only">Loading progress</span>
                        <progress indeterminate role="progressbar" aria-describedby="loading-zone" tabindex="-1"
                            value="70" max="100"></progress>
                    </label>

                    <p>70/123</p>
                </div>

                <div class='stat'>
                    <h3>Total Users</h3>

                    <?php echo "<p>$userCount</p>";?>
                </div>
            </section>
        </div>
    </main>
</body>

</html>