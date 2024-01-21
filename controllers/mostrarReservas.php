<?php
require "model/conexion.php";
echo '<tbody>';
                  
$sql = $conexion->query("SELECT * FROM reservas ORDER BY checkin");
while ($datos = $sql->fetch_object()) {

    // Invertir el formato de las fechas para mostrarlas
    $checkinInvertido = date("d-m-Y", strtotime($datos->checkin));
    $checkoutInvertido = date("d-m-Y", strtotime($datos->checkout));
    
    echo '<tr>';
    echo    '<td>'.$datos->cliente.'</td>';
    echo    '<td>'.$datos->habitacion.'</td>';
    echo    '<td>'.$checkinInvertido.'</td>';
    echo    '<td>'.$checkoutInvertido.'</td>';
    echo '</tr>';
}

echo '</tbody>';
?>
