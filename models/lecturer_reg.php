<?php
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class LecturerReg
    {
        private $registrationdate;
        private $regfee;

        // function __construct() {

        // }

        public function setRegistrationdate()
        {
            $this->registrationdate = date("Y-m-d");
        }

        public function getRegistrationdate()
        {
            return $this->registrationdate;
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}
?>