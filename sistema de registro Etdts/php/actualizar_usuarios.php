<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Usuarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="actualizarU">
    <header>
        <h1>Actualizar Usuarios</h1><br>
        <a href="../php/menu.php">Atras</a>
    </header>

    <main>
        <?php
        include("funciones-sistema.php");
        $estudiantes = actualizarusuarios();
        ?>
    </main>

</body>

</html>