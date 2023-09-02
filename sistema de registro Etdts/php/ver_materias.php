<!DOCTYPE html>
<html>

<head>
    <title>Consulta de Notas por Materia</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="verM">
    
    <header>
        <h1>Consulta de Notas por Materia</h1><br>
        <a href="menu.php">Atras</a>
    </header>

    <main>
        <form action="" method="post">
            <label for="materia">Seleccione una materia:</label>
            <select name="materia" id="materia">
                <option value="Matematicas">Matematicas</option>
                <option value="Ciencias">Ciencias</option>
                <option value="LenguaLiteratura">Lengua y Literatura</option>
                <option value="Historia">Historia o Ciencias Sociales</option>
                <option value="Ingles">Ingles</option>
                <option value="Tecnologia">Tecnologia</option>
            </select>
            <br><br>
            <input type="submit" name="consultar" value="Consultar Notas">
        </form>
    </main>

    <?php
    include("funciones-sistema.php");
    vista();
    ?>

</body>

</html>