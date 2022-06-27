<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";

$conn = new Conn();
$con = $conn->getConn();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

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
    if(empty($_POST['subname']) || empty($_POST['regfee'])) {
        header('location:../pages/Lecturer/Register/Register.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please enter the details";
    } else {
        $lecturer->regSubject($_POST['subname'],$_POST['regfee']);
    }
}
else if (isset($_POST['searchHomework'])) {
    if(empty($_POST['homeworkid'])) {
        header('location:../pages/Lecturer/Homeworks/Submissions/Submission.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please enter the details";
    } else {
        $lecturer->setHomeworkIdSession($_POST['homeworkid']);
    }
}
if(isset($_POST['regLecturer']))
{
    if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['dob']) || empty($_POST['email']) || empty($_POST['cno']) || empty($_POST['certi'])
    || empty($_POST['adrsl1']) || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])
    || empty($_POST['accountno']) || empty($_POST['accountname']) || empty($_POST['bankname']) || empty($_POST['branchname']) || empty($_POST['branchcode'])
    || empty($_POST['subject'])) {
        header('location:../pages/Lecturer/Register.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $lecturer->setLecturer($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['email'],$_POST['cno'],$_POST['certi'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],
        $_POST['city'],$_POST['district'],$_POST['zipcode'],$_POST['accountno'],$_POST['bankname'],$_POST['branchcode'],$_POST['branchname'],$_POST['accountname']);
        $lecturer->register($_POST['subject']);
    }
}

class Lecturer
{
    // properties
    private $lecturer_id;
    private $fname;
    private $lname;
    private $usrname;
    private $passwordHash;
    private $dob;
    private $email;
    private $contactno;
    private $certification;
    private $adrsl1;
    private $adrsl2;
    private $adrsl3;
    private $city;
    private $district;
    private $zipcode;
    private $accountno;
    private $bankname;
    private $branchcode;
    private $branchname;
    private $accountname;
    private $submissiondate;

    // methods
    function setLecturer($fname,$lname,$dob,$email,$contactno,$certification,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$accountno,$bankname,$branchcode,$branchname,$accountname)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = date("Y-m-d", strtotime($dob));
        $this->email = $email;
        $this->contactno = $contactno;
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
        $this->submissiondate = date("Y-m-d");
    }

    function register($subjectname)
    {
        try {
            global $con;
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
            $subject = new Subject();
            $fee = $subject->getFee($subjectname)+2000;
            $subject_id = $subject->getId($subjectname);
            $fname = $this->fname;
            $lname = $this->lname;
            $dob = $this->dob;
            $adrsl1 = $this->adrsl1;
            $adrsl2 = $this->adrsl2;
            $adrsl3 = $this->adrsl3;
            $city = $this->city;
            $district = $this->district;
            $zipcode = $this->zipcode;
            $accountno = $this->accountno;
            $bankname = $this->bankname;
            $branchcode = $this->branchcode;
            $branchname = $this->branchname;
            $accountname = $this->accountname;
            $contactno = $this->contactno;
            $contactno = str_replace('(','',$contactno);
            $contactno = str_replace(')','',$contactno);
            $contactno = str_replace(' ','',$contactno);
            $contactno = str_replace('-','',$contactno);
            //$submissiondate = $this->submissiondate;

            if($con->query("INSERT INTO lecturer(fname,lname,usrname,passwordhash,dob,email,contactno,certification,adrsl1,adrsl2,adrsl3,city,district,zipcode,accountno,bankname,branchcode,branchname,accountname) VALUES ('".$fname."','".$lname."',NULL,NULL,'".$dob."','".$email."','".$contactno."','".$certification."','".$adrsl1."','".$adrsl2."','".$adrsl3."','".$city."','".$district."','".$zipcode."','".$accountno."','".$bankname."','".$branchcode."','".$branchname."','".$accountname."')") === true) {
                $lecturer_id = $this->getLastId();
                if($con->query("INSERT INTO lecturer_reg(lec_reg_id,lec_sub_id,registrationdate,regfee) VALUES ('".$lecturer_id."','".$subject_id."','".$submissiondate."','".$fee."')") === true) {
                    header('location:../pages/Lecturer/Register.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Registered successfully!";
                } else {
                    // header('location:../pages/Lecturer/Register.php');
                    // $_SESSION['response']="danger";
                    // $_SESSION['message']="Database error!";
                    echo "Error: ".$con->error;
                }
            } else {
                // header('location:../pages/Lecturer/Register.php');
                // $_SESSION['response']="danger";
                // $_SESSION['message']="Database error!";
                echo "Error: ".$con->error;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
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

    public function getLastId()
    {
        try {
            global $con;
            $result = $con->query("SELECT l.lecturer_id FROM lecturer l ORDER BY l.lecturer_id DESC LIMIT 1");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $lecturer_id = $row['lecturer_id'];
                }
                return $lecturer_id;
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

    public function getEmail($lecturer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT l.email FROM lecturer l WHERE l.lecturer_id='".$lecturer_id."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $email = $row['email'];
                }
                return $email;
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
            $result = $con->query("SELECT ol.ol_cls_id,s.subjectname,ol.classurl,ol.description,c.date,c.duration,c.starttime FROM lecturer_reg lr, subject s, online_class ol, class c WHERE lr.lec_reg_id='".$lecturer_id."' AND lr.lec_sub_id=c.sub_cls_id AND c.sub_cls_id=s.subject_id AND c.class_id=ol.ol_cls_id AND c.date>=curdate()");// 
            
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
            $result = $con->query("SELECT of.of_cls_id,s.subjectname,of.hallno,c.date,c.duration,c.starttime FROM lecturer_reg lr, subject s, offline_class of, class c WHERE lr.lec_reg_id='".$lecturer_id."' AND lr.lec_sub_id=c.sub_cls_id AND c.sub_cls_id=s.subject_id AND c.class_id=of.of_cls_id AND c.date>=curdate()");
            
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
            $result = $con->query("SELECT la.cls_attlec_id,s.subjectname,la.date,la.intime,la.outtime FROM lec_attendance la, offline_class of, class c, subject s WHERE la.lec_att_id='".$lecturer_id."' AND la.cls_attlec_id=of.of_cls_id AND of.of_cls_id=c.class_id AND c.sub_cls_id=s.subject_id");
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

    public function getOfflineAttendance($lecturer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT ROUND(COUNT(*)/4*100,0) as 'count' FROM lec_attendance la, class c, offline_class oc WHERE (c.date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AND la.cls_attlec_id = c.class_id AND c.class_id = oc.of_cls_id AND c.sub_cls_id IN (SELECT lr.lec_sub_id FROM lecturer_reg lr WHERE lr.lec_reg_id = '".$lecturer_id."')");
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

    public function viewOnlineAttendance($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT la.cls_attlec_id,s.subjectname,la.date,la.intime,la.outtime FROM lec_attendance la, online_class ol, class c, subject s WHERE la.lec_att_id='".$lecturer_id."' AND la.cls_attlec_id=ol.ol_cls_id AND ol.ol_cls_id=c.class_id AND c.sub_cls_id=s.subject_id");
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

    public function getOnlineAttendance($lecturer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT ROUND(COUNT(*)/4*100,0) as 'count' FROM lec_attendance la, class c, online_class oc WHERE (c.date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AND la.cls_attlec_id = c.class_id AND c.class_id = oc.ol_cls_id AND c.sub_cls_id IN (SELECT lr.lec_sub_id FROM lecturer_reg lr WHERE lr.lec_reg_id = '".$lecturer_id."')");
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
            $result = $con->query("SELECT su.student_id,CONCAT(su.fname,' ',su.lname) AS studentname,h.name,s.subjectname,hc.deadlinedate,hs.submitdate,hs.fileName,hs.path FROM homework h, hw_submission hs, hw_creation hc, student su, subject s WHERE h.hw_id=hs.sub_hw_id AND h.hw_sub_id=s.subject_id AND hc.cre_hw_id=h.hw_id AND hs.sub_st_id=su.student_id AND hs.submitdate IS NOT NULL AND hs.fileName IS NOT NULL AND hs.path IS NOT NULL AND hs.submitdate <= hc.deadlinedate AND hc.cre_lec_id='".$lecturer_id."' AND hc.cre_hw_id='".$homework_id."'");
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

    function getLearningModuleList($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT lm.lm_id,lm.name,s.subjectname,lm.fileName,lm.date,lm.path,lm.description FROM learning_module lm, subject s WHERE lm.lm_sub_id=s.subject_id AND lm.lm_lec_id='".$lecturer_id."'");
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