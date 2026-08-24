<?php
// ---------- НАСТРОЙКИ (легко менять) ----------
$requireCode = true;   // true = запрашивать код, false = без кода
$accessCode = '202606';  // верный код (измени на свой)
// ---------------------------------------------

$file = __DIR__ . '/data/latest.html';
if (!file_exists($file)) {
    die('<h2 style="text-align:center;margin-top:80px;color:#555;">Результаты ещё не опубликованы</h2>');
}

$cookieName = 'race_auth';
$cookieHash = md5($accessCode);
$authorized = false;

if ($requireCode) {
    if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] === $cookieHash) {
        $authorized = true;
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
        if ($_POST['code'] === $accessCode) {
            setcookie($cookieName, $cookieHash, time() + 8 * 3600, '/');
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = 'Неверный код';
        }
    }
} else {
    $authorized = true;
}

// Если требуется код и пользователь не авторизован — показываем форму
if ($requireCode && !$authorized) {
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <title>Доступ</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
                background: #f5f5f5;
            }
            .login-form {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                text-align: center;
            }
            input[type=password] {
                padding: 10px;
                width: 200px;
                font-size: 16px;
                margin-bottom: 10px;
            }
            button {
                padding: 10px 20px;
                font-size: 16px;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .error { color: red; margin-bottom: 10px; }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h3>Введите код доступа</h3>
            <?php if (isset($error)) echo '<div class="error">' . $error . '</div>'; ?>
            <form method="POST">
                <input type="password" name="code" placeholder="Код" autofocus>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// ---------- Основная страница (код принят или отключён) ----------
$html = file_get_contents($file);
$lastModified = date('d.m.Y H:i:s', filemtime($file));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- Изменённый viewport: начальный масштаб 0.5 -->
    <meta name="viewport" content="width=device-width, initial-scale=0.3, user-scalable=yes, maximum-scale=5.0">
    <title>Результаты</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: white;   /* Был серый #f5f5f5 — теперь белый, чтобы при зуме не было серых полос */
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 5px 10px;
            background: #fff;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
            color: #555;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 30px;
        }
        .content {
            margin-top: 35px;
            padding: 10px;
            background: white;
        }
        .content table {
            width: auto;
            max-width: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="last-update" id="time">Обновлено: <?= $lastModified ?></div>
    </div>
    <div class="content" id="content"><?= $html ?></div>

    <script>
        let lastTime = "<?= $lastModified ?>";
        const contentDiv = document.getElementById('content');

        // Удаление артефактов Excel
        function cleanExcelArtifacts(container) {
            const images = container.querySelectorAll('img');
            images.forEach(img => {
                if (img.src.includes('image001.png') ||
                    img.alt.includes('Кнопка') ||
                    img.classList.contains('shape')) {
                    img.style.display = 'none';
                }
            });

            const shapes = container.querySelectorAll('[v\\:shapes], .shape');
            shapes.forEach(el => el.style.display = 'none');
        }

        // Первичная очистка после загрузки страницы
        cleanExcelArtifacts(contentDiv);

        // Автообновление раз в 15 секунд
        function checkUpdate() {
            fetch('./get_last_modified.php')
                .then(r => r.text())
                .then(time => {
                    if (time && time !== lastTime) {
                        lastTime = time;
                        document.getElementById('time').textContent = 'Обновлено: ' + time;
                        // Загружаем свежий HTML и вставляем в контейнер
                        fetch('./data/latest.html?t=' + Date.now())
                            .then(r => r.text())
                            .then(html => {
                                contentDiv.innerHTML = html;
                                cleanExcelArtifacts(contentDiv);
                            })
                            .catch(() => {});
                    }
                })
                .catch(() => {});
        }

        setInterval(checkUpdate, 15000);
    </script>
</body>
</html>