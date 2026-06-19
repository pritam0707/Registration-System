<?php

session_start();

require "db.php";

$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conn->prepare(
    "SELECT id,name,password
     FROM users
     WHERE email=?"
);

$stmt->bind_param(
    "s",
    $email
);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $user = $result->fetch_assoc();

    if(
        password_verify(
            $password,
            $user["password"]
        )
    ){

        $_SESSION["id"] =
            $user["id"];

        $_SESSION["name"] =
            $user["name"];

        header(
            "Location: dashboard.php"
        );

        exit();

    }
    else{
        echo "Invalid Password";
    }

}
else{
    echo "User Not Found";
}

$stmt->close();
$conn->close();

?>