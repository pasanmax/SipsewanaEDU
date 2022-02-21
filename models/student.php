<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";
// include_once "$root/SipsewanaEDU/models/subject.php";
// include_once dirname(__FILE__) . "/subject.php";
$conn = new Conn();
$con = $conn->getConn();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$student = new Student();
// $online_class = new Online_Class();
if(isset($_POST['signin']))
{
    $student->login($_POST['username'],$_POST['password']);
}
else if(isset($_GET['logout']))
{
    $student->logout();
}
else if (isset($_POST['regsub'])) {
    if(empty($_POST['subname']) || empty($_POST['regfee'])) {
        header('location:../pages/Student/Register/Register.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please enter the details";
    } else {
        $student->regSubject($_POST['subname'],$_POST['regfee']);
    }
}

class Student
{
    // properties
    protected $student_id;
    protected $fname;
    protected $lname;
    protected $usrname;
    protected $passwordHash;
    protected $dob;
    protected $school;
    protected $adrsl1;
    protected $adrsl2;
    protected $adrsl3;
    protected $city;
    protected $district;
    protected $zipcode;
    protected $gfname;
    protected $glname;
    protected $gemail;
    protected $gcontactNo;
    protected $relationship;
    private $submissiondate;

    // methods
    function setStudent($fname,$lname,$dob,$school,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$gfname,$glname,$gemail,$gcontactNo,$relationship,$submissiondate)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->school = $school;
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->gfname = $gfname;
        $this->glname = $glname;
        $this->gemail = $gemail;
        $this->gcontactNo = $gcontactNo;
        $this->relationship = $relationship;
        $this->submissiondate = $submissiondate;
    }

    public function getName($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT fname,lname FROM student WHERE student_id='".$student_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $student_name = $row['fname']." ".$row['lname'];
                }
                return $student_name;
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
    
    public function getGemail($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT s.gemail FROM student s WHERE s.student_id='".$student_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $gemail = $row['gemail'];
                }
                return $gemail;
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
            $result = $con->query("SELECT usrname,student_id,passwordhash FROM student WHERE usrname='".$username."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if($row['usrname']==$username && password_verify($password, $row['passwordhash'])) {
                        $_SESSION['id']=$row['student_id'];
                        header('location:../pages/Student/Dashboard.php');
                        //setcookie("id", $row['student_id']);
                    } else {
                        header('location:../pages/Student/Login.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Username and Password don't match!";
                    }
                }
            } else {
                header('location:../pages/Student/Login.php');
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
                header('location:../pages/Student/Login.php');
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function getOnlinelist($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT online_class.ol_cls_id,subject.subjectname,online_class.classurl,class_dates.date,class.duration,class.starttime FROM student_reg,subject,class_dates,online_class,class WHERE student_reg.id='".$student_id."' AND student_reg.st_sub_id=class.sub_cls_id AND class.sub_cls_id=subject.subject_id AND class.class_id=online_class.ol_cls_id AND class.class_id=class_dates.cls_dt_id AND class_dates.date=curdate()");
            
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
        // global $con;
        // $data = array();
        // $result = $con->query("SELECT online_class.ol_cls_id,subject.subjectname,online_class.classurl,class_dates.date,class.duration,class.starttime FROM student_reg,subject,class_dates,online_class,class WHERE student_reg.id='".$student_id."' AND student_reg.st_sub_id=class.sub_cls_id AND class.sub_cls_id=subject.subject_id AND class.class_id=online_class.ol_cls_id AND class.class_id=class_dates.cls_dt_id AND class_dates.date=curdate()");
        
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $row = array_map('stripslashes', $row);
        //         $data[] = $row;
        //     }
        //     return $data;
        // } else {
        //     return null;
        // }
        // $con->close();
    }

    public function getOfflinelist($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT offline_class.of_cls_id,subject.subjectname,offline_class.hallno,class_dates.date,class.duration,class.starttime FROM student_reg,subject,class_dates,offline_class,class WHERE student_reg.id='".$student_id."' AND student_reg.st_sub_id=class.sub_cls_id AND class.sub_cls_id=subject.subject_id AND class.class_id=offline_class.of_cls_id AND class.class_id=class_dates.cls_dt_id AND class_dates.date=curdate()");
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

    function regSubject($subname,$regfee)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            $subject = new Subject();
            global $con;
            $subject_id = $subject->getId($subname);
            $student_id = $_SESSION['id'];
            $fee = $subject->getFee($subname)+1000;
            if($fee == $regfee) {
                if($con->query("INSERT INTO student_reg (st_reg_id,st_sub_id,registrationdate,regfee) VALUES ($student_id,$subject_id,'".date("Y-m-d")."',$regfee)") === TRUE) {
                    header('location:../pages/Student/Register/Register.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Registered Successfully!";
                } else {
                    header('location:../pages/Student/Register/Register.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            } else {
                header('location:../pages/Student/Register/Register.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please enter the valid registration amount";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getHomewrokList($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT hs.id,h.hw_id,h.name,s.subjectname,hc.createddate,hc.deadlinedate,hs.submitdate FROM subject s, student_reg sr, homework h, hw_creation hc, hw_submission hs WHERE sr.st_sub_id = s.subject_id AND sr.st_sub_id = h.hw_sub_id AND h.hw_id = hc.cre_hw_id AND h.hw_id = hs.sub_hw_id AND sr.st_reg_id='".$student_id."'");
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

    public function viewOnlineAttendance($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT sa.cls_attst_id,s.subjectname,sa.date,sa.intime,sa.outtime FROM stu_attendance sa, online_class ol, class c, subject s WHERE sa.st_att_id='".$student_id."' AND sa.cls_attst_id=ol.ol_cls_id AND ol.ol_cls_id=c.class_id AND c.sub_cls_id=s.subject_id");
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

    public function getOnlineAttendance($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT ROUND(COUNT(*)/4*100,0) as 'count' FROM stu_attendance sa, class c, online_class oc WHERE (date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AND sa.cls_attst_id = c.class_id AND c.class_id = oc.ol_cls_id AND c.sub_cls_id IN (SELECT sr.st_sub_id FROM student_reg sr WHERE sr.st_reg_id = '".$student_id."')");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }

    public function viewOfflineAttendance($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT sa.cls_attst_id,s.subjectname,sa.date,sa.intime,sa.outtime FROM stu_attendance sa, offline_class oc, class c, subject s WHERE sa.st_att_id='".$student_id."' AND sa.cls_attst_id=oc.of_cls_id AND oc.of_cls_id=c.class_id AND c.sub_cls_id=s.subject_id");
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

    public function getOfflineAttendance($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT ROUND(COUNT(*)/4*100,0) as 'count' FROM stu_attendance sa, class c, offline_class oc WHERE (date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AND sa.cls_attst_id = c.class_id AND c.class_id = oc.of_cls_id AND c.sub_cls_id IN (SELECT sr.st_sub_id FROM student_reg sr WHERE sr.st_reg_id = '".$student_id."')");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }

    public function getPendingHomeworksCount($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) as 'count' FROM hw_submission hs, homework h, student_reg sr, subject s WHERE hs.submitdate IS NULL AND hs.fileName IS NULL AND hs.path IS NULL AND sr.st_sub_id = s.subject_id AND hs.sub_hw_id=h.hw_id AND h.hw_sub_id=sr.st_sub_id AND sr.st_reg_id = '".$student_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }

    public function getPendingPaymentsCount($student_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) as 'count' FROM payment p, student_reg sr WHERE p.status = 'Pending' AND p.pay_sub_id = sr.st_sub_id AND p.pay_st_id = sr.st_reg_id AND sr.st_reg_id = '".$student_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $count = $row['count'];
                }
                return $count;
            } elseif ($result === false) {
                throw new Exception("Database Error!");
            } else {
                return 0;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }
}

?>