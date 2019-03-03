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

    public function addChangeStatus($hardwareID, $prevStatus, $nextStatus, $comments) {
        $data = date("Y-m-d H:i:s");
        $add = $addHardware = $this->dbConnect()->exec("INSERT INTO CHANGESTATUS(hardwareID, prevStatus, nextStatus, data, comments) VALUES($hardwareID, '$prevStatus', '$nextStatus', '$data', '$comments')");
        if($add)
            return "Added change status";
        else
            return "Error";
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