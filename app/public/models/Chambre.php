<?php
require_once '../libraries/Database.php';

class Chambre
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Update Chambre
    public function update($data){
        $this->db->query('UPDATE chambres SET prix=:prix, photo=:photo WHERE chambresId=:chambresId');
        //Bind values
        $this->db->bind(':prix', $data['prix']);
        $this->db->bind(':photo', $data['photo']);
        $this->db->bind(':chambresId', $data['chambresId']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllChambres()
    {
        $this->db->query('SELECT * FROM chambres');
        return $this->db->resultSet();
    }

    public function getAllChambresCount()
    {
        $this->db->query('SELECT COUNT(chambresId) FROM chambres');
        return $this->db->fetchColumn();
    }
}