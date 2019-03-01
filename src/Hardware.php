<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 28.02.19
 * Time: 17:50
 */

class Hardware extends DatabaseConnector
{
    public function addHardware($clientID, $description) {
        $addHardware = $this->dbConnect()->exec("INSERT INTO HARDWARE(clientID, description, status) VALUES($clientID, '$description', 'Adopted')");
        if($addHardware)
            return "Added new hardware";
        else
            return "I can't add new hardware";
    }

    public function getHardware() {
        $query = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                  INNER JOIN USERS ON USERS.ID=HARDWARE.clientID";

        $stmt = $this->dbConnect()->query($query);
        $table='';

        foreach ($stmt as $row) {
            $classStatus = $this->checkStatus($row['status']);
            $table .= '<tr><td>'.$row['hardwareID'].'</td><td>'.$row['clientName'].'</td><td>'.$row['phone'].'</td>
                        <td>'.$row['email'].'</td><td>'.$row['description'].'</td><td class="'.$classStatus.'">'.$row['status'].'</td>
                        <td>'.$row['price'].'</td><td>
                        <form action="updateRow.php" method="POST">
                            <button type="submit" name="id" value="'.$row['hardwareID'].'" class="btn-table btn-edit icon-pencil"></button>
                        </form>
                        <form action="removeRow.php" method="POST">
                            <button type="submit" name="id" value="'.$row['hardwareID'].'" class="btn-table btn-delete icon-trash-empty"></button>
                        </form></td></tr>';
        }

        return $table;
    }

    public function removeHardware($idHardware) {
        $stmt = $this->dbConnect()->prepare("DELETE FROM HARDWARE WHERE ID=?");
        $result = $stmt->execute([$idHardware]);
        if ($result)
            return "Correctly deleted";
        else
            return "Error during deletion";
    }

    private function checkStatus($status) {
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