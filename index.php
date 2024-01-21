<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="reserva">
        <form class="formulario_reserva" method="post" enctype="multipart/form-data" action="controllers/reservas.php">
            <div class="contenedor">
                <label for="nombre">NOMBRE Y APELLIDO</label>
                <input id="nombre" name="nombre" type="text">
            </div>
            <div class="contenedor">
                <label for="check-in">FECHA DE CHECK-IN</label>
                <input id="checkin" name="checkin" type="date">
            </div>
            <div class="contenedor">
                <label for="check-out">FECHA DE CHECK-OUT</label>
                <input id="checkout" name="checkout" type="date">
            </div>
            <div class="contenedor">
                <label for="habitacion">N° HABITACION</label>
                <input id="habitacion" name="habitacion" min="1" max="30" type="number">
            </div>
            <div class="contenedor btn-container">
                <input class="btn" type="submit" name="btnreservar" value="Realizar Reserva">
            </div>
            
        </form>
        <div class="lista">
            <table>
                <thead>
                    <tr>
                        <th >CLIENTE</th>
                        <th >N° DE HABITACION</th>
                        <th >FECHA DE CHECK-IN</th>
                        <th >FECHA DE CHECK-OUT</th>
                    </tr>
                </thead>
                <?php require "controllers/mostrarReservas.php"; ?>
            </table>
        </div>
</body>
</html>
