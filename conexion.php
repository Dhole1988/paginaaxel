<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "registro";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $password = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor ingresa un email válido.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
     
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
     
        $stmt = $conn->prepare("INSERT INTO datos (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password);
        
        if ($stmt->execute()) {
            header("Location: success.php"); 
            exit();
        } else {
            if ($conn->errno == 1062) {
                $error = "Este email ya está registrado.";
            } else {
                $error = "Ocurrió un error. Por favor intenta nuevamente.";
            }
        }
        
        $stmt->close();
    }
}

$conn->close();
?>
