<?php
    session_start();
    require_once 'functions.php';

    if (!isset($_SESSION['option']) || !isset($_SESSION['geometry']) || !isset($_SESSION['random_dimensions'])) {
        header('Location: index.php');
        exit;
    }

    $_SESSION['step'] = 5;

    $answerFirst = (float)$_POST['area'];
    $answerSecond = (float)$_POST['volume'];

    switch ($_SESSION['option']) {
        case 'cube':
            if (!isset($_SESSION['random_dimensions']['a'])) {
                header('Location: index.php');
                exit;
            }

            $correct_area = 6 * pow($_SESSION['random_dimensions']['a'], 2);
            $correct_volume = pow($_SESSION['random_dimensions']['a'], 3);
            break;
        case 'roller':
            if (!isset($_SESSION['random_dimensions']['r']) || !isset($_SESSION['random_dimensions']['h'])) {
                header('Location: index.php');
                exit;
            }

            $correct_area = 2 * M_PI * $_SESSION['random_dimensions']['r'] * ($_SESSION['random_dimensions']['r'] + $_SESSION['random_dimensions']['h']);
            $correct_volume = M_PI * pow($_SESSION['random_dimensions']['r'], 2) * $_SESSION['random_dimensions']['h'];
            break;
        case 'cone':
            if (!isset($_SESSION['random_dimensions']['r']) || !isset($_SESSION['random_dimensions']['h'])) {
                header('Location: index.php');
                exit;
            }

            $l = sqrt(pow($_SESSION['random_dimensions']['r'], 2) + pow($_SESSION['random_dimensions']['h'], 2));

            $correct_area = M_PI * $_SESSION['random_dimensions']['r'] * ($_SESSION['random_dimensions']['r'] + $l);
            $correct_volume = (1/3) * M_PI * pow($_SESSION['random_dimensions']['r'], 2) * $_SESSION['random_dimensions']['h'];
            break;
    }

    $check_area = abs($answerFirst - $correct_area) < 0.01;
    $check_volume = abs($answerSecond - $correct_volume) < 0.01;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 5 - Wynik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px 40px;
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
        strong {
            color: #3498db;
        }
        .result {
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.1em;
        }
        .correct {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .incorrect {
            background-color: #f2dede;
            color: #a94442;
        }
        .action-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .action-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .next {
            background-color: #4caf50;
            color: white;
        }
        .next:hover {
            background-color: #45a049;
        }
        .repeat {
            background-color: #e74c3c;
            color: white;
        }
        .repeat:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Wynik zadania</h1>
        <p><strong>Pole powierzchni:</strong></p>
        <div class="result <?= $check_area ? 'correct' : 'incorrect' ?>">
            <?= $check_area ? 'Poprawne!' : 'Niepoprawne. Prawidłowy wynik to: ' . number_format($correct_area, 2) ?>
        </div>
        <p><strong>Objętość:</strong></p>
        <div class="result <?= $check_volume ? 'correct' : 'incorrect' ?>">
            <?= $check_volume ? 'Poprawna!' : 'Niepoprawna. Prawidłowy wynik to: ' . number_format($correct_volume, 2) ?>
        </div>
        <div class="action-buttons">
            <?php 
                if ($check_area && $check_volume): 
                    updateUserStep();
            ?>
                <a href="step1.php" class="next">Następny poziom</a>
            <?php else: ?>
                <a href="step1.php" class="repeat">Powtórz poziom</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
