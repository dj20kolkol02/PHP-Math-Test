<?php
    session_start();
    require_once 'functions.php';

    if (!isset($_SESSION['option']) || (!isset($_POST['geometry']) && !isset($_SESSION['geometry']))) {
        header('Location: index.php');
        exit;
    }

    $_SESSION['step'] = 3;
    updateUserStep();

    $a = $_POST['a'] ?? 2;
    $r = $_POST['r'] ?? 2;
    $h = $_POST['h'] ?? 2;

    switch ($_SESSION['option']) {
        case 'cube':
            if (!isset($a)) {
                header('Location: index.php');
                exit;
            }

            $area = 6 * pow($a, 2);
            $volume = pow($a, 3);
            break;
        case 'roller':
            if (!isset($r) || !isset($h)) {
                header('Location: index.php');
                exit;
            }

            $area = 2 * M_PI * $r * ($r + $h);
            $volume = M_PI * pow($r, 2) * $h;
            break;
        case 'cone':
            if (!isset($r) || !isset($h)) {
                header('Location: index.php');
                exit;
            }

            $l = sqrt(pow($r, 2) + pow($h, 2));

            $area = M_PI * $r * ($r + $l);
            $volume = (1/3) * M_PI * pow($r, 2) * $h;
            break;
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 3 - Wyniki</title>
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
        p {
            font-size: 1em;
            color: #555;
            margin-bottom: 10px;
        }
        .result {
            background-color: #eef;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 1.2em;
            color: #333;
            border: 1px solid #ccd;
        }
        .action-buttons {
            margin-top: 20px;
        }
        .action-buttons a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .next {
            background-color: #4CAF50;
            color: white;
        }
        .next:hover {
            background-color: #45a049;
        }
        .logout {
            background-color: #e74c3c;
            color: white;
        }
        .logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $_SESSION['geometry'][$_SESSION['option']]['name'] ?></h1>
        <p>Poniżej znajdują się wyniki obliczeń dla podanych wymiarów:</p>
        <div class="result">
            <strong>Pole powierzchni całkowitej:</strong> <?= number_format($area, 2) ?> jednostek kwadratowych
        </div>
        <div class="result">
            <strong>Objętość:</strong> <?= number_format($volume, 2) ?> jednostek sześciennych
        </div>
        <div class="action-buttons">
            <a href="step4.php" class="next">Dalej</a>
            <a href="logout.php" class="logout">Wyloguj</a>
        </div>
    </div>
</body>
</html>
