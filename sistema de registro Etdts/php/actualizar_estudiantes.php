<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Estudiantes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="actualizarE">

    <header>
        <h1>Actualizar Estudiantes</h1><br>
        <a href="../php/menu.php">Atras</a>
    </header>

    <main>
        <?php
        include("funciones-sistema.php");
        $estudiantes = actualizarEstudiante();
        ?>
    </main>

</body>

</html>