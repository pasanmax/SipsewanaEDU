<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/SipsewanaEDU/config.php";
$conn = new Conn();
$con = $conn->getConn();

if(isset($_SESSION['id']))
{
    class Learning_Module {
        private $name;
        private $type;
        private $fileName;
        private $path = '../learning_modules/';
        private $description;
        private $date;
    
        public function setname($name)
        {
            $this->name = $name;
        }
        
        public function settype($type)
        {
            $this->type = $type;
        }
    
        public function setfileName($fileName)
        {
            $this->fileName = $fileName;
        }
    
        public function setdescription($description)
        {
            $this->description = $description;
        }
    
        public function setdate()
        {
            $this->date = date("Y-m-d");
        }
    
    
        public function getFiles($student_id) {
            try {
                global $con;
                $data = array();
                $result = $con->query("SELECT lm.lm_id,lm.name,s.subjectname,lm.date,lm.fileName,lm.path FROM student_reg sr, subject s, learning_module lm WHERE sr.st_sub_id = s.subject_id AND s.subject_id = lm.lm_sub_id AND sr.st_reg_id = '".$student_id."'");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
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

        function getFileName($lmid) {
            try {
                global $con;
                $result = $con->query("SELECT lm.fileName FROM learning_module lm WHERE lm.lm_id='".$lmid."'");
                if ($result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        $fileName = $row['fileName'];
                    }
                    return $fileName;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function addLearningModule($lecturer_id,$subject_id) {
            try {
                global $con;
                $lmName = $this->name;
                $type = $this->type;
                $description = $this->description;
                $fileName = $this->fileName;
                $path = $this->path;
                $date = $this->date;
                $status = null;
                
                if($con->query("INSERT INTO learning_module (name,type,fileName,path,description,date,lm_lec_id,lm_sub_id) VALUES ('$lmName','$type','$fileName','$path','$description','".$date."','$lecturer_id','$subject_id')") === TRUE) {
                    $status = true;
                    // echo "Error: ".$con->error;
                } else {
                    $status = false;
                    // header('location:../pages/Lecturer/Homeworks/Manage/List.php');
                    // $_SESSION['response']="danger";
                    // $_SESSION['message']="Database error occured!";
                    // echo "Error: ".$con->error;
                }
                return $status;
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        function updateLearningModule($lecturer_id,$subject_id,$lmid) {
            try {
                global $con;
                $lmName = $this->name;
                $type = $this->type;
                $description = $this->description;
                $fileName = $this->fileName;
                $path = $this->path;
                $status = null;
                $pfileName = $this->getFileName($lmid);

                if(unlink('../learning_modules/'.$pfileName)) {
                    if($con->query("UPDATE learning_module SET name='".$lmName."',type='".$type."',fileName='".$fileName."',path='".$path."',description='".$description."' WHERE lm_lec_id='".$lecturer_id."' AND lm_sub_id='".$subject_id."' AND lm_id='".$lmid."'") === TRUE) {
                        $status = true;
                        //echo "Error: ".$con->error;
                    } else {
                        $status = false;
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

        function updateLearningModulewithoutFile($lecturer_id,$subject_id,$lmid) {
            try {
                global $con;
                $lmName = $this->name;
                $type = $this->type;
                $description = $this->description;
                $path = $this->path;
                $status = null;
                
                if($con->query("UPDATE learning_module SET name='".$lmName."',type='".$type."',path='".$path."',description='".$description."' WHERE lm_lec_id='".$lecturer_id."' AND lm_sub_id='".$subject_id."' AND lm_id='".$lmid."'") === TRUE) {
                    $status = true;
                    //echo "Error: ".$con->error;
                } else {
                    $status = false;
                    //echo "Error: ".$con->error;
                }
                return $status;
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

        public function deleteLearningModule($lmid)
        {
            try {
                global $con;
                $fileName = $this->getFileName($lmid);
                if(unlink('../learning_modules/'.$fileName)) {
                    if($con->query("DELETE FROM learning_module WHERE lm_id='".$lmid."'") === TRUE) {
                        header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Deleted Successfully!";
                    } else {
                        header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                        //echo "Error: ".$con->error;
                    }
                    
                } else {
                    header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="No file found!";
                }
                
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    if(isset($_POST['addlearningmodule'])) {

        if(empty($_POST['subname']) || empty($_POST['lmname']) || empty($_POST['type']) || empty($_POST['description']) || empty($_FILES['lmfile']))
        {
            header('location:../pages/Lecturer/LearningModule/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter the details before submit";

        } else {
            $file_name = $_FILES['lmfile']['name'];
            $file_size = $_FILES['lmfile']['size'];
            $file_tmp = $_FILES['lmfile']['tmp_name'];
            $file_type = $_FILES['lmfile']['type'];
            $file_ext = end(explode('.',$_FILES['lmfile']['name']));
            $extension = array("PDF");

            if ((in_array($file_ext,$extension))) {
                header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                $_SESSION['response']="danger";
                $_SESSION['message']="Only PDF files are allowed";
            } else {
                if ($file_size > 5000000) {
                    header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="File is exceeding 5MB";
                } else {
                    include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                    $subject = new Subject();
                    $subject_id = $subject->getId($_POST['subname']);
                    $learning_module = new Learning_Module();
                    $learning_module->setname($_POST['lmname']);
                    $learning_module->settype($_POST['type']);
                    $learning_module->setdescription($_POST['description']);
                    $learning_module->setfileName($file_name);
                    $learning_module->setdate();
                    if($learning_module->addLearningModule($_SESSION['id'],$subject_id) === true) {
                        move_uploaded_file($file_tmp,"../learning_modules/".$file_name);
                        header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                        $_SESSION['response']="success";
                        $_SESSION['message']="Created Successfully!";
                        //echo "Error: ".$con->error;
                    } else {
                        header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="Database error occured!";
                        // echo "Error: ".$con->error;
                    }
                }
            }
        }
    }

    if(isset($_POST['updateLearningModule'])) {

        if(empty($_POST['ulmid']) || empty($_POST['usubname']) || empty($_POST['ulmname']) || empty($_POST['utype']) || empty($_POST['udescription']) || empty($_POST['ulmfile']))
        {
            header('location:../pages/Lecturer/LearningModule/Manage/List.php');
            $_SESSION['response']="danger";
            $_SESSION['message']="Please enter the details before submit";

        } else {
            if ($_FILES['ulmfile']['size'] == 0) {
                include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                $subject = new Subject();
                $subject_id = $subject->getId($_POST['usubname']);
                $learning_module = new Learning_Module();
                $learning_module->setname($_POST['ulmname']);
                $learning_module->settype($_POST['utype']);
                $learning_module->setdescription($_POST['udescription']);
                if($learning_module->updateLearningModulewithoutFile($_SESSION['id'],$subject_id,$_POST['ulmid']) === true) {
                    header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                    $_SESSION['response']="success";
                    $_SESSION['message']="Updated Successfully!";
                    //echo "Error: ".$con->error;
                } else {
                    header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Database error occured!";
                    // echo "Error: ".$con->error;
                }
            } else {
                $file_name = $_FILES['ulmfile']['name'];
                $file_size = $_FILES['ulmfile']['size'];
                $file_tmp = $_FILES['ulmfile']['tmp_name'];
                $file_type = $_FILES['ulmfile']['type'];
                $file_ext = end(explode('.',$_FILES['ulmfile']['name']));
                $extension = array("PDF");

                if ((in_array($file_ext,$extension))) {
                    header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                    $_SESSION['response']="danger";
                    $_SESSION['message']="Only PDF files are allowed";
                } else {
                    if ($file_size > 5000000) {
                        header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                        $_SESSION['response']="danger";
                        $_SESSION['message']="File is exceeding 5MB";
                    } else {
                        include "$_SERVER[DOCUMENT_ROOT]/SipsewanaEDU/models/subject.php";
                        $subject = new Subject();
                        $subject_id = $subject->getId($_POST['usubname']);
                        $learning_module = new Learning_Module();
                        $learning_module->setname($_POST['ulmname']);
                        $learning_module->settype($_POST['utype']);
                        $learning_module->setdescription($_POST['udescription']);
                        $learning_module->setfileName($file_name);
                        if($learning_module->updateLearningModule($_SESSION['id'],$subject_id,$_POST['ulmid']) === true) {
                            move_uploaded_file($file_tmp,"../learning_modules/".$file_name);
                            header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                            $_SESSION['response']="success";
                            $_SESSION['message']="Updated Successfully!";
                            //echo "Error: ".$con->error;
                        } else {
                            header('location:../pages/Lecturer/LearningModule/Manage/List.php');
                            $_SESSION['response']="danger";
                            $_SESSION['message']="Database error occured!";
                            // echo "Error: ".$con->error;
                        }
                    }
                }
            }
            
        }
    }

    if(isset($_GET['dellearningModule']))
    {
        $learning_module = new Learning_Module();
        $learning_module->deleteLearningModule($_GET['dellearningModule']);
    }

} else {
    header('location:../pages/Student/Homeworks/Manage/List.php');
}
?>