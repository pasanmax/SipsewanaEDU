<?php
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class StudentReg
    {
        private $st_reg_id;
        private $st_sub_id;
        private $registrationdate;
        private $regfee;

        // function __construct() {

        // }

        function getSubId($st_reg_id) {
            try {
                global $con;
                $result = $con->query("SELECT st_sub_id FROM student_reg WHERE st_reg_id='".$st_reg_id."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $st_sub_id = $row['st_sub_id'];
                    }
                    return $st_sub_id;
                } elseif ($result === false) {
                    throw new Exception("Database Error!");
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }
}
else
{
    header('location:../pages/Student/Login.php');
}
?>