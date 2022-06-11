<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    require_once "homework.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class Hw_creation extends Homework
    {
        private $cre_lec_id;
        private $createddate;
        private $deadlinedate;

        function setLecturerId($lecturer_id)
        {
            $this->cre_lec_id = $lecturer_id;

        }

        function setLecHwSession()
        {
            header('location:../pages/Front Officer/Lecturers/Homework/List.php');
            $_SESSION['lechwid']=$this->cre_lec_id;
        }

        function setcreatedDate()
        {
            $this->createddate = date("Y-m-d");

        }

        function setdeadlineDate($deadlinedate)
        {
            $this->deadlinedate = date("Y-m-d", strtotime($deadlinedate));

        }

        function getStudentList($homework_id)
        {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT sr.st_reg_id FROM homework h, student_reg sr WHERE h.hw_sub_id=sr.st_sub_id AND h.hw_id='".$homework_id."'");
                
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

        function createHomework($lecturer_id,$homeworkName,$type,$description,$fileName,$subject_id) {
            try {
                parent::setHomework($homeworkName,$type,$description,$fileName,$subject_id);
                // $this->setdeadlineDate($deadlinedate);
                // $this->setcreatedDate();
                global $con;
                $homeworkName = $this->name;
                $type = $this->type;
                $description = $this->description;
                $fileName = $this->fileName;
                $path = $this->path;
                $createddate = date("Y-m-d", strtotime($this->createddate));
                $deadlinedate = date("Y-m-d", strtotime($this->deadlinedate));
                // $createddate = $this->createddate;
                // $deadlinedate = $this->deadlinedate;
                $status = null;
                
                if($con->query("INSERT INTO homework (name,type,description,fileName,path,hw_sub_id) VALUES ('$homeworkName','$type','$description','$fileName','$path',$subject_id)") === TRUE) {
                    if(parent::getLastID() !== null) {
                        $hw_id = parent::getLastID();
                        if($con->query("INSERT INTO hw_creation (cre_hw_id,cre_lec_id,createddate,deadlinedate) VALUES ($hw_id,$lecturer_id,'".$createddate."','".$deadlinedate."')") === TRUE) {
                            $student_list = $this->getStudentList($hw_id);
                            foreach($student_list as $student) {
                                if($con->query("INSERT INTO hw_submission (sub_hw_id,sub_st_id,submitdate,fileName,path) VALUES ($hw_id,'".$student['st_reg_id']."',NULL,NULL,NULL)") === TRUE) {
                                    $status = true;
                                } else {
                                    $status = false;
                                }
                            }
                            //return $status;
                            // if($status === true) {
                            //     header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            //     $_SESSION['response']="success";
                            //     $_SESSION['message']="Created Successfully!";
                            // } else {
                            //     header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            //     $_SESSION['response']="danger";
                            //     $_SESSION['message']="Database error occured!";
                            //     //echo "Error: ".$con->error;
                            // }
                        } else {
                            // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            // $_SESSION['response']="danger";
                            // $_SESSION['message']="Database error occured!";
                            echo "Error: ".$con->error;
                        }
                    } else {
                        $status = false;
                        // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        // $_SESSION['response']="danger";
                        // $_SESSION['message']="ID not found!";
                    }

                    return $status;
                } else {
                    // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    // $_SESSION['response']="danger";
                    // $_SESSION['message']="Database error occured!";
                    echo "Error: ".$con->error;
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function updateHomework($lecturer_id,$homeworkName,$type,$description,$fileName,$subject_id,$homework_id) {
            try {
                parent::setHomework($homeworkName,$type,$description,$fileName,$subject_id);
                // $this->setdeadlineDate($deadlinedate);
                // $this->setcreatedDate();
                global $con;
                $homeworkName = $this->name;
                $type = $this->type;
                $description = $this->description;
                $fileName = $this->fileName;
                $path = $this->path;
                //$createddate = date("Y-m-d", strtotime($this->createddate));
                $deadlinedate = date("Y-m-d", strtotime($this->deadlinedate));
                // $createddate = $this->createddate;
                // $deadlinedate = $this->deadlinedate;
                $pfileName = $this->getFileName($homework_id);
                $status = null;

                if(unlink('../hw_creations/'.$pfileName)) {
                    if($con->query("UPDATE homework SET name='".$homeworkName."',type='".$type."',description='".$description."',fileName='".$fileName."',path='".$path."',hw_sub_id='".$subject_id."' WHERE hw_id='".$homework_id."'") === TRUE) {
                    
                        if($con->query("UPDATE hw_creation SET deadlinedate='".$deadlinedate."' WHERE cre_hw_id='".$homework_id."' AND cre_lec_id='".$lecturer_id."'") === TRUE) {
                            $status = true;
                            // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            // $_SESSION['response']="success";
                            // $_SESSION['message']="Updated Successfully!";
                        } else {
                            $status = false;
                            // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            // $_SESSION['response']="danger";
                            // $_SESSION['message']="Database error occured!";
                            //echo "Error: ".$con->error;
                        }
                    } else {
                        $status = false;
                        // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        // $_SESSION['response']="danger";
                        // $_SESSION['message']="Database error occured!";
                        //echo "Error: ".$con->error;
                    }
                } else {
                    $status = false;
                }
                
                return $status;
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function updateHomeworkwithoutFile($lecturer_id,$homeworkName,$type,$description,$subject_id,$homework_id) {
            try {
                parent::setHomework($homeworkName,$type,$description,null,$subject_id);
                // $this->setdeadlineDate($deadlinedate);
                // $this->setcreatedDate();
                global $con;
                $homeworkName = $this->name;
                $type = $this->type;
                $description = $this->description;
                //$fileName = $this->fileName;
                $path = $this->path;
                //$createddate = date("Y-m-d", strtotime($this->createddate));
                $deadlinedate = date("Y-m-d", strtotime($this->deadlinedate));
                // $createddate = $this->createddate;
                // $deadlinedate = $this->deadlinedate;
                
                if($con->query("UPDATE homework SET name='".$homeworkName."',type='".$type."',description='".$description."',path='".$path."',hw_sub_id='".$subject_id."' WHERE hw_id='".$homework_id."'") === TRUE) {
                    
                    if($con->query("UPDATE hw_creation SET deadlinedate='".$deadlinedate."' WHERE cre_hw_id='".$homework_id."' AND cre_lec_id='".$lecturer_id."'") === TRUE) {
                        header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Updated Successfully!";
                    } else {
                        header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                        //echo "Error: ".$con->error;
                    }
                } else {
                    header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    //echo "Error: ".$con->error;
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function deleteHomework($homework_id)
        {
            try {
                global $con;
                $fileName = $this->getFileName($homework_id);
                if(unlink('../hw_creations/'.$fileName)) {
                    include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/hw_submission.php";
                    $hw_submission = new HwSubmission();
                    $submissionList = $hw_submission->getSubmitFiles($homework_id);
                    if ($submissionList === null) {
                        if($con->query("DELETE FROM homework WHERE hw_id='".$homework_id."'") === TRUE) {
                        
                            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Deleted Successfully!";
                        } else {
                            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error occured!";
                            //echo "Error: ".$con->error;
                        }
                    } else {
                        $status = null;
                        foreach($submissionList as $submissionFile) {
                            if(unlink('../hw_submissions/'.$submissionFile['fileName'])) {
                                $status = true;
                            } else {
                                $status = false;
                            }
                        }
                        if($status === true) {
                            if($con->query("DELETE FROM homework WHERE hw_id='".$homework_id."'") === TRUE) {
                            
                                header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                                $_SESSION['response']="success";
                                $_SESSION['message']="Deleted Successfully!";
                            } else {
                                header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                                $_SESSION['response']="danger";
                                $_SESSION['message']="Database error occured!";
                                //echo "Error: ".$con->error;
                            }
                        }
                    }
                    
                } else {
                    header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="No File found!";
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    if(isset($_POST['addhomework'])) {

        if(empty($_POST['subname']) || empty($_POST['name']) || empty($_POST['type']) || empty($_POST['description']) || empty($_FILES['homeworkfile'])
        || empty($_POST['deadlinedate']))
        {
            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter the details before submit";

        } else {
            $file_name = $_FILES['homeworkfile']['name'];
            $file_size = $_FILES['homeworkfile']['size'];
            $file_tmp = $_FILES['homeworkfile']['tmp_name'];
            $file_type = $_FILES['homeworkfile']['type'];
            $file_ext = end(explode('.',$_FILES['homeworkfile']['name']));
            $extension = array("PDF");

            if ((in_array($file_ext,$extension))) {
                header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Only PDF files are allowed";
            } else {
                if ($file_size > 5000000) {
                    header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="File is exceeding 5MB";
                } else {
                    include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                    $subject = new Subject();
                    $subject_id = $subject->getId($_POST['subname']);
                    $hw_creation = new Hw_creation();
                    $hw_creation->setdeadlineDate($_POST['deadlinedate']);
                    $hw_creation->setcreatedDate();
                    if($hw_creation->createHomework($_SESSION['id'],$_POST['name'],$_POST['type'],$_POST['description'],$file_name,$subject_id) === true) {
                        move_uploaded_file($file_tmp,"../hw_creations/".$file_name);
                        header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Created Successfully!";
                        //echo "Error: ".$con->error;
                    } else {
                        header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                        // echo "Error: ".$con->error;
                    }
                }
            }
        }
    }

    if(isset($_POST['updateHomework'])) {

        if(empty($_POST['usubname']) || empty($_POST['uname']) || empty($_POST['utype']) || empty($_POST['udescription']) || empty($_POST['udeadlinedate'])
        || empty($_POST['uhomeworkid']))
        {
            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter the details before submit";

        } else {
            if ($_FILES['uhomeworkfile']['size'] == 0) {
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $subject_id = $subject->getId($_POST['usubname']);
                $hw_creation = new Hw_creation();
                $hw_creation->setdeadlineDate($_POST['udeadlinedate']);
                //$hw_creation->setcreatedDate();
                $hw_creation->updateHomeworkwithoutFile($_SESSION['id'],$_POST['uname'],$_POST['utype'],$_POST['udescription'],$subject_id,$_POST['uhomeworkid']);
            } else {
                $file_name = $_FILES['uhomeworkfile']['name'];
                $file_size = $_FILES['uhomeworkfile']['size'];
                $file_tmp = $_FILES['uhomeworkfile']['tmp_name'];
                $file_type = $_FILES['uhomeworkfile']['type'];
                $file_ext = end(explode('.',$_FILES['uhomeworkfile']['name']));
                $extension = array("PDF");

                if ((in_array($file_ext,$extension))) {
                    header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Only PDF files are allowed";
                } else {
                    if ($file_size > 5000000) {
                        header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="File is exceeding 5MB";
                    } else {
                        include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                        $subject = new Subject();
                        $subject_id = $subject->getId($_POST['usubname']);
                        $hw_creation = new Hw_creation();
                        $hw_creation->setdeadlineDate($_POST['udeadlinedate']);
                        //$hw_creation->setcreatedDate();
                        if($hw_creation->updateHomework($_SESSION['id'],$_POST['uname'],$_POST['utype'],$_POST['udescription'],$file_name,$subject_id,$_POST['uhomeworkid']) === true) {
                            move_uploaded_file($file_tmp,"../hw_creations/".$file_name);
                            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Updated Successfully!";
                        } else {
                            header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error occured!";
                            // echo "Error: ".$con->error;
                        }
                    }
                }
            }
            
        }
    }

    if(isset($_GET['delHomework']))
    {
        $hw_creation = new Hw_creation();
        $hw_creation->deleteHomework($_GET['delHomework']);
    }

    if (isset($_POST['lechwSearch'])) {
        if (empty($_POST['lecturerid'])) {
            header('location:../pages/Front Officer/Lecturers/Homework/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Invalid lecturer ID!";
        } else {
            $hw_creation = new Hw_creation();
            $hw_creation->setLecturerId($_POST['lecturerid']);
            $hw_creation->setLecHwSession();
        }
    }


}
else
{
    header('location:../pages/Student/Login.php');
}
?>