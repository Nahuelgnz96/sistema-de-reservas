<?php
require "../model/conexion.php";
function verificarDisponibilidad($conexion, $numeroHabitacion, $fechaCheckIn, $fechaCheckOut) {
    $query = "SELECT COUNT(*) as conteo FROM reservas WHERE habitacion = ? AND
            ((checkin BETWEEN ? AND ?) OR (checkout BETWEEN ? AND ?))";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("issss", $numeroHabitacion, $fechaCheckIn, $fechaCheckOut, $fechaCheckIn, $fechaCheckOut);
    $stmt->execute();
    $stmt->bind_result($conteo);
    $stmt->fetch();
    $stmt->close();
    return ($conteo == 0);  // Habitación disponible si $conteo es igual a 0
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnreservar"])) {
    
    // Verificar si todos los campos están llenos
    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["checkin"]) &&
        !empty($_POST["checkout"]) &&
        !empty($_POST["habitacion"])
    ) {
        $numeroHabitacion = $_POST["habitacion"];
        $fechaCheckIn = date("Y-m-d", strtotime($_POST["checkin"]));
        $fechaCheckOut = date("Y-m-d", strtotime($_POST["checkout"]));
        $nombre = $_POST["nombre"];


        if (verificarDisponibilidad($conexion, $numeroHabitacion, $fechaCheckIn, $fechaCheckOut)) {
            $sql = $conexion->prepare("INSERT INTO reservas (cliente, habitacion, checkin, checkout) VALUES (?, ?, ?, ?)");
            $sql->bind_param("siss", $nombre, $numeroHabitacion, $fechaCheckIn, $fechaCheckOut);

            if ($sql->execute()) {
                echo "Reserva realizada con éxito.";
                echo '<a href="../">Aceptar</a>';
                exit();
            } else {
                echo "Error al realizar la reserva: " . $conexion->error;
            }
            $sql->close();
        } else {
            echo "La habitación está ocupada para el período seleccionado.";
            echo '<a href="../">Aceptar</a>';
        }
    } else {
        echo '<div>Error al reservar. <br> Debes rellenar todos los campos</div>';
    }
}
?>
