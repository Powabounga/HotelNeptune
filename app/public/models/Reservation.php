<?php
require_once '../libraries/Database.php';

class Reservation
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addReservation($data)
    {
        $this->db->query('INSERT INTO reservation (userId, nb_chambre, type_chambre, date_arrive, date_depart, prix) VALUES (:userId, :nb_chambre, :type_chambre, :date_arrive, :date_depart, :prix)');

        $this->db->bind(":userId", $data["userId"]);
        $this->db->bind(":nb_chambre", $data['nb_chambre']);
        $this->db->bind(":type_chambre", $data['type_chambre']);
        $this->db->bind(":date_arrive", $data["date_arrive"]);
        $this->db->bind(":date_depart", $data['date_depart']);
        $this->db->bind(":prix", $data['prix']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getReservationByUid($uid)
    {
        $this->db->query('SELECT * FROM reservation WHERE uid = :uid');

        $this->db->bind(":uid", $uid);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getChambreByType($type)
    {
        $this->db->query('SELECT * FROM chambres WHERE type_chambre = :type_chambre');

        $this->db->bind(":type_chambre", $type);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}