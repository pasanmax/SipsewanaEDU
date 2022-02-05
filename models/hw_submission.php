<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
//$root = realpath($_SERVER["DOCUMENT_ROOT"]);
// include_once "../config.php";
//include_once "$root/SipsewanaEDU/config.php";

//include_once "$root/SipsewanaEDU/models/homework.php";
//include_once "$root/SipsewanaEDU/models/hm_submit.php";

if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    require_once 'homework.php';
    $conn = new Conn();
    $con = $conn->getConn();

    class HwSubmission extends Homework {
        protected $submitdate;
        protected $fileName;
        protected $path = '../hw_submissions/';
    
        public function setSubmitDate() {
            $this->submitdate = date('Y-m-d');
        }
    
        public function setSubmitFile($hsFile) {
            $this-> fileName = $hsFile;
        }
    
        public function submitHomework($id,$homework_id,$student_id) {
            try {
                global $con;
                $verify = $this->verify($id,$homework_id,$student_id);
                if($verify['status'] === true) {
                    if($con->query("UPDATE hw_submission SET submitdate='".$this->submitdate."',fileName='".$this->fileName."',path='".$this->path."' WHERE id='".$id."' AND sub_hw_id='".$homework_id."' AND sub_st_id='".$student_id."'")) {
                        header('location:../pages/Student/Homeworks/Manage/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Uploaded Successfully";
                        return [
                            'status' => true
                        ];
                    } else {
                        header('location:../pages/Student/Homeworks/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                    }
                } else {
                    header('location:../pages/Student/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Homework does not match";
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function verify($id,$homework_id,$student_id) {
            try {
                // include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                // $subject = new Subject();
                // $subject_id = $subject->getId($subjectname);
                global $con;
                $result = $con->query("SELECT id,sub_hw_id,sub_st_id FROM hw_submission WHERE id='".$id."' AND sub_hw_id='".$homework_id."' AND sub_st_id='".$student_id."'");
                if ($result->num_rows > 0) {
                    return [
                        'status' => true
                    ];
                } else {
                    return false;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function getSubmitFiles($sub_hw_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT hs.fileName FROM hw_submission hs WHERE hs.sub_hw_id='".$sub_hw_id."' AND hs.submitdate IS NOT NULL AND hs.path IS NOT NULL");
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
    }

    if (isset($_POST['hwSubmit'])) {
        if($_POST['hs_id'] === null && $_POST['id'] === null && $_POST['name'] === null && $_POST['subject'] === null && $_POST['createdate'] === null 
        && $_POST['deadlinedate'] === null && $_POST['file'] === null && $_FILES['file'] === null) {
            header('location:../pages/Student/Homeworks/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter the details before submit";
        } else {
            // header('location:../pages/Student/Homeworks/Manage/List.php');
            // $_SESSION['response']="success";
            // $_SESSION['message']="OK";
            
            
            // $hw_submission->setSubmitDate();
            // $hw_submission->setSubmitFile($_FILES['file']);
            // $hw_submission->submitHomework();

            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_ext = end(explode('.',$_FILES['file']['name']));
            $extension = array("PDF");

            if ((in_array($file_ext,$extension))) {
                header('location:../pages/Student/Homeworks/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Only PDF files are allowed";
            } else {
                if ($file_size > 5000000) {
                    header('location:../pages/Student/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="File is exceeding 5MB";
                } else {
                    // header('location:../pages/Student/Homeworks/Manage/List.php');
                    // $_SESSION['response']="success";
                    // $_SESSION['message']="Uploaded Successfully";

                    

                    $hw_submission = new HwSubmission();
                    $hw_submission->setSubmitDate();
                    // realpath($_SERVER["DOCUMENT_ROOT"])."/SipsewanaEDU/hw_submissions/
                    $hw_submission->setSubmitFile($file_name);
                    $success = $hw_submission->submitHomework($_POST['hs_id'],$_POST['id'],$_SESSION['id']);
                    if($success['status'] === true) {
                        move_uploaded_file($file_tmp,"../hw_submissions/".$file_name);
                    }
                }
            }
        }
    }

} else {
    header('location:../pages/Student/Homeworks/Manage/List.php');
}

?>