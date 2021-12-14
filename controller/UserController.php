<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../models/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Initializing Controller
class UserController
{
    public $msg;

    // Function to Register User
    public function registerUser($username, $email, $password, $avatar, $name, $dob)
    {
        $u = new User($username, $email, $password);
        $res = $u->registerUser($username, $email, $password, $avatar, $name, $dob);
        $this->msg = $u->message;
        return $res; // If user is successfully created, returns their user Id
    }

    // Function to get User info
    public function getUserInfo()
    {
        $u = new User($_SESSION['userId']);
        $data = [
            'userId' => $u->getUserId(),
            'username' => $u->getUsername(),
            'avatar' => $u->getUserAvatar(),
            'email' => $u->getUserEmail(),
            'rank' => $u->getUserRank(),
            'role_name' => $u->getUserRolename(),
            'name' => $u->getName(),
            'dob' => $u->getUserDob()
        ];
        return $data;
    }
    // Function to get user password
    public function getUserPassword()
    {
        $u = new User($_SESSION['userId']);
        $data = $u->getUserPassword();
        return $data;
    }

    // Instances a user object. Mostly used to set user info
    public function setUser(){
        $u = new User($_SESSION['userId']);
        return $u;
    }

    // Function to get all users
    public function getAllUsers()
    {
        $u = new User($_SESSION['userId']);
        $data = $u->getAllUsers();
        return $data;
    }

    // Function to update user info
    public function updateUserInfo($user_id, $active_user)
    {
        $u = new User($_SESSION['userId']);
        $data = $u->updateUserStatus($user_id, $active_user);
        return $data;
    }
}
