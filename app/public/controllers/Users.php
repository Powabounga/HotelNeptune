<?php

require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register()
    {
        //Process form

        //Sanitize POST data
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'username' => trim($_POST['username']),
            'userEmail' => trim($_POST['userEmail']),
            'userUid' => trim($_POST['userUid']),
            'userPwd' => trim($_POST['userPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat']),
            'admin' => 0
        ];

        //Validate inputs
        if (
            empty($data['username']) || empty($data['userEmail']) || empty($data['userUid']) ||
            empty($data['userPwd']) || empty($data['pwdRepeat'])
        ) {
            flash("register", "Please fill out all inputs");
            redirect("../register");
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['userUid'])) {
            flash("register", "Invalid username");
            redirect("`../register`");
        }

        if (!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Invalid email");
            redirect("../register");
        }

        if (strlen($data['userPwd']) < 6) {
            flash("register", "Invalid password");
            redirect("../register");
        } else if ($data['userPwd'] !== $data['pwdRepeat']) {
            flash("register", "Passwords don't match");
            redirect("../register");
        }

        //User with the same email or password already exists
        if ($this->userModel->findUserByEmailOrUsername($data['userEmail'], $data['username'])) {
            flash("register", "Username or email already taken");
            redirect("../register");
        }

        //Passed all validation checks.
        //Now going to hash password
        $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

        //Register User
        if ($this->userModel->register($data)) {
            $loggedInUser = $this->userModel->login($data['userEmail'], trim($_POST['userPwd']));

            if ($loggedInUser) {
                //Create session
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Something went wrong, try to login again.");
                redirect("/login");
            }
        } else {
            die("Something went wrong");
        }
    }

    public function login()
    {
        //Sanitize POST data
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'name/email' => trim($_POST['name/email']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if (empty($data['name/email']) || empty($data['usersPwd'])) {
            flash("login", "Please fill out all inputs");
            header("location: /login");
            exit();
        }

        //Check for user/email
        if ($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])) {
            //User Found
            $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd']);
            if ($loggedInUser) {
                //Create session
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Password Incorrect");
                redirect("/login");
            }
        } else {
            flash("login", "No user found");
            redirect("/login");
        }
    }

    public function update() {
        //Init data
        $data = [
            'userId' => trim($_POST['userId']),
            'username' => trim($_POST['username']),
            'userEmail' => trim($_POST['userEmail']),
            'userUid' => trim($_POST['userUid']),
            'admin' => trim($_POST['admin']),
        ];

        //Update User
        if ($this->userModel->update($data)) {
                redirect("/admin/users.php");
        } else {
            die("Something went wrong");
        }
    }

    public function updateChambres() {
        //Init data
        $data = [
            'prix' => trim($_POST['prix']),
            'photo' => trim($_POST['photo']),
            'chambresId' => trim($_POST['chambresId']),
            
        ];

        //Update Chambre
        if ($this->userModel->updateChambre($data)) {
                redirect("/admin/chambres.php");
        } else {
            die("Something went wrong");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['userId'] = $user->userId;
        $_SESSION['username'] = $user->username;
        $_SESSION['userEmail'] = $user->userEmail;
        $_SESSION['admin'] = $user->admin;
        redirect("../index.php");
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['admin']);
        session_destroy();
        redirect("../index.php");
    }
}

$init = new Users;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'update':
            $init->update();
            break;
        case 'updateChambres':
            $init->updateChambres();
            break;
        case 'login':
            $init->login();
            break;
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("../index.php");
    }
} else {
    switch ($_GET['q']) {
            case 'logout':
                $init->logout();
                break;
        default:
            redirect("../index.php");
    }
}