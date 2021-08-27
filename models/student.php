<?php

class Student
{
    // properties
    protected int $student_id;
    private string $fname;
    private string $lname;
    private string $usrname;
    private string $passwordHash;
    private string $dob;
    private string $school;
    protected string $adrsl1;
    protected string $adrsl2;
    protected string $adrsl3;
    protected string $city;
    protected string $district;
    protected int $zipcode;
    protected string $gfname;
    protected string $glname;
    protected string $gemail;
    protected string $gcontactNo;
    protected string $relationship;
    private string $submissiondate;

    // methods
    function setStudent($fname,$lname,$dob,$school,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$gfname,$glname,$gemail,$gcontactNo,$relationship,$submissiondate)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->school = $school;
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->gfname = $gfname;
        $this->glname = $glname;
        $this->gemail = $gemail;
        $this->gcontactNo = $gcontactNo;
        $this->relationship = $relationship;
        $this->submissiondate = $submissiondate;
    }

    function getStudent($student_id)
    {
        // get student from databse
    }

    function getStudents()
    {
        // get students from databse
    }

    function updateInfo()
    {
        // update database
    }

    function register()
    {
        // enter data to database
    }

    function attendOnlineClass($student_id)
    {
        // enter data to Online class table
    }

    function attendOfflineClass($student_id)
    {
        // enter data to offline class table
    }

    function payRegisterFees($student_id,$subid,$regfees)
    {
        // enter data to Student_Reg table & Payment table
    }

    function payClassFees($student_id,$method,$status,$type,$amount)
    {
        // enter data to Payment table
    }

    function submitHomework($student_id,$submitfille)
    {
        // enter data to Hw_Submission table
    }

    function viewOnlineAttendance($student_id)
    {
        // select data from OnlineClass table
    }

    function viewOfflineAttendance($student_id)
    {
        // select data from OfflineClass table
    }
}

?>