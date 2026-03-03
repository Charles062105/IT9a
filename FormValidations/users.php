<?php
// Simple file-based user storage
define('USER_FILE', 'users.txt');

// Initialize file
if(!file_exists(USER_FILE)) {
    file_put_contents(USER_FILE, serialize([]));
}

// Save user
function saveUser($name, $email, $password) {
    $users = unserialize(file_get_contents(USER_FILE));
    
    // Check if email exists
    foreach($users as $user) {
        if($user['email'] == $email) {
            return false;
        }
    }
    
    $users[] = [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ];
    
    file_put_contents(USER_FILE, serialize($users));
    return true;
}

// Authenticate user
function authenticateUser($email, $password) {
    $users = unserialize(file_get_contents(USER_FILE));
    
    foreach($users as $user) {
        if($user['email'] == $email && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}
?>