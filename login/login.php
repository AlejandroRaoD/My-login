<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: /login');
    }
    require 'db.php';
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';
        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location:  /login/login.php');
        } else {
           $message = 'Lo siento, tu usuario o contraseña no es correcto';
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

        <br><br>

        <div class="titulo">
            <h1>INICIO DE SESIÓN</h1>
        </div>

        <br>

        <div class="tab">
            <span><a href="registro.php">¿No te has Registrado aun?</a></span>
            <?php if (!empty($message)) : ?>
                <p><?= $message ?></p>
            <?php endif; ?>
        </div>

        <br>

        <div class="log">
            <form action="login.php" method="post">
                <input type="text" name="email" placeholder="Introduce tu nombre de Usuario o Email">
                <input type="password" name="password" placeholder="Introduce tu Contraseña">
                <input type="submit" value="Entrar">
            </form>
        </div>

    </body>
    
</html>