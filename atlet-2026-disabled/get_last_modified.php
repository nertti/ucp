<?php
$file = __DIR__ . '/data/latest.html';
if (file_exists($file)) {
    echo date('d.m.Y H:i:s', filemtime($file));
} else {
    echo "";
}
?>