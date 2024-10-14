<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Obtener el ID del usuario logueado
$user_id = $_SESSION['user_id'];

// Obtener los datos del personaje del usuario
$query = $pdo->prepare("SELECT * FROM characters WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$character = $query->fetch();

if (!$character) {
    echo "No tienes ningún personaje creado.";
    exit();
}

// Función de entrenamiento para aumentar atributos
if (isset($_POST['train'])) {
    $strengthGain = rand(1, 5);
    $speedGain = rand(1, 5);
    $enduranceGain = rand(1, 5);

    // Actualizar los atributos del personaje
    $query = $pdo->prepare("
        UPDATE characters 
        SET strength = strength + :strength, speed = speed + :speed, endurance = endurance + :endurance
        WHERE user_id = :user_id
    ");
    $query->execute([
        'strength' => $strengthGain,
        'speed' => $speedGain,
        'endurance' => $enduranceGain,
        'user_id' => $user_id
    ]);

    // Recargar los datos del personaje después de entrenar
    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard - Torneo de Artes Marciales</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bienvenido al Torneo de Artes Marciales</h1>
        <h2>Tu personaje</h2>

        <!-- Mostrar los detalles del personaje -->
        <div class="character-info">
            <img src="avatars/<?php echo $character['avatar']; ?>" alt="Avatar de personaje" width="100">
            <p><strong>Nombre:</strong> <?php echo $character['name']; ?></p>
            <p><strong>Raza:</strong> <?php echo $character['race']; ?></p>
            <p><strong>Nivel:</strong> <?php echo $character['level']; ?></p>
            <p><strong>Fuerza:</strong> <?php echo $character['strength']; ?></p>
            <p><strong>Velocidad:</strong> <?php echo $character['speed']; ?></p>
            <p><strong>Resistencia:</strong> <?php echo $character['endurance']; ?></p>
        </div>

        <!-- Botón para entrenar el personaje -->
        <form method="POST">
            <button type="submit" name="train">Entrenar</button>
        </form>

        <!-- Cerrar sesión -->
        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>
</body>
</html>