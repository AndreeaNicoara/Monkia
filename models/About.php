<?php
require_once('DbConn.php');

// Initializing the model About
class About
{
    // Initializing the functions for model About
    public function updateAbout($aboutId, $description)
    {
        $db = new DbConn();
        $date = date('Y-m-d H:i:s');
        $sql = 'UPDATE about_website set description=? WHERE about_id=?';

        $arr = [$description, $aboutId];

        $result = $db->executeQueryBindArr($sql, $arr);
        return $result;
    }

    public function getAllAbout()
    {
        try {
            $result = false;
            $db = new Dbconn();
            $sql = 'SELECT * 
                FROM `about_website` 
                ORDER BY about_id DESC';
            $result = $db->selectQuery($sql);
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
