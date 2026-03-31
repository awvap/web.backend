<?php
// ==================== НАСТРОЙКИ БД ====================
$host = 'localhost';
$db   = 'u82309';           // ← убедись, что имя правильное
$user = 'u82309';           // ← твой логин
$pass = '8610841';                 // ← вставь свой пароль, если он есть
// ======================================================

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

// === ВАЛИДАЦИЯ ===
$errors = [];

$fio = trim($_POST['fio'] ?? '');
if (empty($fio) || !preg_match('/^[а-яА-ЯёЁa-zA-Z\s]+$/u', $fio) || strlen($fio) > 150) {
    $errors[] = "ФИО должно содержать только буквы и пробелы, не более 150 символов.";
}

$phone = trim($_POST['phone'] ?? '');
if (empty($phone)) $errors[] = "Телефон обязателен.";

$email = trim($_POST['email'] ?? '');
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некорректный e-mail.";
}

$birthdate = $_POST['birthdate'] ?? '';
if (empty($birthdate)) $errors[] = "Дата рождения обязательна.";

$gender = $_POST['gender'] ?? '';
if (!in_array($gender, ['Мужской', 'Женский'])) $errors[] = "Выберите пол.";

$languages = $_POST['languages'] ?? [];
$allowed_langs = ['Pascal','C','C++','JavaScript','PHP','Python','Java','Haskell','Clojure','Prolog','Scala','Go'];
$valid_langs = array_intersect($languages, $allowed_langs);

if (empty($valid_langs)) {
    $errors[] = "Выберите хотя бы один язык программирования из списка.";
}

$bio = trim($_POST['bio'] ?? '');
if (empty($bio)) $errors[] = "Биография обязательна.";

$contract = isset($_POST['contract']) ? 1 : 0;
if ($contract != 1) $errors[] = "Необходимо ознакомиться с контрактом.";

if (!empty($errors)) {
    echo "<h2 style='color:red;'>Ошибки заполнения:</h2><ul>";
    foreach ($errors as $err) echo "<li>$err</li>";
    echo "</ul><br><a href='index.php'>← Вернуться к форме</a>";
    exit;
}

// === СОХРАНЕНИЕ В БД ===
try {
    $stmt = $pdo->prepare("INSERT INTO users 
        (fio, phone, email, birthdate, gender, bio, contract, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$fio, $phone, $email, $birthdate, $gender, $bio, $contract]);
    $user_id = $pdo->lastInsertId();

    $stmt_lang = $pdo->prepare("INSERT INTO user_languages (user_id, language) VALUES (?, ?)");
    foreach ($valid_langs as $lang) {
        $stmt_lang->execute([$user_id, $lang]);
    }

    echo "<h2 style='color:green; text-align:center;'>✅ Данные успешно сохранены!</h2>";
    echo "<p style='text-align:center;'>ID записи: <b>$user_id</b></p>";
    echo "<p style='text-align:center;'><a href='index.php'>Заполнить ещё одну анкету →</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>Ошибка при сохранении:</h2>" . $e->getMessage();
}
?>