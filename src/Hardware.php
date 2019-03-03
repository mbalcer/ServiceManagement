<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 28.02.19
 * Time: 17:50
 */

require_once "RepairStatus.php";

class Hardware extends DatabaseConnector
{
    public function addHardware($clientID, $description) {
        $addHardware = $this->dbConnect()->exec("INSERT INTO HARDWARE(clientID, description, status) VALUES($clientID, '$description', 'Adopted')");
        if($addHardware)
            return "Added new hardware";
        else
            return "I can't add new hardware";
    }

    public function getHardwareTable() {
        $query = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                  INNER JOIN USERS ON USERS.ID=HARDWARE.clientID";

        $stmt = $this->dbConnect()->query($query);
        $table='';

        foreach ($stmt as $row) {
            $classStatus = RepairStatus::checkStatus($row['status']);
            $table .= '<tr><td>'.$row['hardwareID'].'</td><td>'.$row['clientName'].'</td><td>'.$row['phone'].'</td>
                        <td>'.$row['email'].'</td><td>'.$row['description'].'</td><td class="'.$classStatus.'">'.$row['status'].'</td>
                        <td>'.$row['price']. '</td><td>
                        <form action="update.php" method="POST">
                            <button type="submit" name="id" value="' .$row['hardwareID'].'" class="btn-table btn-edit icon-pencil"></button>
                        </form>
                        <form action="removeRow.php" method="POST">
                            <button type="submit" name="id" value="'.$row['hardwareID'].'" class="btn-table btn-delete icon-trash-empty"></button>
                        </form></td></tr>';
        }

        return $table;
    }

    public function getHardware($id) {
        $query = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                  INNER JOIN USERS ON USERS.ID=HARDWARE.clientID 
                  WHERE HARDWARE.ID=$id";

        $stmt = $this->dbConnect()->query($query);
        if($stmt->rowCount()>0) {
            $row = $stmt->fetch();

            return $row;
        } else {
            return "Error";
        }
    }

    public function updateHardware($whatToSet, $forWhat, $ID) {
        $result="";

        if($whatToSet=='price') {
            $stmt = $this->dbConnect()->prepare("UPDATE HARDWARE SET price=? WHERE ID=?");
            $result = $stmt->execute([$forWhat, $ID]);
        } else if($whatToSet=='status') {
            $stmt = $this->dbConnect()->prepare("UPDATE HARDWARE SET status=? WHERE ID=?");
            $result = $stmt->execute([$forWhat, $ID]);
        }

        if($result)
            return "Correctly update";
        else
            return "Error";
    }

    public function removeHardware($idHardware)
    {
        $stmt = $this->dbConnect()->prepare("DELETE FROM HARDWARE WHERE ID=?");
        $result = $stmt->execute([$idHardware]);
        if ($result)
            return "Correctly deleted";
        else
            return "Error during deletion";
    }
}