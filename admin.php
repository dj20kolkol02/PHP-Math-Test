<?php
session_start();
require_once 'database.php';

// Sprawdzenie, czy użytkownik jest adminem
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: index.php');
    exit;
}

// Pobranie danych użytkowników
$query = "SELECT id, login, lvl, step, isCompleted, created_at FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Panel Administratora</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Poziom</th>
                <th>Krok</th>
                <th>Ukończony</th>
                <th>Data Utworzenia</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['login'] ?></td>
                    <td><?= $user['lvl'] ?></td>
                    <td><?= $user['step'] ?></td>
                    <td><?= $user['isCompleted'] ? 'Tak' : 'Nie' ?></td>
                    <td><?= $user['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>    
    <a href="logout.php"><button>Wyloguj</button></a>
</body>
</html>
