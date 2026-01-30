<?php
    session_start();
    require_once 'functions.php';

    if (!isset($_SESSION['option'])) {
        header('Location: index.php');
        exit;
    }

    $_SESSION['step'] = 1;
    updateUserStep();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 1</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .text-section {
            flex: 1;
        }
        .image-section img {
            max-width: 300px;
            border: 2px solid #3498db;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background: #1d6fa5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-section">
            <h1><?= $_SESSION['geometry'][$_SESSION['option']]['name'] ?></h1>
            <p><?= $_SESSION['geometry'][$_SESSION['option']]['desc'] ?></p>
            <a href="step2.php">Dalej</a>
        </div>
        <div class="image-section">
            <img src="<?= $_SESSION['geometry'][$_SESSION['option']]['src'] ?>" alt="<?= $_SESSION['geometry'][$_SESSION['option']]['name'] ?>">
        </div>
    </div>
</body>
</html>