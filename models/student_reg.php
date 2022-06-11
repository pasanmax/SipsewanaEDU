<?php
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class StudentReg
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

        function getStudentRegId($subject_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT sr.st_reg_id FROM student_reg sr WHERE sr.st_sub_id='".$subject_id."'");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getStuRegID($st_reg_id) {
            try {
                global $con;
                $result = $con->query("SELECT sr.st_reg_id FROM student_reg sr WHERE sr.st_reg_id='".$st_reg_id."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $st_reg_id = $row['st_reg_id'];
                    }
                    return $st_reg_id;
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