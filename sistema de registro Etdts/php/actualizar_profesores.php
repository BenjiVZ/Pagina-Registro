<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Profesores</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="actualizarP">
    <header>
        <h1>Actualizar Profesores</h1><br>
        <a href="../php/menu.php">Atras</a>
    </header>

    <main>
        <?php
        include("funciones-sistema.php");
        $estudiantes = actualizarProfesor();
        ?>
    </main>

</body>

</html>