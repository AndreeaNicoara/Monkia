<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../models/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Initializing Controller
class AboutController
{
    public $msg;

    // Function to load All About
    public function getAllAbout()
    {
        $u = new About();
        $data = $u->getAllAbout();
        return $data;
    }

    // Function to update About
    public function updateAbout($aboutId, $description)
    {
        $u = new About();
        $data = $u->updateAbout($aboutId, $description);
        return $data;
    }
}
