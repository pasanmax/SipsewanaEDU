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

        function setLecOnlineAttendance($class_url,$class_id,$duration,$lecturer_id)
        {
            try {
                global $con;
                $result = $con->query("SELECT * FROM lec_attendance la WHERE la.lec_att_id='".$lecturer_id."' AND la.cls_attlec_id='".$class_id."'");
                if ($result) {
                    if ($result->num_rows > 0) {
                        header('location:'.$class_url);
                        // $_SESSION['response']="danger";
                        // $_SESSION['message']="Lecturer already attended!";
                    } else {
                        $dt = new DateTime("now", new DateTimeZone('Asia/Colombo'));
                        $intime = $dt->format('H:i:s');
                        $outtime = date("h:m:s", strtotime($intime)+$duration*60*60);
                        if($con->query("INSERT INTO lec_attendance(lec_att_id,cls_attlec_id,date,intime,outtime) VALUES ('".$lecturer_id."','".$class_id."','".date('Y-m-d')."','".$intime."','".$outtime."')") === TRUE) {
                            header('location:'.$class_url);
                        } else {
                            header('location:../pages/Lecturer/Classes/ManageOnline/List.php');
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

    if (isset($_GET['clsurl']) && isset($_GET['clsid']) && isset($_GET['dura']) && isset($_GET['lecid'])) {
        if (!empty($_GET['clsurl']) && !empty($_GET['clsid']) && !empty($_GET['dura']) && !empty($_GET['lecid'])) {
            $lecAttendance = new Lec_Attendance();
            $lecAttendance->setLecOnlineAttendance($_GET['clsurl'],$_GET['clsid'],$_GET['dura'],$_GET['lecid']);
        } else {
            header('location:../pages/Lecturer/Classes/ManageOnline/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please try again!";
        }
    }

}
else
{
    header('location:../pages/Lecturer/Login.php');
}
?>