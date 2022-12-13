<?php
    session_start();
    require 'db.php';
    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id =:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">
        <title>LOGIN . . !</title>
        <link rel="stylesheet" href="assets/css/estilos.css">
        
    </head>

    <body>

        <?php require 'otros/header.php' ?>   
        <?php if(!empty($user)): ?>

        <br><br><br><br>

        <div class="log">
            <br><h1>¡¡¡Hola de nuevo <?= $user['email'] ?>!!!</h1>
            <br><h2>Parece que la sesión se inicio correctamente... Perfecto!</h2>
        </div>

        <div class="tab">
            <a href="logout.php">Salir de la Sesión</a>
        </div>

        <?php else: ?>

        <br><br>

        <div class="titulo">
            <h1>Bienvenido!</h1>
        </div>

        <br>

        <div class="tab">
            <h3>¿Quieres Iniciar Sesión?</h3>
        </div>

        <br><br><br>

        <div class="log">
            <a href="login.php">Has click aqui para iniciar una nueva sesión</a> <br><br><br>
            <a href="registro.php">¿No tienes una cuenta todavia?</a>
        </div>

        <?php endif; ?>

    </body>

</html>