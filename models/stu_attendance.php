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
        private $st_att_id;
        private $date;
        private $intime;
        private $outtime;

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

        public function setStudentId($student_id)
        {
            $this->st_att_id = $student_id;
        }

        public function setDateSession()
        {
            header('location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
            $_SESSION['classdate']=$this->date;
            //echo "Error: ".$con->error;
        }

        public function setStOfAttSession()
        {
            header('location:../pages/Front Officer/Students/OfflineAttendance/List.php');
            $_SESSION['st_Of_att_id']=$this->st_att_id;
            //echo "Error: ".$con->error;
        }

        public function setStOnAttSession()
        {
            header('location:../pages/Front Officer/Students/OnlineAttendance/List.php');
            $_SESSION['st_On_att_id']=$this->st_att_id;
            //echo "Error: ".$con->error;
        }

        function getStudentAttendanceList($date,$lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT DISTINCT sa.cls_attst_id,sa.st_att_id,s.subjectname,sa.date,sa.intime,sa.outtime FROM stu_attendance sa, student_reg sr, class c, subject s, class_dates cd, lecturer_reg lr WHERE sa.cls_attst_id=c.class_id AND c.class_id=cd.cls_dt_id AND c.sub_cls_id=s.subject_id AND sa.date=cd.date AND sr.st_sub_id=c.sub_cls_id AND lr.lec_sub_id=c.sub_cls_id AND sr.st_sub_id=lr.lec_sub_id AND cd.date='".$date."' AND lr.lec_reg_id='".$lecturer_id."'");
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

        function getStudentOfflineAttendance($student_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT c.class_id,st.student_id,CONCAT(st.fname, ' ' ,st.lname) AS 'studentname',s.subjectname,sa.date,sa.intime,sa.outtime FROM class c, offline_class cf, class_dates cd, student st, student_reg sr, stu_attendance sa, subject s WHERE c.class_id=cf.of_cls_id AND c.class_id=cd.cls_dt_id AND st.student_id=sr.st_reg_id AND st.student_id=sa.st_att_id AND sa.cls_attst_id=cf.of_cls_id AND cd.date=sa.date AND sr.st_sub_id=s.subject_id AND c.sub_cls_id=s.subject_id AND sa.st_att_id='".$student_id."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        function getStudentOnlineAttendance($student_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT c.class_id,st.student_id,CONCAT(st.fname, ' ' ,st.lname) AS 'studentname',s.subjectname,sa.date,sa.intime,sa.outtime FROM class c, online_class oc, class_dates cd, student st, student_reg sr, stu_attendance sa, subject s WHERE c.class_id=oc.ol_cls_id AND c.class_id=cd.cls_dt_id AND st.student_id=sr.st_reg_id AND st.student_id=sa.st_att_id AND sa.cls_attst_id=oc.ol_cls_id AND cd.date=sa.date AND sr.st_sub_id=s.subject_id AND c.sub_cls_id=s.subject_id AND sa.st_att_id='".$student_id."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return null;
                    }
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }

        function setStOnlineAttendance($class_url,$class_id,$student_id)
        {
            try {
                global $con;
                $result = $con->query("SELECT * FROM stu_attendance sa WHERE sa.st_att_id='".$student_id."' AND sa.cls_attst_id='".$class_id."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        header('location:'.$class_url);
                        // $_SESSION['response']="danger";
                        // $_SESSION['message']="Student already attended!";
                    } else {
                        $dt = new DateTime("now", new DateTimeZone('Asia/Colombo'));
                        $intime = $dt->format('H:i:s');
                        if($con->query("INSERT INTO stu_attendance(st_att_id,cls_attst_id,date,intime,outtime) VALUES ('".$student_id."','".$class_id."','".date('Y-m-d')."','".$intime."',NULL)") === TRUE) {
                            header('location:'.$class_url);
                        } else {
                            header('location:../pages/Student/Classes/OnlineClass/List.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error occured!";
                            //echo "Error: ".$con->error;
                        }
                    }
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

    }

    if(isset($_POST['dateSearch']))
    {
        if(empty($_POST['date'])) {
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
        if(empty($_POST['ustudentid']) || empty($_POST['uclassid']) || empty($_POST['udate'])) {
            header('location:location:../pages/Lecturer/Attendance/StudentOnlineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Error in Data!";
        } else {
            $stu_atten = new Stu_Attendance();
            $stu_atten->setOuttime($_POST['uouttime']);
            $stu_atten->updateStudentAttendance($_POST['ustudentid'],$_POST['uclassid'],$_POST['udate']);
        }
    }

    if (isset($_POST['stOfAttenSearch'])) {
        if (empty($_POST['studentid'])) {
            header('location:../pages/Front Officer/Students/OfflineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid Student ID!";
        } else {
            $stAttendance = new Stu_Attendance();
            $stAttendance->setStudentId($_POST['studentid']);
            $stAttendance->setStOfAttSession();
        }
    }

    if (isset($_POST['stOnAttenSearch'])) {
        if (empty($_POST['studentid'])) {
            header('location:../pages/Front Officer/Students/OnlineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid Student ID!";
        } else {
            $stAttendance = new Stu_Attendance();
            $stAttendance->setStudentId($_POST['studentid']);
            $stAttendance->setStOnAttSession();
        }
    }

    if (isset($_GET['clsurl']) && isset($_GET['clsid']) && isset($_GET['stid'])) {
        if (!empty($_GET['clsurl']) && !empty($_GET['clsid']) && !empty($_GET['stid'])) {
            $stAttendance = new Stu_Attendance();
            $stAttendance->setStOnlineAttendance($_GET['clsurl'],$_GET['clsid'],$_GET['stid']);
        } else {
            header('location:../pages/Student/Classes/OnlineClass/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please try again!";
        }
    }

}
else
{
    //header('location:../pages/Student/Login.php');
}
?>