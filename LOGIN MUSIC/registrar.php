<?php

$usuario = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

try {

    $conexion = new PDO('mysql:host=localhost;port=3306;dbname=registro_music', 'root', '');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


    $pdo = $conexion->prepare('INSERT INTO usuarios(usuario, email, password) VALUES(?,?,?)');
    $pdo->bindParam(1, $usuario);
    $pdo->bindParam(2, $email);
    $pdo->bindParam(3, $password);
    $pdo->execute() or die(print($pdo-errorInfo()));

    echo json_encode('true');


} catch (PDOException $error) {
    echo $error->getMessage();
    die();
}