
<?php

$mostrar = false;

if (isset($_POST['calcular'])) {

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];

    $materias = array("Matematicas", "Español", "Ciencias", "Sociales", "Ingles");

    $sumaGeneral = 0;

    foreach ($materias as $materia) {

        $nota1 = $_POST[$materia][0];
        $nota2 = $_POST[$materia][1];
        $nota3 = $_POST[$materia][2];

        $promedio = ($nota1 + $nota2 + $nota3) / 3;

        $promedios[$materia] = $promedio;

        $sumaGeneral = $sumaGeneral + $promedio;
    }

    $promedioGeneral = $sumaGeneral / count($materias);

    $mostrar = true;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Calificaciones de estudiantes</title>
</head>

<body>

<h1>Colegio Futuro del Saber</h1>
<h2>Registro de calificaciones</h2>

<p>Profesor: Carlos Martínez</p>

<?php if (!$mostrar) { ?>

<form method="POST">

    <h3>Datos del estudiante</h3>

    Nombre:
    <input type="text" name="nombre" required>
    <br><br>

    Edad:
    <input type="number" name="edad" required>
    <br><br>

    Matricula:
    <input type="text" name="matricula" required>
    <br><br>

    Curso:
    <input type="text" name="curso" required>
    <br><br>

    <h3>Calificaciones</h3>

    <table border="1" cellpadding="8">

        <tr>
            <th>Asignatura</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Nota 3</th>
        </tr>

        <?php foreach ($materias = array("Matematicas", "Español", "Ciencias", "Sociales", "Ingles") as $materia) { ?>

        <tr>
            <td><?php echo $materia; ?></td>

            <td>
                <input type="number" name="<?php echo $materia; ?>[]" min="0" max="100" step="0.01" required>
            </td>

            <td>
                <input type="number" name="<?php echo $materia; ?>[]" min="0" max="100" step="0.01" required>
            </td>

            <td>
                <input type="number" name="<?php echo $materia; ?>[]" min="0" max="100" step="0.01" required>
            </td>
        </tr>

        <?php } ?>

    </table>

    <br>

    <input type="submit" name="calcular" value="Calcular notas">

</form>

<?php } ?>

<?php if ($mostrar) { ?>

    <h2>Resultados del estudiante</h2>

    <p>Nombre: <?php echo htmlspecialchars($nombre); ?></p>
    <p>Edad: <?php echo htmlspecialchars($edad); ?></p>
    <p>Matricula: <?php echo htmlspecialchars($matricula); ?></p>
    <p>Curso: <?php echo htmlspecialchars($curso); ?></p>

    <table border="1" cellpadding="8">

        <tr>
            <th>Asignatura</th>
            <th>Promedio</th>
            <th>Estado</th>
        </tr>

        <?php foreach ($promedios as $materia => $promedio) { ?>

        <tr>
            <td><?php echo $materia; ?></td>

            <td><?php echo number_format($promedio, 2); ?></td>

            <td>
                <?php
                if ($promedio >= 70) {
                    echo "Aprobada";
                } else {
                    echo "Necesita recuperación";
                }
                ?>
            </td>
        </tr>

        <?php } ?>

    </table>

    <h3>Promedio general: <?php echo number_format($promedioGeneral, 2); ?></h3>

    <br>

    <a href="index.php">Registrar otro estudiante</a>

<?php } ?>

</body>
</html>
