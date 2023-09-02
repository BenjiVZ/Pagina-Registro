<!DOCTYPE html>
<html>

<head>
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="registro">

    <header class="register_header">
        <h2>Registro de usuario</h2><br>
        <a href="../index.html">Atras</a>
    </header>

    <main class="register_main">
        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="estudiante">Estudiante</option>
                <option value="profesor">Profesor</option>
            </select><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br>
            <button type="submit">Registrar</button>
        </form>
    </main>

    <?php
    include("funciones-sistema.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $rol = $_POST["rol"];
        $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

        if (!preg_match("/^[a-zA-Z0-9_]+$/", $nombre)) {
            echo "El nombre de usuario solo puede contener letras, números y guiones bajos.";
        } else {
            if (usuarioExiste($nombre)) {
                echo "El nombre de usuario ya está registrado.";
            } else {
                if (registro($nombre, $apellido, $rol, $contrasena)) {
                    echo "Registro exitoso.";
                } else {
                    echo "Hubo un problema al registrar el usuario.";
                }
            }
        }
    }
    ?>

</body>

</html>