<?php

require "db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if($password != $confirm_password){
        die("Passwords do not match");
    }

    $hashedPassword =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (name,email,phone,password)
        VALUES(?,?,?,?)"
    );

    $stmt->bind_param(
        "ssss",
        $name,
        $email,
        $phone,
        $hashedPassword
    );

    if($stmt->execute()){
        header("Location: login.html");
        exit();
    }
    else{
        echo "Registration Failed";
    }

    $stmt->close();
    $conn->close();
}

?>