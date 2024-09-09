<?php
require 'db_connection.php'; // Incluye el archivo de conexión a la base de datos

// Consulta avanzada para obtener hoteles con más de dos reservas asignadas
$sql = "
    SELECT HOTEL.id_hotel, HOTEL.nombre, HOTEL.ubicación, COUNT(RESERVA.id_reserva) as num_reservas
    FROM HOTEL
    JOIN RESERVA ON HOTEL.id_hotel = RESERVA.id_hotel
    GROUP BY HOTEL.id_hotel, HOTEL.nombre, HOTEL.ubicación
    HAVING num_reservas > 2;
";

$result = $conn->query($sql);

echo "<h2>Hoteles con más de dos reservas</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Hotel</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Número de Reservas</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_hotel']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['ubicación']}</td>
                <td>{$row['num_reservas']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay hoteles con más de dos reservas.";
}

// Cerrar conexión
$conn->close();
?>
