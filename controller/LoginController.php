<?php

class LoginController
{
	// Function to Log in User
    public function loginUser($username, $password)
    {
        $u = new UserLogin();
        $res = $u->loginUser($username, $password);
        return $res;
    }
}
