<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    require_once 'student.php';
    $conn = new Conn();
    $con = $conn->getConn();

    class alStudent extends Student
    {
        // properties
        protected $idno;
        protected $email;
        protected $contactno;

        // methods
        function setAlStudent($idno,$email,$contactno)
        {
            $this->idno = $idno;
            $this->email = $email;
            $this->contactno = $contactno;
        }

        function register($subjectname)
        {
            try {
                global $con;
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $fee = $subject->getFee($subjectname)+1000;
                $subject_id = $subject->getId($subjectname);
                $fname = $this->fname;
                $lname = $this->lname;
                $dob = $this->dob;
                $school = $this->school;
                $adrsl1 = $this->adrsl1;
                $adrsl2 = $this->adrsl2;
                $adrsl3 = $this->adrsl3;
                $city = $this->city;
                $district = $this->district;
                $zipcode = $this->zipcode;
                $gfname = $this->gfname;
                $glname = $this->glname;
                $gemail = $this->gemail;
                $gcontactno = $this->gcontactNo;
                $gcontactno = str_replace('(','',$gcontactno);
                $gcontactno = str_replace(')','',$gcontactno);
                $gcontactno = str_replace(' ','',$gcontactno);
                $gcontactno = str_replace('-','',$gcontactno);
                $relationship = $this->relationship;
                $submissiondate = $this->submissiondate;
                $idno = $this->idno;
                $email = $this->email;
                $contactno = $this->contactno;
                $contactno = str_replace('(','',$contactno);
                $contactno = str_replace(')','',$contactno);
                $contactno = str_replace(' ','',$contactno);
                $contactno = str_replace('-','',$contactno);

                if($con->query("INSERT INTO student(fname,lname,usrname,passwordhash,dob,school,adrsl1,adrsl2,adrsl3,city,district,zipcode,gfname,glname,gemail,gcontactno,relationship,frt_st_id,submissiondate) VALUES ('".$fname."','".$lname."',NULL,NULL,'".$dob."','".$school."','".$adrsl1."','".$adrsl2."','".$adrsl3."','".$city."','".$district."','".$zipcode."','".$gfname."','".$glname."','".$gemail."','".$gcontactno."','".$relationship."',NULL,'".$submissiondate."')") === true) {
                    $student_id = $this->getLastId();
                    if($con->query("INSERT INTO al_student(ALstudent_id,idno,email,contactno) VALUES ('".$student_id."','".$idno."','".$email."','".$contactno."')") === true) {
                        if($con->query("INSERT INTO student_reg(st_reg_id,st_sub_id,registrationdate,regfee) VALUES ('".$student_id."','".$subject_id."','".$submissiondate."','".$fee."')") === true) {
                            header('location:../pages/Student/alRegister.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Registered successfully!";
                        } else {
                            header('location:../pages/Student/alRegister.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error!";
                            //echo "Error: ".$con->error;
                        }
                    } else {
                        header('location:../pages/Student/alRegister.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error!";
                        //echo "Error: ".$con->error;
                    }
                } else {
                    header('location:../pages/Student/alRegister.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error!";
                    //echo "Error: ".$con->error;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    $alStudent = new alStudent();

    if(isset($_POST['regAlStudent']))
    {
        if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['dob']) || empty($_POST['nicno']) || empty($_POST['email']) || empty($_POST['cno']) || empty($_POST['school'])
        || empty($_POST['adrsl1']) || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])
        || empty($_POST['gfname']) || empty($_POST['glname']) || empty($_POST['gemail']) || empty($_POST['gcno']) || empty($_POST['relationship'])
        || empty($_POST['subject'])) {
            header('location:../pages/Student/olRegister.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            $alStudent->setAlStudent($_POST['nicno'],$_POST['email'],$_POST['cno']);
            $alStudent->setStudent($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['school'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],
            $_POST['city'],$_POST['district'],$_POST['zipcode'],$_POST['gfname'],$_POST['glname'],$_POST['gemail'],$_POST['gcno'],$_POST['relationship']);
            $alStudent->register($_POST['subject']);
        }
    }
}
?>