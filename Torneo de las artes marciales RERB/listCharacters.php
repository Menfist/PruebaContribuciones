<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Obtener el ID del usuario logueado
$user_id = $_SESSION['user_id'];

// Obtener los personajes asociados al usuario
$query = $pdo->prepare("SELECT * FROM characters WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$characters = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Lista de Personajes</title>
</head>
<body>
    <div class="characters-list-container">
        <h1>Personajes Creados</h1>

        <?php if (count($characters) > 0): ?>
            <ul>
                <?php foreach ($characters as $character): ?>
                    <li>
                        <p><strong>Nombre:</strong> <?php echo $character['name']; ?></p>
                        <p><strong>Nivel:</strong> <?php echo $character['level']; ?></p>
                        <form action="characterDetails.php" method="get">
                            <input type="hidden" name="character_id" value="<?php echo $character['id']; ?>">
                            <button type="submit">Detalles</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No has creado ningún personaje todavía.</p>
        <?php endif; ?>

        <!-- Botón para regresar al dashboard principal -->
        <form action="dashboardCharacters.php" method="get">
            <button type="submit">Regresar</button>
        </form>
    </div>
</body>
</html>