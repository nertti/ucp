<?php
// index.php
$dataFile = __DIR__ . '/data/latest.json';
if (!file_exists($dataFile)) {
    die('<h2>Результаты ещё не опубликованы</h2>');
}

$json = file_get_contents($dataFile);
$data = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты соревнования</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f4; }
        h1 { text-align: center; color: #333; }
        table { width: 100%; max-width: 1200px; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #4CAF50; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .place { font-weight: bold; text-align: center; width: 60px; }
        .total { font-weight: bold; background: #e8f5e9; }
        .timestamp { text-align: center; color: #666; margin: 10px; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($data['competition'] ?? 'Соревнование') ?></h1>
    <div class="timestamp">Обновлено: <?= htmlspecialchars($data['received_at'] ?? '—') ?></div>

    <table>
        <thead>
            <tr>
                <th class="place">Место</th>
                <th>Участник</th>
                <?php 
                // Динамические заголовки этапов из первого участника
                if (!empty($data['participants'])) {
                    $first = reset($data['participants']);
                    foreach ($first['stages'] as $stage => $score) {
                        echo "<th>" . htmlspecialchars($stage) . "</th>";
                    }
                }
                ?>
                <th class="total">Сумма</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['participants'] as $p): ?>
            <tr>
                <td class="place"><?= (int)$p['place'] ?></td>
                <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                <?php foreach ($p['stages'] as $score): ?>
                    <td><?= htmlspecialchars($score) ?></td>
                <?php endforeach; ?>
                <td class="total"><?= (int)$p['total'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Автообновление каждые 30 секунд
        setTimeout(() => location.reload(), 30000);
    </script>
</body>
</html>