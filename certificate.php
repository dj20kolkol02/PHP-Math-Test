<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certyfikat</title>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .certificate {
    margin: 0 auto;
    text-align: center; /* Centruje tekst wewnątrz certyfikatu */
    width: 80%; /* Dostosuj szerokość certyfikatu */
    border: 2px solid #007bff; /* Obwódka */
    border-radius: 10px; /* Zaokrąglenie rogów */
    padding: 20px;
    background-color: #ffffff; /* Kolor tła certyfikatu */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Dodaje cień */
}
        h1 {
            color: #3498db;
            font-size: 2em;
        }
        .name {
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.5em;
            margin: 20px 0;
        }
        p {
            font-size: 1em;
            color: #555;
            line-height: 1.5;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .signature div {
            text-align: center;
            color: #555;
        }
        .signature-line {
            margin: 10px auto;
            height: 2px;
            width: 100px;
            background: #3498db;
        }
        

        .logout-container {
            text-align: center;
            margin-top: 20px;
        }

        .logout-button {
            display: block;
            margin: 20px auto; /* Umieszcza przycisk na środku pod certyfikatem */
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff; /* Kolor przycisku */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
}

.logout-button:hover {
    background-color: #0056b3; /* Ciemniejszy kolor po najechaniu */
}

    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certyfikat Ukończenia</h1>
        <p>Za ukończenie szkolenia o bryłach geometrycznych</p>
        <div class="name"><?= $_SESSION['user'] ?? '[Imię i nazwisko]' ?></div>
        <p>Potwierdza zdobycie wiedzy o sześcianach, walcach i stożkach.</p>
        <div class="signature">
            <div>
                <div class="signature-line"></div>
                Instruktor
            </div>
            <div>
                <div class="signature-line"></div>
                Data wydania
            </div>
        </div>
        
    </div>
    
    <a class="logout-button" href="logout.php">Wyloguj</a>
    </div>

    
</body>

</html>
