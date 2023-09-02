<!DOCTYPE html>
<html>

<head>
    <title>Estudiantes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="verE">

    <header>
        <h1>Lista de Estudiantes</h1><br>
        <a href="menu.php">Atras</a>
    </header><br><br><br>

    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
            </tr>

            <?php
            include("funciones-sistema.php");
            $estudiantes = obtenerEstudiantes();

            foreach ($estudiantes as $estudiante) {
                echo "<tr>";
                echo "<td>" . $estudiante['id'] . "</td>";
                echo "<td>" . $estudiante['nombre'] . "</td>";
                echo "<td>" . $estudiante['apellido'] . "</td>";
                echo "<td>" . $estudiante['edad'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>

</body>

</html>