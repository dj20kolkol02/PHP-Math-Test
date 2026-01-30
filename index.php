<?php
session_start();
require_once 'database.php';

// Zdefiniowanie loginu i hasła dla admina
$adminUsername = 'admin';
$adminPassword = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sprawdzanie, czy to login admina
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['user'] = $username;
        $_SESSION['isAdmin'] = true; // Ustawienie flagi admina
        header('Location: admin.php'); // Przekierowanie na stronę admina
        exit;
    }

    // Logika logowania standardowych użytkowników
    $query = "SELECT login, pass, lvl, step, isCompleted FROM users WHERE login = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['pass'])) {
            $_SESSION['user'] = $username;

            if ($user['isCompleted'] == 1) {
                header('Location: certificate.php');
                exit;
            }

            $_SESSION['step'] = $user['step'];

            switch ($user['lvl']) {
                case 1:
                    $_SESSION['option'] = 'cube';
                    break;
                case 2:
                    $_SESSION['option'] = 'roller';
                    break;
                case 3:
                    $_SESSION['option'] = 'cone';
                    break;
                default:
                    $error = 'Została wybrana nieprawidłowa opcja!';
                    header('Location: index.php');
                    exit;
            }

            header('Location: step' . $_SESSION['step'] . '.php');
            exit;
        } else {
            $error = 'Nieprawidłowe hasło!';
        }
    } else {
        $error = 'Nie znaleziono użytkownika!';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #333;
        }
        label {
            font-size: 0.9em;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Zaloguj się</h1>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php">
            <label for="username">Login:</label>
            <input type="text" id="username" name="username" placeholder="Wprowadź login" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" placeholder="Wprowadź hasło" required>
            <button type="submit">Zaloguj</button>
        </form>
    </div>
</body>
</html>
