<?php
$file = __DIR__ . '/data/latest.html';
if (!file_exists($file)) {
    die('<h2 style="text-align:center;margin-top:80px;color:#555;">Результаты ещё не опубликованы</h2>');
}

$html = file_get_contents($file);
$lastModified = date('d.m.Y H:i:s', filemtime($file));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты соревнования</title>
    <style>
        body { margin:0; padding:0; font-family: Arial, sans-serif; background:#f5f5f5; }
        .header { 
            padding:10px 15px; 
            background:#fff; 
            border-bottom:1px solid #ddd; 
            display:flex; 
            justify-content:space-between; 
            align-items:center; 
        }
        .last-update { font-size:13px; color:#555; }
        iframe { 
            width:100%; 
            height:calc(100vh - 58px); 
            border:none; 
            background:white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Результаты соревнования</h2>
        <div class="last-update" id="time">Обновлено: <?= $lastModified ?></div>
    </div>
    
    <iframe id="content" src="./data/latest.html"></iframe>

    <script>
        let lastTime = "<?= $lastModified ?>";

        function cleanExcelArtifacts() {
            const frame = document.getElementById('content');
            try {
                const doc = frame.contentDocument || frame.contentWindow.document;
                
                // Удаляем кнопку Excel
                const images = doc.querySelectorAll('img');
                images.forEach(img => {
                    if (img.src.includes('image001.png') || 
                        img.alt.includes('Кнопка') || 
                        img.classList.contains('shape')) {
                        img.style.display = 'none';
                    }
                });

                // Удаляем все элементы с v:shapes (это артефакты Excel)
                const shapes = doc.querySelectorAll('[v\\:shapes], .shape');
                shapes.forEach(el => el.style.display = 'none');

                // Скрываем возможные пустые строки или мусор сверху
                const tables = doc.getElementsByTagName('table');
                if (tables[0]) {
                    tables[0].style.marginTop = '10px';
                }
            } catch(e) {}
        }

        // Обновление + очистка
        function checkUpdate() {
            fetch('./get_last_modified.php')
                .then(r => r.text())
                .then(time => {
                    if (time && time !== lastTime) {
                        lastTime = time;
                        document.getElementById('time').textContent = 'Обновлено: ' + time;
                        document.getElementById('content').contentWindow.location.reload(true);
                    }
                })
                .catch(() => {});
        }

        // Запускаем очистку после загрузки iframe
        document.getElementById('content').onload = function() {
            setTimeout(cleanExcelArtifacts, 800);   // небольшая задержка
        };

        setInterval(checkUpdate, 15000); // проверка каждые 15 секунд
    </script>
</body>
</html>