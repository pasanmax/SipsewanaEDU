<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";
require "$root/SipsewanaEDU/plugins/phpmailer/PHPMailer.php";
require "$root/SipsewanaEDU/plugins/phpmailer/SMTP.php";
require "$root/SipsewanaEDU/plugins/phpmailer/Exception.php";
use phpmailer\PHPMailer\PHPMailer;
use phpmailer\PHPMailer\Exception;
use phpmailer\PHPMailer\SMTP;
// include_once "$root/SipsewanaEDU/models/subject.php";
// include_once dirname(__FILE__) . "/subject.php";
$conn = new Conn();
$con = $conn->getConn();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$frontofficer = new FrontOfficer();
// $online_class = new Online_Class();
if(isset($_POST['signin']))
{
    $frontofficer->login($_POST['username'],$_POST['password']);
}
else if(isset($_GET['logout']))
{
    $frontofficer->logout();
}
else if(isset($_POST['approvestudent']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['studentid']) || empty($_POST['subjectname'])
    || empty($_POST['sname'])) {
        header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the details!";
    } else {
        $frontofficer->approveStudent($_POST['studentid'],$_POST['username'],$_POST['password'],$_POST['subjectname'],$_POST['sname']);
    }
}
else if(isset($_GET['delStuApproval']))
{
    $frontofficer->delStudentApproval($_GET['delStuApproval']);
}
else if(isset($_POST['approvelecturer']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['lecturerid']) || empty($_POST['subjectname'])
    || empty($_POST['lname'])) {
        header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the details!";
    } else {
        $frontofficer->approveLecturer($_POST['lecturerid'],$_POST['username'],$_POST['password'],$_POST['subjectname'],$_POST['lname']);
    }
}
else if(isset($_GET['delLecApproval']))
{
    $frontofficer->delLecturerApproval($_GET['delLecApproval']);
}
else if(isset($_POST['approvefrontofficer']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['foofficerid']) || empty($_POST['email']) 
    || empty($_POST['contactno']) || empty($_POST['foname'])) {
        header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the details!";
    } else {
        $frontofficer->approveFOffier($_POST['foofficerid'],$_POST['username'],$_POST['password'],$_POST['foname']);
    }
}
else if(isset($_GET['delFoApproval']))
{
    $frontofficer->delFOfficerApproval($_GET['delFoApproval']);
}
else if(isset($_POST['approvedirector']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['directorid']) || empty($_POST['email']) 
    || empty($_POST['contactno']) || empty($_POST['dname'])) {
        header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the details!";
    } else {
        $frontofficer->approveDirector($_POST['directorid'],$_POST['username'],$_POST['password'],$_POST['dname']);
    }
}
else if(isset($_GET['delDirApproval']))
{
    $frontofficer->delDirectorApproval($_GET['delDirApproval']);
}
else if(isset($_POST['approvecashier']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['cashierid']) || empty($_POST['email'])
    || empty($_POST['contactno']) || empty($_POST['cname'])) {
        header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the details!";
    } else {
        $frontofficer->approveCashier($_POST['cashierid'],$_POST['username'],$_POST['password'],$_POST['cname']);
    }
}
else if(isset($_GET['delCasApproval']))
{
    $frontofficer->delCashierApproval($_GET['delCasApproval']);
}
else if(isset($_POST['updateStudent']))
{
    include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
    $subject = new Subject();
    if($subject->getSType($_POST['studentid']) === "A/L"){

        if(empty($_POST['studentid']) || empty($_POST['stfname']) || empty($_POST['stlname'])
        || empty($_POST['gcontactno']) || empty($_POST['dob']) || empty($_POST['school']) || empty($_POST['adrsl1'])
        || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district'])
        || empty($_POST['zipcode']) || empty($_POST['gfname']) || empty($_POST['glname']) || empty($_POST['gemail'])
        || empty($_POST['relationship']) || empty($_POST['idno']) || empty($_POST['email']) || empty($_POST['contactno'])) {
            header('location:../pages/Front Officer/Students/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            $frontofficer->updateALStudent($_POST['studentid'],$_POST['stfname'],$_POST['stlname'],$_POST['gcontactno'],
            $_POST['dob'],$_POST['school'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],$_POST['city'],$_POST['district'],
            $_POST['zipcode'],$_POST['gfname'],$_POST['glname'],$_POST['gemail'],$_POST['relationship'],$_POST['idno'],
            $_POST['email'],$_POST['contactno']);
        }

    } else if($subject->getSType($_POST['studentid']) === "O/L") {
        if(empty($_POST['studentid']) || empty($_POST['stfname']) || empty($_POST['stlname'])
        || empty($_POST['gcontactno']) || empty($_POST['dob']) || empty($_POST['school']) || empty($_POST['adrsl1'])
        || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district'])
        || empty($_POST['zipcode']) || empty($_POST['gfname']) || empty($_POST['glname']) || empty($_POST['gemail'])
        || empty($_POST['relationship']) || empty($_POST['ttresults'])) {
            header('location:../pages/Front Officer/Students/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            $frontofficer->updateOLStudent($_POST['studentid'],$_POST['stfname'],$_POST['stlname'],$_POST['gcontactno'],
            $_POST['dob'],$_POST['school'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],$_POST['city'],$_POST['district'],
            $_POST['zipcode'],$_POST['gfname'],$_POST['glname'],$_POST['gemail'],$_POST['relationship'],$_POST['ttresults']);
        }
    } else {
        header('location:../pages/Front Officer/Students/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Subject type not found!";
    }
}
if(isset($_GET['delStu']))
{
    $frontofficer->deleteStudent($_GET['delStu']);
}
else if(isset($_POST['updateLecturer']))
{
    if(empty($_POST['lecturerid']) || empty($_POST['lecfname']) || empty($_POST['leclname'])
    || empty($_POST['contactno']) || empty($_POST['dob']) || empty($_POST['email']) || empty($_POST['certification']) || empty($_POST['adrsl1'])
    || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district'])
    || empty($_POST['zipcode']) || empty($_POST['accountno']) || empty($_POST['bankname']) || empty($_POST['branchcode'])
    || empty($_POST['branchname']) || empty($_POST['accountname'])) {
        header('location:../pages/Front Officer/Lecturers/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->updateLecturer($_POST['lecturerid'],$_POST['lecfname'],$_POST['leclname'],$_POST['dob'],$_POST['email'],
        $_POST['contactno'],$_POST['certification'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],$_POST['city'],$_POST['district'],
        $_POST['zipcode'],$_POST['accountno'],$_POST['bankname'],$_POST['branchcode'],$_POST['branchname'],$_POST['accountname']);
    }
}
if(isset($_GET['delLec']))
{
    $frontofficer->deleteLecturer($_GET['delLec']);
}
else if(isset($_POST['updateFoOfficer']))
{
    if(empty($_POST['foid']) || empty($_POST['fofname']) || empty($_POST['folname'])
    || empty($_POST['contactno']) || empty($_POST['dob']) || empty($_POST['email']) || empty($_POST['adrsl1'])
    || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])) {
        header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->updateFrontOfficer($_POST['foid'],$_POST['fofname'],$_POST['folname'],$_POST['dob'],$_POST['email'],$_POST['contactno'],
        $_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],$_POST['city'],$_POST['district'],$_POST['zipcode']);
    }
}
if(isset($_GET['delFo']))
{
    $frontofficer->deleteFrontOfficer($_GET['delFo']);
}
else if(isset($_POST['registerFrontOfficer']))
{
    if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['cno']) || empty($_POST['dob']) || empty($_POST['email'])
    || empty($_POST['adrsl1']) || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])) {
        header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->setFrontOfficer($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],
        $_POST['city'],$_POST['district'],$_POST['zipcode'],$_POST['email'],$_POST['cno']);
        $frontofficer->register();
    }
}
else if(isset($_POST['updateCashier']))
{
    if(empty($_POST['cashierid']) || empty($_POST['fname']) || empty($_POST['lname'])
    || empty($_POST['contactno']) || empty($_POST['dob']) || empty($_POST['email']) || empty($_POST['adrsl1'])
    || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])) {
        header('location:../pages/Front Officer/Cashiers/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->updateCashier($_POST['cashierid'],$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['email'],$_POST['contactno'],
        $_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],$_POST['city'],$_POST['district'],$_POST['zipcode']);
    }
}
if(isset($_GET['delCas']))
{
    $frontofficer->deleteCashier($_GET['delCas']);
}
else if(isset($_POST['updateDirector']))
{
    if(empty($_POST['directorid']) || empty($_POST['fname']) || empty($_POST['lname'])
    || empty($_POST['contactno']) || empty($_POST['dob']) || empty($_POST['email'])) {
        header('location:../pages/Front Officer/Directors/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->updateDirector($_POST['directorid'],$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['email'],$_POST['contactno']);
    }
}
if(isset($_GET['delDir']))
{
    $frontofficer->deleteDirector($_GET['delDir']);
}
else if(isset($_POST['updateSubject']))
{
    if(empty($_POST['subjectid']) || empty($_POST['subname']) || empty($_POST['medium'])
    || empty($_POST['fee']) || empty($_POST['type']) || empty($_POST['description'])) {
        header('location:../pages/Front Officer/Subjects/Manage/List.php');
        $_SESSION['response']="danger";
        $_SESSION['message']="Please fill the relevant details!";
    } else {
        $frontofficer->updateSubject($_POST['subjectid'],$_POST['subname'],$_POST['medium'],$_POST['fee'],$_POST['type'],$_POST['description']);
    }
}
if(isset($_GET['delSub']))
{
    $frontofficer->deleteSubject($_GET['delSub']);
}

class FrontOfficer
{
    // properties
    private $fname;
    private $lname;
    private $usrname;
    private $passwordHash;
    private $dob;
    private $adrsl1;
    private $adrsl2;
    private $adrsl3;
    private $city;
    private $district;
    private $zipcode;
    private $email;
    private $contactNo;

    // methods
    function setFrontOfficer($fname,$lname,$dob,$adrsl1,$adrsl2,$adrsl3,$city,$district,$zipcode,$email,$contactNo)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = date("Y-m-d", strtotime($dob));
        $this->adrsl1 = $adrsl1;
        $this->adrsl2 = $adrsl2;
        $this->adrsl3 = $adrsl3;
        $this->city = $city;
        $this->district = $district;
        $this->zipcode = $zipcode;
        $this->email = $email;
        $this->contactNo = $contactNo;
    }

    public function login($username,$password)
    {
        try {
            global $con;
            $result = $con->query("SELECT fo.usrname,fo.fo_id,fo.passwordhash FROM front_officer fo WHERE fo.usrname='".$username."'");
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if($row['usrname']==$username && password_verify($password, $row['passwordhash'])) {
                        $_SESSION['id']=$row['fo_id'];
                        header('location:../pages/Front Officer/Dashboard.php');
                        //setcookie("id", $row['student_id']);
                    } else {
                        header('location:../pages/Front Officer/Login.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Username and Password don't match!";
                    }
                }
            } else {
                header('location:../pages/Front Officer/Login.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Please enter Username & Password";
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function getName($frontofficer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT fname,lname FROM front_officer WHERE fo_id='".$frontofficer_id."'");
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

    public function logout()
    {
        try{
            global $con;
            if (isset($_SESSION['id'])) {
                session_destroy();
                header('location:../pages/Front Officer/Login.php');
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function getEmail($frontofficer_id)
    {
        try {
            global $con;
            $result = $con->query("SELECT f.email FROM front_officer f WHERE f.fo_id='".$frontofficer_id."'");
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

    function register()
    {
        try {
            global $con;
            $fname = $this->fname;
            $lname = $this->lname;
            $dob = $this->dob;
            $adrsl1 = $this->adrsl1;
            $adrsl2 = $this->adrsl2;
            $adrsl3 = $this->adrsl3;
            $city = $this->city;
            $district = $this->district;
            $zipcode = $this->zipcode;
            $email = $this->email;
            $contactNo = $this->contactNo;
            
            if($con->query("INSERT INTO front_officer (fname,lname,dob,adrsl1,adrsl2,adrsl3,city,district,zipcode,email,contactno) VALUES ('$fname','$lname','$dob','$adrsl1','$adrsl2','".$adrsl3."','$city','$district','$zipcode','$email','$contactNo')") === TRUE) {
                header('location:../pages/Front Officer/FrontOfficers/Register/Register.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Entered Successfully!";
            } else {
                header('location:../pages/Front Officer/FrontOfficers/Register/Register.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                // echo "Error: ".$con->error;
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    // ==============================Student Approval=====================================

    function getStudentApprovals()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT st.student_id,CONCAT(st.fname, ' ' ,st.lname) AS studentname,s.subjectname,st.gcontactno FROM student st, student_reg sr, subject s WHERE st.student_id=sr.st_reg_id AND sr.st_sub_id=s.subject_id AND st.usrname IS NULL AND st.passwordhash IS NULL");
            
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

    function approveStudent($student_id,$username,$password,$subjectname,$studentname)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/student.php";
            $student = new Student();
            $gemail = $student->getGemail($student_id);

            //smtp settings
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "testmailransilu@gmail.com";
            $mail->Password = "pasana@123";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom($gemail,$studentname);
            $mail->addAddress("$gemail");
            $mail->Subject = ("Approved by the Front Officer Sipsewana EDU");
            $mail->Body = "Please use your Username : $username and Password : $password to login to your account.\nSent By Sipsewana EDU";

            if($mail->send()){
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $subject_id = $subject->getId($subjectname);
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/student_reg.php";
                $student_reg = new StudentReg();
                $student_reg->setRegistrationdate();
                $registrationdate = $student_reg->getRegistrationdate();
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                global $con;
                
                if($con->query("UPDATE student SET usrname='".$username."',passwordhash='".$passwordHash."' WHERE student_id='".$student_id."'") === TRUE
                && $con->query("UPDATE student_reg SET registrationdate='".$registrationdate."' WHERE st_reg_id='".$student_id."' AND st_sub_id='".$subject_id."'") === TRUE) {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Approved Successfully!";
                } else {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            }
            else
            {
                header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Email cannot sent!";
            }
            $mail->smtpClose();
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function delStudentApproval($student_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM student WHERE student_id='".$student_id."'") === TRUE) {
                header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                //echo "Error: ".$con->error;
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    // ==============================Lecturer Approval=====================================

    function getLecturerApprovals()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT l.lecturer_id,CONCAT(l.fname, ' ' ,l.lname) AS lecturername,s.subjectname,l.contactno FROM lecturer l, lecturer_reg lr, subject s WHERE l.lecturer_id=lr.lec_reg_id AND lr.lec_sub_id=s.subject_id AND l.usrname IS NULL AND l.passwordhash IS NULL");
            
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

    function approveLecturer($lecturer_id,$username,$password,$subjectname,$lecturername)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/lecturer.php";
            $lecturer = new Lecturer();
            $email = $lecturer->getEmail($lecturer_id);

            //smtp settings
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "testmailransilu@gmail.com";
            $mail->Password = "pasana@123";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom($email,$lecturername);
            $mail->addAddress("$email");
            $mail->Subject = ("Approved by the Front Officer Sipsewana EDU");
            $mail->Body = "Please use your Username : $username and Password : $password to login to your account.\nSent By Sipsewana EDU";

            if($mail->send()){
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $subject_id = $subject->getId($subjectname);
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/lecturer_reg.php";
                $lecturer_reg = new LecturerReg();
                $lecturer_reg->setRegistrationdate();
                $registrationdate = $lecturer_reg->getRegistrationdate();
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                global $con;
                
                if($con->query("UPDATE lecturer SET usrname='".$username."',passwordhash='".$passwordHash."' WHERE lecturer_id='".$lecturer_id."'") === TRUE
                && $con->query("UPDATE lecturer_reg SET registrationdate='".$registrationdate."' WHERE lec_reg_id='".$lecturer_id."' AND lec_sub_id='".$subject_id."'") === TRUE) {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Approved Successfully!";
                } else {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            }
            else
            {
                header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Email cannot sent!";
            }
            $mail->smtpClose();
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function delLecturerApproval($lecturer_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM lecturer WHERE lecturer_id='".$lecturer_id."'") === TRUE) {
                header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                //echo "Error: ".$con->error;
            }
                // header('location:../pages/Student/Register/Register.php');
                // $_SESSION['response']="danger";
                // $_SESSION['message']="Please enter the valid registration amount";
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    // ==============================Front Officer Approval=====================================

    function getFOfficerApprovals()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT fo.fo_id,CONCAT(fo.fname, ' ' ,fo.lname) AS fofficername,fo.email,fo.contactno FROM front_officer fo WHERE fo.usrname IS NULL AND fo.passwordhash IS NULL");
            
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

    function approveFOffier($frontofficer_id,$username,$password,$fofficername)
    {
        try {
            $email = $this->getEmail($frontofficer_id);

            //smtp settings
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "testmailransilu@gmail.com";
            $mail->Password = "pasana@123";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom($email,$fofficername);
            $mail->addAddress("$email");
            $mail->Subject = ("Approved by the Front Officer Sipsewana EDU");
            $mail->Body = "Please use your Username : $username and Password : $password to login to your account.\nSent By Sipsewana EDU";

            if($mail->send()){
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                global $con;
                
                if($con->query("UPDATE front_officer SET usrname='".$username."',passwordhash='".$passwordHash."' WHERE fo_id='".$frontofficer_id."'") === TRUE) {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Approved Successfully!";
                } else {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            }
            else
            {
                header('location:../pages/Front Officer/ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Email cannot sent!";
            }
            $mail->smtpClose();
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function delFOfficerApproval($frontofficer_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM front_officer WHERE fo_id='".$frontofficer_id."'") === TRUE) {
                header('location:../pages/Front Officer/ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                //echo "Error: ".$con->error;
            }
                // header('location:../pages/Student/Register/Register.php');
                // $_SESSION['response']="danger";
                // $_SESSION['message']="Please enter the valid registration amount";
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    // ==============================Director Approval=====================================

    function getDirectorApprovals()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT d.dir_id,CONCAT(d.fname, ' ' ,d.lname) AS directorname,d.email,d.contactno FROM director d WHERE d.usrname IS NULL AND d.passwordhash IS NULL AND d.frt_dir_id IS NULL");
            
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

    function approveDirector($director_id,$username,$password,$directorname)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/director.php";
            $director = new Director();
            $email = $director->getEmail($director_id);

            //smtp settings
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "testmailransilu@gmail.com";
            $mail->Password = "pasana@123";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom($email,$directorname);
            $mail->addAddress("$email");
            $mail->Subject = ("Approved by the Front Officer Sipsewana EDU");
            $mail->Body = "Please use your Username : $username and Password : $password to login to your account.\nSent By Sipsewana EDU";

            if($mail->send()){
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                global $con;
                
                if($con->query("UPDATE director SET usrname='".$username."',passwordhash='".$passwordHash."',frt_dir_id='".$_SESSION['id']."' WHERE dir_id='".$director_id."'") === TRUE) {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Approved Successfully!";
                } else {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            }
            else
            {
                header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Email cannot sent!";
            }
            $mail->smtpClose();
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function delDirectorApproval($director_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM director WHERE dir_id='".$director_id."'") === TRUE) {
                header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                //echo "Error: ".$con->error;
            }
                // header('location:../pages/Student/Register/Register.php');
                // $_SESSION['response']="danger";
                // $_SESSION['message']="Please enter the valid registration amount";
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    // ==============================Cashier Approval=====================================

    function getCashierApprovals()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT c.cashier_id,CONCAT(c.fname, ' ' ,c.lname) AS cashiername,c.email,c.contactno FROM cashier c WHERE c.usrname IS NULL AND c.passwordhash IS NULL");
            
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

    function approveCashier($cashier_id,$username,$password,$cashiername)
    {
        try {
            include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/cashier.php";
            $cashier = new Cashier();
            $email = $cashier->getEmail($cashier_id);

            //smtp settings
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "testmailransilu@gmail.com";
            $mail->Password = "pasana@123";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom($email,$cashiername);
            $mail->addAddress("$email");
            $mail->Subject = ("Approved by the Front Officer Sipsewana EDU");
            $mail->Body = "Please use your Username : $username and Password : $password to login to your account.\nSent By Sipsewana EDU";

            if($mail->send()){
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                global $con;
                
                if($con->query("UPDATE cashier SET usrname='".$username."',passwordhash='".$passwordHash."' WHERE cashier_id='".$cashier_id."'") === TRUE) {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Approved Successfully!";
                } else {
                    header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                }
            }
            else
            {
                header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Email cannot sent!";
            }
            $mail->smtpClose();
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function delCashierApproval($cashier_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM cashier WHERE cashier_id='".$cashier_id."'") === TRUE) {
                header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
                //echo "Error: ".$con->error;
            }
                // header('location:../pages/Student/Register/Register.php');
                // $_SESSION['response']="danger";
                // $_SESSION['message']="Please enter the valid registration amount";
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getStudentList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT DISTINCT st.student_id,st.fname,st.lname,s.subjectname,st.gcontactno,st.dob,st.school,st.adrsl1,st.adrsl2,st.adrsl3,st.city,st.district,st.zipcode,st.gfname,st.glname,st.gemail,st.relationship, IF(st.student_id=ol.OLstudent_id, ol.ttresults, NULL) as 'ttresults',IF(st.student_id=al.ALstudent_id, al.idno, NULL) as 'idno',IF(st.student_id=al.ALstudent_id, al.email, NULL) as 'email',IF(st.student_id=al.ALstudent_id, al.contactno, NULL) as 'contactno' FROM student st, ol_student ol, al_student al, student_reg sr, subject s WHERE (st.student_id=ol.OLstudent_id OR st.student_id=al.ALstudent_id) AND st.student_id=sr.st_reg_id AND sr.st_sub_id=s.subject_id AND st.usrname IS NOT NULL AND st.passwordhash IS NOT NULL");
            
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

    function updateALStudent($student_id,$student_fname,$student_lname,$gcontact_no,$dob,$school,$adrsl1,$adrsl2,
    $adrsl3,$city,$district,$zipcode,$gfname,$glname,$gemail,$relationship,$idno,$email,$contact_no)
    {
        try {
            global $con;
            
            if($con->query("UPDATE student SET fname='".$student_fname."',lname='".$student_lname."',dob='".date("Y-m-d", strtotime($dob))."',school='".$school."',adrsl1='".$adrsl1."',adrsl2='".$adrsl2."',adrsl3='".$adrsl3."',city='".$city."',district='".$district."',zipcode='".$zipcode."',gfname='".$gfname."',glname='".$glname."',gemail='".$gemail."',gcontactno='".$gcontact_no."',relationship='".$relationship."' WHERE student_id='".$student_id."'") === TRUE
            && $con->query("UPDATE al_student SET idno='".$idno."',email='".$email."',contactno='".$contact_no."' WHERE ALstudent_id='".$student_id."'") === TRUE) {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function updateOLStudent($student_id,$student_fname,$student_lname,$gcontact_no,$dob,$school,$adrsl1,$adrsl2,
    $adrsl3,$city,$district,$zipcode,$gfname,$glname,$gemail,$relationship,$ttresults)
    {
        try {
            global $con;
            
            if($con->query("UPDATE student SET fname='".$student_fname."',lname='".$student_lname."',dob='".date("Y-m-d", strtotime($dob))."',school='".$school."',adrsl1='".$adrsl1."',adrsl2='".$adrsl2."',adrsl3='".$adrsl3."',city='".$city."',district='".$district."',zipcode='".$zipcode."',gfname='".$gfname."',glname='".$glname."',gemail='".$gemail."',gcontactno='".$gcontact_no."',relationship='".$relationship."' WHERE student_id='".$student_id."'") === TRUE
            && $con->query("UPDATE ol_student SET ttresults='".$ttresults."' WHERE OLstudent_id='".$student_id."'") === TRUE) {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteStudent($student_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM student WHERE student_id='".$student_id."'") === TRUE) {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/Students/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getStudentPayId()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id FROM payment p, student st, student_reg sr, subject s WHERE p.pay_sub_id=s.subject_id AND p.pay_st_id=st.student_id AND st.student_id=sr.st_reg_id AND p.pay_sub_id=sr.st_sub_id AND p.pay_lec_id IS NULL");
            
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

    function getStPayment($payment_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,s.subjectname,p.amount,p.date FROM payment p, subject s WHERE p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.type='Class Fees' AND p.pay_id='".$payment_id."'");
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

    function getLecPayment($payment_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,s.subjectname,p.amount,p.date FROM payment p, subject s WHERE p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.type='Monthly Fees' AND p.pay_id='".$payment_id."'");
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

    function getStudentHwId()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT h.hw_id FROM homework h, hw_submission hs, student st, student_reg sr, subject s WHERE h.hw_id=hs.sub_hw_id AND h.hw_sub_id=s.subject_id AND hs.sub_st_id=st.student_id AND st.student_id=sr.st_reg_id AND sr.st_sub_id=h.hw_sub_id AND sr.st_sub_id=s.subject_id AND hs.submitdate IS NOT NULL AND hs.fileName IS NOT NULL AND hs.path IS NOT NULL");
            
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

    function getStHomework($student_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT h.hw_id,CONCAT(st.fname, ' ' ,st.lname) AS 'studentname',s.subjectname,hs.submitdate,hc.deadlinedate,hs.fileName,hs.path FROM homework h, hw_submission hs, hw_creation hc, student st, student_reg sr, subject s WHERE h.hw_id=hs.sub_hw_id AND h.hw_sub_id=s.subject_id AND hs.sub_st_id=st.student_id AND st.student_id=sr.st_reg_id AND sr.st_sub_id=h.hw_sub_id AND sr.st_sub_id=s.subject_id AND h.hw_id=hc.cre_hw_id AND hs.sub_hw_id=hc.cre_hw_id AND hs.submitdate IS NOT NULL AND hs.fileName IS NOT NULL AND hs.path IS NOT NULL AND hs.sub_st_id='".$student_id."'");
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

    function getLecturerList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT l.lecturer_id,l.fname,l.lname,s.subjectname,l.contactno,l.dob,l.email,l.certification,l.adrsl1,l.adrsl2,l.adrsl3,l.city,l.district,l.zipcode,l.accountno,l.bankname,l.branchcode,l.branchname,l.accountname FROM lecturer l, lecturer_reg lr, subject s WHERE l.lecturer_id=lr.lec_reg_id AND lr.lec_sub_id=s.subject_id AND l.usrname IS NOT NULL AND l.passwordhash IS NOT NULL");
            
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

    function updateLecturer($lecturer_id,$lecturer_fname,$lecturer_lname,$dob,$email,$contact_no,$certification,$adrsl1,$adrsl2,
    $adrsl3,$city,$district,$zipcode,$accountno,$bankname,$branchcode,$branchname,$accountname)
    {
        try {
            global $con;
            
            if($con->query("UPDATE lecturer SET fname='".$lecturer_fname."',lname='".$lecturer_lname."',dob='".date("Y-m-d", strtotime($dob))."',email='".$email."',contactno='".$contact_no."',certification='".$certification."',adrsl1='".$adrsl1."',adrsl2='".$adrsl2."',adrsl3='".$adrsl3."',city='".$city."',district='".$district."',zipcode='".$zipcode."',accountno='".$accountno."',bankname='".$bankname."',branchcode='".$branchcode."',branchname='".$branchname."',accountname='".$accountname."' WHERE lecturer_id='".$lecturer_id."'") === TRUE ) {
                header('location:../pages/Front Officer/Lecturers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Lecturers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteLecturer($lecturer_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM lecturer WHERE lecturer_id='".$lecturer_id."'") === TRUE) {
                header('location:../pages/Front Officer/Lecturers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/Lecturers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getLecHomework($lecturer_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT h.hw_id,CONCAT(l.fname, ' ' ,l.lname) AS 'lecturername',s.subjectname,hc.createddate,hc.deadlinedate,(SELECT COUNT(*) FROM hw_submission hw WHERE hw.submitdate IS NOT NULL AND hw.fileName IS NOT NULL AND hw.path IS NOT NULL AND hw.sub_hw_id=h.hw_id) AS 'submitcount',h.fileName,h.path FROM homework h, hw_creation hc, lecturer l, lecturer_reg lr, subject s WHERE h.hw_id=hc.cre_hw_id AND hc.cre_lec_id=l.lecturer_id AND l.lecturer_id=lr.lec_reg_id AND lr.lec_sub_id=s.subject_id AND h.hw_sub_id=s.subject_id AND hc.cre_lec_id='".$lecturer_id."'");
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

    function getFoOfficerList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT fo.fo_id,fo.fname,fo.lname,fo.dob,fo.adrsl1,fo.adrsl2,fo.adrsl3,fo.city,fo.district,fo.zipcode,fo.email,fo.contactno FROM front_officer fo");
            
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

    function updateFrontOfficer($fo_id,$fo_fname,$fo_lname,$dob,$email,$contact_no,$adrsl1,$adrsl2,
    $adrsl3,$city,$district,$zipcode)
    {
        try {
            global $con;
            
            if($con->query("UPDATE front_officer SET fname='".$fo_fname."',lname='".$fo_lname."',dob='".date("Y-m-d", strtotime($dob))."',email='".$email."',contactno='".$contact_no."',adrsl1='".$adrsl1."',adrsl2='".$adrsl2."',adrsl3='".$adrsl3."',city='".$city."',district='".$district."',zipcode='".$zipcode."' WHERE fo_id='".$fo_id."'") === TRUE ) {
                header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteFrontOfficer($fo_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM front_officer WHERE fo_id='".$fo_id."'") === TRUE) {
                header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/FrontOfficers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getCashierList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT ca.cashier_id,ca.fname,ca.lname,ca.dob,ca.adrsl1,ca.adrsl2,ca.adrsl3,ca.city,ca.district,ca.zipcode,ca.email,ca.contactno FROM cashier ca");
            
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

    function updateCashier($cashier_id,$fname,$lname,$dob,$email,$contact_no,$adrsl1,$adrsl2,
    $adrsl3,$city,$district,$zipcode)
    {
        try {
            global $con;
            
            if($con->query("UPDATE cashier SET fname='".$fname."',lname='".$lname."',dob='".date("Y-m-d", strtotime($dob))."',email='".$email."',contactno='".$contact_no."',adrsl1='".$adrsl1."',adrsl2='".$adrsl2."',adrsl3='".$adrsl3."',city='".$city."',district='".$district."',zipcode='".$zipcode."' WHERE cashier_id='".$cashier_id."'") === TRUE ) {
                header('location:../pages/Front Officer/Cashiers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Cashiers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteCashier($cashier_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM cashier WHERE cashier_id='".$cashier_id."'") === TRUE) {
                header('location:../pages/Front Officer/Cashiers/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/Cashiers/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getCasPayment($cashier_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT p.pay_id,s.subjectname,p.type,p.amount,p.date FROM cashier ca, payment p, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.pay_cas_id='".$cashier_id."' UNION SELECT p.pay_id,s.subjectname,p.type,p.amount,p.date FROM cashier ca, payment p, subject s WHERE p.pay_cas_id=ca.cashier_id AND p.pay_sub_id=s.subject_id AND p.status='Paid' AND p.pay_cas_id='".$cashier_id."'");
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

    function getDirectorList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT d.dir_id,d.fname,d.lname,d.dob,d.email,d.contactno FROM director d");
            
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

    function updateDirector($director_id,$fname,$lname,$dob,$email,$contact_no)
    {
        try {
            global $con;
            
            if($con->query("UPDATE director SET fname='".$fname."',lname='".$lname."',dob='".date("Y-m-d", strtotime($dob))."',email='".$email."',contactno='".$contact_no."' WHERE dir_id='".$director_id."'") === TRUE ) {
                header('location:../pages/Front Officer/Directors/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Directors/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteDirector($director_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM director WHERE dir_id='".$director_id."'") === TRUE) {
                header('location:../pages/Front Officer/Directors/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/Directors/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getSubjectList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT s.subject_id,s.subjectname,s.medium,s.fee,s.type,s.description FROM subject s");
            
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

    function updateSubject($subject_id,$subjectname,$medium,$fee,$type,$description)
    {
        try {
            global $con;
            
            if($con->query("UPDATE subject SET subjectname='".$subjectname."',description='".$description."',fee='".$fee."',medium='".$medium."',type='".$type."' WHERE subject_id='".$subject_id."'") === TRUE ) {
                header('location:../pages/Front Officer/Subjects/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Updated Successfully!";
            } else {
                header('location:../pages/Front Officer/Subjects/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function deleteSubject($subject_id)
    {
        try {
            global $con;
            if($con->query("DELETE FROM subject WHERE subject_id='".$subject_id."'") === TRUE) {
                header('location:../pages/Front Officer/Subjects/Manage/List.php');
                $_SESSION['response']="success";
                $_SESSION['message']="Deleted Successfully!";
            } else {
                header('location:../pages/Front Officer/Subjects/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Database error occured!";
            }
            
            $con->close();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    function getEnrolledStudents($subject_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT st.student_id,CONCAT(st.fname, ' ' ,st.lname) AS 'studentname',s.subject_id,s.subjectname,sr.registrationdate,st.gcontactno  FROM student st, student_reg sr, subject s WHERE st.student_id=sr.st_reg_id AND sr.st_sub_id=s.subject_id AND sr.st_sub_id='".$subject_id."'");
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

    function getAssignedLecturers($subject_id)
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT l.lecturer_id,CONCAT(l.fname, ' ' ,l.lname) AS 'lecturername',s.subject_id,s.subjectname,lr.registrationdate,l.contactno FROM lecturer l, lecturer_reg lr, subject s WHERE l.lecturer_id=lr.lec_reg_id AND lr.lec_sub_id=s.subject_id AND lr.lec_sub_id='".$subject_id."'");
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

    function getOnlineClassList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT c.class_id,s.subjectname,oc.classurl,oc.description,c.date,c.duration,c.starttime FROM class c, online_class oc, subject s WHERE c.class_id=oc.ol_cls_id AND oc.ol_cls_id=cd.cls_dt_id AND c.sub_cls_id=s.subject_id");
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

    function getOfflineClassList()
    {
        try {
            global $con;
            $data = array();
            $result = $con->query("SELECT c.class_id,s.subjectname,of.hallno,c.date,c.duration,c.starttime FROM class c, offline_class of, subject s WHERE c.class_id=of.of_cls_id AND of.of_cls_id=cd.cls_dt_id AND c.sub_cls_id=s.subject_id");
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

    function getRegisteredStudentCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM student st WHERE st.usrname IS NOT NULL AND st.passwordhash IS NOT NULL");
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

    function getRegisteredLecturerCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM lecturer l WHERE l.usrname IS NOT NULL AND l.passwordhash IS NOT NULL");
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

    function getSubjectCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM subject");
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

    function getPendingStudentsCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM student st WHERE st.usrname IS NULL AND st.passwordhash IS NULL");
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

    function getPendingLecturersCount()
    {
        try {
            global $con;
            $result = $con->query("SELECT COUNT(*) AS 'count' FROM lecturer l WHERE l.usrname IS NULL AND l.passwordhash IS NULL");
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