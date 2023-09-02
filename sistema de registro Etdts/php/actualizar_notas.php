<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Notas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="actualizarN">
    <header>
        <h1>Seleccionar Materia</h1><br>
        <a href="../php/menu.php">Atras</a>
    </header>

    <main>
        <form method="post" action="">
            <label>Materia:</label>
            <select name="materia" id="materia">
                <option value="Matematicas">Matematicas</option>
                <option value="Ciencias">Ciencias</option>
                <option value="LenguaLiteratura">Lengua y Literatura</option>
                <option value="Historia">Historia o Ciencias Sociales</option>
                <option value="Ingles">Ingles</option>
                <option value="Tecnologia">Tecnologia</option>
            </select>
            <input type="submit" value="Mostrar Notas">
        </form>

        <?php
        include("funciones-sistema.php");
        $estudiantes = actualizarnotas();
        ?>
    </main>

</body>
</html>