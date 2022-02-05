<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class Stu_Attendance
    {
        // properties
        protected $date;
        protected $intime;
        protected $outtime;

        //methods
        public function setDate($date)
        {
            $this->date = $date;
        }

        public function setIntime($intime)
        {
            $this->intime = $intime;
        }

        public function setOuttime($outtime)
        {
            $this->outtime = $outtime;
        }

        public function setDateSession()
        {
            header('location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
            $_SESSION['classdate']=$this->date;
            //echo "Error: ".$con->error;
        }

        function getStudentAttendanceList($date)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT sa.cls_attst_id,sa.st_att_id,s.subjectname,sa.date,sa.intime,sa.outtime FROM stu_attendance sa, class c, subject s, class_dates cd WHERE sa.cls_attst_id=c.class_id AND c.class_id=cd.cls_dt_id AND c.sub_cls_id=s.subject_id AND sa.date=cd.date AND cd.date='".$date."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $row = array_map('stripslashes', $row);
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                // $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        public function updateStudentAttendance($student_id,$class_id,$date)
        {
            $outtime = $this->outtime;
            try {
                global $con;
                if($con->query("UPDATE stu_attendance SET outtime='".$outtime."' WHERE st_att_id='".$student_id."' AND cls_attst_id='".$class_id."' AND date='".$date."'") === TRUE) {
                    echo "<script type='text/javascript'>  window.location='../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php'; </script>";
                    //header('location:location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Updated Successfully!";
                    //echo "Error: ".$con->error;
                    
                } else {
                    header('location:location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

    }

    if(isset($_POST['dateSearch']))
    {
        if($_POST['date'] === null) {
            header('location:location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please select a date!";
        } else {
            $stu_atten = new Stu_Attendance();
            $stu_atten->setDate($_POST['date']);
            $stu_atten->setDateSession();
        }
    }

    if(isset($_POST['updateOnlineAttendance']))
    {
        if($_POST['ustudentid'] === null && $_POST['uclassid'] === null && $_POST['udate'] === null) {
            header('location:location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Error in Data!";
        } else {
            $stu_atten = new Stu_Attendance();
            $stu_atten->setOuttime($_POST['uouttime']);
            $stu_atten->updateStudentAttendance($_POST['ustudentid'],$_POST['uclassid'],$_POST['udate']);
        }
    }

}
else
{
    header('location:../pages/Student/Login.php');
}
?>