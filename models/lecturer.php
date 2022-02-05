<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";

$conn = new Conn();
$con = $conn->getConn();
session_start();

$lecturer = new Lecturer();

if(isset($_POST['signin']))
{
    $lecturer->login($_POST['username'],$_POST['password']);
}
else if(isset($_GET['logout']))
{
    $lecturer->logout();
}
else if (isset($_POST['Lregsub'])) {
    if($_POST['subname'] === null && $_POST['regfee'] === null) {
        header('location:../pages/Lecturer/Register/Register.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please enter the details";
    } else {
        $lecturer->regSubject($_POST['subname'],$_POST['regfee']);
    }
}
else if (isset($_POST['searchHomework'])) {
    if($_POST['homeworkid'] === null) {
        header('location:../pages/Lecturer/Homeworks/Submissions/Submission.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please enter the details";
    } else {
        $lecturer->setHomeworkIdSession($_POST['homeworkid']);
    }
}

class Lecturer
{
    // properties
    protected $lecturer_id;
    private $fname;
    private $lname;
    private $usrname;
    private $passwordHash;
    private $dob;
    private $email;
    protected $certification;
    protected $adrsl1;
    protected $adrsl2;
    protected $adrsl3;
    protected $city;
    protected $district;
    protected $zipcode;
    protected $accountno;
    protected $bankname;
    protected $branchcode;
    protected $branchname;
    protected $accountname;
    private $submissiondate;

    // methods
    function setLecturer($fname,$lname,$dob,$email,$certification,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$accountno,$bankname,$branchcode,$branchname,$accountname,$submissiondate)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->email = $email;
        $this->certification = $certification;
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->accountno = $accountno;
        $this->bankname = $bankname;
        $this->branchcode = $branchcode;
        $this->branchname = $branchname;
        $this->accountname = $accountname;
        $this->submissiondate = $submissiondate;
    }

    public function getName($lecturer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT fname,lname FROM lecturer WHERE lecturer_id='".$lecturer_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $lecturer_name = $row['fname']." ".$row['lname'];
                }
                return $lecturer_name;
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

    public function login($username,$password)
    {
        try {
            global $con;
            $result = $con->query("SELECT usrname,lecturer_id,passwordhash FROM lecturer WHERE usrname='".$username."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if($row['usrname']==$username && password_verify($password, $row['passwordhash'])) {
                        $_SESSION['id']=$row['lecturer_id'];
                        header('location:../pages/Lecturer/Dashboard.php');
                        //setcookie("id", $row['student_id']);
                    } else {
                        header('location:../pages/Lecturer/Login.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Username and Password don't match!";
                    }
                }
            } else {
                header('location:../pages/Lecturer/Login.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please enter Username & Password";
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function logout()
    {
        try{
            global $con;
            if (isset($_SESSION['id'])) {
                session_destroy();
                header('location:../pages/Lecturer/Login.php');
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }


    public function getOnlinelist($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT ol.ol_cls_id,s.subjectname,ol.classurl,ol.description,cd.date,c.duration,c.starttime FROM lecturer_reg lr, subject s, class_dates cd, online_class ol, class c WHERE lr.id='".$lecturer_id."' AND lr.lec_sub_id=c.sub_cls_id AND c.sub_cls_id=s.subject_id AND c.class_id=ol.ol_cls_id AND c.class_id=cd.cls_dt_id AND cd.date=curdate()");
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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


    public function getOfflinelist($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT of.of_cls_id,s.subjectname,of.hallno,cd.date,c.duration,c.starttime FROM lecturer_reg lr, subject s, class_dates cd, offline_class of, class c WHERE lr.id='".$lecturer_id."' AND lr.lec_sub_id=c.sub_cls_id AND c.sub_cls_id=s.subject_id AND c.class_id=of.of_cls_id AND c.class_id=cd.cls_dt_id AND cd.date=curdate()");
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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

    public function viewOfflineAttendance($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT la.cls_attlec_id,la.date,la.intime,la.outtime FROM lec_attendance la, offline_class of WHERE la.lec_att_id='".$lecturer_id."' AND la.cls_attlec_id=of.of_cls_id");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
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

    public function viewOnlineAttendance($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT la.cls_attlec_id,la.date,la.intime,la.outtime FROM lec_attendance la, online_class ol WHERE la.lec_att_id='".$lecturer_id."' AND la.cls_attlec_id=ol.ol_cls_id");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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

    function regSubject($subname,$regfee)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            $subject = new Subject();
            global $con;
            $subject_id = $subject->getId($subname);
            $lecturer_id = $_SESSION['id'];
            $fee = $subject->getFee($subname)+1000;
            if($fee == $regfee) {
                if($con->query("INSERT INTO lecturer_reg (lec_reg_id,lec_sub_id,registrationdate,regfee) VALUES ($lecturer_id,$subject_id,'".date("Y-m-d")."',$regfee)") === TRUE) {
                    header('location:../pages/Lecturer/Register/Register.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Registered Successfully!";
                } else {
                    header('location:../pages/Lecturer/Register/Register.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            } else {
                header('location:../pages/Lecturer/Register/Register.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please enter the valid registration amount";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getHomewrokList($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT h.hw_id,s.subjectname,h.name,h.type,h.description,h.fileName,hc.deadlinedate,hc.createddate FROM subject s, homework h, hw_creation hc WHERE s.subject_id=h.hw_sub_id AND h.hw_id=hc.cre_hw_id AND hc.cre_lec_id='".$lecturer_id."'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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

    function getHomewrokSubmissionList($lecturer_id,$homework_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT su.student_id,CONCAT(su.fname,' ',su.lname) AS studentname,h.name,s.subjectname,hc.deadlinedate,hs.submitdate,hs.fileName,hs.path FROM homework h, hw_submission hs, hw_creation hc, student su, subject s WHERE h.hw_id=hs.sub_hw_id AND h.hw_sub_id=s.subject_id AND hc.cre_hw_id=h.hw_id AND hs.submitdate IS NOT NULL AND hs.fileName IS NOT NULL AND hs.path IS NOT NULL AND hs.submitdate <= hc.deadlinedate AND hc.cre_lec_id='".$lecturer_id."' AND hc.cre_hw_id='".$homework_id."'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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

    public function setHomeworkIdSession($homework_id)
        {
            header('location:../pages/Lecturer/Homeworks/Submissions/Submission.php');
            $_SESSION['homeworkid']=$homework_id;
            //echo "Error: ".$con->error;
        }

    function getHomewrokIdList($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT hc.cre_hw_id FROM hw_creation hc WHERE hc.cre_lec_id='".$lecturer_id."'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row = array_map('stripslashes', $row);
                    $data[] = $row;
                }
                return $data;
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


?>