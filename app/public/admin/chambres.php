<?php
require_once '../helpers/session_helper.php';
include_once '../models/User.php';


if (!isset($_SESSION['admin'])) {
    redirect('/index.php');
}

if (!$_SESSION['admin']) {
    redirect('/index.php');
}

$model = new User;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../global.css">
    <title>Document</title>
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
    
    <table>
        <tr>
            <th>Chambre PHOTO</th>
            <th>Chambres Id</th>
            <th>Type Chambre</th>
            <th>Prix</th>
        </tr>
        <?php foreach ($model->getAllChambres() as $key => $chambre) : ?>
        <tr>
            <td><img src="<?php echo ($chambre->photo); ?>" alt="chambre photo"></td>
            <td><?php echo ($chambre->chambresId); ?></td>
            <td><?php echo ($chambre->type_chambre); ?></td>
            <td><?php echo ($chambre->prix); ?></td>
            <?php
                echo ("<td><a href=\"/admin/editChambres.php?chambresId=$chambre->chambresId&prix=$chambre->prix&photo=$chambre->photo\">Edit</a></td>")
                ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>