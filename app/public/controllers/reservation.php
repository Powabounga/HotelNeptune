<?php

require_once "../models/Reservation.php";
require_once '../helpers/session_helper.php';

class Reservations
{

    private $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new Reservation;
    }

    public function getChambre($type)
    {
        return $this->reservationModel->getChambreByType($type);
    }

    public function addReservation()
    {
        $chambre = $this->getChambre(trim($_POST['type_chambre']));
        $prix = 0;

        if ($chambre) {
            $prix = intval($_POST['nb_chambre']) * intval($chambre->prix);
        }

        $data = [
            "userId" => $_SESSION["userId"],
            "nb_chambre" => trim($_POST['nb_chambre']),
            "type_chambre" => trim($_POST['type_chambre']),
            "date_arrive" => trim($_POST['date_arrive']),
            "date_depart" => trim($_POST['date_depart']),
            "prix" =>  $prix
        ];

        if (empty($data["userId"]) || empty($data["nb_chambre"]) || empty($data["type_chambre"]) || empty($data["date_arrive"]) || empty($data["date_depart"])) {
            // // error redirect user back to reservation
            flash("reservation", "Vous n'avez pas rempli tous les champs", 'error');
            header("location: ../reservation");
            exit();
        } else {
            // add reservation
            if ($this->reservationModel->addReservation($data)) {
                // redirect to page and add reservation
                flash("reservation", "Merci de nous faire confiance. Le prix par nuit sera de : $prix €", 'prix');
                redirect("/reservation");
            } else {
                //error
                var_dump('error');
                die("Something went wrong");
            }
        }
    }
}

$init = new Reservations;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'reservation':
            $init->addReservation();
            break;
        default:
            redirect("../index.html");
    }
}