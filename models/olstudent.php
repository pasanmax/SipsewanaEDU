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


    class olStudent extends Student
    {
        // properties
        private $ttresults;

        // methods
        function setResults($ttresults)
        {
            $this->ttresults = $ttresults;
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
                //$submissiondate = $this->submissiondate;
                $ttresults = $this->ttresults;

                if($con->query("INSERT INTO student(fname,lname,usrname,passwordhash,dob,school,adrsl1,adrsl2,adrsl3,city,district,zipcode,gfname,glname,gemail,gcontactno,relationship) VALUES ('".$fname."','".$lname."',NULL,NULL,'".$dob."','".$school."','".$adrsl1."','".$adrsl2."','".$adrsl3."','".$city."','".$district."','".$zipcode."','".$gfname."','".$glname."','".$gemail."','".$gcontactno."','".$relationship."')") === true) {
                    $student_id = $this->getLastId();
                    if($con->query("INSERT INTO ol_student(OLstudent_id,ttresults) VALUES ('".$student_id."','".$ttresults."')") === true) {
                        if($con->query("INSERT INTO student_reg(st_reg_id,st_sub_id,registrationdate,regfee) VALUES ('".$student_id."','".$subject_id."','".$submissiondate."','".$fee."')") === true) {
                            header('location:../pages/Student/olRegister.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Registered successfully!";
                        } else {
                            header('location:../pages/Student/olRegister.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error!";
                            //echo "Error: ".$con->error;
                        }
                    } else {
                        header('location:../pages/Student/olRegister.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error!";
                        //echo "Error: ".$con->error;
                    }
                } else {
                    header('location:../pages/Student/olRegister.php');
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

    $olStudent = new olStudent();

    if(isset($_POST['regOlStudent']))
    {
        if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['dob']) || empty($_POST['school']) || empty($_POST['ttresults'])
        || empty($_POST['adrsl1']) || empty($_POST['adrsl2']) || empty($_POST['city']) || empty($_POST['district']) || empty($_POST['zipcode'])
        || empty($_POST['gfname']) || empty($_POST['glname']) || empty($_POST['gemail']) || empty($_POST['gcno']) || empty($_POST['relationship'])
        || empty($_POST['subject'])) {
            header('location:../pages/Student/olRegister.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please fill the relevant details!";
        } else {
            $olStudent->setResults($_POST['ttresults']);
            $olStudent->setStudent($_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['school'],$_POST['adrsl1'],$_POST['adrsl2'],$_POST['adrsl3'],
            $_POST['city'],$_POST['district'],$_POST['zipcode'],$_POST['gfname'],$_POST['glname'],$_POST['gemail'],$_POST['gcno'],$_POST['relationship']);
            $olStudent->register($_POST['subject']);
        }
    }
}
?>