<?php
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class LecturerReg
    {
        private $lec_reg_id;
        private $st_sub_id;
        private $registrationdate;
        private $regfee;

        // function __construct() {

        // }

        function getLec() {
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}
?>