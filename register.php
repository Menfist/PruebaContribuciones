<?php
include 'db.php'; //Importar información de un archivo externo
if (isset($_POST['register'])) { //Si doy clic a un boton llamado register+
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $avatar = $_POST['avatar']; // Avatar asignado aleatoriamente

    // Comprobamos si el email ya existe
    $checkEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $checkEmail->execute(['email' => $email]);
    if ($checkEmail->rowCount() > 0) {
        $error = "El correo ya está registrado.";
    } else {
        // Insertamos el nuevo usuario
        $query = $pdo->prepare("INSERT INTO users (name, email, password, avatar) VALUES (:name, :email, :password, :avatar)");
        $query->execute(['name' => $name, 'email' => $email, 'password' => $password, 'avatar' => $avatar]);
        //echo $password."---".$_POST['password'];
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro - Torneo de Artes Marciales</title>
    <script src="random.js" defer></script>
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>
        <?php if (isset($error)):?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <!-- Avatar asignado aleatoriamente -->
            <input type="hidden" id="avatar" name="avatar">
            <div class="avatar-preview" id="avatarPreview"></div>

            <button type="submit" name="register">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>