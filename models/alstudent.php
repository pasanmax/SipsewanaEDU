<?php
require_once 'student.php';

class alStudent extends Student
{
    // properties
    private $idno;
    private $email;
    private $contactno;

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
        //return $details;
    }
}

?>