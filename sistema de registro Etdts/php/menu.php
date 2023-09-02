<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sysbenyi";

if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
}

$rolUsuario = $_SESSION['rol'];
$nombreUsuario = $_SESSION['nombre'];

?>

<!DOCTYPE html>
<html lang="en">

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

        .menu_header {
            background-color: #73255A;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu_header h1 {
            margin: 0;
            font-size: 24px;
        }

        .user_welcome {
            margin-right: 20px;
            font-size: 18px;
        }

        .menu_main {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .menu_main {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        /* Estilos para la sección 1 (sec1) */
        .sec1 {
            flex: 1;
            padding: 20px;
            background-color: #559bf0a4;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .sec1 a {
            display: block;
            color: #000000;
            font-size: 20px;
            text-decoration: none;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #8907379d;
            color: white;
            border-radius: 5px;
        }

        .sec1 a:hover {
            background-color: #890736;
        }

        /* Estilos para la sección 2 (sec2) */
        .sec2 {
            flex: 1;
            padding: 20px;
            background-color: #559bf0bb;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .sec2 h2.p1 {
            color: #000000;
            font-size: 24px;
        }

        .sec2 article {
            margin-top: 20px;
        }

        .sec2 h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .sec2 p {
            margin: 5px 0;
        }

        .sec2 .p1 {
            line-height: 1.6;
        }

        .sec2 .img1 {
            max-width: 15%;
            height: auto;
            margin-top: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
</head>

<body>

    <header class="menu_header">
        <div class="user_welcome">
            <?php echo "Bienvenido, $nombreUsuario"; ?>
        </div>
        <h1>SYSbenji</h1>
        <div>
            <img src="../img/logo.png" alt="Logo" class="logo_img">
        </div>
    </header> <br>

    <main class="menu_main">
        <div class="sec1">
            <?php
            if ($rolUsuario === "admin") {
                echo "<a href='estudiantes.php'>Registro de estudiantes</a>";
                echo "<a href='profesores.php'>Registro de profesores</a>";
                echo "<a href='notas.php'>Registro de notas</a>";
                echo "<a href='ver_materias.php'>Notas</a>";
                echo "<a href='ver_estudiantes.php'>Estudiantes</a>";
                echo "<a href='ver_profesores.php'>Profesores</a>";
                echo "<a href='../html/modificar-menu.html'>Modificar información</a>";
                echo "<a href='usuarios.php'>Usuarios</a>";
                echo "<a href='respaldo.php'>Respaldo</a><br>";
            } elseif ($rolUsuario === "estudiante") {
                echo "<a href='ver_profesores.php'>Profesores</a>";
                echo "<a href='ver_materias.php'>Notas</a>";
                echo "<a href='ver_estudiantes.php'>Estudiantes</a>";
            } elseif ($rolUsuario === "profesor") {
                echo "<a href='estudiantes.php'>Registro de estudiantes</a>";
                echo "<a href='notas.php'>Registro de notas</a>";
                echo "<a href='ver_materias.php'>Notas</a>";
                echo "<a href='ver_estudiantes.php'>Estudiantes</a>";
                echo "<a href='ver_profesores.php'>Profesores</a>";
                echo "<a href='actualizar_notas.php'>Modificar las Notas</a>";
            }
            ?> <br>
            <a href="../index.html" class="button">Salir</a>
        </div>

        <div class="sec2">
            <h2 class="p1">Autor</h2>
            <article>
                <h3>Benjamin Velazco</h3>
                <p>30719983</p><br><br>
                <p class="p1">
                    INSTITUTO UNIVERSITARIO DE TECNOLOGÍA DE ADMINISTRACIÓN INDUSTRIAL <br><br>
                    TÉCNICO SUPERIOR UNIVERSITARIO EN INFORMÁTICA
                </p><br>
                <!--             <img src="img/autor.jpg" alt="" class="img1"> -->
            </article>
        </div>
    </main>

</body>

</html>