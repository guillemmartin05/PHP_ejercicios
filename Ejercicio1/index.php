<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table> 
    <?php
    
    /*bucle for dentro de otro for. En el bucle exterior imprimirá las filas y en el interior las columnas. 
    Dentro, tambien está la lógica para imprimir una casilla blanca y otra negra */ 
    for($row=0; $row< 8; $row++) { 
        echo "<tr>";
        for ($col = 0; $col < 8; $col++) { 
            
            if (($row + $col) % 2 == 0) {
                $color = "casilla-blanca"; 
            } else {
                $color = "casilla-negra"; 
            }
            echo "<td class='$color'></td>"; 
        }
        echo "</tr>"; 
    }
    ?>
    </table>
</body>
</html>