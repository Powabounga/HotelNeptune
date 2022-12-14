<?php

require_once "../models/Reservation.php";

class Reservations
{

    private $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new Reservation;
    }

    public function addReservation()
    {
        $data = [
            "uid" => $_SESSION["usersId"],
            "nb_chambre" => trim($_POST['nb_chambre']),
            "type_chambre" => trim($_POST['type_chambre']),
            "date_arrive" => trim($_POST['date_arrive']),
            "date_depart" => trim($_POST['date_depart']),
            "prix" => trim($_POST['prix'])
        ];

        if (empty($data["uid"]) || empty($data["nb_chambre"]) || empty($data["type_chambre"]) || empty($data["date_arrive"]) || empty($data["date_depart"])) {
            // error redirect user back to reservation
            redirect("../reservation");
        } else {
            // add reservation
            if ($this->reservationModel->addReservation($data)) {
                // redirect to page and add reservation
                redirect("");
            } else {
                //error
                die("Something went wrong");
            }
        }
    }
}
