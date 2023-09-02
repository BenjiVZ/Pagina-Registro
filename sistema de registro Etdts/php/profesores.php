<!DOCTYPE html>
<html>

<head>
    <title>Registro de Profesores</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="profesores">

    <header>
        <h1>Registro de Profesor</h1><br>
        <a href="menu.php">Atras</a>
    </header>

    <main>
        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="materia">Materia:</label>
            <select id="materia" name="materia">
                <option value="Matematicas">Matematicas</option>
                <option value="Ciencias">Ciencias</option>
                <option value="Lengua y Literatura">Lengua y Literatura</option>
                <option value="Historia">Historia</option>
                <option value="Ingles">Ingles</option>
                <option value="Tecnologia">Tecnologia</option>
            </select><br>
            <button type="submit">Registrar</button>
        </form>
    </main>

    <?php
    include("funciones-sistema.php");
    registroProfesor();
    ?>

</body>

</html>