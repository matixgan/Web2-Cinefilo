<?php
require_once "./models/userModel.php";
require_once "./helpers/loginHelper.php";
require_once "./views/userView.php";

class UserController {

	function __construct(){
        $this->model = new UserModel();
        $this->authHelper = new AuthHelper();
        $this->view = new userView();
    }

    public function IniciarSesion(){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $username = $this->model->GetPassword($user);

        if (!empty($username) && password_verify($pass, $username->clave)){
            $this->authHelper->login($username);
            header('Location: logged');
        }else{
            header("Location: " . BASE_URL);
        }
       // header("Location: " . BASE_URL);
    }

    public function logout() {
        $this->authHelper->logout();
        header('Location: ' . BASE_URL);
    }

    public function registrar(){
        $this->view->displayRegistro();
    }

    public function registro(){
        $user = $_POST['user'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if(!empty($user) && $pass1 == $pass2){
            $this->model->registro($user, $pass1);
            header('Location: ' . BASE_URL);
        }else{
            header('Location: ' . BASE_URL);
        }
    }
    
}

