<?php
    require 'db.php';
    $message = '';
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $message = 'Su nuevo Usuario se a Creado y Guardad eficientemente';   
        } else {
            $message = 'Lo siento, tuvimos un problema para poder guardar sus datos';
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

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <div class="titulo">
            <h1>REGISTRARSE</h1>
        </div>

        <br>

        <div class="tab">
            <span><a href="login.php">Iniciar Sesión</a></span>
        </div>
        
        <br>

        <div class="log">
            <form action="registro.php" method="post">
                <input type="text" name="email" placeholder="Ingresa un nombre de Usuario">
                <input type="password" name="password" placeholder="Ingresa una contraseña">
                <input type="submit" value="Enviar">
            </form>
        </div>

    </body>

</html>