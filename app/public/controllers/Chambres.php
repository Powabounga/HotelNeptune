<?php

require_once '../models/Chambre.php';
require_once '../helpers/session_helper.php';

class Chambres
{

    private $chambresModel;

    public function __construct()
    {
        $this->chambresModel = new Chambre;
    }

    public function update() {
        //Init data
        $data = [
            'prix' => trim($_POST['prix']),
            'photo' => trim($_POST['photo']),
            'chambresId' => trim($_POST['chambresId']),
            
        ];

        //Update Chambre
        if ($this->chambresModel->update($data)) {
                redirect("/admin/chambres.php");
        } else {
            die("Something went wrong");
        }
    }
}

$init = new Chambres;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'update':
            $init->update();
            break;
        default:
            redirect("/index.php");
    }
}