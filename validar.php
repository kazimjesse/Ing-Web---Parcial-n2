<?php
require "db.php";

$db = new Database();
$conn = $db->conectar();

// Validaciones básicas
$nombre = ucfirst(strtolower(trim($_POST['nombre'])));
$apellido = ucfirst(strtolower(trim($_POST['apellido'])));
$edad = intval($_POST['edad']);
$sexo = $_POST['sexo'];
$pais_residente = $_POST["pais_residente"];
$nacionalidad = intval($_POST['nacionalidad']);
$correo = trim($_POST['correo']);
$telefono = trim($_POST['celular']);
$temas = isset($_POST['temas']) ? $_POST['temas'] : [];
$observaciones = $_POST["observaciones"] ?? null;
$fecha_registro = date("Y-m-d H:i:s");

// Guardar datos
$data = [
    ":Nombre" => $nombre,
    ":Apellido" => $apellido,
    ":Edad" => $edad,
    ":Sexo" => $sexo,
    ":Pais_Residente" => $pais_residente,
    ":Nacionalidad" => $nacionalidad,
    ":Correo" => $correo,
    ":Telefono" => $telefono,
    ":Observaciones" => $observaciones,
    ":Fecha_Registro" => $fecha_registro
];

$id = $db->guardarInscriptor($data);

// Guardar temas
if (!empty($temas)) {
    $db->guardarTemas($id, $temas);
}

header("Location: index.php?success=1");
exit;
