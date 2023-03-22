<?php
require_once '../libraries/Database.php';

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Find user by email or username
    public function findUserByEmailOrUsername($email, $username)
    {
        $this->db->query('SELECT * FROM users WHERE userUid = :username OR userEmail = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllUsersCount()
    {
        $this->db->query('SELECT COUNT(userId) FROM users');
        return $this->db->fetchColumn();
    }

    public function getAllChambresCount()
    {
        $this->db->query('SELECT COUNT(chambresId) FROM chambres');
        return $this->db->fetchColumn();
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }

    public function getAllChambres()
    {
        $this->db->query('SELECT * FROM chambres');
        return $this->db->resultSet();
    }

    //Register User
    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, userEmail, userUid, userPwd) 
        VALUES (:name, :email, :Uid, :password)');
        //Bind values
        $this->db->bind(':name', $data['username']);
        $this->db->bind(':email', $data['userEmail']);
        $this->db->bind(':Uid', $data['userUid']);
        $this->db->bind(':password', $data['userPwd']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Update User
    public function update($data){
        $this->db->query('UPDATE users SET username=:username, userEmail=:userEmail, userUid=:userUid, admin=:admin WHERE userId=:userId');
        //Bind values
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':userEmail', $data['userEmail']);
        $this->db->bind(':userUid', $data['userUid']);
        $this->db->bind(':admin', $data['admin']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Update Chambre
    public function updateChambre($data){
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

    //Login user
    public function login($nameOrEmail, $password)
    {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if ($row == false) return false;

        $hashedPassword = $row->userPwd;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE users SET userPwd=:pwd WHERE userEmail=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}