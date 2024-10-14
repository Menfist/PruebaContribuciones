<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Obtener el ID del personaje seleccionado
$character_id = $_GET['character_id'];

// Obtener los detalles del personaje
$query = $pdo->prepare("SELECT * FROM characters WHERE id = :character_id AND user_id = :user_id");
$query->execute(['character_id' => $character_id, 'user_id' => $_SESSION['user_id']]);
$character = $query->fetch();

if (!$character) {
    echo "Personaje no encontrado.";
    exit();
}

// Obtener las transformaciones desbloqueadas del personaje
$query = $pdo->prepare("
    SELECT t.name 
    FROM transformations t
    JOIN character_transformations ct ON t.id = ct.transformation_id
    WHERE ct.character_id = :character_id
");
$query->execute(['character_id' => $character_id]);
$unlocked_transformations = $query->fetchAll(PDO::FETCH_COLUMN);

// Obtener todas las transformaciones que el personaje podría desbloquear
$query = $pdo->prepare("
    SELECT * 
    FROM transformations
    WHERE level_required <= :level
    AND id NOT IN (
        SELECT transformation_id FROM character_transformations WHERE character_id = :character_id
    )
");
$query->execute(['level' => $character['level'], 'character_id' => $character_id]);
$available_transformations = $query->fetchAll();

// Desbloquear las transformaciones cuando se alcanza el nivel requerido
if (isset($_POST['unlock_transformation'])) {
    $transformation_id = $_POST['unlock_transformation'];
    
    // Insertar la nueva transformación en la tabla character_transformations
    $query = $pdo->prepare("
        INSERT INTO character_transformations (character_id, transformation_id)
        VALUES (:character_id, :transformation_id)
    ");
    $query->execute(['character_id' => $character_id, 'transformation_id' => $transformation_id]);

    // Recargar la página para mostrar las transformaciones actualizadas
    header("Location: characterDetails.php?character_id=$character_id");
    exit();
}

// Función para entrenar al personaje (aumentar atributos)
if (isset($_POST['train'])) {
    $strengthGain = rand(1, 5);
    $speedGain = rand(1, 5);
    $enduranceGain = rand(1, 5);

    //Incremento de nivel
    $levelUp = $character['level'] + 1;

    $query = $pdo->prepare("
        UPDATE characters 
        SET strength = strength + :strength, speed = speed + :speed, endurance = endurance + :endurance,level = :level
        WHERE id = :character_id
    ");
    $query->execute([
        'strength' => $strengthGain,
        'speed' => $speedGain,
        'endurance' => $enduranceGain,
        'level' => $levelUp,
        'character_id' => $character_id
    ]);

    // Recargar los detalles del personaje después del entrenamiento
    header("Location: characterDetails.php?character_id=$character_id");
    exit();
}

// Función para eliminar el personaje
if (isset($_POST['delete'])) {
    //Eliminar de la tabla referenciada
    $query = $pdo->prepare("DELETE FROM character_transformations WHERE character_id = :character_id");
    $query->execute(['character_id' => $character_id]);

    $query = $pdo->prepare("DELETE FROM characters WHERE id = :character_id AND user_id = :user_id");
    $query->execute(['character_id' => $character_id, 'user_id' => $_SESSION['user_id']]);

    // Redirigir a la lista de personajes después de eliminar
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
    <title>Detalles del Personaje</title>
</head>
<body>
    <div class="character-details-container">
        <h1>Detalles del Personaje</h1>

        <img src="avatars/<?php echo $character['avatar']; ?>" alt="Avatar de personaje" width="100">
        <p><strong>Nombre:</strong> <?php echo $character['name']; ?></p>
        <p><strong>Raza:</strong> <?php echo $character['race']; ?></p>
        <p><strong>Nivel:</strong> <?php echo $character['level']; ?></p>
        <p><strong>Fuerza:</strong> <?php echo $character['strength']; ?></p>
        <p><strong>Velocidad:</strong> <?php echo $character['speed']; ?></p>
        <p><strong>Resistencia:</strong> <?php echo $character['endurance']; ?></p>

        <h2>Transformaciones Desbloqueadas</h2>
        <?php if (count($unlocked_transformations) > 0): ?>
            <ul>
                <?php foreach ($unlocked_transformations as $transformation): ?>
                    <li><?php echo $transformation; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No has desbloqueado ninguna transformación aún.</p>
        <?php endif; ?>

        <h2>Transformaciones Disponibles</h2>
        <?php if (count($available_transformations) > 0): ?>
            <form method="POST">
                <ul>
                    <?php foreach ($available_transformations as $transformation): ?>
                        <li>
                            <?php echo $transformation['name']; ?> (Requiere nivel <?php echo $transformation['level_required']; ?>)
                            <button type="submit" id="transformation_id" name="unlock_transformation" value="<?php echo $transformation['id']; ?>">Desbloquear</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        <?php else: ?>
            <p>No tienes transformaciones disponibles para desbloquear.</p>
        <?php endif; ?>

        <!-- Formulario para entrenar al personaje -->
        <form method="POST" style="display:inline;">
            <button type="submit" name="train">Entrenar Personaje</button>
        </form>

        <!-- Formulario para eliminar el personaje -->
        <form method="POST" style="display:inline;">
            <button type="submit" name="delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este personaje?');">Eliminar Personaje</button>
        </form>

        <!-- Botón para regresar a la lista de personajes -->
        <form action="listCharacters.php" method="get">
            <button type="submit">Regresar a la Lista de Personajes</button>
        </form>
    </div>
</body>
</html>