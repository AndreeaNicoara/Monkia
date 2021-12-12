<?php
// require_once("../models/UserLogin.php");


class LoginController
{
	// Function to Login User
    public function loginUser($username, $password)
    {
        $u = new UserLogin();
        $res = $u->loginUser($username, $password);
        return $res;
    }
}
