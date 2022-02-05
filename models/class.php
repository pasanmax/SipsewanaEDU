<?php
if(isset($_SESSION['id']))
{
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/SipsewanaEDU/config.php";
    $conn = new Conn();
    $con = $conn->getConn();

    class Class_
    {
        // properties
        protected $date;
        protected $duration;
        protected $starttime;
        protected $endtime;

        //methods

        public function setClass($duration,$starttime)
        {
            $this->duration = $duration;
            $this->starttime = $starttime;
            $this->endtime = date("h:m:s", strtotime($starttime)+$duration*60*60);
        }

        public function getLastID()
        {
            try {
                global $con;
                $result = $con->query("SELECT class_id FROM class ORDER BY class_id DESC LIMIT 1");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['class_id'];
                    }
                    return $id;
                } else {
                    return null;
                }
                $con->close();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }
}
?>