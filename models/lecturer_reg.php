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

        function getLecturerRegId($subject_id)
        {
            try {
                global $con;
                $result = $con->query("SELECT lr.lec_reg_id FROM lecturer_reg lr WHERE lr.lec_sub_id='".$subject_id."'");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['lec_reg_id'];
                    }
                    return $id;
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