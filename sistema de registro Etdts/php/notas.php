<!DOCTYPE html>
<html>

<head>
    <title>Registro de Notas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="notas">

    <header>
        <h1>Registro de Notas</h1><br>
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
                <option value="LenguaLiteratura">Lengua y Literatura</option>
                <option value="Historia">Historia o Ciencias Sociales</option>
                <option value="Ingles">Ingles</option>
                <option value="Tecnologia">Tecnologia</option>
            </select><br>
            <label for="nota1">Nota 1:</label>
            <input type="number" id="nota1" name="nota1" step="0.01" required><br>
            <label for="nota2">Nota 2:</label>
            <input type="number" id="nota2" name="nota2" step="0.01" required><br>
            <label for="nota3">Nota 3:</label>
            <input type="number" id="nota3" name="nota3" step="0.01" required><br>
            <label for="nota4">Nota 4:</label>
            <input type="number" id="nota4" name="nota4" step="0.01" required><br>
            <label for="nota5">Nota 5:</label>
            <input type="number" id="nota5" name="nota5" step="0.01" required><br>
            <button type="submit">Guardar Notas</button>
        </form>
    </main>

    <?php
    include("funciones-sistema.php");
    $notas = notas();
    ?>
</body>

</html>