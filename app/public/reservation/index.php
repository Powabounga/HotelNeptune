<?php
session_start();
include_once '../helpers/session_helper.php';
include_once '../models/Chambre.php';

$model = new Chambre;


$chambres = $model->getAllChambres();
$chambreOne = $chambres[0];
$chambreTwo = $chambres[1];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="description"
        content="Bienvenue à l'hotel neptune, hotel 3 étoiles qui vous invite à passer une soirée, lit confortable et locaux sympatiques." />
    <title>Réserver chez Hotel Neptune</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="http://hotel-neptune.fr/wp-content/uploads/2021/02/Logo-Neptune-avec-rond-e1607450857665.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <script type='module' src='../script.js'></script>
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

    <div class="chambre1">
        <img src="<?php echo $chambreOne->photo ?>" class="image_c1" alt="Type de chambre 1" />

        <div class="info">
            <h3 class="desc">Chambre Single / Twin (<?php echo $chambreOne->prix ?> € par nuit) :</h3>
            <div class="lit">
                <p>Lit :</p>
                <p>
                    Chambre Single : King Size Bed (180cm) ou Chambre Twin : deux Single
                    Bed (90cm)
                </p>
            </div>
            <div class="capacite">
                <p>Capacité :</p>
                <p>
                    Jusqu'à 2 personnes maximum par chambre, possibilité d'ajouter un
                    lit bébé
                </p>
            </div>
            <div class="taille">
                <p>Taille de la chambre :</p>
                <p>20m²</p>
            </div>
        </div>
    </div>

    <div class="chambre2">
        <img src="<?php echo $chambreTwo->photo ?>" class="image_c2" alt="Type de chambre 2" />

        <div class="info">
            <h3 class="desc">Chambre Triple (<?php echo $chambreTwo->prix ?> € par nuit) : </h3>
            <div class="lit">
                <p>Lit :</p>
                <p>un Double bed (140cm) et un Single Bed (90cm)</p>
            </div>
            <div class="capacite">
                <p>Capacité :</p>
                <p>
                    Jusqu'à 3 personnes maximum par chambre, possibilité d'ajouter un
                    lit bébé
                </p>
            </div>
            <div class="taille">
                <p>Taille de la chambre :</p>
                <p>25m²</p>
            </div>
        </div>
    </div>
    <div class="box-reservation">
        <?php flash('reservation') ?>


        <form action="../controllers/reservation.php" method="POST" class="box">
            <input type="hidden" name="type" value="reservation" />

            <label class="boxInput">
                Type de chambre :

                <input type="number" name="type_chambre" min="1" max="2" />
            </label>

            <label class="boxInput">
                Nombre de chambre(s) :

                <input type="number" name="nb_chambre" min="1" max="15" />
            </label>


            <label class="boxInput">
                Date d'arrivée :

                <input type="date" name="date_arrive" />
            </label>

            <label class="boxInput">
                Date de départ :

                <input type="date" name="date_depart" />
            </label>

            <label>
                <input type="checkbox" name="checkbox">

                En cliquant sur cette case, vous acceptez de reserver. Le paiement se fera lors de votre arrivée à
                l'hotel sous présentation de votre carte d'identité.
            </label>

            <div class="button-submit">
                <button type="submit" name="submit">Reserver</button>
            </div>
        </form>
    </div>
</body>

</html>