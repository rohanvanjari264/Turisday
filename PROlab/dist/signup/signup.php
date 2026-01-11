<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $pass  = $_POST["password"];
    $cpass = $_POST["confirm_password"];

    // Validation
    if ($pass !== $cpass) {
        die("Passwords do not match");
    }

    // Hash password
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $name, $email, $hashed);

    if ($stmt->execute()) {
        header("Location: ../signup/loginpage.html");
        exit;
    } else {
        echo "Email already exists!";
    }
}
?>
