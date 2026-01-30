<?php
    session_start();
    require_once 'functions.php';

    if (!isset($_SESSION['option']) || !isset($_SESSION['geometry'])) {
        header('Location: index.php');
        exit;
    }

    $_SESSION['step'] = 2;
    updateUserStep();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 2 - Wymiary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
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
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1em;
            color: #555;
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
        <h1>Podaj wymiary: <?= $_SESSION['geometry'][$_SESSION['option']]['name'] ?></h1>
        <form action="step3.php" method="post">
            <?php
                if ($_SESSION['option'] === 'cube') {
                    echo '<label for="a">Krawędź a:</label>';
                    echo '<input type="number" id="a" name="a" placeholder="Podaj długość krawędzi" required>';
                } else {
                    echo '<label for="r">Promień r:</label>';
                    echo '<input type="number" id="r" name="r" placeholder="Podaj promień podstawy" required>';
                    echo '<label for="h">Wysokość h:</label>';
                    echo '<input type="number" id="h" name="h" placeholder="Podaj wysokość" required>';
                }
            ?>
            <button type="submit">Oblicz</button>
        </form>
        <a href="logout.php" class="logout">Wyloguj</a>
    </div>
</body>
</html>
