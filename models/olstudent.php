<?php
require_once 'student.php';

class olStudent extends Student
{
    // properties
    private $ttresults;

    // methods
    function __construct($ttresults)
    {
        $this->ttresults = $ttresults;
    }

    function saveResults()
    {
        // enter to database
    }

    function getResults($studentId)
    {
        //return $results;
    }
}

?>