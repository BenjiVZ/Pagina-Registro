<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="Usuarios">
    <header>
        <h1>Tabla de Usuarios</h1><br>
        <a href="menu.php">Atras</a>
    </header>

    <main>
        <?php
        include("funciones-sistema.php");
        $usuarios = obtenerUsuarios();

        if (!empty($usuarios)) {
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido</th>";
            echo "<th>Rol</th>";
            echo "</tr>";

            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>{$usuario['id']}</td>";
                echo "<td>{$usuario['nombre']}</td>";
                echo "<td>{$usuario['apellido']}</td>";
                echo "<td>{$usuario['rol']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay usuarios registrados.</p>";
        }
        ?>
    </main>

</body>

</html>