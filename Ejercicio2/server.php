<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

//0. Sesión iniciada
session_start(); 

//1. Para empezar compruebo si la página fue accedida mediante petición HTTP POST. Si no, se omite todo el procesado de info y comprobaciones,etc
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //2.Obtenemos valores enviados del formulario
    $nombre= $_POST ["nombre"];  
    $apellidos = $_POST ["apellidos"];
    $mail = $_POST ["mail"];
    $password = $_POST ["password"];
    $password2 = $_POST ["password2"];
    $birth = $_POST ["birth"];
    $card = $_POST ["card"];
    $expiration = $_POST ["expiration"];
    $cvv = $_POST ["CVV"];

    //3. Realizamos comprobaciones de los datos introducidos por el usuario en el formulario

    $errores = []; // Array para almacenar errores en  comprobaciones

    //array para almacenar datos
    $datos = [
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "mail" => $mail,
        "password" => $password,
        "password2" => $password2,
        "birth" => $birth,
        "card" => $card,
        "expiration" => $expiration,
        "CVV" => $cvv,
    ];
    //Comprobación de si el recuadro no esta vacio, y de si empieza con mayúscula y toda son letras
    if (empty($nombre)) {
        $errores['nombre'] = "El nombre es obligatorio.";
    } elseif (!preg_match("/^[A-Z][a-zA-Z]*$/", $nombre)) {
        $errores['nombre'] = "El nombre debe contener solo letras y comenzar con mayúscula.";
    }

    //Comprobación de que no este vacio el recuadro y de si empieza con maysucula los dos apellidos y todo son letras
    /* Al ser 2 palabras, haré un proceso parecido al anterior pero separando los apellidos en un array para analizar cada apellido individualmente*/
    if (empty($apellidos)) {
        $errores['apellidos'] = "Los apellidos son obligatorios.";
    } else {
        $apellidosArray = explode(" ", $apellidos); 
        foreach ($apellidosArray as $apellido) {
            if (!preg_match("/^[A-Z][a-zA-Z]*$/", $apellido)) {
                $errores['apellidos'] = "Cada apellido debe comenzar con mayúscula y contener solo letras.";
                break; 
            }
        }
    }

    //Comprobación de email. No puede estar vacio y debe estar en un formato válido para ser email
    if(empty($mail)){
        $errores['mail'] = "El mail es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/", $mail)){
        $errores['mail'] = "El mail debe estar en un formato correcto.";
    }

    //Comprobación de contraseña. No puede estar vacia y debe estar en el formato que especifica el enunciado
    if(empty($password)){
        $errores['password'] = "Es necesario una contraseña";
    } elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}$/", $password)){
        $errores['password'] = "El password debe estar en un formato correcto.";
    }

    //Comprobación de contraseña repetida. Debe compararse con la password introducida ya que debe ser igual
    if(empty($password2)){
        $errores['password2'] = "Es necesario repetir la contraseña.";
    }elseif($password !== $password2){
        $errores['password2'] = "Las contraseñas no coinciden";
    }

    //Comprobación fecha nacimiento. No es obligatoria pero si se pone, deberá estar en formato DD/MM/YYYY
    if(!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $birth)){
        $errores['birth'] = "Es necesaria poner una fecha de nacimiento en formato DD/MM/YYYY.";
    }

    //Comprobación de número de tarjeta. Si no esta vacio y no tiene 16 dígitos, saldrá error que almacenaremos en array de errores
    if (!empty($card) && !preg_match("/^\d{16}$/", $card)) {
        $errores['card'] = "El número de tarjeta debe contener 16 dígitos.";
    }

    //Comprobación de fecha expiración. Campo no obligatorio pero si se introduce un número de tarjeta si lo es y debe ser fecha futura
    if (!empty($card)) {
        if (empty($expiration)) {
            $errores['expiration'] = "La fecha de caducidad no puede estar vacia si se incluye una tarjeta de pago";
        } else {
            $fechaActual = new DateTime();
            $fechaCaducidad = DateTime::createFromFormat("m/Y", $expiration);
                if ($fechaCaducidad <= $fechaActual){
                    $errores['expiration'] = "Es necesario que la fecha de caducidad sea futura.";
            }
        }
    } 
    //Comprobación de código de seguridad. Campo no obligatorio pero si se introduce un número de tarjeta entonces si es obligatorio
    if (!empty($card)){
        if (empty($cvv)) {
            $errores['CVV'] = "El CVV no puede estar vacio si se incluye una tarjeta de pago";
        } elseif (!preg_match("/^\d{3}$/", $cvv)) {
            $errores['CVV'] = "El CVV debe contener 3 dígitos.";
        }
    }     

  
  // Verificamos si en el array errores, hay errores,  y si los hay, los almacenamos junto a los datos en $_SESSION 
  if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['datos'] = $datos;
    header("Location: index.php"); //la funcion header es para que no redirija a una página nueva, una vez enviado el formulario
    exit();
    }

    // Si no hay errores, guardamos los datos en sesión y mostramos mensaje personalizado de éxito
    $_SESSION['usuario'] = $datos;
    $_SESSION['mensaje'] = "Registro completado con éxito.";
    header("Location: index.php");
    exit();
    

} else{
    echo "<p style='color: red;'>Error al procesar la información.</p>"; 
}
?>
</body>
</html>