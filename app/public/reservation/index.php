<?php
include_once '../helpers/session_helper.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="description"
        content="Bienvenue à l'hotel neptune, hotel 3 étoiles qui vous invite à passer une soirée, lit confortable et locaux sympatiques." />
    <title>Réserver chez Hotel Neptune</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="http://hotel-neptune.fr/wp-content/uploads/2021/02/Logo-Neptune-avec-rond-e1607450857665.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="logo">
        <a target="_blank" href="../index.html">
            <img src="neptune.png" class="logo" alt="Logo Hotel Neptune" />
        </a>

    </div>
    <div class="chambre1">
        <img src="C1.png" class="image_c1" alt="Type de chambre 1" />

        <div class="info">
            <h3 class="prix">Chambre Single / Twin (85€) :</h3>
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
        <img src="C2.png" class="image_c2" alt="Type de chambre 2" />

        <div class="info">
            <h3 class="prix">Chambre Triple (95€) : </h3>
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

                <input type="number" min="1" max="2" />
            </label>

            <label class="boxInput">
                Nombre de chambre(s) :

                <input type="number" min="1" max="15" />
            </label>


            <label class="boxInput">
                Date d'arrivée :

                <input type="date" name="date_arrive" />
            </label>

            <label class="boxInput">
                Date de départ :

                <input type="date" name="date_depart" />
            </label>

            <div class="button-submit">
                <button type="submit" name="submit">Reserver</button>
            </div>
        </form>
    </div>
</body>

</html>