<!DOCTYPE html>
<html>

<head>
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="Estudiantes">

    <header class="header_estudiantes">
        <h1>Registro de Estudiantes</h1><br>
        <a href="menu.php">atras</a>
    </header><br>



    <main class="main_estudiantes">
        <form method="POST" action="">
            <label for="nombre">nombre</label><input type="text" name="nombre">
            <label for="apellido">apellido</label><input type="text" name="apellido">
            <label for="edad">edad</label><input type="text" name="edad">
            <input type="submit" value="Enviar">
        </form>
    </main>

    <?php
    include("funciones-sistema.php");
    $estudiantes = estudiantes();
    ?>
</body>

</html>