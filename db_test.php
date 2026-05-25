<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=auto_engine_web", "root", "");
    echo "Connected successfully to localhost\n";
} catch (PDOException $e) {
    echo "Connection to localhost failed: " . $e->getMessage() . "\n";
}

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=auto_engine_web", "root", "");
    echo "Connected successfully to 127.0.0.1\n";
} catch (PDOException $e) {
    echo "Connection to 127.0.0.1 failed: " . $e->getMessage() . "\n";
}
