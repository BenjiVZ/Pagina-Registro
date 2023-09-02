<?php

function login()
{
    session_start();

    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $contrasena = $_POST["contrasena"];

        if ($nombre === "admin" && $contrasena === "12345") {
            $_SESSION["nombre"] = "admin";
            $_SESSION["rol"] = "admin";
            header("Location: menu.php");
            exit;
        }

        $sql = "SELECT * FROM usuarios WHERE nombre='$nombre'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row["contrasena"])) {
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $row["rol"];
                header("Location: menu.php");
                exit;
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }

    $conn->close();
}


function registro($nombre, $apellido, $rol, $contrasena) {
    // Reemplaza con tu lógica de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Insertar registro en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, rol, contrasena) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellido, $rol, $contrasena);

    $result = $stmt->execute();

    // Cerrar conexión
    $stmt->close();
    $conn->close();

    return $result;
}

// Función para verificar si un usuario ya existe en la base de datos
function usuarioExiste($nombre) {
    // Reemplaza con tu lógica de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el usuario ya existe
    $sql = "SELECT id FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;

    // Cerrar conexión
    $stmt->close();
    $conn->close();

    return ($count > 0);
}


function estudiantes()
{
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];

        // Conexión a la base de datos
        $host = 'localhost';
        $db = 'sysbenyi';
        $user = 'root';
        $pass = '';

        $conn = new mysqli($host, $user, $pass, $db);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO estudiantes (nombre, apellido, edad) VALUES ('$nombre', '$apellido', '$edad')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close(); // Cerrar la conexión
    }
};


function notas()
{
    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    // Crear la conexión
    $conn = new mysqli($host, $user, $pass, $db);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si las claves están definidas
    if (
        isset($_POST["nombre"]) && isset($_POST["apellido"]) &&
        isset($_POST["materia"]) && isset($_POST["nota1"]) &&
        isset($_POST["nota2"]) && isset($_POST["nota3"]) &&
        isset($_POST["nota4"]) && isset($_POST["nota5"])
    ) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $materia = $_POST["materia"];
        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];
        $nota4 = $_POST["nota4"];
        $nota5 = $_POST["nota5"];

        // Calcular la nota final (promedio de las notas)
        $notafinal = ($nota1 + $nota2 + $nota3 + $nota4 + $nota5) / 5;

        // Insertar los datos en la tabla de la materia
        $sql_insert = "INSERT INTO notas (materia, nombre, apellido, nota1, nota2, nota3, nota4, nota5, notafinal)
                VALUES ('$materia', '$nombre', '$apellido', $nota1, $nota2, $nota3, $nota4, $nota5, $notafinal)";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Notas registradas correctamente.";
        } else {
            echo "Error al registrar las notas: " . $conn->error;
        }
    } else {
        echo "Faltan datos en el formulario.";
    }

    $conn->close();
};


function vista()
{
    if (isset($_POST['consultar'])) {
        $materiaSeleccionada = $_POST['materia'];

        $host = 'localhost';
        $db = 'sysbenyi';
        $user = 'root';
        $pass = '';

        // Crear la conexión
        $conn = new mysqli($host, $user, $pass, $db);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener las notas de la materia seleccionada
        $sql = "SELECT * FROM notas WHERE materia = '$materiaSeleccionada'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Notas de la materia: $materiaSeleccionada</h2>";
            echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Materia</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nota1</th>
                    <th>Nota2</th>
                    <th>Nota3</th>
                    <th>Nota4</th>
                    <th>Nota5</th>
                    <th>Nota Final</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['materia'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['nota1'] . "</td>";
                echo "<td>" . $row['nota2'] . "</td>";
                echo "<td>" . $row['nota3'] . "</td>";
                echo "<td>" . $row['nota4'] . "</td>";
                echo "<td>" . $row['nota5'] . "</td>";
                echo "<td>" . $row['notafinal'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron notas para la materia: $materiaSeleccionada";
        }

        $conn->close();
    }
};


function registroProfesor()
{
    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $materia = $_POST["materia"];

        $sql = "INSERT INTO profesores (nombre, apellido, materia) VALUES ('$nombre', '$apellido', '$materia')";

        if ($conn->query($sql) === TRUE) {
            echo "Profesor registrado correctamente.";
        } else {
            echo "Error al registrar el profesor: " . $conn->error;
        }
    }

    $conn->close();
}


function obtenerProfesores()
{
    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM profesores";
    $result = $conn->query($sql);

    $profesores = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $profesores[] = $row;
        }
    }

    $conn->close();

    return $profesores;
}


function obtenerEstudiantes()
{
    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM estudiantes";
    $result = $conn->query($sql);

    $estudiantes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estudiantes[] = $row;
        }
    }

    $conn->close();

    return $estudiantes;
}


function actualizarnotas()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['materia'])) {
            $materia = $_POST['materia'];

            $sql = "SELECT * FROM notas WHERE materia = '$materia'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Actualizar Notas de $materia</h2>";
                echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Nota 4</th>
                    <th>Nota 5</th>
                    <th>Actualizar</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<form method='post' action=''>
                    <tr>
                        <td>" . $row['id'] . "<input type='hidden' name='id' value='" . $row['id'] . "'></td>
                        <td><input type='text' name='nombre' value='" . $row['nombre'] . "'></td>
                        <td><input type='text' name='apellido' value='" . $row['apellido'] . "'></td>
                        <td><input type='text' name='nota1' value='" . $row['nota1'] . "'></td>
                        <td><input type='text' name='nota2' value='" . $row['nota2'] . "'></td>
                        <td><input type='text' name='nota3' value='" . $row['nota3'] . "'></td>
                        <td><input type='text' name='nota4' value='" . $row['nota4'] . "'></td>
                        <td><input type='text' name='nota5' value='" . $row['nota5'] . "'></td>
                        <td><input type='submit' value='Actualizar'></td>
                    </tr>
                    </form>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron registros para la materia: $materia";
            }
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];
            $nota4 = $_POST['nota4'];
            $nota5 = $_POST['nota5'];
            $notafinal = ($nota1 + $nota2 + $nota3 + $nota4 + $nota5) / 5;

            $update_sql = "UPDATE notas SET nombre='$nombre', apellido='$apellido', nota1='$nota1', nota2='$nota2', nota3='$nota3', nota4='$nota4', nota5='$nota5', notafinal='$notafinal' WHERE id='$id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Notas actualizadas correctamente.";
            } else {
                echo "Error al actualizar las notas: " . $conn->error;
            }
        }
    }

    $conn->close();
}

function obtenerMaterias()
{
    return ['matematicas', 'ciencias', 'lengua_literatura', 'historia', 'ingles', 'tecnologia'];
}

function actualizarEstudiante()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $edad = $_POST['edad'];

            $update_sql = "UPDATE estudiantes SET nombre='$nombre', apellido='$apellido', edad='$edad' WHERE id='$id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Estudiante actualizado correctamente.";
            } else {
                echo "Error al actualizar el estudiante: " . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM estudiantes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Actualizar</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<form method='post' action=''>
            <tr>
                <td>" . $row['id'] . "<input type='hidden' name='id' value='" . $row['id'] . "'></td>
                <td><input type='text' name='nombre' value='" . $row['nombre'] . "'></td>
                <td><input type='text' name='apellido' value='" . $row['apellido'] . "'></td>
                <td><input type='text' name='edad' value='" . $row['edad'] . "'></td>
                <td><input type='submit' name='update' value='Actualizar'></td>
            </tr>
            </form>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros de estudiantes.";
    }

    $conn->close();
}


function actualizarProfesor()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $materia = $_POST['materia'];

            $update_sql = "UPDATE profesores SET nombre='$nombre', apellido='$apellido', materia='$materia' WHERE id='$id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Profesor actualizado correctamente.";
            } else {
                echo "Error al actualizar el profesor: " . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM profesores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Materia</th>
            <th>Actualizar</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<form method='post' action=''>
            <tr>
                <td>" . $row['id'] . "<input type='hidden' name='id' value='" . $row['id'] . "'></td>
                <td><input type='text' name='nombre' value='" . $row['nombre'] . "'></td>
                <td><input type='text' name='apellido' value='" . $row['apellido'] . "'></td>
                <td>
                    <select name='materia'>
                        <option value='Matematicas' " . ($row['materia'] == 'Matematicas' ? 'selected' : '') . ">Matematicas</option>
                        <option value='Ciencias' " . ($row['materia'] == 'Ciencias' ? 'selected' : '') . ">Ciencias</option>
                        <option value='LenguaLiteratura' " . ($row['materia'] == 'LenguaLiteratura' ? 'selected' : '') . ">Lengua y Literatura</option>
                        <option value='Historia' " . ($row['materia'] == 'Historia' ? 'selected' : '') . ">Historia o Ciencias Sociales</option>
                        <option value='Ingles' " . ($row['materia'] == 'Ingles' ? 'selected' : '') . ">Ingles</option>
                        <option value='Tecnologia' " . ($row['materia'] == 'Tecnologia' ? 'selected' : '') . ">Tecnologia</option>
                    </select>
                </td>
                <td><input type='submit' name='update' value='Actualizar'></td>
            </tr>
            </form>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros de profesores.";
    }

    $conn->close();
}

function actualizarusuarios()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysbenyi";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['actualizar'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $rol = $_POST['rol'];

            $update_sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', rol='$rol' WHERE id='$id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Usuario actualizado correctamente.";
            } else {
                echo "Error al actualizar el usuario: " . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rol</th>
            <th>Actualizar</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<form method='post' action=''>
            <tr>
                <td>" . $row['id'] . "<input type='hidden' name='id' value='" . $row['id'] . "'></td>
                <td><input type='text' name='nombre' value='" . $row['nombre'] . "'></td>
                <td><input type='text' name='apellido' value='" . $row['apellido'] . "'></td>
                <td>
                    <select name='rol'>
                        <option value='estudiante' " . ($row['rol'] == 'estudiante' ? 'selected' : '') . ">Estudiante</option>
                        <option value='profesor' " . ($row['rol'] == 'profesor' ? 'selected' : '') . ">Profesor</option>
                    </select>
                </td>
                <td><input type='submit' name='actualizar' value='Actualizar'></td>
            </tr>
            </form>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros de usuarios.";
    }

    $conn->close();
}

function obtenerUsuarios()
{
    $host = 'localhost';
    $db = 'sysbenyi';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    $usuarios = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }

    $conn->close();

    return $usuarios;
}





function respaldo()
{

    if (isset($_POST['exportar_db'])) {
        $nombreArchivo = '..\respaldo\backup_' . date("Y-m-d_H-i-s") . '.sql';
        $comando = "mysqldump --user=usuario --password=contraseña --host=localhost nombre_de_la_base_de_datos > $nombreArchivo";
        exec($comando, $output, $return_var);

        if ($return_var === 0) {
            echo "Base de datos exportada exitosamente.";
        } else {
            echo "Error al exportar la base de datos.";
        }
    } elseif (isset($_POST['crear_respaldo'])) {
        $carpetaRespaldo = '../respaldo';
        if (!is_dir($carpetaRespaldo)) {
            mkdir($carpetaRespaldo);
        }

        $nombreArchivo = 'respaldo_' . date("Y-m-d_H-i-s") . '.txt';
        $contenidoRespaldo = '';

        // Conexión a la base de datos (ajusta los valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sysbenyi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Encabezado y datos de la tabla notas
        $contenidoRespaldo .= "Tabla: notas\n";
        $contenidoRespaldo .= "ID\tMateria\tNombre\tApellido\tNota1\tNota2\tNota3\tNota4\tNota5\tNota Final\n";

        $sql = "SELECT * FROM notas";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $contenidoRespaldo .= implode("\t", $row) . "\n";
        }

        // Encabezado y datos de la tabla estudiantes
        $contenidoRespaldo .= "\nTabla: estudiantes\n";
        $contenidoRespaldo .= "ID\tNombre\tApellido\tEdad\n";

        $sql = "SELECT * FROM estudiantes";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $contenidoRespaldo .= implode("\t", $row) . "\n";
        }

        // Encabezado y datos de la tabla profesores
        $contenidoRespaldo .= "\nTabla: profesores\n";
        $contenidoRespaldo .= "ID\tNombre\tApellido\tMateria\n";

        $sql = "SELECT * FROM profesores";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $contenidoRespaldo .= implode("\t", $row) . "\n";
        }

        $conn->close();

        // Crear archivo de respaldo
        file_put_contents($carpetaRespaldo . '/' . $nombreArchivo, $contenidoRespaldo);

        echo "Respaldo creado exitosamente.";
    }
}
