<!DOCTYPE html>
<html>

<head>
    <title>Respaldar Base de Datos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="respaldo">

    <header>
        <h1>Respaldar Base de Datos</h1><br>
        <a href="menu.php">Atras</a>
    </header>

    <main>
        <form action="" method="post">
            <input type="submit" name="exportar_db" value="Exportar Base de Datos">
            <input type="submit" name="crear_respaldo" value="Crear Respaldo">
        </form>
    </main>


    <?php
    include("funciones-sistema.php");
    respaldo();
    ?>
    
</body>

</html>