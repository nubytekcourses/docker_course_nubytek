<?php
// Configuración de conexión a la base de datos
$host = '192.168.1.9'; // Cambia esto si usas un host diferente
$dbname = 'nubytek_db'; // Cambia al nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = 'nubytek'; // Contraseña del usuario de la base de datos


try {
    // Conectar a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Manejar la solicitud de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    echo "Correo ingresado: $email <br>";
    echo "Contraseña ingresada: $passwordInput <br>";

    if (!empty($email) && !empty($passwordInput)) {
        // Consultar la base de datos para obtener la contraseña almacenada
        $stmt = $pdo->prepare("SELECT contrasea FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($user); // Agrega esta línea para verificar el resultado


        if ($user && $passwordInput === $user['contrasea']) {
            echo "Inicio de sesión exitoso. Bienvenido, $email.";
        } else {
            echo "Credenciales inválidas.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h1>Inicia Sesión</h1>
    <form method="POST" action="">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
