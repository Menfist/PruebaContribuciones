<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
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
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Estilos del contenedor principal */
        .dashboard-container {
            width: 80%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-items: center;
        }

        /* Estilos de las fichas */
        .card {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin: 10px 0;
        }

        .card p {
            color: #666;
        }

        /* Botón en cada ficha */
        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #0056b3;
        }

        /* Ajustes para dispositivos pequeños */
        @media (max-width: 600px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- Ficha de Perfil de Personaje -->
    <div class="card">
        <h3>Perfil de Personajes</h3>
        <p>Gestiona tu personaje, entrena y mejora tus atributos.</p>
        <a href="dashboardCharacters.php">Ver Perfil</a>
    </div>

    <!-- Ficha de Torneos del Dragón -->
    <div class="card">
        <h3>Torneos del Dragón</h3>
        <p>Participa en torneos épicos y enfrenta a otros guerreros.</p>
        <a href="dashboardTournaments.php">Ver Torneos</a>
    </div>

    <!-- Ficha de Tabla de Clasificaciones -->
    <div class="card">
        <h3>Tabla de Clasificaciones</h3>
        <p>Consulta la lista de los guerreros más poderosos.</p>
        <a href="leaderboard.php">Ver Clasificaciones</a>
    </div>

    <!-- Ficha de Cerrar Sesión -->
    <div class="card">
        <h3>Cerrar Sesión</h3>
        <p>Sal de la aplicación y vuelve más tarde.</p>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</div>

</body>
</html>