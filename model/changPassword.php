<?php
include 'conn.php';

if(isset($_POST['submit'])){
    if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {

        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if (empty($oldPassword)) {
            $_SESSION['message']['text'] = "Old Password is required";
            $_SESSION['message']['type'] = "danger";
        } elseif (empty($newPassword)) {
            $_SESSION['message']['text'] = "New Password is required";
            $_SESSION['message']['type'] = "danger";
        } elseif ($newPassword !== $confirmPassword) {
            $_SESSION['message']['text'] = "The confirmation password does not match";
            $_SESSION['message']['type'] = "danger";
        } else {
            $id = $_SESSION['id'];

            $sql = "SELECT password FROM users WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
    
            if ($row) {
                // Verify old password
                if (password_verify($oldPassword, $row['password'])) {
                    // Hash the new password
                    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
    
                    // Update the password
                    $sql_2 = "UPDATE users SET password=:password WHERE id=:id";
                    // Prepares the statement
                    $stmt_2 = $conn->prepare($sql_2);
                    // Binds the parameters
                    $stmt_2->bindParam(':password', $newPasswordHashed);
                    $stmt_2->bindParam(':id', $id);
                    // Executes the statement
                    $stmt_2->execute();
    
                    $_SESSION['message']['text'] = "Your password has been changed successfully";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Incorrect old password";
                    $_SESSION['message']['type'] = "danger";
                }
            }
        }
    } else {
        $_SESSION['message']['text'] = "Some information is missing";
        $_SESSION['message']['type'] = "danger";
    }
}

header("Location: ../vue/setting.php");
