<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета студента</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #f5f7fa, #c3cfe2); margin:0; padding:20px; }
        .container { max-width: 700px; margin:40px auto; background:white; padding:30px 40px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.1); }
        h1 { text-align:center; color:#333; }
        label { display:block; margin:15px 0 5px; font-weight:bold; color:#444; }
        input[type="text"], input[type="tel"], input[type="email"], input[type="date"], textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; box-sizing:border-box; }
        .radio-group, .checkbox-group { display:flex; flex-wrap:wrap; gap:15px; margin:10px 0; }
        button { background:#4CAF50; color:white; padding:12px 30px; border:none; border-radius:6px; font-size:16px; cursor:pointer; margin-top:20px; }
        button:hover { background:#45a049; }
        .error { color:red; margin-top:5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>ЗАДАНИЕ 3 — Анкета</h1>
        
        <form action="save.php" method="POST">
            <label for="fio">1. ФИО:</label>
            <input type="text" id="fio" name="fio" maxlength="150" required>

            <label for="phone">2. Телефон:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">3. e-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="birthdate">4. Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label>5. Пол:</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Мужской" required> Мужской</label>
                <label><input type="radio" name="gender" value="Женский"> Женский</label>
            </div>

            <label>6. Любимый язык программирования (можно несколько):</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="languages[]" value="Pascal"> Pascal</label>
                <label><input type="checkbox" name="languages[]" value="C"> C</label>
                <label><input type="checkbox" name="languages[]" value="C++"> C++</label>
                <label><input type="checkbox" name="languages[]" value="JavaScript"> JavaScript</label>
                <label><input type="checkbox" name="languages[]" value="PHP"> PHP</label>
                <label><input type="checkbox" name="languages[]" value="Python"> Python</label>
                <label><input type="checkbox" name="languages[]" value="Java"> Java</label>
                <label><input type="checkbox" name="languages[]" value="Haskell"> Haskell</label>
                <label><input type="checkbox" name="languages[]" value="Clojure"> Clojure</label>
                <label><input type="checkbox" name="languages[]" value="Prolog"> Prolog</label>
                <label><input type="checkbox" name="languages[]" value="Scala"> Scala</label>
                <label><input type="checkbox" name="languages[]" value="Go"> Go</label>
            </div>

            <label for="bio">7. Биография:</label>
            <textarea id="bio" name="bio" rows="6" required></textarea>

            <label>
                <input type="checkbox" name="contract" value="1" required>
                8. С контрактом ознакомлен(а)
            </label>

            <button type="submit">Сохранить</button>
        </form>
    </div>
</body>
</html>
