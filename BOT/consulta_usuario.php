<?php
$host = "sql10.freesqldatabase.com";
$database = "sql10783504";
$user = "sql10783504";
$password = "L6nKgqLfsq"; // Reemplaza con tu contraseña real

header('Content-Type: application/json');

// Obtener la cédula desde la URL
$cedula = $_GET['cedula'];

$conn = new mysqli($host, $user, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    echo json_encode(["error" => "Conexión fallida: " . $conn->connect_error]);
    exit();
}

// Consulta a la tabla actualizada
$sql = "SELECT cedula, nombre_completos, celular, correo FROM consulta_usuario WHERE cedula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cedula);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["mensaje" => "Usuario no encontrado"]);
}

$stmt->close();
$conn->close();
?>

