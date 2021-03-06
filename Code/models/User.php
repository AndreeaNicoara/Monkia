<?php
require_once('DbConn.php');

class User
{
    private $userId;
    private $username;
    private $email;
    private $avatar;
    private $password;
    private $rank;
    public $userCategories = array();
    public $message = array(
        "id" => "",
        "text" => "",
    );

    //We retrieve user data from user table and their preferred categories from user_category table
    public function __construct($userId)
    {
        $db = new Dbconn();
        $result = false;
        if ($db->isConnected()) {
            $sql = "SELECT `user_id`, username, email,`password`, avatar, `rank`
                    from user where `user_id` = ?";
            $stmt = $db->selectQueryBind($sql, $userId);
            if ($stmt) {
                foreach ($stmt as $values) {
                    $this->userId = $values['user_id'];
                    $this->username = $values['username'];
                    $this->email = $values['email'];
                    $this->password = $values['password'];
                    $this->avatar = $values['avatar'];
                    $this->rank = $values['rank'];
                }
            }
            $sql = "SELECT c.category_name, c.icon
            from category c 
            inner join user_category uc on c.category_name = uc.category_name  
            where uc.user_id = ?";
            $stmt = $db->selectQueryBind($sql, $userId);
            if ($stmt) {
                foreach ($stmt as $data)
                    array_push($this->userCategories, $data);
            }
            $result = true;
        }

        return $result;
    }

    // Getters
    public function getUsername()
    {
        return $this->username;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function getUserPassword()
    {
        return $this->password;
    }

    public function getUserCategories()
    {
        return $this->userCategories;
    }

    public function getUserAvatar()
    {
        return $this->avatar;
    }
    public function getUserRank()
    {
        return $this->rank;
    }

    public function getUserEmail()
    {
        return $this->email;
    }

    //Setters

    public function setUsername($newUsername)
    {
        $this->username = $newUsername;
        $this->updateUserInfo('username',$newUsername);
    }

    public function setUserId($userId)
    {
        $this->userId;
        $this->updateUserInfo('userId', $userId);
    }
    public function setUserPassword($password)
    {
        $this->password =$password;
        $this->updateUserInfo('password', $password);
    }

    // Needs re-work. It's not like the others. We pass an array
    public function setUserCategories($userCategories)
    {
        $this->userCategories = $userCategories;
        // $this->updateUserInfo('avatar', $userCategories);

    }

    public function setUserAvatar($avatar)
    {
        $this->avatar = $avatar;
        $this->updateUserInfo('avatar', $avatar);
    }

    public function setUserEmail($email)
    {
        $this->email = $email;
        $this->updateUserInfo('email', $email);
    }

    // Methods

    public function isEmailRegistered($email)
    {
        try {
            $db = new Dbconn();
            $result = false;
            if ($db->isConnected()) {
                $sql = 'SELECT count(*) as total from user where email = ?';
                $result = $db->selectQueryBindSingleFetch($sql, $email);
                if ($result[0]['total'] == 0) {
                    $result = false;
                } else {
                    $result = true;
                }
            }
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
    public function isUsernameRegistered($username)
    {
        try {
            $db = new Dbconn();
            $result = false;
            if ($db->isConnected()) {
                $sql = 'SELECT count(*) as total from user where `username` = ?';
                $result = $db->selectQueryBindSingleFetch($sql, $username);
                if ($result[0]['total'] == 0) {
                    $result = false;
                } else {
                    $result = true;
                }
            }
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function isUserRegisteredId($userId)
    {
        try {
            $db = new Dbconn();
            $result = false;
            if ($db->isConnected()) {
                $sql = 'SELECT count(*) from user where user_id = ?';
                $result = $db->selectQueryBind($sql, $userId);
            }
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function registerUser($username, $email, $password, $avatar)
    {
        try {
            $db = new Dbconn();
            $result = false;
            if ($db->isConnected()) {

                if ($this->isUsernameRegistered($username)) {
                    $this->message["id"] = "username";
                    $this->message["text"] = "This username is currently being used by another user.";
                } else if ($this->isEmailRegistered($email)) {
                    $this->message["id"] = "email";
                    $this->message["text"] = "This email is currently being used by another user.";
                } else {
                    $sql = 'INSERT INTO `user` (`username`, avatar, `password`, email, `rank`, role_name) 
                    VALUES (?, ?, ?, ?, ?, ?)';
                    $arr = [$username, $avatar, $password, $email, 'Beginner', 'registeredUser'];
                    $result = $db->executeQueryBindArr($sql, $arr);
                    // If the user is succesfully created, we retrieve the user Id when inserted
                    if ($result) $result = $db->dbConn->lastInsertId();
                }
            }
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    //Not implemented yet. Missing binded parameters array
    public function updateUser($userId, $email, $username, $password)
    {
        $db = new Dbconn();
        $result = false;
        $arr = [$userId, $email, $username, $password];
        if ($db->isConnected()) {
            $sql = 'UPDATE user 
                    SET username = ?,
                    avatar = ?,
                    password = ?,
                    email = ?,
                    WHERE user_id = ?';
            $result = $db->executeQueryBindArr($sql, $arr);
        }
        return $result;
    }

    private function updateUserInfo ($field,$data) {
        $db = new Dbconn();
        $result = false;
        $data;
        if ($db->isConnected()) {
            $sql = "UPDATE user 
                    SET {$field}  = ?
                    WHERE user_id = {$this->userId}";
            $result = $db->executeQueryBind($sql, $data);
        }
        return $result; 
    }
}
