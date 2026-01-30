<?php
    session_start();
    require_once 'functions.php';

    if (!isset($_SESSION['option']) || !isset($_SESSION['geometry'])) {
        header('Location: index.php');
        exit;
    }

    $_SESSION['step'] = 4;
    updateUserStep();

    $random_dimensions = [
        'cube' => [
            'a' => rand(1, 10)
        ],
        'roller' => [
            'r' => rand(1, 3), 
            'h' => rand(4, 8)
        ],
        'cone' => [
            'r' => rand(1, 3), 
            'h' => rand(4, 8)
        ]
    ];

    foreach ($random_dimensions as $shape => &$dimensions) {
        $dimensions['dim'] = implode(', ', array_map(
            fn($key, $value) => "$key: $value",
            array_keys($dimensions),
            $dimensions
        ));
    }

    $_SESSION['random_dimensions'] = $random_dimensions[$_SESSION['option']];
    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 4 - Obliczenia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9fc;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 1em;
            color: #555;
            margin-bottom: 20px;
        }
        .dimensions {
            background-color: #eef;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 1.2em;
            color: #333;
            border: 1px solid #ccd;
        }
        form {
            margin-top: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .logout {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #e74c3c;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .logout:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Oblicz dla figury: <?= $_SESSION['geometry'][$_SESSION['option']]['name'] ?></h1>
        <p>Poniżej znajdują się wymiary:</p>
        <div class="dimensions">
            <?= $_SESSION['random_dimensions']['dim'] ?>
        </div>
        <form action="step5.php" method="post">
            <input type="number" name="area" placeholder="Podaj pole figury..." step="0.01" required>
            <input type="number" name="volume" placeholder="Podaj objętość figury..." step="0.01" required>
            <button type="submit">Sprawdź</button>
        </form>
        <a href="logout.php" class="logout">Wyloguj</a>
    </div>
</body>
</html>
