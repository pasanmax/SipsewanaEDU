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

    class Lec_Attendance
    {
        // properties
        protected $lec_att_id;
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

        public function setLecturerId($lecturer_id)
        {
            $this->lec_att_id = $lecturer_id;
        }

        public function setLecOfAttSession()
        {
            header('location:../pages/Front Officer/Lecturers/OfflineAttendance/List.php');
            $_SESSION['lec_Of_att_id']=$this->lec_att_id;
            //echo "Error: ".$con->error;
        }

        public function setLecOnAttSession()
        {
            header('location:../pages/Front Officer/Lecturers/OnlineAttendance/List.php');
            $_SESSION['lec_On_att_id']=$this->lec_att_id;
            //echo "Error: ".$con->error;
        }

        function getLecturerOfflineAttendance($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT c.class_id,l.lecturer_id,CONCAT(l.fname, ' ' ,l.lname) AS 'lecturername',s.subjectname,la.date,la.intime,la.outtime FROM class c, offline_class cf, class_dates cd, lecturer l, lecturer_reg lr, lec_attendance la, subject s WHERE c.class_id=cf.of_cls_id AND c.class_id=cd.cls_dt_id AND l.lecturer_id=lr.lec_reg_id AND l.lecturer_id=la.lec_att_id AND la.cls_attlec_id=cf.of_cls_id AND cd.date=la.date AND lr.lec_sub_id=s.subject_id AND c.sub_cls_id=s.subject_id AND la.lec_att_id='".$lecturer_id."'");
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

        function getLecturerOnlineAttendance($lecturer_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT c.class_id,l.lecturer_id,CONCAT(l.fname, ' ' ,l.lname) AS 'lecturername',s.subjectname,la.date,la.intime,la.outtime FROM class c, online_class oc, class_dates cd, lecturer l, lecturer_reg lr, lec_attendance la, subject s WHERE c.class_id=oc.ol_cls_id AND c.class_id=cd.cls_dt_id AND l.lecturer_id=lr.lec_reg_id AND l.lecturer_id=la.lec_att_id AND la.cls_attlec_id=oc.ol_cls_id AND cd.date=la.date AND lr.lec_sub_id=s.subject_id AND c.sub_cls_id=s.subject_id AND la.lec_att_id='".$lecturer_id."'");
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

    }

    if (isset($_POST['lecOfAttenSearch'])) {
        if (empty($_POST['lecturerid'])) {
            header('location:../pages/Front Officer/Lecturers/OfflineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid Lecturer ID!";
        } else {
            $lecAttendance = new Lec_Attendance();
            $lecAttendance->setLecturerId($_POST['lecturerid']);
            $lecAttendance->setLecOfAttSession();
        }
    }

    if (isset($_POST['lecOnAttenSearch'])) {
        if (empty($_POST['lecturerid'])) {
            header('location:../pages/Front Officer/Lecturers/OnlineAttendance/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid Lecturer ID!";
        } else {
            $lecAttendance = new Lec_Attendance();
            $lecAttendance->setLecturerId($_POST['lecturerid']);
            $lecAttendance->setLecOnAttSession();
        }
    }

}
else
{
    header('location:../pages/Lecturer/Login.php');
}
?>