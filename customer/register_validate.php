<?php 
function validateRegister($email,$pass1,$pass2,$phone) {
    include("connect.php");
    $users = getUsers($pdo);
    $phoneRegex = "/^0\d{8,}/";
    echo '<font color="red"><b>';
    if ($pass1 !== $pass2) {
        echo "The passwords have to be the same.";
        echo '</b></font>';
        return false;
    } else if(strlen($pass1) < 8) {
        echo "Your password must be at least 8 characters long.";
        echo "</b></font>";
    } else if (!preg_match($phoneRegex,$phone)) {
        echo "Enter valid phone number format. E.g. 099877655";
        echo '</b></font>';
        return false;
    } else {
        foreach($users as $user) {
            if ($email === $user['email']) {
                echo "The email is already in use.";
                echo '</b></font>';
                return false;
            }
        }
        echo '</font>';
        return true;
    }
    
}

function addUser($name,$email,$pass1,$phone,$address,$utype) {
    include("connect.php");
    $sql = "INSERT INTO users (name, email, address, phone, user_type, password) 
                VALUES (:name, :email, :address, :phone, :utype,:password)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':utype', $utype);
        $stmt->bindParam(':password', $pass1);

        if ($stmt->execute()) {
            echo 'Registered successfully!<br>' . 
            '<a href="index.php">Go back to home page.</a>';
        } else {
            echo "Failed to insert data.";
        }
}

?>
