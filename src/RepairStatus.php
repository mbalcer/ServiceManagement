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
}