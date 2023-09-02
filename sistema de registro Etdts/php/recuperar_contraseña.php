<?php
// Recuperar contraseña
$host = 'localhost';
$db = 'sysbenyi';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $newPassword = $_POST["new_password"];

    // Encriptar la nueva contraseña (si se desea)
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la tabla usuarios
    $sql = "UPDATE usuarios SET contrasena = '$hashedPassword' WHERE nombre = '$nombre' AND apellido = '$apellido'";

    if ($conn->query($sql) === TRUE) {
        echo "Contraseña cambiada exitosamente.";
    } else {
        echo "Error al cambiar la contraseña: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url("../img/layered-peaks-haikei.png") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        header {
            background-color: #333;
            text-align: center;
            color: white;
            padding: 1em;
        }

        h1 {
            margin: 0;
        }

        a {
            color: white;
        }

        main {
            max-width: 500px;
            margin: 2em auto;
            padding: 1em;
            background-color: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 0.5em 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
    <title>Cambiar Contraseña</title>
</head>

<body>
    <header>
        <h1>Cambiar Contraseña</h1><br>
        <a href="../index.html">Atras</a>
    </header>

    <main>
        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" id="new_password" name="new_password" required><br><br>

            <input type="submit" value="Cambiar Contraseña">
        </form>
    </main>
</body>

</html>