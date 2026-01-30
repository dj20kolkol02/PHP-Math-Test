<?php
    require_once 'database.php';

    function updateUserStep() {
        global $conn;

        if (!isset($_SESSION['user']) || !isset($_SESSION['step'])) {
            session_start();
            session_destroy();
            header('Location: index.php');
            return;
        }

        $username = $_SESSION['user'];
        $step = $_SESSION['step'];

        $query = "SELECT login, lvl, step, isCompleted FROM users WHERE login = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            header('Location: index.php');
            exit;
        }
    
        $user = $result->fetch_assoc();

        if ($step == 5) {
            switch ($user['lvl']) {
                case 1:
                    $_SESSION['step'] = 1;
                    $newStep = 1;
                    $newLvl = 2;
                    $_SESSION['option'] = 'roller';
                    break;
                case 2:
                    $_SESSION['step'] = 1;
                    $newStep = 1;
                    $newLvl = 3;
                    $_SESSION['option'] = 'cone';
                    break;
                case 3:
                    $isCompleted = 1;
                    header('Location: certificate.php');
                    break;
                default:
                    header('Location: index.php');
                    exit;
            }
    
            $updateQuery = "UPDATE users SET step = ?, lvl = ?, isCompleted = ? WHERE login = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('iiis', $newStep, $newLvl, $isCompleted, $user['login']);
            $updateStmt->execute();
        } else {
            $newStep = $_SESSION['step'];
            $updateQuery = "UPDATE users SET step = ? WHERE login = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('is', $newStep, $user['login']);
            $updateStmt->execute();
        }
    }

    $imgPath = './img/';
    $geometry = [
        'cube' => [
            'name' => 'Sześcian',
            'desc' => 'Sześcian to szczególny rodzaj prostopadłościanu, który ma wszystkie krawędzie tej samej długości. Składa się z 6 ścian, z których każda jest kwadratem. Ma 12 krawędzi, wszystkie równej długości, oraz 8 wierzchołków. Wzór na pole powierzchni sześcianu to: 𝑃 = 6⋅𝑎2 P=6⋅a 2 , gdzie 𝑎 a to długość krawędzi.',
            'src' => $imgPath . 'szesc.png'
        ],
        'roller' => [
            'name' => 'Walec',
            'desc' => 'Walec to bryła przestrzenna składająca się z dwóch równych, okrągłych podstaw oraz powierzchni bocznej, która po rozwinięciu ma kształt prostokąta. Ma 2 podstawy, 1 powierzchnię boczną oraz 2 krawędzie wyznaczone przez obwody podstaw.

Wzory dotyczące walca:

Pole powierzchni walca: 
𝑃
=
2
⋅
𝜋
⋅
𝑟
⋅
(
𝑟
+
ℎ
)
P=2⋅π⋅r⋅(r+h), gdzie:
𝜋
π ≈ 3.14,
𝑟
r to promień podstawy,
ℎ
h to wysokość walca.
Objętość walca: 
𝑉
=
𝜋
⋅
𝑟
2
⋅
ℎ
V=π⋅r 
2
 ⋅h, gdzie:
𝜋
π ≈ 3.14,
𝑟
r to promień podstawy,
ℎ
h to wysokość walca.',
            'src' => $imgPath . 'walec.png'
        ],
        'cone' => [
            'name' => 'Stożek',
            'desc' => 'Stożek to bryła geometryczna, której podstawa jest okręgiem, a powierzchnia boczna zwęża się do jednego punktu nazywanego wierzchołkiem. Stożek posiada jedną podstawę, powierzchnię boczną w kształcie wycinka koła oraz jeden wierzchołek poza podstawą. Wzory dotyczące stożka: Pole powierzchni stożka: 𝑃 = 𝑃𝑝 + 𝑃𝑏 P=Pp+Pb , gdzie:

𝑃
𝑝
=
𝜋
⋅
𝑟
2
P 
p
​
 =π⋅r 
2
  to pole podstawy,
𝑃
𝑏
=
𝜋
⋅
𝑟
⋅
𝑙
P 
b
​
 =π⋅r⋅l to pole powierzchni bocznej,
𝑙
=
𝑟
2
+
ℎ
2
l= 
r 
2
 +h 
2
 
​
  to długość tworzącej,
𝑟
r to promień podstawy,
ℎ
h to wysokość stożka,
𝜋
π ≈ 3.14.
Objętość stożka:
𝑉
=
1
3
⋅
𝜋
⋅
𝑟
2
⋅
ℎ
V= 
3
1
​
 ⋅π⋅r 
2
 ⋅h, gdzie:

𝑟
r to promień podstawy,
ℎ
h to wysokość stożka,
𝜋
π ≈ 3.14.',
            'src' => $imgPath . 'stozek.png'
        ]
    ];

    $_SESSION['geometry'] = $geometry;
?>
