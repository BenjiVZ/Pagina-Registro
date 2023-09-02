<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="login">
    <header class="login_header">
        <h2>Iniciar sesion</h2><br>
        <a href="../index.html">Atras</a>
    </header>

    <main class="login_main">
        <div>
            <form method="post" action="">
                <label>Usuario:</label>
                <input type="text" name="nombre" required><br>
                <label>Contraseña:</label>
                <input type="password" name="contrasena" required><br>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div><br>

        <div>
            <a href="recuperar_contraseña.php">¿Olvidaste tu contraseña?</a>
        </div>
    </main>

    <?php
    include("funciones-sistema.php");
    $login = login();
    ?>

</body>

</html>