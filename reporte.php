<?php
require "db.php";
$db = new Database();
$conn = $db->conectar();

// Consultar formularios
$sql = "SELECT i.ID, i.Nombre, i.Apellido, i.Edad, i.Sexo,
               p1.Nombre AS Pais,
               p2.Nombre AS Nacionalidad,
               i.Correo, i.Telefono, i.Fecha_Registro,
               i.Observaciones
        FROM inscriptor i
        INNER JOIN pais p1 ON i.Pais_Residente = p1.ID
        INNER JOIN pais p2 ON i.Nacionalidad = p2.ID
        ORDER BY i.ID DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$formularios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para temas
$sqlTemas = "SELECT t.Nombre 
             FROM `inscriptor-tema` ft
             INNER JOIN temas t ON ft.ID_Tema = t.ID
             WHERE ft.ID_Inscriptor = :id";

$stmtTemas = $conn->prepare($sqlTemas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Formularios</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<h2>Reporte de Formularios Registrados</h2>

<table class="tabla-reporte">
    <tr>
        <th>ID</th>
        <th>Nombre Completo</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>País</th>
        <th>Nacionalidad</th>
        <th>Correo</th>
        <th>Celular</th>
        <th>Temas</th>
        <th>Observaciones</th>
        <th>Fecha Registro</th>
    </tr>

    <?php foreach ($formularios as $f): ?>
    <tr>
        <td><?= $f['ID'] ?></td>
        <td><?= $f['Nombre'] . " " . $f['Apellido'] ?></td>
        <td><?= $f['Edad'] ?></td>
        <td><?= $f['Sexo'] ?></td>
        <td><?= $f['Pais'] ?></td>
        <td><?= $f['Nacionalidad'] ?></td>
        <td><?= $f['Correo'] ?></td>
        <td><?= $f['Telefono'] ?></td>

        <td>
            <?php
            $stmtTemas->execute([':id' => $f['ID']]);
            $temas = $stmtTemas->fetchAll(PDO::FETCH_COLUMN);

            if ($temas) {
                echo "<ul>";
                foreach ($temas as $t) {
                    echo "<li>" . htmlspecialchars($t) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "N/A";
            }
            ?>
        </td>

        <td><?= nl2br(htmlspecialchars($f['Observaciones'])) ?></td>
        <td><?= date("d/m/Y H:i", strtotime($f['Fecha_Registro'])) ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<footer>
    © <?= date("Y") ?> iTECH. All rights reserved.
</footer>

</body>
</html>
