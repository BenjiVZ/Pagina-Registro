<!DOCTYPE html>
<html>

<head>
    <title>Profesores</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="verP">

    <header>
        <h1>Lista de Profesores</h1><br>
        <a href="menu.php">Atras</a>
    </header><br><br><br>

    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Materia</th>
            </tr>

            <?php
            include("funciones-sistema.php");
            $profesores = obtenerProfesores();

            foreach ($profesores as $profesor) {
                echo "<tr>";
                echo "<td>" . $profesor['id'] . "</td>";
                echo "<td>" . $profesor['nombre'] . "</td>";
                echo "<td>" . $profesor['apellido'] . "</td>";
                echo "<td>" . $profesor['materia'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>

</body>

</html>