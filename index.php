<?php
require "db.php";
$db = new Database();
$conn = $db->conectar();

$paises = $db->getPaises();
$temas = $db->getTemas();

$anio = date("Y");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

<div class="form-container">

    <h2>Formulario de Registro</h2>

    <form action="validar.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" required>

        <label>Edad:</label>
        <input type="number" name="edad" min="1" required>

        <label>Sexo:</label>
        <div class="radio-group">
            <div>
                <input type="radio" name="sexo" value="M" required>
                <label>Masculino</label>
            </div>

            <div>
                <input type="radio" name="sexo" value="F" required>
                <label>Femenino</label>
            </div>

            <div>
                <input type="radio" name="sexo" value="NA" required>
                <label>Otro</label>
            </div>
        </div>

        <label>País de residencia:</label>
        <select name="pais_residente" required>
            <option value="">Seleccione...</option>
            <?php foreach ($paises as $pais): ?>
                <option value="<?= $pais['ID'] ?>">
                    <?= $pais['Nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Nacionalidad:</label>
        <select name="nacionalidad" required>
            <option value="">Seleccione...</option>
            <?php foreach ($paises as $pais): ?>
                <option value="<?= $pais['ID'] ?>">
                    <?= $pais['Nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Correo:</label>
        <input type="email" name="correo" required>

        <label>Celular:</label>
        <input type="text" name="celular" required>

        <label>Tema de interés:</label><br>
        <?php foreach ($temas as $t): ?>
            <input type="checkbox" name="temas[]" value="<?= $t['ID'] ?>"> <?= $t['Nombre'] ?><br>
        <?php endforeach; ?>

        <br>

        <label>Observaciones:</label>
        <textarea name="observaciones"></textarea>

        <br><br>

        <div class="botones-form">
            <button type="submit">Enviar</button>
            <a href="reporte.php" class="btn-reporte">Ver Reporte</a>
        </div>

    </form>

</div>

<footer>
    © <?= $anio ?> iTECH. All rights reserved.
</footer>

</body>
</html>