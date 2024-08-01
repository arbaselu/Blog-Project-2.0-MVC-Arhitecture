<?php

function sanitize($txt){
    $txt = htmlspecialchars($txt);
    $txt = trim($txt);
    $txt = stripslashes($txt);

    return $txt;
}


function clearSessionErrors() {
    $errorKeys = ['fullNameError', 'emailError', 'usernameError', 'passwordError', 'confirmPasswordError','emailCheck','titleError','contentError'];
    foreach ($errorKeys as $key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}

function clearSessionInputs() {
    $inputKeys = ['input_full_name', 'input_email', 'input_username', 'input_password', 'input_confirmPassword'];
    foreach ($inputKeys as $key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}


function isEmailTaken($email, $connect) {
    $sql = "SELECT email FROM users WHERE email = :email";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
    return false;
}

function isUsernameTaken($username, $connect) {
    $sql = "SELECT username FROM users WHERE username = :username";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
    return false;
}

function UserId($email, $connect) {
    $sql = "SELECT id FROM users WHERE email = :email";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['id'];
    }
    return false;
}


function createSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', ' ', $text);
    $text = trim($text);
    $text = preg_replace('/\s/', '-', $text);
    
    return $text;
}

function ValidateSlug($slug)
{
    $pattern = '/^[a-z0-9]+(-[a-z0-9]+)*$/';
    return preg_match($pattern, $slug);
}