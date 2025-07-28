<?php
file_put_contents(__DIR__ . '/../storage/app/webhook.txt', 'Telegram hit at ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
echo "ok";
