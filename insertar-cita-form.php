<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cita - PsicoVida</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container">
        <h2 class="w3-text-blue">Insertar nueva cita</h2>
        <form action="php/insertar-cita.php" method="POST" class="w3-container">
            <label for="paciente" class="w3-text-blue">Nombre del paciente:</label><br>
            <select id="paciente" name="paciente" class="w3-select w3-border" required>
                <option value="" disabled selected>Selecciona el paciente</option>
                <?php
                include 'php/vars.php';

                try {
                    $conex = new PDO("sqlite:" . $nombre_fichero);
                    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para obtener los nombres de los pacientes
                    $stmt = $conex->query("SELECT nombre FROM pacientes");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                    }
                } catch(PDOException $exc) {
                    echo "Error al conectar con la base de datos: " . $exc->getMessage();
                }
                ?>
            </select><br><br>
            <label for="fecha" class="w3-text-blue">Fecha:</label><br>
            <input type="date" id="fecha" name="fecha" class="w3-input w3-border" required><br>
            <label for="hora" class="w3-text-blue">Hora:</label><br>
            <input type="time" id="hora" name="hora" class="w3-input w3-border" required><br>
            <label for="psicologo" class="w3-text-blue">Psicólogo:</label><br>
            <select id="psicologo" name="psicologo" class="w3-select w3-border" required>
                <option value="" disabled selected>Selecciona el psicólogo</option>
                <?php
                try {
                    // Consulta para obtener los nombres de los psicólogos
                    $stmt = $conex->query("SELECT nombre FROM psicologos");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                    }
                } catch(PDOException $exc) {
                    echo "Error al conectar con la base de datos: " . $exc->getMessage();
                }
                ?>
            </select><br><br>
            <label for="motivo" class="w3-text-blue">Motivo:</label><br>
            <input type="text" id="motivo" name="motivo" class="w3-input w3-border" required><br><br>
            <button type="submit" class="w3-button w3-blue">Enviar</button>
        </form>
    </div>
</body>
</html>
