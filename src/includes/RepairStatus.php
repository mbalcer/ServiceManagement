<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 03.03.19
 * Time: 20:15
 */

class RepairStatus extends DatabaseConnector
{
    private const statusArr = array("Adopted", "During repair", "Repaired", "Not repaired", "Received");

    public function getStatusArr() {
        return self::statusArr;
    }

    public function addStatusHistory($hardwareID, $prevStatus, $nextStatus, $comments) {
        $date = date("Y-m-d H:i:s");
        $add = $addHardware = $this->dbConnect()->exec("INSERT INTO STATUSHISTORY(hardwareID, prevStatus, nextStatus, date, comments) VALUES($hardwareID, '$prevStatus', '$nextStatus', '$date', '$comments')");
        if($add)
            return "Added change status";
        else
            return "Error";
    }

    public function getStatusHistory($hardwareID) {
        $query = "SELECT * FROM STATUSHISTORY WHERE hardwareID=$hardwareID";

        $stmt = $this->dbConnect()->query($query);
        if($stmt->rowCount()>0)
            return $stmt->fetchAll();
        else
            return "No status change information";
    }

    public function checkStatus($status) {
        switch ($status) {
            case 'Adopted':
            case 'Not repaired':
                return 'status-red'; break;

            case 'During repair':
                return 'status-yellow'; break;

            case 'Repaired':
            case 'Received':
                return 'status-green'; break;
        }
    }
}