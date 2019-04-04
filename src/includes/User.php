<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 27.02.19
 * Time: 19:37
 */


class User extends DatabaseConnector
{
    public function addNewUser($clientName, $email, $password, $phone) {
        $query = "SELECT email FROM USERS WHERE email='$email'";
        $isUser = $this->dbConnect()->query($query);
        if($isUser->rowCount()==0) {
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $addUser = $this->dbConnect()->exec("INSERT INTO USERS(clientName, email, password, phone, role) VALUES ('$clientName', '$email', '$passHash', '$phone', 'client')");
            if($addUser)
                return "Added new user";
            else
                return "I can't add new user";
        }
        else {
            return "The user already exists";
        }
    }

    public function getUser($email) {
        $query = "SELECT * FROM USERS WHERE email='$email'";
        $isUser = $this->dbConnect()->query($query);
        if($isUser->rowCount()==1) {
            $result = $isUser->fetch();
            return $result;
        }
        else {
            return "Error";
        }
    }

    public function getUserTable() {
        $query = "SELECT * FROM USERS";
        $stmt = $this->dbConnect()->query($query);
        $table = '';

        foreach ($stmt as $row) {
            $table .= '<tr>'
                    .'<td>'.$row['ID'].'</td>'
                    .'<td>'.$row['clientName'].'</td>'
                    .'<td>'.$row['phone'].'</td>'
                    .'<td>'.$row['email'].'</td>'
                    .'<td>'.$row['role'].'</td>'
                    .'<td><form action="update.php" method="POST">
                            <button type="submit" name="userEmail" value="' .$row['email']. '" class="btn-table btn-edit icon-pencil"></button>
                        </form>
                        <form action="removeUser.php" method="POST">
                            <button type="submit" name="userEmail" value="' .$row['email'].'" class="btn-table btn-delete icon-trash-empty"></button>
                        </form></td>'
                    .'</tr>';
        }

        return $table;
    }

    public function updateUser($whatToSet, $forWhat, $email) {
        $stmt = '';
        switch ($whatToSet) {
            case 'clientName':
                $stmt = $this->dbConnect()->prepare("UPDATE USERS SET clientName=? WHERE email=?");
            break;
            case 'phone':
                $stmt = $this->dbConnect()->prepare("UPDATE USERS SET phone=? WHERE email=?");
            break;
            case 'role':
                $stmt = $this->dbConnect()->prepare("UPDATE USERS SET role=? WHERE email=?");
            break;
        }
        $result = $stmt->execute([$forWhat, $email]);

        if($result)
            return "Correctly update";
        else
            return "Error";
    }

    public function updatePassword($email, $password) {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $updateUser = $this->dbConnect()->exec("UPDATE USERS SET password='$passHash' WHERE email='$email'");
        if($updateUser)
            return "Updated password";
        else
            return "Error";
    }

    public function removeUser($idUser)
    {
        $stmt = $this->dbConnect()->prepare("DELETE FROM USERS WHERE ID=?");
        $result = $stmt->execute([$idUser]);
        if ($result)
            return "Correctly deleted";
        else
            return "Error during deletion";
    }
}