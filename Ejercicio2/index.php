<?php
//Recupera datos de la sesión 
session_start();
$datos = $_SESSION['datos'] ?? [];
$errores = $_SESSION['errores'] ?? [];
$mensaje = $_SESSION['mensaje'] ?? '';

// Limpiar variables de sesión después de usarlas
unset($_SESSION['errores'], $_SESSION['mensaje']); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if ($mensaje): ?>
    <p style="color: rgb(144, 238, 144);"> <?php echo $mensaje; ?></p>
<?php endif; ?>

<form action="server.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $datos['nombre'] ?? ''; ?>" >
    <span style="color:red;"><?php echo $errores['nombre'] ?? ''; ?></span><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo $datos['apellidos'] ?? ''; ?>" >
    <span style="color:red;"><?php echo $errores['apellidos'] ?? ''; ?></span><br>

    <label for="mail">Correo Electrónico:</label>
    <input type="text" name="mail" id="mail" value="<?php echo $datos['mail'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['mail'] ?? ''; ?></span><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" value="<?php echo $datos['password'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['password'] ?? ''; ?></span><br>

    <label for="password2">Repetir Contraseña:</label>
    <input type="password" name="password2" id="password2" value="<?php echo $datos['password2'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['password2'] ?? ''; ?></span><br>

    <label for="birth">Fecha de Nacimiento(DD/MM/YYYY):</label>
    <input type='text' name='birth' id="birth" value="<?php echo $datos['birth'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['birth'] ?? ''; ?></span><br>


    <label for="card">Número de Tarjeta:</label>
    <input type='text' name='card' id="card" value="<?php echo $datos['card'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['card'] ?? ''; ?></span><br>


    <label for="expiration">Fecha de Expiración(MM/YYYY):</label>
    <input type='text' name='expiration' id="expiration" value="<?php echo $datos['expiration'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['expiration'] ?? ''; ?></span><br>


    <label for="CVV">CVV:</label>
    <input type='text' name='CVV' id="CVV" value="<?php echo $datos['CVV'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errores['CVV'] ?? ''; ?></span><br>

    <button type="submit">Enviar formulario</button>
</form>
</body>
</html>