<?php
class SessionHandle
{
    // Setting up session for login
    public function logged_in()
    {
        return isset($_SESSION['userId']);
    }

    // Check if user is logged in or not
    public function confirm_logged_in()
    {
        if (!$this->logged_in()) {
            // $redirect = new Redirector("login.php");
            return true;
        } else {
            return false;
        }
    }
}
