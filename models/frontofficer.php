<?php

class FrontOfficer
{
    // properties
    protected int $fo_id;
    private string $fname;
    private string $lname;
    private string $usrname;
    private string $passwordHash;
    private string $dob;
    protected string $adrsl1;
    protected string $adrsl2;
    protected string $adrsl3;
    protected string $city;
    protected string $district;
    protected int $zipcode;
    protected string $email;
    protected string $contactNo;

    // methods
    function setFrontOfficer($fname,$lname,$dob,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$email,$contactNo)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->email = $email;
        $this->contactNo = $contactNo;
    }

    function getFrontOfficer($fo_id)
    {
        // get front officer from database
    }

    function getFrontOfficers()
    {
        // get front officers from database
    }

    function updateInfo($fofficerId)
    {
        // update database
    }

    function register()
    {
        // enter data to database
    }

    function registerbyId($fofficerId)
    {
        // enter data to database
    }

    function delete($fofficerId)
    {
        // delete Front Officer
    }

    // ==============================Student Approval=====================================

    function getStudentApprovals()
    {
        // Get student pending approvals
    }

    function approveStudent($studentId)
    {
        // Approve Student
    }

    function delStudentApproval($studentId)
    {
        // Delete Student Approval
    }

    // ==============================Lecturer Approval=====================================

    function getLecturerApprovals()
    {
        // Get Lecturer pending approvals
    }

    function approveLecturert($lecturerId)
    {
        // Approve Lecturer
    }

    function delLecturerApproval($lecturerId)
    {
        // Delete Lecturer Approval
    }

    // ==============================Front Officer Approval=====================================

    function getFOfficerApprovals()
    {
        // Get Front Officer pending approvals
    }

    function approveFOffier($fofficerId)
    {
        // Approve Front Officer
    }

    function delFOfficerApproval($fofficerId)
    {
        // Delete Front Officer Approval
    }

    // ==============================Director Approval=====================================

    function getDirectorApprovals()
    {
        // Get Director pending approvals
    }

    function approveDirector($directorId)
    {
        // Approve Director
    }

    function delDirectorApproval($directorId)
    {
        // Delete Director Approval
    }

    // ==============================Cashier Approval=====================================

    function getCashierApprovals()
    {
        // Get Cashier pending approvals
    }

    function approveCashier($cashierId)
    {
        // Approve Cashier
    }

    function delCashierApproval($cashierId)
    {
        // Delete Cashier Approval
    }
}

?>