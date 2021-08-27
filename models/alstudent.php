<?php
require_once 'student.php';

class alStudent extends Student
{
    // properties
    private string $idno;
    private string $email;
    private string $contactno;

    // methods
    function __construct($idno,$email,$contactno)
    {
        $this->idno = $idno;
        $this->email = $email;
        $this->contactno = $contactno;
    }

    function saveDetails()
    {
        // Enter to database
    }

    function getDetails()
    {
        return $details;
    }
}

?>