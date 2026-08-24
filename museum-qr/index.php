<?php

/**
 * Музейная QR-система
 * PHP + SQLite3 + JS
 */

session_start();

// --- НАСТРОЙКИ ---
define('ADMIN_LOGIN', 'admin');
define('ADMIN_PASS', 'Museum_moderator_2026!'); // Обязательно измените!
define('DB_FILE', __DIR__ . '/museum.sqlite');
define('UPLOAD_DIR', __DIR__ . '/uploads');
define('BASE_URL', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . dirname($_SERVER['PHP_SELF']));

// Создаем папку для загрузок, если её нет
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0775, true);
}
// --- ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ ДЛЯ fetchAll ---
function sqlite3_fetch_all($result) {
    $rows = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $rows[] = $row;
    }
    return $rows;
}

// --- БАЗА ДАННЫХ ---
function getDb()
{
    $db = new SQLite3(DB_FILE);
    $db->exec('PRAGMA foreign_keys = ON;');

    // Инициализация таблиц
    $db->exec("
        CREATE TABLE IF NOT EXISTS items (
            id TEXT PRIMARY KEY,
            type TEXT NOT NULL,
            title TEXT DEFAULT 'Без названия',
            content TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        CREATE TABLE IF NOT EXISTS audio_tracks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            item_id TEXT,
            lang TEXT NOT NULL,
            file_path TEXT NOT NULL,
            FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE CASCADE
        );
    ");

    // Попытка добавить колонку title, если её нет
    @$db->exec("ALTER TABLE items ADD COLUMN title TEXT DEFAULT 'Без названия'");

    return $db;
}

// --- АВТОРИЗАЦИЯ ---
function checkAuth()
{
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?admin");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_action'])) {
    if ($_POST['login'] === ADMIN_LOGIN && $_POST['password'] === ADMIN_PASS) {
        $_SESSION['is_admin'] = true;
        header("Location: ?admin");
        exit;
    } else {
        $auth_error = "Неверный логин или пароль";
    }
}

// --- API (ОБРАБОТКА ДАННЫХ) ---
if (isset($_GET['api'])) {
    header('Content-Type: application/json');
    if (!checkAuth()) {
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    $db = getDb();

    try {
        $action = $_GET['api'];

        // === LIST ===
        if ($action === 'list') {
            $result = $db->query("SELECT * FROM items ORDER BY created_at DESC");
            $items = sqlite3_fetch_all($result);

            foreach ($items as &$item) {
                if ($item['type'] === 'audio') {
                    $stmt = $db->prepare("SELECT * FROM audio_tracks WHERE item_id = :item_id");
                    $stmt->bindValue(':item_id', $item['id'], SQLITE3_TEXT);
                    $trackResult = $stmt->execute();
                    $item['tracks'] = sqlite3_fetch_all($trackResult);
                }
            }

            echo json_encode($items);
            exit;
        }

        // === SAVE ===
        if ($action === 'save') {
            $id = !empty($_POST['id']) ? $_POST['id'] : uniqid();
            $type = $_POST['type'];
            $title = !empty($_POST['title']) ? $_POST['title'] : 'Без названия';
            $content = '';

            // Проверка существующего элемента
            $stmt = $db->prepare("SELECT * FROM items WHERE id = :id");
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $result = $stmt->execute();
            $existing = $result->fetchArray(SQLITE3_ASSOC);

            if ($existing && $existing['type'] !== $type) {
                if (in_array($existing['type'], ['image', 'video']) && file_exists(UPLOAD_DIR . '/' . $existing['content']) && !empty($existing['content'])) {
                    unlink(UPLOAD_DIR . '/' . $existing['content']);
                }
                if ($existing['type'] === 'audio') {
                    $stmtTracks = $db->prepare("SELECT file_path FROM audio_tracks WHERE item_id = :item_id");
                    $stmtTracks->bindValue(':item_id', $id, SQLITE3_TEXT);
                    $tracksResult = $stmtTracks->execute();
                    while ($track = $tracksResult->fetchArray(SQLITE3_ASSOC)) {
                        if (file_exists(UPLOAD_DIR . '/' . $track['file_path'])) {
                            unlink(UPLOAD_DIR . '/' . $track['file_path']);
                        }
                    }
                    $db->exec("DELETE FROM audio_tracks WHERE item_id = '" . SQLite3::escapeString($id) . "'");
                }
            }

            if ($type === 'text') {
                $content = $_POST['text_content'];
            } elseif (in_array($type, ['image', 'video'])) {
                if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION));
                    $allowedImage = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                    $allowedVideo = ['mp4', 'webm', 'ogg', 'mov', 'avi'];

                    if ($type === 'image' && !in_array($ext, $allowedImage)) throw new Exception("Недопустимый формат изображения");
                    if ($type === 'video' && !in_array($ext, $allowedVideo)) throw new Exception("Недопустимый формат видео");

                    $filename = uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['media_file']['tmp_name'], UPLOAD_DIR . '/' . $filename);
                    $content = $filename;
                } else {
                    $content = $existing['content'] ?? '';
                }
            }

            // INSERT OR REPLACE вместо ON CONFLICT для максимальной совместимости
            $stmt = $db->prepare("INSERT OR REPLACE INTO items (id, type, title, content) VALUES (:id, :type, :title, :content)");
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $stmt->bindValue(':type', $type, SQLITE3_TEXT);
            $stmt->bindValue(':title', $title, SQLITE3_TEXT);
            $stmt->bindValue(':content', $content, SQLITE3_TEXT);
            $stmt->execute();

            if ($type === 'audio') {
                $kept_files = $_POST['existing_audio'] ?? [];

                // Удаление старых файлов
                $stmtTracks = $db->prepare("SELECT file_path FROM audio_tracks WHERE item_id = :item_id");
                $stmtTracks->bindValue(':item_id', $id, SQLITE3_TEXT);
                $tracksResult = $stmtTracks->execute();
                while ($row = $tracksResult->fetchArray(SQLITE3_ASSOC)) {
                    if (!in_array($row['file_path'], $kept_files) && !empty($row['file_path']) && file_exists(UPLOAD_DIR . '/' . $row['file_path'])) {
                        unlink(UPLOAD_DIR . '/' . $row['file_path']);
                    }
                }

                $db->exec("DELETE FROM audio_tracks WHERE item_id = '" . SQLite3::escapeString($id) . "'");

                if (isset($_POST['audio_langs'])) {
                    foreach ($_POST['audio_langs'] as $index => $lang) {
                        $filepath = '';
                        if (isset($_FILES['audio_files']['name'][$index]) && $_FILES['audio_files']['error'][$index] === UPLOAD_ERR_OK) {
                            $ext = strtolower(pathinfo($_FILES['audio_files']['name'][$index], PATHINFO_EXTENSION));
                            $filename = uniqid('aud_') . '.' . $ext;
                            move_uploaded_file($_FILES['audio_files']['tmp_name'][$index], UPLOAD_DIR . '/' . $filename);
                            $filepath = $filename;
                        } elseif (isset($_POST['existing_audio'][$index]) && !empty($_POST['existing_audio'][$index])) {
                            $filepath = $_POST['existing_audio'][$index];
                        }

                        if ($filepath) {
                            $stmtInsert = $db->prepare("INSERT INTO audio_tracks (item_id, lang, file_path) VALUES (:item_id, :lang, :file_path)");
                            $stmtInsert->bindValue(':item_id', $id, SQLITE3_TEXT);
                            $stmtInsert->bindValue(':lang', $lang, SQLITE3_TEXT);
                            $stmtInsert->bindValue(':file_path', $filepath, SQLITE3_TEXT);
                            $stmtInsert->execute();
                        }
                    }
                }
            }

            echo json_encode(['success' => true, 'id' => $id]);
            exit;
        }

        // === DELETE ===
        if ($action === 'delete') {
            $id = $_POST['id'];
            $stmt = $db->prepare("SELECT type, content FROM items WHERE id = :id");
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $result = $stmt->execute();
            $item = $result->fetchArray(SQLITE3_ASSOC);

            if ($item) {
                if (in_array($item['type'], ['image', 'video']) && file_exists(UPLOAD_DIR . '/' . $item['content']) && !empty($item['content'])) {
                    unlink(UPLOAD_DIR . '/' . $item['content']);
                } elseif ($item['type'] === 'audio') {
                    $tracksStmt = $db->prepare("SELECT file_path FROM audio_tracks WHERE item_id = :item_id");
                    $tracksStmt->bindValue(':item_id', $id, SQLITE3_TEXT);
                    $tracksResult = $tracksStmt->execute();
                    while ($track = $tracksResult->fetchArray(SQLITE3_ASSOC)) {
                        if (file_exists(UPLOAD_DIR . '/' . $track['file_path'])) {
                            unlink(UPLOAD_DIR . '/' . $track['file_path']);
                        }
                    }
                }
            }

            $stmt = $db->prepare("DELETE FROM items WHERE id = :id");
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $stmt->execute();
            
            echo json_encode(['success' => true]);
            exit;
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// --- ПУБЛИЧНАЯ ЧАСТЬ (ПРОСМОТР КОНТЕНТА) ---
if (isset($_GET['id'])) {
    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM items WHERE id = :id");
    $stmt->bindValue(':id', $_GET['id'], SQLITE3_TEXT);
    $result = $stmt->execute();
    $item = $result->fetchArray(SQLITE3_ASSOC);

    if (!$item) {
        die("Контент не найден.");
    }

    $tracks = [];
    if ($item['type'] === 'audio') {
        $stmt = $db->prepare("SELECT * FROM audio_tracks WHERE item_id = :item_id");
        $stmt->bindValue(':item_id', $item['id'], SQLITE3_TEXT);
        $trackResult = $stmt->execute();
        $tracks = sqlite3_fetch_all($trackResult);
    }
?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($item['title']) ?></title>
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: system-ui, -apple-system, sans-serif;
                background: #000;
                color: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                overflow-x: hidden;
            }

            .content-text {
                background: #fff;
                color: #000;
                padding: 20px;
                width: 100%;
                min-height: 100vh;
                box-sizing: border-box;
                font-size: 18px;
                line-height: 1.6;
            }

            img.full-screen {
                width: 100vw;
                height: 100vh;
                object-fit: contain;
            }

            video.full-screen {
                width: 100vw;
                height: 100vh;
                object-fit: contain;
            }

            .audio-container {
                text-align: center;
                background: #222;
                padding: 30px;
                border-radius: 15px;
                width: 90%;
                max-width: 400px;
            }

            .lang-btn {
                display: block;
                width: 100%;
                padding: 15px;
                margin-bottom: 10px;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 18px;
                cursor: pointer;
            }

            .lang-btn:active {
                background: #0056b3;
            }

            audio {
                width: 100%;
                margin-top: 20px;
                outline: none;
            }
        </style>
    </head>

    <body>
        <?php if ($item['type'] === 'image'): ?>
            <img src="uploads/<?= htmlspecialchars($item['content']) ?>" class="full-screen" alt="Экспонат">
        <?php elseif ($item['type'] === 'video'): ?>
            <video src="uploads/<?= htmlspecialchars($item['content']) ?>" class="full-screen" controls autoplay playsinline></video>
        <?php elseif ($item['type'] === 'text'): ?>
            <div class="content-text"><?= $item['content'] ?></div>
        <?php elseif ($item['type'] === 'audio'): ?>
            <div class="audio-container">
                <h2>Аудиогид</h2>
                <div id="lang-selector">
                    <?php foreach ($tracks as $track): ?>
                        <button class="lang-btn" data-src="uploads/<?= htmlspecialchars($track['file_path']) ?>">
                            <?= htmlspecialchars($track['lang']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div id="player-container" style="display: none;">
                    <button class="lang-btn" style="background: #555; margin-bottom: 20px;" onclick="location.reload()">❮ Назад к выбору языка</button>
                    <audio id="audio-player" controls controlsList="nodownload"></audio>
                </div>
            </div>
            <script>
                document.querySelectorAll('.lang-btn[data-src]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const src = this.getAttribute('data-src');
                        document.getElementById('lang-selector').style.display = 'none';
                        document.getElementById('player-container').style.display = 'block';
                        const player = document.getElementById('audio-player');
                        player.src = src;
                        player.play();
                    });
                });
            </script>
        <?php endif; ?>
    </body>

    </html>
    <?php
    exit;
}

// --- АДМИН-ПАНЕЛЬ ---
if (isset($_GET['admin'])) {
    if (!checkAuth()) {
    ?>
        <!DOCTYPE html>
        <html lang="ru">

        <head>
            <meta charset="UTF-8">
            <title>Вход</title>
            <link href="assets/bootstrap.min.css" rel="stylesheet">
        </head>

        <body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="card p-4 shadow" style="width: 350px;">
                <h3 class="text-center mb-3">Вход модератора</h3>
                <?php if (isset($auth_error)) echo "<div class='alert alert-danger'>$auth_error</div>"; ?>
                <form method="post">
                    <input type="hidden" name="login_action" value="1">
                    <div class="mb-3"><input type="text" name="login" class="form-control" placeholder="Логин" required></div>
                    <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Пароль" required></div>
                    <button type="submit" class="btn btn-primary w-100">Войти</button>
                </form>
            </div>
        </body>

        </html>
    <?php
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Управление контентом</title>
        <link href="assets/bootstrap.min.css" rel="stylesheet">
        <script src="assets/easy.qrcode.min.js"></script>
        <script src="assets/qr-code-styling.js"></script>

        <script src="assets/jszip.min.js"></script>
        <script src="assets/FileSaver.min.js"></script>
        <style>
            .qr-preview {
                width: 100px;
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .hidden {
                display: none !important;
            }

            .preview-icon {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 8px;
                background: #e9ecef;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
            }

            .audio-track-box {
                border-left: 4px solid #0d6efd;
            }

            .qr-preview canvas,
            .qr-preview svg {
                max-width: 100%;
                max-height: 100%;
            }

            /* Фикс для SVG и Canvas */
        </style>
    </head>

    <body class="bg-light">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand">Панель управления QR</span>
                <a href="?logout=1" class="btn btn-outline-light btn-sm">Выход</a>
            </div>
        </nav>

        <div class="container mt-4">
            <div id="view-list">
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <h2>Контент музея</h2>
                    <div>
                        <button class="btn btn-success shadow-sm" onclick="downloadAllQR()">Скачать архив QR-кодов</button>
                        <button class="btn btn-primary shadow-sm" onclick="showForm()">+ Добавить</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered bg-white shadow-sm table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Превью</th>
                                <th>Название</th>
                                <th>Тип</th>
                                <th>QR-код</th>
                                <th>Ссылка</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>
            </div>

            <div id="view-form" class="hidden bg-white p-4 shadow-sm border rounded mb-5">
                <h3 id="form-title">Добавить контент</h3>
                <form id="content-form">
                    <input type="hidden" id="item-id" name="id">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Название (для администратора):</label>
                        <input type="text" class="form-control" name="title" id="item-title" placeholder="Например: Картина 'Утро в сосновом лесу'" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Тип контента:</label>
                        <select class="form-select" name="type" id="content-type" onchange="toggleFields()" required>
                            <option value="image">Изображение</option>
                            <option value="video">Видео</option>
                            <option value="text">Текст (HTML)</option>
                            <option value="audio">Аудиогид</option>
                        </select>
                    </div>

                    <div id="field-media" class="mb-3 border p-3 bg-light rounded">
                        <label class="form-label fw-bold">Файл (размер до 24 МБ):</label>
                        <input type="file" class="form-control" name="media_file" id="media_file" accept="image/*">
                        <small class="text-muted d-block mt-1">Оставьте пустым при редактировании, если не хотите менять загруженный ранее файл.</small>
                    </div>

                    <div id="field-text" class="mb-3 hidden border p-3 bg-light rounded">
                        <label class="form-label fw-bold">Текст (поддерживается HTML):</label>
                        <textarea class="form-control" name="text_content" id="text_content" rows="10"></textarea>
                    </div>

                    <div id="field-audio" class="mb-3 hidden border p-3 bg-light rounded">
                        <label class="form-label fw-bold">Аудиодорожки:</label>
                        <div id="audio-tracks-container"></div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" onclick="addAudioTrack()">+ Добавить язык</button>
                    </div>

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Сохранить</button>
                        <button type="button" class="btn btn-secondary px-4" onclick="showList()">Отмена</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // ==========================================
            // БЛОК ГЛОБАЛЬНЫХ НАСТРОЕК QR-КОДОВ
            // ==========================================
            const qrConfig = {
                // ВЫБОР ДВИЖКА: 
                // 'qr-code-styling' - современные красивые QR (рекомендуется)
                // 'easy-qrcode' - классические квадратные QR
                engine: 'qr-code-styling',

                logo: 'logo.png', // Путь к логотипу (должен лежать в папке /qr/)
                margin: 10, // Отступ вокруг QR (белая рамка)

                // ------------------------------------------
                // 1. Настройки для движка 'qr-code-styling' (Современный)
                // ------------------------------------------
                stylingOptions: {
                    // Форма точек: "rounded", "dots", "classy", "classy-rounded", "square", "extra-rounded"
                    dotType: "rounded",

                    // Цвет точек (основной) или градиент
                    dotsColor: "#000000",
                    useGradient: true, // Использовать ли градиент для точек
                    gradientColors: ["#0052cc", "#172b4d"], // Цвета градиента
                    gradientType: "linear", // "linear" или "radial"

                    // Форма угловых внешних квадратов: "dot", "square", "extra-rounded"
                    cornersSquareType: "extra-rounded",
                    cornersSquareColor: "#0052cc", // Цвет внешних квадратов

                    // Форма угловых внутренних точек: "dot", "square"
                    cornersDotType: "dot",
                    cornersDotColor: "#172b4d", // Цвет внутренних точек

                    // Настройки фона
                    backgroundColor: "#ffffff",

                    // Размер логотипа внутри QR (от 0.1 до 1)
                    logoImageSize: 0.5,
                    // Скрывать ли точки под логотипом (true/false)
                    logoHideBackgroundDots: true
                },

                // ------------------------------------------
                // 2. Настройки для движка 'easy-qrcode' (Классика)
                // ------------------------------------------
                easyOptions: {
                    colorDark: "#000000", // Цвет самого кода
                    colorLight: "#ffffff", // Цвет фона
                    dotScale: 1, // Масштаб точек (0.1 - 1.0)
                    // Цвета угловых элементов (можно раскомментировать для цвета)
                    // PO: '#0052cc',       // Position Outer color
                    // PI: '#172b4d',       // Position Inner color
                    correctLevel: typeof QRCode !== 'undefined' ? QRCode.CorrectLevel.H : 2 // Уровень коррекции ошибок
                }
            };
            // ==========================================


            const baseUrl = '<?= BASE_URL ?>';
            let currentItems = [];

            const typeTranslations = {
                'image': 'Изображение',
                'video': 'Видео',
                'text': 'Текст',
                'audio': 'Аудио'
            };

            // Санитизация имени
            function sanitizeFileName(name) {
                if (!name) return 'no_title';
                return name.replace(/[<>:"\/\\|?*]+/g, '_').replace(/\s+/g, '_').trim();
            }

            // Првеью-иконки
            function getPreviewHtml(item) {
                if (item.type === 'image') {
                    return `<img src="${baseUrl}/uploads/${item.content}" class="preview-icon shadow-sm" alt="img">`;
                }
                let icon = '';
                if (item.type === 'video') icon = '🎬';
                if (item.type === 'text') icon = '📝';
                if (item.type === 'audio') icon = '🎧';
                return `<div class="preview-icon shadow-sm">${icon}</div>`;
            }

            // Загрузка списка
            async function loadList() {
                const res = await fetch('?api=list');
                currentItems = await res.json();
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = '';

                currentItems.forEach(item => {
                    const link = `${baseUrl}/?id=${item.id}`;
                    const typeRu = typeTranslations[item.type] || item.type;
                    const title = item.title || 'Без названия';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><div class="d-flex justify-content-center">${getPreviewHtml(item)}</div></td>
                        <td class="text-start fw-bold">${title}</td>
                        <td><span class="badge bg-secondary">${typeRu}</span></td>
                        <td><div id="qr-${item.id}" class="qr-preview mx-auto"></div></td>
                        <td><a href="${link}" target="_blank" class="text-decoration-none small">${link}</a></td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <button class="btn btn-sm btn-info text-white" onclick="downloadSingleQR('${item.id}', '${encodeURIComponent(title)}', '${item.type}')">Скачать QR</button>
                                <button class="btn btn-sm btn-warning" onclick="editItem('${item.id}')">Изменить</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteItem('${item.id}')">Удалить</button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                    generateQR(link, `qr-${item.id}`, 250);
                });
            }

            // Переключение полей
            function toggleFields() {
                const type = document.getElementById('content-type').value;
                const mediaInput = document.getElementById('media_file');

                document.getElementById('field-media').classList.toggle('hidden', !['image', 'video'].includes(type));
                document.getElementById('field-text').classList.toggle('hidden', type !== 'text');
                document.getElementById('field-audio').classList.toggle('hidden', type !== 'audio');

                if (type === 'image') {
                    mediaInput.setAttribute('accept', 'image/png, image/jpeg, image/gif, image/webp');
                } else if (type === 'video') {
                    mediaInput.setAttribute('accept', 'video/mp4, video/webm, video/ogg');
                }
            }

            // Добавление аудио
            function addAudioTrack(trackData = null) {
                const container = document.getElementById('audio-tracks-container');
                const div = document.createElement('div');
                div.className = 'audio-track-box d-flex flex-column gap-2 mb-3 bg-white p-3 border rounded shadow-sm';

                let langVal = trackData ? trackData.lang : '';
                let filePath = trackData ? trackData.file_path : '';

                let fileInfoHtml = '';
                if (filePath) {
                    fileInfoHtml = `<div class="small text-success mb-1">✓ Текущий файл: <strong>${filePath}</strong> (Оставьте пустым, чтобы не менять)</div>`;
                }

                div.innerHTML = `
                    <div class="d-flex flex-column flex-md-row gap-3 align-items-md-center">
                        <div>
                            <label class="small text-muted mb-1">Язык</label>
                            <input type="text" class="form-control" name="audio_langs[]" placeholder="Язык (RU, EN...)" value="${langVal}" required>
                        </div>
                        <div class="flex-grow-1">
                            ${fileInfoHtml}
                            <input type="file" class="form-control form-control-sm" name="audio_files[]" accept="audio/mpeg, audio/ogg, audio/wav, audio/mp3">
                            <input type="hidden" name="existing_audio[]" value="${filePath}">
                        </div>
                        <div class="align-self-end align-self-md-center mt-2 mt-md-0">
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.audio-track-box').remove()">Удалить</button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            }

            // ГЕНЕРАТОР (Роутер по выбранному движку)
            async function generateQRййй(text, elementOrId, size = 100) {
                // Убеждаемся, что ссылка полная (для распознавания телефонами)
                if (!text.startsWith('http')) {
                    //text = window.location.protocol + '//' + text;
                    text = "https" + '//' + text;
                }

                /* // заменить http на https
                text = text.replace('http', 'https');

                // Убеждаемся, что ссылка полная (для распознавания телефонами)
                if (!text.startsWith('http')) {
                    //text = window.location.protocol + '//' + text;
                    text = "https" + '//' + text;
                }

                // заменить localhost в ссылке на mail.ru
                text = text.replace('localhost', 'mail.ru'); */

                let container;
                if (typeof elementOrId === 'string') {
                    container = document.getElementById(elementOrId);
                } else {
                    container = elementOrId;
                }

                if (!container) return null;
                container.innerHTML = '';

                if (qrConfig.engine === 'qr-code-styling' && typeof QRCodeStyling !== 'undefined') {
                    const options = {
                        width: size,
                        height: size,
                        data: text, // Теперь здесь точно ссылка с http/https
                        margin: qrConfig.margin,
                        image: qrConfig.logo,
                        dotsOptions: {
                            color: qrConfig.stylingOptions.dotsColor,
                            type: qrConfig.stylingOptions.dotType
                        },
                        backgroundOptions: {
                            color: qrConfig.stylingOptions.backgroundColor,
                        },
                        imageOptions: {
                            crossOrigin: "anonymous",
                            margin: 5,
                            imageSize: qrConfig.stylingOptions.logoImageSize,
                            hideBackgroundDots: qrConfig.stylingOptions.logoHideBackgroundDots
                        },
                        cornersSquareOptions: {
                            color: qrConfig.stylingOptions.cornersSquareColor,
                            type: qrConfig.stylingOptions.cornersSquareType
                        },
                        cornersDotOptions: {
                            color: qrConfig.stylingOptions.cornersDotColor,
                            type: qrConfig.stylingOptions.cornersDotType
                        }
                    };

                    if (qrConfig.stylingOptions.useGradient) {
                        options.dotsOptions.gradient = {
                            type: qrConfig.stylingOptions.gradientType,
                            colorStops: qrConfig.stylingOptions.gradientColors.map((color, index) => ({
                                offset: index / (qrConfig.stylingOptions.gradientColors.length - 1),
                                color: color
                            }))
                        };
                    }

                    const qrCode = new QRCodeStyling(options);
                    qrCode.append(container);

                    // Ждем отрисовки (библиотеке нужно время на рендер)
                    await qrCode._canvas;
                    return qrCode;

                } else {
                    // Классический генератор
                    return new QRCode(container, {
                        text: text,
                        width: size,
                        height: size,
                        logo: qrConfig.logo,
                        logoWidth: size * 0.3,
                        logoHeight: size * 0.3,
                        colorDark: qrConfig.easyOptions.colorDark,
                        colorLight: qrConfig.easyOptions.colorLight,
                        dotScale: qrConfig.easyOptions.dotScale,
                        correctLevel: qrConfig.easyOptions.correctLevel
                    });
                }
            }





            async function generateQR(text, elementOrId, size = 100) {
                // === 1. Фиксим URL (теперь даже localhost будет правильной ссылкой) ===
                let url = text.trim();

                if (!/^https?:\/\//i.test(url)) {
                    url = 'https://' + url;
                } else if (url.startsWith('http://')) {
                    url = 'https://' + url.substring(7);
                }

                // === 2. Получаем контейнер ===
                let container;
                if (typeof elementOrId === 'string') {
                    container = document.getElementById(elementOrId);
                } else {
                    container = elementOrId;
                }
                if (!container) return null;

                container.innerHTML = '';

                // === 3. МЕГА-СОВРЕМЕННЫЙ движок qr-code-styling ===
                if (qrConfig.engine === 'qr-code-styling' && typeof QRCodeStyling !== 'undefined') {

                    const optionsOld = {
                        width: size,
                        height: size,
                        data: url,
                        margin: qrConfig.margin ?? 2,

                        // Логотип
                        image: qrConfig.logo,

                        // === Точки — самый стильный вариант 2026 ===
                        dotsOptions: {
                            color: qrConfig.stylingOptions.dotsColor || '#111111',
                            type: qrConfig.stylingOptions.dotType || 'classy-rounded', // ← вот он, трендовый вид!
                        },

                        // Фон
                        backgroundOptions: {
                            color: qrConfig.stylingOptions.backgroundColor || '#ffffff',
                        },

                        // Логотип в центре
                        imageOptions: {
                            crossOrigin: "anonymous",
                            margin: 10, // чуть больше отступа — красивее
                            imageSize: qrConfig.stylingOptions.logoImageSize ?? 0.42,
                            hideBackgroundDots: qrConfig.stylingOptions.logoHideBackgroundDots ?? true,
                        },

                        // === Углы — супер-современные ===
                        cornersSquareOptions: {
                            color: qrConfig.stylingOptions.cornersSquareColor || '#111111',
                            type: qrConfig.stylingOptions.cornersSquareType || 'extra-rounded',
                        },
                        cornersDotOptions: {
                            color: qrConfig.stylingOptions.cornersDotColor || '#111111',
                            type: qrConfig.stylingOptions.cornersDotType || 'dot',
                        },

                        // Высокая коррекция ошибок — логотип не ломает QR
                        qrOptions: {
                            errorCorrectionLevel: 'H'
                        }
                    };



                    const options = {
                        "type": "canvas",
                        "shape": "square",
                        "width": 2000,
                        "height": 2000,
                        "data": url,
                        "margin": 10,
                        "qrOptions": {
                            "typeNumber": "0",
                            "mode": "Byte",
                            "errorCorrectionLevel": "H"
                        },

                        // Логотип
                        "image": qrConfig.logo,


                        "imageOptions": {
                            "saveAsBlob": true,
                            "hideBackgroundDots": true,
                            "imageSize": 0.4,
                            "margin": 0
                        },
                        "dotsOptions": {
                            "type": "extra-rounded",
                            "color": "#6a1a4c",
                            "roundSize": true,
                            "gradient": {
                                "type": "radial",
                                "rotation": 3.141592653589793,
                                "colorStops": [{
                                        "offset": 0,
                                        "color": "#337ab7"
                                    },
                                    {
                                        "offset": 1,
                                        "color": "#02345f"
                                    }
                                ]
                            }
                        },
                        "backgroundOptions": {
                            "round": 0,
                            "color": "#ffffff"
                        },

                        "dotsOptionsHelper": {
                            "colorType": {
                                "single": true,
                                "gradient": false
                            },
                            "gradient": {
                                "linear": true,
                                "radial": false,
                                "color1": "#6a1a4c",
                                "color2": "#6a1a4c",
                                "rotation": "0"
                            }
                        },
                        "cornersSquareOptions": {
                            "type": "extra-rounded",
                            "color": "#000000",
                            "gradient": {
                                "type": "radial",
                                "rotation": 0.7853981633974483,
                                "colorStops": [{
                                        "offset": 0,
                                        "color": "#337ab7"
                                    },
                                    {
                                        "offset": 1,
                                        "color": "#02345f"
                                    }
                                ]
                            }
                        },
                        "cornersSquareOptionsHelper": {
                            "colorType": {
                                "single": true,
                                "gradient": false
                            },
                            "gradient": {
                                "linear": true,
                                "radial": false,
                                "color1": "#000000",
                                "color2": "#000000",
                                "rotation": "0"
                            }
                        },
                        "cornersDotOptions": {
                            "type": "",
                            "color": "#000000",
                            "gradient": {
                                "type": "linear",
                                "rotation": 0.7853981633974483,
                                "colorStops": [{
                                        "offset": 0,
                                        "color": "#337ab7"
                                    },
                                    {
                                        "offset": 1,
                                        "color": "#02345f"
                                    }
                                ]
                            }
                        },
                        "cornersDotOptionsHelper": {
                            "colorType": {
                                "single": true,
                                "gradient": false
                            },
                            "gradient": {
                                "linear": true,
                                "radial": false,
                                "color1": "#000000",
                                "color2": "#000000",
                                "rotation": "0"
                            }
                        },
                        "backgroundOptionsHelper": {
                            "colorType": {
                                "single": true,
                                "gradient": false
                            },
                            "gradient": {
                                "linear": true,
                                "radial": false,
                                "color1": "#ffffff",
                                "color2": "#ffffff",
                                "rotation": "0"
                            }
                        }
                    }

                    // === Градиент по умолчанию (можно отключить в qrConfig) ===
                    const useGradient = qrConfig.stylingOptions.useGradient !== false;

                    if (useGradient) {
                        const colors = qrConfig.stylingOptions.gradientColors?.length > 1 ?
                            qrConfig.stylingOptions.gradientColors :
                            ['#7b2cbf', '#c026d3', '#db2777']; // красивый современный градиент по умолчанию

                        options.dotsOptions.gradient = {
                            type: qrConfig.stylingOptions.gradientType || 'linear',
                            rotation: qrConfig.stylingOptions.gradientRotation ?? 45,
                            colorStops: colors.map((color, index) => ({
                                offset: index / (colors.length - 1),
                                color: color
                            }))
                        };
                    }

                    // Создаём QR
                    const qrCode = new QRCodeStyling(options);

                    // Добавляем в DOM
                    qrCode.append(container);

                    // Ждём полной отрисовки (надёжнее, чем оригинал)
                    await new Promise(resolve => setTimeout(resolve, 120));

                    return qrCode;
                } else {
                    // Классический вариант (оставлен на случай, если qr-code-styling не загружен)
                    console.warn('qr-code-styling не найден → используем простой QRCode');
                    return new QRCode(container, {
                        text: url,
                        width: size,
                        height: size,
                        logo: qrConfig.logo,
                        logoWidth: size * 0.35,
                        logoHeight: size * 0.35,
                        colorDark: qrConfig.easyOptions.colorDark || '#000000',
                        colorLight: qrConfig.easyOptions.colorLight || '#ffffff',
                        dotScale: qrConfig.easyOptions.dotScale || 1,
                        correctLevel: qrConfig.easyOptions.correctLevel || QRCode.CorrectLevel.H
                    });
                }
            }

            // Скачивание ЕДИНИЧНОГО QR-кода
            async function downloadSingleQR(id, titleEncoded, type) {
                const title = decodeURIComponent(titleEncoded);
                const safeTitle = sanitizeFileName(title);
                const link = `${baseUrl}/?id=${id}`;

                if (qrConfig.engine === 'qr-code-styling' && typeof QRCodeStyling !== 'undefined') {
                    // Создаем временный невидимый контейнер
                    const tempDiv = document.createElement('div');
                    const qrCode = await generateQR(link, tempDiv, 1000);

                    if (qrCode) {
                        // Важно: скачиваем через встроенный метод после генерации
                        await qrCode.download({
                            name: `QR_${safeTitle}_${type}`,
                            extension: "png"
                        });
                    }
                } else {
                    // Логика для easy.qrcode
                    const hiddenDiv = document.createElement('div');
                    hiddenDiv.style.display = 'none';
                    document.body.appendChild(hiddenDiv);

                    await generateQR(link, hiddenDiv, 1000);

                    setTimeout(() => {
                        const canvas = hiddenDiv.querySelector('canvas');
                        if (canvas) {
                            canvas.toBlob(function(blob) {
                                saveAs(blob, `QR_${safeTitle}_${type}.png`);
                                document.body.removeChild(hiddenDiv);
                            });
                        }
                    }, 500);
                }
            }

            // Архивация всех QR-кодов
            async function downloadAllQR() {
                if (currentItems.length === 0) return alert('Нет контента');
                const zip = new JSZip();
                const folder = zip.folder("museum_qrs");

                const hiddenDiv = document.createElement('div');
                hiddenDiv.style.display = 'none';
                document.body.appendChild(hiddenDiv);

                for (let item of currentItems) {
                    const tempId = `temp-qr-${item.id}`;
                    hiddenDiv.innerHTML = `<div id="${tempId}"></div>`;
                    const link = `${baseUrl}/?id=${item.id}`;
                    const safeTitle = sanitizeFileName(item.title);
                    const finalFileName = `QR_${safeTitle}_${item.type}.png`;

                    if (qrConfig.engine === 'qr-code-styling' && typeof QRCodeStyling !== 'undefined') {
                        // QR Code Styling позволяет напрямую получить сырые данные (Blob)
                        const qrCode = await generateQR(link, tempId, 1000);
                        const blob = await qrCode.getRawData("png");
                        if (blob) {
                            folder.file(finalFileName, blob);
                        }
                    } else {
                        // Для easy.qrcode достаем из canvas
                        generateQR(link, tempId, 1000);
                        await new Promise(r => setTimeout(r, 150));
                        const canvas = document.querySelector(`#${tempId} canvas`);
                        if (canvas) {
                            const dataURL = canvas.toDataURL("image/png").replace("data:image/png;base64,", "");
                            folder.file(finalFileName, dataURL, {
                                base64: true
                            });
                        }
                    }
                }

                document.body.removeChild(hiddenDiv);
                zip.generateAsync({
                    type: "blob"
                }).then(function(content) {
                    saveAs(content, "museum_qrs.zip");
                });
            }

            // Сохранение формы
            document.getElementById('content-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(e.target);

                try {
                    const res = await fetch('?api=save', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await res.json();
                    if (result.success) {
                        showList();
                        loadList();
                    } else {
                        alert('Ошибка: ' + result.error);
                    }
                } catch (err) {
                    alert('Ошибка сети или сервера');
                }
            });

            function deleteItem(id) {
                if (confirm('Удалить этот контент? Внимание: файлы также будут удалены с сервера.')) {
                    const fd = new FormData();
                    fd.append('id', id);
                    fetch('?api=delete', {
                        method: 'POST',
                        body: fd
                    }).then(() => loadList());
                }
            }

            function showForm() {
                document.getElementById('view-list').classList.add('hidden');
                document.getElementById('view-form').classList.remove('hidden');
                document.getElementById('form-title').innerText = 'Добавить контент';
                document.getElementById('content-form').reset();
                document.getElementById('item-id').value = '';
                document.getElementById('audio-tracks-container').innerHTML = '';
                toggleFields();
            }

            function showList() {
                document.getElementById('view-form').classList.add('hidden');
                document.getElementById('view-list').classList.remove('hidden');
            }

            function editItem(id) {
                const item = currentItems.find(i => i.id === id);
                if (!item) return;

                showForm();

                document.getElementById('form-title').innerText = 'Редактировать контент';
                document.getElementById('item-id').value = item.id;
                document.getElementById('item-title').value = item.title;
                document.getElementById('content-type').value = item.type;

                if (item.type === 'text') {
                    document.getElementById('text_content').value = item.content;
                }

                if (item.type === 'audio' && item.tracks) {
                    item.tracks.forEach(track => {
                        addAudioTrack(track);
                    });
                }

                toggleFields();
            }

            // Инициализация
            loadList();
        </script>
    </body>

    </html>
<?php
    exit;
}
?>