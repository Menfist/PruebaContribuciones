<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Procesar la creación de un nuevo personaje
if (isset($_POST['add_character'])) {
    $name = $_POST['name'];
    $race = $_POST['race'];
    $avatar = $_POST['avatar']; // Avatar generado o elegido por el estudiante

    $user_id = $_SESSION['user_id'];

    // Insertar el nuevo personaje en la base de datos
    $query = $pdo->prepare("
        INSERT INTO characters (user_id, name, race, avatar, strength, speed, endurance, level, experience)
        VALUES (:user_id, :name, :race, :avatar, 50, 50, 50, 1, 0)
    ");
    $query->execute([
        'user_id' => $user_id,
        'name' => $name,
        'race' => $race,
        'avatar' => $avatar
    ]);

    // Redirigir a la lista de personajes
    header('Location: listCharacters.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Crear Personaje</title>
    <script src="random.js" defer></script>
</head>
<body>
    <div class="create-character-container">
        <h1>Crear un Nuevo Personaje</h1>
        <form method="POST">
            <label for="name">Nombre del personaje:</label>
            <input type="text" id="name" name="name" required>

            <label for="race">Raza:</label>
            <select id="race" name="race">
                <option value="Saiyan">Saiyan</option>
                <option value="Namek">Namek</option>
                <option value="Humano">Humano</option>
                <option value="Freezer Race">Freezer Race</option>
                <option value="Majin">Majin</option>
            </select>

            <!-- Avatar asignado aleatoriamente -->
            <input type="hidden" id="avatar" name="avatar">
            <div class="avatar-preview" id="avatarPreview"></div>

            <button type="submit" name="add_character">Agregar Personaje</button>
        </form>

        <!-- Botón para regresar al dashboard principal -->
        <form action="dashboardCharacters.php" method="get">
            <button type="submit">Regresar</button>
        </form>
    </div>
</body>
</html>